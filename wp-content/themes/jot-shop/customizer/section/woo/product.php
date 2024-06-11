<?php
//General Section
if ( ! class_exists( 'WooCommerce' ) ){
    return;
}
// product animation
$wp_customize->add_setting('jot_shop_woo_product_animation', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_select',
    ));
$wp_customize->add_control( 'jot_shop_woo_product_animation', array(
        'settings'=> 'jot_shop_woo_product_animation',
        'label'   => __('Product Image Hover Style','jot-shop'),
        'section' => 'jot-shop-woo-shop',
        'type'    => 'select',
        'choices'    => array(
        'none'            => __('None','jot-shop'),
        'zoom'            => __('Zoom','jot-shop'),
        'swap'            => __('Fade Swap (Pro)','jot-shop'), 
        'slide'           => __('Slide Swap (Pro)','jot-shop'),            
        ),
    ));
/*******************/
//Product Title 
/*******************/
$wp_customize->add_setting('jot_shop_prdct_single', array(
                'default'               => true,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize,'jot_shop_prdct_single', array(
                'label'         => esc_html__('Enable Product Tilte in Single line', 'jot-shop'),
                'type'          => 'checkbox',
                'section'       => 'jot-shop-woo-shop',
                'settings'      => 'jot_shop_prdct_single',
            ) ) );
/*******************/
//Quick view
/*******************/
$wp_customize->add_setting('jot_shop_woo_quickview_enable', array(
                'default'               => true,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize,'jot_shop_woo_quickview_enable', array(
                'label'         => esc_html__('Enable Quick View.', 'jot-shop'),
                'type'          => 'checkbox',
                'section'       => 'jot-shop-woo-shop',
                'settings'      => 'jot_shop_woo_quickview_enable',
            ) ) );
/****************/
// doc link
/****************/
$wp_customize->add_setting('jot_shop_product_style_link_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_product_style_link_more',
            array(
        'section'     => 'jot-shop-woo-shop',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#style-product',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));