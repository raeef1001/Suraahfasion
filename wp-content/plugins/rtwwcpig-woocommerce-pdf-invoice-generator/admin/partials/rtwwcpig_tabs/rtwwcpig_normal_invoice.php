<?php 
$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
if (!empty($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' ) 
{
	if(isset($_POST['rtwwcpig_submit'])) 
	{
		?> 
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
			</button>
		</div>
		<?php
		woocommerce_update_options( rtwwcpig_normal_invoice_settings() );
	}
	?>
	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_normal_invoice_settings()); ?> 
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
function rtwwcpig_normal_invoice_settings()
{
	$settings =	array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'rtwwcpig_normal_invoice_setting_opt'
		),
		array(
			'name' 		=> esc_html__( 'Enable Normal Invoicing', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Normal invoices are gnerated as soon as order are marked as completed.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_regular_invoice',
		),
		array(
			'name' 		=> esc_html__( 'Download From My Account Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled user will be able to download normal PDF invoice from my account page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_allow_dwnlod_frm_my_acnt',

		),
		array(
			'name' 		=> esc_html__( 'Display Download Button On Order List Table', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled admin will be able to download PDF invoice from order list page directly.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_dwnlod_on_ordr_page',

		),
		array(
			'name' 		=> esc_html__( 'Display Download Button On Order Detail Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled user will be able to download PDF invoice from order detailes page directly.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dsply_dwnlod_on_ordr_detail_page',

		),
		array(
			'name' 		=> esc_html__( 'Download From Edit Order Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled admin will be able to download PDF invoice from edit order page directly.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_dwnld_edit_ordr_page',

		),
		array(
			'name' 		=> esc_html__( 'Show Order Completed Watermark', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enable then add automatically a watermark on Invoice when order marked as completed.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_show_completed_watermark',
		),
		array(
			'name' 		=> esc_html__( 'Attached to Order Email', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled PDF invoice is send along with order complition mail to the user .', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_atchd_ordr_mail',
		),
		array(
			'name' 		=> esc_html__( 'Allow admin For Delete Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'If enabled, admin wiil be able to delete pdf invoice from edit order page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip' =>  true,
			'id'   		=> 'rtwwcpig_admin_delete_normal_invoice',
		),

		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'wc_settings_tab_demo_section_end'
		)
	);
return $settings;
} 	
