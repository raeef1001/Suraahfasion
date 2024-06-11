<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	if(isset($_POST['rtwwcpig_submit'])) {
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
			</button>
			</div><?php
			woocommerce_update_options( rtwwcpig_prduct_tax_settings() );
		}
	?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_prduct_tax_settings()); ?> 
	</div>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
* function for display woocommerce settings.
*
* @since    1.0.0
*/
function rtwwcpig_prduct_tax_settings()
{
	$rtwwcpig_html = '';
	$settings =	array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'rtwwcpig_product_and_tax_setting_opt'
		),
		array(
			'id'          => 'rtwwcpig_prdct_id_sku',
			'option_key'  => 'rtwwcpig_prdct_id_sku',
			'name'       => esc_html__( 'Display Product ID/SKU', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' => esc_html__( 'Select option for Showing product Id or SKU after its name.', 'rtwwcpig-woocommerce-pdf-invoice-generator.' ),
			'type'        => 'select',
			'options'     => array(
				'dont_dsply'   => esc_html__( 'Do Not Display', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'dsply_prdct_id'  => esc_html__( 'Display Product ID(WP Post ID)', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'dsply_sku'  => esc_html__( 'Display SKU', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			),
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Display Product Category', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want to show product category.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_prdct_cat',
		),
		array(
			'name' 		=> esc_html__( 'Show Line Total with Tax', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want to show line total included with tax amount.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_total_with_tax',
		),
		array(
			'name' 		=> esc_html__( 'Display Order Status On PDF Invoice ', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled then order staus will displayed on the Invoice.' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_allow_show_odr_status',

		),
		array(
			'name' 		=> esc_html__( 'Choose Date Format', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'text',
			'desc' 		=> esc_html__( 'User can set date format of date ( ie.d/m/Y or d-m-Y etc ).','rtwwcpig-woocommerce-pdf-invoice-generator'),
			'id'   		=> 'rtwwcpig_date_format',
			'default'	=> '',
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Display Product Image', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want to show product image on PDF invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_prdct_img',
		),
		$rtwwcpig_height_html = apply_filters( 'rtwwcpig_custom_hieght_html',  $rtwwcpig_html ),
		$rtwwcpig_width_html = apply_filters( 'rtwwcpig_custom_width_html',  $rtwwcpig_html ),
		array(
			'name' 		=> esc_html__( 'Display Currency Symbol', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled, currency symbol (e.g. $) will be displayed next to every amount on the invoice.By default currency code (e.g. USD) is displayed next to total amount.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_crrncy_smbl',
		),
		array(
			'name' 		=> esc_html__( 'Display Payment Method', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled, payment method title will displayed in both types of invoices and also in packing slip;', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_paymnt_mthd',
		),
		array(
			'name' 		=> esc_html__( 'Display Shipping Charges', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled, shipping row will be displayed in order summary.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_fee_shipng',
		),
		array(
			'name' 		=> esc_html__( 'Display Amount In Words', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want to show Amount in words.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_amnt_word',
		),
		array(
			'id'          => 'rtwwcpig_dsplay_tax_row',
			'name'       => esc_html__( 'Display Tax Row', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' => esc_html__( 'If enabled, total of all applicable taxes will be listed.', 'rtwwcpig-woocommerce-pdf-invoice-generator.' ),
			'type'        => 'checkbox',
			'desc_tip' =>  true,
		),
		array(
			'id'          => 'rtwwcpig_remove_prsnl_data',
			'option_key'  => 'rtwwcpig_remove_prsnl_data',
			'name'       => esc_html__( 'When Personal Data Is Removed', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' => esc_html__( 'Choose what should happend when any user personal data is delete or removed.', 'rtwwcpig-woocommerce-pdf-invoice-generator.' ),
			'type'        => 'select',
			'options'     => array(
				'keep_invoice'   => esc_html__( 'Keep Invoice - will remove manually', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'remove_invoice'  => esc_html__( 'Remove Invoice automatically', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				),
			'desc_tip' =>  true,
		),

		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'rtwwcpig_product_and_tax_setting_opt'
		)
	);

	return $settings;
}