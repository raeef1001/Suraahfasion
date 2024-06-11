<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwcpig_Woocommerce_Pdf_Invoice_Generator {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Loader    $rtwwcpig_loader    Maintains and registers all hooks for the plugin.
	 */
	protected $rtwwcpig_loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $rtwwcpig_plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $rtwwcpig_plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $rtwwcpig_version    The current version of the plugin.
	 */
	protected $rtwwcpig_version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'RTWWCPIG_WOOCOMMERCE_PDF_INVOICE_GENERATOR_VERSION' ) ) {
			$this->rtwwcpig_version = RTWWCPIG_WOOCOMMERCE_PDF_INVOICE_GENERATOR_VERSION;
		} else {
			$this->rtwwcpig_version = '1.0.0';
		}
		$this->rtwwcpig_plugin_name = 'woocommerce-pdf-invoice-generator';

		$this->rtwwcpig_load_dependencies();
		$this->rtwwcpig_set_locale();
		$this->rtwwcpig_define_admin_hooks();
		$this->rtwwcpig_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Loader. Orchestrates the hooks of the plugin.
	 * - Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_i18n. Defines internationalization functionality.
	 * - Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Admin. Defines all hooks for the admin area.
	 * - Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwwcpig_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rtwwcpig-class-woocommerce-pdf-invoice-generator-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rtwwcpig-class-woocommerce-pdf-invoice-generator-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/rtwwcpig-class-woocommerce-pdf-invoice-generator-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/rtwwcpig-class-woocommerce-pdf-invoice-generator-public.php';

		/**
		 * The class responsible for defining general function
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rtwwcpig_general_function.php';

		$this->rtwwcpig_loader = new Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwwcpig_set_locale() {

		$rtwwcpig_plugin_i18n = new Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_i18n();

		$this->rtwwcpig_loader->rtwwcpig_add_action( 'plugins_loaded', $rtwwcpig_plugin_i18n, 'rtwwcpig_load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwwcpig_define_admin_hooks() {

		$rtwwcpig_plugin_admin = new Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Admin( $this->rtwwcpig_get_plugin_name(), $this->rtwwcpig_get_version() ); 
		
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'admin_enqueue_scripts', $rtwwcpig_plugin_admin, 'rtwwcpig_enqueue_styles' );
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'admin_enqueue_scripts', $rtwwcpig_plugin_admin, 'rtwwcpig_enqueue_scripts' );
		$this->rtwwcpig_loader->rtwwcpig_add_action('admin_menu', $rtwwcpig_plugin_admin, 'rtwwcpig_add_menu_page');
		$this->rtwwcpig_loader->rtwwcpig_add_action('admin_init', $rtwwcpig_plugin_admin, 'rtwwcpig_save_admin_setting');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_delete_invoice', $rtwwcpig_plugin_admin, 'rtwwcpig_delete_invoice');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_regnrate_invoice', $rtwwcpig_plugin_admin, 'rtwwcpig_regnrate_invoice');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_regnrate_shipping_lbl', $rtwwcpig_plugin_admin, 'rtwwcpig_regnrate_shipping_lbl');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_delete_shiping_lbl', $rtwwcpig_plugin_admin, 'rtwwcpig_delete_shiping_lbl');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_delete_packng_slp', $rtwwcpig_plugin_admin, 'rtwwcpig_delete_packng_slp');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_regnrate_packng_slp', $rtwwcpig_plugin_admin, 'rtwwcpig_regnrate_packng_slp');
		$this->rtwwcpig_loader->rtwwcpig_add_filter( 'plugin_action_links_' . RTWWCPIG_BASEFILE_NAME, $rtwwcpig_plugin_admin, 'rtwwcpig_add_setting_links' );
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'wp_ajax_rtwwcpig_verify_purchase_code', $rtwwcpig_plugin_admin, 'rtwwcpig_verify_purchase_code_callback');


		$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
		if( !empty($rtwwcpig_purchase_code_details) && ( !isset($rtwwcpig_purchase_code_details['status']) && $rtwwcpig_purchase_code_details['status'] == false && !isset($rtwwcpig_purchase_code_details['purchase_code']) || $rtwwcpig_purchase_code_details['purchase_code'] == '' ) && $_GET['page'] != 'rtwwcpig-pdf-invoice-settings')
		{
			$this->rtwwcpig_loader->rtwwcpig_add_action('admin_notices', $rtwwcpig_plugin_admin, 'rtwwcpig_show_notices');
		}
		$this->rtwwcpig_loader->rtwwcpig_add_action('init', $rtwwcpig_plugin_admin, 'rtwwcpig_invoice_regenerate_callback');
		//delete_purchase_code
		if(isset($_GET['rtwwcpig_action']) && $_GET['rtwwcpig_action'] == 'delete_purchase_code')
		{
			$this->rtwwcpig_loader->rtwwcpig_add_action( 'admin_init', $rtwwcpig_plugin_admin, 'rtwwcpig_delete_purchase_code' );
		}

		if(get_option('rtwwcpig_regular_invoice') == 'yes' || get_option('rtwwcpig_proforma_invoice') == 'yes')
		{ 
			$rtwwcpig_order_status = array_unique(apply_filters('woocommerce_order_is_paid_statuses', array('processing', 'completed', 'on-hold')));

			if (!in_array('completed', $rtwwcpig_order_status)) {
				$rtwwcpig_order_status[] = 'completed';
			}

			foreach ($rtwwcpig_order_status as $rtwwcpig_ordr_istatus) 
			{
				$this->rtwwcpig_loader->rtwwcpig_add_action( 'woocommerce_order_status_'. $rtwwcpig_ordr_istatus, $rtwwcpig_plugin_admin, 'rtwwcpig_make_invoice_on_order_status_change', '' , 2);
			}

			$this->rtwwcpig_loader->rtwwcpig_add_action('add_meta_boxes', $rtwwcpig_plugin_admin, 'rtwwcpig_add_meta_box',10,2);
			
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_email_attachments', $rtwwcpig_plugin_admin, 'rtwwcpig_send_invoice_on_mail', 10 , 3);
			
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_admin_order_actions', $rtwwcpig_plugin_admin, 'rtwwcpig_admin_invoice_link', '', 2);
		}

		if(get_option('rtwwcpig_download_pkng_slp') == 'yes')
		{
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_admin_order_actions', $rtwwcpig_plugin_admin, 'rtwwcpig_admin_pckng_slip_link', '', 2);
		}

		$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_order_status_refunded', $rtwwcpig_plugin_admin, 'rtwwcpig_create_credit_note');
		//$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_email_actions', $rtwwcpig_plugin_admin, 'rtwwcpig_send_credit_note_email');

		$this->rtwwcpig_loader->rtwwcpig_add_action('bulk_actions-edit-shop_order', $rtwwcpig_plugin_admin, 'rtwwcpig_add_bulk_action_in_orderlist', 20, 1);
		$this->rtwwcpig_loader->rtwwcpig_add_action('handle_bulk_actions-edit-shop_order', $rtwwcpig_plugin_admin, 'rtwwcpig_handle_bulk_action', '', 3);
		// exporter
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'wp_privacy_personal_data_exporters', $rtwwcpig_plugin_admin, 'rtwwcpig_export_data' );
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'wp_privacy_personal_data_erasers', $rtwwcpig_plugin_admin, 'rtwwcpig_eraser_data' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rtwwcpig_define_public_hooks() {

		$rtwwcpig_plugin_public = new Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Public( $this->rtwwcpig_get_plugin_name(), $this->rtwwcpig_get_version() );

		$this->rtwwcpig_loader->rtwwcpig_add_action( 'wp_enqueue_scripts', $rtwwcpig_plugin_public, 'rtwwcpig_enqueue_styles' );
		$this->rtwwcpig_loader->rtwwcpig_add_action( 'wp_enqueue_scripts', $rtwwcpig_plugin_public, 'rtwwcpig_enqueue_scripts' );
		if(get_option('rtwwcpig_regular_invoice') == 'yes' || get_option('rtwwcpig_proforma_invoice') == 'yes'){
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_checkout_order_processed', $rtwwcpig_plugin_public, 'rtwwcpig_generate_invoice', 9 , 3);
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_order_details_after_order_table', $rtwwcpig_plugin_public, 'rtwwcpig_user_invoice_link');
		}
		if (get_option('rtwwcpig_enable_pkng_slp') == 'yes') {
			$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_checkout_order_processed', $rtwwcpig_plugin_public, 'rtwwcpig_create_packng_slip', 11 , 3);
		}
		$this->rtwwcpig_loader->rtwwcpig_add_filter( 'rtwmer_invoice_and_packaging_slip', $rtwwcpig_plugin_public, 'render_btn_for_mltivndr', '', 2 );
		$this->rtwwcpig_loader->rtwwcpig_add_filter( 'rtwmer_include_js', $rtwwcpig_plugin_public, 'rtwwcpig_mercado_js', 9999, 1 );
	    $this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_my_account_my_orders_actions', $rtwwcpig_plugin_public, 'rtwwcpig_orders_actions', '' , 2);   
	    $this->rtwwcpig_loader->rtwwcpig_add_action('init', $rtwwcpig_plugin_public, 'rtwwcpig_invoice_download_callback');
	    $this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_create_invoice', $rtwwcpig_plugin_public, 'rtwwcpig_create_invoice_cb');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_nopriv_rtwwcpig_create_invoice', $rtwwcpig_plugin_public, 'rtwwcpig_create_invoice_cb');

		
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_rtwwcpig_create_packaging', $rtwwcpig_plugin_public, 'rtwwcpig_create_packaging_cb');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_nopriv_rtwwcpig_create_packaging', $rtwwcpig_plugin_public, 'rtwwcpig_create_packaging_cb');


		$this->rtwwcpig_loader->rtwwcpig_add_action('woocommerce_cart_collaterals', $rtwwcpig_plugin_public, 'custom_add_to_cart_redirect');

		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_set_data_in_session', $rtwwcpig_plugin_public, 'set_data_in_session_cb');
		$this->rtwwcpig_loader->rtwwcpig_add_action('wp_ajax_nopriv_set_data_in_session', $rtwwcpig_plugin_public, 'set_data_in_session_cb');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_run() {
		$this->rtwwcpig_loader->rtwwcpig_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function rtwwcpig_get_plugin_name() {
		return $this->rtwwcpig_plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woocommerce_Pdf_Invoice_Generator_Loader    Orchestrates the hooks of the plugin.
	 */
	public function rtwwcpig_get_loader() {
		return $this->rtwwcpig_loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function rtwwcpig_get_version() {
		return $this->rtwwcpig_version;
	}



}
