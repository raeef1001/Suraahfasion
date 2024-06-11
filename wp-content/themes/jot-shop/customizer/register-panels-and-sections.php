<?php
/**
 * Register customizer panels & sections.
 */
/*************************/
/*WordPress Default Panel*/
/*************************/
/**
 * Category Section Customizer Settings
 */
if(!function_exists('jot_shop_get_category_list')){
function jot_shop_get_category_list($arr='',$all=true){
    $cats = array();
    foreach ( get_categories($arr) as $categories => $category ){
       
        $cats[$category->slug] = $category->name;
     }
     return $cats;
  }
}

$jot_shop_shop_panel_default = new Jot_Shop_WP_Customize_Panel( $wp_customize,'jot-shop-panel-default', array(
    'priority' => 1,
    'title'    => __( 'WordPress Default', 'jot-shop' ),
  ));
$wp_customize->add_panel($jot_shop_shop_panel_default);
$wp_customize->get_section( 'title_tagline' )->panel = 'jot-shop-panel-default';
$wp_customize->get_section( 'static_front_page' )->panel = 'jot-shop-panel-default';
$wp_customize->get_section( 'custom_css' )->panel = 'jot-shop-panel-default';

$wp_customize->add_setting('jot_shop_home_page_setup', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_home_page_setup',
            array(
        'section'    => 'static_front_page',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/jot-shop/#homepage-setting',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));
/************************/
// Background option
/************************/
$jot_shop_shop_bg_option = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-bg-option', array(
    'title' =>  __( 'Background', 'jot-shop' ),
    'panel' => 'jot-shop-panel-default',
    'priority' => 10,
  ));
$wp_customize->add_section($jot_shop_shop_bg_option);

/*************************/
/*Layout Panel*/
/*************************/
$wp_customize->add_panel( 'jot-shop-panel-layout', array(
				'priority' => 3,
				'title'    => __( 'Layout', 'jot-shop' ),
) );

// Header
$jot_shop_section_header_group = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-section-header-group', array(
    'title' =>  __( 'Header', 'jot-shop' ),
    'panel' => 'jot-shop-panel-layout',
    'priority' => 2,
  ));
$wp_customize->add_section( $jot_shop_section_header_group );

// above-header
$jot_shop_above_header = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-above-header', array(
    'title'    => __( 'Above Header', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-layout',
        'section'  => 'jot-shop-section-header-group',
        'priority' => 3,
  ));
$wp_customize->add_section( $jot_shop_above_header );
// main-header
$jot_shop_shop_main_header = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-main-header', array(
    'title'    => __( 'Main Header', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-layout',
    'section'  => 'jot-shop-section-header-group',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_shop_main_header );

// exclude category
$jot_shop_exclde_cat_header = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_exclde_cat_header', array(
    'title'    => __( 'Exclude Category', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-layout',
    'section'  => 'jot-shop-section-header-group',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_exclde_cat_header );

//blog
$jot_shop_section_blog_group = new  Jot_Shop_WP_Customize_Section( $wp_customize,'jot-shop-section-blog-group', array(
    'title' =>  __( 'Blog', 'jot-shop' ),
    'panel' => 'jot-shop-panel-layout',
    'priority' => 2,
  ));
$wp_customize->add_section($jot_shop_section_blog_group);

$jot_shop_section_footer_group = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-section-footer-group', array(
    'title' =>  __( 'Footer', 'jot-shop' ),
    'panel' => 'jot-shop-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section( $jot_shop_section_footer_group);
// sidebar

$jot_shop_section_sidebar_group = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-section-sidebar-group', array(
    'title' =>  __( 'Sidebar', 'jot-shop' ),
    'panel' => 'jot-shop-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section($jot_shop_section_sidebar_group);
// Scroll to top
$jot_shop_move_to_top = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-move-to-top', array(
    'title' =>  __( 'Move To Top', 'jot-shop' ),
    'panel' => 'jot-shop-panel-layout',
    'priority' => 3,
  ));
$wp_customize->add_section($jot_shop_move_to_top);
//above-footer
$jot_shop_above_footer = new  Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-above-footer',array(
    'title'    => __( 'Above Footer','jot-shop' ),
    'panel'    => 'jot-shop-panel-layout',
        'section'  => 'jot-shop-section-footer-group',
        'priority' => 1,
));
$wp_customize->add_section( $jot_shop_above_footer);
//widget footer
$jot_shop_shop_widget_footer = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-widget-footer', array(
    'title'    => __('Widget Footer','jot-shop'),
    'panel'    => 'jot-shop-panel-layout',
    'section'  => 'jot-shop-section-footer-group',
    'priority' => 5,
));
$wp_customize->add_section( $jot_shop_shop_widget_footer);
//Bottom footer
$jot_shop_shop_bottom_footer = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-bottom-footer', array(
    'title'    => __('Below Footer','jot-shop'),
    'panel'    => 'jot-shop-panel-layout',
    'section'  => 'jot-shop-section-footer-group',
    'priority' => 5,
));
$wp_customize->add_section( $jot_shop_shop_bottom_footer);
/*************************/
/* Preloader */
/*************************/
$wp_customize->add_section( 'jot-shop-pre-loader' , array(
    'title'      => __('Preloader','jot-shop'),
    'priority'   => 30,
) );
/*************************/
/* Social   Icon*/
/*************************/
$jot_shop_social_header = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-social-icon', array(
    'title'    => __( 'Social Icon', 'jot-shop' ),
    'priority' => 30,
  ));
$wp_customize->add_section( $jot_shop_social_header );
/*************************/
/* Frontpage Panel */
/*************************/
$wp_customize->add_panel( 'jot-shop-panel-frontpage', array(
                'priority' => 5,
                'title'    => __( 'Frontpage Sections', 'jot-shop' ),
) );

$jot_shop_top_slider_section = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_top_slider_section', array(
    'title'    => __( 'Top Slider', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_top_slider_section );

$jot_shop_highlight = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_highlight', array(
    'title'    => __( 'Highlight', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_highlight );

$jot_shop_category_tab_section = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_category_tab_section', array(
    'title'    => __( 'Tabbed Product Carousel', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_category_tab_section );



$jot_shop_cat_slide_section = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_cat_slide_section', array(
    'title'    => __( 'Woo Category', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_cat_slide_section );
// ribbon
$jot_shop_ribbon = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_ribbon', array(
    'title'    => __( 'Ribbon', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_ribbon );

$jot_shop_product_slide_section = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_product_slide_section', array(
    'title'    => __( 'Product Carousel', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_product_slide_section );

$jot_shop_banner = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_banner', array(
    'title'    => __( 'Banner', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_banner );

$jot_shop_product_slide_list = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_product_slide_list', array(
    'title'    => __( 'Product List Carousel', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_product_slide_list );


$jot_shop_brand = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_brand', array(
    'title'    => __( 'Brand', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_brand );

$jot_shop_product_tab_image = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_product_tab_image', array(
    'title'    => __( 'Tabbed Image Product Carousel', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_product_tab_image );

$jot_shop_product_big_feature = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_product_big_feature', array(
    'title'    => __( 'Big Featured Product', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_product_big_feature );
$jot_shop_product_cat_list = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_product_cat_list', array(
    'title'    => __( 'Tabbed Product List Carousel', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_product_cat_list );
$jot_shop_1_custom_sec = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_1_custom_sec', array(
    'title'    => __( 'First Custom Section', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_1_custom_sec );

$jot_shop_2_custom_sec = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_2_custom_sec', array(
    'title'    => __( 'Second Custom Section', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_2_custom_sec );

$jot_shop_3_custom_sec = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_3_custom_sec', array(
    'title'    => __( 'Third Custom Section', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_3_custom_sec );

$jot_shop_4_custom_sec = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot_shop_4_custom_sec', array(
    'title'    => __( 'Fourth Custom Section', 'jot-shop' ),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 4,
  ));
$wp_customize->add_section( $jot_shop_4_custom_sec );
/******************/
// Color Option
/******************/
$wp_customize->add_panel( 'jot-shop-panel-color-background', array(
        'priority' => 22,
        'title'    => __( 'Total Color & BG Options', 'jot-shop' ),
    ) );
// Section gloab color and background
$wp_customize->add_section('jot-shop-gloabal-color', array(
    'title'    => __('Global Colors', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 1,
));
//header
$jot_shop_header_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-header-color', array(
    'title'    => __('Header', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_header_color );
$jot_shop_abv_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-abv-header-clr', array(
    'title'    => __('Above Header','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_abv_header_clr);

$jot_shop_main_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-main-header-clr', array(
    'title'    => __('Main Header','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 2,
));
$wp_customize->add_section( $jot_shop_main_header_clr);

$jot_shop_below_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-below-header-clr', array(
    'title'    => __('Below Header','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 3,
));
$wp_customize->add_section( $jot_shop_below_header_clr);

$jot_shop_icon_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-icon-header-clr', array(
    'title'    => __('Shop Icons','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 4,
));
$wp_customize->add_section( $jot_shop_icon_header_clr);
$jot_shop_menu_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-menu-header-clr', array(
    'title'    => __('Main Menu','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 4,
));
$wp_customize->add_section( $jot_shop_menu_header_clr);

$jot_shop_sticky_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-sticky-header-clr', array(
    'title'    => __('Sticky Header','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_sticky_header_clr);


$jot_shop_mobile_pan_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-mobile-pan-clr', array(
    'title'    => __('Mobile','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_mobile_pan_clr);

$jot_shop_canvas_pan_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-canvas-pan-clr', array(
    'title'    => __('Off Canvas Sidebar','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-header-color',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_canvas_pan_clr);

$jot_shop_main_header_header_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-main-header-header-clr', array(
    'title'    => __('Header','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-main-header-clr',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_main_header_header_clr);

// main-menu
$jot_shop_main_header_menu_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-main-header-menu-clr', array(
    'title'    => __('Main Menu','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-main-header-clr',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_main_header_menu_clr);

// header category
$jot_shop_main_header_cat_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-main-header-cat-clr', array(
    'title'    => __('Category','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-main-header-clr',
    'priority' => 3,
));
$wp_customize->add_section($jot_shop_main_header_cat_clr);

//Shop Icon
$jot_shop_main_header_shp_icon = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-main-header-shp-icon', array(
    'title'    => __('Shop Icon','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-main-header-clr',
    'priority' => 5,
));
$wp_customize->add_section($jot_shop_main_header_shp_icon);
/****************/
//Sidebar
/****************/
$jot_shop_sidebar_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-sidebar-color', array(
    'title'    => __('Sidebar', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_sidebar_color );
/****************/
//footer
/****************/
$jot_shop_footer_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-footer-color', array(
    'title'    => __('Footer', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_footer_color );

$jot_shop_abv_footer_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-abv-footer-clr', array(
    'title'    => __('Above Footer','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-footer-color',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_abv_footer_clr);

$jot_shop_footer_widget_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-footer-widget-clr', array(
    'title'    => __('Footer Widget','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-footer-color',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_footer_widget_clr);

$jot_shop_btm_footer_clr = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-btm-footer-clr', array(
    'title'    => __('Bottom Footer','jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-footer-color',
    'priority' => 3,
));
$wp_customize->add_section( $jot_shop_btm_footer_clr);

/****************/
//Woocommerce color
/****************/
$jot_shop_woo_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-woo-color', array(
    'title'    => __('Woocommerce', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 6,
));
$wp_customize->add_section( $jot_shop_woo_color );
// Box Color
$jot_shop_box_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot_shop_box_color', array(
    'title'    => __('Box Color', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-woo-color',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_box_color );
/****************/
//Mobile Nav Bar
/****************/
$jot_shop_mobile_nav_bar = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot_shop_mobile_nav_bar', array(
    'title'    => __('Mobile Nav Bar', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 21,
));
$wp_customize->add_section( $jot_shop_mobile_nav_bar );
// product
$jot_shop_woo_prdct_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-woo-prdct-color', array(
    'title'    => __('Product', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-woo-color',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_woo_prdct_color );
// shopping cart
$jot_shop_woo_cart_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-woo-cart-color', array(
    'title'    => __('Shopping Cart', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-woo-color',
    'priority' => 1,
));
$wp_customize->add_section( $jot_shop_woo_cart_color );

// sale
$jot_shop_woo_prdct_sale_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-woo-prdct-sale-color', array(
    'title'    => __('Sale Badge', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-woo-color',
    'priority' => 2,
));
$wp_customize->add_section( $jot_shop_woo_prdct_sale_color );
// single product
$jot_shop_woo_prdct_single_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-woo-prdct-single-color', array(
    'title'    => __('Single Product', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-woo-color',
    'priority' => 3,
));
$wp_customize->add_section( $jot_shop_woo_prdct_single_color );

/*************************/
// Frontpage
/*************************/
$jot_shop_front_page_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-front-page-color', array(
    'title'    => __('Frontpage', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 4,
));
$wp_customize->add_section($jot_shop_front_page_color);

$jot_shop_top_slider_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-top-slider-color', array(
    'title'    => __('Top Slider', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 1,
));
$wp_customize->add_section($jot_shop_top_slider_color);

$jot_shop_cat_slider_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-cat-slider-color', array(
    'title'    => __('Woo Category', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_cat_slider_color);

$jot_shop_ribbon_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-ribbon-color', array(
    'title'    => __('Ribbon', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_ribbon_color);

$jot_shop_product_slider_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-product-slider-color', array(
    'title'    => __('Product Carousel', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 3,
));
$wp_customize->add_section($jot_shop_product_slider_color);

$jot_shop_product_cat_slide_tab_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-product-cat-slide-tab-color', array(
    'title'    => __('Tabbed Product Carousel', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 3,
));
$wp_customize->add_section($jot_shop_product_cat_slide_tab_color);

$jot_shop_product_list_slide_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-product-list-slide-color', array(
    'title'    => __('Product List Carousel', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 4,
));
$wp_customize->add_section($jot_shop_product_list_slide_color);

$jot_shop_product_list_tab_slide_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-product-list-tab-slide-color', array(
    'title'    => __('Tabbed Product List Carousel', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 5,
));
$wp_customize->add_section($jot_shop_product_list_tab_slide_color);

$jot_shop_banner_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-banner-color', array(
    'title'    => __('Banner', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_banner_color);

$jot_shop_ribbon_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-ribbon-color', array(
    'title'    => __('Ribbon', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_ribbon_color);

$jot_shop_brand_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-brand-color', array(
    'title'    => __('Brand', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_brand_color);

$jot_shop_highlight_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-highlight-color', array(
    'title'    => __('Highlight', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_highlight_color);
$jot_shop_tabimgprd_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-tabimgprd-color', array(
    'title'    => __('Product Tab Image', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_tabimgprd_color);
$jot_shop_big_featured_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-big-featured-color', array(
    'title'    => __('Big Featured Product', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_big_featured_color);
/****************/
//custom section
/****************/
$jot_shop_custom_one_color = new Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-custom-one-color', array(
    'title'    => __('Custom Section', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_custom_one_color);

$jot_shop_custom_two_color = new Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-custom-two-color', array(
    'title'    => __('Custom Section Two', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_custom_two_color);

$jot_shop_custom_three_color = new Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-custom-three-color', array(
    'title'    => __('Custom Section Three', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_custom_three_color);


$jot_shop_custom_four_color = new Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-custom-four-color', array(
    'title'    => __('Custom Section Four', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'section'  => 'jot-shop-front-page-color',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_custom_four_color);

//section ordering
$jot_shop_section_order = new Jot_Shop_WP_Customize_Section($wp_customize,'jot_shop_section_order', array(
    'title'    => __('Section Ordering', 'jot-shop'),
    'panel'    => 'jot-shop-panel-frontpage',
    'priority' => 6,
));
$wp_customize->add_section($jot_shop_section_order);

// pan color
$jot_shop_pan_color = new  Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-pan-color', array(
    'title'    => __('Pan / Mobile Menu Color', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 5,
));
$wp_customize->add_section( $jot_shop_pan_color);
/*********************/
// Page Content Color
/*********************/
$jot_shop_custom_page_content_color = new Jot_Shop_WP_Customize_Section($wp_customize,'jot-shop-page-content-color', array(
    'title'    => __('Content Color', 'jot-shop'),
    'panel'    => 'jot-shop-panel-color-background',
    'priority' => 2,
));
$wp_customize->add_section($jot_shop_custom_page_content_color);
/******************/
// Shop Page
/******************/
$jot_shop_woo_shop = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-woo-shop', array(
    'title'    => __( 'Product Style', 'jot-shop' ),
     'panel'    => 'woocommerce',
     'priority' => 2,
));
$wp_customize->add_section( $jot_shop_woo_shop );

$jot_shop_woo_single_product = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-woo-single-product', array(
    'title'    => __( 'Single Product', 'jot-shop' ),
     'panel'    => 'woocommerce',
     'priority' => 3,
));
$wp_customize->add_section($jot_shop_woo_single_product );

$jot_shop_woo_cart_page = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-woo-cart-page', array(
    'title'    => __( 'Cart Page', 'jot-shop' ),
     'panel'    => 'woocommerce',
     'priority' => 4,
));
$wp_customize->add_section($jot_shop_woo_cart_page);

$jot_shop_woo_shop_page = new Jot_Shop_WP_Customize_Section( $wp_customize, 'jot-shop-woo-shop-page', array(
    'title'    => __( 'Shop Page', 'jot-shop' ),
     'panel'    => 'woocommerce',
     'priority' => 4,
));
$wp_customize->add_section($jot_shop_woo_shop_page);