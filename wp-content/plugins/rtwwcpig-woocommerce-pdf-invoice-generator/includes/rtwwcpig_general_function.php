<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
} 

/**
 * checking woocommerce sequential order number plugin is activated or not.
 *
 * @since    1.3.0
 */
function rtwwcpig_woo_seq_order_no_compatibility(){
  
  	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'woocommerce-sequential-order-numbers/woocommerce-sequential-order-numbers.php' ) || is_plugin_active( 'woocommerce-sequential-order-numbers-pro/woocommerce-sequential-order-numbers-pro.php' ) )
	{
    	return true;
  	}else{
    	return false;
  	}
}
/**
 * checking woocommerce product bundel plugin is activated or not.
 *
 * @since    2.0.0
 */
function rtwwcpig_woo_product_bundled_compatibility(){
  
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'woocommerce-product-bundles/woocommerce-product-bundles.php' ) )
    {
    	return true;
  	}else{
    	return false;
  	}
}

/**
 * function for regenerate pdf invoice when order status is changed.
 *
 * @since    1.0.0
 */
function rtwwcpig_make_invoice($rtwwcpig_odr_id, $rtwwcpig_odr_objct)
{
	$rtwwcpig_stng = array();
	$rtwwcpig_basic_stng = get_option('rtwwcpig_basic_setting_opt');
	if( !$rtwwcpig_basic_stng )
	{
		$rtwwcpig_basic_stng = array();
	}
	$rtwwcpig_css_stng = get_option('rtwwcpig_css_setting_opt');
	if( !$rtwwcpig_css_stng )
	{
		$rtwwcpig_css_stng = array();
	}
	$rtwwcpig_header_stng = get_option('rtwwcpig_header_setting_opt');
	if( !$rtwwcpig_header_stng )
	{
		$rtwwcpig_header_stng = array();
	}
	$rtwwcpig_footer_stng = get_option('rtwwcpig_footer_setting_opt');
	if( !$rtwwcpig_footer_stng )
	{
		$rtwwcpig_footer_stng = array();
	}
	$rtwwcpig_watermark_stng = get_option('rtwwcpig_watermark_setting_opt');
	if( !$rtwwcpig_watermark_stng )
	{
		$rtwwcpig_watermark_stng = array();
	}
	$rtwwcpig_invoice_format_stng = get_option('rtwwcpig_invoice_format_setting_opt');
	if( !$rtwwcpig_invoice_format_stng )
	{
		$rtwwcpig_invoice_format_stng = array();
	}
	$rtwwcpig_stng = array_merge($rtwwcpig_basic_stng,$rtwwcpig_css_stng,$rtwwcpig_header_stng,$rtwwcpig_footer_stng,$rtwwcpig_watermark_stng);

	if(rtwwcpig_woo_seq_order_no_compatibility())
	{
		$rtwwcpig_odr_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_odr_id , $rtwwcpig_odr_objct);
	}

	$currency_code = $rtwwcpig_odr_objct->get_currency();
	$rtwwcpig_currency_symbol = get_woocommerce_currency_symbol( $currency_code );
	$status = get_option( 'rtwwcpig_when_gnrate_invoice' , array() );
	if ( empty($status) ) {
		$status = 'processing';
	}
	$tax_name = array();

	if( $rtwwcpig_odr_objct->get_status() == $status || $rtwwcpig_odr_objct->get_status() == 'completed' || $rtwwcpig_odr_objct->get_status() == 'all-status')
	{
		if ( get_option( 'rtwwcpig_dsply_crrncy_smbl' ) == 'yes' ) {
			define('CURRENCY', $rtwwcpig_odr_objct->get_currency());
			$currency_code = $rtwwcpig_odr_objct->get_currency();
			$rtwwcpig_currency_symbol = get_woocommerce_currency_symbol( $currency_code );
		}else{
			$rtwwcpig_currency_symbol = '';
		}
		$rtwwcpig_order = wc_get_order( $rtwwcpig_odr_id );
		if ( !$rtwwcpig_order ) {
			$rtwwcpig_order = $rtwwcpig_odr_objct;
		}
		$rtwwcpig_order_data   = $rtwwcpig_order->get_data();
		$rtwwcpig_user_email   = $rtwwcpig_order->get_billing_email();
		$rtwwcpig_shpng_total  = $rtwwcpig_order->get_shipping_total();
		if ( $rtwwcpig_shpng_total == '' ) {
			$rtwwcpig_shpng_total = 0.00;
		}
		$rtwwcpig_shipping_tax = $rtwwcpig_order->get_shipping_tax();
		if ( $rtwwcpig_shipping_tax == '' ) {
			$rtwwcpig_shipping_tax = 0.00;
		}
		$rtwwcpig_shpng_amnt   = ( $rtwwcpig_shpng_total + $rtwwcpig_shipping_tax );
		$rtwwcpig_total_discount = $rtwwcpig_order->get_discount_total();

    	foreach( $rtwwcpig_order->get_items('fee') as $item_id => $item_fee )
    	{
		    $fee_total[] = $item_fee->get_total();
		}
		$rtwwcpig_product_qty = array();
		$prod_count = 1;
		foreach( $rtwwcpig_order->get_items() as $rtwwcpig_item_key => $rtwwcpig_item_values )
		{
			$prod_sku = new WC_Product($rtwwcpig_item_values->get_product_id());
			if ( rtwwcpig_woo_product_bundled_compatibility() ) 
			{
				if ( $prod_sku->get_sku() ) 
				{
					$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
					if ( !array_key_exists($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) ) {
						$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
					}else{
						$rtwwcpig_product_qty[' '.$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
					}
					$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
					$rtwwcpig_prodct_price[] = ( $rtwwcpig_item_values->get_total()/$rtwwcpig_item_values->get_quantity() );
					$rtwwcpig_subtotal_amnt[] = $rtwwcpig_item_values->get_subtotal();
					$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
					$rtwwcpig_tax_class = $rtwwcpig_item_values->get_tax_class(); // Tax class
					if ( $rtwwcpig_tax_class !== '' ) {
						$tax_obj = WC_Tax::get_rates_for_tax_class( $rtwwcpig_tax_class );
						foreach($tax_obj as $k => $val){
							$rtwwcpig_standrd_rate = WC_Tax::get_rate_percent( $k );
							$rtwwcpig_standrd_label = WC_Tax::get_rate_label( $k );
						}				
						$tax_name[] = $rtwwcpig_standrd_label.' ('.$rtwwcpig_standrd_rate.' )';
					}else{
						$rtwwcpig_prod_data = $rtwwcpig_item_values->get_product();
						if( $rtwwcpig_prod_data->tax_status == 'taxable' ){
							$rtwwcpig_standrd_rate = WC_Tax::get_rate_percent( 1 );
							$rtwwcpig_standrd_label = WC_Tax::get_rate_label( 1 );
							$tax_name[] = $rtwwcpig_standrd_label.' ('.$rtwwcpig_standrd_rate.' )';
						}else{
							$tax_name[] = "0.00 %";
						}
					}
		    		$rtwwcpig_subtotal_tax[] = $rtwwcpig_item_values->get_subtotal_tax(); 
		    		$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax();
		    		$rtwwcpig_taxes_array = $rtwwcpig_item_values->get_taxes();
		    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();
		    		if ($rtwwcpig_prduct_vrtion_id){
		    			$rtwwcpig_prduct = new WC_Product_Variation($rtwwcpig_item_values->get_variation_id());
		    		}else{
		    			$rtwwcpig_prduct = new WC_Product($rtwwcpig_item_values->get_product_id());
		    		}
		    		$rtwwcpig_sku[] = $rtwwcpig_prduct->get_sku();
				}
			}
			else
			{
				$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
				if ( !array_key_exists($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) )
				{
					$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
				}else{
					$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name().' - '.$prod_count] = $rtwwcpig_item_values->get_quantity();
				}
				if(get_option('rtwwcpig_dsply_total_with_tax') == 'yes'){
					$rtwwcpig_total_amnt[] = ((float)$rtwwcpig_item_values->get_total()+(float)$rtwwcpig_item_values->get_total_tax());
				}else{
					$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
				}
				$rtwwcpig_prodct_price[] = ( $rtwwcpig_item_values->get_total()/$rtwwcpig_item_values->get_quantity() );
				$rtwwcpig_subtotal_amnt[] = $rtwwcpig_item_values->get_subtotal();
				$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
				$rtwwcpig_tax_class = $rtwwcpig_item_values->get_tax_class(); // Tax class
				if ( $rtwwcpig_tax_class !== '' ) {
					$tax_obj = WC_Tax::get_rates_for_tax_class( $rtwwcpig_tax_class );
					foreach($tax_obj as $k => $val){
						$rtwwcpig_standrd_rate = WC_Tax::get_rate_percent( $k );
						$rtwwcpig_standrd_label = WC_Tax::get_rate_label( $k );
					}				
					$tax_name[] = $rtwwcpig_standrd_label.' ('.$rtwwcpig_standrd_rate.' )';
				}else{
					$rtwwcpig_prod_data = $rtwwcpig_item_values->get_product();
					$product_data = $rtwwcpig_prod_data->get_data();
					if( $product_data['tax_status'] == 'taxable' ){
						// Get an instance of the WC_Tax object
						$tax_rates = WC_Tax::find_rates(array( 'country'   => $rtwwcpig_odr_objct->get_billing_country() ));
						if( $tax_rates ){
							$tax_rates = array_shift($tax_rates);
							$rtwwcpig_standrd_rate = WC_Tax::get_rate_percent( 1 );
							$rtwwcpig_standrd_label = WC_Tax::get_rate_label( 1 );
							$tax_name[] = $tax_rates['label'].' ( '.$tax_rates['rate'].' % )';
						}
					}else{
						$tax_name[] = "0.00 %";
					}
				}
	    		$rtwwcpig_subtotal_tax[] = $rtwwcpig_item_values->get_subtotal_tax(); 
	    		$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax();
	    		$rtwwcpig_taxes_array = $rtwwcpig_item_values->get_taxes();
	    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();
	    		if ($rtwwcpig_prduct_vrtion_id){
	    			$rtwwcpig_prduct = new WC_Product_Variation($rtwwcpig_item_values->get_variation_id());
	    		}else{
	    			$rtwwcpig_prduct = new WC_Product($rtwwcpig_item_values->get_product_id());
	    		}
	    		$rtwwcpig_sku[] = $rtwwcpig_prduct->get_sku();
			}
		}
    	if (!empty($fee_total)) {
			$totalfee = 0;
			foreach ($fee_total as $k => $v) {
				$totalfee = $totalfee + $v;
			}
			$rtwwcpig_data['processing_fees'] = $rtwwcpig_currency_symbol.' '.wc_format_decimal($totalfee,2);
		}else{
			$rtwwcpig_data['processing_fees'] = $rtwwcpig_currency_symbol.' 0.00';
		}
		$rtwwcpig_data['store_address_1'] = get_option( 'woocommerce_store_address' );
		$rtwwcpig_data['store_address_2'] = get_option( 'woocommerce_store_address_2' );
		$rtwwcpig_data['store_city'] = get_option( 'woocommerce_store_city' );
		$rtwwcpig_data['store_postcode'] = get_option( 'woocommerce_store_postcode' );
		$rtwwcpig_data['store_country'] = WC()->countries->get_base_country();
		$rtwwcpig_data['shipping_method'] =	$rtwwcpig_odr_objct->get_shipping_method();
		$rtwwcpig_data['shipping_first_name'] =	$rtwwcpig_odr_objct->get_shipping_first_name();
		if( $rtwwcpig_data['shipping_first_name'] == '' )
		{
			$rtwwcpig_data['shipping_first_name'] = $rtwwcpig_odr_objct->get_billing_first_name();
		}
		$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_odr_objct->get_shipping_last_name();
		if( $rtwwcpig_data['shipping_last_name'] == '' )
		{
			$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_odr_objct->get_billing_last_name();
		}
		$rtwwcpig_data['shipping_company'] = $rtwwcpig_odr_objct->get_shipping_company();
		if( $rtwwcpig_data['shipping_company'] == '' )
		{
			$rtwwcpig_data['shipping_company'] = $rtwwcpig_odr_objct->get_billing_company();
		}
		$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_odr_objct->get_shipping_address_1();
		if( $rtwwcpig_data['shipping_address_1'] == '' )
		{
			$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_odr_objct->get_billing_address_1();
		}
		$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_odr_objct->get_shipping_address_2();
		if( $rtwwcpig_data['shipping_address_2'] == '' )
		{
			$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_odr_objct->get_billing_address_2();
		}
		$rtwwcpig_data['shipping_city'] = $rtwwcpig_odr_objct->get_shipping_city();
		if( $rtwwcpig_data['shipping_city'] == '' )
		{
			$rtwwcpig_data['shipping_city'] = $rtwwcpig_odr_objct->get_billing_city();
		}
		$rtwwcpig_data['shipping_state'] = $rtwwcpig_odr_objct->get_shipping_state();
		if( $rtwwcpig_data['shipping_state'] == '' )
		{
			$rtwwcpig_data['shipping_state'] = $rtwwcpig_odr_objct->get_billing_state();
		}
		$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_odr_objct->get_shipping_postcode();
		if( $rtwwcpig_data['shipping_postcode'] == '' )
		{
			$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_odr_objct->get_billing_postcode();
		}
		$rtwwcpig_data['shipping_country'] = WC()->countries->countries[ $rtwwcpig_odr_objct->get_shipping_country() ];
		if( $rtwwcpig_data['shipping_country'] == '' )
		{
			$rtwwcpig_data['shipping_country'] = WC()->countries->countries[ $rtwwcpig_odr_objct->get_billing_country() ];
		}

		$rtwwcpig_data['billing_first_name'] = $rtwwcpig_odr_objct->get_billing_first_name();
		$rtwwcpig_data['billing_email'] = $rtwwcpig_odr_objct->get_billing_email();
		$rtwwcpig_data['billing_last_name'] = $rtwwcpig_odr_objct->get_billing_last_name();
		$rtwwcpig_data['billing_address_1'] = $rtwwcpig_odr_objct->get_billing_address_1();
		$rtwwcpig_data['billing_address_2'] = $rtwwcpig_odr_objct->get_billing_address_2();
		$rtwwcpig_data['billing_city'] = $rtwwcpig_odr_objct->get_billing_city();
		$rtwwcpig_data['billing_state'] = $rtwwcpig_odr_objct->get_billing_state();
		$rtwwcpig_data['billing_postcode'] = $rtwwcpig_odr_objct->get_billing_postcode();
		$rtwwcpig_data['billing_country'] = WC()->countries->countries[ $rtwwcpig_odr_objct->get_billing_country() ];
		$rtwwcpig_data['order_amount'] = $rtwwcpig_odr_objct->get_total();
		$rtwwcpig_data['billing_company'] = $rtwwcpig_odr_objct->get_billing_company();
		$rtwwcpig_data['billing_phone'] = $rtwwcpig_odr_objct->get_billing_phone();
		$rtwwcpig_data['payment_method'] = $rtwwcpig_odr_objct->get_payment_method_title();
		$rtwwcpig_data['order_id'] = $rtwwcpig_odr_id;
		if (get_option('rtwwcpig_date_format')) {
			$rtwwcpig_data['order_date'] = $rtwwcpig_order_data['date_created']->date(get_option('rtwwcpig_date_format'));
		}else{
			$rtwwcpig_data['order_date'] = $rtwwcpig_order_data['date_created']->date('d/m/Y');
		}
		if ( get_option('rtwwcpig_allow_show_odr_status') == 'yes' ) {
			$rtwwcpig_data['order_status'] = $rtwwcpig_odr_objct->get_status();
		}
		if ( $rtwwcpig_odr_objct->get_meta('total_fee') ) {
			$rtwwcpig_data['Wipay_fees'] = wc_price($rtwwcpig_odr_objct->get_meta('total_fee'));
		}else{
			$rtwwcpig_data['Wipay_fees'] = ( $rtwwcpig_currency_symbol.' 0.00' );
		}
		$rtwwcpig_data['order_time'] = $rtwwcpig_order_data['date_created']->date('h:i:s');
		$rtwwcpig_data['customer_note'] = $rtwwcpig_odr_objct->get_customer_note();
		$rtwwcpig_data['total_discount'] = $rtwwcpig_odr_objct->get_total_discount();
		$rtwwcpig_data['billing_eu_vat'] = $rtwwcpig_odr_objct->get_meta('_billing_eu_vat');
		if ( $rtwwcpig_shpng_amnt == '' ) {
			$rtwwcpig_shpng_amnt = 0.00;
		}
		if ( $rtwwcpig_odr_objct->get_total_tax() == '' ) {
			$get_total_tax = 0.00;
		}else{
			$get_total_tax = $rtwwcpig_odr_objct->get_total_tax();
		}
		$rtwwcpig_data['subtotal_amount'] = $rtwwcpig_odr_objct->get_subtotal();
		$rtwwcpig_data['pos_discount'] = ( $rtwwcpig_currency_symbol.' 0.00' );
		if ( $rtwwcpig_odr_objct->get_meta('_op_order') ) {
			$order_discount = $rtwwcpig_odr_objct->get_meta('_op_order');
			if (isset($order_discount['final_discount_amount'])) {
				$rtwwcpig_data['pos_discount'] = ($rtwwcpig_currency_symbol.' '.wc_format_decimal($order_discount['final_discount_amount'],2));
			}
		}
   
		if ($rtwwcpig_product_id != '') 
		{
			$width = get_option('rtwwcpig_prod_img_width');
			$height = get_option('rtwwcpig_prod_img_height');
			if ( $width == '' ) {
				$width = 50;
			}
			if ( $height == '' ) {
				$height = 50;
			}
			foreach ($rtwwcpig_product_id as $rtwwcpig_k => $rtwwcpig_v) 
			{
				$rtwwcpig_pro = new WC_Product( $rtwwcpig_v );
				$price_exclude_tax = wc_get_price_excluding_tax( $rtwwcpig_pro );
				$price_incl_tax = wc_get_price_including_tax( $rtwwcpig_pro );
				$tax_amount[]     = ($price_incl_tax - $price_exclude_tax);
				$rtwwcpig_price[] = $rtwwcpig_pro->get_price();
				$rtwwcpig_hsncode[] = $rtwwcpig_pro->get_attribute( 'pa_hsn' );
				$rtwwcpig_regular_price[] = $rtwwcpig_pro->get_regular_price();
				if(!empty($rtwwcpig_pro->get_sale_price())){
					$rtwwcpig_sale_price[] = $rtwwcpig_pro->get_sale_price();
				}else{
					$rtwwcpig_sale_price[] = 0.00;
				}
				$rtwwcpig_prdct_img[] = $rtwwcpig_pro->get_image(array( $width,$height ));
				$rtwwcpig_term_list = wp_get_post_terms($rtwwcpig_v,'product_cat',array('fields'=>'all'));
				$rtwwcpig_cat_id = $rtwwcpig_term_list[0];
				$rtwwcpig_cat_name[] = $rtwwcpig_term_list[0]->name; //show product category name
				$rtwwcpig_cat[] = get_term_link ($rtwwcpig_cat_id, 'product_cat'); // show products category link
			}
		}

		$rtwwcpig_nmbrng_mthd = get_option('rtwwcpig_nmbrng_method');
		$currency_symbol = get_option('woocommerce_currency');

		if($rtwwcpig_nmbrng_mthd != '')
		{
			if( $rtwwcpig_odr_objct->get_status() == 'completed' )
			{
				if ($rtwwcpig_nmbrng_mthd == 'intrnl_suf_pre') 
				{
					$rtwwcpig_nxt_nmbr = get_option('rtwwcpig_nxt_nmbr');
					$rtwwcpig_prefix = get_option('rtwwcpig_prefix');
					$rtwwcpig_suffix = get_option('rtwwcpig_suffix');
					if ( strpos($rtwwcpig_prefix, 'day') !== false ) {
						$rtwwcpig_prefix = date('D');
					}else if( strpos($rtwwcpig_prefix, 'year') !== false ){
						$rtwwcpig_prefix = date('Y');
					}else if( strpos($rtwwcpig_prefix, 'month') !== false ){
						$rtwwcpig_prefix = date('m');
					}

					if ( strpos($rtwwcpig_suffix, 'day') !== false ) {
						$rtwwcpig_suffix = date('D');
					}else if( strpos($rtwwcpig_suffix, 'year') !== false ){
						$rtwwcpig_suffix = date('Y');
					}else if( strpos($rtwwcpig_suffix, 'month') !== false ){
						$rtwwcpig_suffix = date('m');
					}
					
					if ($rtwwcpig_nxt_nmbr != '') 
					{
						$rtwwcpig_options = ( $rtwwcpig_nxt_nmbr +1 );
						$rtwwcpig_data['order_id'] = $rtwwcpig_prefix.$rtwwcpig_nxt_nmbr.$rtwwcpig_suffix;
					}
					else
					{
						$rtwwcpig_options = 0;
						$rtwwcpig_data['order_id'] = $rtwwcpig_prefix.'0'.$rtwwcpig_suffix;
					}
					update_option( 'rtwwcpig_nxt_nmbr', $rtwwcpig_options );
				}
				else if($rtwwcpig_nmbrng_mthd == 'ordr_suf_pre')
				{
					$rtwwcpig_prefix = $rtwwcpig_stng['prefix'];
					$rtwwcpig_suffix = $rtwwcpig_stng['suffix'];
					$rtwwcpig_data['order_id'] = $rtwwcpig_prefix.$rtwwcpig_odr_id.$rtwwcpig_suffix;
				}
				else
				{
					$rtwwcpig_data['order_id'] = $rtwwcpig_odr_id;
				} 
			}
			else
			{
				$rtwwcpig_data['order_id'] = $rtwwcpig_odr_id;
			}
		}
		else
		{
			$rtwwcpig_data['order_id'] = $rtwwcpig_odr_id;
		}

		if( !class_exists('qrlib') ) {

			include_once( RTWWCPIG_DIR .'includes/phpqrcode/qrlib.php');
			include_once( RTWWCPIG_DIR .'includes/phpqrcode/qrconfig.php');
		}

		$qr_filepath = RTWWCPIG_PDF_SHPNGLBL_DIR.'qr_code_'.$rtwwcpig_odr_id.'.png';
		$qr_text = 'Order No. : '.$rtwwcpig_odr_id;
		$qr_text .= 'Customer Name : '.$rtwwcpig_odr_objct->get_billing_first_name().' '.$rtwwcpig_odr_objct->get_billing_last_name();
		$qr_text .= 'Order Total. : '.$rtwwcpig_odr_objct->get_total();
		if(file_exists($qr_filepath))
		{
			$rtwwcpig_qrcode = QRcode::png($qr_text,$qr_filepath);
		}
		$rtwwcpig_data['qr_image'] = '<img src="'.RTWWCPIG_PDF_URL.'/rtwwcpig_shipping_label/assets/qr_code_'.$rtwwcpig_odr_id.'.png" style="width: 180px; height: 180px; display: block; margin: 0 auto; box-sizing: border-box;">';

		if (! class_exists ( 'simple_html_dom_node' )) 
		{
			require_once (RTWWCPIG_DIR .'/includes/simplehtmldom/simple_html_dom.php');
		}

		$rtwwcpig_invoice = get_option( 'rtwwcpig_invoice_format_setting_opt' );
		$rtwwcpig_invoice =apply_filters( 'rtwwcpig_invoice_format_option', $rtwwcpig_invoice , $rtwwcpig_odr_id);

		$rtwwcpig_invoice_temp = isset($rtwwcpig_invoice['invoice_template']) ? $rtwwcpig_invoice['invoice_template'] : 1;

		if( $rtwwcpig_invoice_temp == 1 )
		{

			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_1']);			
			if ( $rtwwcpig_invoice_format == '' ) 
			{
				$rtwwcpig_invoice_format = get_option( 'rtwwcpig_default_formatt_and_tmplate' );
				$rtwwcpig_invoice_format = $rtwwcpig_invoice_format['invoice_format'];

				if(strpos($rtwwcpig_invoice_format,'[total_amnt_in_words]') !== false)
				{	
					if (get_option('rtwwcpig_dsply_amnt_word') == 'yes') 
					{
						$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
						$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr style="border-bottom: none;">
						<td style="width: 170px; padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;"><strong>Amount In Words</strong></td>
						<td style="padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;">[total_amnt_in_words]</td>
					</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[payment_method]') !== false)
				{
					if (get_option('rtwwcpig_dsply_paymnt_mthd') == 'yes') 
					{
						$rtwwcpig_data['payment_method'] = $rtwwcpig_order->get_payment_method_title();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
						<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Payment Method</strong></td>
						<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[payment_method]</td>
					</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[shipping_charges]') !== false)
				{
					if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
					{
						$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
						<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Shipping Charges</strong></td>
						<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[shipping_charges]</td>
					</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]') !== false)
				{
					if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
					{
						$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
						<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Tax</strong></td>
						<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[row_tax_amount]</td>
					</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
			}
			else
			{
				if(strpos($rtwwcpig_invoice_format,'[total_amnt_in_words]') !== false)
				{	
					if (get_option('rtwwcpig_dsply_amnt_word') == 'yes') 
					{
						$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
						$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Amount In Words</th>
<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[total_amnt_in_words]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[payment_method]') !== false)
				{
					if (get_option('rtwwcpig_dsply_paymnt_mthd') == 'yes') 
					{
						$rtwwcpig_data['payment_method'] = $rtwwcpig_order->get_payment_method_title();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Payment Method</th>
<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[payment_method]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[shipping_charges]') !== false)
				{
					if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
					{
						$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; color: #777777;">Shipping Charges</th>
<td style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 14px;">[shipping_charges]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]') !== false)
				{
					if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
					{
						$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="color: #777777; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd;">Tax</th>
<td style="text-align: right; color: #444444; padding: 10px; border-bottom: 1px solid #dddddd; font-size: 14px;">[row_tax_amount]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
			}
				
			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
			    }

			    $rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1;
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';
				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{
							$rtwwcpig_pric[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
						}else{

							$rtwwcpig_pric[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count], 2);
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img[] = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls[] = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[hsn_code]' ,'[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key.' '.$category_name[$rtwwcpig_count],$rtwwcpig_hsncode[$rtwwcpig_count] ,($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]), wc_price($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_name[$rtwwcpig_count] , wc_price( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count] ) ), wc_price($rtwwcpig_total_tax[$rtwwcpig_count]), wc_price(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}
		else if( $rtwwcpig_invoice_temp == 2 )
		{
			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_2']);
			
			if(strpos($rtwwcpig_invoice_format,'[total_amnt_in_words]')!= false)
				{
					if (get_option('rtwwcpig_dsply_amnt_word') == 'yes') 
					{
						$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
						$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Amount In Words</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[total_amnt_in_words]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[payment_method]')!= false)
				{
					if (get_option('rtwwcpig_dsply_paymnt_mthd') == 'yes') 
					{
						$rtwwcpig_data['payment_method'] = $rtwwcpig_order->get_payment_method_title();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Payment Method</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[payment_method]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				
				if(strpos($rtwwcpig_invoice_format,'[shipping_charges]')!= false)
				{
					if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
					{
						$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Shipping Charges</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[shipping_charges]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}
				if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]')!= false)
				{
					if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
					{
						$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Tax</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[row_tax_amount]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}

			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
				}

				$rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1; 
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';

				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{
							//$rtwwcpig_pric[] = wc_format_decimal($price_exclude_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							$rtwwcpig_dicount[] = ( $rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ).' '.$rtwwcpig_currency_symbol;
						}else{

							//$rtwwcpig_pric[] = wc_format_decimal($price_exclude_tax[$rtwwcpig_count], 2);
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							if( $rtwwcpig_sale_price[$rtwwcpig_count] != 0 ){
								$rtwwcpig_dicount[] =  wc_format_decimal(($rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ), 2);
							}else{
								$rtwwcpig_dicount[] = 0.00;
							}
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[hsn_code]' ,'[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key.' '.$category_name[$rtwwcpig_count], $rtwwcpig_hsncode[$rtwwcpig_count] ,($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]), wc_price($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_name[$rtwwcpig_count] , wc_price(( $rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ), wc_price($rtwwcpig_total_tax[$rtwwcpig_count]), wc_price(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}
		else if( $rtwwcpig_invoice_temp == 3 )
		{
			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_3']);

			if(strpos($rtwwcpig_invoice_format,'[total_amnt_in_words]')!= false)
				{
					if (get_option('rtwwcpig_dsply_amnt_word') == 'yes') 
					{
						$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
						$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Amount In Words</th>
<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[total_amnt_in_words]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}

				if(strpos($rtwwcpig_invoice_format,'[payment_method]')!= false)
				{
					if (get_option('rtwwcpig_dsply_paymnt_mthd') == 'yes') 
					{
						$rtwwcpig_data['payment_method'] = $rtwwcpig_order->get_payment_method_title();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Payment Method</th>
<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[payment_method]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}

				if(strpos($rtwwcpig_invoice_format,'[shipping_charges]')!= false)
				{
					if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
					{
						$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Shipping Charges</th>
<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[shipping_charges]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}

				if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]')!= false)
				{
					if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
					{
						$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('<tr>
<th style="color: #444444; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">Tax</th>
<td style="color: #555555; padding: 10px; text-align: left; border-bottom: 1px solid #dddddd; font-size: 15px;">[row_tax_amount]</td>
</tr>', " ", $rtwwcpig_invoice_format);
					}
				}

			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
				}

				$rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1;
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';		
				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{
							//$rtwwcpig_pric[] = wc_format_decimal($price_exclude_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							$rtwwcpig_dicount[] = ( $rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ).' '.$rtwwcpig_currency_symbol;
						}else{

							//$rtwwcpig_pric[] = wc_format_decimal($price_exclude_tax[$rtwwcpig_count], 2);
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							if( $rtwwcpig_sale_price[$rtwwcpig_count] != 0 ){
								$rtwwcpig_dicount[] =  wc_format_decimal(($rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ), 2);
							}else{
								$rtwwcpig_dicount[] = 0.00;
							}
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[]hsn_code]','[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key.' '.$category_name[$rtwwcpig_count], $rtwwcpig_hsncode[$rtwwcpig_count],($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]), wc_price($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_name[$rtwwcpig_count] , wc_price( ( $rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count] ) ), wc_price($rtwwcpig_total_tax[$rtwwcpig_count]), wc_price(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}
		else if( $rtwwcpig_invoice_temp == 4 )
		{
			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_4']);

			if(strpos($rtwwcpig_invoice_format,'[total_amnt_in_words]')!= false)
			{
				if (get_option('rtwwcpig_dsply_amnt_word') == 'yes') 
				{
					$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
					$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr style="border-bottom: none;">
<td style="width: 170px; padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;"><strong>Amount In Words</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: none; color: #444444;">[total_amnt_in_words]</td>
</tr>', " ", $rtwwcpig_invoice_format);
				}
			}

			if(strpos($rtwwcpig_invoice_format,'[payment_method]')!= false)
			{
				if (get_option('rtwwcpig_dsply_paymnt_mthd') == 'yes') 
				{
					$rtwwcpig_data['payment_method'] = $rtwwcpig_order->get_payment_method_title();
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Payment Method</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[payment_method]</td>
</tr>', ' ', $rtwwcpig_invoice_format);
				}
			}

			if(strpos($rtwwcpig_invoice_format,'[shipping_charges]')!= false)
			{
				if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
				{
					$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Shipping Charges</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[shipping_charges]</td>
</tr>', ' ', $rtwwcpig_invoice_format);
				}
			}

			if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]')!= false)
			{
				if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
				{
					$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="width: 150px; padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;"><strong>Tax</strong></td>
<td style="padding: 10px 5px; text-align: left; border-bottom: 2px solid #dddddd; color: #444444;">[row_tax_amount]</td>
</tr>', " ", trim($rtwwcpig_invoice_format));
				}
			}

			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
				}

				$rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1; 
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';		
				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{	
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							$rtwwcpig_dicount[] = ( $rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ).' '.$rtwwcpig_currency_symbol;
						}else{
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							if( $rtwwcpig_sale_price[$rtwwcpig_count] != 0 ){
								$rtwwcpig_dicount[] =  wc_format_decimal(($rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ), 2);
							}else{
								$rtwwcpig_dicount[] = 0.00;
							}
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls[] = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[hsn_code]','[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key.' '.$category_name[$rtwwcpig_count], $rtwwcpig_hsncode[$rtwwcpig_count],($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]), wc_price($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_name[$rtwwcpig_count] , wc_price( ( $rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count] ) ), wc_price($rtwwcpig_total_tax[$rtwwcpig_count]), wc_price(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}
		else if ( $rtwwcpig_invoice_temp == 5 ) 
		{
			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_5']);

			if(strpos($rtwwcpig_invoice_format,'[shipping_charges]')!= false)
			{
				if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
				{
					$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 40px; font-size: 15px;">Shipping Charge</td>
<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 40px; font-size: 15px;">[shipping_charges]</td>
</tr>', " ", $rtwwcpig_invoice_format);
				}
			}

			if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]')!= false)
			{
				if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
				{
					$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="text-align: right; padding-left: 10px; padding-right: 20px; background: #2897b8; color: white; width: 205px; height: 40px; font-size: 15px;">Total Tax</td>
<td style="text-align: right; background: #2897b8; padding-left: 10px; padding-right: 20px; color: white; width: 100px; height: 40px; font-size: 15px;">[row_tax_amount]</td>
</tr>', " ", $rtwwcpig_invoice_format);
				}
			}
			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
				}

				$rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1; 
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';		
				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{	
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							$rtwwcpig_dicount[] = ( $rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ).' '.$rtwwcpig_currency_symbol;
						}else{
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							if( $rtwwcpig_sale_price[$rtwwcpig_count] != 0 ){
								$rtwwcpig_dicount[] =  wc_format_decimal(($rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ), 2);
							}else{
								$rtwwcpig_dicount[] = 0.00;
							}
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img[] = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls[] = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( array('[product_name]', '[product_img]', '[product_qty]', '[tax_rate]', '[product_price]', '[discount]', '[line_total]'), array($key.' '.$category_name[$rtwwcpig_count],($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]),$value,$tax_name[$rtwwcpig_count],wc_price($rtwwcpig_prodct_price[$rtwwcpig_count]),wc_price( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ), wc_price(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}
		else if ($rtwwcpig_invoice_temp == 6) 
		{
			$rtwwcpig_invoice_format = stripcslashes($rtwwcpig_invoice['invoice_format_6']);
			if(strpos($rtwwcpig_invoice_format,'[shipping_charges]')!= false)
			{
				if (get_option('rtwwcpig_dsply_fee_shipng') == 'yes') 
				{
					$rtwwcpig_data['shipping_charges'] = $rtwwcpig_shpng_amnt;
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="padding-top: 10px; padding-bottom: 10px; background: whitesmoke;">Shipping Charges</td>
<td style="background: whitesmoke;">[shipping_charges]</td>
</tr>', " ", $rtwwcpig_invoice_format);
				}
			}

			if(strpos($rtwwcpig_invoice_format,'[row_tax_amount]')!= false)
			{
				if (get_option('rtwwcpig_dsplay_tax_row') == 'yes') 
				{
					$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_odr_objct->get_total_tax();
				}
				else
				{
					$rtwwcpig_invoice_format = str_replace('<tr>
<td style="padding-top: 10px; padding-bottom: 10px; background: whitesmoke;">Total Tax</td>
<td style="background: whitesmoke;">[row_tax_amount]</td>
</tr>', " ", $rtwwcpig_invoice_format);
				}
			}
			if ($rtwwcpig_invoice_format != '') 
			{
				foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
				{
					if ( $rtwwcpig_key == 'order_amount' ) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'row_tax_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_odr_objct->get_total_tax();
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_odr_objct->get_total_tax());
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'shipping_charges' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					if( $rtwwcpig_key == 'subtotal_amount' )
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') {
							$rtwwcpig_val = $rtwwcpig_val;
						}else{
							$rtwwcpig_val = wc_price($rtwwcpig_val);
						}
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);
					}
					else
					{
						$rtwwcpig_invoice_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_invoice_format);	
					}
				}

				$rtwwcpig_invoice_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_invoice_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
				$rtwwcpig_count = 0;
				$line_numb = 1; 
				$rtwwcpig_string2 = '';
				$rtwwcpig_dom = new simple_html_dom ();
				$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
				$rtwwcpig_prod_tr = '';
				$rtwwcpig_count = 0;
				foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody') as $val) 
				{
					$rtwwcpig_prod_tr = $val->outertext;
				}
				$rtwwcpig_prod_tr_final = '';		
				if ($rtwwcpig_product_qty != '') 
				{
					foreach ($rtwwcpig_product_qty as $key => $value) 
					{
						if (get_option('rtwwcpig_dsply_crrncy_smbl') != 'yes') 
						{	
							$rtwwcpig_ttl_amnt[] = ($rtwwcpig_price[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_ttl_tax[] = ($rtwwcpig_total_tax[$rtwwcpig_count].' '.$rtwwcpig_currency_symbol);
							$rtwwcpig_line_ttl[] = ($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count]).' '.$rtwwcpig_currency_symbol;
							$rtwwcpig_dicount[] = ( $rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ).' '.$rtwwcpig_currency_symbol;
						}else{
							$rtwwcpig_ttl_amnt[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] ,2);
							$rtwwcpig_ttl_tax[] = wc_format_decimal($rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							$rtwwcpig_line_ttl[] = wc_format_decimal($rtwwcpig_price[$rtwwcpig_count] + $rtwwcpig_total_tax[$rtwwcpig_count] , 2);
							if( $rtwwcpig_sale_price[$rtwwcpig_count] != 0 ){
								$rtwwcpig_dicount[] =  wc_format_decimal(($rtwwcpig_price[$rtwwcpig_count] - $rtwwcpig_sale_price[$rtwwcpig_count] ), 2);
							}else{
								$rtwwcpig_dicount[] = 0.00;
							}
							
						}
						if (get_option('rtwwcpig_dsply_prdct_img') == 'yes' && $rtwwcpig_prdct_img !='') 
						{
							$rtwwcpig_prodct_img[] = $rtwwcpig_prdct_img[$rtwwcpig_count];
						}
						else
						{
							$rtwwcpig_prodct_img[] = '';
						}
						if (get_option('rtwwcpig_prdct_id_sku') == 'dsply_prdct_id') 
						{
							$rtwwcpig_prdct_dtls[] = '(Product ID : '.$rtwwcpig_product_id[$rtwwcpig_count].')';
						}
						else if(get_option('rtwwcpig_prdct_id_sku') == 'dsply_sku')
						{
							$rtwwcpig_prdct_dtls[] = '(Product SKU : '.$rtwwcpig_sku[$rtwwcpig_count].')';
						}
						else
						{
							$rtwwcpig_prdct_dtls[] = '';
						}
						if(get_option('rtwwcpig_dsply_prdct_cat') == 'yes'){
							$category_name[] = '('.$rtwwcpig_cat_name[$rtwwcpig_count].')';
						}else{
							$category_name[] = '';
						}
						$rtwwcpig_prod_tr_final .= str_replace( 
							array('[product_name]', '[product_img]', '[product_qty]', '[tax_rate]', '[product_price]', '[discount]', '[line_total]'), 
							array(
								$key.' '.$category_name[$rtwwcpig_count],
								($rtwwcpig_prdct_img[$rtwwcpig_count].' '.$rtwwcpig_prdct_dtls[$rtwwcpig_count]),
								$value,
								$tax_name[$rtwwcpig_count],
								$rtwwcpig_currency_symbol.' '.wc_format_decimal($rtwwcpig_prodct_price[$rtwwcpig_count],2),
								$rtwwcpig_currency_symbol.' '.( wc_format_decimal( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ,2 ) ), 
								$rtwwcpig_currency_symbol.' '.wc_format_decimal(($rtwwcpig_total_amnt[$rtwwcpig_count]),2)), 
								$rtwwcpig_prod_tr);

						$rtwwcpig_count = ++$rtwwcpig_count;
						$line_numb = ++$line_numb;
					}
				}
			}
		}

		$rtwwcpig_dom = new simple_html_dom ();
		$rtwwcpig_dom->load ( $rtwwcpig_invoice_format );
		foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody') as $val) 
		{
			$val->outertext = $rtwwcpig_prod_tr_final;
		}
		$rtwwcpig_invoice_format = $rtwwcpig_dom->save();
		$rtwwcpig_invoice_format = preg_replace('/\[[^\]]*\]/', '', $rtwwcpig_invoice_format);
		$rtwwcpig_pdf_invoice = rtwwcpig_convert_to_pdf($rtwwcpig_invoice_format, $rtwwcpig_odr_id, $rtwwcpig_user_email);

		return $rtwwcpig_pdf_invoice;
	}
	else
	{
		return ;
	}	
}

/**
 * function for create pdf for invoice.
 *
 * @since    1.0.0
 */
function rtwwcpig_convert_to_pdf( $rtwwcpig_pdf_html, $rtwwcpig_ordr_id, $rtwwcpig_user_email, $rtwwcpig_pro_desc='')
{
	error_reporting(0);
	ini_set('display_errors', 0);
	$rtwwcpig_order = wc_get_order($rtwwcpig_ordr_id);
	$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
	if ( $pdf_name == '' ) {
		$pdf_name = 'rtwwcpig_';
	}
	if ($rtwwcpig_pro_desc == 'Shipping_label') 
	{
		$rtwwcpig_file_path = RTWWCPIG_PDF_DIR.'/rtwwcpig_shipping_label/rtwwcpig_shiping_lbl_'.$rtwwcpig_ordr_id.'.pdf';
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		$rtwwcpig_file_path = RTWWCPIG_CREDITNOTE_DIR.'credi-note-'.$rtwwcpig_ordr_id.'.pdf';
	}
	else
	{
		$rtwwcpig_file_path = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_ordr_id.'.pdf'; 
	}

	if(get_option('rtwwcpig_table_border') == 'yes')
	{
		$rtwwcpig_pdf_css = '<style>
		body
		{
			margin: 0px;
		}
		table 
		{
			width : 100%;
		}
		table, td, th
		{
			border: 1px solid black;
			border-collapse: collapse;
		}
		th
		{
			background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;
			font-weight:bold;
		}
		tr
		{
			border: 1px solid black;
			border-collapse: collapse;
		}
		td
		{
			font-size:12pt;
		}
		.rtwwcpig_text {
			font-weight:bold;
			padding-top:6px;
			text-align: right;
			display: inline-block;
			margin-top: 5px;
			margin:bottom: 5px;
		}
		.rtwwcpig_text_label {
			font-weight: bold;
			width: 200px;
			display: block;
		}
		#rtwwcpig_text_center
		{
			text-align: center;
		}';
		$rtwwcpig_pdf_css .= '<style> div
		{ 
			margin-top:0px;
			margin-bottom:0px;
			padding-top:0px;
			padding-bottom:0px;
		}
		td, tr, th
		{
			text-align: left;
		}';
	}
	else
	{
		$rtwwcpig_pdf_css = '<style>
		body
		{
			margin: 0px;
		}
		img
		{
			float:left;
		}
		table 
		{
			width : 100%;
		}
		table
		{
			border-collapse: collapse;
		}
		th
		{
			font-weight:bold;
			padding:10px;
			border-bottom:1px solid #dddddd;
			text-align: center;
		}
		td
		{
			padding:10px;
			border-bottom:1px solid #dddddd;
			text-align: center;
		}
		.rtwwcpig_text {
			font-weight:lighter;
			padding-top:6px;
			text-align: right;
			display: inline-block;
			margin-top: 5px;
			margin:bottom: 5px;
		}
		.rtwwcpig_text_label {
			width: 200px;
			display: block;
			font-weight: bold;
		}
		#rtwwcpig_text_center
		{
			text-align: center;
		}';
	}

	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if (get_option('rtwwcpig_pckngslp_pdf_css') != '')
		{
			$rtwwcpig_pdf_css .= get_option('rtwwcpig_pdf_css');
		}
		$rtwwcpig_pdf_html = $rtwwcpig_pdf_css.'</style>'.$rtwwcpig_pdf_html;
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		if (get_option('rtwwcpig_credit_note_pdf_css') != '')
		{
			$rtwwcpig_pdf_css .= get_option('rtwwcpig_credit_note_pdf_css');
		}
		$rtwwcpig_pdf_html = $rtwwcpig_pdf_css.'</style>'.$rtwwcpig_pdf_html;
	}
	else
	{
		if (get_option('rtwwcpig_pdf_css') != '')
		{
			$rtwwcpig_pdf_css .= get_option('rtwwcpig_pdf_css');
		}
		$rtwwcpig_pdf_html = $rtwwcpig_pdf_css.'</style>'.$rtwwcpig_pdf_html;
	}
	
	if ( $rtwwcpig_pro_desc == 'Shipping_label' ) 
	{
		$shpng_page = get_option( 'rtwwcpig_shpng_lbl_css_setting_opt');
		if ( !empty($shpng_page) && isset($shpng_page['rtwwcpig_pdf_page_size']) ) 
		{
			$rtwwcpig_page_size = $shpng_page['rtwwcpig_pdf_page_size'];
		}
		else
		{
			$rtwwcpig_page_size = serialize(array(210,297));
		}
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		$credit_note = get_option( 'rtwwcpig_credit_note_css_setting_opt' );
		if( isset( $credit_note['rtwwcpig_pdf_page_size'] ) && !empty( $credit_note ['rtwwcpig_pdf_page_size'] ) && $credit_note['rtwwcpig_pdf_page_size'] != 'select' ) 
		{
			$rtwwcpig_page_size = $credit_note['rtwwcpig_pdf_page_size'];
		}else{

			$rtwwcpig_page_size = serialize(array(210,297));
		}
	}
	else
	{
		if( isset( $rtwwcpig_stng['rtwwcpig_pdf_page_size'] ) && !empty( $rtwwcpig_stng ['rtwwcpig_pdf_page_size'] ) && $rtwwcpig_stng['rtwwcpig_pdf_page_size'] != 'select' ) 
		{
			$rtwwcpig_page_size = $rtwwcpig_stng ['rtwwcpig_pdf_page_size'];
		}else{

			$rtwwcpig_page_size = serialize(array(210,297));
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpnglbl_page_orien') != '' )
		{
			$rtwwcpig_page_orientation = get_option('rtwwcpig_shpnglbl_page_orien');
		}
		else
		{
			$rtwwcpig_page_orientation = 'P';
		}
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		if( get_option('rtwwcpig_credit_note_page_orien') != '' ) 
		{
			$rtwwcpig_page_orientation = get_option('rtwwcpig_credit_note_page_orien');
		}
		else
		{
			$rtwwcpig_page_orientation = 'P';
		}
	}
	else
	{
		if( get_option('rtwwcpig_rtwwcpig_page_orien') != '' ) 
		{
			$rtwwcpig_page_orientation = get_option('rtwwcpig_rtwwcpig_page_orien');
		}
		else
		{
			$rtwwcpig_page_orientation = 'P';
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpnglbl_body_left_margin') !='' ) {
			$rtwwcpig_lft_marg = get_option('rtwwcpig_shpnglbl_body_left_margin');	
		} else {

			$rtwwcpig_lft_marg = 15;
		}
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		if( get_option('rtwwcpig_credit_note_body_left_margin') !='' ) {
			$rtwwcpig_lft_marg = get_option('rtwwcpig_credit_note_body_left_margin');	
		} else {

			$rtwwcpig_lft_marg = 15;
		}
	}
	else
	{
		if( get_option('rtwwcpig_body_left_margin') !='' ) {
			$rtwwcpig_lft_marg = get_option('rtwwcpig_body_left_margin');	
		} else {

			$rtwwcpig_lft_marg = 15;
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpnglbl_body_right_margin') !='' ) {

			$rtwwcpig_rgt_marg = get_option('rtwwcpig_shpnglbl_body_right_margin');	
		} else {

			$rtwwcpig_rgt_marg = 15;
		}
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		if( get_option('rtwwcpig_credit_note_body_right_margin') !='' ) {

			$rtwwcpig_rgt_marg = get_option('rtwwcpig_credit_note_body_right_margin');	
		} else {

			$rtwwcpig_rgt_marg = 15;
		}
	}
	else
	{
		if( get_option('rtwwcpig_body_right_margin') !='' ) {

			$rtwwcpig_rgt_marg = get_option('rtwwcpig_body_right_margin');	
		} else {

			$rtwwcpig_rgt_marg = 15;
		}
	}

	if ( $rtwwcpig_pro_desc == 'Shipping_label' ) 
	{
		if( get_option('rtwwcpig_shpnglbl_body_top_margin') !='' ) {

			$rtwwcpig_top_marg = get_option('rtwwcpig_shpnglbl_body_top_margin');	
		} else {

			$rtwwcpig_top_marg = 15;
		}
	}
	else if( $rtwwcpig_pro_desc == 'credit_note' )
	{
		if( get_option('rtwwcpig_credit_note_body_top_margin') !='' ) {

			$rtwwcpig_top_marg = get_option('rtwwcpig_credit_note_body_top_margin');	
		} else {

			$rtwwcpig_top_marg = 15;
		}
	}
	else
	{
		if( get_option('rtwwcpig_body_top_margin') !='' ) {

			$rtwwcpig_top_marg = get_option('rtwwcpig_body_top_margin');	
		} else {

			$rtwwcpig_top_marg = 15;
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_header_top_margin') !='' ) {
			$rtwwcpig_hdr_top_marg = get_option('rtwwcpig_shpng_lbl_header_top_margin');	
		} else {

			$rtwwcpig_hdr_top_marg = 7;
		}
	}
	elseif ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_header_top_margin') !='' ) {
			$rtwwcpig_hdr_top_marg = get_option('rtwwcpig_credit_note_header_top_margin');	
		} else {

			$rtwwcpig_hdr_top_marg = 7;
		}
	}
	else
	{
		if( get_option('rtwwcpig_header_top_margin') !='' ) {
			$rtwwcpig_hdr_top_marg = get_option('rtwwcpig_header_top_margin');	
		} else {

			$rtwwcpig_hdr_top_marg = 7;
		}
	}

	/*PDF footer top margin*/
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_footer_top_margin') !='' ) 
		{
			$rtwwcpig_foo_top_marg = get_option('rtwwcpig_shpng_lbl_footer_top_margin');	
		} 
		else 
		{
			$rtwwcpig_foo_top_marg = 15;
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note'  ) 
	{
		if( get_option('rtwwcpig_credit_note_footer_top_margin') !='' ) 
		{
			$rtwwcpig_foo_top_marg = get_option('rtwwcpig_credit_note_footer_top_margin');	
		} 
		else 
		{
			$rtwwcpig_foo_top_marg = 15;
		}
	}
	else
	{
		if( get_option('rtwwcpig_footer_top_margin') !='' ) 
		{
			$rtwwcpig_foo_top_marg = get_option('rtwwcpig_footer_top_margin');	
		} 
		else 
		{
			$rtwwcpig_foo_top_marg = 15;
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpnglbl_body_font_family') !='' ) 
		{
			$rtwwcpig_body_font_family = get_option('rtwwcpig_shpnglbl_body_font_family');
		}
		else
		{
			$rtwwcpig_body_font_family = "dejavusanscondensed";
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_body_font_family') !='' ) 
		{
			$rtwwcpig_body_font_family = get_option('rtwwcpig_credit_note_body_font_family');
		}
		else
		{
			$rtwwcpig_body_font_family = "dejavusanscondensed";
		}
	}
	else
	{
		if( get_option('rtwwcpig_body_font_family') !='' ) 
		{
			$rtwwcpig_body_font_family = get_option('rtwwcpig_body_font_family');
		}
		else
		{
			$rtwwcpig_body_font_family = "dejavusanscondensed";
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if(get_option('rtwwcpig_shpnglbl_body_font_size') !='' ) 
		{
			$rtwwcpig_body_font_size = get_option('rtwwcpig_shpnglbl_body_font_size');
		} 
		else
		{
			$rtwwcpig_body_font_size = 10;
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_body_font_size') !='' ) 
		{
			$rtwwcpig_body_font_size = get_option('rtwwcpig_credit_note_body_font_size');
		}
		else
		{
			$rtwwcpig_body_font_size = 10;
		}
	}
	else
	{
		if(get_option('rtwwcpig_body_font_size') !='' ) 
		{
			$rtwwcpig_body_font_size = get_option('rtwwcpig_body_font_size');
		} 
		else
		{
			$rtwwcpig_body_font_size = 10;
		}
	}

	if ( $rtwwcpig_pro_desc == '' || $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		$rtwwcpig_option = get_option('rtwwcpig_invoice_format_setting_opt');
		$rtwwcpig_credit_note = get_option( 'rtwwcpig_credit_note_format_setting_opt' );

		if( $rtwwcpig_option['invoice_template'] == 1 || $rtwwcpig_option['invoice_template'] == 5 || $rtwwcpig_option['invoice_template'] == 6 || $rtwwcpig_credit_note['invoice_template'] == 6 )
		{
			$rtwwcpig_top_marg = 0;
			$rtwwcpig_rgt_marg = 0;
			$rtwwcpig_lft_marg = 0;
			$rtwwcpig_hdr_top_marg = 0;
		}
		else if( $rtwwcpig_option['invoice_template'] == 3 || $rtwwcpig_credit_note['invoice_template'] == 3 )
		{
			$rtwwcpig_rgt_marg = 12;
			$rtwwcpig_lft_marg = 12;
		}
	}
	include(RTWWCPIG_DIR ."includes/mpdf/autoload.php");
	$rtwwcpig_mpdf = new \Mpdf\Mpdf( ['mode' => 'utf-8', 'format' => unserialize( $rtwwcpig_page_size ), 'default_font_size' => $rtwwcpig_body_font_size, 'default_font' => $rtwwcpig_body_font_family, 'margin_left' => $rtwwcpig_lft_marg, 'margin_right' => $rtwwcpig_rgt_marg, 'margin_top' => $rtwwcpig_top_marg, 'margin_bottom' => '20', 'margin_header' => $rtwwcpig_hdr_top_marg, 'margin_footer' => $rtwwcpig_foo_top_marg, 'orientation' => $rtwwcpig_page_orientation ]);
	if ( $rtwwcpig_option['invoice_template'] == 1 || $rtwwcpig_option['invoice_template'] == 5 || $rtwwcpig_option['invoice_template'] == 6 || $rtwwcpig_credit_note['invoice_template'] == 6 ) 
	{
		$rtwwcpig_mpdf->setAutoTopMargin = 'stretch';
		$rtwwcpig_mpdf->setAutoBottomMargin = 'stretch';
		$rtwwcpig_mpdf->SetDisplayMode('fullpage');
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_header_font_size') != '' ) {

			$rtwwcpig_hdr_font_size = get_option('rtwwcpig_shpng_lbl_header_font_size');
		} else {

			$rtwwcpig_hdr_font_size = 20;
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_header_font_size') != '' ) {

			$rtwwcpig_hdr_font_size = get_option('rtwwcpig_credit_note_header_font_size');
		} else {

			$rtwwcpig_hdr_font_size = 20;
		}
	}
	else
	{
		if( get_option('rtwwcpig_header_font_size') != '' ) {

			$rtwwcpig_hdr_font_size = get_option('rtwwcpig_header_font_size');
		} else {

			$rtwwcpig_hdr_font_size = 20;
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_header_font') !='' ) {

			$rtwwcpig_hdr_font_family = get_option('rtwwcpig_shpng_lbl_header_font');
		} else{

			$rtwwcpig_hdr_font_family = 'sans-serif';
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_header_font') != '' ) {

			$rtwwcpig_hdr_font_family = get_option('rtwwcpig_credit_note_header_font');
		} else {

			$rtwwcpig_hdr_font_family = 20;
		}
	}
	else
	{
		if( get_option('rtwwcpig_header_font_family') !='' ) {

			$rtwwcpig_hdr_font_family = get_option('rtwwcpig_header_font_family');
		} else{

			$rtwwcpig_hdr_font_family = 'sans-serif';
		}
	}
	
	$rtwwcpig_mpdf->defaultheaderfontsize = $rtwwcpig_hdr_font_size;
	$rtwwcpig_mpdf->defaultheaderfontstyle = $rtwwcpig_hdr_font_family;
	$rtwwcpig_mpdf->defaultheaderline = 1;

	$rtwwcpig_site_name=get_bloginfo ( 'name' );
	$rtwwcpig_site_desc=get_bloginfo ( 'description' );
	$rtwwcpig_site_url=home_url();

	//***$rtwwcpig_stng['rtw_header_html'] this variable is used for HTML***//
	if ( $rtwwcpig_pro_desc == 'Shipping_label' ) 
	{
		$shpng_hdr_html = get_option('rtwwcpig_shpng_lbl_header_stng_opt');
		if (!empty($shpng_hdr_html) && isset($shpng_hdr_html['rtw_header_html']) && $shpng_hdr_html['rtw_header_html'] != '' ) 
		{
			$rtwwcpig_hdr_html = $shpng_hdr_html['rtw_header_html'];

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'O' );

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'E');
		}
		else
		{
			$rtwwcpig_mpdf->SetHTMLHeader('', 'O' );
			$rtwwcpig_mpdf->SetHTMLHeader('', 'E');
		}
	}
	else if ($rtwwcpig_pro_desc == 'credit_note') 
	{
		$credit_hdr_html = get_option('rtwwcpig_credit_note_header_stng_opt');
		if (!empty($credit_hdr_html) && isset($credit_hdr_html['rtw_header_html']) && $credit_hdr_html['rtw_header_html'] != '' ) 
		{
			$rtwwcpig_hdr_html = $credit_hdr_html['rtw_header_html'];

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'O' );

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'E');
		}
		else
		{
			$rtwwcpig_mpdf->SetHTMLHeader('', 'O' );
			$rtwwcpig_mpdf->SetHTMLHeader('', 'E');
		}
	}
	else
	{
		$invoice_hdr_html = get_option('rtwwcpig_header_setting_opt');
		if( isset( $invoice_hdr_html['rtw_header_html'] ) && $invoice_hdr_html['rtw_header_html'] != '' ) 
		{
			$rtwwcpig_hdr_html = $invoice_hdr_html['rtw_header_html'];

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'O' );

			$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr(get_option('rtwwcpig_header_font_family')).';">'.stripcslashes($rtwwcpig_hdr_html).'</h2></div>', 'E');
		}
		else
		{
			$rtwwcpig_mpdf->SetHTMLHeader('', 'O' );
			$rtwwcpig_mpdf->SetHTMLHeader('', 'E');
		}
	}
    
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_footer_font_size') !='' ) {

			$rtwwcpig_foo_font_size = get_option('rtwwcpig_shpng_lbl_footer_font_size');
		} else {

			$rtwwcpig_foo_font_size = 10;
		}
	}
	else if ($rtwwcpig_pro_desc == 'credit_note') 
	{
		if( get_option('rtwwcpig_credit_note_footer_font_size') !='' ) {

			$rtwwcpig_foo_font_size = get_option('rtwwcpig_credit_note_footer_font_size');
		} else {

			$rtwwcpig_foo_font_size = 10;
		}
	}
	else
	{
		if( get_option('rtwwcpig_footer_font_size') !='' ) {

			$rtwwcpig_foo_font_size = get_option('rtwwcpig_footer_font_size');
		} else {

			$rtwwcpig_foo_font_size = 10;
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if(get_option('rtwwcpig_shpng_lbl_footer_font_family') !='' ) {

			$rtwwcpig_foo_family = get_option('rtwwcpig_shpng_lbl_footer_font_family');
		} else {

			$rtwwcpig_foo_family = 'sans-serif';
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if(get_option('rtwwcpig_credit_note_footer_font_family') !='' ) {

			$rtwwcpig_foo_family = get_option('rtwwcpig_credit_note_footer_font_family');
		} else {

			$rtwwcpig_foo_family = 'sans-serif';
		}
	}
	else
	{
		if(get_option('rtwwcpig_footer_font_family') !='' ) {

			$rtwwcpig_foo_family = get_option('rtwwcpig_footer_font_family');
		} else {

			$rtwwcpig_foo_family = 'sans-serif';
		}
	}

	$rtwwcpig_mpdf->defaultfooterfontsize = $rtwwcpig_foo_font_size;	/* in pts */
	$rtwwcpig_mpdf->defaultfooterfontstyle = $rtwwcpig_foo_family;	/* blank, B, I, or BI */
	$rtwwcpig_mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		$shpng_footr_html = get_option( 'rtwwcpig_shpng_lbl_footer_setting_opt' );
		if( !empty($shpng_footr_html) && isset($shpng_footr_html['rtw_footer_html']) ) {
			$rtwwcpig_footer_txt = $rtwwcpig_stng['rtw_footer_html'];
		} else {
			$rtwwcpig_footer_txt = '';
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		$credit_footr_html = get_option( 'rtwwcpig_credit_note_footer_setting_opt' );
		if( !empty($credit_footr_html) && isset($credit_footr_html['rtw_footer_html']) ) {
			$rtwwcpig_footer_txt = $rtwwcpig_stng['rtw_footer_html'];
		} else {
			$rtwwcpig_footer_txt = '';
		}
	}
	else
	{
		$invoice_footr_html = get_option( 'rtwwcpig_footer_setting_opt' );
		if( isset($invoice_footr_html['rtw_footer_html']) && !empty( $invoice_footr_html['rtw_footer_html'] ) ) {
			$rtwwcpig_footer_txt = $invoice_footr_html['rtw_footer_html'];
		} else {
			$rtwwcpig_footer_txt = '';
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if (get_option('rtwwcpig_shpng_lbl_page_no') !='' && get_option('rtwwcpig_shpng_lbl_page_no') == 'yes' ) {
			$rtwwcpig_page_no = '' ;
		}else{
			$rtwwcpig_page_no = '{PAGENO}/{nbpg}';
		}
	}
	else if ($rtwwcpig_pro_desc == 'credit_note') 
	{
		if (get_option('rtwwcpig_credit_note_page_no') !='' && get_option('rtwwcpig_credit_note_page_no') == 'yes' ) {
			$rtwwcpig_page_no = '' ;
		}else{
			$rtwwcpig_page_no = '{PAGENO}/{nbpg}';
		}
	}
	else
	{
		if (get_option('rtwwcpig_page_no') !='' && get_option('rtwwcpig_page_no') == 'yes' ) {
			$rtwwcpig_page_no = '' ;
		}else{
			$rtwwcpig_page_no = '{PAGENO}/{nbpg}';
		}
	}
	

	/*
	*  $rtwwcpig_footer_txt this variable is used for HTML 
	*/
	if( !empty($rtwwcpig_footer_txt) )
	{
		$rtwwcpig_mpdf->SetHTMLFooter( '<div style="width:100%;margin:0px;padding:0px;"><div style="width: 92%;margin-top:'.esc_attr($rtwwcpig_foo_top_marg).';font-size:'.esc_attr($rtwwcpig_foo_font_size).';font-family:'.esc_attr($rtwwcpig_foo_family).'">'.stripcslashes($rtwwcpig_footer_txt).'</div><div style="width: ;margin:0px;padding:0px;float:;text-align:;font-size:'.esc_attr($rtwwcpig_foo_font_size).';">'.$rtwwcpig_page_no.'</div>', 'O' );
		$rtwwcpig_mpdf->SetHTMLFooter( '<div style="width:100%;margin:0px;padding:0px;margin-top:2px;padding-top:10px"><div style="width: 92%;margin-top:'.esc_attr($rtwwcpig_foo_top_marg).';font-size:'.esc_attr($rtwwcpig_foo_font_size).'">'.stripcslashes($rtwwcpig_footer_txt).'</div><div style="width: 8%;margin:0px;padding:0px;float:;text-align:;font-size:'.esc_attr($rtwwcpig_foo_font_size).';">'.$rtwwcpig_page_no.'</div>', 'E' );
	}

	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_enable_shpng_lbl_text_watermark') !='' && get_option('rtwwcpig_enable_shpng_lbl_text_watermark') == 'yes' )
		{
			if( get_option('rtwwcpig_shpng_lbl_watermark_text') != '' )
			{
				$rtwwcpig_alpha=0.2;
				if( get_option('rtwwcpig_shpng_lbl_watermark_text_trans') != '' )
				{
					$rtwwcpig_alpha = get_option('rtwwcpig_shpng_lbl_watermark_text_trans');
				}

				if(get_option('rtwwcpig_shpng_lbl_watermark_rotation') !='')
				{
					$GLOBALS['rotate']= get_option('rtwwcpig_shpng_lbl_watermark_rotation');
				}
				$rtwwcpig_mpdf->SetWatermarkText( trim(get_option('rtwwcpig_shpng_lbl_watermark_text')),$rtwwcpig_alpha );
				$rtwwcpig_mpdf->showWatermarkText = true;
				if( get_option('rtwwcpig_shpng_lbl_watermark_font') )
				{
					$rtwwcpig_mpdf->watermark_font = get_option('rtwwcpig_shpng_lbl_watermark_font');
				}
			}
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_enable_creditnote_text_watermark') !='' && get_option('rtwwcpig_enable_creditnote_text_watermark') == 'yes' )
		{
			if( get_option('rtwwcpig_creditnote_watermark_text') != '' )
			{
				$rtwwcpig_alpha=0.2;
				if( get_option('rtwwcpig_credit_watermark_text_trans') != '' )
				{
					$rtwwcpig_alpha = get_option('rtwwcpig_credit_watermark_text_trans');
				}

				if(get_option('rtwwcpig_pckngslp_watermark_rotation') !='')
				{
					$GLOBALS['rotate']= get_option('rtwwcpig_pckngslp_watermark_rotation');
				}
				$rtwwcpig_mpdf->SetWatermarkText( trim(get_option('rtwwcpig_creditnote_watermark_text')),$rtwwcpig_alpha );
				$rtwwcpig_mpdf->showWatermarkText = true;
				if( get_option('rtwwcpig_creditnote_watermark_font') )
				{
					$rtwwcpig_mpdf->watermark_font = get_option('rtwwcpig_creditnote_watermark_font');
				}
			}
		}
	}
	else
	{
		if( get_option('rtwwcpig_enable_text_watermark') !='' && get_option('rtwwcpig_enable_text_watermark') == 'yes' )
		{
			if( get_option('rtwwcpig_watermark_text') != '' )
			{
				$rtwwcpig_alpha=0.2;
				if( get_option('rtwwcpig_watermark_text_trans') != '' )
				{
					$rtwwcpig_alpha = get_option('rtwwcpig_watermark_text_trans');
				}

				if(get_option('rtwwcpig_watermark_rotation') !='')
				{
					$GLOBALS['rotate']= get_option('rtwwcpig_watermark_rotation');
				}
				$rtwwcpig_mpdf->SetWatermarkText( trim(get_option('rtwwcpig_watermark_text')),$rtwwcpig_alpha );
				$rtwwcpig_mpdf->showWatermarkText = true;
				if( get_option('rtwwcpig_watermark_font') )
				{
					$rtwwcpig_mpdf->watermark_font = get_option('rtwwcpig_watermark_font');
				}
			}	
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_enable_shpng_lbl_image_watermark') !='' && get_option('rtwwcpig_enable_shpng_lbl_image_watermark') == 'yes' )
		{
			$shpng_wtrmrk = get_option('rtwwcpig_shpng_lbl_watermark_setting_opt');
			if( !empty($shpng_wtrmrk) && isset( $shpng_wtrmrk ['rtwwcpig_watermark_img_url'] ) )
			{
				if(get_option('rtwwcpig_shpng_lbl_watermark_image_trans') != '')
				{ 
					$rtwwcpig_alpha_img = get_option('rtwwcpig_shpng_lbl_watermark_image_trans');
				}
				else
				{
					$rtwwcpig_alpha_img = 0.2;
				}
				$rtwwcpig_watermark_img_dim ='D';
				if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') == 'P') 
				{
					$rtwwcpig_watermark_img_dim = 'P';
				}
				if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' &&  get_option('rtwwcpig_pckngslp_watermark_img_dim') =='F')
				{
					$rtwwcpig_watermark_img_dim = 'F';
				}
				if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') =='INT')
				{
					$rtwwcpig_watermark_img_dim = get_option('rtwwcpig_watermark_img_dim');
					$rtwwcpig_watermark_img_dim = (int)$rtwwcpig_watermark_img_dim ; 
				}
				if(get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') =='array')
				{
					$rtwwcpig_watermark_img_dim = array(get_option('rtwwcpig_shpng_lbl_water_img_dim_width'),get_option('rtwwcpig_shpng_lbl_water_img_dim_height'));
				}
				$rtwwcpig_watermark_pos = 'P';
				if(get_option('rtwwcpig_shpng_lbl_watermark_img_pos') != '' && get_option('rtwwcpig_shpng_lbl_watermark_img_pos') =='F')
				{
					$rtwwcpig_watermark_pos='F';	
				}
				if(get_option('rtwwcpig_shpng_lbl_watermark_img_pos') !='' && get_option('rtwwcpig_shpng_lbl_watermark_img_pos') =='arrays')
				{
					$rtwwcpig_watermark_pos=array(get_option('rtwwcpig_shpng_lbl_watermark_img_pos_x'),get_option('rtwwcpig_shpng_lbl_watermark_img_pos_y'));
				}
				$rtwwcpig_mpdf->SetWatermarkImage($shpng_wtrmrk ['rtwwcpig_watermark_img_url'],$rtwwcpig_alpha_img,$rtwwcpig_watermark_img_dim , $rtwwcpig_watermark_pos);
				$rtwwcpig_mpdf->showWatermarkImage = true;
			}	
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_enable_creditnote_image_watermark') !='' && get_option('rtwwcpig_enable_creditnote_image_watermark') == 'yes' )
		{
			$credit_wtrmrk = get_option('rtwwcpig_creditnote_watermark_setting_opt');
			if( !empty($credit_wtrmrk) && isset( $credit_wtrmrk ['rtwwcpig_watermark_img_url'] ) )
			{
				if(get_option('rtwwcpig_creditnote_watermark_image_trans') != '')
				{ 
					$rtwwcpig_alpha_img = get_option('rtwwcpig_creditnote_watermark_image_trans');
				}
				else
				{
					$rtwwcpig_alpha_img = 0.2;
				}
				$rtwwcpig_watermark_img_dim ='D';
				if( get_option('rtwwcpig_creditnote_watermark_img_dim') != '' && get_option('rtwwcpig_creditnote_watermark_img_dim') == 'P') 
				{
					$rtwwcpig_watermark_img_dim = 'P';
				}
				if( get_option('rtwwcpig_creditnote_watermark_img_dim') != '' &&  get_option('rtwwcpig_creditnote_watermark_img_dim') =='F')
				{
					$rtwwcpig_watermark_img_dim = 'F';
				}
				if( get_option('rtwwcpig_creditnote_watermark_img_dim') != '' && get_option('rtwwcpig_creditnote_watermark_img_dim') =='INT')
				{
					$rtwwcpig_watermark_img_dim = get_option('rtwwcpig_watermark_img_dim');
					$rtwwcpig_watermark_img_dim = (int)$rtwwcpig_watermark_img_dim ; 
				}
				if(get_option('rtwwcpig_creditnote_watermark_img_dim') != '' && get_option('rtwwcpig_creditnote_watermark_img_dim') =='array')
				{
					$rtwwcpig_watermark_img_dim = array(get_option('rtwwcpig_creditnote_water_img_dim_width'),get_option('rtwwcpig_creditnote_water_img_dim_height'));
				}
				$rtwwcpig_watermark_pos = 'P';
				if(get_option('rtwwcpig_creditnote_watermark_img_pos') != '' && get_option('rtwwcpig_creditnote_watermark_img_pos') =='F')
				{
					$rtwwcpig_watermark_pos='F';	
				}
				if(get_option('rtwwcpig_creditnote_watermark_img_pos') !='' && get_option('rtwwcpig_creditnote_watermark_img_pos') =='arrays')
				{
					$rtwwcpig_watermark_pos=array(get_option('rtwwcpig_creditnote_watermark_img_pos_x'),get_option('rtwwcpig_creditnote_watermark_img_pos_y'));
				}
				$rtwwcpig_mpdf->SetWatermarkImage($credit_wtrmrk ['rtwwcpig_watermark_img_url'],$rtwwcpig_alpha_img,$rtwwcpig_watermark_img_dim , $rtwwcpig_watermark_pos);
				$rtwwcpig_mpdf->showWatermarkImage = true;
			}	
		}
	}
	else
	{
		if ( get_option('rtwwcpig_show_completed_watermark') == 'yes' ) 
		{
			if ( $rtwwcpig_order->get_status() == 'completed' ) 
			{
				$rtwwcpig_mpdf->SetWatermarkImage(RTWWCPIG_URL.'assets/paid-stamp.png',0.2,'D','P');
				$rtwwcpig_mpdf->showWatermarkImage = true;
			}
		}
		else
		{
			if( get_option('rtwwcpig_enable_image_watermark') !='' && get_option('rtwwcpig_enable_image_watermark') == 'yes' )
			{
				$watermark_img = get_option('rtwwcpig_watermark_setting_opt');
				if( isset( $watermark_img['rtwwcpig_watermark_img_url'] ) && !empty($watermark_img['rtwwcpig_watermark_img_url']) )
				{
					if(get_option('rtwwcpig_watermark_image_trans') != '')
					{ 
						$rtwwcpig_alpha_img = get_option('rtwwcpig_watermark_image_trans');
					}
					else
					{
						$rtwwcpig_alpha_img = 0.2;
					}
					$rtwwcpig_watermark_img_dim ='D';
					if( get_option('rtwwcpig_watermark_img_dim') != '' && get_option('rtwwcpig_watermark_img_dim') == 'P') 
					{
						$rtwwcpig_watermark_img_dim = 'P';
					}
					if( get_option('rtwwcpig_watermark_img_dim') != '' &&  get_option('rtwwcpig_watermark_img_dim') =='F')
					{
						$rtwwcpig_watermark_img_dim = 'F';
					}
					if( get_option('rtwwcpig_watermark_img_dim') != '' && get_option('rtwwcpig_watermark_img_dim') =='INT')
					{
						$rtwwcpig_watermark_img_dim = get_option('rtwwcpig_watermark_img_dim');
						$rtwwcpig_watermark_img_dim = (int)$rtwwcpig_watermark_img_dim ; 
					}
					if(get_option('rtwwcpig_watermark_img_dim') != '' && get_option('rtwwcpig_watermark_img_dim') =='array')
					{
						$rtwwcpig_watermark_img_dim = array(get_option('rtwwcpig_water_img_dim_width'),get_option('rtwwcpig_water_img_dim_height'));
					}
					$rtwwcpig_watermark_pos = 'P';
					if(get_option('rtwwcpig_watermark_img_pos') != '' && get_option('rtwwcpig_watermark_img_pos') =='F')
					{
						$rtwwcpig_watermark_pos='F';	
					}
					if(get_option('rtwwcpig_watermark_img_pos') !='' && get_option('rtwwcpig_watermark_img_pos') =='arrays')
					{
						$rtwwcpig_watermark_pos=array(get_option('rtwwcpig_watermark_img_pos_x'),get_option('rtwwcpig_watermark_img_pos_y'));
					}
					$rtwwcpig_mpdf->SetWatermarkImage($watermark_img['rtwwcpig_watermark_img_url'],0.2,$rtwwcpig_watermark_img_dim , $rtwwcpig_watermark_pos);
					$rtwwcpig_mpdf->showWatermarkImage = true;
				}	
			}
		}
	}
	
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if( get_option('rtwwcpig_shpng_lbl_rtl') != '' && get_option('rtwwcpig_shpng_lbl_rtl') == 'yes'){
			$rtwwcpig_mpdf->SetDirectionality('rtl');
		}else{
			$rtwwcpig_mpdf->SetDirectionality('ltr');
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if( get_option('rtwwcpig_credit_note_rtl') != '' && get_option('rtwwcpig_credit_note_rtl') == 'yes'){
			$rtwwcpig_mpdf->SetDirectionality('rtl');
		}else{
			$rtwwcpig_mpdf->SetDirectionality('ltr');
		}
	}
	else
	{
		if( get_option('rtwwcpig_rtl') != '' && get_option('rtwwcpig_rtl') == 'yes'){
			$rtwwcpig_mpdf->SetDirectionality('rtl');
		}else{
			$rtwwcpig_mpdf->SetDirectionality('ltr');
		}
	}
	
	if( get_option('rtwwcpig_enable_paswrd') != '' && get_option('rtwwcpig_enable_paswrd') == 'yes')
	{
		if( get_option('rtwwcpig_admin_pswrd') != '')
		{
			$rtwwcpig_admin_pswrd = get_option('rtwwcpig_admin_pswrd');
		}
		else
		{
			$rtwwcpig_admin_pswrd = 12345678;
		}
		if (get_option('rtwwcpig_add_pswrd_protctn') != '' && get_option('rtwwcpig_add_pswrd_protctn') == 'protctn_type_ordr_id') 
		{
			$rtwwcpig_pswrd_pdf = $rtwwcpig_ordr_id;
		}
		if(get_option('rtwwcpig_add_pswrd_protctn') != '' && get_option('rtwwcpig_add_pswrd_protctn') == 'protctn_type_email')
		{ 
			$rtwwcpig_pswrd_pdf = $rtwwcpig_user_email;
		}
	}

	//$rtwwcpig_mpdf->showImageErrors = true;
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		if ( !is_dir ( RTWWCPIG_PDF_SHPNGLBL_DIR ) ) 
		{
			mkdir ( RTWWCPIG_PDF_SHPNGLBL_DIR, 0755, true );
		}
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		if ( !is_dir ( RTWWCPIG_CREDITNOTE_DIR ) ) 
		{
			mkdir ( RTWWCPIG_CREDITNOTE_DIR, 0755, true );
		}
	}
	else
	{
		if ( !is_dir ( RTWWCPIG_PDF_DIR ) ) 
		{
			mkdir ( RTWWCPIG_PDF_DIR, 0755, true );
		}
	}
	try
	{ 
		$rtwwcpig_mpdf->autoScriptToLang = true;
		$rtwwcpig_mpdf->autoLangToFont = true;
		$basic_setting = get_option('rtwwcpig_basic_setting_opt', array());
		if ( isset($basic_setting['back_color']) && $basic_setting['back_color'] != '' ) {
			$rtwwcpig_mpdf->SetDefaultBodyCSS('background-color', $basic_setting['back_color']);
		}
		if ( isset($basic_setting['bck_img_url']) && $basic_setting['bck_img_url'] != '' ) {
			$rtwwcpig_mpdf->SetDefaultBodyCSS('background', "url(".$basic_setting['bck_img_url'].")");
			$rtwwcpig_mpdf->SetDefaultBodyCSS('background-image-resize', 6);
		}
		if ( $rtwwcpig_pro_desc != 'credit_note' && $rtwwcpig_pro_desc != 'Shipping_label') {
			if(get_option('rtwwcpig_enable_paswrd') == 'yes' && ($rtwwcpig_pswrd_pdf != '' || $rtwwcpig_admin_pswrd != '')){
				$rtwwcpig_mpdf->SetProtection(array(), $rtwwcpig_pswrd_pdf , $rtwwcpig_admin_pswrd);
			}
		}
		
		$rtwwcpig_pdf_html = do_shortcode( $rtwwcpig_pdf_html );
		$rtwwcpig_mpdf->WriteHTML($rtwwcpig_pdf_html);
		$rtwwcpig_mpdf->Output($rtwwcpig_file_path,'F');	
	}
	catch( Exception $rtwwcpig_excptn)
	{
		print_r($rtwwcpig_excptn);
	}
	if( $rtwwcpig_pro_desc == 'Shipping_label' )
	{
		$rtwwcpig_Dir_path = RTWWCPIG_PDF_DIR.'/rtwwcpig_shipping_label/rtwwcpig_shiping_lbl_'.$rtwwcpig_ordr_id.'.pdf';
		$rtwwcpig_file_url = RTWWCPIG_PDF_URL.'/rtwwcpig_shipping_label/rtwwcpig_shiping_lbl_'.$rtwwcpig_ordr_id.'.pdf';
	}
	else if ( $rtwwcpig_pro_desc == 'credit_note' ) 
	{
		$rtwwcpig_Dir_path = RTWWCPIG_CREDITNOTE_DIR.$rtwwcpig_ordr_id.'.pdf';
		$rtwwcpig_file_url = RTWWCPIG_CREDITNOTE_URL.$rtwwcpig_ordr_id.'.pdf';
	}
	else
	{
		$rtwwcpig_Dir_path = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_ordr_id.'.pdf';
		$rtwwcpig_file_url = RTWWCPIG_PDF_URL.$pdf_name.$rtwwcpig_ordr_id.'.pdf';
	}
	
	$rtwwcpig_pdf_file_name = $pdf_name.$rtwwcpig_ordr_id.'.pdf';
	
	$rtwwcpig_pdf_invoice = array('dir_path' => $rtwwcpig_Dir_path, 'file_url' => $rtwwcpig_file_url);

	return $rtwwcpig_pdf_invoice;
}

/**
 * function for convrt amount in words.
 *
 * @since    1.0.0
 */
function rtwwcpig_convert_amount_in_words($rtwwcpig_amount)
{

	if (CURRENCY && CURRENCY == 'INR' ) 
	{
		$obj = new IndianCurrency($rtwwcpig_amount);
		return $obj->get_words();
	}
	else
	{
		$hyphen      = '-';
    $conjunction = ' ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($rtwwcpig_amount)) {
        return false;
    }

    if (($rtwwcpig_amount >= 0 && (int) $rtwwcpig_amount < 0) || (int) $rtwwcpig_amount < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($rtwwcpig_amount < 0) {
        return $negative . rtwwcpig_convert_amount_in_words(abs($rtwwcpig_amount));
    }

    $string = $fraction = null;

    if (strpos($rtwwcpig_amount, '.') !== false) {
        list($rtwwcpig_amount, $fraction) = explode('.', $rtwwcpig_amount);
    }

    switch (true) {
        case $rtwwcpig_amount < 21:
        
            $string = $dictionary[$rtwwcpig_amount];
            break;
        case $rtwwcpig_amount < 100:
        
            $tens   = ((int) ($rtwwcpig_amount / 10)) * 10;
            $units  = $rtwwcpig_amount % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $rtwwcpig_amount < 1000:
       
            $hundreds  = $rtwwcpig_amount / 100;
            $remainder = $rtwwcpig_amount % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . rtwwcpig_convert_amount_in_words($remainder);
            }
            break;
        default:
        
            $baseUnit = pow(1000, floor(log($rtwwcpig_amount, 1000)));
            $numBaseUnits = (int) ($rtwwcpig_amount / $baseUnit);
            $remainder = $rtwwcpig_amount % $baseUnit;
            $string = rtwwcpig_convert_amount_in_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= rtwwcpig_convert_amount_in_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $rtwwcpig_amount) {
            $words[] = $dictionary[$rtwwcpig_amount];
        }
        $string .= implode(' ', $words);

    }

    return $string;
	}

}

/**
 * function for create packing slip for an order.
 *
 * @since    1.0.0
 */
function rtwwcpig_create_pdf_packngslip($rtwwcpig_ordr_no,$rtwwcpig_ordr_obj)
{
	$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

	if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
	{
		$rtwwcpig_order = wc_get_order( $rtwwcpig_ordr_no );
		$currency_code = $rtwwcpig_ordr_obj->get_currency();
		$rtwwcpig_currency_symbol = get_woocommerce_currency_symbol( $currency_code );
		$tax_name = array();
		$rtwwcpig_product_qty = array();
		$prod_qty[] = array();
		if ( get_option( 'rtwwcpig_dsply_crrncy_smbl' ) == 'yes' ) {
			define('CURRENCY', $rtwwcpig_ordr_obj->get_currency());
			$currency_code = $rtwwcpig_ordr_obj->get_currency();
			$rtwwcpig_currency_symbol = get_woocommerce_currency_symbol( $currency_code );
		}else{
			$rtwwcpig_currency_symbol = '';
		}
		if ($rtwwcpig_order->get_items( 'tax' ) != '') 
    	{
    		foreach ($rtwwcpig_order->get_items( 'tax' ) as $rtwwcpig_key => $rtwwcpig_value) {
				$rtwwcpig_item_type = $rtwwcpig_value->get_type(); // Line item type
			    $rtwwcpig_item_name = $rtwwcpig_value->get_name(); // Line item name
			    $rtwwcpig_rate_code = $rtwwcpig_value->get_rate_code(); // Tax rate code
			    $rtwwcpig_tax_rate_label[] = $rtwwcpig_value->get_label(); // Tax label
			    $rtwwcpig_tax_rate_id[] = $rtwwcpig_value->get_rate_id(); // Tax rate ID
			    $rtwwcpig_compound = $rtwwcpig_value->get_compound(); // Tax compound
			    $rtwwcpig_tax_amount_total = $rtwwcpig_value->get_tax_total(); // Tax rate total
			    $rtwwcpig_tax_shipping_total[] = $rtwwcpig_value->get_shipping_tax_total();
			    $rtwwcpig_total_tax_rate[] = $rtwwcpig_value->get_rate_percent();
			}
    	}
		foreach( $rtwwcpig_order->get_items() as $rtwwcpig_item_key => $rtwwcpig_item_values )
		{
			$prod_sku = new WC_Product($rtwwcpig_item_values->get_product_id());
			if (  rtwwcpig_woo_product_bundled_compatibility() ) 
			{
				if ( $prod_sku->get_sku() ) 
				{
					$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax();
					$rtwwcpig_tax_class = $rtwwcpig_item_values->get_tax_class(); // Tax class
					if ( $rtwwcpig_tax_class !== '' ) 
					{
						$data[] = WC_Tax::get_rates_for_tax_class( $rtwwcpig_tax_class );
						foreach ($data as $k => $val) {
							foreach ($rtwwcpig_tax_rate_id as $key => $rate_id) {
								if ( isset($val[$rate_id]) && !empty($val[$rate_id]) ) {
									$tax_name[] = $val[$rate_id];
								}
							}
						}
					}else{
						$tax_name[] = '';
					}
					$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
					$qty[] = $rtwwcpig_item_values->get_quantity();
					if ( !array_key_exists($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) ) {
						$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
					}else{
						$rtwwcpig_product_qty[' '.$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
					}
					$prod_qty[] = $rtwwcpig_item_values->get_quantity();
					$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
					$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
		    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();

		    		if ($rtwwcpig_prduct_vrtion_id){

		    			$rtwwcpig_prduct = wc_get_product($rtwwcpig_item_values->get_variation_id());

		    		}else{

		    			$rtwwcpig_prduct = wc_get_product($rtwwcpig_item_values->get_product_id());
		    		}
		    		$rtwwcpig_prdct_img[] = $rtwwcpig_prduct->get_image(array( 50,50 ));
				}
			}
			else
			{
				$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax();
				$rtwwcpig_tax_class = $rtwwcpig_item_values->get_tax_class(); // Tax class
				if ( $rtwwcpig_tax_class !== '' ) 
				{
					$data[] = WC_Tax::get_rates_for_tax_class( $rtwwcpig_tax_class );
					foreach ($data as $k => $val) {
						foreach ($rtwwcpig_tax_rate_id as $key => $rate_id) {
							if ( isset($val[$rate_id]) && !empty($val[$rate_id]) ) {
								$tax_name[] = $val[$rate_id];
							}
						}
					}
				}else{
					$tax_name[] = '';
				}
				$prod_qty[] = $rtwwcpig_item_values->get_quantity();
				$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
				if ( !array_key_exists($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) ) {
					$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
				}else{
					$rtwwcpig_product_qty[' '.$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
				}
				$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
				$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
	    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();		
	    	}
    	}

    	if ($rtwwcpig_product_id != '') 
		{
			foreach ($rtwwcpig_product_id as $rtwwcpig_k => $rtwwcpig_v) 
			{
				$rtwwcpig_pro = new WC_Product( $rtwwcpig_v );
				$product_weight[] = $rtwwcpig_pro->get_weight();
				$rtwwcpig_sku[] = $rtwwcpig_pro->get_sku();
				$rtwwcpig_prodct_price[] = $rtwwcpig_pro->get_price();
				$rtwwcpig_prdct_img[] = $rtwwcpig_pro->get_image(array( 50,50 ));
				
			}
		}

    	if ( !empty($tax_name) ) {
    		$tax_string = array();
    		foreach ($tax_name as $name_key => $name_value) {
    			if ( is_object($name_value) && !empty($name_value) ) {
    				$tax_string[] = $name_value->tax_rate_name.' ( '.(int)$name_value->tax_rate.'% )';
    			}
    		}
    	}else{
    		$tax_string[] = '0.00%';
    	}
		$width = get_option('rtwwcpig_prod_img_width');
		$height = get_option('rtwwcpig_prod_img_height');
		if ( $width == '' ) {
			$width = 50;
		}
		if ( $height == '' ) {
			$height = 50;
		}

		$rtwwcpig_pckng_slp_formt = get_option('pckng_slp_format');
		if( $rtwwcpig_pckng_slp_formt == '')
		{
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
			$rtwwcpig_pckng_slp_formt = '
			<table class="invhead" style="width: 100%; font-size: 14px; border: none;">
				<tbody>
					<tr>
						<td style="width: 40%; border: none; padding: 15px;">
							<div class="rtwcpig-logo"><img class="alignnone" style="margin-bottom: 15px;" alt="shop logo" width="100" height="100" /></div>
							</td>
							<td style="width: 60%; border: none; padding: 15px;">
							<p style="margin: 5px 0;"><span style="display: inline-block; width: 120px;">Order No:</span> [order_id]</p>
							<p style="margin: 5px 0;"><span style="display: inline-block; width: 120px;">Order Date:</span> [order_date]</p>
							<p style="margin: 5px 0;"><span style="display: inline-block; width: 120px;">Total Items:</span> [total_items]</p>
							<p style="margin: 5px 0;"><span style="display: inline-block; width: 120px;">Total Products:</span> [total_products]</p>
							<p style="margin: 5px 0;"><span style="display: inline-block; width: 120px;">Order Amount:</span> [order_amount]</p>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="rtwcpig-invoice-wrapper"><br />
				<table style="width: 100%; border-collapse: collapse; border: 1px solid #b08c77; font-size: 13px;">
					<thead>
						<tr>
							<th style="color: #000000; padding: 15px 10px; font-weight: bold; margin: 5px 5px 5px 0px; text-align: left; border: 1px solid #b08c77; background-color: #5ee3b6; font-size: 15px;">Seller Address</th>
							<th style="color: #000000; padding: 15px 10px; font-weight: bold; margin: 5px 5px 5px 0px; text-align: left; border: 1px solid #b08c77; background-color: #5ee3b6; font-size: 15px;">Billing Address</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="width: 50%; border: 1px solid #b08c77; padding: 10px;">
								<p><strong>RedefiningTheWeb</strong></p>
								<p>100 MAIN ST. SEATTLE WA,98104, USA</p>
								<p>www.redefiningtheweb.com</p>
								<p>Phone: 987-654-032</p>
								<p>E-mail: developer@redefiningtheweb.com</p>
								</td>
								<td style="width: 50%; border: 1px solid #b08c77; padding: 10px;">
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
							<th style="width: 100px; font-size: 15px; padding: 15px 10px; text-align: left; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Line No.</th>
							<th style="width: 150px; padding: 15px 10px; text-align: left; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Product SKU</th>
							<th style="width: 110px; font-size: 15px; text-align: center; padding: 15px 10px; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Product</th>
							<th style="width: 110px; font-size: 15px; text-align: center; padding: 15px 10px; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Price</th>
							<th style="width: 110px; font-size: 15px; text-align: center; padding: 15px 10px; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Tax Amount</th>
							<th style="width: 110px; font-size: 15px; text-align: center; padding: 15px 10px; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Quantity</th>
							<th style="width: 110px; font-size: 15px; text-align: center; padding: 15px 10px; border-bottom: 1px solid #b08c77; border-top: 1px solid #b08c77; background-color: #5ee3b6; color: #000000;">Line Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[line_number]</td>
							<td style="padding: 10px; border-bottom: 2px solid #dddddd; text-align: left; color: #444444;">[product_sku]</td>
							<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_name]</td>
							<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_price]</td>
							<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[tax_amount]</td>
							<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[product_qty]</td>
							<td style="text-align: center; padding: 10px; border-bottom: 2px solid #dddddd; color: #444444;">[line_total]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div style="width: 100%; float: left; font-size: 11px;"><hr />
				<p>Terms &amp; Conditions:</p>
				<ol>
					<li>Goods once sold can be exchanged within 7 days of delivery.</li>
					<li>No cash refund.</li>
				</ol>
				<p>Please joins us on Facebook at https://www.facebook.com/RedefiningTheWeb/</p>
			</div>';
		}

		$rtwwcpig_data = array();
		$rtwwcpig_data['shipping_method'] = $rtwwcpig_ordr_obj->get_shipping_method();
		$rtwwcpig_data['shipping_first_name'] =	$rtwwcpig_ordr_obj->get_shipping_first_name();
		if( $rtwwcpig_data['shipping_first_name'] == '' )
		{
			$rtwwcpig_data['shipping_first_name'] = $rtwwcpig_ordr_obj->get_billing_first_name();
		}
		$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_ordr_obj->get_shipping_last_name();
		if( $rtwwcpig_data['shipping_last_name'] == '' )
		{
			$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_ordr_obj->get_billing_last_name();
		}
		$rtwwcpig_data['shipping_company'] = $rtwwcpig_ordr_obj->get_shipping_company();
		if( $rtwwcpig_data['shipping_company'] == '' )
		{
			$rtwwcpig_data['shipping_company'] = $rtwwcpig_ordr_obj->get_billing_company();
		}
		$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_ordr_obj->get_shipping_address_1();
		if( $rtwwcpig_data['shipping_address_1'] == '' )
		{
			$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_ordr_obj->get_billing_address_1();
		}
		$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_ordr_obj->get_shipping_address_2();
		if( $rtwwcpig_data['shipping_address_2'] == '' )
		{
			$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_ordr_obj->get_billing_address_2();
		}
		$rtwwcpig_data['shipping_city'] = $rtwwcpig_ordr_obj->get_shipping_city();
		if( $rtwwcpig_data['shipping_city'] == '' )
		{
			$rtwwcpig_data['shipping_city'] = $rtwwcpig_ordr_obj->get_billing_city();
		}
		$rtwwcpig_data['shipping_state'] = $rtwwcpig_ordr_obj->get_shipping_state();
		if( $rtwwcpig_data['shipping_state'] == '' )
		{
			$rtwwcpig_data['shipping_state'] = $rtwwcpig_ordr_obj->get_billing_state();
		}
		$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_ordr_obj->get_shipping_postcode();
		if( $rtwwcpig_data['shipping_postcode'] == '' )
		{
			$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_ordr_obj->get_billing_postcode();
		}
		$rtwwcpig_data['shipping_country'] = $rtwwcpig_ordr_obj->get_shipping_country();
		if( $rtwwcpig_data['shipping_country'] == '' )
		{
			$rtwwcpig_data['shipping_country'] = $rtwwcpig_ordr_obj->get_billing_country();
		}
		$rtwwcpig_data['billing_first_name'] = $rtwwcpig_ordr_obj->get_billing_first_name();
		$rtwwcpig_data['billing_last_name'] = $rtwwcpig_ordr_obj->get_billing_last_name();
		$rtwwcpig_data['billing_address_1'] = $rtwwcpig_ordr_obj->get_billing_address_1();
		$rtwwcpig_data['billing_address_2'] = $rtwwcpig_ordr_obj->get_billing_address_2();
		$rtwwcpig_data['billing_city'] = $rtwwcpig_ordr_obj->get_billing_city();
		$rtwwcpig_data['billing_state'] = $rtwwcpig_ordr_obj->get_billing_state();
		$rtwwcpig_data['billing_postcode'] = $rtwwcpig_ordr_obj->get_billing_postcode();
		$rtwwcpig_data['billing_email'] = $rtwwcpig_ordr_obj->get_billing_email();
		$rtwwcpig_data['billing_phone'] = $rtwwcpig_ordr_obj->get_billing_phone();
		$rtwwcpig_data['billing_country'] = $rtwwcpig_ordr_obj->get_billing_country();
		$rtwwcpig_data['order_amount'] = $rtwwcpig_ordr_obj->get_total();
		$rtwwcpig_data['customer_note'] = $rtwwcpig_ordr_obj->get_customer_note();
		$rtwwcpig_data['payment_method'] = $rtwwcpig_ordr_obj->get_payment_method_title();
		$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_ordr_obj->get_total()), 'rtwwcpig-woocommerce-pdf-invoice-generator');
		$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
		$rtwwcpig_shpng_total  = $rtwwcpig_ordr_obj->get_shipping_total();
		if ( $rtwwcpig_shpng_total == '' ) {
			$rtwwcpig_shpng_total = 0.00;
		}
		$rtwwcpig_shipping_tax = $rtwwcpig_order->get_shipping_tax();
		if ( $rtwwcpig_shipping_tax == '' ) {
			$rtwwcpig_shipping_tax = 0.00;
		}
		$rtwwcpig_shpng_amnt   = ( $rtwwcpig_shpng_total + $rtwwcpig_shipping_tax );
		if ( $rtwwcpig_ordr_obj->get_total_tax() == '' ) {
			$get_total_tax = 0.00;
		}else{
			$get_total_tax = $rtwwcpig_ordr_obj->get_total_tax();
		}
		$rtwwcpig_data['subtotal_amount'] = ( (int)$rtwwcpig_ordr_obj->get_total() - (int)($rtwwcpig_shpng_amnt + $get_total_tax) );
		$rtwwcpig_order = wc_get_order( $rtwwcpig_ordr_no );
		$rtwwcpig_order_data = $rtwwcpig_order->get_data();
		$rtwwcpig_data['order_date'] = $rtwwcpig_order_data['date_created']->date('d-m-Y H:i:s');
		if(rtwwcpig_woo_seq_order_no_compatibility()) {
			$rtwwcpig_data['order_id'] = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_ordr_no , $rtwwcpig_ordr_obj);
		}else{
			$rtwwcpig_data['order_id'] = $rtwwcpig_ordr_no;
		}
		$rtwwcpig_data['total_items'] = $rtwwcpig_order->get_item_count();
		$rtwwcpig_data['total_products'] = count(WC()->cart->get_cart());

		$rtwwcpig_pckng_slp_formt = stripslashes($rtwwcpig_pckng_slp_formt);
		if($rtwwcpig_pckng_slp_formt != '')
		{	
			foreach ($rtwwcpig_data as $rtwwcpig_k => $rtwwcpig_v) 
			{
				if ($rtwwcpig_k == 'order_amount' ) 
				{
					$rtwwcpig_v = $rtwwcpig_currency_symbol.' '.($rtwwcpig_v);
					$rtwwcpig_pckng_slp_formt = str_replace('['.$rtwwcpig_k.']', $rtwwcpig_v, $rtwwcpig_pckng_slp_formt);
				}
				$rtwwcpig_pckng_slp_formt = str_replace('['.$rtwwcpig_k.']', $rtwwcpig_v, $rtwwcpig_pckng_slp_formt);
			}
		}
		if (! class_exists ( 'simple_html_dom_node' )) 
		{
			require_once (RTWWCPIG_DIR .'/includes/simplehtmldom/simple_html_dom.php');
		}

		$rtwwcpig_pckng_slp_formt = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_pckng_slp_formt, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
		$rtwwcpig_count = 0;
		$line_numb = 1;
		$rtwwcpig_string2 = '';
		$rtwwcpig_dom = new simple_html_dom ();
		$rtwwcpig_dom->load ( $rtwwcpig_pckng_slp_formt );
		$rtwwcpig_prod_tr = '';
		$rtwwcpig_count = 0;
		foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody tr') as $val) 
		{
			$rtwwcpig_prod_tr = $val->outertext;
		}
		$rtwwcpig_prod_tr_final = '';

		$rtwwcpig_count = 0; 
		$line_numb = 1 ; 

		if ($rtwwcpig_product_qty != '') 
		{
			foreach ($rtwwcpig_product_qty as $key => $value) 
			{
				$rtwwcpig_prod_tr_final .= str_replace(array('[line_number]','[product_img]','[product_sku]','[product_name]','[product_price]','[tax_amount]','[product_qty]','[net_weight]','[line_total]'), array($line_numb,$rtwwcpig_prdct_img[$rtwwcpig_count],$rtwwcpig_sku[$rtwwcpig_count],$key,$rtwwcpig_currency_symbol.' '.($rtwwcpig_prodct_price[$rtwwcpig_count]),$rtwwcpig_total_tax[$rtwwcpig_count],$value,$rtwwcpig_currency_symbol.' '.wc_format_decimal(($rtwwcpig_prodct_price[$rtwwcpig_count] * $value),2)), $rtwwcpig_prod_tr);
				$rtwwcpig_count = ++$rtwwcpig_count;
				$line_numb = ++$line_numb;
			}
		}

		$rtwwcpig_dom = new simple_html_dom ();
		$rtwwcpig_dom->load ( $rtwwcpig_pckng_slp_formt );
		foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody') as $val) 
		{
			$val->outertext = $rtwwcpig_prod_tr_final;
		}

		$rtwwcpig_pckng_slp_formt = $rtwwcpig_dom->save();
		$rtwwcpig_pdf_pckngslp = rtwwcpig_convert_pckng_slp_to_pdf($rtwwcpig_pckng_slp_formt, $rtwwcpig_ordr_no);
	}
}
/**
 * function for provide download invoice link in order detail page to the user.
 *
 * @since    1.0.0
 */
function rtwwcpig_user_invoice_link($rtwwcpig_order)
{
	$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

	if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
	{
		$rtwwcpig_order_id = $rtwwcpig_order->get_id();
		$rtwwcpig_url = RTWWCPIG_PDF_URL.'rtwwcpig_'.$rtwwcpig_order_id.'.pdf';
		$rtwwcpig_dir = RTWWCPIG_PDF_DIR.'rtwwcpig_'.$rtwwcpig_order_id.'.pdf';

		if(file_exists($rtwwcpig_dir))
		{
			$rtwwcpig_status = $rtwwcpig_order->get_status();
			if($rtwwcpig_status == 'completed' )
			{
				if(get_option('rtwwcpig_regular_invoice') =='yes' && (is_user_logged_in() == true ) && get_option('rtwwcpig_dsply_dwnlod_on_ordr_detail_page') =='yes')
				{
					$rtwwcpig_button = '<p id="rtwwcpig_img_btn"><a href="'.esc_url($rtwwcpig_url).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'">' .
					'<img src="'.esc_url(RTWWCPIG_URL.'assets/download_pdf.png').'" alt="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" >' .
					'<span>'. esc_html__('Download Normal Invoice' ,'rtwwcpig-woocommerce-pdf-invoice-generator').'</span>' .
					'</a></p>';
					/** This is for displaying the button **/
					echo $rtwwcpig_button;
				}
			}
			else
			{
				if (get_option('rtwwcpig_proforma_invoice') =='yes' && get_option('rtwwcpig_dwnld_prfrma_order_detail') == 'yes') 
				{
					$rtwwcpig_button = '<p id="rtwwcpig_img_btn"><a href="'.esc_url($rtwwcpig_url).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'">' .
					'<img src="'.esc_url(RTWWCPIG_URL.'assets/download_pdf.png').'" alt="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" >' .
					'<span>'. esc_html__('Download Proforma Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'</span>' .
					'</a></p>';
					/** This is for displaying the button **/
					echo $rtwwcpig_button;
				}
			}
		}
	}
}
/**
 * function for provide download link in my_account page.
 *
 * @since    1.0.0
 */
function rtwwcpig_orders_actions($rtwwcpig_action, $rtwwcpig_odr)
{
	$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

	if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
	{
		$rtwwcpig_order_id = $rtwwcpig_odr->get_id();
		if ( $rtwwcpig_odr->get_status() == 'completed' ) 
		{
			if (get_option('rtwwcpig_allow_dwnlod_frm_my_acnt') == 'yes' && get_option('rtwwcpig_regular_invoice') == 'yes') 
			{
				$rtwwcpig_url = RTWWCPIG_PDF_URL.'rtwwcpig_'.$rtwwcpig_order_id.'.pdf';
				$rtwwcpig_title = 'Normal Invoice';
			}	
		}
		else
		{
			if (get_option('rtwwcpig_allow_proforma_dwnlod_frm_my_accnt') == 'yes' && get_option('rtwwcpig_proforma_invoice') == 'yes') 
			{
				$rtwwcpig_url = RTWWCPIG_PDF_URL.'rtwwcpig_'.$rtwwcpig_order_id.'.pdf';
				$rtwwcpig_title = 'Proforma Invoice';
			}
		}
		if (isset($rtwwcpig_url) && isset($rtwwcpig_title)) 
		{
			$rtwwcpig_action['invoice'] = array(
				'url' => $rtwwcpig_url,
				'name' => $rtwwcpig_title,
			);
		}
		return $rtwwcpig_action;
	}else{
		return $rtwwcpig_action;
	}
}

/**
 * function for create pdf for paking slip.
 *
 * @since    1.0.0
 */
function rtwwcpig_convert_pckng_slp_to_pdf($rtwwcpig_pdf_html, $rtwwcpig_ordr_id)
{
	error_reporting(0);
	ini_set('display_errors', 0);
	$rtwwcpig_file_path = RTWWCPIG_PDF_PCKNGSLP_DIR . '/rtwwcpig_'.$rtwwcpig_ordr_id.'.pdf';
	$rtwwcpig_pdf_html .= '<style>';
	
	if (get_option('rtwwcpig_pckngslp_pdf_css') != '')
	{
		$rtwwcpig_pdf_html .= get_option('rtwwcpig_pckngslp_pdf_css');
	}
	$rtwwcpig_pdf_html .= '</style>';
	
	if( get_option('rtwwcpig_pckngslp_css_setting_opt') != '')
	{ 
		$rtwwcpig_page = get_option('rtwwcpig_pckngslp_css_setting_opt');
		$rtwwcpig_page_size = $rtwwcpig_page['rtwwcpig_pdf_page_size'];
	}
	else
	{
		$rtwwcpig_page_size = serialize(array(210,297));
	}
	if( get_option('rtwwcpig_pckngslp_page_orien') != '' ) {
		$rtwwcpig_page_orientation = get_option('rtwwcpig_pckngslp_page_orien');
	} else {
		$rtwwcpig_page_orientation = 'P';
	}
	if( get_option('rtwwcpig_pckngslp_body_left_margin') !='' ) {
		$rtwwcpig_lft_marg = get_option('rtwwcpig_pckngslp_body_left_margin');	
	} else {
		$rtwwcpig_lft_marg = 15;
	}
	if( get_option('rtwwcpig_pckngslp_body_right_margin') !='' ) {
		$rtwwcpig_rgt_marg = get_option('rtwwcpig_pckngslp_body_right_margin');	
	} else {
		$rtwwcpig_rgt_marg = 15;
	}
	if( get_option('rtwwcpig_pckngslp_body_top_margin') !='' ) {
		$rtwwcpig_top_marg = get_option('rtwwcpig_pckngslp_body_top_margin');	
	} else {
		$rtwwcpig_top_marg = 15;
	}
	if( get_option('rtwwcpig_pckngslp_header_top_margin') !='' ) {
		$rtwwcpig_hdr_top_marg = get_option('rtwwcpig_pckngslp_header_top_margin');	
	} else {
		$rtwwcpig_hdr_top_marg = 7;
	}
	/*PDF footer top margin*/
	if( get_option('rtwwcpig_pckngslp_footer_top_margin') !='' ) {
		$rtwwcpig_foo_top_marg = get_option('rtwwcpig_pckngslp_footer_top_margin');	
	} else {
		$rtwwcpig_foo_top_marg = 15;
	}
	if( get_option('rtwwcpig_pckngslp_body_font_family') !='' ) {
		$rtwwcpig_body_font_family = get_option('rtwwcpig_pckngslp_body_font_family');
	} else{
		$rtwwcpig_body_font_family = "dejavusanscondensed";
	}
	if(get_option('rtwwcpig_pckngslp_body_font_size') !='' ) {
		$rtwwcpig_body_font_size = get_option('rtwwcpig_pckngslp_body_font_size');
	} else{
		$rtwwcpig_body_font_size = 10;
	}
	include(RTWWCPIG_DIR ."includes/mpdf/autoload.php"); 
	$rtwwcpig_mpdf = new \Mpdf\Mpdf( ['mode' => 'utf-8', 'format' => unserialize( $rtwwcpig_page_size ), 'default_font_size' => $rtwwcpig_body_font_size, 'default_font' => $rtwwcpig_body_font_family, 'margin_left' => $rtwwcpig_lft_marg, 'margin_right' => $rtwwcpig_rgt_marg, 'margin_top' => $rtwwcpig_top_marg, 'margin_bottom' => '20', 'margin_header' => $rtwwcpig_hdr_top_marg, 'margin_footer' => $rtwwcpig_foo_top_marg, 'orientation' => $rtwwcpig_page_orientation ]);
	$rtwwcpig_mpdf->setAutoTopMargin = 'stretch';
	$rtwwcpig_mpdf->setAutoBottomMargin = 'stretch';
	$rtwwcpig_mpdf->SetDisplayMode('fullpage');
	if( get_option('rtwwcpig_pkngslp_header_font_size') !='' ) {
		$rtwwcpig_hdr_font_size = get_option('rtwwcpig_pkngslp_header_font_size');
	} else {
		$rtwwcpig_hdr_font_size = 20;
	}
	if( get_option('rtwwcpig_pkngslp_header_font') !='' ) {
		$rtwwcpig_hdr_font_family = get_option('rtwwcpig_pkngslp_header_font');
	} else{
		$rtwwcpig_hdr_font_family = 'sans-serif';
	}
	$rtwwcpig_mpdf->defaultheaderfontsize = $rtwwcpig_hdr_font_size;
	$rtwwcpig_mpdf->defaultheaderfontstyle = $rtwwcpig_hdr_font_family;
	$rtwwcpig_mpdf->defaultheaderline = 1;
	$rtwwcpig_site_name=get_bloginfo ( 'name' );
	$rtwwcpig_site_desc=get_bloginfo ( 'description' );
	$rtwwcpig_site_url=home_url();

	//***$rtwwcpig_stng['rtw_header_html'] this variable is used for HTML***//

	if(get_option('rtwwcpig_pkngslp_header_stng_opt') != '')
	{
		$rtwwcpig_hedr = get_option('rtwwcpig_pkngslp_header_stng_opt');
		$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_hedr['rtw_header_html'].'</h2></div>', 'O' );
		$rtwwcpig_mpdf->SetHTMLHeader('<div style=""><h2 style="margin-top:'.esc_attr($rtwwcpig_hdr_top_marg).';padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_stng['rtw_header_html'].'</h2></div>', 'E');
	}
	else
	{
		$rtwwcpig_mpdf->SetHTMLHeader('<div style="width:100%;height:70px;border-bottom: 2px solid #000000;"><div style="float:left;"><h2 style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_site_name.'</h2><p style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.esc_html__($rtwwcpig_site_desc, 'rtwwcpig-woocommerce-pdf-invoice-generator').'</p><p style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_site_url.'</p></div></div>','O');
		$rtwwcpig_mpdf->SetHTMLHeader('<div style="width:100%;height:70px;border-bottom: 2px solid #000000;"><div style="float:left;"><h2 style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_site_name.'</h2><p style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.esc_html__($rtwwcpig_site_desc, 'rtwwcpig-woocommerce-pdf-invoice-generator').'</p><p style="margin:0px;padding:0px;font-size:'.esc_attr($rtwwcpig_hdr_font_size).'px;font-family:'.esc_attr($rtwwcpig_hdr_font_family).';">'.$rtwwcpig_site_url.'</p></div></div>','E');
	}
	if( get_option('rtwwcpig_pckngslp_footer_font_size') !='' ) {
		$rtwwcpig_foo_font_size = get_option('rtwwcpig_pckngslp_footer_font_size');
	} else {
		$rtwwcpig_foo_font_size = 10;
	}
	if(get_option('rtwwcpig_pckngslp_footer_font_family') !='' ) {
		$rtwwcpig_foo_family = get_option('rtwwcpig_pckngslp_footer_font_family');
	} else {
		$rtwwcpig_foo_family = 'sans-serif';
	}
	$rtwwcpig_mpdf->defaultfooterfontsize = $rtwwcpig_foo_font_size;	/* in pts */
	$rtwwcpig_mpdf->defaultfooterfontstyle = $rtwwcpig_foo_family;	/* blank, B, I, or BI */
	$rtwwcpig_mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
	if( get_option('rtwwcpig_pckngslp_footer_setting_opt') != '') {
		$rtwwcpig_footer = get_option('rtwwcpig_pckngslp_footer_setting_opt');
		$rtwwcpig_footer_txt = $rtwwcpig_footer['rtw_footer_html'];
	} else {
		$rtwwcpig_footer_txt = '';
	}
	if (get_option('rtwwcpig_pkng_slp_page_no') !='' && get_option('rtwwcpig_pkng_slp_page_no') == 'yes' ) 
	{
		$rtwwcpig_page_no = '' ;
	}
	else
	{
		$rtwwcpig_page_no = '{PAGENO}/{nbpg}';
	}
	//***  $rtwwcpig_footer_txt this variable is used for HTML ***//
	$rtwwcpig_mpdf->SetHTMLFooter( '<div style="width:100%;margin:0px;padding:0px;"><div style="width: 92%;margin-top:'.esc_attr($rtwwcpig_foo_top_marg).';font-size:'.esc_attr($rtwwcpig_foo_font_size).';font-family:'.esc_attr($rtwwcpig_foo_family).'">'.$rtwwcpig_footer_txt.'</div><div style="width: ;margin:0px;padding:0px;float:;text-align:;">'.$rtwwcpig_page_no.'</div>', 'O' );
	$rtwwcpig_mpdf->SetHTMLFooter( '<div style="width:100%;margin:0px;padding:0px;margin-top:2px;padding-top:10px"><div style="width: 92%;margin-top:'.esc_attr($rtwwcpig_foo_top_marg).';font-size:'.esc_attr($rtwwcpig_foo_font_size).'">'.$rtwwcpig_footer_txt.'</div><div style="width: 8%;margin:0px;padding:0px;float:;text-align:;">'.$rtwwcpig_page_no.'</div>', 'E' );
	if( get_option('rtwwcpig_enable_pckngslp_text_watermark') !='' && get_option('rtwwcpig_enable_pckngslp_text_watermark') == 'yes' )
	{
		if( get_option('rtwwcpig_pckngslp_watermark_text') != '' )
		{
			$rtwwcpig_alpha = 0.2;
			if( get_option('rtwwcpig_pckngslp_watermark_text_trans') != '' )
			{
				$rtwwcpig_alpha = get_option('rtwwcpig_pckngslp_watermark_text_trans');
			}
			if(get_option('rtwwcpig_pckngslp_watermark_rotation') !='')
			{
				$GLOBALS['rotate']= get_option('rtwwcpig_pckngslp_watermark_rotation');
			}
			$rtwwcpig_mpdf->SetWatermarkText( trim(get_option('rtwwcpig_pckngslp_watermark_text')),$rtwwcpig_alpha );
			$rtwwcpig_mpdf->showWatermarkText = true;
			if( get_option('rtwwcpig_pckngslp_watermark_font') )
			{
				$rtwwcpig_mpdf->watermark_font = get_option('rtwwcpig_pckngslp_watermark_font');
			}
		}	
	}
	$rtwwcpig_wtrmrk_img = get_option('rtwwcpig_pckngslp_watermark_setting_opt');	
	if( get_option('rtwwcpig_enable_pckngslp_image_watermark') == 'yes' )
	{
		if(isset($rtwwcpig_wtrmrk_img['rtwwcpig_watermark_img_url']) && $rtwwcpig_wtrmrk_img['rtwwcpig_watermark_img_url'] != '')
		{
			if(get_option('rtwwcpig_pckngslp_watermark_image_trans') != '')
			{ 
				$rtwwcpig_alpha_img = get_option('rtwwcpig_pckngslp_watermark_image_trans');
			}
			else
			{
				$rtwwcpig_alpha_img = 0.2;
			}
			$rtwwcpig_watermark_img_dim ='D';
			if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') == 'P') 
			{
				$rtwwcpig_watermark_img_dim = 'P';
			}
			if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' &&  get_option('rtwwcpig_pckngslp_watermark_img_dim') =='F')
			{
				$rtwwcpig_watermark_img_dim = 'F';
			}
			if( get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') =='INT')
			{
				$rtwwcpig_watermark_img_dim = get_option('rtwwcpig_pckngslp_watermark_img_dim');
				$rtwwcpig_watermark_img_dim = (int)$rtwwcpig_watermark_img_dim ; 
			}
			if(get_option('rtwwcpig_pckngslp_watermark_img_dim') != '' && get_option('rtwwcpig_pckngslp_watermark_img_dim') =='array')
			{
				$rtwwcpig_watermark_img_dim = array(get_option('rtwwcpig_pckngslp_water_img_dim_width'),get_option('rtwwcpig_pckngslp_water_img_dim_height'));
			}
			$rtwwcpig_watermark_pos = 'P';
			if(get_option('rtwwcpig_pckngslp_watermark_img_pos') != '' && get_option('rtwwcpig_pckngslp_watermark_img_pos') =='F')
			{
				$rtwwcpig_watermark_pos='F';	
			}
			if(get_option('rtwwcpig_pckngslp_watermark_img_pos') !='' && get_option('rtwwcpig_pckngslp_watermark_img_pos') =='arrays')
			{
				$rtwwcpig_watermark_pos=array(get_option('rtwwcpig_pckngslp_watermark_img_pos_x'),get_option('rtwwcpig_pckngslp_watermark_img_pos_y'));
			}
			$rtwwcpig_mpdf->SetWatermarkImage($rtwwcpig_wtrmrk_img['rtwwcpig_watermark_img_url'],$rtwwcpig_alpha_img,$rtwwcpig_watermark_img_dim , $rtwwcpig_watermark_pos);
			$rtwwcpig_mpdf->showWatermarkImage = true;
		}	
	}
	if( get_option('rtwwcpig_pkng_slp_rtl') != '' && get_option('rtwwcpig_pkng_slp_rtl') == 'yes')
	{
		$rtwwcpig_mpdf->SetDirectionality('rtl');
	}
	else
	{
		$rtwwcpig_mpdf->SetDirectionality('ltr');
	}
	//$rtwwcpig_mpdf->showImageErrors = true;
	if ( !is_dir ( RTWWCPIG_PDF_PCKNGSLP_DIR ) ) 
	{
		mkdir ( RTWWCPIG_PDF_PCKNGSLP_DIR, 0755, true );
	}
	$rtwwcpig_bck_img = get_option('rtwwcpig_pkngslp_basic_stng_opt');
	$rtwwcpig_bck_img_url = $rtwwcpig_bck_img['bck_img_url'];
	$rtwwcpig_bck_color = $rtwwcpig_bck_img['back_color'];
	try
	{ 
		$rtwwcpig_mpdf->SetDefaultBodyCSS('background', "url(".$rtwwcpig_bck_img_url.")");
		$rtwwcpig_mpdf->autoScriptToLang = true;
		$rtwwcpig_mpdf->autoLangToFont = true;
		$rtwwcpig_mpdf->SetDefaultBodyCSS('background-image-resize', 6);
		$rtwwcpig_mpdf->SetDefaultBodyCSS('background-color', $rtwwcpig_bck_color);
		$rtwwcpig_pdf_html = do_shortcode( $rtwwcpig_pdf_html );
		$rtwwcpig_mpdf->WriteHTML($rtwwcpig_pdf_html);
		$rtwwcpig_mpdf->Output($rtwwcpig_file_path,'F');	
	}
	catch( Exception $rtwwcpig_excptn)
	{
		print_r($rtwwcpig_excptn);
	}
	$rtwwcpig_Dir_path = RTWWCPIG_PDF_PCKNGSLP_DIR . '/packing_slip/rtwwcpig_'.$rtwwcpig_ordr_id.'.pdf';
	$rtwwcpig_file_url = RTWWCPIG_PDF_PCKNGSLP_URL . '/packing_slip/rtwwcpig_'.$rtwwcpig_ordr_id.'.pdf';
	$rtwwcpig_pdf_file_name = 'rtwwcpig_'.$rtwwcpig_ordr_id.'.pdf';
	$rtwwcpig_pdf_1 = array('dir_path' => $rtwwcpig_Dir_path, 'file_url' => $rtwwcpig_file_url);
	return $rtwwcpig_pdf_1;
}

//Convert Number to Indian Currency Format
class IndianCurrency
{

  	public function __construct($amount)
  	{
	    $this->amount=$amount;
	    $this->hasPaisa=false;
	    $arr=explode(".",$this->amount);
	    $this->rupees=$arr[0];
    	if(isset($arr[1])&&((int)$arr[1])>0){
      		if(strlen($arr[1])>2){
        		$arr[1]=substr($arr[1],0,2);
      		}
      		$this->hasPaisa=true;
      		$this->paisa=$arr[1];
    	}
  	}
  
  	public function get_words(){
	    $w="";
	    $crore=(int)($this->rupees/10000000);
	    $this->rupees=$this->rupees%10000000;
	    $w.=$this->single_word($crore,"Cror ");
	    $lakh=(int)($this->rupees/100000);
	    $this->rupees=$this->rupees%100000;
	    $w.=$this->single_word($lakh,"Lakh ");
	    $thousand=(int)($this->rupees/1000);
	    $this->rupees=$this->rupees%1000;
	    $w.=$this->single_word($thousand,"Thousand  ");
	    $hundred=(int)($this->rupees/100);
	    $w.=$this->single_word($hundred,"Hundred ");
	    $ten=$this->rupees%100;
	    $w.=$this->single_word($ten,"");
	    $w.="Rupees ";
    	if($this->hasPaisa){
      		if($this->paisa[0]=="0"){
        		$this->paisa=(int)$this->paisa;
      		}
      		else if(strlen($this->paisa)==1){
        		$this->paisa=$this->paisa*10;
      		}
      		$w.=" and ".$this->single_word($this->paisa," Paisa");
    	}
    	return $w;
  	}

  	private function single_word($n,$txt){
    	$t="";
	    if($n<=19){
	      $t=$this->words_array($n);
	    }else{
	      $a=$n-($n%10);
	      $b=$n%10;
	      $t=$this->words_array($a)." ".$this->words_array($b);
	    }
	    if($n==0){
	      $txt="";
	    }
    	return $t." ".$txt;
  	}

  private function words_array($num){
    	$n=[0=>"", 1=>"One", 2=>"Two", 3=>"Three", 4=>"Four", 5=>"Five", 6=>"Six", 7=>"Seven", 8=>"Eight", 9=>"Nine", 10=>"Ten", 11=>"Eleven", 12=>"Twelve", 13=>"Thirteen", 14=>"Fourteen", 15=>"Fifteen", 16=>"Sixteen", 17=>"Seventeen", 18=>"Eighteen", 19=>"Nineteen", 20=>"Twenty", 30=>"Thirty", 40=>"Forty", 50=>"Fifty", 60=>"Sixty", 70=>"Seventy", 80=>"Eighty", 90=>"Ninety", 100=>"Hundred",];
    	return $n[$num];
  	}
}

/**
*  Function For send sms notification.
*
* @since    1.1.0
*/
function rtwwcpig_send_sms_notification($rtwwcpig_order)
{
	$rtwwcpig_sms_notification_array = get_option('rtwwcpig_sms_setting_opt', array());
	if ( isset($rtwwcpig_sms_notification_array['rtwwcpig_sms_notification']) && $rtwwcpig_sms_notification_array['rtwwcpig_sms_notification'] != '' ) 
	{
		$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
		if ( !$pdf_name || $pdf_name == '' ) {
			$pdf_name = 'rtwwcpig_';
		}
		$rtwwcpig_file_url = RTWWCPIG_PDF_DIR.'/'. $pdf_name.$rtwwcpig_order.'.pdf';
		
		$rtwwcpig_sms_acount_id = (isset($rtwwcpig_sms_notification_array['twilio_sid']) && $rtwwcpig_sms_notification_array['twilio_sid']) ? $rtwwcpig_sms_notification_array['twilio_sid'] : "";
		$rtwwcpig_auth_token = (isset($rtwwcpig_sms_notification_array['twilio_auth_token']) && $rtwwcpig_sms_notification_array['twilio_auth_token']) ? $rtwwcpig_sms_notification_array['twilio_auth_token'] : "";
		$rtwwcpig_sms_phone_number = (isset($rtwwcpig_sms_notification_array['twilio_phone_no']) && $rtwwcpig_sms_notification_array['twilio_phone_no']) ? $rtwwcpig_sms_notification_array['twilio_phone_no'] : "";
		$rtwwcpig_order_obj = wc_get_order($rtwwcpig_order);
		$customer_mob = $rtwwcpig_order_obj->get_billing_phone();
		if ( file_exists($rtwwcpig_file_url) ) {
			$rtwwcpig_msg = 'Your PDF invoice has been generated successfully.you can view it from here: '.$rtwwcpig_file_url.'&From='.$rtwwcpig_sms_phone_number.'&To='.$customer_mob;
		}else{
			$rtwwcpig_msg = 'Your PDF invoice has been generated successfully.&From='.$rtwwcpig_sms_phone_number.'&To='.$customer_mob;
		}
		$rtwwcpig_url = "https://api.twilio.com/2010-04-01/Accounts/".$rtwwcpig_sms_acount_id."/Messages.json";

		$rtwwcpig_curl = curl_init();
		$rtwwcpig_curl_header = array(
			"api-version: alpha",
			"cache-control: no-cache",
			"content-type: application/x-www-form-urlencoded",
			"Authorization: Basic ".base64_encode($rtwwcpig_sms_acount_id.":".$rtwwcpig_auth_token)
		);

		curl_setopt($rtwwcpig_curl, CURLOPT_HEADER, false);
		curl_setopt($rtwwcpig_curl, CURLOPT_NOBODY, false);
		curl_setopt($rtwwcpig_curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($rtwwcpig_curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($rtwwcpig_curl, CURLOPT_TIMEOUT, 4);
		curl_setopt($rtwwcpig_curl, CURLOPT_SSL_VERIFYPEER, FALSE); // Validate SSL certificate
		curl_setopt($rtwwcpig_curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($rtwwcpig_curl, CURLOPT_URL, $rtwwcpig_url);
		curl_setopt($rtwwcpig_curl, CURLOPT_HTTPHEADER, $rtwwcpig_curl_header);
		curl_setopt($rtwwcpig_curl, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($rtwwcpig_curl, CURLOPT_POSTFIELDS, 'Body='.$rtwwcpig_msg);

		$rtwwcpig_response = curl_exec($rtwwcpig_curl);
		$rtwwcpig_error = curl_error($rtwwcpig_curl);
		curl_close($rtwwcpig_curl);
	}
}

?>