<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       www.redefiningtheweb.com
 * @since      1.0.0
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Rtwwcpig_Woocommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_Woocommerce_Pdf_Invoice_Generator/includes
 * @author     RedefiningTheWeb <developer@redefiningtheweb.com>
 */
class Rtwwcpig_Woocommerce_Pdf_Invoice_Generator_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $rtwwcpig_actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $rtwwcpig_actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $rtwwcpig_filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $rtwwcpig_filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->rtwwcpig_actions = array();
		$this->rtwwcpig_filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $rtwwcpig_hook             The name of the WordPress action that is being registered.
	 * @param    object               $rtwwcpig_component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $rtwwcpig_callback         The name of the function definition on the $rtwwcpig_component.
	 * @param    int                  $rtwwcpig_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $rtwwcpig_accepted_args    Optional. The number of arguments that should be passed to the $rtwwcpig_callback. Default is 1.
	 */
	public function rtwwcpig_add_action( $rtwwcpig_hook, $rtwwcpig_component, $rtwwcpig_callback, $rtwwcpig_priority = 10, $rtwwcpig_accepted_args = 1 ) {
		$this->rtwwcpig_actions = $this->rtwwcpig_add( $this->rtwwcpig_actions, $rtwwcpig_hook, $rtwwcpig_component, $rtwwcpig_callback, $rtwwcpig_priority, $rtwwcpig_accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $rtwwcpig_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $rtwwcpig_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $rtwwcpig_callback         The name of the function definition on the $rtwwcpig_component.
	 * @param    int                  $rtwwcpig_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $rtwwcpig_accepted_args    Optional. The number of arguments that should be passed to the $rtwwcpig_callback. Default is 1
	 */
	public function rtwwcpig_add_filter( $rtwwcpig_hook, $rtwwcpig_component, $rtwwcpig_callback, $rtwwcpig_priority = 10, $rtwwcpig_accepted_args = 1 ) {
		$this->rtwwcpig_filters = $this->rtwwcpig_add( $this->rtwwcpig_filters, $rtwwcpig_hook, $rtwwcpig_component, $rtwwcpig_callback, $rtwwcpig_priority, $rtwwcpig_accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $rtwwcpig_hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $rtwwcpig_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $rtwwcpig_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $rtwwcpig_callback         The name of the function definition on the $component.
	 * @param    int                  $rtwwcpig_priority         The priority at which the function should be fired.
	 * @param    int                  $rtwwcpig_accepted_args    The number of arguments that should be passed to the $rtwwcpig_callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function rtwwcpig_add( $rtwwcpig_hooks, $rtwwcpig_hook, $rtwwcpig_component, $rtwwcpig_callback, $rtwwcpig_priority, $rtwwcpig_accepted_args ) {

		$rtwwcpig_hooks[] = array(
			'hook'          => $rtwwcpig_hook,
			'component'     => $rtwwcpig_component,
			'callback'      => $rtwwcpig_callback,
			'priority'      => $rtwwcpig_priority,
			'accepted_args' => $rtwwcpig_accepted_args
		);

		return $rtwwcpig_hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rtwwcpig_run() {

		foreach ( $this->rtwwcpig_filters as $rtwwcpig_hook ) {
			add_filter( $rtwwcpig_hook['hook'], array( $rtwwcpig_hook['component'], $rtwwcpig_hook['callback'] ), $rtwwcpig_hook['priority'], $rtwwcpig_hook['accepted_args'] );
		}

		foreach ( $this->rtwwcpig_actions as $rtwwcpig_hook ) {
			add_action( $rtwwcpig_hook['hook'], array( $rtwwcpig_hook['component'], $rtwwcpig_hook['callback'] ), $rtwwcpig_hook['priority'], $rtwwcpig_hook['accepted_args'] );
		}

	}

}
