<?php 
/**
 * all file includeed
 *
 * @param  
 * @return mixed|string
 */
get_template_part( 'inc/admin-function');
get_template_part( 'inc/header-function');
get_template_part( 'inc/footer-function');
get_template_part( 'inc/blog-function');
// theme-option
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if ( !is_plugin_active('jot-shop-pro/jot-shop-pro.php') ) {
get_template_part( 'lib/th-option/th-option');
//CHILD THEME 
// get_template_part( 'lib/th-option/child-notify');

}
//breadcrumbs
get_template_part( 'lib/breadcrumbs/breadcrumbs');
//page-post-meta
get_template_part( 'lib/page-meta-box/jotshop-page-meta-box');
//custom-style
get_template_part( 'inc/jot-shop-custom-style');
// customizer
get_template_part('customizer/models/class-jot-shop-singleton');
get_template_part('customizer/models/class-jot-shop-defaults-models');
get_template_part('customizer/repeater/class-jot-shop-repeater');
get_template_part('customizer/extend-customizer/class-jot-shop-wp-customize-panel');
get_template_part('customizer/extend-customizer/class-jot-shop-wp-customize-section');
get_template_part('customizer/customizer-radio-image/class/class-jot-shop-customize-control-radio-image');
get_template_part('customizer/customizer-range-value/class/class-jot-shop-customizer-range-value-control');
get_template_part('customizer/customizer-scroll/class/class-jot-shop-customize-control-scroll');
get_template_part('customizer/customize-focus-section/jot-shop-focus-section');
get_template_part('customizer/color/class-control-color');
get_template_part('customizer/customize-buttonset/class-control-buttonset');
get_template_part('customizer/sortable/class-open-control-sortable');
get_template_part('customizer/background/class-jot-shop-background-image-control');
get_template_part('customizer/customizer-tabs/class-jot-shop-customize-control-tabs');
get_template_part('customizer/customizer-toggle/class-jot-shop-toggle-control');

get_template_part('customizer/custom-customizer');
get_template_part('customizer/customizer-constant');
get_template_part('customizer/customizer');
/******************************/
// woocommerce
/******************************/
get_template_part( 'inc/woocommerce/woo-core');
get_template_part( 'inc/woocommerce/woo-function');
get_template_part('inc/woocommerce/woocommerce-ajax');

