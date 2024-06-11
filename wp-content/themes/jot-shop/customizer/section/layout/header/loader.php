<?php
//Enable Loader
$wp_customize->add_setting( 'jot_shop_preloader_enable', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_preloader_enable', array(
                'label'                 => esc_html__('Enable Loader', 'jot-shop'),
                'type'                  => 'checkbox',
                'section'               => 'jot-shop-pre-loader',
                'settings'              => 'jot_shop_preloader_enable',
                'priority'   => 1,
            ) ) );
// BG color
 $wp_customize->add_setting('jot_shop_loader_bg_clr', array(
        'default'           => '#9c9c9c',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new Jot_Shop_Customizer_Color_Control($wp_customize,'jot_shop_loader_bg_clr', array(
        'label'      => __('Background Color', 'jot-shop' ),
        'section'    => 'jot-shop-pre-loader',
        'settings'   => 'jot_shop_loader_bg_clr',
        'priority'   => 2,
    ) ) 
 ); 
/*******************/ 
// Pre loader Image
/*******************/ 
$wp_customize->add_setting('jot_shop_preloader_image_upload', array(
        'default'       => '',
        'capability'    => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_upload',
    ));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'jot_shop_preloader_image_upload', array(
        'label'          => __('Pre Loader Image', 'jot-shop'),
        'description'    => __('(You can also use GIF image.)', 'jot-shop'),
        'section'        => 'jot-shop-pre-loader',
        'settings'       => 'jot_shop_preloader_image_upload',
 )));

/****************/
// doc link
/****************/
$wp_customize->add_setting('jot_shop_loader_link_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_loader_link_more',
            array(
        'section'     => 'jot-shop-pre-loader',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#pre-loader',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));
