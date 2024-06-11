<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	if(isset($_POST['rtwwcpig_submit'])) 
	{
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
			</button>
			</div><?php
			woocommerce_update_options( rtwwcpig_proforma_invoice_settings() );
	} ?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_proforma_invoice_settings()); ?> 
	</div>
<?php }
else
{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
 * function for display WooCommerce settings.
 *
 * @since    1.0.0
 */
function rtwwcpig_proforma_invoice_settings()
{
	$settings = array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'rtwwcpig_proforma_invoice_setting_opt'
		),
		
		array(
			'name' 		=> esc_html__( 'Enable Proforma Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Proforma invoices are gnerated as soon as order are marked as Paid.In proforma invoice Order ID is used for invoice numbering method.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_proforma_invoice',
		),
		array(
			'id'          => 'rtwwcpig_when_gnrate_invoice',
			'option_key'  => 'rtwwcpig_when_gnrate_invoice',
			'name'        => esc_html__( 'Select The Status', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc'        => esc_html__( 'Select the order status for which you want to generate Proforma PDF invoice, except Refunded and Failed(By default Processing is set.)', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type'        => 'select',
			'options'     => array(
				'all-status'  => esc_html__( 'All Status', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'on-hold'  => esc_html__( 'On hold', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'cancelled'  => esc_html__( 'Cancelled', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'processing'  => esc_html__( 'Processing', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'pending'  => esc_html__( 'Pending Payment', 'rtwwcpig-woocommerce-pdf-invoice-generator' )
			),
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Download From My Account Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled user will be able to download proforma PDF invoice from my account page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_allow_proforma_dwnlod_frm_my_accnt',
		),
		array(
			'name' 		=> esc_html__( 'Download From Order List Table', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled admin will be able to download proforma PDF invoice from order list table.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_dwnld_prfrma_order_list',
		),
		array(
			'name' 		=> esc_html__( 'Download From Order Detail Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled user will be able to download proforma PDF invoice from order order detail page directoly.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_dwnld_prfrma_order_detail',
		),
		array(
			'name' 		=> esc_html__( 'Download From Edit Order Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled admin will be able to download proforma PDF invoice from edit order page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_allow_proforma_dwnlod',
		),
		array(
			'name' 		=> esc_html__( 'Allow admin For Delete Proforma Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled, admin wiil be able to delete pdf invoice from edit order page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_admin_delete_proforma_invoice',
		),
		array(
			'name' 		=> esc_html__( 'Attached to order Email', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled PDF proforma invoice wiil be email to the user with order on-hold email and possibly proccessing order email', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_attchd_profrma_ordr_mail',
		),

		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'wc_settings_tab_demo_section_end'
		)
	);

	return $settings;
}
