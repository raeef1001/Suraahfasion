<?php
get_header();
if(empty(get_post_meta( $post->ID, 'jot_shop_sidebar_dyn', true ))){
$jot_shop_sidebar = 'right';
}else{
$jot_shop_sidebar = get_post_meta( $post->ID, 'jot_shop_sidebar_dyn', true );
}
?>
<div id="content" class="page-content thunk-page  <?php echo esc_attr($jot_shop_sidebar); ?>">
          <div class="container">
        	<div class="content-wrap" >
        			<div class="main-area">
        				<div id="primary" class="primary-content-area">
        					<div class="primary-content-wrap">
                    <div class="page-head">
                   <?php jot_shop_get_page_title();?>
                   <?php jot_shop_breadcrumb_trail();?>
                    </div>
                        <div class="thunk-content-wrap">
                        <?php
                            while( have_posts() ) : the_post();
                               get_template_part( 'template-parts/content', 'page' );
                              // If comments are open or we have at least one comment, load up the comment template.
                              if ( comments_open() || get_comments_number() ) :
                                comments_template();
                               endif;
                               endwhile; // End of the loop.
                            ?>
                         </div>
                      </div> <!-- end primary-content-wrap-->
        				</div> <!-- end primary primary-content-area-->
        				<?php 
                if($jot_shop_sidebar != 'no-sidebar' ):
                get_sidebar();
                endif;
                 ?><!-- end sidebar-primary  sidebar-content-area-->
        			</div> <!-- end main-area -->
        		</div>  <!-- end content-wrap -->
        	</div> 
        </div> <!-- end content page-content -->
<?php get_footer();?>