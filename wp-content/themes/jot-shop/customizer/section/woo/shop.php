<?php 
$wp_customize->add_setting('jot_shop_prd_view', array(
        'default'        => 'grid-view',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_select',
    ));
    $wp_customize->add_control('jot_shop_prd_view', array(
        'settings' => 'jot_shop_prd_view',
        'label'   => __('Display Product View','jot-shop'),
        'description' => __('(Select layout to display products at shop page.)','jot-shop'),
        'section' => 'jot-shop-woo-shop-page',
        'type'    => 'select',
        'choices' => array(
        'grid-view'   => __('Grid','jot-shop'), 
        'list-view'     => __('List','jot-shop'),
        
        )
    ));
/************************/
//Shop product pagination
/************************/
   $wp_customize->add_setting('jot_shop_pagination', array(
        'default'        => 'num',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_select',
    ));
    $wp_customize->add_control('jot_shop_pagination', array(
        'settings' => 'jot_shop_pagination',
        'label'   => __('Shop Page Pagination','jot-shop'),
        'section' => 'jot-shop-woo-shop-page',
        'type'    => 'select',
        'choices' => array(
        'num'     => __('Numbered','jot-shop'),
        'click'   => __('Load More (Pro)','jot-shop'), 
        'scroll'  => __('Infinite Scroll (Pro)','jot-shop'), 
        )
    ));

  
$wp_customize->add_setting('jot_shop_pagination_loadmore_btn_text', array(
        'default'           => 'Load More',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        'transport'         => 'postMessage',
        
    ));
$wp_customize->add_control('jot_shop_pagination_loadmore_btn_text', array(
        'label'    => __('Load More Text', 'jot-shop'),
        'section'  => 'jot-shop-woo-shop-page',
        'settings' => 'jot_shop_pagination_loadmore_btn_text',
         'type'    => 'text',
    ));
/****************/
// doc link
/****************/
$wp_customize->add_setting('jot_shop_shop_page_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_shop_page_more',
            array(
        'section'     => 'jot-shop-woo-shop-page',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#shop-page',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>  100,
    )));