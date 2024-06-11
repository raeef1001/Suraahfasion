<?php 
/**
 *
 *
 * @package      Jot Shop
 * @author       Jot Shop
 * @copyright    Copyright (c) 2019,  Jot Shop
 * @since        Jot Shop 1.0.0
 */
//General Section
if ( ! class_exists( 'WooCommerce' ) ){
    return;
}
/***************/
// Checkout
/***************/
$wp_customize->add_setting('jot_shop_woo_checkout_distraction_enable', array(
                'default'               => false,
                'sanitize_callback'     => 'jot_shop_sanitize_checkbox',
            ) );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize,'jot_shop_woo_checkout_distraction_enable', array(
                'label'         => esc_html__('Enable Distraction Free Checkout.', 'jot-shop'),
                'type'          => 'checkbox',
                'section'       => 'jot-shop-woo-checkout-page',
                'settings'      => 'jot_shop_woo_checkout_distraction_enable',
            ) ) );

/****************/
// doc link
/****************/
$wp_customize->add_setting('jot_shop_checkout_link_more', array(
    'sanitize_callback' => 'jot_shop_sanitize_text',
    ));
$wp_customize->add_control(new Jot_Shop_Misc_Control( $wp_customize, 'jot_shop_checkout_link_more',
            array(
        'section'     => 'jot-shop-woo-checkout-page',
        'type'        => 'custom_message',
        'description' => sprintf( wp_kses(__( 'To know more go with this <a target="_blank" href="%s">Doc</a> !', 'jot-shop' ), array(  'a' => array( 'href' => array(),'target' => array() ) ) ), esc_url('https://themehunk.com/docs/jot-shop-theme/#checkout-page')),
        'priority'   =>30,
    )));