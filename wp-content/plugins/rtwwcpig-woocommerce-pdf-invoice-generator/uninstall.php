<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://redefiningtheweb.com/
 * @since      1.0.0
 *
 * @package    Pdf_Generator_Addon_For_Elementor_Page_Builder
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$rtwwcpig_site_url 		= get_site_url();
$rtwwcpig_admin_email 	= get_option('admin_email');
$wp_get_current_user 	= get_user_meta( get_current_user_id() );

if( is_array($wp_get_current_user) && !empty( $wp_get_current_user ) )
{
	if( isset( $wp_get_current_user['first_name'][0]))
	{
		$rtwwcpig_admin_name = $wp_get_current_user['first_name'][0] . ' '. $wp_get_current_user['last_name'][0];
	}
}
else{
	$wp_get_current_user 	= wp_get_current_user();
	$rtwwcpig_admin_name 	= $wp_get_current_user->data->user_nicename;
}
$rtwwcpig_plugin_name 	= 'WooCommerce PDF Invoice & Packing Slip Generator';
$plugin_text_domain 	= 'rtwwcpig-woocommerce-pdf-invoice-generator';
$rtwwcpig_site_domain 	= preg_replace( "(^https?://)", "", $rtwwcpig_site_url );
$rtwwcpig_purchase_code = get_option( 'rtwwcpig_verification_done', array() );

$rtwwcpig_post_array = array(
						'site_domain' => $rtwwcpig_site_domain,
						'admin_email' => $rtwwcpig_admin_email,
						'admin_name' => $rtwwcpig_admin_name,
						'plugin_name' => $rtwwcpig_plugin_name,
						'text_domain' => $plugin_text_domain,
						'purchase_code' => $rtwwcpig_purchase_code['purchase_code'],
						'plugin_id' => 24179339
					);
delete_option('rtwwcpig_verification_done');
$args = array(
				'method' => 'POST',
				'headers'  => array(
						'Content-type: application/x-www-form-urlencoded'
				),
				'sslverify' => false,
				'body' => $rtwwcpig_post_array
		);

$response = wp_remote_post( 'https://demo.redefiningtheweb.com/license-verification/license-remove.php', $args );

wp_redirect( esc_url( admin_url( 'admin.php?page=rtwwcpig-pdf-invoice-settings' ) ) );