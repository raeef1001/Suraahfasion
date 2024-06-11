<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/admin
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Admin {
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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_enqueue_styles() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the rtwwcpig_run() function
		 * defined in Woocommerce_Pdf_Invoice_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Pdf_Invoice_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */ 
		$rtwwcpig_screen 			= get_current_screen();
		$rtwwcpig_screen_id 		= $rtwwcpig_screen->id;
		$rtwwcpig_allowed_screens 	= array(
										'woocommerce_page_rtwwcpig-pdf-invoice-settings',
										'woocommerce_page_rtwwcpig-pdf-packing-slip-settings',
										'woocommerce_page_rtwwcpig-pdf-shipping-label-settings',
										'shop_order',
										'edit-shop_order',
										'woocommerce_page_rtwwcpig-pdf-credit-note-settings'
									);
		if( in_array( $rtwwcpig_screen_id, $rtwwcpig_allowed_screens ) )
		{
			wp_enqueue_style( $this->rtwwcpig_plugin_name, plugin_dir_url( __FILE__ ) . 'css/rtwwcpig-woocommerce-pdf-invoice-generator-admin.css', array(), $this->rtwwcpig_version, 'all' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'woo-admin-css', plugins_url( 'woocommerce/assets/css/admin.css' ), array(), $this->rtwwcpig_version, 'all' );
		}
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the rtwwcpig_run() function
		 * defined in Woocommerce_Pdf_Invoice_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Pdf_Invoice_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$rtwwcpig_screen = get_current_screen();
		if(isset($_GET['page']) && ($_GET['page'] == 'rtwwcpig-pdf-invoice-settings' || $_GET['page'] == 'rtwwcpig-pdf-packing-slip-settings') || $rtwwcpig_screen->id == 'shop_order' || $rtwwcpig_screen->id == 'edit-shop_order' || $rtwwcpig_screen->id == 'woocommerce_page_rtwwcpig-pdf-shipping-label-settings' || $rtwwcpig_screen->id == 'woocommerce_page_rtwwcpig-pdf-credit-note-settings')
		{
			wp_enqueue_script( 'wp-color-picker');
			wp_register_script( $this->rtwwcpig_plugin_name, plugin_dir_url( __FILE__ ) . 'js/rtwwcpig-woocommerce-pdf-invoice-generator-admin.js', array( 'jquery', 'wp-color-picker' ), $this->rtwwcpig_version, false );
			$rtwwcpig_ajax_nonce = wp_create_nonce( "rtwwcpig-ajax-security-string" );
			$rtwwcpig_translation_array 	= array(
										'rtwwcpig_ajaxurl' 	=> esc_url( admin_url( 'admin-ajax.php' ) ),
										'rtwwcpig_nonce' 	=> $rtwwcpig_ajax_nonce
									);
			wp_localize_script( $this->rtwwcpig_plugin_name, 'rtwwcpig_ajax_param', $rtwwcpig_translation_array );
			wp_enqueue_script( $this->rtwwcpig_plugin_name );
			wp_enqueue_script( "blockUI", plugins_url( 'woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js' ), array( 'jquery' ), $this->rtwwcpig_version, false );
			wp_enqueue_script( 'jquery.validate', RTWWCPIG_URL . 'assets/jquery/jquery.validate/jquery.validate.js', array( 'jquery' ), $this->rtwwcpig_version, false );
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script( 'html2canvas', plugin_dir_url( __FILE__ ) .'js/html2canvas.js','','',true);
			wp_enqueue_script( 'tipTip', plugins_url( 'woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js' ), array( 'jquery' ), $this->rtwwcpig_version, false );
		}
	}
	/**
	 * function for add custom menu in woocommerce menu page.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_add_menu_page() {
		add_submenu_page( 'woocommerce', 'PDF Invoice Settings', esc_html__('PDF Invoice Settings', 'rtwwcpig-woocommerce-pdf-invoice-generator'), 'manage_options', 'rtwwcpig-pdf-invoice-settings', array($this,'rtwwcpig_pdf_invoice_settings_callback') );
		add_submenu_page( 'woocommerce', 'PDF Packing Slip', esc_html__('PDF Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'), 'manage_options', 'rtwwcpig-pdf-packing-slip-settings', array($this,'rtwwcpig_pdf_packing_slip_callback') );
		add_submenu_page( 'woocommerce', 'PDF Shipping Label', esc_html__('PDF Shipping Label', 'rtwwcpig-woocommerce-pdf-invoice-generator'), 'manage_options', 'rtwwcpig-pdf-shipping-label-settings', array($this,'rtwwcpig_pdf_shipping_lable_callback') );
		add_submenu_page( 'woocommerce', 'PDF Credit Note', esc_html__('PDF Credit Note', 'rtwwcpig-woocommerce-pdf-invoice-generator'), 'manage_options', 'rtwwcpig-pdf-credit-note-settings', array($this,'rtwwcpig_pdf_credit_note_callback') );
	}
	/**
	 * function for display pdf invoice settings tabs on front end.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_pdf_invoice_settings_callback() {
		include_once(RTWWCPIG_DIR.'admin/partials/rtwwcpig-woocommerce-pdf-invoice-generator-admin-display.php');
	}
	/**
	 * function for display pdf packing slip settings tabs on front end.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_pdf_packing_slip_callback() {
		include_once(RTWWCPIG_DIR.'admin/partials/rtwwcpig-woocommerce-pdf-packing-slip-admin-display.php');
	}
	/**
	 * function for display pdf shipping lable settings tabs on front end.
	 *
	 * @since    1.2.0
	 */
	function rtwwcpig_pdf_shipping_lable_callback() {
		include_once(RTWWCPIG_DIR.'admin/partials/rtwwcpig-woocommerce-pdf-shipping-lable-admin-display.php');
	}
	/**
	 * function for display pdf shipping lable settings tabs on front end.
	 *
	 * @since    1.4.0
	 */
	function rtwwcpig_pdf_credit_note_callback() {
		include_once(RTWWCPIG_DIR.'admin/partials/rtwwcpig-woocommerce-pdf-credit-note-admin-display.php');
	}
	/**
	 * Adding Meta container admin shop_order pages.
	 *
	 * @since    1.0.0
	 */ 
	function rtwwcpig_add_meta_box($rtwwcpig_post_id, $rtwwcpig_param )
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			global $post;
			if( $post->post_type == 'shop_order' )
			{
				$rtwwcpig_order = wc_get_order( $rtwwcpig_param->ID );
				if ( get_option('rtwwcpig_enable_pkng_slp') == 'yes'  ) 
				{
					add_meta_box( 'pdf_packing_slip', esc_html__('Generate packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator'), array($this, 'rtwwcpig_packing_slip_metabox_callback'), 'shop_order', 'side', 'core' );
				}
				if ( (get_option('rtwwcpig_regular_invoice') == 'yes' && $rtwwcpig_order->get_status() == 'completed' && get_option('rtwwcpig_dwnld_edit_ordr_page') == 'yes') || (get_option('rtwwcpig_proforma_invoice') == 'yes' && $rtwwcpig_order->get_status() != 'completed' && get_option('rtwwcpig_allow_proforma_dwnlod') == 'yes' ) )
				{
					add_meta_box( 'pdf_invoice', esc_html__('PDF Invoices', 'rtwwcpig-woocommerce-pdf-invoice-generator'), array($this, 'rtwwcpig_pdf_invoice_metabox_callback'), 'shop_order', 'side', 'core');	
				}
				if ( (get_option('rtwwcpig_enable_shpng_lbl') == 'yes' ) )
				{
					add_meta_box( 'pdf_shipping_label', esc_html__('Shipping Label', 'rtwwcpig-woocommerce-pdf-invoice-generator'), array($this, 'rtwwcpig_shipping_label_metabox_callback'), 'shop_order', 'side', 'core' );
				}
			}
		}
	}
	/**
	 * Adding Meta field in the meta container admin shop_order pages.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_pdf_invoice_metabox_callback($post)
	{
		include(RTWWCPIG_DIR.'admin/partials/rtwwcpig_html/rtwwcpig_render_invoice_btn.php');
	}
	/**
	 * Adding Meta field in the meta container for shipping label in admin shop_order pages.
	 *
	 * @since    1.2.0
	 */
	function rtwwcpig_shipping_label_metabox_callback($post)
	{
		include(RTWWCPIG_DIR.'admin/partials/rtwwcpig_html/rtwwcpig_render_shipping_label_btn.php');
	}
	/**
	 * Adding Meta field in the meta container for packing slip in admin shop_order pages.
	 *
	 * @since    1.2.1
	 */
	function rtwwcpig_packing_slip_metabox_callback($post)
	{
		include(RTWWCPIG_DIR.'admin/partials/rtwwcpig_html/rtwwcpig_render_packing_slip_btn.php');
	}
	/*
	* Function to show settings link
	*/
	function rtwwcpig_add_setting_links( $rtwwcpig_links ){
		$rtwwcpig_links[] = '<a href="' . esc_url(admin_url( 'admin.php?page=rtwwcpig-pdf-invoice-settings' )) . '">'.esc_html__( 'Invoice Settings', 'rtwwcpig-woocommerce-pdf-invoice-generator' ).'</a>';
		$rtwwcpig_links[] = '<a href="' . esc_url(admin_url( 'admin.php?page=rtwwcpig-pdf-packing-slip-settings' )) . '">'.esc_html__( 'Packing Slip Settings', 'rtwwcpig-woocommerce-pdf-invoice-generator' ).'</a>';
		return $rtwwcpig_links;
	} 
	/*
	* function to download PDF Invoice.
	*/
	function rtwwcpig_invoice_regenerate_callback()
	{
		$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
		if ( !$pdf_name || $pdf_name == '' ) {
			$pdf_name = 'rtwwcpig_';
		}
		if( isset( $_GET[ 'rtwwcpig_order_id' ] ) )
		{
			$rtwwcpig_odr_id = $_GET[ 'rtwwcpig_order_id' ];
			if(rtwwcpig_woo_seq_order_no_compatibility())
			{
				$rtwwcpig_odr_objct = wc_get_order($_GET[ 'rtwwcpig_order_id' ]);
				$rtwwcpig_odr_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_odr_id , $rtwwcpig_odr_objct);
			}
			$rtwwcpig_file_name = $pdf_name.$rtwwcpig_odr_id.'.pdf';
			$rtwwcpig_file_url 	= RTWWCPIG_PDF_DIR.'/'. $rtwwcpig_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwwcpig_file_name."\""); 
			readfile( $rtwwcpig_file_url );
			exit;
		}else if (isset($_GET['rtwwcpig_packingslip_id']) && $_GET['rtwwcpig_packingslip_id'] != '') {
			$rtwwcpig_odr_id = $_GET[ 'rtwwcpig_packingslip_id' ];
			if(rtwwcpig_woo_seq_order_no_compatibility())
			{
				$rtwwcpig_odr_objct = wc_get_order($_GET[ 'rtwwcpig_packingslip_id' ]);
				$rtwwcpig_odr_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_odr_id , $rtwwcpig_odr_objct);
			}
			$rtwwcpig_file_name = 'rtwwcpig_'.$rtwwcpig_odr_id.'.pdf';
			$rtwwcpig_file_url 	= RTWWCPIG_PDF_DIR.'rtwwcpig_pckng_slip/'. $rtwwcpig_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwwcpig_file_name."\""); 
			readfile( $rtwwcpig_file_url );
			exit;
		}else if (isset($_GET['rtwwcpig_shipping_label']) && $_GET['rtwwcpig_shipping_label'] != '') {
			$rtwwcpig_file_name = 'rtwwcpig_shiping_lbl_'.$_GET[ 'rtwwcpig_shipping_label' ].'.pdf';
			$rtwwcpig_file_url 	= RTWWCPIG_PDF_DIR.'rtwwcpig_shipping_label/'. $rtwwcpig_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwwcpig_file_name."\""); 
			readfile( $rtwwcpig_file_url );
			exit;
		}else if(isset($_GET['rtwwcpig_credi_note']) && $_GET['rtwwcpig_credi_note'] != ''){
			$rtwwcpig_file_name = 'credi-note-'.$_GET[ 'rtwwcpig_credi_note' ].'.pdf';
			$rtwwcpig_file_url 	= RTWWCPIG_PDF_DIR.'credit_notes/'. $rtwwcpig_file_name;
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"".$rtwwcpig_file_name."\""); 
			readfile( $rtwwcpig_file_url );
			exit;
		}
	}
	/**
	 * Save admin settings.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_save_admin_setting()
	{
		register_setting('rtwwcpig_header_setting','rtwwcpig_header_setting_opt');
		register_setting('rtwwcpig_pckngslp_header_setting','rtwwcpig_pkngslp_header_stng_opt');
		register_setting('rtwwcpig_footer_setting','rtwwcpig_footer_setting_opt');
		register_setting('rtwwcpig_basic_setting','rtwwcpig_basic_setting_opt');
		register_setting('rtwwcpig_css_setting','rtwwcpig_css_setting_opt');
		register_setting('rtwwcpig_watermark_setting','rtwwcpig_watermark_setting_opt');
		register_setting('rtwwcpig_sms_setting','rtwwcpig_sms_setting_opt');
	}
	/**
	 * function for send email with invoice to the admin.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_send_invoice_on_mail($rtwwcpig_atchmnt, $rtwwcpig_mail_type, $rtwwcpig_ordr_obj)
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if( is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			if (!isset($rtwwcpig_mail_type) || !is_object($rtwwcpig_ordr_obj) || !is_a($rtwwcpig_ordr_obj, 'WC_Order')) 
			{
				return $rtwwcpig_atchmnt;
			}
			$order_id = $rtwwcpig_ordr_obj->get_id();
			$rtwwcpig_normal_invoice   = false;
			$rtwwcpig_proforma_invoice  = false;
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
				$pdf_name = 'rtwwcpig_';
			}
			$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$order_id.'.pdf';
			if ($rtwwcpig_mail_type == 'customer_refunded_order') 
			{
				$credit_note = RTWWCPIG_CREDITNOTE_DIR.'credi-note-'.$order_id.'.pdf';
				if (file_exists($credit_note))
				{
					$rtwwcpig_credit_note = true;
				}
			}
			if ($rtwwcpig_mail_type == 'customer_invoice') 
			{
				if (get_option('rtwwcpig_regular_invoice') == 'yes') 
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_normal_invoice = true;
					}
				}
				if (get_option('rtwwcpig_proforma_invoice') == 'yes') 
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_proforma_invoice = true;
					}
				}
			}
			else if ($rtwwcpig_mail_type == 'customer_on_hold_order') 
			{
				if (get_option('rtwwcpig_proforma_invoice') == 'yes' && get_option('rtwwcpig_attchd_profrma_ordr_mail') == 'yes' )
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_proforma_invoice = true;
					}
				}
			}
			else if ($rtwwcpig_mail_type == 'customer_processing_order')
			{
				if (get_option('rtwwcpig_regular_invoice') == 'yes' && get_option('rtwwcpig_atchd_ordr_mail') == 'yes')
				{
					if(file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_normal_invoice = true;
					}
				}
				if (get_option('rtwwcpig_proforma_invoice') == 'yes' && get_option('rtwwcpig_attchd_ordr_mail') == 'yes') 
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_proforma_invoice = true;
					}
				}
			}
			else if ($rtwwcpig_mail_type == 'customer_completed_order')
			{
				if (get_option('rtwwcpig_rtwwcpig_regular_invoice') == 'yes' && get_option('rtwwcpig_atchd_ordr_mail') == 'yes')
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_normal_invoice = true;
					}
				}
			}
			else if ($rtwwcpig_mail_type == 'new_order')
			{
				if (get_option('rtwwcpig_proforma_invoice') == 'yes' && get_option('rtwwcpig_attchd_ordr_mail') == 'yes')
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_proforma_invoice = true;
					}
				}
			}
			else if ($rtwwcpig_mail_type == 'partial_payment') 
			{
				if (get_option('rtwwcpig_proforma_invoice') == 'yes')
				{
					if (file_exists($rtwwcpig_dir))
					{
						$rtwwcpig_proforma_invoice = true;
					}
				}
			}
			if ($rtwwcpig_proforma_invoice = true)
			{
				if (!file_exists($rtwwcpig_dir)){
					return $rtwwcpig_atchmnt;
				}
				if (is_string($rtwwcpig_atchmnt) && empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt = $rtwwcpig_dir;
				}
				if (is_string($rtwwcpig_atchmnt) && !empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt .= PHP_EOL . $rtwwcpig_dir;
				}
				if (is_array($rtwwcpig_atchmnt)){
					array_push($rtwwcpig_atchmnt, $rtwwcpig_dir);
				}
				return $rtwwcpig_atchmnt ;
			}
			if ($rtwwcpig_normal_invoice = true)
			{
				if (empty($rtwwcpig_dir)){
					return $rtwwcpig_atchmnt;
				}
				if (is_string($rtwwcpig_atchmnt) && empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt = $rtwwcpig_dir;
				}
				if (is_string($rtwwcpig_atchmnt) && !empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt .= PHP_EOL . $rtwwcpig_dir;
				}
				if (is_array($rtwwcpig_atchmnt)){
					array_push($rtwwcpig_atchmnt, $rtwwcpig_dir);
				}
				return $rtwwcpig_atchmnt ;
			}
			if ( $rtwwcpig_credit_note == true ) 
			{
				if (empty($credit_note)){
					return $rtwwcpig_atchmnt;
				}
				if (is_string($rtwwcpig_atchmnt) && empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt = $credit_note;
				}
				if (is_string($rtwwcpig_atchmnt) && !empty($rtwwcpig_atchmnt)){
					$rtwwcpig_atchmnt .= PHP_EOL . $credit_note;
				}
				if (is_array($rtwwcpig_atchmnt)){
					array_push($rtwwcpig_atchmnt, $credit_note);
				}
				return $rtwwcpig_atchmnt ;
			}
		}
		else{
			return $rtwwcpig_atchmnt;
		}
	}
	/**
	 * function for provide download invoice link in order list page to the admin.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_admin_invoice_link($rtwwcpig_actn, $rtwwcpig_odr)
    {
    	$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			global $wp;
			if (!$rtwwcpig_odr) {
				return $rtwwcpig_actn;
			}
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
				$pdf_name = 'rtwwcpig_';
			}
			$rtwwcpig_order_id = $rtwwcpig_odr->get_id();
			if(rtwwcpig_woo_seq_order_no_compatibility())
			{
				$rtwwcpig_order = wc_get_order($rtwwcpig_odr->get_id());
				$rtwwcpig_order_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_odr->get_id() , $rtwwcpig_order);
			}
			$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_order_id.'.pdf';
			$rtwwcpig_ID = $rtwwcpig_odr->get_id();
			$rtwwcpig_url = add_query_arg('rtwwcpig_order_id',$rtwwcpig_odr->get_id(),home_url($wp->request));
			$rtwwcpig_pckng_slip = RTWWCPIG_PDF_PCKNGSLP_URL.'/rtwwcpig_'.$rtwwcpig_odr->get_id().'.pdf';
			$rtwwcpig_credinote_dir = RTWWCPIG_CREDITNOTE_DIR.'credi-note-'.$rtwwcpig_odr->get_id().'.pdf';
			$rtwwcpig_credinote_url = add_query_arg('rtwwcpig_credi_note',$rtwwcpig_odr->get_id(),home_url($wp->request));
			if ( file_exists($rtwwcpig_credinote_dir) ) {
				$rtwwcpig_credit_btn = '<a id="rtwwcpig_img_btn" class="rtw_btn" href="'.esc_url($rtwwcpig_credinote_url).'" data-tip="'.esc_attr__('Credit Note', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" download>' .
						'<img src="'.esc_url(RTWWCPIG_URL.'assets/images.png').'" alt="'.esc_attr__('Credit Note', 'rtwwcpig-woocommerce-pdf-invoice-generator').'"></a>';
						/** This is for displaying the button **/
						echo $rtwwcpig_credit_btn;
			}
			if ( $rtwwcpig_odr->get_status() != 'completed') 
			{
				if(get_option('rtwwcpig_proforma_invoice') =='yes' && get_option('rtwwcpig_dwnld_prfrma_order_list') == 'yes')
				{
					$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_order_id.'.pdf';
					if (file_exists($rtwwcpig_dir)) 
					{
						$rtwwcpig_dwnld_btn = '<a id="rtwwcpig_img_btn" class="rtw_btn" href="'.esc_url($rtwwcpig_url).'" data-tip="'.esc_attr__('Proforma Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" download>' .
						'<img src="'.esc_url(RTWWCPIG_URL.'assets/download.png').'" alt="'.esc_attr__('Proforma Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'"></a>';
						/** This is for displaying the button **/
						echo $rtwwcpig_dwnld_btn;
					}
			    }
			}
			else
			{
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_order_id.'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					if (get_option('rtwwcpig_regular_invoice') =='yes' && get_option('rtwwcpig_dsply_dwnlod_on_ordr_page') == 'yes') 
					{
						$rtwwcpig_dwnld_btn = '<a id="rtwwcpig_img_btn" class="rtw_btn" href="'.esc_url($rtwwcpig_url).'" data-tip="'.esc_attr__('Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" download>' .
						'<img src="'.esc_url(RTWWCPIG_URL.'assets/download.png').'" alt="'.esc_attr__('Normal Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator').'"></a>';
						/** This is for displaying the button **/
						echo $rtwwcpig_dwnld_btn;
					}
			    }
			}
			return $rtwwcpig_actn;
		}
		else
		{
			return $rtwwcpig_actn;
		}
    }
    /**
	 * function for provide download packing slip link in order list page.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_admin_pckng_slip_link($rtwwcpig_actn, $rtwwcpig_odr)
    {
    	$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			global $wp;
			if (!$rtwwcpig_odr) {
				return $rtwwcpig_actn;
			}
			$rtwwcpig_dir = RTWWCPIG_PDF_DIR.'rtwwcpig_'.$rtwwcpig_odr->get_id().'.pdf';
			$rtwwcpig_ID = $rtwwcpig_odr->get_id(); 
			$rtwwcpig_pckng_slip = add_query_arg('rtwwcpig_packingslip_id',$rtwwcpig_odr->get_id(),home_url($wp->request));
			$rtwwcpig_pckng_slp = RTWWCPIG_PDF_PCKNGSLP_DIR.'/rtwwcpig_'.$rtwwcpig_odr->get_id().'.pdf';
			if (file_exists($rtwwcpig_pckng_slp)) 
			{
				$rtwwcpig_dwnld_pckngslp_btn = '<a id="rtwwcpig_img_btn" class="rtw_btn" href="'.esc_url($rtwwcpig_pckng_slip).'" data-tip="'.esc_attr__('Download Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator').'" download>' .
				'<img src="'.esc_url(RTWWCPIG_URL.'assets/pckng.png').'" alt="'.esc_attr__('Packing Slip', 'rtwwcpig-woocommerce-pdf-invoice-generator').'"></a>';
				/** This is for displaying the button **/
				echo $rtwwcpig_dwnld_pckngslp_btn;
			}
			return $rtwwcpig_actn;
		}
		else
		{
			return $rtwwcpig_actn;
		}
	}
	/**
	 * function for regenerate pdf invoice when order status is changed.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_make_invoice_on_order_status_change($rtwwcpig_odr_id, $rtwwcpig_odr_objct)
    {
    	$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
		if ( !$pdf_name || $pdf_name == '' ) {
			$pdf_name = 'rtwwcpig_';
		}
		$rtwwcpig_file_url = RTWWCPIG_PDF_DIR.'/'. $pdf_name.$rtwwcpig_odr_id.'.pdf';
		if ( !file_exists($rtwwcpig_file_url) ) {
    		$rtwwcpig_pdf_invoice = rtwwcpig_make_invoice($rtwwcpig_odr_id, $rtwwcpig_odr_objct);
    		rtwwcpig_send_sms_notification($rtwwcpig_odr_id);
		}
		return;
    }
	/**
	 * function for add custom bulk action into woocoomerce action.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_add_bulk_action_in_orderlist($rtwwcpig_bulk_action)
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_bulk_action['bulk_pdf_invoice'] = esc_html__( 'Download Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator' );
			$rtwwcpig_bulk_action['bulk_credit_note'] = esc_html__( 'Create Credit Notes', 'rtwwcpig-woocommerce-pdf-invoice-generator' );
			$rtwwcpig_bulk_action['bulk_delete_invoice'] = esc_html__( 'Delete Invoices', 'rtwwcpig-woocommerce-pdf-invoice-generator' );
		}
		return $rtwwcpig_bulk_action;
	}
	/**
	 * function for handel custom bulk action.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_handle_bulk_action($rtwwcpig_redirect, $rtwwcpig_action, $rtwwcpig_post_ids)
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			if ( $rtwwcpig_action == 'bulk_credit_note' ) 
			{
				foreach ($rtwwcpig_post_ids as $rtwwcpig_key => $rtwwcpig_value) 
				{
				    $rtwwcpig_ordr_obj = wc_get_order( $rtwwcpig_value );
					if(rtwwcpig_woo_seq_order_no_compatibility())
					{
						$rtwwcpig_value = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_value , $rtwwcpig_ordr_obj);
					}
				    if ( $rtwwcpig_ordr_obj->get_status() == 'refunded' ) 
				    {
				    	$this->rtwwcpig_make_credit_note( $rtwwcpig_value, $rtwwcpig_ordr_obj );
				    }
				    else
				    {
				    	die('Please change the order status from '.$rtwwcpig_ordr_obj->get_status().' to Refunded.' );
				    }
				}
				return $rtwwcpig_redirect;
			}
			if ($rtwwcpig_action == 'bulk_pdf_invoice') 
			{
				if ( class_exists('ZipArchive') ) 
				{
					$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
					if ( $pdf_name == '' ) {
						$pdf_name = 'rtwwcpig_';
					}
					$rtwwcpig_output = ob_get_contents();
					ob_clean();
					$rtwwcpig_zip = new ZipArchive;
					$rtwwcpig_archive_file_name = $pdf_name.time().'.zip';
					if ($rtwwcpig_zip->open($rtwwcpig_archive_file_name, ZipArchive::CREATE) === TRUE) 
					{
						foreach ($rtwwcpig_post_ids as $rtwwcpig_key => $rtwwcpig_value) 
						{
							$rtwwcpig_file = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_value.'.pdf';
							if (file_exists($rtwwcpig_file)) {
								$rtwwcpig_zip->addFile($rtwwcpig_file, 'rtwwcpig_pdf_zip/'.$rtwwcpig_value);
							}else{
								$invoice_text = "PDF Invoice Does not Exist for Order No : ".$rtwwcpig_value.", Please unselect This Order.";
								esc_html_e( $invoice_text, 'rtwwcpig-woocommerce-pdf-invoice-generator' );
								die();
							}
						}	
					}
					$rtwwcpig_zip->close();
					header("Content-type: application/zip");
					header("Content-Disposition: attachment; filename=".$rtwwcpig_archive_file_name);
					header("Content-length: " . filesize($rtwwcpig_archive_file_name));
					header("Pragma: no-cache"); 
					header("Expires: 0"); 
					readfile($rtwwcpig_archive_file_name);
					unlink($rtwwcpig_archive_file_name);
					exit();
				}
			}
			if ( $rtwwcpig_action == 'bulk_delete_invoice' ) {
				$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
				if ( !$pdf_name || $pdf_name == '' ) {
					$pdf_name = 'rtwwcpig_';
				}
				foreach ($rtwwcpig_post_ids as $rtwwcpig_key => $rtwwcpig_value) {
					$rtwwcpig_file = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_value.'.pdf';
					if (file_exists($rtwwcpig_file)) {
						unlink($rtwwcpig_file);
					}
				}
				return $rtwwcpig_redirect;
			}
		}
	}
	/**
	 * function for delete pdf invoice.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_delete_invoice()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security_check' );
			if($rtwwcpig_check_ajax)
			{
				$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
				if ( $pdf_name == '' ) {
					$pdf_name = 'rtwwcpig_';
				}
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_ordr_id.'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					$rtwwcpig_unlink = unlink($rtwwcpig_dir);
					/** Response for ajax request  **/
					echo $rtwwcpig_unlink;
					die; 
				}
			}
		}
	}
	/**
	 * function for delete shipping label.
	 *
	 * @since    1.2.0
	 */
	function rtwwcpig_delete_shiping_lbl()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security_check' );
			if($rtwwcpig_check_ajax)
			{
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.'rtwwcpig_shipping_label/rtwwcpig_shiping_lbl_'.$rtwwcpig_ordr_id.'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					$rtwwcpig_unlink = unlink($rtwwcpig_dir);
					/** Response for ajax request  **/
					echo $rtwwcpig_unlink;
					die; 
				}
			}
		}
	}
	/**
	 * function for delete shipping label.
	 *
	 * @since    1.2.1
	 */
	function rtwwcpig_delete_packng_slp()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security_check' );
			if($rtwwcpig_check_ajax)
			{
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.'rtwwcpig_pckng_slip/rtwwcpig_'.$rtwwcpig_ordr_id.'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					$rtwwcpig_unlink = unlink($rtwwcpig_dir);
					/** Response for ajax request  **/
					echo $rtwwcpig_unlink;
					die; 
				}
			}
		}
	}
	/**
	 * function for regenerate deleted pdf invoice.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_regnrate_invoice()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security_check' );
			if ( $rtwwcpig_check_ajax ) 
			{
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_ordr_obj = wc_get_order( $rtwwcpig_ordr_id );
				$rtwwcpig_regenrate_invoice = rtwwcpig_make_invoice($rtwwcpig_ordr_id, $rtwwcpig_ordr_obj);
				if (!empty($rtwwcpig_regenrate_invoice)) 
				{
					echo json_encode( array( 'rtwwcpig_status' => true, 'rtwwcpig_message' => esc_html__( 'Successfully Regenerated', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
				else
				{
					echo json_encode( array( 'rtwwcpig_status' => false, 'rtwwcpig_message' => esc_html__( 'Something Went Wrong', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
			}
		}
	}
	/**
	 * function for regenerate deleted shipping label.
	 *
	 * @since    1.2.0
	 */
	function rtwwcpig_regnrate_shipping_lbl()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security' );
			if ( $rtwwcpig_check_ajax ) 
			{
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_ordr_obj = wc_get_order( $rtwwcpig_ordr_id );
				$rtwwcpig_regenrate_shipng_lbl = $this->rtwwcpig_make_shipping_lable($rtwwcpig_ordr_id, $rtwwcpig_ordr_obj);
				if (!empty($rtwwcpig_regenrate_shipng_lbl)) 
				{
					echo json_encode( array( 'rtwwcpig_status' => true, 'rtwwcpig_message' => esc_html__( 'Successfully Regenerated', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
				else
				{
					echo json_encode( array( 'rtwwcpig_status' => false, 'rtwwcpig_message' => esc_html__( 'Something Went Wrong', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
			}
		}
	}
	/**
	 * function for regenerate deleted packind slip.
	 *
	 * @since    1.2.1
	 */
	function rtwwcpig_regnrate_packng_slp()
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_check_ajax = check_ajax_referer( 'rtwwcpig-ajax-security-string', 'rtwwcpig_security' );
			if ( $rtwwcpig_check_ajax ) 
			{
				$rtwwcpig_ordr_id = $_POST[ 'order_id' ];
				$rtwwcpig_ordr_obj = wc_get_order( $rtwwcpig_ordr_id );
				$rtwwcpig_regenrate_shipng_lbl = $this->rtwwcpig_create_packng_slip($rtwwcpig_ordr_id, $rtwwcpig_ordr_obj);
				if (!empty($rtwwcpig_regenrate_shipng_lbl)) 
				{
					echo json_encode( array( 'rtwwcpig_status' => true, 'rtwwcpig_message' => esc_html__( 'Successfully Regenerated', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
				else
				{
					echo json_encode( array( 'rtwwcpig_status' => false, 'rtwwcpig_message' => esc_html__( 'Something Went Wrong', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
					die;
				}
			}
		}
	}
	/**
	 * callback function for regenerate deleted shipping label.
	 *
	 * @since    1.2.0
	 */
	public function rtwwcpig_make_shipping_lable( $rtwwcpig_ordr_id, $rtwwcpig_ordr_obj )
	{
		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
		{
			$rtwwcpig_order = wc_get_order( $rtwwcpig_ordr_id );
			if ( !$rtwwcpig_order ) {
				$rtwwcpig_order = $rtwwcpig_ordr_obj;
			}
			$rtwwcpig_order_data = $rtwwcpig_order->get_data();
			$rtwwcpig_user_email = $rtwwcpig_order->get_billing_email();
			$rtwwcpig_shpng_total = $rtwwcpig_order->get_shipping_total();
			$rtwwcpig_shipping_tax   = $rtwwcpig_order->get_shipping_tax();
			$rtwwcpig_product_qty = array();
			foreach( $rtwwcpig_order->get_items() as $rtwwcpig_item_key => $rtwwcpig_item_values )
			{ 
				$prod_sku = new WC_Product($rtwwcpig_item_values->get_product_id());
				if ( rtwwcpig_woo_product_bundled_compatibility() ) 
				{
					if ( $prod_sku->get_sku() ) 
					{
						$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
						if ( in_array($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) ) {
							$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name().' - '] = $rtwwcpig_item_values->get_quantity();
						}else{
							$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
						}
						$prod_qty[] = $rtwwcpig_item_values->get_quantity();
						$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
						$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
						$rtwwcpig_tax_class[] = $rtwwcpig_item_values->get_tax_class(); // Tax class
			    		$rtwwcpig_subtotal_tax[] = $rtwwcpig_item_values->get_subtotal_tax(); // Line item name
			    		$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax(); // Tax rate code
			    		$rtwwcpig_taxes_array[] = $rtwwcpig_item_values->get_taxes(); 
			    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();
			    		if ($rtwwcpig_prduct_vrtion_id){
			    			$rtwwcpig_prduct = new WC_Product_Variation($rtwwcpig_item_values->get_variation_id());
			    		}else{
			    			$rtwwcpig_prduct = new WC_Product($rtwwcpig_item_values->get_product_id());
			    		}
			    		if ( $rtwwcpig_prduct->get_sku() ) {
			    			$rtwwcpig_sku[] = $rtwwcpig_prduct->get_sku();
			    		}
					}
				}
				else
				{
					$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
					if ( in_array($rtwwcpig_item_values->get_name(), $rtwwcpig_product_qty) ) {
						$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name().' - '] = $rtwwcpig_item_values->get_quantity();
					}else{
						$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
					}
					$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
					$rtwwcpig_total_line_amnt[] = $rtwwcpig_order->get_formatted_line_subtotal( $rtwwcpig_item_values );
					$rtwwcpig_tax_class[] = $rtwwcpig_item_values->get_tax_class(); // Tax class
		    		$rtwwcpig_subtotal_tax[] = $rtwwcpig_item_values->get_subtotal_tax(); // Line item name
		    		$rtwwcpig_total_tax[] = $rtwwcpig_item_values->get_total_tax(); // Tax rate code
		    		$rtwwcpig_taxes_array[] = $rtwwcpig_item_values->get_taxes(); 
		    		$rtwwcpig_prduct_vrtion_id = $rtwwcpig_item_values->get_variation_id();
		    		if ($rtwwcpig_prduct_vrtion_id){
		    			$rtwwcpig_prduct = new WC_Product_Variation($rtwwcpig_item_values->get_variation_id());
		    		}else{
		    			$rtwwcpig_prduct = new WC_Product($rtwwcpig_item_values->get_product_id());
		    		}
		    		if ( $rtwwcpig_prduct->get_sku() ) {
		    			$rtwwcpig_sku[] = $rtwwcpig_prduct->get_sku();
		    		}
				}
	    	}
	    	if ($rtwwcpig_product_id != '') 
			{
				foreach ($rtwwcpig_product_id as $rtwwcpig_k => $rtwwcpig_v) 
				{
					$rtwwcpig_pro = new WC_Product( $rtwwcpig_v );
					$product_weight[] = $rtwwcpig_pro->get_weight();
				}
			}
	    	if ($rtwwcpig_order->get_items( 'tax' ) != '') 
	    	{
	    		foreach ($rtwwcpig_order->get_items( 'tax' ) as $rtwwcpig_key => $rtwwcpig_value) 
	    		{
					$rtwwcpig_item_type = $rtwwcpig_value->get_type(); // Line item type
				    $rtwwcpig_item_name = $rtwwcpig_value->get_name(); // Line item name
				    $rtwwcpig_rate_code = $rtwwcpig_value->get_rate_code(); // Tax rate code
				    $rtwwcpig_tax_rate_label = $rtwwcpig_value->get_label(); // Tax label
				    $rtwwcpig_tax_rate_id = $rtwwcpig_value->get_rate_id(); // Tax rate ID
				    $rtwwcpig_compound = $rtwwcpig_value->get_compound(); // Tax compound
				    $rtwwcpig_tax_amount_total = $rtwwcpig_value->get_tax_total(); // Tax rate total
				    $rtwwcpig_tax_shipping_total[] = $rtwwcpig_value->get_shipping_tax_total();
				}
			}
			$rtwwcpig_data = array();
			if ( !empty($product_weight) ) 
			{
				$total = 0;
				foreach ($product_weight as $k => $v) {
					$total = $total+(int)$v;
				}
				$rtwwcpig_data['total_weight'] = $total;
			}
			$meta = $rtwwcpig_ordr_obj->get_meta('_wctmw_tracking');
			$rtwwcpig_data['tracking_no'] = '';
			if (!empty($meta)) {
				foreach ($meta as $k => $v) {
					$rtwwcpig_data['tracking_no'] = $v['tracking_number'];
				}
			}
			if (!empty($prod_qty)) 
			{
				$count = 0;
				$total_weight = 0;
				foreach ($prod_qty as $key => $value) 
				{
					if ( $product_weight[$count] != '' ) {
						$total_weight = ($total_weight + ($value * $product_weight[$count]));
					}else{
						$total_weight = ($total_weight + ($value * 0));
					}
					$count++;
				}
				$rtwwcpig_data['total_weight'] = $total_weight;
			}
			$rtwwcpig_data['store_address_1'] = get_option( 'woocommerce_store_address' );
			$rtwwcpig_data['store_address_2'] = get_option( 'woocommerce_store_address_2' );
			$rtwwcpig_data['store_city'] = get_option( 'woocommerce_store_city' );
			$rtwwcpig_data['store_postcode'] = get_option( 'woocommerce_store_postcode' );
			$rtwwcpig_data['store_country'] = WC()->countries->countries[$rtwwcpig_ordr_obj->get_billing_country()];
			$rtwwcpig_data['seller_name'] = get_option( 'woocommerce_store_address' );
			$rtwwcpig_data['shipping_method'] =	$rtwwcpig_ordr_obj->get_shipping_method();
			$rtwwcpig_data['shipping_first_name'] =	$rtwwcpig_ordr_obj->get_shipping_first_name();
			$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_ordr_obj->get_shipping_last_name();
			$rtwwcpig_data['shipping_company'] = $rtwwcpig_ordr_obj->get_shipping_company();
			$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_ordr_obj->get_shipping_address_1();
			$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_ordr_obj->get_shipping_address_2();
			$rtwwcpig_data['shipping_city'] = $rtwwcpig_ordr_obj->get_shipping_city();
			$rtwwcpig_data['shipping_state'] = $rtwwcpig_ordr_obj->get_shipping_state();
			$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_ordr_obj->get_shipping_postcode();
			$rtwwcpig_data['shipping_country'] = $rtwwcpig_ordr_obj->get_shipping_country();
			$rtwwcpig_data['order_id'] = $rtwwcpig_ordr_id;
			$rtwwcpig_data['billing_first_name'] = $rtwwcpig_ordr_obj->get_billing_first_name();
			$rtwwcpig_data['billing_email'] = $rtwwcpig_ordr_obj->get_billing_email();
			$rtwwcpig_data['billing_last_name'] = $rtwwcpig_ordr_obj->get_billing_last_name();
			$rtwwcpig_data['billing_address_1'] = $rtwwcpig_ordr_obj->get_billing_address_1();
			$rtwwcpig_data['billing_address_2'] = $rtwwcpig_ordr_obj->get_billing_address_2();
			$rtwwcpig_data['billing_city'] = $rtwwcpig_ordr_obj->get_billing_city();
			$rtwwcpig_data['billing_state'] = $rtwwcpig_ordr_obj->get_billing_state();
			$rtwwcpig_data['billing_postcode'] = $rtwwcpig_ordr_obj->get_billing_postcode();
			$rtwwcpig_data['billing_country'] = $rtwwcpig_ordr_obj->get_billing_country();
			$rtwwcpig_data['payment_method'] = $rtwwcpig_ordr_obj->get_payment_method_title();
			$rtwwcpig_data['customer_note'] = $rtwwcpig_ordr_obj->get_customer_note();
			$amount_sign = get_option('woocommerce_currency');
			$rtwwcpig_data['order_amount'] = wc_price( $rtwwcpig_ordr_obj->get_total() );
			$rtwwcpig_data['billing_company'] = $rtwwcpig_ordr_obj->get_billing_company();
			$rtwwcpig_data['billing_phone'] = $rtwwcpig_ordr_obj->get_billing_phone();
			if(rtwwcpig_woo_seq_order_no_compatibility())
			{
				$rtwwcpig_data['order_id'] = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_ordr_id , $rtwwcpig_ordr_obj);
			}
			else
			{
				$rtwwcpig_data['order_id'] = $rtwwcpig_ordr_id;
			}
			$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_tax_amount_total;
			$rtwwcpig_data['order_date'] = $rtwwcpig_order_data['date_created']->date('d/m/Y');
			$rtwwcpig_data['subtotal_amount'] = ( $rtwwcpig_ordr_obj->get_total() - $rtwwcpig_ordr_obj->get_total_tax() );
			$rtwwcpig_data['line_no'] = 1;
			if(!empty($rtwwcpig_tax_rate_id))
			{
				$rtwwcpig_tax_rates = WC_Tax::_get_tax_rate( $rtwwcpig_tax_rate_id );
				if (!empty($rtwwcpig_tax_rates)) 
				{
					$rtwwcpig_tax_rate = $rtwwcpig_tax_rates['tax_rate'];
				}
			}
			else
			{
				$rtwwcpig_tax_rate = '0.00%';
			}
			if ($rtwwcpig_product_id != '') 
			{
				foreach ($rtwwcpig_product_id as $rtwwcpig_k => $rtwwcpig_v) 
				{
					$rtwwcpig_product[] = wc_get_product( $rtwwcpig_v );
					$rtwwcpig_excerpt[] = get_the_excerpt( $rtwwcpig_v );
					$rtwwcpig_pro = new WC_Product( $rtwwcpig_v ); 
					$rtwwcpig_price[] = $rtwwcpig_pro->get_price();
					$rtwwcpig_term_list = wp_get_post_terms($rtwwcpig_v,'product_cat',array('fields'=>'all'));
					$rtwwcpig_cat_id = $rtwwcpig_term_list[0];
					$rtwwcpig_cat_name[] = $rtwwcpig_term_list[0]->name;
					$rtwwcpig_cat[] = get_term_link ($rtwwcpig_cat_id, 'product_cat');
				}
			}
			if ($rtwwcpig_order->get_items() != '') {
				foreach( $rtwwcpig_order->get_items() as $rtwwcpig_item_id => $rtwwcpig_item ) {
					$rtwwcpig_product = apply_filters( 'woocommerce_order_item_product', $rtwwcpig_order->get_product_from_item( $rtwwcpig_item ), $rtwwcpig_item );
					if ( $rtwwcpig_product->get_variation_id() ) {
						$rtwwcpig_product = new WC_Product_Variation($rtwwcpig_item_values->get_variation_id());
						if ( $rtwwcpig_product->get_image() ) {
							$rtwwcpig_prdct_img[] = $rtwwcpig_product->get_image(array( 50,50 ));
						}
					}else{
						if ( $rtwwcpig_product->get_image() ) {
							$rtwwcpig_prdct_img[] = $rtwwcpig_product->get_image(array( 50,50 ));
						}
					}
				}
			}
			$rtwwcpig_shipping_lbl = get_option( 'rtwwcpig_shipping_format');
			$rtwwcpig_shipping_lbl = stripcslashes($rtwwcpig_shipping_lbl);
			$rtwwcpig_qr_cntnt = get_option('rtwwcpig_qr_code_content');
			$str = '';
			foreach ($rtwwcpig_data as $k => $val) 
			{
				if ( strpos($rtwwcpig_qr_cntnt, '['.$k.']') !== false ) {
					if ( $val != '' ) 
					{
						$str.= '<p>'.$val.'</p>';
					}
				}
			}
			if( $rtwwcpig_qr_cntnt == '' ){
				$qr_text = '<table><thead><tr><th>Order No.</th><th>Customer Name</th><th>Order Total</th></tr></thead><tbody><tr><td>'.$rtwwcpig_ordr_id.'</td><td>'.$rtwwcpig_ordr_obj->get_billing_first_name().' '.$rtwwcpig_ordr_obj->get_billing_last_name().'</td><<td>'.$rtwwcpig_ordr_obj->get_total().'</td>/tr></tbody></table>';
			}else{
				$qr_text = $str;
			}
			if( !class_exists('qrlib') ) {
				include_once( RTWWCPIG_DIR .'includes/phpqrcode/qrlib.php');
				include_once( RTWWCPIG_DIR .'includes/phpqrcode/qrconfig.php');
			}
			require( RTWWCPIG_DIR .'includes/php-barcode-master/barcode.php');
			$rtwwcpig_barcode_cntnt = get_option('rtwwcpig_bar_code_content');
			$rtwwcpig_barcode_cntnt = do_shortcode( $rtwwcpig_barcode_cntnt );
			if( $rtwwcpig_barcode_cntnt != '' ){
				$text = '';
				foreach ($rtwwcpig_data as $k => $val) 
				{
					if ( strpos($rtwwcpig_barcode_cntnt, '['.$k.']') !== false ) {
						if ( $val != '' ) 
						{
							$text.= '<p>'.$val.'</p>';
						}
					}
				}
			}else{
				$text = '<table><thead><tr><th>Order No.</th><th>Customer Name</th><th>Order Total</th></tr></thead><tbody><tr><td>'.$rtwwcpig_ordr_id.'</td><td>'.$rtwwcpig_ordr_obj->get_billing_first_name().' '.$rtwwcpig_ordr_obj->get_billing_last_name().'</td><<td>'.$rtwwcpig_ordr_obj->get_total().'</td>/tr></tbody></table>';
			}
			$size = 100; //size for barcode
			if ( !is_dir ( RTWWCPIG_PDF_SHPNGLBL_DIR ) ) 
			{
				mkdir ( RTWWCPIG_PDF_SHPNGLBL_DIR, 0755, true );
			}
			$qr_filepath = RTWWCPIG_PDF_SHPNGLBL_DIR.'qr_code_'.$rtwwcpig_ordr_id.'.png';
			$rtwwcpig_qrcode = QRcode::png($qr_text,$qr_filepath);
			$barcode_file_path = RTWWCPIG_PDF_SHPNGLBL_DIR.'barcode_'.$rtwwcpig_ordr_id.'.png';
			$rtwwcpig_barcode = barcode($barcode_file_path,$text);
			$rtwwcpig_data['barcode_img'] = '<img src="'.RTWWCPIG_PDF_URL.'/rtwwcpig_shipping_label/assets/barcode_'.$rtwwcpig_ordr_id.'.png" style="width: 500px; height: 50px; display: block; margin: 0 auto; box-sizing: border-box;">';
			$rtwwcpig_data['qr_code_img'] = '<img src="'.RTWWCPIG_PDF_URL.'/rtwwcpig_shipping_label/assets/qr_code_'.$rtwwcpig_ordr_id.'.png" style="width: 180px; height: 180px; display: block; margin: 0 auto; box-sizing: border-box;">';
			if ( $rtwwcpig_shipping_lbl != '' ) 
			{
				if ( !empty( $rtwwcpig_data ) ) 
				{
					foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
					{
						$rtwwcpig_shipping_lbl = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_shipping_lbl);
					}
				}
			}
			$rtwwcpig_pro_desc = 'Shipping_label';
			$rtwwcpig_regenrate_shpng_lbl = rtwwcpig_convert_to_pdf($rtwwcpig_shipping_lbl, $rtwwcpig_ordr_id, $rtwwcpig_user_email,$rtwwcpig_pro_desc);
			if (is_array($rtwwcpig_regenrate_shpng_lbl) && !empty($rtwwcpig_regenrate_shpng_lbl)) 
			{
				echo json_encode( array( 'rtwwcpig_status' => true, 'rtwwcpig_message' => esc_html__( 'Successfully Regenerated', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
				die;
			}
			else
			{
				echo json_encode( array( 'rtwwcpig_status' => false, 'rtwwcpig_message' => esc_html__( 'Something Went Wrong', 'rtwwcpig-woocommerce-pdf-invoice-generator' ) ) );
				die;
			}
		}
	}
	/**
	 * Function for export user data.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_export_data( $rtwwcpig_exporters ){
		$rtwwcpig_exporters[ 'rtwwcpig-my-plugin-exporter-WordPress' ] = array(
			'exporter_friendly_name' => esc_html__( 'WooCommerce PDF Invoice & Packing Slip Generator', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'callback'	=> array( $this, 'rtwwcpig_plugin_exporter' ),
		);
		return $rtwwcpig_exporters;
	}
	/**
	 * Callback function for export user data function.
	 *
	 * @since    1.0.0
	 */ 
	function rtwwcpig_plugin_exporter( $rtwwcpig_email_address, $rtwwcpig_page = 1 )
	{
		global $wpdb;
		$rtwwcpig_user	= get_user_by( 'email', $rtwwcpig_email_address );
		$rtwwcpig_datas = array();
		$rtwwcpig_id = array();
		$rtwwcpig_tablename = $wpdb->prefix.'postmeta';
		$rtwwcpig_user_id = $rtwwcpig_user->ID;
		if ($rtwwcpig_user_id != '') {
			$rtwwcpig_id = $wpdb->get_results($wpdb->prepare("SELECT `post_id` FROM $rtwwcpig_tablename WHERE `meta_value` = %d", $rtwwcpig_user_id), ARRAY_A);
		}
		$rtwwcpig_data_to_export = array();
		if (!empty($rtwwcpig_id)) 
		{
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
				$pdf_name = 'rtwwcpig_';
			}
			$rtwwcpig_internal_data = array();
			foreach ($rtwwcpig_id as $rtwwcpig_key => $rtwwcpig_value) 
			{
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_value['post_id'].'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					$rtwwcpig_internal_data[] = array( 'name' => 'Order No - '. $rtwwcpig_value['post_id'], 'value' => "<a href='". esc_url(RTWWCPIG_PDF_URL.$pdf_name.$rtwwcpig_value['post_id']).".pdf'>View PDF Invoice</a>" );
				}
			}
			$rtwwcpig_data_to_export[] 	= array(
				'group_id'    => 'rtwwcpig_pdf_invoice_exporter',
				'group_label' => esc_html__("WooCommerce PDF Invoice & Packing Slip Generator", "rtwwcpig-woocommerce-pdf-invoice-generator"),
				'item_id'     => $rtwwcpig_key,
				'data'        => $rtwwcpig_internal_data,
			);
		}
		return array(
			'data' => $rtwwcpig_data_to_export,
			'done' => true,
		);
	}
	/**
	 * Function for Delete user data.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_eraser_data( $rtwwcpig_erasers )
	{
		$rtwwcpig_erasers[ 'rtwwcpig-my-plugin-eraser' ] = array(
			'eraser_friendly_name' => esc_html__( 'WooCommerce PDF Invoice Eraser', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'callback'	=> array( $this, 'rtwwcpig_my_plugin_eraser' ),
		);
		return $rtwwcpig_erasers;
	}
	/**
	 * Callback function for Delete user data function.
	 *
	 * @since    1.0.0
	 */ 
	function rtwwcpig_my_plugin_eraser( $rtwwcpig_email_address, $rtwwcpig_page = 1 )
	{
		global $wpdb;
		$rtwwcpig_user	= get_user_by( 'email', $rtwwcpig_email_address );
		$rtwwcpig_datas = array();
		$rtwwcpig_id = array();
		$rtwwcpig_tablename = $wpdb->prefix.'postmeta';
		$rtwwcpig_user_id = $rtwwcpig_user->ID;
		if ($rtwwcpig_user_id != '') {
			$rtwwcpig_id = $wpdb->get_results($wpdb->prepare("SELECT `post_id` FROM $rtwwcpig_tablename WHERE `meta_value` = %d", $rtwwcpig_user_id), ARRAY_A);
		}
		if (get_option('remove_prsnl_data') == 'remove_invoice') 
		{
			$pdf_name = get_option( 'rtwwcpig_custm_pdf_name' );
			if ( $pdf_name == '' ) {
				$pdf_name = 'rtwwcpig_';
			}
			foreach ($rtwwcpig_id as $rtwwcpig_key => $rtwwcpig_value) 
			{
				$rtwwcpig_dir = RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_value['post_id'].'.pdf';
				if (file_exists($rtwwcpig_dir)) 
				{
					unlink(RTWWCPIG_PDF_DIR.$pdf_name.$rtwwcpig_value['post_id'].'.pdf');
				}
			}
		}
		return array(
			'items_removed'  => true,
			'items_retained' => false,
			'messages'       => [],
			'done'           => true,
		);
	}
	/** 
	* function to verify purchase code
	* @since 1.3.1
	*/
	function rtwwcpig_verify_purchase_code_callback()
	{
		if (!wp_verify_nonce($_POST['security_check'], 'rtwwcpig-ajax-security-string')){
			return;
		}
		$rtwwcpig_purchase_code = sanitize_text_field( $_POST['purchase_code'] );
		$rtwwcpig_user_data     = get_user_meta( wp_get_current_user()->data->ID );
		$rtwwcpig_site_data     = explode( '://', get_site_url());
		$rtwwcpig_site_domain 	= $rtwwcpig_site_data[1];
		$rtwwcpig_admin_email 	= get_option('admin_email');
		$wp_get_current_user 	= wp_get_current_user();
		$rtwwcpig_admin_name 	= $rtwwcpig_user_data['first_name'][0].' '.$rtwwcpig_user_data['last_name'][0];
		$rtwwcpig_plugin_name 	= 'WooCommerce PDF Invoice & Packing Slip Generator';
		$plugin_text_domain 	= 'rtwwcpig-woocommerce-pdf-invoice-generator';
		$rtwwcpig_post_array = array('site_domain' => $rtwwcpig_site_domain,
									 'admin_email' => $rtwwcpig_admin_email,
									 'admin_name' => $rtwwcpig_admin_name,
									 'plugin_name' => $rtwwcpig_plugin_name,
									 'text_domain' => $plugin_text_domain,
									 'purchase_code' => $rtwwcpig_purchase_code 
								);
		$args = array(
		    'method' => 'POST',
		    'headers'  => array(
		        'Content-type: application/x-www-form-urlencoded'
		    ),
		    'sslverify' => false,
		    'body' => $rtwwcpig_post_array
		);
		$response = wp_remote_post( 'https://demo.redefiningtheweb.com/license-verification/license-verification.php', $args ) ;
		if(is_wp_error($response))
		{
			$rtwwcpig_result = array( 'status' => false,
			'message' => $response->get_error_message() );
			echo json_encode( $rtwwcpig_result );
			die;
		}
		$response_body = json_decode( $response['body'] );
		$response_status = $response_body->result;
		$response_message = $response_body->message;
		if( $response_status ){
			$rtwwcpig_update_array = array( 'purchase_code' => $rtwwcpig_purchase_code,
			'status' => true );
			update_option( 'rtwwcpig_verification_done', $rtwwcpig_update_array );
			$rtwwcpig_result = array( 'status' => true,
								'message' => $response_message );
			echo json_encode( $rtwwcpig_result );
			die;
		}else{
			$rtwwcpig_result = array( 'status' => false,
								'message' => $response_message );
			echo json_encode( $rtwwcpig_result );
			die;
		}
		/* ///////////////////////
		Code to be done for verification of purchase code
		/////////////////////// */
	}
	/*
	* Function to remove purchase code
	*/
	function rtwwcpig_delete_purchase_code()
	{
		$rtwwcpig_site_url 		= get_site_url();
		$rtwwcpig_admin_email 	= get_option('admin_email');
		$wp_get_current_user 	= get_user_meta( get_current_user_id() );
		if( is_array($wp_get_current_user) && !empty( $wp_get_current_user ) )
		{
			if( isset( $wp_get_current_user['first_name'][0]))
			{
				$rtwwcpig_admin_name = $wp_get_current_user['first_name'][0] . ' '. $wp_get_current_user['last_name'][0];
			}
		}
		else{
			$wp_get_current_user 	= wp_get_current_user();
			$rtwwcpig_admin_name 	= $wp_get_current_user->data->user_nicename;
		}
		$rtwwcpig_plugin_name 	= 'WooCommerce PDF Invoice & Packing Slip Generator';
		$plugin_text_domain 	= 'rtwwcpig-woocommerce-pdf-invoice-generator';
		$rtwwcpig_site_domain 	= preg_replace( "(^https?://)", "", $rtwwcpig_site_url );
		$rtwwcpig_purchase_code = get_option( 'rtwwcpig_verification_done', array() );
		$rtwwcpig_post_array = array(
								'site_domain' => $rtwwcpig_site_domain,
								'admin_email' => $rtwwcpig_admin_email,
								'admin_name' => $rtwwcpig_admin_name,
								'plugin_name' => $rtwwcpig_plugin_name,
								'text_domain' => $plugin_text_domain,
								'purchase_code' => $rtwwcpig_purchase_code['purchase_code'],
								'plugin_id' => 24179339
							);
		$args = array(
						'method' => 'POST',
						'headers'  => array(
								'Content-type: application/x-www-form-urlencoded'
						),
						'sslverify' => false,
						'body' => $rtwwcpig_post_array
				);
		$response = wp_remote_post( 'https://demo.redefiningtheweb.com/license-verification/license-remove.php', $args );
		delete_option('rtwwcpig_verification_done');
		wp_redirect( esc_url( admin_url( 'admin.php?page=rtwwcpig-pdf-invoice-settings' ) ) );
		exit;
	}
	/**
	 * function for create packing slip for an order.
	 *
	 * @since    1.0.0
	 */
	function rtwwcpig_create_packng_slip($rtwwcpig_ordr_no,$rtwwcpig_ordr_obj)
	{
		$rtwwcpig_pkngslp_pdf = rtwwcpig_create_pdf_packngslip($rtwwcpig_ordr_no,$rtwwcpig_ordr_obj);
	}
	/**
	 * function for create Credit note for an order.
	 *
	 * @since    1.4.0
	 */
	public function rtwwcpig_create_credit_note($rtwwcpig_order_id)
	{
		$rtwwcpig_ordr = wc_get_order($rtwwcpig_order_id);
		if ( !$rtwwcpig_ordr ) {
			return ;
		}
		if(rtwwcpig_woo_seq_order_no_compatibility())
		{
			$rtwwcpig_order_id = (string) apply_filters( 'woocommerce_order_number', $rtwwcpig_order_id , $rtwwcpig_ordr);
		}
		$rtwwcpig_credit_note = $this->rtwwcpig_make_credit_note($rtwwcpig_order_id, $rtwwcpig_ordr);
	}
	/**
	 * function for create credit note HTML for PDF.
	 *
	 * @since    1.4.0
	 */
	public function rtwwcpig_make_credit_note($rtwwcpig_order_id, $rtwwcpig_ordr)
	{
		if( $rtwwcpig_ordr->get_status() == 'refunded')
		{
			if ( get_option( 'rtwwcpig_dsply_crrncy_smbl' ) == 'yes' ) {
				define('CURRENCY', $rtwwcpig_ordr->get_currency());
				$currency_code = $rtwwcpig_ordr->get_currency();
				$rtwwcpig_currency_symbol = get_woocommerce_currency_symbol( $currency_code );
			}else{
				$rtwwcpig_currency_symbol = '';
			}
			$currency_code = $rtwwcpig_ordr->get_currency();
			$rtwwcpig_crncy = get_woocommerce_currency_symbol( $currency_code );
			$rtwwcpig_order_data   = $rtwwcpig_ordr->get_data();
			$rtwwcpig_user_email   = $rtwwcpig_ordr->get_billing_email();
			$rtwwcpig_shpng_total  = $rtwwcpig_ordr->get_shipping_total();
			if ( $rtwwcpig_shpng_total == '' ) {
				$rtwwcpig_shpng_total = 0.00;
			}
			$rtwwcpig_shipping_tax = $rtwwcpig_ordr->get_shipping_tax();
			if ( $rtwwcpig_shipping_tax == '' ) {
				$rtwwcpig_shipping_tax = 0.00;
			}
			$rtwwcpig_shpng_amnt = ( $rtwwcpig_shpng_total + $rtwwcpig_shipping_tax );
			$rtwwcpig_total_discount = $rtwwcpig_ordr->get_discount_total();
			if ($rtwwcpig_ordr->get_items( 'tax' ) != '') 
	    	{
	    		foreach ($rtwwcpig_ordr->get_items( 'tax' ) as $rtwwcpig_key => $rtwwcpig_value) {
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
	    	foreach( $rtwwcpig_ordr->get_items() as $rtwwcpig_item_key => $rtwwcpig_item_values )
			{
				$rtwwcpig_product_id[] = $rtwwcpig_item_values->get_product_id();
				$rtwwcpig_product_qty[$rtwwcpig_item_values->get_name()] = $rtwwcpig_item_values->get_quantity();
				$rtwwcpig_total_amnt[] = $rtwwcpig_item_values->get_total();
				$rtwwcpig_prodct_price[] = ( $rtwwcpig_item_values->get_total()/$rtwwcpig_item_values->get_quantity() );
				$rtwwcpig_subtotal_amnt[] = $rtwwcpig_item_values->get_subtotal();
				$rtwwcpig_total_line_amnt[] = $rtwwcpig_ordr->get_formatted_line_subtotal( $rtwwcpig_item_values );
				$rtwwcpig_tax_class = $rtwwcpig_item_values->get_tax_class(); // Tax class
				if ( $rtwwcpig_tax_class !== '' ) {
					$data[] = WC_Tax::get_rates_for_tax_class( $rtwwcpig_tax_class );
				}else{
					$tax_name[] = '';
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
			foreach ($tax_name as $key => $val) {
	    		if (!empty($val)) {
	    			foreach ($val as $k => $v) {
	    				$tax_string[] = $v->tax_rate_name.'( '.(int)$v->tax_rate.'% )';
	    			}
	    		}else{
	    			$tax_string[] = '0.00%';
	    		}
	    	}
	    	$rtwwcpig_data['store_address_1'] = get_option( 'woocommerce_store_address' );
			$rtwwcpig_data['store_address_2'] = get_option( 'woocommerce_store_address_2' );
			$rtwwcpig_data['store_city'] = get_option( 'woocommerce_store_city' );
			$rtwwcpig_data['store_postcode'] = get_option( 'woocommerce_store_postcode' );
			$rtwwcpig_data['store_country'] = WC()->countries->get_base_country();
			$rtwwcpig_data['shipping_first_name'] =	$rtwwcpig_ordr->get_shipping_first_name();
			if( $rtwwcpig_data['shipping_first_name'] == '' )
			{
				$rtwwcpig_data['shipping_first_name'] = $rtwwcpig_ordr->get_billing_first_name();
			}
			$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_ordr->get_shipping_last_name();
			if( $rtwwcpig_data['shipping_last_name'] == '' )
			{
				$rtwwcpig_data['shipping_last_name'] = $rtwwcpig_ordr->get_billing_last_name();
			}
			$rtwwcpig_data['shipping_company'] = $rtwwcpig_ordr->get_shipping_company();
			if( $rtwwcpig_data['shipping_company'] == '' )
			{
				$rtwwcpig_data['shipping_company'] = $rtwwcpig_ordr->get_billing_company();
			}
			$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_ordr->get_shipping_address_1();
			if( $rtwwcpig_data['shipping_address_1'] == '' )
			{
				$rtwwcpig_data['shipping_address_1'] = $rtwwcpig_ordr->get_billing_address_1();
			}
			$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_ordr->get_shipping_address_2();
			if( $rtwwcpig_data['shipping_address_2'] == '' )
			{
				$rtwwcpig_data['shipping_address_2'] = $rtwwcpig_ordr->get_billing_address_2();
			}
			$rtwwcpig_data['shipping_city'] = $rtwwcpig_ordr->get_shipping_city();
			if( $rtwwcpig_data['shipping_city'] == '' )
			{
				$rtwwcpig_data['shipping_city'] = $rtwwcpig_ordr->get_billing_city();
			}
			$rtwwcpig_data['shipping_state'] = $rtwwcpig_ordr->get_shipping_state();
			if( $rtwwcpig_data['shipping_state'] == '' )
			{
				$rtwwcpig_data['shipping_state'] = $rtwwcpig_ordr->get_billing_state();
			}
			$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_ordr->get_shipping_postcode();
			if( $rtwwcpig_data['shipping_postcode'] == '' )
			{
				$rtwwcpig_data['shipping_postcode'] = $rtwwcpig_ordr->get_billing_postcode();
			}
			$rtwwcpig_data['shipping_country'] = $rtwwcpig_ordr->get_shipping_country();
			if( $rtwwcpig_data['shipping_country'] == '' )
			{
				$rtwwcpig_data['shipping_country'] = $rtwwcpig_ordr->get_billing_country();
			}
			$rtwwcpig_data['billing_first_name'] = $rtwwcpig_ordr->get_billing_first_name();
			$rtwwcpig_data['billing_email'] = $rtwwcpig_ordr->get_billing_email();
			$rtwwcpig_data['billing_last_name'] = $rtwwcpig_ordr->get_billing_last_name();
			$rtwwcpig_data['billing_address_1'] = $rtwwcpig_ordr->get_billing_address_1();
			$rtwwcpig_data['billing_address_2'] = $rtwwcpig_ordr->get_billing_address_2();
			$rtwwcpig_data['billing_city'] = $rtwwcpig_ordr->get_billing_city();
			$rtwwcpig_data['billing_state'] = $rtwwcpig_ordr->get_billing_state();
			$rtwwcpig_data['billing_postcode'] = $rtwwcpig_ordr->get_billing_postcode();
			$rtwwcpig_data['billing_country'] = $rtwwcpig_ordr->get_billing_country();
			$rtwwcpig_data['order_amount'] = $rtwwcpig_ordr->get_total();
			$rtwwcpig_data['billing_company'] = $rtwwcpig_ordr->get_billing_company();
			$rtwwcpig_data['billing_phone'] = $rtwwcpig_ordr->get_billing_phone();
			$rtwwcpig_data['payment_method'] = $rtwwcpig_ordr->get_payment_method_title();
			$rtwwcpig_data['order_id'] = $rtwwcpig_order_id;
			$rtwwcpig_data['order_date'] = $rtwwcpig_order_data['date_created']->date('d/m/Y');
			$rtwwcpig_data['order_time'] = $rtwwcpig_order_data['date_created']->date('h:i:s');
			$rtwwcpig_data['customer_note'] = $rtwwcpig_ordr->get_customer_note();
			$rtwwcpig_data['total_amnt_in_words'] = esc_html__(rtwwcpig_convert_amount_in_words($rtwwcpig_data['order_amount']), 'rtwwcpig-woocommerce-pdf-invoice-generator');
			$rtwwcpig_data['total_amnt_in_words'] .= esc_html__(' Only', 'rtwwcpig-woocommerce-pdf-invoice-generator');
			$rtwwcpig_data['row_tax_amount'] = $rtwwcpig_ordr->get_total_tax();
			if ( $rtwwcpig_shpng_amnt == '' ) {
				$rtwwcpig_shpng_amnt = 0.00;
			}
			if ( $rtwwcpig_ordr->get_total_tax() == '' ) {
				$get_total_tax = 0.00;
			}else{
				$get_total_tax = $rtwwcpig_ordr->get_total_tax();
			}
			$rtwwcpig_data['subtotal_amount'] = ( (int)$rtwwcpig_ordr->get_total() - (int)($rtwwcpig_shpng_amnt + $get_total_tax) );
			if ($rtwwcpig_product_id != '') 
			{
				foreach ($rtwwcpig_product_id as $rtwwcpig_k => $rtwwcpig_v) 
				{
					$rtwwcpig_pro = new WC_Product( $rtwwcpig_v );
					$price_exclude_tax = wc_get_price_excluding_tax( $rtwwcpig_pro );
					$price_incl_tax = wc_get_price_including_tax( $rtwwcpig_pro );
					$tax_amount[]     = ($price_incl_tax - $price_exclude_tax);
					$rtwwcpig_price[] = $rtwwcpig_pro->get_price();
					$rtwwcpig_regular_price[] = $rtwwcpig_pro->get_regular_price();
					if(!empty($rtwwcpig_pro->get_sale_price())){
						$rtwwcpig_sale_price[] = $rtwwcpig_pro->get_sale_price();
					}else{
						$rtwwcpig_sale_price[] = 0.00;
					}
					$rtwwcpig_term_list = wp_get_post_terms($rtwwcpig_v,'product_cat',array('fields'=>'all'));
					$rtwwcpig_cat_id = $rtwwcpig_term_list[0];
					$rtwwcpig_cat_name[] = $rtwwcpig_term_list[0]->name;
					$rtwwcpig_cat[] = get_term_link ($rtwwcpig_cat_id, 'product_cat');
				}
			}
			if ($rtwwcpig_ordr->get_items() != '') {
				foreach( $rtwwcpig_ordr->get_items() as $rtwwcpig_item_id => $rtwwcpig_item ) {
					$rtwwcpig_product = apply_filters( 'woocommerce_order_item_product', $rtwwcpig_ordr->get_product_from_item( $rtwwcpig_item ), $rtwwcpig_item );
					if ( $rtwwcpig_product ) {
						$rtwwcpig_prdct_img[] = $rtwwcpig_product->get_image(array( 50,50 ));
					}
				}
			}
			if (! class_exists ( 'simple_html_dom_node' )) 
			{
				require_once (RTWWCPIG_DIR .'/includes/simplehtmldom/simple_html_dom.php');
			}
			$rtwwcpig_credit_note = get_option( 'rtwwcpig_credit_note_format_setting_opt' );
			$rtwwcpig_credit_temp = isset($rtwwcpig_credit_note['invoice_template']) ? $rtwwcpig_credit_note['invoice_template'] : 2;
			if ( $rtwwcpig_credit_temp == 2 ) 
			{
				$rtwwcpig_credit_format = stripcslashes($rtwwcpig_credit_note['invoice_format_2']);
				if ( $rtwwcpig_credit_format != '' ) 
				{	
					foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
					{
						if ( $rtwwcpig_key == 'order_amount' ) 
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'row_tax_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_ordr->get_total_tax());
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'subtotal_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);	
					}
					$rtwwcpig_credit_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_credit_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
					$rtwwcpig_count = 0;
					$line_numb = 1; 
					$rtwwcpig_string2 = '';
					$rtwwcpig_dom = new simple_html_dom ();
					$rtwwcpig_dom->load( $rtwwcpig_credit_format );
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
							$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key, ($rtwwcpig_prdct_img[$rtwwcpig_count]), $rtwwcpig_crncy.' '.($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_string[$rtwwcpig_count] , $rtwwcpig_crncy.' '.( wc_format_decimal( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ,2 ) ), $rtwwcpig_crncy.' '.($rtwwcpig_total_tax[$rtwwcpig_count]), $rtwwcpig_crncy.' '.(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);
							$rtwwcpig_count = ++$rtwwcpig_count;
							$line_numb = ++$line_numb;
						}
					}
				}
			}
			if ( $rtwwcpig_credit_temp == 3 ) 
			{
				$rtwwcpig_credit_format = stripcslashes($rtwwcpig_credit_note['invoice_format_3']);
				if ( $rtwwcpig_credit_format != '' ) 
				{
					foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
					{
						if ( $rtwwcpig_key == 'order_amount' ) 
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'row_tax_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_ordr->get_total_tax());
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'subtotal_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);	
					}
					$rtwwcpig_credit_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_credit_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
					$rtwwcpig_count = 0;
					$line_numb = 1; 
					$rtwwcpig_string2 = '';
					$rtwwcpig_dom = new simple_html_dom ();
					$rtwwcpig_dom->load( $rtwwcpig_credit_format );
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
							$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key, ($rtwwcpig_prdct_img[$rtwwcpig_count]), $rtwwcpig_crncy.' '.($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_string[$rtwwcpig_count] , $rtwwcpig_crncy.' '.( wc_format_decimal( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ,2 ) ), $rtwwcpig_crncy.' '.($rtwwcpig_total_tax[$rtwwcpig_count]), $rtwwcpig_crncy.' '.(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);
							$rtwwcpig_count = ++$rtwwcpig_count;
							$line_numb = ++$line_numb;
						}
					}
				}
			}
			if ( $rtwwcpig_credit_temp == 6 ) 
			{
				$rtwwcpig_credit_format = stripcslashes($rtwwcpig_credit_note['invoice_format_6']);
				if ( $rtwwcpig_credit_format != '' ) 
				{
					foreach ($rtwwcpig_data as $rtwwcpig_key => $rtwwcpig_val) 
					{
						if ( $rtwwcpig_key == 'order_amount' ) 
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'row_tax_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_ordr->get_total_tax());
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						if( $rtwwcpig_key == 'subtotal_amount' )
						{
							$rtwwcpig_val = $rtwwcpig_crncy.' '.($rtwwcpig_val);
							$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);
						}
						$rtwwcpig_credit_format = str_replace('['.$rtwwcpig_key.']', $rtwwcpig_val, $rtwwcpig_credit_format);	
					}
					$rtwwcpig_credit_format = htmlspecialchars_decode ( htmlentities ( $rtwwcpig_credit_format, ENT_NOQUOTES, 'UTF-8', false ), ENT_NOQUOTES );
					$rtwwcpig_count = 0;
					$line_numb = 1; 
					$rtwwcpig_string2 = '';
					$rtwwcpig_dom = new simple_html_dom ();
					$rtwwcpig_dom->load( $rtwwcpig_credit_format );
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
							$rtwwcpig_prod_tr_final .= str_replace( array('[line_number]', '[product_name]', '[product_img]', '[product_price]', '[product_qty]', '[tax_rate]', '[discount]', '[tax_amount]', '[line_total]'), array($line_numb, $key, ($rtwwcpig_prdct_img[$rtwwcpig_count]), $rtwwcpig_crncy.' '.($rtwwcpig_prodct_price[$rtwwcpig_count]), $value,$tax_string[$rtwwcpig_count] , $rtwwcpig_crncy.' '.( wc_format_decimal( ($rtwwcpig_subtotal_amnt[$rtwwcpig_count] - $rtwwcpig_total_amnt[$rtwwcpig_count]) ,2 ) ), $rtwwcpig_crncy.' '.($rtwwcpig_total_tax[$rtwwcpig_count]), $rtwwcpig_crncy.' '.(($rtwwcpig_total_amnt[$rtwwcpig_count]))), $rtwwcpig_prod_tr);
							$rtwwcpig_count = ++$rtwwcpig_count;
							$line_numb = ++$line_numb;
						}
					}
				}
			}
			$rtwwcpig_dom = new simple_html_dom ();
			$rtwwcpig_dom->load ( $rtwwcpig_credit_format );
			foreach ($rtwwcpig_dom->find('#rtwwcpig_prod_table tbody') as $vals) 
			{
				$vals->outertext = $rtwwcpig_prod_tr_final;
			}
			$rtwwcpig_credit_format = $rtwwcpig_dom->save();
			$rtwwcpig_pdf_creditnote = rtwwcpig_convert_to_pdf($rtwwcpig_credit_format, $rtwwcpig_order_id, $rtwwcpig_user_email,'credit_note');
		}
	}
	/**
	 * Display the admin notices.
	 *
	 * @since    1.2.1
	 */
	public function rtwwcpig_show_notices()
	{
		$rtwwpf_purchase_code_details = get_option( 'rtwwpf_verification_done', array() );
		if(($rtwwpf_purchase_code_details['status'] == false && !isset($rtwwpf_purchase_code_details['purchase_code']) || $rtwwpf_purchase_code_details['purchase_code'] == '') && $_GET['page'] != 'rtwwcfp_settings')
		{ ?>
		<div class="notice notice-error is-dismissible">
		    <p>Please Enter Your Purchase Code For Activation Of WooCommerce PDF Invoice & Packing Slip Generator. For Enter Your Purchase Code : <strong><a href="<?php echo esc_url( home_url()."/wp-admin/admin.php?page=rtwwcpig-pdf-invoice-settings" ); ?>">Click Here</a></strong></p>
		</div>
	<?Php	
		}
	}		
}