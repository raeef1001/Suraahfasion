<?php 
//Enable Loader
$wp_customize->add_setting( 'jot_shop_social_original_color', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ));
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_social_original_color', array(
                'label'       => esc_html__('Show Original Color', 'jot-shop'),
                'type'        => 'checkbox',
                'section'     => 'jot-shop-social-icon',
                'settings'    => 'jot_shop_social_original_color',
)));
$wp_customize->add_setting('social_shop_link_facebook', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('social_shop_link_facebook', array(
        'label'    => __('Facebook URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_facebook',
         'type'       => 'text',
        
        ));

$wp_customize->add_setting('social_shop_link_linkedin', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('social_shop_link_linkedin', array(
        'label'    => __('LinkedIn URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_linkedin',
         'type'       => 'text',
        
        ));
$wp_customize->add_setting('social_shop_link_pintrest', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('social_shop_link_pintrest', array(
        'label'    => __('Pinterest URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_pintrest',
         'type'       => 'text',
        
        ));
$wp_customize->add_setting('social_shop_link_twitter', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_twitter', array(
        'label'    => __('Twitter URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_twitter',
         'type'       => 'text',
        ));
$wp_customize->add_setting('social_shop_link_insta', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_insta', array(
        'label'    => __('Instagram URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_insta',
         'type'       => 'text',
        ));
$wp_customize->add_setting('social_shop_link_tumblr', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_tumblr', array(
        'label'    => __('Tumblr URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_tumblr',
         'type'       => 'text',
        ));
$wp_customize->add_setting('social_shop_link_youtube', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_youtube', array(
        'label'    => __('Youtube URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_youtube',
         'type'       => 'text',
        ));
$wp_customize->add_setting('social_shop_link_stumbleupon', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_stumbleupon', array(
        'label'    => __('Stumbleupon URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_stumbleupon',
        'type'     => 'text',
        ));
        $wp_customize->add_setting('social_shop_link_dribble', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_dribble', array(
        'label'    => __('Dribble URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_dribble',
        'type'     => 'text',
        ));

         $wp_customize->add_setting('social_shop_link_skype', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        
        ));
        $wp_customize->add_control('social_shop_link_skype', array(
        'label'    => __('Skype URL', 'jot-shop'),
        'section'  => 'jot-shop-social-icon',
        'settings' => 'social_shop_link_skype',
        'type'     => 'text',
        ));

/****************/
//body doc link
/****************/
$wp_customize->add_setting('jot_shop_social_link_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_social_link_more',
            array(
        'section'     => 'jot-shop-social-icon',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#social-icon',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));