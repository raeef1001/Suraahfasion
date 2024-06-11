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
		woocommerce_update_options( rtwwcpig_credit_note_format_settings() );
		update_option( 'rtwwcpig_credit_note_format_setting_opt', $_POST['rtwwcpig_credit_note_format_setting_opt']);
	}
		settings_fields('rtwwcpig_credit_note_format_setting');
		$rtwwcpig_get_setting 			= get_option('rtwwcpig_credit_note_format_setting_opt');
		$rtwwcpig_credit_note_template_selected 	= isset( $rtwwcpig_get_setting[ 'invoice_template' ] ) ? $rtwwcpig_get_setting[ 'invoice_template' ] : '1';

		$rtwwcpig_content_html_2 = '
		<div class="rtwcpig-logo">
		</div>
		<div class="rtwcpig-invoice-wrapper">
			<div style="float: left; width: 50%; color: #444444;">
				<p style="color: #777777; font-weight: bold; margin: 5px 0;">Credit From</p>
				<p style="margin: 5px 0;">RedefiningTheWeb</p>
				<p style="margin: 5px 0;">100 MAIN ST.</p>
				<p style="margin: 5px 0;">SEATTLE WA,98104, USA</p>
				<p style="margin: 5px 0;">www.redefiningtheweb.com</p>
			</div>
			<div style="float: left; width: 50%; color: #444444;">
				<p style="color: #777777; font-weight: bold; margin: 5px 0;">Credit To</p>
				<p style="margin: 5px 0;">[billing_first_name] [billing_last_name]</p>
				<p style="margin: 5px 0;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
				<p style="margin: 5px 0;">[billing_email]</p>
			</div>
			<div style="float: left; width: 50%; color: #444444; margin-top: 20px;">
				<p style="margin: 5px 0;"><span style="font-weight: bold;">Credit Note No:</span> [order_id]</p>
				<p style="margin: 5px 0;"><span style="font-weight: bold;">Credit Date:</span> [order_date]</p>
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
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Total Refunded Amount</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[order_amount]</td>
						</tr>
						<tr>
							<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Amount In Words</strong></td>
							<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[total_amnt_in_words]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>';

		$rtwwcpig_content_html_3 = '
		<div>
			<div style="width: 20%; float: left;"><img alt="text" width="100px" /></div>
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
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Credit To</p>
				<p style="padding: 0 10px;">[billing_first_name] [billing_last_name]</p>
				<p style="padding: 0 10px;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state], [billing_country], [billing_postcode]</p>
			</div>
			<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Credit Note Number</p>
				<p style="padding: 0 10px;">[order_id]</p>
			</div>
			<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Date Of Issue</p>
				<p style="padding: 0 10px;">[order_date]</p>
			</div>
			<div style="float: left; width: 25%;">
				<p style="color: #ffffff; font-weight: bold; background-color: #28c3d4; padding: 5 10px;">Refunded Amount</p>
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
			<div style="width: 35%; float: right;">
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
							<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Total Amount</th>
							<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[order_amount]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>';

	    $rtwwcpig_content_html_6 = '
	    <div class="container" style="padding: 20px 50px 20px 50px;"><header class="header_part">
	    	<header class="header_part">
				<div class="row">
					<div class="rside" style="width: 300px; float: left;">
						<div class="link"><img style="max-width: 50%; width: auto; padding: 5px; max-height: 150px;" src="">
						</div>
					</div>
					<div style="width: 300px; font-family: Sans-serif; float: right;">
						<h1 style="text-align: right; letter-spacing: 2px; margin-right: 10px;">Credit Note</h1>
						<div style="float: left; margin-left: 70px; list-style-type: none; width: 100px; color: #14a7d3;">
							<p style="padding-top: 3px; margin: 0px;">Credit Note No.:</p>
							<p style="padding-top: 3px; margin: 0px;">Credit date :</p>
							<p style="padding-top: 3px; margin: 0px;">Credit time :</p>
						</div>
						<div style="float: right; width: 100px; list-style-type: none; text-align: left;">
							<p style="padding-top: 3px; margin: 0px;">[order_id]</p>
							<p style="padding-top: 3px; margin: 0px;">[order_date]</p>
							<p style="padding-top: 3px; margin-left: 12px; margin: 0px;">[order_time]</p>
						</div>
					</div>
				</div>
			</header>
			<div style="font-family: Sans-serif; margin-top: 10px;">
				<div style="list-style-type: none; float: left; width: 320px; font-family: Sans-serif;">
					<h2 style="margin-bottom: 0; color: #14a7d3;">Credit From</h2>
					<hr style="color: #14a7d3;" />
					<h3>Seller Name</h3>
					<p style="margin: 0px;">RedefiningTheWeb</p>
					<p style="padding-top: 3px; margin: 0px;">100 Main ST.</p>
					<p style="padding-top: 3px; margin: 0px;">SEATTLE WA,98104, USA</p>
					<p style="padding-top: 3px; margin: 0px;">redefiningtheweb.com</p>
				</div>
				<div style="float: right; width: 320px; list-style-type: none;">
					<h2 style="margin-bottom: 0; color: #14a7d3;">Credit To</h2>
					<hr style="color: #14a7d3;" />
					<h3>[billing_first_name] [billing_last_name]</h3>
					<p style="margin: 0px;">[billing_address_1] , [billing_address_2], [billing_city], [billing_state]</p>
					<p style="padding-top: 3px; margin: 0px;">[billing_country], [billing_postcode]</p>
					<p style="padding-top: 3px; margin: 0px;">[billing_email]</p>
				</div>
			</div>
			<div class="product-table" style="padding-top: 20px;">
				<table id="rtwwcpig_prod_table" style="font-family: Sans-serif;">
					<thead>
						<tr>
							<th style="text-align: left;">
								<h3>Product</h3>
							</th>
							<th style="padding-left: 10px; padding-right: 10px; width: 100px;">
								<h3>Qty</h3>
							</th>
							<th style="padding-left: 10px; padding-right: 10px; width: 100px; border-collapse: collapse;">
								<h3>Tax</h3>
							</th>
							<th style="padding-left: 10px; padding-right: 10px; width: 100px;">
								<h3>Price</h3>
							</th>
							<th style="padding-left: 10px; padding-right: 10px; width: 100px;">
								<h3>Discount</h3>
							</th>
							<th style="padding-left: 10px; padding-right: 10px; width: 100px;">
								<h3>Total</h3>
							</th>
						</tr>
						<tr>
							<th style="padding: 1px 35px; background-color: #14a7d3;" colspan="6"> </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: left; padding-top: 10px; padding-bottom: 10px; background: whitesmoke;">
								<h4>[product_name] [product_img]</h4>
							</td>
							<td style="text-align: center; background: whitesmoke;">[product_qty]</td>
							<td style="text-align: center; background: whitesmoke;">[tax_rate]</td>
							<td style="text-align: center; background: whitesmoke;">[product_price]</td>
							<td style="text-align: center; background: whitesmoke;">[discount]</td>
							<td style="text-align: center; background: whitesmoke;">[line_total]</td>
						</tr>
					</tbody>
				</table>
				<div>
					<div style="float: right; width: 193px;">
						<table style="font-family: Sans-serif; width: 200px; text-align: left;">
							<tbody>
								<tr>
									<td style="padding-top: 10px; padding-bottom: 10px; background: whitesmoke;">Sub Total</td>
									<td style="background: whitesmoke;">[subtotal_amount]</td>
								</tr>
								<tr>
									<td style="padding-top: 10px; padding-bottom: 10px; background: whitesmoke;">Total Tax</td>
									<td style="background: whitesmoke;">[row_tax_amount]</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			<div>
			<div style="float: right; color: #ffffff; width: 180px; font-family: Sans-serif; background: #14a7d3; padding: 10px 5px 10px 5px;">
				<div style="float: left; width: 90px;">Total Refunded Amount</div>
					<div style="float: right; width: 90px;">[order_amount]</div>
				</div>
			</div>
		</div>
		<div style="font-family: Sans-serif;">
			<h3 style="margin-bottom: 0;">important notice</h3>
			<hr style="color: #14a7d3;" />
			<p>Terms &amp; Conditions:</p>
			<ol>
				<li>Goods once sold can be exchanged within 7 days of delivery.</li>
				<li>No cash refund.</li>
			</ol>
			<p>No item will be replaced or refunded if you dont have the invoice with you. You can refund within 2 days of purchase.</p>
			<p>Please joins us on Facebook at https://www.facebook.com/RedefiningTheWeb/</p>
		</div>
	</div>';

		?>
		<table class="wp-list-table form-table rtw-table">
			<tbody>
				<tr>
					<th><h3><?php esc_html_e('Macros','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
					<td>
						<p><?php esc_html_e('Use following macros for Credit Note','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></p>
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
								</ul>
							</div>
							<div class="rtwwcpig_macros_2">
								<ul>
									<li><strong>[line_number]</strong></li>
									<li><strong>[row_tax_amount]</strong></li>
									<li><strong>[subtotal_amount]</strong></li>
									<li><strong>[tax_rate]</strong></li>
									<li><strong>[tax_amount]</strong></li>
									<li><strong>[row_tax_amount]</strong></li>
									<li><strong>[customer_note]</strong></li>
									<li><strong>[product_img]</strong></li>
									<li><strong>[payment_method]</strong></li>
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
					<th><h3><?php esc_html_e('Credit Note Templates', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?>
					</th>
					<td>
						<select class="rtwwcpig_credit_note_template_select" name="rtwwcpig_credit_note_format_setting_opt[invoice_template]">
							<option value="2" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '2' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 1', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="3" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '3' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 2', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
							<option value="6" <?php echo isset( $rtwwcpig_get_setting['invoice_template'] ) && $rtwwcpig_get_setting['invoice_template'] == '6' ? esc_html('selected="selected"') : '';?>><?php esc_html_e('Template 3', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></option>
						</select>
						<div class="descr"><?php esc_html_e('Select any one of these template for your Credit Note layout.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>	
					</td>
				</tr>
				<tr class="rtwwcpig_credit_note_template_2 <?php if( $rtwwcpig_credit_note_template_selected != '2' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('Credit Note Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
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
							'textarea_name' => 'rtwwcpig_credit_note_format_setting_opt[invoice_format_2]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_2' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_credit_note_template_3 <?php if( $rtwwcpig_credit_note_template_selected != '3' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('Credit Note Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
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
							'textarea_name' => 'rtwwcpig_credit_note_format_setting_opt[invoice_format_3]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_3' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
				<tr class="rtwwcpig_credit_note_template_6 <?php if( $rtwwcpig_credit_note_template_selected != '6' ){ echo 'rtwwcpig_hide_template'; } ?>">
					<th><h3><?php esc_html_e('Credit Note Layout', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></h3></th>
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
							'textarea_name' => 'rtwwcpig_credit_note_format_setting_opt[invoice_format_6]',
							'textarea_rows' => 40,
							'textarea_cols' => 30,
						);
						wp_editor($rtwwcpig_cntnt, 'rtwwcpig_pdf_invoice_html_6' , $rtwwcpig_setting );
						?>
					</td>
				</tr>
			</tbody>
		</table>
	
	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_credit_note_format_settings()); ?> 
	</div>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
 * function for display woocommerce settings.
 *
 * @since    1.0.0
 */
function rtwwcpig_credit_note_format_settings()
{
	$settings =	array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'rtwwcpig_credit_note_setting'
		),
		// array(
		// 	'name' 		=> esc_html__( 'Table Border', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		// 	'type' 		=> 'checkbox',
		// 	'desc' 		=> esc_html__( 'Check it if you want to apply border on the table of Credit Note', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		// 	'desc_tip'  =>  true,
		// 	'id'   		=> 'rtwwcpig_table_border'
		// ),
		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'rtwwcpig_credit_note_setting'
		)
	);
	return $settings;
}