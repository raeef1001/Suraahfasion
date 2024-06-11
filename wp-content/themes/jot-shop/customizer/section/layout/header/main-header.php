<?php
// main header
// choose col layout
if(class_exists('Jot_Shop_WP_Customize_Control_Radio_Image')){
        $wp_customize->add_setting(
            'jot_shop_main_header_layout', array(
                'default'           => 'mhdrthree',
                'sanitize_callback' => 'jot_shop_sanitize_radio',
            )
        );
$wp_customize->add_control(
            new Jot_Shop_WP_Customize_Control_Radio_Image(
                $wp_customize, 'jot_shop_main_header_layout', array(
                    'label'    => esc_html__( 'Header Layout', 'jot-shop' ),
                    'section'  => 'jot-shop-main-header',
                    'choices'  => array(
                        'mhdrthree' => array(
                            'url' => JOT_SHOP_MAIN_HEADER_LAYOUT_ONE,
                        ),
                        'mhdrdefault'   => array(
                            'url' => JOT_SHOP_MAIN_HEADER_LAYOUT_TWO,
                        ),
                        'mhdrone'   => array(
                            'url' => JOT_SHOP_MAIN_HEADER_LAYOUT_THREE,
                        ),
                        'mhdrtwo' => array(
                            'url' => JOT_SHOP_MAIN_HEADER_LAYOUT_FOUR,
                        ),
                        
                                     
                    ),
                    'priority'   => 1,
                )
            )
        );
} 
/***********************************/  
// menu alignment
/***********************************/ 
$wp_customize->add_setting('jot_shop_menu_alignment', array(
                'default'               => 'center',
                'sanitize_callback'     => 'jot_shop_sanitize_select',
            ) );
$wp_customize->add_control( new Jot_Shop_Customizer_Buttonset_Control( $wp_customize, 'jot_shop_menu_alignment', array(
                'label'                 => esc_html__( 'Menu Alignment', 'jot-shop' ),
                'section'               => 'jot-shop-main-header',
                'settings'              => 'jot_shop_menu_alignment',
                'choices'               => array(
                    'left'              => esc_html__( 'Left', 'jot-shop' ),
                    'center'            => esc_html__( 'center', 'jot-shop' ),
                    'right'             => esc_html__( 'Right', 'jot-shop' ),
                ),
                'priority'   => 2,
        ) ) );
//Main menu option
$wp_customize->add_setting('jot_shop_main_header_option', array(
        'default'        => 'none',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_select',
    ));
$wp_customize->add_control( 'jot_shop_main_header_option', array(
        'settings' => 'jot_shop_main_header_option',
        'label'    => __('Right Column','jot-shop'),
        'section'  => 'jot-shop-main-header',
        'type'     => 'select',
        'choices'    => array(
        'none'       => __('None','jot-shop'),
        'callto'     => __('Call-To','jot-shop'),
        'button'     => __('Button (Pro)','jot-shop'),
        
        'widget'     => __('Widget (Pro)','jot-shop'),     
        ),
        'priority'   => 3,
    ));
//**************/
// BUTTON TEXT //
//**************/
$wp_customize->add_setting('jot_shop_main_hdr_btn_txt', array(
        'default' => __('Button Text','jot-shop'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'jot_shop_main_hdr_btn_txt', array(
        'label'    => __('Button Text', 'jot-shop'),
        'section'  => 'jot-shop-main-header',
         'type'    => 'text',
         'priority'   => 4,
));

$wp_customize->add_setting('jot_shop_main_hdr_btn_lnk', array(
        'default' => __('#','jot-shop'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        
));
$wp_customize->add_control( 'jot_shop_main_hdr_btn_lnk', array(
        'label'    => __('Button Link', 'jot-shop'),
        'section'  => 'jot-shop-main-header',
         'type'    => 'text',
         'priority'   => 5,
));
/*****************/
// Call-to
/*****************/
$wp_customize->add_setting('jot_shop_main_hdr_calto_txt', array(
        'default' => __('Call To','jot-shop'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'jot_shop_main_hdr_calto_txt', array(
        'label'    => __('Call To Text', 'jot-shop'),
        'section'  => 'jot-shop-main-header',
         'type'    => 'text',
         'priority'   => 6,
));

$wp_customize->add_setting('jot_shop_main_hdr_calto_nub', array(
        'default' => __('+1800090098','jot-shop'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'jot_shop_main_hdr_calto_nub', array(
        'label'    => __('Call To Number', 'jot-shop'),
        'section'  => 'jot-shop-main-header',
         'type'    => 'text',
         'priority'   => 7,
));

// col1 widget redirection
if (class_exists('Jot_Shop_Widegt_Redirect')){ 
$wp_customize->add_setting(
            'jot_shop_main_header_widget_redirect', array(
            'sanitize_callback' => 'sanitize_text_field',
     )
);
$wp_customize->add_control(
            new Jot_Shop_Widegt_Redirect(
                $wp_customize, 'jot_shop_main_header_widget_redirect', array(
                    'section'      => 'jot-shop-main-header',
                    'button_text'  => esc_html__( 'Go To Widget', 'jot-shop' ),
                    'button_class' => 'focus-customizer-widget-redirect',  
                    'priority'   => 8,
                )
            )
        );
} 
/***********************************/  
// menu alignment
/***********************************/ 
$wp_customize->add_setting('jot_shop_mobile_menu_open', array(
                'default'               => 'left',
                'sanitize_callback'     => 'jot_shop_sanitize_select',
            ) );
$wp_customize->add_control( new Jot_Shop_Customizer_Buttonset_Control( $wp_customize, 'jot_shop_mobile_menu_open', array(
                'label'                 => esc_html__( 'Mobile Menu', 'jot-shop' ),
                'section'               => 'jot-shop-main-header',
                'settings'              => 'jot_shop_mobile_menu_open',
                'choices'               => array(
                    'left'              => esc_html__( 'Left', 'jot-shop' ),
                    // 'overcenter'        => esc_html__( 'center', 'jot-shop' ),
                    'right'             => esc_html__( 'Right', 'jot-shop' ),
                ),
                'priority'   => 9,
        ) ) );

/***********************************/  
// Sticky Header
/***********************************/ 
  $wp_customize->add_setting( 'jot_shop_sticky_header', array(
    'default'           => false,
    'sanitize_callback' => 'jot_shop_sanitize_checkbox',
  ) );
  $wp_customize->add_control( new Jot_Shop_Toggle_Control( $wp_customize, 'jot_shop_sticky_header', array(
    'label'       => esc_html__( 'Sticky Header', 'jot-shop' ),
    'section'     => 'jot-shop-main-header',
    'type'        => 'toggle',
    'settings'    => 'jot_shop_sticky_header',
    'priority'   => 10,
  ) ) );

  $wp_customize->add_setting('jot_shop_sticky_header_effect', array(
        'default'        => 'scrldwmn',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_select',
    ));
$wp_customize->add_control( 'jot_shop_sticky_header_effect', array(
        'settings' => 'jot_shop_sticky_header_effect',
        'label'    => __('Sticky Header Effect','jot-shop'),
        'section'  => 'jot-shop-main-header',
        'type'     => 'select',
        'choices'    => array(
        'scrltop'     => __('Effect One','jot-shop'),
        'scrldwmn'    => __('Effect Two','jot-shop'),
        
        ),
        'priority'   => 11,
    ));
/******************/
// Disable in Mobile
/******************/
$wp_customize->add_setting( 'jot_shop_whislist_mobile_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_whislist_mobile_disable', array(
                'label'                 => esc_html__('Check to disable whislist icon in mobile device', 'jot-shop'),
                'type'                  => 'checkbox',
                'section'               => 'jot-shop-main-header',
                'settings'              => 'jot_shop_whislist_mobile_disable',
                'priority'   => 12,
            ) ) );

$wp_customize->add_setting( 'jot_shop_account_mobile_disable', array(
                'default'               => '',
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_account_mobile_disable', array(
                'label'                 => esc_html__('Check to disable account icon in mobile device', 'jot-shop'),
                'type'                  => 'checkbox',
                'section'               => 'jot-shop-main-header',
                'settings'              => 'jot_shop_account_mobile_disable',
                'priority'   => 13,
            ) ) );

$wp_customize->add_setting( 'jot_shop_cart_mobile_disable', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jot_shop_cart_mobile_disable', array(
                'label'                 => esc_html__('Check to disable cart icon in mobile device', 'jot-shop'),
                'type'                  => 'checkbox',
                'section'               => 'jot-shop-main-header',
                'settings'              => 'jot_shop_cart_mobile_disable',
                'priority'   => 14,
            ) ) );

/****************/
//doc link
/****************/
$wp_customize->add_setting('jot_shop_main_header_doc_learn_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_main_header_doc_learn_more',
            array(
        'section'    => 'jot-shop-main-header',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/jot-shop/#main-header',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));

// exclude header category
function jot_shop_get_category_id($arr='',$all=true){
    $cats = array();
    foreach ( get_categories($arr) as $categories => $category ){
       
        $cats[$category->term_id] = $category->name;
     }
     return $cats;
  }
$wp_customize->add_setting('jot_shop_main_hdr_cat_txt', array(
        'default' => __('All Departments','jot-shop'),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'jot_shop_sanitize_text',
        'transport'         => 'postMessage',
));
$wp_customize->add_control( 'jot_shop_main_hdr_cat_txt', array(
        'label'    => __('Category Text', 'jot-shop'),
        'section'  => 'jot_shop_exclde_cat_header',
         'type'    => 'text',
));
 if (class_exists( 'Jot_Shop_Customize_Control_Checkbox_Multiple')) {
   $wp_customize->add_setting('jot_shop_exclde_category', array(
        'default'           => '',
        'sanitize_callback' => 'jot_shop_checkbox_explode'
    ));
    $wp_customize->add_control(new Jot_Shop_Customize_Control_Checkbox_Multiple(
            $wp_customize,'jot_shop_exclde_category', array(
        'settings'=> 'jot_shop_exclde_category',
        'label'   => __( 'Choose Categories To Exclude', 'jot-shop' ),
        'section' => 'jot_shop_exclde_cat_header',
        'choices' => jot_shop_get_category_id(array('taxonomy' =>'product_cat'),true),
        ) 
    ));

}  
$wp_customize->add_setting('jot_shop_exclde_doc', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_exclde_doc',
            array(
        'section'     => 'jot_shop_exclde_cat_header',
        'type'        => 'doc-link',
        'url'         => 'https://themehunk.com/docs/jot-shop/#exclude-category',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));