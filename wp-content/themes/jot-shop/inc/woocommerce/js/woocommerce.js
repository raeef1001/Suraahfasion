/********************************/
// JotShopWooLib Custom Function
/********************************/
(function ($) {
    var JotShopWooLib = {
        init: function (){
            this.bindEvents();
        },
        bindEvents: function (){
            var $this = this;
            $this.listGridView();
            $this.OffCanvas();
            $this.cartDropdown();
            $this.AddtoCartQuanty();
            $this.CategoryTabFilter();
            $this.ProductSlide();
            $this.ProductListSlide();
            $this.CategorySlider();
            $this.cartopen();
            $this.woccomerce_tab();
          },
          woccomerce_tab: function (){
                 $( document ).ready( function() {
                 if($( '.description_tab' ).hasClass('active')){
                       $('.woocommerce-Tabs-panel.woocommerce-Tabs-panel--description').css('display','block');
                    }
                });

           },
        listGridView: function (){

            var wrapper = $('.thunk-list-grid-switcher');
            var class_name = '';
            wrapper.find('a').on('click', function (e){
              e.preventDefault();
                var type = $(this).attr('data-type');
                switch (type){
                    case "list":
                        class_name = "thunk-list-view";
                        break;
                    case "grid":
                        class_name = "thunk-grid-view";
                        break;
                    default:
                        class_name = "thunk-grid-view";
                        break;
                }
                if (class_name != ''){
                    $(this).closest('#shop-product-wrap').attr('class', '').addClass(class_name);
                    $(this).closest('.thunk-list-grid-switcher').find('a').removeClass('selected');
                    $(this).addClass('selected');
                }
              
            });
        },
        OffCanvas: function () {
                   var off_canvas_wrapper = $( '.jot-shop-off-canvas-sidebar-wrapper');
                   var opn_shop_offcanvas_filter_close = function(){
                  $('html').css({
                       'overflow': '',
                       'margin-right': '' 
                     });
                  $('html').removeClass( 'jot-shop-enabled-overlay' );
                 };
                 var trigger_class = 'off-canvas-button';
                 if( 'undefined' != typeof JotShop_Off_Canvas && '' != JotShop_Off_Canvas.off_canvas_trigger_class ){
                       trigger_class = JotShop_Off_Canvas.off_canvas_trigger_class;
                 }
                 $(document).on( 'click', '.' + trigger_class, function(e){
                        e.preventDefault();
                       var innerWidth = $('html').innerWidth();
                       $('html').css( 'overflow', 'hidden' );
                       var hiddenInnerWidth = $('html').innerWidth();
                       $('html').css( 'margin-right', hiddenInnerWidth - innerWidth );
                       $('html').addClass( 'jot-shop-enabled-overlay' );
                 });

                off_canvas_wrapper.on('click', function(e){
                   if ( e.target === this ) {
                     opn_shop_offcanvas_filter_close();
                     }
                });

                off_canvas_wrapper.find('.menu-close').on('click', function(e) {
                 opn_shop_offcanvas_filter_close();
               });

             },
      cartDropdown: function (){
           /* woo, wc_add_to_cart_params */
              if ( typeof wc_add_to_cart_params === 'undefined' ){
               return false;
              }

               $( document ).on( 'click', '.ajax_add_to_cart', function(e){ // Remove button selector
                 e.preventDefault();
                var data1 = {
                 'action': 'jot_shop_product_count_update'
                };
                 $.post(
                 woocommerce_params.ajax_url, // The AJAX URL
                 data1, // Send our PHP function
                 function(response_data){
                 $('a.cart-content').html(response_data);
                 $( ".return.wc-backward" ).remove();
                 $('body').toggleClass('cart-pan-active');
                 $('.cart-overlay').toggleClass('open');
                 }
               );
             });
          // Ajax remove cart item
               $( document ).on( 'click', 'a.remove', function(e){ // Remove button selector
               e.preventDefault();
          // AJAX add to cart request
              var $thisbutton = $( this );
              if ( $thisbutton.is( '.remove' ) ){
                //Check if the button has a product ID
               if ( ! $thisbutton.attr( 'data-product_id' ) ){ 
              return true;
               }
            }
              $product_id = $thisbutton.attr( 'data-product_id' );
              var data = {'product_id':$product_id,
             'action': 'jot_shop_product_remove'
            };
            $.post(
            woocommerce_params.ajax_url, // The AJAX URL
            data, // Send our PHP function
            function(response){
            $('.open-quickcart-dropdown').html(response);
            var data = {
           'action': 'jot_shop_product_count_update'
            };
           $.post(
           woocommerce_params.ajax_url, // The AJAX URL
           data, // Send our PHP function
           function(response_data){
           $('a.cart-content').html(response_data);
           }
         );
       }
   );
      return false;
  });
},  
       AddtoCartQuanty: function (){
                $('form.cart').on( 'click', 'button.plus, button.minus', function(){
                // Get current quantity values
                var qty = $( this ).siblings('.quantity').find( '.qty' );
                var val = parseFloat(qty.val()) ? parseFloat(qty.val()) : '0';
                var max = parseFloat(qty.attr( 'max' ));
                var min = parseFloat(qty.attr( 'min' ));
                var step = parseFloat(qty.attr( 'step' ));
                // Change the value if plus or minus
                if ( $(this).is( '.plus' ) ) {
                    if ( max && ( max <= val ) ) {
                        qty.val( max );
                    } else {
                        qty.val( val + step );
                    }
                } else {
                    if ( min && ( min >= val ) ) {
                        qty.val( min );
                    } else if ( val > 1 ) {
                        qty.val( val - step );
                    }
                }
                 
            });

        },

 cartopen: function(){
            $(document).on('click','a.cart-contents',function(e){
            e.preventDefault();
            $('body').toggleClass('cart-pan-active');
            $('.cart-overlay').toggleClass('open');
            });

            $('.cart-close-btn').click(function (e){
                $('body').removeClass('cart-pan-active');
                $('.cart-overlay').removeClass('open');
            });

             $('body').click(function(evt){    
                if(evt.target.class == ".open-cart")
                  return;
                if($(evt.target).closest('.open-cart').length)
                  return;             
                  $('body').removeClass('cart-pan-active'); 
                  $('.cart-overlay').removeClass('open');
        
            });


        },
/***********************/        
// Front Page Function
/***********************/  
      CategoryTabFilter:function(){
                         //product slider 
                          if(jotshop.jot_shop_single_row_slide_cat == true){
                          var sliderow = false;
                          }else{
                          var sliderow = true;
                          }
                    // slide autoplay
                            if(jotshop.jot_shop_cat_slider_optn == true){
                            var cat_atply = true;
                            }else{
                            var cat_atply = false; 
                            } 
                             if(jot_shop.jot_shop_rtl==true){
                      var bgstr_rtl = true;
                     }else{
                      var bgstr_rtl = false;
                     }

                     if(jotshop.jot_shop_frontpage_sidebar =='no-sidebar'){
                             var numslide = parseInt('5');
                            }else{
                             var numslide = parseInt('4');
                            }
                            
                            var owl = $('.thunk-product-cat-slide');
                                     owl.owlCarousel({
                                      rtl:bgstr_rtl,
                                       items:5,
                                       nav:true,
                                       owl2row:sliderow, 
                                       owl2rowDirection: 'ltr',
                                       owl2rowTarget: 'thunk-woo-product-list',
                                       navText: ["<i class='slick-nav fa fa-angle-left'></i>",
                                       "<i class='slick-nav fa fa-angle-right'></i>"],
                                       loop:cat_atply,
                                       dots: false,
                                       smartSpeed: 1800,
                                       autoHeight: false,
                                       margin: 15,
                                       autoplay:cat_atply,
                                       autoplayHoverPause: true, // Stops autoplay
                                       
                                       responsive:{
                                       0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:numslide,
                                       }
                   }
                                });
                          $('.thunk-product-tab-section #thunk-cat-tab li a:first').addClass('active');
                          $(document).on('click', '.thunk-product-tab-section #thunk-cat-tab li a', function(e){
                          $('.thunk-product-tab-section #thunk-cat-tab .tab-content').append('<div class="thunk-loadContainer"> <div class="loader"></div></div>');
                          $(".thunk-product-tab-section .thunk-loadContainer").css("display", "block");
                          $('.thunk-product-tab-section #thunk-cat-tab li a.active').removeClass("active");
                          $(this).addClass('active');
                                  var data_term_id = $( this ).attr( 'data-filter' );
                                  $.ajax({
                                      type: 'POST',
                                      url: jotshop.ajaxUrl,
                                      data: {
                                        action :'jot_shop_cat_filter_ajax',
                                        'data_cat_slug':data_term_id,
                                       },
                                dataType: 'html'
                              }).done( function( response ){
                                if ( response ){
                                 $('.thunk-product-tab-section #thunk-cat-tab .tab-content').html('<div class="thunk-slide thunk-product-cat-slide owl-carousel"></div> <div class="thunk-loadContainer"> <div class="loader"></div></div>');
                                 $(".thunk-slide.thunk-product-cat-slide.owl-carousel").append(response);
                                 var owl = $('.thunk-product-cat-slide');
                                 owl.owlCarousel({
                                  rtl:bgstr_rtl,
                                 items:5,
                                 nav: true,
                                 owl2row:sliderow, 
                                 owl2rowDirection: 'ltr',
                                 owl2rowTarget: 'thunk-woo-product-list',
                                 navText: ["<i class='slick-nav fa fa-angle-left'></i>",
                                 "<i class='slick-nav fa fa-angle-right'></i>"],
                                 loop:cat_atply,
                                 dots: false,
                                 smartSpeed: 1800,
                                 autoHeight: false,
                                 margin: 15,
                                 autoplay:cat_atply,
                                 autoplayHoverPause: true, // Stops autoplay
                                 
                                 responsive:{
                                       0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:numslide,
                                       }
                   }
                               });
                            $(".thunk-product-tab-section .thunk-loadContainer").css("display", "none");
                            $('li.thvs_loop-available-attributes__value').hover(function () {
                               var src = $(this).attr('data-o-src');
                               var id = $(this).attr('data-product-id');
                               $(this).closest('.product.post-'+ id ).find('img.attachment-woocommerce_thumbnail').attr("srcset", src );
                            });

                              
             
                            } 
                          } );
                              e.preventDefault();
                           });

              },
      
      ProductSlide:function(){
                if(jotshop.jot_shop_single_row_prdct_slide == true){
                var sliderow_p = false;
                }else{
                var sliderow_p = true;
                }
                // slide autoplay
                if(jotshop.jot_shop_product_slider_optn == true){
                var cat_atply_p = true;
                }else{
                var cat_atply_p = false; 
                }
                  if(jot_shop.jot_shop_rtl==true){
                      var bgstr_rtl = true;
                     }else{
                      var bgstr_rtl = false;
                     }
                     if(jotshop.jot_shop_frontpage_sidebar =='no-sidebar'){
                             var numslide = parseInt('5');
                            }else{
                             var numslide = parseInt('4');
                            }
                
                var owl = $('.thunk-product-slide');
                     owl.owlCarousel({
                        rtl:bgstr_rtl,
                       items:5,
                       nav:true,
                       owl2row:sliderow_p, 
                       owl2rowDirection: 'ltr',
                       owl2rowTarget: 'thunk-woo-product-list',
                       navText: ["<i class='slick-nav fa fa-angle-left'></i>",
                       "<i class='slick-nav fa fa-angle-right'></i>"],
                       loop:cat_atply_p,
                       dots: false,
                       smartSpeed: 1800,
                       autoHeight: false,
                       margin:20,
                       autoplay:cat_atply_p,
                       autoplayHoverPause: true, // Stops autoplay
                      
                       responsive:{
                        0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:numslide,
                                       }
                   }
                });

      },
      ProductListSlide:function(){
                          if(jotshop.jot_shop_single_row_prdct_list == true){
                            var sliderow_l = false;
                            }else{
                            var sliderow_l = true;
                            }
                            
                            // slide autoplay
                            if(jotshop.jot_shop_product_list_slide_optn == true){
                            var cat_atply_l = true;
                            }else{
                            var cat_atply_l = false; 
                            }
                            if(jot_shop.jot_shop_rtl==true){
                      var bgstr_rtl = true;
                     }else{
                      var bgstr_rtl = false;
                     }
                      if(jotshop.jot_shop_frontpage_sidebar =='no-sidebar'){
                             var numslide = parseInt('4');
                            }else{
                             var numslide = parseInt('3');
                            }

                            var owl = $('.thunk-product-list');
                                 owl.owlCarousel({
                                    rtl:bgstr_rtl,
                                   items:3,
                                   nav: true,
                                   owl2row:sliderow_l, 
                                   owl2rowDirection: 'ltr',
                                   owl2rowTarget: 'thunk-woo-product-list',
                                   navText: ["<i class='slick-nav fa fa-angle-left'></i>",
                                   "<i class='slick-nav fa fa-angle-right'></i>"],
                                   loop:cat_atply_l,
                                   dots: false,
                                   smartSpeed: 1800,
                                   autoHeight: false,
                                   margin: 15,
                                   autoplay:cat_atply_l,
                                   autoplayHoverPause: true, // Stops autoplay
                                   
                                   responsive:{
                                       0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:numslide,
                                       }
                   }
                            });
                      
      },
       CategorySlider:function(){
                     // slide autoplay
                     if(jotshop.jot_shop_category_slider_optn == true){
                      var cat_atply_c = true;
                      }else{
                      var cat_atply_c = false; 
                      }
                      if(jot_shop.jot_shop_rtl==true){
                      var bgstr_rtl = true;
                     }else{
                      var bgstr_rtl = false;
                     }

                      var column_no = parseInt(jotshop.jot_shop_cat_item_no);      
                      var owl = $('.thunk-cat-slide');
                           owl.owlCarousel({
                           rtl:bgstr_rtl,
                             items:10,
                             nav: true,
                             navText: ["<i class='slick-nav fa fa-angle-left'></i>",
                             "<i class='slick-nav fa fa-angle-right'></i>"],
                             loop:cat_atply_c,
                             dots: false,
                             smartSpeed: 1800,
                             autoHeight: false,
                             margin:15,
                             autoplay:cat_atply_c,
                             autoplayHoverPause: true, // Stops autoplay
                            
                             responsive:{
                             0:{
                                           items:2,
                                           margin:7.5,
                                       },
                                       768:{
                                           items:2,
                                       },
                                       900:{
                                           items:3,
                                       },
                                       1025:{
                                           items:column_no,
                                       }
                         }
              });

       }, 
        
       
      }
    JotShopWooLib.init();
})(jQuery);