<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
if( ! class_exists( 'WP_Customize_Control' ) ){
	return;
}
add_action( 'customize_preview_init', 'jot_shop_focus_section_enqueue');
add_action( 'customize_controls_init', 'jot_shop_focus_section_helper_script_enqueue' );
function jot_shop_focus_section_enqueue(){
	   wp_enqueue_style( 'jot-shop-focus-section-style',JOT_SHOP_THEME_URI . 'customizer/customize-focus-section/css/focus-section.css');
		wp_enqueue_script( 'jot-shop-focus-section-script',JOT_SHOP_THEME_URI . 'customizer/customize-focus-section/js/focus-section.js', array('jquery'),'',false);
	}
function jot_shop_focus_section_helper_script_enqueue(){
		wp_enqueue_script( 'jot-shop-focus-section-addon-script', JOT_SHOP_THEME_URI . 'customizer/customize-focus-section/js/addon-focus-section.js', array('jquery'),'',false);
	}

