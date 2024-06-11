<?php
/*********************/
// Move To Top
/********************/
 $wp_customize->add_setting( 'jot_shop_move_to_top', array(
    'default'           => false,
    'sanitize_callback' => 'jot_shop_sanitize_checkbox',
  ) );
  $wp_customize->add_control( new Jot_Shop_Toggle_Control( $wp_customize, 'jot_shop_move_to_top', array(
    'label'       => esc_html__( 'Enable', 'jot-shop' ),
    'section'     => 'jot-shop-move-to-top',
    'type'        => 'toggle',
    'settings'    => 'jot_shop_move_to_top',
  ) ) );

  // BG color
 $wp_customize->add_setting('jot_shop_move_to_top_bg_clr', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new Jot_Shop_Customizer_Color_Control($wp_customize,'jot_shop_move_to_top_bg_clr', array(
        'label'      => __('Background Color', 'jot-shop' ),
        'section'    => 'jot-shop-move-to-top',
        'settings'   => 'jot_shop_move_to_top_bg_clr',
    ) ) 
 );  

$wp_customize->add_setting('jot_shop_move_to_top_icon_clr', array(
        'default'        => '#fff',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_color',
        'transport'         => 'postMessage',
    ));
$wp_customize->add_control( 
    new WP_Customize_Color_Control($wp_customize,'jot_shop_move_to_top_icon_clr', array(
        'label'      => __('Icon Color', 'jot-shop' ),
        'section'    => 'jot-shop-move-to-top',
        'settings'   => 'jot_shop_move_to_top_icon_clr',
    ) ) 
 );

/****************/
//doc link
/****************/
$wp_customize->add_setting('jot_shop_movetotop_learn_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_movetotop_learn_more',
            array(
        'section'    => 'jot-shop-move-to-top',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/jot-shop/#back-top',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));
