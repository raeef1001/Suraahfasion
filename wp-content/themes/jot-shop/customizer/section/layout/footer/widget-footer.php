<?php

/******************/
//Widegt footer
/******************/
if(class_exists('Jot_Shop_WP_Customize_Control_Radio_Image')){
               $wp_customize->add_setting(
               'jot_shop_bottom_footer_widget_layout', array(
               'default'           => 'ft-wgt-none',
               'sanitize_callback' => 'sanitize_text_field',
            )
        );
$wp_customize->add_control(
            new Jot_Shop_WP_Customize_Control_Radio_Image(
                $wp_customize, 'jot_shop_bottom_footer_widget_layout', array(
                    'label'    => esc_html__( 'Layout','jot-shop'),
                    'section'  => 'jot-shop-widget-footer',
                    'choices'  => array(
                       'ft-wgt-none'   => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_NONE,
                        ),
                        'ft-wgt-one'   => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_1,
                        ),
                        'ft-wgt-two' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_2,
                        ),
                        'ft-wgt-three' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_3,
                        ),
                        'ft-wgt-four' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_4,
                        ),
                        'ft-wgt-five' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_5,
                        ),
                        'ft-wgt-six' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_6,
                        ),
                        'ft-wgt-seven' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_7,
                        ),
                        'ft-wgt-eight' => array(
                            'url' => JOT_SHOP_FOOTER_WIDGET_LAYOUT_8,
                        ),
                    ),
                )
            )
        );
    } 
/******************************/
/* Widget Redirect
/****************************/
if (class_exists('Jot_Shop_Widegt_Redirect')){ 
$wp_customize->add_setting(
            'jot_shop_bottom_footer_widget_redirect', array(
            'sanitize_callback' => 'sanitize_text_field',
     )
);
$wp_customize->add_control(
            new Jot_Shop_Widegt_Redirect(
                $wp_customize, 'jot_shop_bottom_footer_widget_redirect', array(
                    'section'      => 'jot-shop-widget-footer',
                    'button_text'  => esc_html__( 'Go To Widget', 'jot-shop' ),
                    'button_class' => 'focus-customizer-widget-redirect',  
                )
            )
        );
} 
/****************/
//doc link
/****************/
$wp_customize->add_setting('jot_shop_ftr_wdgt_learn_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_ftr_wdgt_learn_more',
            array(
        'section'    => 'jot-shop-widget-footer',
        'type'      => 'doc-link',
        'url'       => 'https://themehunk.com/docs/jot-shop/#widget-footer',
        'description' => esc_html__( 'To know more go with this', 'jot-shop' ),
        'priority'   =>100,
    )));