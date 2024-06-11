<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	global $post;
	global $wp;

	if( $post->ID )
	{
		$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
		if ( $pdf_name == '' ) {
		$pdf_name = 'rtwwcpig_';
		}
		$rtwwcpig_order = wc_get_order( $post->ID );
		$rtwwcpig_order_id = $rtwwcpig_order->get_id();
		if(rtwwcpig_woo_seq_order_no_compatibility())
		{
			$rtwwcpig_order_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_order_id , $rtwwcpig_order);
		}
		$rtw_permalink = get_admin_url().'post.php?post='.$rtwwcpig_order_id.'&action=edit&rtwwcpig_order_id='.$rtwwcpig_order_id;

		$rtwwcpig_url = RTWWCPIG_PDF_URL.$pdf_name.$rtwwcpig_order_id.'.pdf';
		$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_order_id.'.pdf';
		
		$rtwwcpig_order_status = $rtwwcpig_order->get_status(); // Get the order status
		
		if (file_exists($rtwwcpig_dir)) 
		{
			if ( $rtwwcpig_order_status == 'completed' && get_option('rtwwcpig_dwnld_edit_ordr_page') == 'yes') 
			{
				$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Normal Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				?>
				
				<div class="rtwwcpig_btn_wrap">

					<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_nrml_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					<?php if(get_option( 'rtwwcpig_admin_delete_normal_invoice' ) == 'yes')
					{ ?>
						<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_nrml" href="javascript:void(0);" data-order_id="<?php echo esc_attr($rtwwcpig_order_id); ?>"><?php esc_html_e('Delete '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					<?php } ?>
					<a class="rtwwcpig_display_none button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwwcpig_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
				</div>



				<?php 
			}
			else
			{
				$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				if( get_option('rtwwcpig_allow_proforma_dwnlod') == 'yes' ){
				?>
					<div class="rtwwcpig_btn_wrap">
						<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_prfrm_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
						<?php if(get_option( 'rtwwcpig_admin_delete_proforma_invoice' ) == 'yes')
						{ ?>
							<a class="rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_profrma" href="javascript:void(0);" data-order_id="<?php echo esc_attr($rtwwcpig_order_id); ?>"><?php esc_html_e('Delete '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
						<?php } ?>
						<a class="rtwwcpig_display_none button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwwcpig_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					</div>
				<?php
				} 				
			}
		}
		else
		{
			if ( $rtwwcpig_order_status == 'completed' && get_option('rtwwcpig_dwnld_edit_ordr_page') == 'yes') 
			{
				$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				?>
				
				<div class="rtwwcpig_btn_wrap">

					<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_nrml_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					<?php if(get_option( 'rtwwcpig_admin_delete_normal_invoice' ) == 'yes')
					{ ?>
						<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_nrml" href="javascript:void(0);" data-order_id="<?php echo esc_attr($rtwwcpig_order_id); ?>"><?php esc_html_e('Delete '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					<?php } ?>
					<a class="button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwwcpig_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
				</div>



				<?php 
			}
			else
			{
				$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download Proforma Invoice';
					$other_txt = 'Invoice';
				}else{
					$other_txt = 'License';
				}
				if( get_option('rtwwcpig_allow_proforma_dwnlod') == 'yes' ){
				?>
					<div class="rtwwcpig_btn_wrap">
						<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_prfrm_btn" target="_blank" href="<?php echo esc_url($rtw_permalink); ?>" download><?php esc_html_e($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
						<?php if(get_option( 'rtwwcpig_admin_delete_proforma_invoice' ) == 'yes')
						{ ?>
							<a class="rtwwcpig_display_none rtwwcpig_btn button button-primary" id="rtwwcpig_dlt_profrma" href="javascript:void(0);" data-order_id="<?php echo esc_attr($rtwwcpig_order_id); ?>"><?php esc_html_e('Delete '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
						<?php } ?>
						<a class="button button-primary rtwwcpig_btn" id="rtwwcpig_regnrt_invoice" href="javascript:void(0);" data-order_id="<?php echo esc_attr($post->ID); ?>" data-order_status="<?php echo esc_attr($rtwwcpig_order_status); ?>"><?php esc_html_e('Regenerate '.$other_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></a>
					</div>
				<?php
				}			
			}
		}
	}
}else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}
?>