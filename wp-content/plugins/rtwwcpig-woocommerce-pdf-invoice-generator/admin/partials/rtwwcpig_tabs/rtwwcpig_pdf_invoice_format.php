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
		update_option( 'rtwwcpig_invoice_format_setting_opt', $_POST['rtwwcpig_invoice_format_setting_opt']);
	}
		settings_fields('rtwwcpig_invoice_format_setting');
		$rtwwcpig_get_setting 			= get_option('rtwwcpig_invoice_format_setting_opt');
		$rtwwcpig_template_selected 	= isset( $rtwwcpig_get_setting[ 'invoice_template' ] ) ? $rtwwcpig_get_setting[ 'invoice_template' ] : '1';

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );

		$rtwwcpig_get_pkngslp_format = get_option('pckng_slp_format');

		$rtwwcpig_content_html_1 = '
		<div style="background-color: #eeeeee; padding: 3%;">
			<div style="width: 19%; float: left;"><img src="" alt="text" width="100px" /></div>
				<div style="width: 40%; float: left; color: #444444;">
					<p style="font-size: 16px; margin: 5px 0;">987-654-032</p>
					<p style="font-size: 16px; margin: 5px 0;">developer@redefiningtheweb.com</p>
					<p style="font-size: 16px; margin: 5px 0;">RedefiningTheWeb.com</p>
				</div>
				<div style="width: 38%; float: left; color: #444444; margin-left: 30px;">
					<p style="font-size: 16px; color: #444444;">100 MAIN ST.,SEATTLE, WA,98104, USA</p>
				</div>
			</div>
			<div style="margin-top: 30px; margin-left: 40px; margin-right: 40px;">
				<div style="float: left; width: 35%;">
					<p style="color: #777777; font-weight: bold;">Billed To</p>
					<p>[billing_first_name] [billing_last_name]</p>
					<p>[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
				</div>
			<div style="float: left; width: 32%; margin-left: 30px;">
				<p style="color: #777777; font-weight: bold;">Invoice Number</p>
				<p>[order_id]</p>
				<p style="color: #777777; font-weight: bold;">Date Of Issue</p>
				<p>[order_date]</p>
			</div>
			<div style="float: left; width: 28%; margin-left: 5px;">
				<p style="color: #777777; font-weight: bold;">Invoice Total</p>
				<p style="color: #8ac6d1; font-size: 32px; font-weight: bold;">[order_amount]</p>
			</div>
		</div>
		<div style="border-top: 3px solid #8ac6d1; margin-top: 40px; margin-left: 40px; margin-right: 40px;">
			<table id="rtwwcpig_prod_table" style="width: 100%; border-collapse: collapse;">
				<thead>
					<tr>
						<th style="width: 100px; padding: 15px 10px; color: #777777; text-align: left; border-bottom: 1px solid #dddddd;">Line No.</th>
						<th style="width: 200px; padding: 15px 10px; color: #777777; text-align: left; border-bottom: 1px solid #dddddd;">Product</th>
						<th style="width: 90px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Price</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Quantity</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Tax Rate</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Discount</th>
						<th style="width: 130px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Tax Amount</th>
						<th style="width: 120px; text-align: center; padding: 15px 10px; color: #777777; border-bottom: 1px solid #dddddd;">Line Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="padding: 10px; border-bottom: 1px solid #dddddd; text-align: left; font-size: 15px;">[line_number]</td>
						<td style="padding: 10px; border-bottom: 1px solid #dddddd; text-align: left; font-size: 15px;">[product_name][product_img]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[product_price]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[product_qty]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[tax_rate]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[discount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[tax_amount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 15px;">[line_total]</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="rtwcpig-subtotal-wrapper" style="margin-left: 40px; margin-right: 40px;">
			<div style="float: left; width: 58%; margin-right: 2%;">
				<table style="width: 100%; border-collapse: collapse; margin-top: 50px;">
					<tbody>
						<tr>
							<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Payment Method</th>
							<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[payment_method]</td>
							</tr>
						<tr>
							<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Shipping Charges</th>
							<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[shipping_charges]</td>
						</tr>
						<tr>
							<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Amount In Words</th>
							<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[total_amnt_in_words]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="float: right; width: 38%; margin-right: 2%;">
				<table style="width: 100%; border-collapse: collapse; margin-top: 50px;">
					<tbody>
						<tr>
							<th style="color: #777777; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd;">SubTotal</th>
							<td style="text-align: right; color: #444444; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 14px;">[subtotal_amount]</td>
							</tr>
							<tr>
							<th style="color: #777777; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd;">Tax</th>
							<td style="text-align: right; color: #444444; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 14px;">[row_tax_amount]</td>
							</tr>
							<tr>
							<th style="color: #777777; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd;">Total</th>
							<td style="text-align: right; color: #444444; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 14px;">[order_amount]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>';
		
		$rtwwcpig_content_html_2 = '
		<div class="rtwcpig-logo"><img src="" alt="shop logo" width="100px" />
		</div>
		<div class="rtwcpig-invoice-wrapper">
			<div style="float: left; width: 50%; color: #444444;">
				<p style="color: #777777; font-weight: bold; margin: 5px 0;">From</p>
				<p style="margin: 5px 0;">RedefiningTheWeb</p>
				<p style="margin: 5px 0;">100 MAIN ST.</p>
				<p style="margin: 5px 0;">SEATTLE WA,98104, USA</p>
				<p style="margin: 5px 0;">www.redefiningtheweb.com</p>
			</div>
			<div style="float: left; width: 50%; color: #444444;">
				<p style="color: #777777; font-weight: bold; margin: 5px 0;">To</p>
				<p style="margin: 5px 0;">[billing_first_name] [billing_last_name]</p>
				<p style="margin: 5px 0;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
				<p style="margin: 5px 0;">[billing_email]</p>
			</div>
			<div style="float: left; width: 50%; color: #444444; margin-top: 20px;">
				<p style="margin: 5px 0;"><span style="font-weight: bold;">Invoice No:</span> [order_id]</p>
				<p style="margin: 5px 0;"><span style="font-weight: bold;">Invoice Date:</span> [order_date]</p>
			</div>
		</div>
		<div style="margin-top: 40px; color: #444444;">
			<table id="rtwwcpig_prod_table" style="width: 100%; border-collapse: collapse;">
				<thead>
					<tr>
						<th style="width: 100px; padding: 15px 10px; text-align: left; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Line No.</th>
						<th style="width: 200px; padding: 15px 10px; text-align: left; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Product</th>
						<th style="width: 80px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Price</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Quantity</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Tax Rate</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Discount</th>
						<th style="width: 130px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Tax Amount</th>
						<th style="width: 110px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #f8f8f8; color: #444444;">Line Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[line_number]</td>
						<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[product_name][product_img]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_price]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_qty]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[tax_rate]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[discount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[tax_amount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[line_total]</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="rtwcpig-subtotal-wrapper" style="float: right; text-align: right;">
			<div style="width: 60%; float: right;">
				<table style="float: right; width: 100%; border-collapse: collapse; margin-top: 50px;">
					<tbody>
						<tr>
							<th style="color: #444444; background-color: #f8f8f8; padding: 10px; text-align: center; border-top: 2px solid #dddddd; border-bottom: 2px solid #dddddd;" colspan="2">Invoice Summary</th>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>SubTotal</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[subtotal_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Tax</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[row_tax_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Shipping Charges</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[shipping_charges]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Total</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[order_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Amount In Words</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[total_amnt_in_words]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Payment Method</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[payment_method]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>';

		$rtwwcpig_content_html_3 = '
		<div>
			<div style="width: 20%; float: left;"><img src="" alt="text" width="100px" />
			</div>
			<div style="width: 40%; float: left; color: #444444;">
				<p style="font-size: 16px; margin: 5px 0;">(793) 151-6230</p>
				<p style="font-size: 16px; margin: 5px 0;">developer@redefiningtheweb.com</p>
				<p style="font-size: 16px; margin: 5px 0;">redefiningtheweb.com</p>
			</div>
			<div style="width: 38%; float: left; color: #444444;">
				<p style="font-size: 16px; color: #444444;">JOHN SMITH,100 MAIN ST.,SEATTLE WA,98104, USA</p>
			</div>
		</div>
		<div style="margin-top: 30px;">
			<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Billed To</p>
				<p style="padding: 0 10px;">[billing_first_name] [billing_last_name]</p>
				<p style="padding: 0 10px;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
			</div>
			<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Invoice Number</p>
				<p style="padding: 0 10px;">[order_id]</p>
				</div>
				<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Date Of Issue</p>
				<p style="padding: 0 10px;">[order_date]</p>
				</div>
				<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Invoice Total</p>
				<p style="color: #8ac6d1; font-size: 22px; font-weight: bold; padding: 0 10px;">[order_amount]</p>
			</div>
		</div>
		<div style="margin-top: 40px;">
			<table id="rtwwcpig_prod_table" style="width: 100%; border-collapse: collapse;">
				<thead>
					<tr>
						<th style="width: 100px; padding: 15px 10px; color: #ffffff; text-align: left; background-color: #28c3d4;">Line No.</th>
						<th style="width: 200px; padding: 15px 10px; color: #ffffff; text-align: left; background-color: #28c3d4;">Product</th>
						<th style="width: 90px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Price</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Quantity</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Tax Rate</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Discount</th>
						<th style="width: 130px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Tax Amount</th>
						<th style="width: 110px; text-align: center; padding: 15px 10px; color: #ffffff; background-color: #28c3d4;">Line Total</th>
					</tr>
				</thead>
				<tbody>
					<tr class="rtwwcpig_table">
						<td style="padding: 15px 10px; border-bottom: 1px solid #dddddd; text-align: left;">[line_number]</td>
						<td style="padding: 15px 10px; border-bottom: 1px solid #dddddd; text-align: left;">[product_name][product_img]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[product_price]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[product_qty]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[tax_rate]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[discount]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[tax_amount]</td>
						<td style="text-align: center; padding: 15px 10px; border-bottom: 1px solid #dddddd;">[line_total]</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="rtwcpig-subtotal-wrapper" style="float: right; text-align: right;">
			<div style="width: 35%; float: left;">
				<table style="width: 100%; float: right; border-collapse: collapse; margin-top: 50px;">
					<tbody>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">SubTotal</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[subtotal_amount]</td>
						</tr>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Tax</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[row_tax_amount]</td>
						</tr>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Total</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[order_amount]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="float: left; width: 58%; margin-left: 7%;">
				<table style="width: 100%; margin-top: 50px;">
					<tbody>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Payment Method</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[payment_method]</td>
						</tr>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Shipping Charges</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[shipping_charges]</td>
						</tr>
						<tr>
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Amount In Words</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[total_amnt_in_words]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>';

		$rtwwcpig_content_html_4 = '
		<table class="invhead" style="width: 100%; font-size: 14px; border: none;">
			<tbody>
				<tr>
					<td style="width: 40%; border: none;">
						<div class="rtwcpig-logo" style="width: 29%; display: inline-block;"><img class="alignnone" style="margin-bottom: 15px;" src="" alt="shop logo" width="100" height="100" />
						</div>
						<p style="margin: 5px 0; text-align:left;">Invoice No: [order_id]</p>
						<p style="margin: 5px 0; text-align:left;">Invoice Date: [order_date]</p>
					</td>
					<td style="width: 60%; border: none;">
						<div style="width: 69%; display: inline-block;">
							<p style="margin: 5px 5px 5px 0px;"><strong>RedefiningTheWeb</strong></p>
							<p style="margin: 5px 5px 5px 0px;">100 MAIN ST. SEATTLE WA,98104, USA</p>
							<p style="margin: 5px 5px 5px 0px;">www.redefiningtheweb.com</p>
							<p style="margin: 5px 5px 5px 0px;">Phone: 987-654-032</p>
							<p style="margin: 5px 5px 5px 0px;">E-mail: developer@redefiningtheweb.com</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div> </div>
		<div class="rtwcpig-invoice-wrapper"><br />
			<table style="width: 100%; border-collapse: collapse; border: 1px solid #b08c77; font-size: 13px;">
				<thead>
					<tr>
						<th>
							<p style="color: #777777; font-weight: bold; margin: 5px 5px 5px 0px; text-align: left;">Shipping Address</p>
						</th>
						<th style="border-left: 1px solid #b08c77;">
							<p style="color: #777777; font-weight: bold; margin: 5px 5px 5px 0px; text-align: left;">Billing Address</p>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr style="border-bottom: none;">
						<td style="width: 50%; border-bottom: none; text-align:left;">
							<p>[shipping_first_name] [shipping_last_name]</p>
							<p>[shipping_address_1] , [shipping_address_2], [shipping_city], [shipping_state], [shipping_country], [shipping_postcode]</p>
						</td>
						<td style="width: 50%; border-bottom: none; border-left: 1px solid #b08c77; text-align:left;">
							<p style="margin: 5px 0;">[billing_first_name] [billing_last_name]</p>
							<p style="margin: 5px 0;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
							<p style="margin: 5px 0;">[billing_email]</p>
							<p>[billing_phone]</p>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div style="margin-top: 40px; color: #444444;">
			<table id="rtwwcpig_prod_table" style="width: 100%; border-collapse: collapse; font-size: 13px; border: 1px solid #b08c77;">
				<thead>
					<tr>
						<th style="width: 100px; padding: 15px 10px; text-align: left; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Line No.</th>
						<th style="width: 200px; padding: 15px 10px; text-align: left; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Product</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Price</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Quantity</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Tax Rate</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Discount</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Tax Amount</th>
						<th style="width: 100px; text-align: center; padding: 15px 10px; border-bottom: 2px solid #dddddd; border-top: 2px solid #dddddd; background-color: #b08c77; color: #f5fffa;">Line Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[line_number]</td>
						<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[product_name][product_img]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_price]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_qty]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[tax_rate]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[discount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[tax_amount]</td>
						<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[line_total]</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="rtwcpig-subtotal-wrapper" style="float: right; text-align: right;">
			<div style="width: 60%; float: right;">
				<table style="float: right; width: 100%; border-collapse: collapse; margin-top: 50px; font-size: 13px; border: 1px solid #b08c77;">
					<tbody>
						<tr>
							<th style="color: #f5fffa; background-color: #b08c77; padding: 10px; text-align: center; border-top: 2px solid #dddddd; border-bottom: 2px solid #dddddd;" colspan="2">Invoice Summary</th>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>SubTotal</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[subtotal_amount]</td>
							</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Tax</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[row_tax_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Shipping Charges</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[shipping_charges]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Total</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[order_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Payment Method</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[payment_method]</td>
						</tr>
						<tr style="border-bottom: none;">
							<td style="width: 170px; padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;"><strong>Amount In Words</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;">[total_amnt_in_words]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div style="width: 100%; float: left; font-size: 11px;"><hr />
			<p>Terms &amp; Conditions:</p>
			<ol>
				<li>Goods once sold can be exchanged within 7 days of delivery.</li>
				<li>No cash refund.</li>
			</ol>
			<p>Please joins us on Facebook at https://www.facebook.com/RedefiningTheWeb/</p>
		</div>';

		$rtwwcpig_content_html_5 = '
		<div class="container" style="padding: 20px 50px 20px 50px;">
			<header class="header_part">
				<div class="row" style="width: 800px;">
					<div class="lside" style="width: 250px; float: left; font-family: Sans-serif;">
						<div class="list" style="list-style-type: none; color: #14a7d3; font-size: 20px;">
							<p style="margin: 0px;">RedefiningTheWeb</p>
							<p style="padding-top: 1px; margin: 0px;">100 Main ST.</p>
							<p style="padding-top: 1px; margin: 0px;">SEATTLE WA,98104, USA</p>
							<p style="padding-top: 1px; margin: 0px;">redefiningtheweb.com</p>
						</div>
					</div>
					<div class="rside" style="width: 200px; float: right; text-align: right;">
						<div class="link"><img style="max-width: 50%; width: auto; padding: 5px; max-height: 100px;" src="" />
						</div>
					</div>
				</div>
			</header>
			<div class="row" style="margin-top: 20px; margin-bottom: 50px; font-family: Sans-serif;">
				<div style="background: #2897b8; color: white; padding: 20px 30px 20px 30px;">
					<div style="float: left; width: 250px; list-style-type: none;">
						<h3>Invoice To:</h3>
						<p style="margin: 0px;">[billing_first_name] [billing_last_name]</p>
						<p style="padding-top: 1px; margin: 0px;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state]</p>
						<p style="padding-top: 1px; margin: 0px;">[billing_country], [billing_postcode]</p>
						<p style="padding-top: 1px; margin: 0px;">[billing_email]</p>
					</div>
					<div style="float: right; width: 350px; list-style-type: none; text-align: right;">
						<h2>Purchase Invoice : <br />[order_id]</h2>
						<div style="list-style-type: none;">
							<p>Date of Invoice : [order_date]</p>
						</div>
					</div>
				</div>
			</div>
			<table id="rtwwcpig_prod_table" style="font-family: Sans-serif;">
				<thead style="text-transform: uppercase;">
					<tr>
						<th style="text-transform: uppercase; background: grey; color: white; width: 250px; height: 50px; font-size: 15px;">description</th>
						<th style="text-transform: uppercase; background: grey; padding-left: 10px; padding-right: 10px; color: white; width: 110px; height: 50px; font-size: 15px;">qty</th>
						<th style="text-transform: uppercase; background: grey; padding-left: 10px; padding-right: 10px; color: white; width: 110px; height: 50px; font-size: 15px;">tax</th>
						<th style="text-transform: uppercase; background: grey; padding-left: 10px; padding-right: 10px; color: white; width: 110px; height: 50px; font-size: 15px;">price</th>
						<th style="text-transform: uppercase; background: grey; padding-left: 10px; padding-right: 10px; color: white; width: 110px; height: 50px; font-size: 15px;">discount</th>
						<th style="text-transform: uppercase; background: grey; padding-left: 10px; padding-right: 10px; color: white; width: 110px; height: 50px; font-size: 15px;">total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: left;">[product_name] [product_img]</td>
						<td style="text-align: center; background: whitesmoke; height: 40px;">[product_qty]</td>
						<td style="text-align: center; background: whitesmoke; height: 40px;">[tax_rate]</td>
						<td style="text-align: center; background: whitesmoke; height: 40px;">[product_price]</td>
						<td style="text-align: center; background: whitesmoke; height: 40px;">[discount]</td>
						<td style="text-align: center; background: whitesmoke; height: 40px;">[line_total]</td>
					</tr>
				</tbody>
			</table>
			<div>
				<div style="float: right; width: 260px; margin-top: 15px;">
					<table style="font-family: Sans-serif;">
						<tbody>
							<tr>
								<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 40px; font-size: 15px;">Sub Total</td>
								<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 40px; font-size: 15px;">[subtotal_amount]</td>
							</tr>
							<tr>
								<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 40px; font-size: 15px;">Total Tax</td>
								<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 40px; font-size: 15px;">[row_tax_amount]</td>
							</tr>
							<tr>
								<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 40px; font-size: 15px;">Shipping Charge</td>
								<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 40px; font-size: 15px;">[shipping_charges]</td>
							</tr>
							<tr>
								<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 35px; font-size: 15px;">Grand Total</td>
								<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 35px; font-size: 15px;">[order_amount]</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div style="float: left; font-family: Sans-serif; margin-bottom: 30px;"><span style="color: #2897b8;">Thank you! </span>
			</div>
			<div style="color: grey; font-family: Sans-serif;"><strong>Note:</strong>
				<p style="margin: 0;">[customer_note]</p>
			</div>
		</div>';

	    $rtwwcpig_content_html_6 = '
	    <div class="container" style="padding-left:50px; padding-right:50px; padding-top:20px; padding-bottom:20px;"> 
    		<header class="header_part">
        		<div class="row">
        			<div class="rside" style="width:300px;float:left;">
				        <div class="link">
				            <img style="max-width: 50%; width: auto; padding: 5px; max-height: 150px;" src="">
				        </div>
    				</div>
        			<div style="width:300px; font-family:Sans-serif; float:right;">
            			<h1 style="text-align:right; letter-spacing:2px; margin-right:10px;">Sale Invoice
            			</h1>
          				<div style="float:left;  margin-left:90px; list-style-type:none; width:100px; color:#14a7d3;">
                     		<p style="padding-top:3px; margin: 0px;">Invoice No.: </p> 
                     		<p style="padding-top:3px; margin: 0px;"> Billing date :</p>
                     		<p style="padding-top:3px; margin: 0px;">Billing time :</p>
          				</div>
           				<div style="float:right; width:100px;  list-style-type:none;  text-align:left;">
			                <p style="padding-top:3px;margin: 0px;">[order_id]</p>
			                <p style="padding-top:3px;margin: 0px;">[order_date]</p>
            				<p style="padding-top:3px;margin-left:12px; margin: 0px;">[order_time]</p>
          				</div>
    				</div>
    			</div>
    		</header>
    		<div style="font-family:Sans-serif; margin-top:10px;">
            	<div style = "list-style-type:none; float:left; width:320px; font-family:Sans-serif;">
                 	<h2 style="margin-bottom:0; color:#14a7d3;">Billing from</h2>
                 	<hr style="color:#14a7d3;">
                 	<h3>Seller Name</h3>
                 	<p style="margin: 0px;">RedefiningTheWeb</p>
                 	<p style="padding-top:3px; margin: 0px;">100 Main ST.</p>
                 	<p style="padding-top:3px; margin: 0px;">SEATTLE WA,98104, USA</p>
                 	<p style="padding-top:3px; margin: 0px;">redefiningtheweb.com</p>
             	</div>
            	<div style="float:right; width:320px; list-style-type:none; ">
            		<h2 style="margin-bottom:0; color:#14a7d3;">Billing to</h2>
            		<hr style="color:#14a7d3;">
		            <h3>[billing_first_name] [billing_last_name]</h3>
		            <p style="margin: 0px;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state]</p>
		            <p style="padding-top:3px; margin: 0px;">[billing_country], [billing_postcode]</p>
		            <p style="padding-top:3px; margin: 0px;">[billing_email]</p>
            	</div>
    		</div>
    		<div class="product-table" style="padding-top:20px;">
    			<table id="rtwwcpig_prod_table" style="font-family:Sans-serif;">
    				<thead>
					    <tr>
						    <th style="text-align:left;"><h3>Product</h3></th>
						    <th style="padding-left:10px; padding-right:10px; width:100px;"><h3>Qty</h3></th>
						    <th style="padding-left:10px; padding-right:10px; width:100px; border-collapse:collapse;"><h3>Tax</h3></th>
						    <th style="padding-left:10px; padding-right:10px; width:100px;"><h3>Price</h3></th>
						    <th style="padding-left:10px; padding-right:10px; width:100px;"><h3>Discount</h3></th>
						    <th style="padding-left:10px; padding-right:10px; width:100px;"><h3>Total</h3></th>
					    </tr>
					    <tr>
			                <th colspan="6" style="padding: 1px 35px; background-color: #14a7d3;"></th>
			            </tr>
   					</thead>
    				<tbody>
					    <tr>
						    <td style="text-align:left; padding-top:10px; padding-bottom:10px; background:whitesmoke;"><h4>[product_name] [product_img]</h4></td>
						    <td style="text-align:center; background:whitesmoke;">[product_qty]</td>
						    <td style="text-align:center; background:whitesmoke;">[tax_rate]</td>
						    <td style="text-align:center; background:whitesmoke;">[product_price]</td>
						    <td style="text-align:center; background:whitesmoke;">[discount]</td>
						    <td style="text-align:center; background:whitesmoke;">[line_total]</td>
					    </tr>
    				</tbody>
    			</table>
    			<div>
    				<div style="float:right; width:193px;">
      					<table style="font-family:Sans-serif;  width:200px; text-align:left;">
       						<tbody>
						         <tr>
						         	<td style="padding-top:10px; padding-bottom:10px; background:whitesmoke;">Sub Total</td>
						         	<td style="background:whitesmoke;">[subtotal_amount]</td>
						         </tr>
							     <tr>
							        <td style="padding-top:10px; padding-bottom:10px; background:whitesmoke;">Total Tax</td>
							        <td style="background:whitesmoke;">[row_tax_amount]</td>
							     </tr>
							     <tr>
							        <td style="padding-top:10px; padding-bottom:10px; background:whitesmoke;">Shipping Charges</td>
							        <td style="background:whitesmoke;">[shipping_charges]</td>
							     </tr>
  							</tbody>
 						</table>
  					</div>
  				</div>
    			<div>
    				<div style="float:right; color:#ffffff; width:180px; padding-bottom:10px; font-family:Sans-serif; padding-top:10px; padding-left:5px; padding-right:5px; background:#14a7d3;">
     					<div style="float:left; width:90px;">Grand Total</div>
     					<div style="float:right; width:90px;">[order_amount]</div>
  					</div>
  				</div>
			</div>
			<div style="font-family:Sans-serif;">
				<h3 style="margin-bottom:0;">important notice</h3>
				<hr style="color:#14a7d3;">
				<p>Terms &amp; Conditions:</p>
				<ol>
					<li>Goods once sold can be exchanged within 7 days of delivery.</li>
					<li>No cash refund.</li>
				</ol>
				<p> No item will be replaced or refunded if you dont have the invoice with you. You can refund within 2 days of purchase.</p>
				<p>Please joins us on Facebook at https://www.facebook.com/RedefiningTheWeb/</p>
			</div>
		</div>';

		?>
		<table class="wp-list-table form-table rtw-table">
			<tbody>
				<tr>
					<th><h3><?php esc_html_e('Macros','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<h2><?php esc_html_e('Use following macros for PDF invoice','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h2>
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
									<li><strong>[customer_id]</strong></li>
									<li><strong>[order_status]</strong></li>
								</ul>
							</div>
							<div class="rtwwcpig_macros_2">
								<ul>
									<li><strong>[line_number]</strong></li>
									<li><strong>[row_tax_amount]</strong></li>
									<li><strong>[subtotal_amount]</strong></li>
									<li><strong>[tax_rate]</strong></li>
									<li><strong>[tax_amount]</strong></li>
									<li><strong>[customer_note]</strong></li>
									<li><strong>[product_img]</strong></li>
									<li><strong>[payment_method]</strong></li>
									<li><strong>[product_category]</strong></li>
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
								</ul>
							</div>
							<?php 
							$shortcode_array = array();
							$shortcode_array = apply_filters('rtwwcpig_shortcode_array', $shortcode_array);
							
							if( isset($shortcode_array) && is_array($shortcode_array) && !empty($shortcode_array) )
							{
								?>
								<div class="rtwwcpig_macros_5">
									<ul>
										<?php 
										foreach ($shortcode_array as $short_code => $code) {
											echo '<li><strong>['.$code.']</strong></li>';
										}
										?>
									</ul>
								</div>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th><h3><?php esc_html_e('Invoice Templates', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?>
					</th>
					<td>
						<select class="rtwwcpig_template_select" name="rtwwcpig_invoice_format_setting_opt[invoice_template]">
							<option value="1" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '1' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 1', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="2" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '2' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 2', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="3" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '3' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 3', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="4" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '4' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 4', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="5" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '5' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 5', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="6" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '6' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 6', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
						</select>
						<div class="descr"><?php esc_html_e('Select any one of these template for your PDF invoice layout.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>	
					</td>
				</tr>
				<tr class="rtwwcpig_template_1 <?php if( $rtwwcpig_template_selected != '1' ){ echo 'rtwwcpig_hide_template'; } ?>" >
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_1'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_1'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_1;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_1]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_1' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_template_2 <?php if( $rtwwcpig_template_selected != '2' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_2'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_2'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_2;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_2]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_2' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_template_3 <?php if( $rtwwcpig_template_selected != '3' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_3'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_3'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_3;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_3]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_3' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_template_4 <?php if( $rtwwcpig_template_selected != '4' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_4'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_4'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_4;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_4]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_4' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_template_5 <?php if( $rtwwcpig_template_selected != '5' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_5'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_5'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_5;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_5]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_5' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_template_6 <?php if( $rtwwcpig_template_selected != '6' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('PDF Invoice Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p class="rtwwcpig_cmnt"><?php esc_html_e('Please do not remove id=rtwwcpig_prod_table.If you add your custom format then must add this id in your table.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
						<?php
						if ( !empty($rtwwcpig_get_setting['invoice_format_6'])) 
						{
							$rtwwcpig_cntnt = $rtwwcpig_get_setting['invoice_format_6'] ;
						}
						else
						{
							$rtwwcpig_cntnt = $rtwwcpig_content_html_6;
						}
						$rtwwcpig_cntnt = html_entity_decode( $rtwwcpig_cntnt );
						$rtwwcpig_cntnt = stripslashes( $rtwwcpig_cntnt );
						$rtwwcpig_setting = array(
							'wpautop' => false,
							'media_buttons' => true,
							'textarea_name' => 'rtwwcpig_invoice_format_setting_opt[invoice_format_6]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_6' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
			</tbody>
		</table>

<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}
