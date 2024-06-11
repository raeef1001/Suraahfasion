<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jot Shop
 * @since 1.0.0
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php echo esc_attr(get_theme_mod('jot_shop_mobile_header_clr','#fff')); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

	<?php wp_body_open();?>


	<?php 
$page_post_meta_sidebar = '';
if(!is_404() && !is_search() && is_page()){ 
	$page_post_meta_sidebar = get_post_meta(get_the_ID(), 'jot_shop_sidebar_dyn', true );
		
}elseif(is_single() && (class_exists( 'WooCommerce' ) && !is_product())){
	    $page_post_meta_sidebar = get_post_meta(get_the_ID(), 'jot_shop_sidebar_dyn', true );
	    if(get_theme_mod('jot_shop_blog_single_sidebar_disable')==true){
	     	$page_post_meta_sidebar = 'no-sidebar';
	  }	     
}elseif(jot_shop_is_blog()){
	    $blog_page_id = get_option( 'page_for_posts' );
        $page_post_meta_sidebar = get_post_meta( $blog_page_id, 'jot_shop_sidebar_dyn', true );
}elseif(class_exists( 'WooCommerce' ) && is_shop()){
	    $shop_page_id = get_option( 'woocommerce_shop_page_id' );
        $page_post_meta_sidebar = get_post_meta( $shop_page_id, 'jot_shop_sidebar_dyn', true );
}elseif(class_exists( 'WooCommerce' ) && is_product()){
	    $page_post_meta_sidebar = get_post_meta(get_the_ID(), 'jot_shop_sidebar_dyn', true );
	    if(get_theme_mod('jot_shop_product_single_sidebar_disable',false)==true){
	     	$page_post_meta_sidebar = 'no-sidebar';
	      }
}
?>
<?php do_action('jot_shop_site_preloader'); ?>
<div id="page" class="jotshop-site <?php echo esc_attr($page_post_meta_sidebar);?>">
	<header>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jot-shop' ); ?></a>
		<?php do_action( 'jot_shop_sticky_header' ); ?> 
        <!-- sticky header -->
		<?php if(get_theme_mod('jot_shop_above_mobile_disable')==true){
			if (wp_is_mobile()!== true):
             do_action( 'jot_shop_top_header' );  
            endif;
		}elseif(get_theme_mod('jot_shop_above_mobile_disable',false)==false){
			 do_action( 'jot_shop_top_header' );  
		} ?> 
		<!-- end top-header -->
        <?php do_action( 'jot_shop_main_header' ); ?> 
		<!-- end main-header -->
		<?php do_action( 'jot_shop_below_header' );?> 
		<!-- end below-header -->
	</header> <!-- end header -->
		