<?php 
/**
 * Template Name: Homepage Template
 * @package ThemeHunk
 * @subpackage Jot Shop
 * @since 1.0.0
 */
get_header();
$jot_shop_sidebar = get_post_meta( $post->ID, 'jot_shop_sidebar_dyn', true ); ?>
   <div id="content">
    <div class="container">
          <div class="content-wrap">
           <?php 
           if( shortcode_exists( 'jot-shop' ) && (!defined('JOT_SHOP_PRO') && class_exists('WooCommerce'))){
             require_once (THEMEHUNK_CUSTOMIZER_PLUGIN_PATH . 'jot-shop/jot-shop-front-page/front-topslider.php');
           }
           elseif (defined('JOT_SHOP_PRO') && class_exists('WooCommerce')) {
            require_once (JOT_SHOP_PRO_DIR_PATH . 'front-page/front-topslider.php');
           }
           ?>
              <div class="main-area">
                <?php 
                if ( $jot_shop_sidebar != 'no-sidebar') {
                get_sidebar('primary');
                } ?>
                <div id="primary" class="primary-content-area">
                  <div class="primary-content-wrap">
                        <?php
                          if( shortcode_exists( 'jot-shop' ) ){
                             do_shortcode("[jot-shop section='jot_shop_show_frontpage']");
                          }
                        ?>
                  </div>  <!-- end primary-content-wrap-->
                </div>  <!-- end primary primary-content-area-->
                
              </div> <!-- end main-area -->
          </div> <!-- end content-wrap -->
        </div> <!-- end content page-content -->
      </div>
<?php get_footer();