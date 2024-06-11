<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	if(isset($_POST['rtwwcpig_submit'])) 
		{ ?>
			<div class="notice notice-success is-dismissible">
				<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
				</button>
			</div>
			<?php 
			
			update_option( 'rtwwcpig_shipping_format', sanitize_post($_POST['rtwwcpig_shipping_format']));
			update_option( 'rtwwcpig_qr_code_content', sanitize_post($_POST['rtwwcpig_qr_code_content']));
			update_option( 'rtwwcpig_bar_code_content', sanitize_post($_POST['rtwwcpig_bar_code_content']));
		}

		$rtwwcpig_get_shpng_lbl_format = get_option('rtwwcpig_shipping_format');
		$rtwwcpig_qr_cntnt = get_option('rtwwcpig_qr_code_content');
		$rtwwcpig_barcode_cntnt = get_option('rtwwcpig_bar_code_content');

		if( $rtwwcpig_get_shpng_lbl_format == '' )
		{
			$rtwwcpig_get_shpng_lbl_format = '<div style="max-width: 1170px; margin: 0 auto; padding: 30px 0; box-sizing: border-box;">
			<table style="width: 650px; border-collapse: collapse; margin: 0 auto; font-family: Helvetica; border: 1px solid #dddddd; box-sizing: border-box;">
			<thead>
			<tr>
			<th style="border: 1px solid #dddddd; width: 100px; box-sizing: border-box;" rowspan="3"> </th>
			</tr>
			<tr>
			<th style="border: 1px solid #dddddd; font-size: 13px; padding: 5px 3px; box-sizing: border-box;" colspan="2">RTW Logistics</th>
			</tr>
			<tr>
			<th style="border: 1px solid #dddddd; text-transform: uppercase; font-size: 18px; font-weight: bold; padding: 5px 3px; box-sizing: border-box;">PrePaid</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td style="border: 1px solid #dddddd; padding: 20px; width: 50%; box-sizing: border-box;">
			<div>[barcode_img]</div>
			</td>
			<td style="border: 1px solid #dddddd; width: 50%; padding: 20px; box-sizing: border-box;">
			<p style="font-size: 25px; font-weight: bold; margin: 0; line-height: 22px; padding-bottom: 10px; box-sizing: border-box;">Return Address</p>
			<p style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">RedefiningTheWeb 100 MAIN ST. SEATTLE WA,98104, USA</p>
			<p style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">Phone: 987-654-032</p>
			<p style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">E-mail: developer@redefiningtheweb.com</p>
			</td>
			</tr>
			<tr>
			<td style="border: 1px solid #dddddd; padding: 20px; box-sizing: border-box;">
			<div style="margin: 0; line-height: 22px; font-size: 19px; font-weight: bold; box-sizing: border-box;">Shipping Customer Address</div>
			<div style="font-size: 13px; margin: 0; line-height: 22px box-sizing: border-box;">[shipping_first_name] [shipping_last_name]</div>
			<div style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">[shipping_address_1] , [shipping_address_2]</div>
			<div style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">[shipping_city] , [shipping_state]</div>
			<div style="font-size: 13px; margin: 0; line-height: 22px; box-sizing: border-box;">[shipping_postcode] , [shipping_country]</div>
			</td>
			<td style="border: 1px solid #dddddd; padding: 20px; box-sizing: border-box;">
			<div>[qr_code_img]</div>
			</td>
			</tr>
			<tr>
			<td colspan="4">
			<table style="width: 100%; border-collapse: collapse; box-sizing: border-box;">
			<thead>
			<tr>
			<th style="border: 1px solid #dddddd; font-family: Helvetica; font-size: 13px; padding: 5px; box-sizing: border-box;">Sr. No.</th>
			<th style="border: 1px solid #dddddd; font-family: Helvetica; font-size: 13px; padding: 5px; box-sizing: border-box;">Seller Name</th>
			<th style="border: 1px solid #dddddd; font-family: Helvetica; font-size: 13px; padding: 5px; box-sizing: border-box;">Date</th>
			<th style="border: 1px solid #dddddd; font-family: Helvetica; font-size: 13px; padding: 5px; box-sizing: border-box;">Order Number</th>
			<th style="border: 1px solid #dddddd; font-family: Helvetica; font-size: 13px; padding: 5px; box-sizing: border-box;">Order Amount</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td style="border: 1px solid #dddddd; font-size: 13px; padding: 5px; box-sizing: border-box;">1</td>
			<td style="border: 1px solid #dddddd; font-size: 13px; padding: 5px; box-sizing: border-box;">[seller_name]</td>
			<td style="border: 1px solid #dddddd; font-size: 13px; padding: 5px; box-sizing: border-box;">[order_date]</td>
			<td style="border: 1px solid #dddddd; font-size: 13px; padding: 5px; box-sizing: border-box;">[order_id]</td>
			<td style="border: 1px solid #dddddd; font-size: 13px; padding: 5px; box-sizing: border-box;">[order_amount]</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</div>';
		}

		?>

		<table class="wp-list-table form-table rtw-table">
			<tbody>
				<tr>
					<th><h3><?php esc_html_e('Macros','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p><?php esc_html_e('You can use these macros for shipping label.', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<div class="rtwwcpig_macros">
							<div class="rtwwcpig_macros_1">
								<ul>
									<li><strong>[order_id]</strong></li>
									<li><strong>[order_date]</strong></li>
									<li><strong>[order_amount]</strong></li>
									<li><strong>[total_amnt_in_words]</strong></li>
									<li><strong>[line_total]</strong></li>
									<li><strong>[product_name]</strong></li>
									<li><strong>[product_qty]</strong></li>
									<li><strong>[product_price]</strong></li>
									<li><strong>[line_number]</strong></li>
									<li><strong>[customer_note]</strong></li>
									<li><strong>[product_img]</strong></li>
									<li><strong>[payment_method]</strong></li>
									<li><strong>[seller_name]</strong></li>
								</ul>
							</div>
							<div class="rtwwcpig_macros_3">
								<ul>
									<li><strong>[shipping_first_name]</strong></li>
									<li><strong>[shipping_last_name]</strong></li>
									<li><strong>[shipping_company]</strong></li>
									<li><strong>[shipping_address_1]</strong></li>
									<li><strong>[shipping_address_2]</strong></li>
									<li><strong>[shipping_city]</strong></li>
									<li><strong>[shipping_charges]</strong></li>
									<li><strong>[shipping_method]</strong></li>
									<li><strong>[shipping_postcode]</strong></li>
									<li><strong>[shipping_country]</strong></li>
									<li><strong>[shipping_state]</strong></li>
									<li><strong>[barcode_img]</strong></li>
								</ul>
							</div>
							<div class="rtwwcpig_macros_4">
								<ul>
									<li><strong>[billing_first_name]</strong></li>
									<li><strong>[billing_last_name]</strong></li>
									<li><strong>[billing_address_1]</strong></li>
									<li><strong>[billing_address_2]</strong></li>
									<li><strong>[billing_city]</strong></li>
									<li><strong>[billing_phone]</strong></li>
									<li><strong>[billing_state]</strong></li>
									<li><strong>[billing_postcode]</strong></li>
									<li><strong>[billing_country]</strong></li>
	 								<li><strong>[billing_email]</strong></li>
	 								<li><strong>[billing_company]</strong></li>
	 								<li><strong>[qr_code_img]</strong></li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th><h3><?php esc_html_e('QR Code Content','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></th>
					<td>
						<textarea name="rtwwcpig_qr_code_content" rows="3" cols="50"><?php echo esc_html($rtwwcpig_qr_cntnt); ?></textarea>
						<div class="descr"><?php esc_html_e('Enter some content for making QR code.If empty then order detail is set.(Max. 20 words)', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
					</td>
				</tr>
				<tr>
					<th><h3><?php esc_html_e('BarCode Content','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></th>
					<td>
						<textarea name="rtwwcpig_bar_code_content" rows="5" cols="50"><?php echo esc_html($rtwwcpig_barcode_cntnt); ?></textarea>
						<div class="descr"><?php esc_html_e('Enter some content for making Barcode.If empty then order detail is set.(Max. 50 words)', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
					</td>
				</tr>

			</tbody>
		</table>

		<table class="wp-list-table form-table rtw-table">
			<tbody> 
				<tr>
					<th class="descr"><?php esc_html_e('Shipping Label Format', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
					<td>
						<?php
						if ( !empty($rtwwcpig_get_shpng_lbl_format)) 
						{
							$rtwwcpig_shpng_lbl_cntnt = $rtwwcpig_get_shpng_lbl_format ;
						}
						
						$rtwwcpig_shpng_lbl_cntnt = html_entity_decode( $rtwwcpig_shpng_lbl_cntnt );
						$rtwwcpig_shpng_lbl_cntnt = stripslashes( $rtwwcpig_shpng_lbl_cntnt );
						$rtwwcpig_shpng_label_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_shipping_format',
							'textarea_rows' => 20,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_shpng_lbl_cntnt, 'rtwwcpig_pckng_slp_html' , $rtwwcpig_shpng_label_setting );
						?>
					</td>
				</tr>
			</tbody>
		</table>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}