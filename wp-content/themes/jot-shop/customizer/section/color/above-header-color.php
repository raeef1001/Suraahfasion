<?php 
/******************/
//Above Header
/******************/

// BG color
 $wp_customize->add_setting('jot_shop_above_hd_bg_clr', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new Jot_Shop_Customizer_Color_Control($wp_customize,'jot_shop_above_hd_bg_clr', array(
        'label'      => __('Background Color', 'jot-shop' ),
        'section'    => 'jot-shop-abv-header-clr',
        'settings'   => 'jot_shop_above_hd_bg_clr',
        'priority'   => 2,
    ) ) 
 );  

// above content header
$wp_customize->add_setting('jot_shop_divide_abv_hdr_content', array(
        'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control( new jot_shop_Misc_Control( $wp_customize, 'jot_shop_divide_abv_hdr_content',
            array(
        'section'     => 'jot-shop-abv-header-clr',
        'type'        => 'custom_message',
        'description' => wp_kses_post('Above Header Content','jot-shop' ),
        'priority'    => 3,
)));

$wp_customize->add_setting('jot_shop_abv_content_txt_clr', array(
        'default'        => '#111',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_abv_content_txt_clr', array(
        'label'      => __('Text Color', 'jot-shop' ),
        'section'    => 'jot-shop-abv-header-clr',
        'settings'   => 'jot_shop_abv_content_txt_clr',
        'priority' => 4,
    ) ) 
 );

$wp_customize->add_setting('jot_shop_abv_content_link_clr', array(
        'default'           => '#111',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_abv_content_link_clr', array(
        'label'      => __('Link Color', 'jot-shop' ),
        'section'    => 'jot-shop-abv-header-clr',
        'settings'   => 'jot_shop_abv_content_link_clr',
        'priority'   => 16,
    ) ) 
 );


/****************/
//doc link
/****************/
$wp_customize->add_setting('jot_shop_abv_hrd_doc_learn_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new jot_shop_Misc_Control( $wp_customize, 'jot_shop_abv_hrd_doc_learn_more',
            array(
        'section'     => 'jot-shop-abv-header-clr',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop-pro/#header-color',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));