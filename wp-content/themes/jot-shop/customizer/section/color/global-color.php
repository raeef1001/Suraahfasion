<?php
/******************/
//Global Option
/******************/

// theme color
 $wp_customize->add_setting('jot_shop_theme_clr', array(
        'default'        => '#ff3377',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_theme_clr', array(
        'label'      => __('Theme Color', 'jot-shop' ),
        'section'    => 'jot-shop-gloabal-color',
        'settings'   => 'jot_shop_theme_clr',
        'priority' => 1,
    ) ) 
 );  
// link color
 $wp_customize->add_setting('jot_shop_link_clr', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_link_clr', array(
        'label'      => __('Link Color', 'jot-shop' ),
        'section'    => 'jot-shop-gloabal-color',
        'settings'   => 'jot_shop_link_clr',
        'priority' => 2,
    ) ) 
 );  
// link hvr color
 $wp_customize->add_setting('jot_shop_link_hvr_clr', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_link_hvr_clr', array(
        'label'      => __('Link Hover Color', 'jot-shop' ),
        'section'    => 'jot-shop-gloabal-color',
        'settings'   => 'jot_shop_link_hvr_clr',
        'priority' => 3,
    ) ) 
 );

// text color
 $wp_customize->add_setting('jot_shop_text_clr', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_text_clr', array(
        'label'      => __('Text Color', 'jot-shop' ),
        'section'    => 'jot-shop-gloabal-color',
        'settings'   => 'jot_shop_text_clr',
        'priority' => 4,
    ) ) 
 );
 // title color
 $wp_customize->add_setting('jot_shop_title_clr', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_title_clr', array(
        'label'      => __('Title Color', 'jot-shop' ),
        'section'    => 'jot-shop-gloabal-color',
        'settings'   => 'jot_shop_title_clr',
        'priority' => 6,
    ) ) 
 );  
// gloabal background option
$wp_customize->get_control( 'background_color' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_color' )->priority = 9;
$wp_customize->get_control( 'background_image' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_image' )->priority = 10;
$wp_customize->get_control( 'background_preset' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_preset' )->priority = 11;
$wp_customize->get_control( 'background_position' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_position' )->priority = 11;
$wp_customize->get_control( 'background_repeat' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_repeat' )->priority = 12;
$wp_customize->get_control( 'background_attachment' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_attachment' )->priority = 13;
$wp_customize->get_control( 'background_size' )->section = 'jot-shop-gloabal-color';
$wp_customize->get_control( 'background_size' )->priority = 14;
/****************/
//doc link
/****************/
$wp_customize->add_setting('jot_shop_global_clr_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_global_clr_more',
            array(
        'section'     => 'jot-shop-gloabal-color',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#color-background',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));