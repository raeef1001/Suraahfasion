<?php
$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	foreach ($rtwwcpig_fonts as $rtwwcpig_key => $rtwwcpig_value) 
	{
		$rtwwcpig_font_array[$rtwwcpig_key] = $rtwwcpig_value ;
	}

	if(isset($_POST['rtwwcpig_submit'])) { 
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
			</button>
		</div>

		<?php
		update_option( 'rtwwcpig_header_setting_opt', sanitize_post($_POST['rtwwcpig_header_setting_opt']) );
		woocommerce_update_options( rtwwcpig_invoice_header_settings() );
	}

	settings_fields('rtwwcpig_header_setting');
	$rtwwcpig_get_setting = get_option('rtwwcpig_header_setting_opt'); 
	?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_invoice_header_settings()); ?> 
	</div>

	<table class="wp-list-table form-table rtw-table">
		<tbody>
			<tr>
				<th><?php esc_html_e('Header Html', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php
					$rtwwcpig_content = isset( $rtwwcpig_get_setting['rtw_header_html'] ) ? $rtwwcpig_get_setting['rtw_header_html'] : '';
					$rtwwcpig_content = html_entity_decode( $rtwwcpig_content );
					$rtwwcpig_content = stripslashes( $rtwwcpig_content );
					$rtwwcpig_setting = array(
						'wpautop' => false,
						'media_buttons' => true,
						'textarea_name' => 'rtwwcpig_header_setting_opt[rtw_header_html]',
						'textarea_rows' => 7
					);
					wp_editor($rtwwcpig_content, 'rtwwcpig_header_editor', $rtwwcpig_setting );
					?>
				</td>
			</tr> 
		</tbody>	
	</table>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
 * function for display WooCommerce settings.
 *
 * @since    1.0.0
 */
function rtwwcpig_invoice_header_settings()
{
	global $rtwwcpig_font_array;
	$settings =	array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'wc_settings_tab_demo_section_end'
		),
		array(
			'name' 		=> esc_html__( 'Header Top Margin', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'number',
			'desc' 		=> esc_html__( 'Enter your required top margin (By default 7)', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'id'   		=> 'rtwwcpig_header_top_margin',
			'default'	=> '7',
			'desc_tip' =>  true,
		),
		array(
			'id'          => 'rtwwcpig_header_font_family',
			'option_key'  => 'rtwwcpig_header_font_family',
			'name'       => esc_html__( 'Header Section Font', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' => esc_html__( 'Select Font type for Header section text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type'        => 'select',
			'options'     => $rtwwcpig_font_array,
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Header Section Font Size', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'number',
			'desc' 		=> esc_html__( 'Enter your required font size for Pdf Header(By default 15)', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'id'   		=> 'rtwwcpig_header_font_size',
			'default'	=> '15',
			'desc_tip' =>  true,
		),
		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'wc_settings_tab_demo_section_end'
		)
	);

	return $settings;
}