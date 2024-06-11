<?php 
/**
 * Perform all main WooCommerce configurations for this theme
 *
 * @package  Jot Shop WordPress theme
 */
// If plugin - 'WooCommerce' not exist then return.
if ( ! class_exists( 'WooCommerce' ) ){
	   return;
}

if ( ! function_exists( 'is_plugin_active' ) ){
  require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/*******************************/
/** Sidebar Add Cart Product **/
/*******************************/
if ( ! function_exists( 'jot_shop_cart_total_item' ) ){
  /**
   * Cart Link
   * Displayed a link to the cart including the number of items present and the cart total
   */
 function jot_shop_cart_total_item(){
   global $woocommerce; 
   $product_no = WC()->cart->get_cart_contents_count();
  ?>
 <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','jot-shop' ); ?>">
  <i class="fa fa-shopping-basket"></i>
  <?php if ($product_no > 0) { ?>
  <span class="count-item"><?php echo WC()->cart->get_cart_contents_count();?></span>
  <span class="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>
<?php }  ?>
</a>
  <?php }
}
function jot_shop_woo_cart_product(){
  if ( shortcode_exists('taiowc') ){
    echo do_shortcode('[taiowc]'); 
  }
  elseif( shortcode_exists('taiowcp') ){
    echo do_shortcode('[taiowcp]');

  }
}
add_action( 'jot_shop_woo_cart', 'jot_shop_woo_cart_product' );
add_filter('woocommerce_add_to_cart_fragments', 'jot_shop_add_to_cart_dropdown_fragment');
function jot_shop_add_to_cart_dropdown_fragment( $fragments ){
   global $woocommerce;
   ob_start();
   ?>
   <div class="open-quickcart-dropdown">
       <?php woocommerce_mini_cart(); ?>
   </div>
   <?php $fragments['div.open-quickcart-dropdown'] = ob_get_clean();
   return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'jot_shop_add_to_cart_fragment');
function jot_shop_add_to_cart_fragment($fragments) {
        ob_start();
        $product_no = WC()->cart->get_cart_contents_count(); ?>

        <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart','jot-shop' ); ?>">
          <i class="fa fa-shopping-basket"></i> 
          <?php if ($product_no > 0) { ?>
          <span class="count-item"><?php echo WC()->cart->get_cart_contents_count();?></span>
          <span class="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>
           <?php }?>
        </a>

       <?php  $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
/***********************************************/
//Sort section Woocommerce category filter show
/***********************************************/
function jot_shop_add_to_cart_url($product){
 $cart_url =  apply_filters( 'woocommerce_loop_add_to_cart_link',
    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button th-button %s %s"><span>%s</span></a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        $product->is_purchasable() && $product->is_in_stock() && $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
        esc_html( $product->add_to_cart_text() )
    ),$product );
 return $cart_url;
}

/**********************************/
//Shop Product Markup
/**********************************/
if ( ! function_exists( 'jot_shop_product_meta_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_meta_start(){
    echo '<div class="thunk-product-wrap"><div class="thunk-product">';
  }
}
if ( ! function_exists( 'jot_shop_product_meta_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_meta_end(){

    echo '</div></div>';
  }
}
/**********************************/
//Shop Product Image Markup
/**********************************/
if ( ! function_exists( 'jot_shop_product_image_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_image_start(){
    echo '<div class="thunk-product-image">';
  }
}
if ( ! function_exists( 'jot_shop_product_image_end' ) ){

  /**
   * Thumbnail wrap start.
   */
    function jot_shop_product_image_end(){
    
    echo '</div>';
  }
}

/**
   * add to cart start.
   */
 if ( ! function_exists( 'add_to_cart' ) ){
  function add_to_cart(){

    echo'<div class="add-to-cart">';
    // do_action('jot_shop_wishlist');
    // do_action('jot_shop_compare');

    echo woocommerce_template_loop_add_to_cart();

    echo '</div>';
      
  }
}

if ( ! function_exists( 'jot_shop_product_content_start' ) ){
  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_content_start(){
    echo '<div class="thunk-product-content">';
  }
}
if ( ! function_exists( 'jot_shop_product_content_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_content_end(){

    echo '</div>';
  }
}
 /**
   * Thunk-product-hover start.
   */
 if ( ! function_exists( 'jot_shop_product_hover_start' ) ){
  function jot_shop_product_hover_start(){

    echo'<div class="thunk-product-hover">';
    // do_action('jot_shop_wishlist');
    // do_action('jot_shop_compare');
    

      
  }
}
if ( ! function_exists( 'jot_shop_product_hover_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_product_hover_end(){
    
    echo '</div>';
  }
}

if ( ! function_exists( 'jot_shop_shop_content_start' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_shop_content_start(){
    $viewshow = get_theme_mod('jot_shop_prd_view','grid-view');
    if($viewshow == 'grid-view'){
    echo '<div id="shop-product-wrap" class="thunk-grid-view">';
    }else{
    echo '<div id="shop-product-wrap" class="thunk-list-view">';
    }
  }
}

if ( ! function_exists( 'jot_shop_shop_content_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_shop_content_end(){
    
    echo '</div>';
  }
}

function jot_shop_quickview(){
do_action('quickview');
}
/**
* Shop customization.
*
* @return void
*/
add_action( 'woocommerce_before_shop_loop_item', 'jot_shop_product_meta_start', 10);
add_action( 'woocommerce_after_shop_loop_item', 'jot_shop_product_meta_end', 12 );
add_action( 'woocommerce_before_shop_loop_item_title', 'jot_shop_product_content_start',20);
add_action( 'woocommerce_after_shop_loop_item_title', 'jot_shop_product_content_end', 20 );
add_action( 'woocommerce_after_shop_loop_item_title', 'jot_shop_product_hover_start',50);
add_action( 'woocommerce_after_shop_loop_item', 'jot_shop_product_hover_end',20);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',20);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open',5);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 0);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',20);
add_action( 'woocommerce_before_shop_loop_item_title', 'jot_shop_product_image_start', 0);
add_action( 'woocommerce_before_shop_loop_item_title', 'jot_shop_product_image_end',10 );

add_action( 'woocommerce_after_shop_loop_item', 'jot_shop_quickview',11);
add_action( 'woocommerce_after_shop_loop_item', 'jot_shop_whish_list',11);
//for th compare plugin
add_action( 'woocommerce_after_shop_loop_item', 'jot_shop_add_to_compare_fltr',11);


//for add to cart 
add_action( 'woocommerce_before_shop_loop_item_title', 'add_to_cart', 1 );

add_action( 'woocommerce_before_shop_loop', 'jot_shop_shop_content_start',1);
add_action( 'woocommerce_after_shop_loop', 'jot_shop_shop_content_end',1);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//To disable th compare button 
remove_action('woocommerce_init','th_compare_add_action_shop_list');
//To disable th compare Pro button 
remove_action('woocommerce_init', 'tpcp_add_action_shop_list');
/***************/
// single page
/***************/
if ( ! function_exists( 'jot_shop_single_summary_start' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_single_summary_start(){
    
    echo '<div class="thunk-single-product-summary-wrap single">';
  }
}
if( ! function_exists( 'jot_shop_single_summary_end' ) ){

  /**
   * Thumbnail wrap start.
   */
  function jot_shop_single_summary_end(){
    
    echo '</div>';
  }
}
add_action( 'woocommerce_before_single_product_summary', 'jot_shop_single_summary_start',0);
add_action( 'woocommerce_after_single_product_summary', 'jot_shop_single_summary_end',0);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs',40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_filter( 'woocommerce_product_tabs', 'jot_shop_woocommerce_custom_product_tabs', 40 );

function jot_shop_woocommerce_custom_product_tabs( $tabs ) {
     $tabs['delivery_information'] = array(
        'title'     => __( 'Meta Information', 'jot-shop' ),
        'priority'  => 10,
        'callback'  => 'woocommerce_product_meta_tab'
    );
   return $tabs;
}
function woocommerce_product_meta_tab(){// this is where you indicate what appears in the description tab
wc_get_template( 'single-product/meta.php' ); // The meta content first
}

/**
 * Add next/prev buttons @ WooCommerce Single Product Page
 */
 
add_action( 'woocommerce_single_product_summary', 'jot_shop_prev_next_product',0 );
 
// and if you also want them at the bottom...
add_action( 'woocommerce_single_product_summary', 'jot_shop_prev_next_product',0 );
 
function jot_shop_prev_next_product(){
 
echo '<div class="prev_next_buttons">';
 
   // 'product_cat' will make sure to return next/prev from current category
   $previous = next_post_link('%link', '&larr;', TRUE, ' ', 'product_cat');
   $next = previous_post_link('%link', '&rarr;', TRUE, ' ', 'product_cat');
 
   echo $previous;
   echo $next;
    
echo '</div>';
         
}
/****************/
// add to compare
/****************/
function jot_shop_add_to_compare_fltr($pid = ''){
      if (is_shop()) {
        global $product;
        $product_id='';
        if(!empty($product)){    
        $product_id = $product->get_id();
        }
      } else{
        $product_id = $pid;
      }
      
    if(class_exists('th_product_compare') || class_exists('Tpcp_product_compare')){
    echo '<div class="thunk-compare"><span class="compare-list"><div class="woocommerce product compare-button">
          <a class="th-product-compare-btn compare button" data-th-product-id="'.$product_id.'"></a>
          </div></span></div>';

           }
        }


/**********************/
/** wishlist **/
/**********************/
function jot_shop_whish_list($pid = ''){
       if( shortcode_exists( 'yith_wcwl_add_to_wishlist' )){
       echo '<div class="thunk-wishlist"><span class="thunk-wishlist-inner">'.do_shortcode('[yith_wcwl_add_to_wishlist product_id='.$pid.' icon="th-icon th-icon-heart1" label='.__('wishlist','jot-shop').' already_in_wishslist_text='.__('Already','jot-shop').' browse_wishlist_text='.__('Added','jot-shop').']' ).'</span></div>';
       }
 } 

function jot_shop_whishlist_url(){
$wishlist_page_id =  get_option( 'yith_wcwl_wishlist_page_id' );
$wishlist_permalink = get_the_permalink( $wishlist_page_id );
return $wishlist_permalink ;
} 


function jot_shop_compare_wishlist_check($pid=''){

   if( class_exists( 'th_product_compare' )){
          echo jot_shop_add_to_compare_fltr($pid);
        }
                    
                if( class_exists( 'YITH_WCWL' )){
                      jot_shop_whish_list($pid);
                    }

}


// shop open
/** My Account Menu **/
function jot_shop_account(){
 if ( is_user_logged_in() ){
  $return = '<a class="account" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><i class="th-icon th-icon-user"></i><span class="tooltiptext">'.__('Account','jot-shop').'</span></a>';
  } 
 else {
  $return = '<a class="account" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><i class="th-icon th-icon-lock1"></i><span class="tooltiptext">'.__('Register','jot-shop').'</span></a>';
}
 echo $return;
 }

 // Plus Minus Quantity Buttons @ WooCommerce Single Product Page
add_action( 'woocommerce_before_add_to_cart_quantity', 'jot_shop_display_quantity_minus',10,2 );
function jot_shop_display_quantity_minus(){
    echo '<div class="jot-shop-quantity"><button type="button" class="minus" >-</button>';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'jot_shop_display_quantity_plus',10,2 );
function jot_shop_display_quantity_plus(){
    echo '<button type="button" class="plus" >+</button></div>';
}

//Woocommerce: How to remove page-title at the home/shop page but not category pages
add_filter( 'woocommerce_show_page_title', 'jot_shop_not_a_shop_page' );
function jot_shop_not_a_shop_page() {
    return boolval(!is_shop());
}

//***********************/
// product category list
//************************/
function jot_shop_product_list_categories( $args = '' ){
$term = get_theme_mod('jot_shop_exclde_category');
if(!empty($term[0])){
  $exclude_id = $term;
  }else{
  $exclude_id = '';
 }
$defaults = array(
        'child_of'            => 0,
        'current_category'    => 0,
        'depth'               => 5,
        'echo'                => 0,
        'exclude'             => $exclude_id,
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 1,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories','jot-shop' ),
        'style'               => 'list',
        'taxonomy'            => 'product_cat',
        'title_li'            => '',
        'use_desc_for_title'  => 0,
    );
 $html = wp_list_categories($defaults);
        echo '<ul class="product-cat-list thunk-product-cat-list" data-menu-style="vertical">'.$html.'</ul>';
  }
function jot_shop_product_list_categories_mobile( $args = '' ){
  $term = get_theme_mod('jot_shop_exclde_category');
if(!empty($term[0])){
  $exclude_id = $term;
  }else{
  $exclude_id = '';
 }
    $defaults = array(
        'child_of'            => 0,
        'current_category'    => 0,
        'depth'               => 5,
        'echo'                => 0,
        'exclude'             => $exclude_id,
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => 1,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'menu_order',
        'separator'           => '<br />',
        'show_count'          => 0,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories','jot-shop' ),
        'style'               => 'list',
        'taxonomy'            => 'product_cat',
        'title_li'            => '',
        'use_desc_for_title'  => 0,
    );
 $html = wp_list_categories($defaults);
        echo '<ul class="thunk-product-cat-list mobile" data-menu-style="accordion">'.$html.'</ul>';
  }