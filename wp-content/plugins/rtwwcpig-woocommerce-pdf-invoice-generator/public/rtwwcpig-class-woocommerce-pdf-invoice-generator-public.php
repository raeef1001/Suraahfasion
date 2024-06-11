<?php
/**
 * The public-specific functionality of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/public
 */
/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-specific stylesheet and JavaScript.
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/public
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Public {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwwcpig_plugin_name    The ID of this plugin.
	 */
	private $rtwwcpig_plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rtwwcpig_version    The current version of this plugin.
	 */
	private $rtwwcpig_version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rtwwcpig_plugin_name       The name of this plugin.
	 * @param      string    $rtwwcpig_version    The version of this plugin.
	 */
	public function __construct( $rtwwcpig_plugin_name, $rtwwcpig_version ) {
		$this->rtwwcpig_plugin_name = $rtwwcpig_plugin_name;
		$this->rtwwcpig_version = $rtwwcpig_version;
	}

	/**
	 * Register the stylesheets for the public area.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 */
		wp_enqueue_style( $this->rtwwcpig_plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtwwcpig-woocommerce-pdf-invoice-generator-public.css', array(), $this->rtwwcpig_version, 'all' );
	}
	public function rtwwcpig_enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 */
		//wp_enqueue_script( $this->rtwwcpig_plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtwwcpig-woocommerce-pdf-invoice-generator-public.js', array(), $this->rtwwcpig_version, 'all' );
		wp_register_script( $this->rtwwcpig_plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtwwcpig-woocommerce-pdf-invoice-generator-public.js', array(), $this->rtwwcpig_version, 'all' );
			$rtwwcpig_ajax_nonce = wp_create_nonce( "rtwwcpig-ajax-security-string" );
			$rtwwcpig_translation_array 	= array(
										'rtwwcpig_ajaxurl' 	=> esc_url( admin_url( 'admin-ajax.php' ) ),
										'rtwwcpig_nonce' 	=> $rtwwcpig_ajax_nonce
									);
			wp_localize_script( $this->rtwwcpig_plugin_name, 'rtwwcpig_ajax_param', $rtwwcpig_translation_array );
			wp_enqueue_script( $this->rtwwcpig_plugin_name );
	}
	/*
	* function to download PDF Invoice.
	*/
	function rtwwcpig_invoice_download_callback(){
		if( isset( $_GET[ 'rtwwcpig_order_id' ] ) ){
			$rtwwcpig_file_name = 'rtwwcpig_'.$_GET[ 'rtwwcpig_order_id' ].'.pdf';
			$rtwwcpig_file_url 	= RTWWCPIG_PDF_URL.'/'. $rtwwcpig_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwwcpig_file_name."\""); 
			readfile( $rtwwcpig_file_url );
			exit;
		}
	}
    
	/**
	 * function for generate invoice.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_generate_invoice($rtwwcpig_odr_id, $rtwwcpig_posted_data, $rtwwcpig_odr_objct)
	{
		rtwwcpig_make_invoice($rtwwcpig_odr_id, $rtwwcpig_odr_objct);
		rtwwcpig_send_sms_notification($rtwwcpig_odr_id);
		return;
	}

	/**
	 * function for create packing slip for an order.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_create_packng_slip($rtwwcpig_ordr_no,$rtwwcpig_adrss,$rtwwcpig_ordr_obj)
	{
		$rtwwcpig_pkngslp_pdf = rtwwcpig_create_pdf_packngslip($rtwwcpig_ordr_no,$rtwwcpig_ordr_obj);
	}
	/**
	 * function for provide download invoice link in order detail page to the user.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_user_invoice_link($rtwwcpig_order)
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
			$pdf_name = 'rtwwcpig_';
			}
			global $wp;
			$rtwwcpig_order_id = apply_filters( 'rtwwcpig_change_order_id_for_invoice', $rtwwcpig_order->get_id() );
			$rtwwcpig_url = RTWWCPIG_PDF_URL.$pdf_name.$rtwwcpig_order_id.'.pdf';
			$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_order_id.'.pdf';
			$rtw_permalink = add_query_arg ( array( 'rtwwcpig_order_id' => $rtwwcpig_order_id ) , home_url( $wp->request ) );
			if(file_exists($rtwwcpig_dir))
			{
				$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
				if ( $btn_txt == '' ) {
					$btn_txt = 'Download PDF Invoice';
				}
				$rtwwcpig_status = $rtwwcpig_order->get_status();
				if($rtwwcpig_status == 'completed' )
				{
					if(get_option('rtwwcpig_regular_invoice') =='yes' && (is_user_logged_in() == true ) && get_option('rtwwcpig_dsply_dwnlod_on_ordr_detail_page') =='yes')
					{
						$rtwwcpig_button = '<p id="rtwwcpig_img_btn" data-rtwwcpig_order_id="'.$rtwwcpig_order_id.'"><a href="'.esc_url($rtw_permalink).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'">' .
						'<img src="'.esc_url(RTWWCPIG_URL.'assets/download_pdf.png').'" alt="'.esc_attr__( $btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator').'" >' .
						'<span>'. esc_html__($btn_txt ,'rtwwcpig-woocommerce-pdf-invoice-generator').'</span>' .
						'</a></p>';
						/** This is for displaying the button **/
						echo $rtwwcpig_button;
					}
				}
				else
				{
					if (get_option('rtwwcpig_proforma_invoice') =='yes' && get_option('rtwwcpig_dwnld_prfrma_order_detail') == 'yes') 
					{
						$rtwwcpig_button = '<p id="rtwwcpig_img_btn" data-rtwwcpig_order_id="'.$rtwwcpig_order_id.'"><a href="'.esc_url($rtw_permalink).'" target="_blank" data-tip="'.esc_attr__('Download Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'">' .
						'<img src="'.esc_url(RTWWCPIG_URL.'assets/download_pdf.png').'" alt="'.esc_attr__($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator').'" >' .
						'<span>'. esc_html__($btn_txt, 'rtwwcpig-woocommerce-pdf-invoice-generator').'</span>' .
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
	public function rtwwcpig_orders_actions($rtwwcpig_action, $rtwwcpig_odr)
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			global $wp;
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
			$pdf_name = 'rtwwcpig_';
			}
			$btn_txt = get_option( 'rtwwcpig_custm_btn_txt' );
			if ( $btn_txt == '' ) {
				$btn_txt = esc_html__('Download PDF Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator');
			}
			$rtwwcpig_order_id = $rtwwcpig_odr->get_id();
			if ( $rtwwcpig_odr->get_status() == 'completed' ) 
			{
				if (get_option('rtwwcpig_allow_dwnlod_frm_my_acnt') == 'yes' && get_option('rtwwcpig_regular_invoice') == 'yes') 
				{
					$rtwwcpig_url = add_query_arg('rtwwcpig_order_id',$rtwwcpig_order_id,home_url( $wp->request ));
					$rtwwcpig_title = $btn_txt;
				}	
			}
			else
			{
				if (get_option('rtwwcpig_allow_proforma_dwnlod_frm_my_accnt') == 'yes' && get_option('rtwwcpig_proforma_invoice') == 'yes') 
				{
					$rtwwcpig_url = add_query_arg('rtwwcpig_order_id',$rtwwcpig_order_id,home_url( $wp->request ));
					$rtwwcpig_title = $btn_txt;
				}
			}
			if (isset($rtwwcpig_url) && isset($rtwwcpig_title)) 
			{
				$rtwwcpig_action['rtwwcpig-invoice'] = array(
					'url' => $rtwwcpig_url,
					'name' => $rtwwcpig_title,
				);
			}
			return $rtwwcpig_action;
		}else{
			return $rtwwcpig_action;
		}
	}

	public function render_btn_for_mltivndr($rtwwcpig_btn, $rtwwcpig_order_obj)
    {
		$rtwwcpig_dir = RTWWCPIG_PDF_DIR."rtwwcpig_".$rtwwcpig_order_obj->get_id().'.pdf';
		$status = get_option( 'rtwwcpig_when_gnrate_invoice' , array() );
		if ( empty($status) ) {
			$status = 'processing';
		}
		if( $rtwwcpig_order_obj->get_status() == $status || $rtwwcpig_order_obj->get_status() == 'completed'){
			if ( file_exists($rtwwcpig_dir) ) {
	    		$rtwwcpig_url = RTWWCPIG_PDF_URL."rtwwcpig_".$rtwwcpig_order_obj->get_id().'.pdf';
	    		$rtwwcpig_btn .= "<a href='".esc_url($rtwwcpig_url)."' data-id='" . $rtwwcpig_order_obj->get_id() . "' class='rtwmer_order_invoice'><i class='fas fa-file-invoice rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Download invoice", "rtwwcpig-woocommerce-pdf-invoice-generator") . "</span></i></a>";
	    		
	    	}else{
				$rtwwcpig_btn .= "<a href='#' data-id='" . $rtwwcpig_order_obj->get_id() . "' class='rtwmer_order_generate_invoice'><i class='fas fa-file-invoice rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Generate invoice", "rtwwcpig-woocommerce-pdf-invoice-generator") . "</span></i></a>";	
			}
		}
		$rtwwcpig_package_dir = RTWWCPIG_PDF_PCKNGSLP_DIR."rtwwcpig_".$rtwwcpig_order_obj->get_id().'.pdf';
		if ( file_exists($rtwwcpig_package_dir) ) {
			$rtwwcpig_packaging_url = RTWWCPIG_PDF_PCKNGSLP_URL."rtwwcpig_".$rtwwcpig_order_obj->get_id().'.pdf';
			$rtwwcpig_btn .= "<a href='".esc_url($rtwwcpig_packaging_url)."' data-id='" . $rtwwcpig_order_obj->get_id() . "' class='rtwwcpig_packing_slip'><i class='fas fa-receipt rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Packing Slip", "rtwwcpig-woocommerce-pdf-invoice-generator") . "</span></i></a>";
			
		}else{
			$rtwwcpig_btn .= "<a href='#' data-id='" . $rtwwcpig_order_obj->get_id() . "' class='rtwwcpig_generate_packing_slip'><i class='fas fa-receipt rtwmer_tooltip' aria-hidden='true'><span class='rtwmer_tooltiptext'>" . esc_html__("Generate Packing Slip", "rtwwcpig-woocommerce-pdf-invoice-generator") . "</span></i></a>";
		}
		return $rtwwcpig_btn;
	}

	function rtwwcpig_create_invoice_cb(){
		if (check_ajax_referer("rtwwcpig-ajax-security-string", 'rtwwcpig_nonce')) {
			$rtwwcpig_order_id = $_POST["rtwwcpig_order_id"];
			$rtwwcpig_order_obj = wc_get_order($rtwwcpig_order_id);
			$rtwwcpig_file = rtwwcpig_make_invoice($rtwwcpig_order_id,$rtwwcpig_order_obj);
			$rtwwcpig_file["status"] = true;
			echo json_encode($rtwwcpig_file);
			die();
		}
	}

	public function rtwwcpig_create_packaging_cb(){
		if (check_ajax_referer("rtwwcpig-ajax-security-string", 'rtwwcpig_nonce')) {
			$rtwwcpig_order_id = $_POST["rtwwcpig_order_id"];
			$rtwwcpig_order_obj = wc_get_order($rtwwcpig_order_id);
			$rtwwcpig_file = rtwwcpig_create_pdf_packngslip($rtwwcpig_order_id,$rtwwcpig_order_obj);
			$rtwwcpig_file["status"] = true;
			echo json_encode($rtwwcpig_file);
			die();
		}
	}

	public function custom_add_to_cart_redirect() {
	    echo '<button class="data_button">Set Data</button>';
	}

	public function set_data_in_session_cb()
	{
		 echo "<pre>";
		 print_r(WC()->session);
		 echo "</pre>";
		 echo "<pre>";
		 print_r(WC()->session->get( 'cart_id' ));
		 echo "</pre>";
		 die();
	}
}
