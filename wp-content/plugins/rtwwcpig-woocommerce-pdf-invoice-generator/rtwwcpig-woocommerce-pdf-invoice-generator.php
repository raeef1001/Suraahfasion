<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.redefiningtheweb.com
 * @since             1.0.0
 * @package           Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce PDF Invoice & Packing Slip Generator
 * Plugin URI:        www.redefiningtheweb.com
 * Description:       This plugin helps you to generate PDF invoices and packing slip of WooCommerce's order.
 * Version:           2.3.2
 * Author:            RedefiningTheWeb
 * Author URI:        www.redefiningtheweb.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rtwwcpig-woocommerce-pdf-invoice-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
update_option( 'rtwwcpig_verification_done', ['purchase_code' => 'nulled-00000-nulled','status' => true] );
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RTWWCPIG_WOOCOMMERCE_PDF_INVOICE_GENERATOR_VERSION', '2.3.2' );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/rtwwcfp-class-wordpress-contact-form-7-pdf-activator.php
 */
function rtwwcpig_woocommerce_pdf_invoice_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/rtwwcpig-class-woocommerce-pdf-invoice-generateor-activator.php';
	Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Activator::rtwwcpig_activate();
}
register_activation_hook( __FILE__, 'rtwwcpig_woocommerce_pdf_invoice_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/rtwwcpig-class-woocommerce-pdf-invoice-generator.php';

/**
 * This function is used to check woocommerce is activated or not.
 *
 * @since    1.0.0
 * @access   public
 */
function rtwwcpig_check_run_allows() 
{
	$rtwwcpig_status = true;
	if( function_exists('is_multisite') && is_multisite() )
	{
		include_once(ABSPATH. 'wp-admin/includes/plugin.php');
		if( !is_plugin_active('woocommerce/woocommerce.php') )
		{
			$rtwwcpig_status = false;
		}
	}
	else
	{
		if( !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins') ) ) )
		{
			$rtwwcpig_status = false;
		}
	}
	return $rtwwcpig_status;
}

if( rtwwcpig_check_run_allows() )
{
	//Plugin Constant
	if ( !defined( 'RTWWCPIG_DIR' ) ) {
		define('RTWWCPIG_DIR', plugin_dir_path( __FILE__ ) );
	}
	if ( !defined( 'RTWWCPIG_URL' ) ) {
		define('RTWWCPIG_URL', plugin_dir_url( __FILE__ ) );
	}
	if ( !defined( 'RTWWCPIG_HOME' ) ) {
		define('RTWWCPIG_HOME', home_url() );
	}
	if( !defined('RTWWCPIG_PDF_DIR') ){
		define ('RTWWCPIG_PDF_DIR', WP_CONTENT_DIR .'/uploads/rtwwcpig-pdf-invoice/');
	}
	if( !defined('RTWWCPIG_PDF_URL') ){
		define('RTWWCPIG_PDF_URL', WP_CONTENT_URL .'/uploads/rtwwcpig-pdf-invoice/');	
	}
	if( !defined('RTWWCPIG_PDF_PCKNGSLP_DIR') ){
		define ('RTWWCPIG_PDF_PCKNGSLP_DIR', WP_CONTENT_DIR .'/uploads/rtwwcpig-pdf-invoice/rtwwcpig_pckng_slip/');
	}
	if( !defined('RTWWCPIG_PDF_PCKNGSLP_URL') ){
		define('RTWWCPIG_PDF_PCKNGSLP_URL', WP_CONTENT_URL .'/uploads/rtwwcpig-pdf-invoice/rtwwcpig_pckng_slip/');	
	}
	if( !defined('RTWWCPIG_PDF_SHPNGLBL_DIR') ){
		define ('RTWWCPIG_PDF_SHPNGLBL_DIR', WP_CONTENT_DIR .'/uploads/rtwwcpig-pdf-invoice/rtwwcpig_shipping_label/assets/');
	}
	if( !defined('RTWWCPIG_PDF_SHPNGLBL_URL') ){
		define('RTWWCPIG_PDF_SHPNGLBL_URL', WP_CONTENT_URL .'/uploads/rtwwcpig-pdf-invoice/rtwwcpig_shipping_label/assets/');	
	}
	if( !defined('RTWWCPIG_CREDITNOTE_DIR') ){
		define ('RTWWCPIG_CREDITNOTE_DIR', WP_CONTENT_DIR .'/uploads/rtwwcpig-pdf-invoice/credit_notes/');
	}
	if( !defined('RTWWCPIG_CREDITNOTE_URL') ){
		define('RTWWCPIG_CREDITNOTE_URL', WP_CONTENT_URL .'/uploads/rtwwcpig-pdf-invoice/credit_notes/');	
	}

	if( !defined('RTWWCPIG_BASEFILE_NAME') ){
		define('RTWWCPIG_BASEFILE_NAME', plugin_basename(__FILE__) );
	}

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_run_woocommerce_pdf_invoice_generator() {

		$plugin = new Rtwwcpig_Woocommerce_Pdf_Invoice_Generator();
		$plugin->rtwwcpig_run();

	}

	rtwwcpig_run_woocommerce_pdf_invoice_generator();
}
else
{
	/**
	* Show plugin error notice.
	*
	* @since 1.0.0
	*/
	function rtwwcpig_error_notice()
	{
		?>
		<div class="error notice is-dismissible">
			<p><?php esc_html_e( 'WooCommerce is not activated, Please activate WooCommerce plugin first to install WooCommerce PDF Invoice & Packing Slip Generator.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></p>
		</div>
		<?php
	}

	/**
	* Deactivate Plugin if WooCommerce is not active
	* @since 1.0.0
	*/
	function rtwwcpig_deactivate_woocommere_pdf_invoice_and_pkng_slp_generater()
	{
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins( plugin_basename( __FILE__ ) );

		add_action('admin_notices', 'rtwwcpig_error_notice');
	}
	add_action( 'admin_init', 'rtwwcpig_deactivate_woocommere_pdf_invoice_and_pkng_slp_generater' );
}