<?php
/**
 * The WooCommerce template file
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#woocommerce
 * @package  Jot Shop
 * @since 1.0.0
 */
if ( ! class_exists( 'WooCommerce' ) ){
    return;
}
get_header();
?>
<div id="content" class="page-content">
        	<div class="container">
          <div class="content-wrap" >
        			<div class="main-area">

                 <?php 
    if(class_exists( 'WooCommerce' ) && is_shop()){
       $shoppage_id = get_option( 'woocommerce_shop_page_id' );
        if(get_post_meta( $shoppage_id, 'jot_shop_sidebar_dyn', true )!=='no-sidebar'){
                         get_sidebar();
          }
      }
      elseif(class_exists( 'WooCommerce' ) && is_product()){

                if(get_theme_mod('jot_shop_product_single_sidebar_disable',false) !==true){
                    if(get_post_meta(get_the_ID(), 'jot_shop_sidebar_dyn', true )!=='no-sidebar'){
                         get_sidebar();
                    }
                }
                }elseif(get_post_meta(get_the_ID(), 'jot_shop_sidebar_dyn', true )!=='no-sidebar'){
                    get_sidebar();
                  } 
                 ?><!-- end sidebar-primary  sidebar-content-area-->
                 <div id="primary" class="primary-content-area">
                  <div class="primary-content-wrap">
                          <div class="page-head">
                   <?php jot_shop_get_page_title();?>
                   <?php jot_shop_breadcrumb_trail();?>
                    </div>
                            <?php woocommerce_content();?>  
                           </div> <!-- end primary-content-wrap-->
                </div> <!-- end primary primary-content-area-->
        			</div> <!-- end main-area -->
        		</div>  <!-- end content-wrap -->
        	</div> 
        </div> <!-- end content page-content -->
<?php get_footer();?>
