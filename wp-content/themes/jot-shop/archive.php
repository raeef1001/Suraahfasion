<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jot Shop
 * @since 1.0.0
 */
get_header();
if(empty(get_post_meta( $post->ID, 'jot_shop_sidebar_dyn', true ))){
$jot_shop_sidebar = 'right';
}else{
$jot_shop_sidebar = get_post_meta( $post->ID, 'jot_shop_sidebar_dyn', true );
} ?>
<div id="content" class="page-content archive  <?php echo esc_attr($jot_shop_sidebar); ?>">
            <div class="content-wrap" >
                <div class="container">
                    <div class="main-area">
                        <div id="primary" class="primary-content-area">
                            <div class="primary-content-wrap">
                            <div class="page-head">
                   <?php jot_shop_get_page_title();?>
                   <?php jot_shop_breadcrumb_trail();?>
                    </div>
                            <div class="primary-content-wrap">
                                 <?php
            if( have_posts()):
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                get_template_part( 'template-parts/content', get_post_format() );
                endwhile;
                
            else :
                get_template_part( 'template-parts/content', 'none' );
            endif;

           jot_shop_post_loader();
            ?>
                           </div> <!-- end primary-content-wrap-->
                       </div>
                        </div> <!-- end primary primary-content-area-->
                        <?php if(jot_shop_is_blog()){
                               if(get_post_meta(get_option( 'page_for_posts' ),$jot_shop_sidebar)!='no-sidebar'){
                                            get_sidebar();
                            }
                        } ?><!-- end sidebar-primary  sidebar-content-area-->
                    </div> <!-- end main-area -->
                </div>
            </div> <!-- end content-wrap -->
        </div> <!-- end content page-content -->
<?php get_footer();?>