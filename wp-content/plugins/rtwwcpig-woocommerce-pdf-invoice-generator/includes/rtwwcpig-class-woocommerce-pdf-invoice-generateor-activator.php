<?php
/**
 * Fired during plugin activation
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 */
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Activator {
/**
 * Short Description. (use period)
 *
 * Long Description.
 *
 * @since    1.0.0
 */
public static function rtwwcpig_activate() 
{
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
	$default_formt = get_option( 'rtwwcpig_default_formatt_and_tmplate' );
	if ( empty($default_formt) && !isset($default_formt['invoice_format']) ) 
	{
	$rtwwcpig_format = '
	<table class="invhead" style="width: 100%; font-size: 14px; border: none;">
		<tbody>
			<tr>
				<td style="width: 40%; border: none;">
					<div class="rtwcpig-logo" style="width: 29%; display: inline-block;"><img class="alignnone" style="margin-bottom: 15px;" alt="shop logo" width="100" height="100" />
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
					<td style="width: 50%; border-bottom: none;">
						<p>[shipping_first_name] [shipping_last_name]</p>
						<p>[shipping_address_1] , [shipping_address_2], [shipping_city], [shipping_state], [shipping_country], [shipping_postcode]</p>
					</td>
					<td style="width: 50%; border-bottom: none; border-left: 1px solid #b08c77;">
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
			$rtwwcpig_array = array( 
						'invoice_format' => $rtwwcpig_format,
						'invoice_template' => 1
					);
			update_option( 'rtwwcpig_default_formatt_and_tmplate', $rtwwcpig_array);
	}

	$default_shpng_frmt = get_option( 'rtwwcpig_shipping_format' );
	if ( $default_shpng_frmt == '') 
	{
		$rtwwcpig_shipping_label_format = '
			<div style="max-width: 1170px; margin: 0 auto; padding: 30px 0; box-sizing: border-box;">
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

			update_option( 'rtwwcpig_shipping_format', $rtwwcpig_shipping_label_format);
	}
		if ( get_option( 'rtwwcpig_proforma_invoice' ) == '' ) {
			update_option( 'rtwwcpig_proforma_invoice', 'yes');
		}
		if ( get_option( 'rtwwcpig_when_gnrate_invoice' ) == '' ) {
			update_option( 'rtwwcpig_when_gnrate_invoice', 'processing');
		}
		if ( get_option( 'rtwwcpig_admin_delete_normal_invoice' ) == '' ) {
			update_option( 'rtwwcpig_admin_delete_normal_invoice', 'yes');
		}
		if ( get_option( 'rtwwcpig_allow_proforma_dwnlod_frm_my_accnt' ) == '' ) {
			update_option( 'rtwwcpig_allow_proforma_dwnlod_frm_my_accnt', 'yes');
		}
		if ( get_option( 'rtwwcpig_dwnld_prfrma_order_detail' ) == '' ) {
			update_option( 'rtwwcpig_dwnld_prfrma_order_detail', 'yes');
		}
		if ( get_option( 'rtwwcpig_allow_proforma_dwnlod' ) == '' ) {
			update_option( 'rtwwcpig_allow_proforma_dwnlod', 'yes');
		}
		if ( get_option( 'rtwwcpig_admin_delete_proforma_invoice' ) == '' ) {
			update_option( 'rtwwcpig_admin_delete_proforma_invoice', 'yes');
		}
		if ( get_option( 'rtwwcpig_allow_dwnlod_frm_my_acnt' ) == '' ) {
			update_option( 'rtwwcpig_allow_dwnlod_frm_my_acnt', 'yes');
		}
		if ( get_option( 'rtwwcpig_dsply_dwnlod_on_ordr_page' ) == '' ) {
			update_option( 'rtwwcpig_dsply_dwnlod_on_ordr_page', 'yes');
		}
		if ( get_option( 'rtwwcpig_dsply_dwnlod_on_ordr_detail_page' ) == '' ) {
			update_option( 'rtwwcpig_dsply_dwnlod_on_ordr_detail_page', 'yes');
		}
		if ( get_option( 'rtwwcpig_dwnld_edit_ordr_page' ) == '' ) {
			update_option( 'rtwwcpig_dwnld_edit_ordr_page', 'yes');
		}
		if ( get_option( 'rtwwcpig_regular_invoice' ) == '' ) {
			update_option( 'rtwwcpig_regular_invoice', 'yes');
		}
		if ( get_option( 'rtwwcpig_dsply_crrncy_smbl' ) == '' ) {
			update_option( 'rtwwcpig_dsply_crrncy_smbl', 'yes');
		}	
		
	}
}
