<?php 

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	global $post;

	if( $post->ID )
	{
		$rtwwcpig_order_id = $post->ID;
		$rtw_permalink = get_admin_url().'post.php?post='.$rtwwcpig_order_id.'&action=edit&rtwwcpig_packingslip_id='.$rtwwcpig_order_id;
		$rtwwcpig_url = RTWWCPIG_PDF_URL.'rtwwcpig_pckng_slip/rtwwcpig_'.$rtwwcpig_order_id.'.pdf';
		$rtwwcpig_dir = RTWWCPIG_PDF_DIR.'rtwwcpig_pckng_slip/rtwwcpig_'.$rtwwcpig_order_id.'.pdf';

		if (file_exists($rtwwcpig_dir)) 
		{
			?><div class="rtwwcpig_btn_wrap">

					<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_pckng_slp" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e('Download Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>

					<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_pckng_slp" data-order_id="<?php echo esc_attr($post->ID); ?>" href="javascript:void(0);"><?php esc_html_e('Delete Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>

					<a class="rtwwcpig_display_none button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_pckng_slp" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" ><?php esc_html_e('Generate Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
				</div>

			<?php 
		}
		else
		{
			?>
				
				<div class="rtwwcpig_btn_wrap">

					<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_pckng_slp" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>"><?php esc_html_e('Download Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>

					<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_pckng_slp" data-order_id="<?php echo esc_attr($post->ID); ?>" href="javascript:void(0);"><?php esc_html_e('Delete Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>

					<a class="button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_pckng_slp" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>"><?php esc_html_e('Generate Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
				</div>

			<?php 
		}
	}
}else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}
?>