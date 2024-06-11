<?php 
/**
 * Header Function for jot shop theme.
 * 
 * @package     jot shop
 * @author      jot shop
 * @copyright   Copyright (c) 2021, jot shop
 * @since       jot shop 1.0.0
 */
/**************************************/
//Top Header function
/**************************************/
if ( ! function_exists( 'jot_shop_top_header_markup' ) ){	
function jot_shop_top_header_markup(){ 
$jot_shop_above_header_layout     = get_theme_mod( 'jot_shop_above_header_layout','abv-none');
$jot_shop_above_header_col1_set   = get_theme_mod( 'jot_shop_above_header_col1_set','text');
$jot_shop_above_header_col2_set   = get_theme_mod( 'jot_shop_above_header_col2_set','text');
$jot_shop_above_header_col3_set   = get_theme_mod( 'jot_shop_above_header_col3_set','text');
$jot_shop_menu_open = get_theme_mod('jot_shop_mobile_menu_open','left');
if($jot_shop_above_header_layout!=='abv-none'):?> 
<div class="top-header">
      <div class="container">
      	<?php if($jot_shop_above_header_layout=='abv-three'){?>
        <div class="top-header-bar thnk-col-3">
          <div class="top-header-col1"> 
          	<?php jot_shop_top_header_conetnt_col1($jot_shop_above_header_col1_set,$jot_shop_menu_open); ?>
          </div>
          <div class="top-header-col2">
          	<?php jot_shop_top_header_conetnt_col2($jot_shop_above_header_col2_set,$jot_shop_menu_open); ?>
          </div>
          <div class="top-header-col3">
          	<?php jot_shop_top_header_conetnt_col3($jot_shop_above_header_col3_set,$jot_shop_menu_open); ?>
          </div>
        </div> 
    <?php } ?>
    <?php if($jot_shop_above_header_layout=='abv-two'){?>
        <div class="top-header-bar thnk-col-2">
          <div class="top-header-col1"> 
          	<?php jot_shop_top_header_conetnt_col1($jot_shop_above_header_col1_set,$jot_shop_menu_open); ?>
          </div>
          <div class="top-header-col2">
          	<?php jot_shop_top_header_conetnt_col2($jot_shop_above_header_col2_set,$jot_shop_menu_open); ?>
          </div>
        </div> 
    <?php } ?>
    <?php if($jot_shop_above_header_layout=='abv-one'){
    	?>
        <div class="top-header-bar thnk-col-1">
          <div class="top-header-col1"> 
          	<?php jot_shop_top_header_conetnt_col1($jot_shop_above_header_col1_set,$jot_shop_menu_open); ?>
          </div>
        </div> 
    <?php } ?>
      <!-- end top-header-bar -->
   </div>
</div>
<?php endif;
   }
}
add_action( 'jot_shop_top_header', 'jot_shop_top_header_markup' );
//************************************/
// Top header col1 function
//************************************/
if ( ! function_exists( 'jot_shop_top_header_conetnt_col1' ) ){ 
function jot_shop_top_header_conetnt_col1($content,$mobileopen){ ?>
<?php if($content=='text'){?>
<div class='content-html'>
  <?php echo esc_html(get_theme_mod('jot_shop_col1_texthtml',  __( 'Add your content here', 'jot-shop' )));?>
</div>
<?php }elseif($content=='menu'){
if ( has_nav_menu('jot-shop-above-menu' ) ){?>
<!-- Menu Toggle btn-->
     <nav> 
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn-abv">
              <div class="btn">
                <i class="th-icon th-icon-TextEditor-Icons-01"></i>
                </div>
            </button>
        </div>
        <div class="sider above jot-shop-menu-hide  <?php echo esc_attr($mobileopen);?>">
        <div class="sider-inner">
        <?php jot_shop_abv_nav_menu();?>
        </div>
      </div>
    </nav>
<?php 
  }else{?>
<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Assign Above header menu', 'jot-shop' );?></a>
 <?php }
}elseif($content=='widget'){?>
  <div class="content-widget">
    <?php if( is_active_sidebar('top-header-widget-col1' ) ){
    dynamic_sidebar('top-header-widget-col1' );
     }else{?>
      <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Add Widget', 'jot-shop' );?></a>
     <?php }?>
     </div>
<?php }elseif($content=='social'){?>
<div class="content-social">
<?php echo jot_shop_social_links();?>
</div>
<?php }elseif($content=='none'){
return true;
}?>
<?php }
}
//************************************/
// top header col2 function
//************************************/
if ( ! function_exists( 'jot_shop_top_header_conetnt_col2' ) ){ 
function jot_shop_top_header_conetnt_col2($content,$mobileopen){ ?>
<?php if($content=='text'){?>
<div class='content-html'>
  <?php echo esc_html(get_theme_mod('jot_shop_col2_texthtml',  __( 'Add your content here', 'jot-shop' )));?>
</div>
<?php }elseif($content=='menu'){
  if ( has_nav_menu('jot-shop-above-menu' ) ){?>
<!-- Menu Toggle btn-->
        <nav> 
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn-abv">
                <div class="btn">
                 <i class="th-icon th-icon-TextEditor-Icons-01"></i>
                </div>
            </button>
        </div>
        <div class="sider above jot-shop-menu-hide <?php echo esc_attr($mobileopen);?>">
        <div class="sider-inner">
        <?php jot_shop_abv_nav_menu();?>
        </div>
      </div>
    </nav>
<?php 
 }else{?>
<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Assign Above header menu', 'jot-shop' );?></a>
 <?php }
}
elseif($content=='widget'){?>
  <div class="content-widget">
    <?php if( is_active_sidebar('top-header-widget-col2' ) ){
    dynamic_sidebar('top-header-widget-col2' );
     }else{?>
      <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Add Widget', 'jot-shop' );?></a>
     <?php }?>
     </div>
<?php }elseif($content=='social'){?>
<div class="content-social">
<?php echo jot_shop_social_links();?>
</div>
<?php }elseif($content=='none'){
return true;
}?>
<?php }
}
//************************************/
// top header col3 function
//************************************/
if ( ! function_exists( 'jot_shop_top_header_conetnt_col3' ) ){ 
function jot_shop_top_header_conetnt_col3($content,$mobileopen){ ?>
<?php if($content=='text'){?>
<div class='content-html'>
  <?php echo esc_html(get_theme_mod('jot_shop_col3_texthtml',  __( 'Add your content here', 'jot-shop' )));?>
</div>
<?php }elseif($content=='menu'){
  if ( has_nav_menu('jot-shop-above-menu' ) ){?>
<!-- Menu Toggle btn-->
        <nav> 
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn-abv">
                <div class="btn">
                 <i class="th-icon th-icon-TextEditor-Icons-01"></i>
                </div>
            </button>
        </div>
        <div class="sider above jot-shop-menu-hide <?php echo esc_attr($mobileopen);?>">
        <div class="sider-inner">
        <?php jot_shop_abv_nav_menu();?>
        </div>
      </div>
    </nav>
<?php 
 }else{?>
<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Assign Above header menu', 'jot-shop' );?></a>
 <?php }
}
elseif($content=='widget'){?>
  <div class="content-widget">
    <?php if( is_active_sidebar('top-header-widget-col3' ) ){
    dynamic_sidebar('top-header-widget-col3' );
     }else{?>
      <a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Add Widget', 'jot-shop' );?></a>
     <?php }?>
     </div>
<?php }elseif($content=='social'){?>
<div class="content-social">
<?php echo jot_shop_social_links();?>
</div>
<?php }elseif($content=='none'){
return true;
}?>
<?php }
}
/**************************************/
//Below Header function
/**************************************/
if ( ! function_exists( 'jot_shop_below_header_markup' ) ){	
function jot_shop_below_header_markup(){ 
$main_header_layout = get_theme_mod('jot_shop_main_header_layout','mhdrthree');
$jot_shop_menu_alignment = get_theme_mod('jot_shop_menu_alignment','center');
$jot_shop_menu_open = get_theme_mod('jot_shop_mobile_menu_open','left');
if($main_header_layout!=='mhdrtwo'):?> 
<div class="below-header  <?php echo esc_attr($main_header_layout);?> <?php echo esc_attr($jot_shop_menu_alignment);?>">
			<div class="container">
				<div class="below-header-bar thnk-col-3">
          <?php if ( class_exists( 'WooCommerce' ) ){ ?>
					<div class="below-header-col1">
						<div class="menu-category-list toogleclose">
						  <div class="toggle-cat-wrap">
						  	  <p class="cat-toggle" tabindex="0">
                    <span class="cat-icon"> 
                      <span class="cat-top"></span>
                       <span class="cat-mid"></span>
                       <span class="cat-bot"></span>
                     </span>
						  	  	<span class="toggle-title">
                      <?php echo esc_html(get_theme_mod('jot_shop_main_hdr_cat_txt','All Departments'));?>
                        
                      </span>
						  	  	<span class="toggle-icon"></span>
						  	  </p>
						  </div>
						  <?php jot_shop_product_list_categories(); ?>
					   </div><!-- menu-category-list -->
				   </div>
         <?php }?>
           <div class="below-header-col2"> 
            <?php if($main_header_layout=='mhdrthree'){?>
            <nav>
        <!-- Menu Toggle btn-->
       <!-- Menu Toggle btn-->
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn">
                <div class="btn">
                    <i class="th-icon th-icon-TextEditor-Icons-01"></i>
               </div>
            </button>
        </div>
        <div class="sider-inner">
          <?php if(has_nav_menu('jot-shop-main-menu' )){ 
              if (wp_is_mobile()!== true){
                    if(has_nav_menu('jot-shop-above-menu' )){
                                jot_shop_abv_nav_menu();
                       }
                    }  
                   jot_shop_main_nav_menu();
              }else{
                 wp_page_menu(array( 
                 'items_wrap'  => '<ul class="jot-shop-menu" data-menu-style="horizontal">%3$s</ul>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>'));
             }?>
        </div>
        
        </nav>
       <?php }else{ 
        if ( class_exists( 'WooCommerce' ) ){
            jot_shop_product_search_box();
         }
      }?>
      </div>
       <?php if($main_header_layout =='mhdrdefault' || $main_header_layout =='mhdrone'){?>
       <div class="below-header-col3"> 
        <div class="header-support-wrap"> 
        
           <div class="header-support-icon">
                
        <?php jot_shop_header_icon(); ?>

              <div class="thunk-icon">
                <?php if(class_exists( 'WooCommerce' )){ 
                  if(get_theme_mod('jot_shop_cart_mobile_disable')==true){
                         if (wp_is_mobile()!== true):
                          
                      ?>
                      <div class="cart-icon" > 
                         <?php 
                         do_action( 'jot_shop_woo_cart' ); 
                         ?>
                       </div>
                      <?php  endif; }
                      elseif(get_theme_mod('jot_shop_cart_mobile_disable')==false){?>
                           <div class="cart-icon" > 
                            <?php 
                               do_action( 'jot_shop_woo_cart' ); 
                               ?>
                          </div>
                     <?php  } } ?>  
                  </div>  
 
              </div>
            </div>
          </div>
          <?php } ?>
				</div> <!-- end main-header-bar -->
			</div>
		</div> <!-- end below-header -->
<?php	endif; }
}
add_action( 'jot_shop_below_header', 'jot_shop_below_header_markup' );
/**************************************/
//Main Header function
/**************************************/
if ( ! function_exists( 'jot_shop_main_header_markup' ) ){	
function jot_shop_main_header_markup(){ 
$main_header_layout = get_theme_mod('jot_shop_main_header_layout','mhdrthree');
$main_header_opt = get_theme_mod('jot_shop_main_header_option','none');
$jot_shop_menu_alignment = get_theme_mod('jot_shop_menu_alignment','center');
$jot_shop_menu_open = get_theme_mod('jot_shop_mobile_menu_open','left');
$offcanvas = get_theme_mod('jot_shop_canvas_alignment','cnv-none');
?>
<div class="main-header <?php echo esc_attr($main_header_layout);?> <?php echo esc_attr($main_header_opt);?> <?php echo esc_attr($jot_shop_menu_alignment).'-menu';?>  <?php echo esc_attr($offcanvas);?>">
			<div class="container">
        <div class="desktop-main-header">
				<div class="main-header-bar thnk-col-3">
					<div class="main-header-col1">
          <span class="logo-content">
            <?php jot_shop_logo();?> 
          </span>
           <?php if(function_exists('jot_shop_show_off_canvas_sidebar_icon')){jot_shop_show_off_canvas_sidebar_icon();} ?>
        </div>
					<div class="main-header-col2">
       <?php if($main_header_layout!=='mhdrthree'){?>
        <nav>
        <!-- Menu Toggle btn-->
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn">
                <div class="btn">
                    <i class="th-icon th-icon-TextEditor-Icons-01"></i>
               </div>
            </button>
        </div>
        <div class="sider main  jot-shop-menu-hide <?php echo esc_attr($jot_shop_menu_open);?>">
        <div class="sider-inner">
          <?php if(has_nav_menu('jot-shop-main-menu' )){ 

             if (wp_is_mobile()!== false){
                   if(has_nav_menu('jot-shop-above-menu' )){
                                jot_shop_abv_nav_menu();
                       }
                  }  
                    jot_shop_main_nav_menu();
              }else{
                 wp_page_menu(array( 
                 'items_wrap'  => '<ul class="jot-shop-menu" data-menu-style="horizontal">%3$s</ul>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>'));
             }?>
        </div>
        </div>
        </nav>
      <?php }else{ 
        if ( class_exists( 'WooCommerce' ) ){
        jot_shop_product_search_box();
       }
      }?>
      </div>
					<div class="main-header-col3">
             <?php jot_shop_main_header_optn();?>
          </div>
				</div> 
      </div>
        <!-- end main-header-bar -->
        <!-- responsive mobile main header-->
        <div class="responsive-main-header">
          <div class="main-header-bar thnk-col-3">
            <div class="main-header-col1">
            <span class="logo-content">
            <?php jot_shop_logo();?> 
          </span>
          
          </div>

           <div class="main-header-col2">
            <?php if ( class_exists( 'WooCommerce' ) ){
              jot_shop_product_search_box();
             } ?>
           </div>

           <div class="main-header-col3">
            <div class="thunk-icon-market">
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn">
                <div class="btn">
                    <i class="th-icon th-icon-TextEditor-Icons-01"></i>
               </div>
            </button>
        </div>
           <div class="header-support-wrap">
              <div class="header-support-icon">

                 <?php if( get_theme_mod('jot_shop_whislist_mobile_disable',false) != true && class_exists( 'YITH_WCWL' )){?>
                <a class="whishlist" href="<?php echo esc_url( jot_shop_whishlist_url() ); ?>">
        <i class="th-icon th-icon-heartline"></span><span><?php _e('Wishlist','jot-shop');?></i></a>
      <?php } ?>
        
        <?php if(class_exists( 'WooCommerce' ) && get_theme_mod('jot_shop_account_mobile_disable',false) != true){ jot_shop_account(); } ?>
               
              </div>
              <div class="thunk-icon">
             
                <?php if(class_exists( 'WooCommerce' )){ 
                  if(get_theme_mod('jot_shop_cart_mobile_disable')==true){
                         if (wp_is_mobile()!== true):
                          
                      ?>
                      <div class="cart-icon" > 
                         <?php 
                         do_action( 'jot_shop_woo_cart' ); 
                         ?>
                       </div>
                      <?php  endif; }
                      elseif(get_theme_mod('jot_shop_cart_mobile_disable')==false){?>
                           <div class="cart-icon" > 
                            <?php 
                               do_action( 'jot_shop_woo_cart' ); 
                               ?>
                          </div>
                     <?php  } } ?>  
                  </div>   
             
          </div>
          </div>
        </div>
            </div>
          </div> <!-- responsive-main-header END -->
			</div>
		</div> 
       <div class="search-wrapper">
                     <div class="container">
                      <div class="search-close"><a class="search-close-btn"></a></div>
                     <?php  if ( class_exists( 'WooCommerce' ) ){
                              jot_shop_product_search_box();
                          } ?>
                       </div>
       </div> 
<?php	}
}
add_action( 'jot_shop_main_header', 'jot_shop_main_header_markup' );

function jot_shop_main_header_optn(){
          $main_header_layout = get_theme_mod('jot_shop_main_header_layout','mhdrthree');
          $jot_shop_main_header_option = get_theme_mod('jot_shop_main_header_option','none');?>
          <div class="header-support-wrap">
           
         <?php if($jot_shop_main_header_option =='button'){?>

          <a href="<?php echo esc_url(get_theme_mod('jot_shop_main_hdr_btn_lnk','#')); ?>" class="btn-main-header"><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_btn_txt','Button Text')); ?></a>
          <?php }
          elseif($jot_shop_main_header_option =='callto'){ ?>
          
         
              <div class="header-support-content">
                 <i class="fa fa-phone" aria-hidden="true"></i>
                <span class="sprt-tel"><b><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_txt','Call To')); ?></b> <a href="tel:<?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_nub','+1800090098')); ?>"><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_nub','+1800090098')); ?></a></span>
                
              </div>
         
          <?php }elseif($jot_shop_main_header_option =='widget'){?>
               <div class="header-widget-wrap">
                 <?php
                  if ( is_active_sidebar('main-header-widget') ){
                       dynamic_sidebar('main-header-widget');
                   }
                  ?>
               </div>
         <?php  }?>
         <?php if($main_header_layout!=='mhdrdefault' && $main_header_layout!=='mhdrone'){?>
        <div class="header-support-icon">
               
        <?php jot_shop_header_icon(); ?>

              <div class="thunk-icon">
                
                <?php if(class_exists( 'WooCommerce' )){ 
                  if(get_theme_mod('jot_shop_cart_mobile_disable')==true){
                         if (wp_is_mobile()!== true):
                          
                      ?>
                      <div class="cart-icon" > 
                         <?php 
                         do_action( 'jot_shop_woo_cart' ); 
                         ?>
                       </div>
                      <?php  endif; }
                      elseif(get_theme_mod('jot_shop_cart_mobile_disable')==false){?>
                           <div class="cart-icon" > 
                            <?php 
                               do_action( 'jot_shop_woo_cart' ); 
                               ?>
                          </div>
                     <?php  } } ?>  
                  </div>  
 
              </div>
            <?php } ?>
          </div>
<?php }
/**************************************/
//logo & site title function
/**************************************/
if ( ! function_exists( 'jot_shop_logo' ) ){
function jot_shop_logo(){
$title_disable          = get_theme_mod( 'title_disable','enable');
$tagline_disable        = get_theme_mod( 'tagline_disable','enable');
$description            = get_bloginfo( 'description', 'display' );
jot_shop_custom_logo(); 
if($title_disable!='' || $tagline_disable!=''){
if($title_disable!=''){ 
?>
<div class="site-title"><span>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
</span>
</div>
<?php
}
if($tagline_disable!=''){
if( $description || is_customize_preview() ):?>
<div class="site-description">
   <p><?php echo esc_html($description); ?></p>
</div>
<?php endif;
      }
    } 
  }
}
/***************************/
// Product search
/***************************/
function jot_shop_product_search_box(){  
    if ( shortcode_exists('th-aps') ){

                echo do_shortcode('[th-aps]');

              }elseif ( shortcode_exists('tapsp') ){

                echo do_shortcode('[tapsp]');

              }    
}
/**********************************/
// header icon function
/**********************************/
function jot_shop_header_icon(){
    if ( class_exists( 'WooCommerce' ) ){
?>
<div class="header-icon">
<?php 
if(get_theme_mod('jot_shop_main_header_layout')=='mhdrtwo'){?>
                <a class="prd-search" href="#"><i class="th-icon th-icon-vector-search"></i></a> 
<?php } 
jot_shop_account();
if( class_exists( 'WPCleverWoosw' )){?>
  <a class="whishlist" href="<?php echo esc_url( WPcleverWoosw::get_url() ); ?>">
        <i  class="fa fa-heart-o" aria-hidden="true"></i><span class="tooltiptext"><?php echo esc_html('Wishlist','jot-shop');?></span></a>
<?php }
 if( class_exists( 'YITH_WCWL' )){?>
 <a class="whishlist" href="<?php echo esc_url( jot_shop_whishlist_url() ); ?>">
        <i class="th-icon th-icon-heartline"></i><span class="tooltiptext"><?php echo esc_html('Wishlist','jot-shop');?></span></a>
      <?php } 
      ?>
</div>
<?php } }

/**************************/
//PRELOADER
/**************************/
if( ! function_exists( 'jot_shop_preloader' ) ){
 function jot_shop_preloader(){
 if (( isset( $_REQUEST['action'] ) && 'elementor' == $_REQUEST['action'] ) ||
                isset( $_REQUEST['elementor-preview'] )){
      return;
 }else{    
    $jot_shop_preloader_enable = get_theme_mod('jot_shop_preloader_enable',false);
    $jot_shop_preloader_image_upload = get_theme_mod('jot_shop_preloader_image_upload','');
    if($jot_shop_preloader_enable==true){ ?>
    <div class="jot_shop_overlayloader">
    <div class="jot-shop-pre-loader"><img src="<?php echo esc_url($jot_shop_preloader_image_upload);?>"></div>
    </div> 
   <?php }
   }
 }

}
add_action('jot_shop_site_preloader','jot_shop_preloader');

 /**********************/
 // Sticky Header
 /**********************/
 if( ! function_exists( 'jot_shop_sticky_header_markup' )){
 function jot_shop_sticky_header_markup(){ 
 $jot_shop_menu_open = get_theme_mod('jot_shop_mobile_menu_open','left'); ?>
<div class="sticky-header">
   <div class="container">
        <div class="sticky-header-bar thnk-col-3">
           <div class="sticky-header-col1">
               <span class="logo-content">
                  <?php jot_shop_logo();?> 
              </span>
           </div>
           <div class="sticky-header-col2">
             <nav>
        <!-- Menu Toggle btn-->
        <div class="menu-toggle">
            <button type="button" class="menu-btn" id="menu-btn-stk">
                <div class="btn">
                   <i class="th-icon th-icon-TextEditor-Icons-01"></i>
               </div>
            </button>
        </div>
        <div class="sider main  jot-shop-menu-hide  <?php echo esc_attr($jot_shop_menu_open); ?>">
        <div class="sider-inner">
          <?php if(has_nav_menu('jot-shop-sticky-menu' )){ 
             if (wp_is_mobile()!== false){
                    if(has_nav_menu('jot-shop-above-menu')){
                      jot_shop_abv_nav_menu();
                    }     
                  }  
                jot_shop_stick_nav_menu();
              }else{
                wp_page_menu(array( 
                 'items_wrap'  => '<ul class="jot-shop-menu" data-menu-style="horizontal">%3$s</ul>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>'));
             }?>
        </div>
        </div>
        </nav>
           </div>
            <div class="sticky-header-col3">
              <div class="thunk-icon">
        
                <div class="header-icon">
                  <a class="prd-search" href="#"><i class="th-icon th-icon-vector-search"></i></a>     
                     <?php  
                    if( class_exists( 'YITH_WCWL' )){
                      ?>
                      <a class="whishlist" href="<?php echo esc_url( jot_shop_whishlist_url() ); ?>"><i class="th-icon th-icon-heartline"></i></a>
                     <?php } 
                     if(class_exists( 'WooCommerce' )){
                        jot_shop_account();
                      }
                       ?>
                </div>
             <?php if(class_exists( 'WooCommerce' )){ ?>
                      <div class="cart-icon" > 
                         <?php 
                         do_action( 'jot_shop_woo_cart' ); 
                         ?>
                       </div>
                      <?php  } ?> 
                  </div>
           </div>
        </div>

   </div>
</div>
      <div class="search-wrapper">
                     <div class="container">
                      <div class="search-close"><a class="search-close-btn"></a></div>
                     <?php  if ( class_exists( 'WooCommerce' ) ){
                              jot_shop_product_search_box();
                          } ?>
                       </div>
       </div> 
 <?php }
}
if(get_theme_mod('jot_shop_sticky_header',false)==true):
add_action('jot_shop_sticky_header','jot_shop_sticky_header_markup');
endif;

/*****************/
/*mobile nav bar*/
/*****************/

function jotshop_mobile_navbar(){?>
  <?php if(class_exists( 'WooCommerce' )){?>
<div id="jotshop-mobile-bar">
  <ul>
    
    <li><a class="gethome" href="<?php echo esc_url( get_home_url() ); ?>"><span class="th-icon th-icon-home"></span></a></li>
     <?php 
    if( class_exists( 'YITH_WCWL' )){ ?>
    <li><a class="whishlist" href="<?php echo esc_url( jot_shop_whishlist_url() ); ?>"><span class="th-icon th-icon-heartline"></span></a></li>
    <?php } ?>
    <li>
            <a href="#" class="menu-btn" id="mob-menu-btn">           
                <i class="th-icon th-icon-TextEditor-Icons-01" ></i>             
            </a>
 
       </li>
    <li><?php jot_shop_account();?></li>
  </ul>
</div>
<?php }}
add_action( 'wp_footer', 'jotshop_mobile_navbar' );

/// mobile panel
function jot_shop_cart_mobile_panel(){
$jot_shop_mobile_menu_open = get_theme_mod('jot_shop_mobile_menu_open','left');
  ?>
      <div class="mobile-nav-bar sider main  jot-shop-menu-hide <?php echo esc_attr($jot_shop_mobile_menu_open); ?>">
        <div class="sider-inner">
        
          <div class="mobile-tab-wrap">
              <?php if(class_exists( 'WooCommerce' )){?>
            <div class="mobile-nav-tabs">
                <ul>
                  <li class="primary active" data-menu="primary">
                     <a href="#mobile-nav-tab-menu"><?php _e('Menu','jot-shop');?></a>
                  </li>
                  
                  <li class="categories" data-menu="categories">
                    <a href="#mobile-nav-tab-category"><?php _e('Categories','jot-shop');?></a>
                  </li>
                
                </ul>
            </div>
            <?php }?>
            <div id="mobile-nav-tab-menu" class="mobile-nav-tab-menu panel">
          <?php if(has_nav_menu('jot-shop-main-menu' )){ 
                    if(has_nav_menu('jot-shop-above-menu' )){
                         jot_shop_abv_nav_menu();
                       }
                        jot_shop_main_nav_menu();
              }else{
                 wp_page_menu(array( 
                 'items_wrap'  => '<ul class="jot-shop-menu" data-menu-style="horizontal">%3$s</ul>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>'));
             }?>
           </div>
            <?php if(class_exists( 'WooCommerce' )){?>
           <div id="mobile-nav-tab-category" class="mobile-nav-tab-category panel">
             <?php jot_shop_product_list_categories_mobile(); ?>
           </div>
           <?php }?>
          </div>
           <div class="mobile-nav-widget">
             <?php $jot_shop_main_header_option = get_theme_mod('jot_shop_main_header_option','none');
          if($jot_shop_main_header_option =='button'){?>
          <a href="<?php echo esc_url(get_theme_mod('jot_shop_main_hdr_btn_lnk','#')); ?>" class="btn-main-header"><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_btn_txt','Button Text')); ?></a>
          <?php }
          elseif($jot_shop_main_header_option =='callto'){ ?>
          <div class="header-support-wrap">
              <div class="header-support-content">
                 <i class="fa fa-phone" aria-hidden="true"></i>
                <span class="sprt-tel"><b><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_txt','Call Us Free')); ?></b>
                  <a href="tel:<?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_nub','+1800090098')); ?>"><?php echo esc_html(get_theme_mod('jot_shop_main_hdr_calto_nub','+1800090098')); ?>    
                  </a>
                </span> 
              </div>
          </div>
          <?php }elseif($jot_shop_main_header_option =='widget'){?>
               <div class="header-widget-wrap">
                 <?php
                  if ( is_active_sidebar('main-header-widget') ){
                       dynamic_sidebar('main-header-widget');
                   }
                  ?>
               </div>
         <?php  }?>
           </div>
        </div>
      </div>
<?php 
}
add_action( 'jot_shop_below_header', 'jot_shop_cart_mobile_panel' );