<?php
/**
 * Perform WooCommerce function with Ajax
 *
 * @package Open WordPress theme
 */
add_action( 'wp_ajax_jot_shop_product_remove', 'jot_shop_product_remove' );
add_action( 'wp_ajax_nopriv_jot_shop_product_remove', 'jot_shop_product_remove' );
function  jot_shop_product_remove(){
    global $woocommerce;
    $cart = $woocommerce->cart;
    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item){
    if($cart_item['product_id'] == $_POST['product_id'] ){
        // Remove product in the cart using  cart_item_key.
        $cart->remove_cart_item($cart_item_key);
        woocommerce_mini_cart();
        exit();
      }
    }
  die();
}

function jot_shop_product_count_update(){
   global $woocommerce; 
  ?>
<span class="cart-content"><?php echo sprintf ( _n( '<span class="count-item">%d <span class="item">item</span></span>', '<span class="count-item">%d <span class="item">items</span></span>', WC()->cart->get_cart_contents_count(),'jot-shop' ), WC()->cart->get_cart_contents_count(),'jot-shop'); ?><?php echo WC()->cart->get_cart_total(); ?></span>
<?php 
  die();
}
add_action( 'wp_ajax_jot_shop_product_count_update', 'jot_shop_product_count_update' );
add_action( 'wp_ajax_nopriv_jot_shop_product_count_update', 'jot_shop_product_count_update' );