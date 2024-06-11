<?php 
/**
 * all customizer setting includeed
 *
 * @param  
 * @return mixed|string
 */
function jot_shop_customize_register( $wp_customize ){
//view pro feature
//Registered panel and section
require JOT_SHOP_THEME_DIR . 'customizer/register-panels-and-sections.php';	
//site identity
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/header/set-identity.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/header/header.php';	
//Header
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/header/above-header.php';	
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/header/main-header.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/header/loader.php';
//Footer
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/footer/above-footer.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/footer/widget-footer.php';

//section ordering
require JOT_SHOP_THEME_DIR . 'customizer/section-ordering.php';
//social Icon
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/social-icon/social-icon.php';
//Blog
require JOT_SHOP_THEME_DIR . 'customizer/section/layout/blog/blog.php';
//Color Option
require JOT_SHOP_THEME_DIR . 'customizer/section/color/global-color.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/color/above-header-color.php';


//woo-product
require JOT_SHOP_THEME_DIR . 'customizer/section/woo/product.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/woo/single-product.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/woo/cart.php';
require JOT_SHOP_THEME_DIR . 'customizer/section/woo/shop.php';

// scroller
if ( class_exists('Jot_Shop_Customize_Control_Scroll')){
      $scroller = new Jot_Shop_Customize_Control_Scroll();
  }
}
add_action('customize_register','jot_shop_customize_register');
function jot_shop_is_json( $string ){
    return is_string( $string ) && is_array( json_decode( $string, true ) ) ? true : false;
}