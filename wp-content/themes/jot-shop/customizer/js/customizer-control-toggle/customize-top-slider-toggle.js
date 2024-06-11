( function( $ ){
//**********************************/
// Slider settings
//**********************************/
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
		OPNCustomizerToggles['jot_shop_top_slide_layout'] = [
		    {
				controls: [    
				'jot_shop_top_slider_2_title',
				'jot_shop_lay2_adimg',
				'jot_shop_lay2_url',
				'jot_shop_lay2_adimg2',
				'jot_shop_lay2_url2',
				'jot_shop_top_slider_2_title2',
				'jot_shop_lay2_adimg3',
				'jot_shop_lay2_url3',
				'jot_shop_lay3_adimg',
				'jot_shop_lay3_url',
				'jot_shop_lay3_adimg3',
				'jot_shop_lay3_3url',
				'jot_shop_lay3_adimg2',
				'jot_shop_lay3_2url',
				'jot_shop_include_category_slider',
				'jot_shop_lay3_bg_img',
				'jot_shop_discount_offer_txt',
				'jot_shop_cat_url',
				'jot_shop_lay3_url3',
				'jot_shop_top_slider_3_title2',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-1'){
					return false;
					}
					return true;
				}
			},	
			{
				controls: [    
				'jot_shop_top_slide_content',
				'jot_shop_top_slider_2_title',
				'jot_shop_lay2_adimg',
				'jot_shop_lay2_url',
				'jot_shop_lay2_adimg2',
				'jot_shop_lay2_url2',
				'jot_shop_top_slider_2_title2',
				'jot_shop_lay2_adimg3',
				'jot_shop_lay2_url3',
				'jot_shop_lay3_bg_img',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-2'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [  
				'jot_shop_top_slide_content',  
				'jot_shop_lay3_adimg',
				'jot_shop_lay3_url',
				'jot_shop_lay3_adimg2',
				'jot_shop_lay3_2url',
				'jot_shop_lay3_adimg3',
				'jot_shop_lay3_3url',
				'jot_shop_include_category_slider',
				'jot_shop_lay3_bg_img',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-3'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [  
				
				'jot_shop_lay3_bg_img',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-4' || slideroptn =='slide-layout-3'|| slideroptn =='slide-layout-2'){
					return true;
					}
					return false;
				}
			},
			{
				controls: [    
				'jot_shop_top_slide_content6',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-6'){
					return true;
					}
					return false;
				}
			},	
			{
				controls: [    
				'jot_shop_top_slide_content',
				],
				callback: function(slideroptn){
					if(slideroptn =='slide-layout-1' || slideroptn =='slide-layout-2' || slideroptn =='slide-layout-3' || slideroptn =='slide-layout-4' || slideroptn =='slide-layout-9'){
					return true;
					}
					return false;
				}
			},				 
		];	
            OPNCustomizerToggles['jot_shop_top_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			
			];
			OPNCustomizerToggles['jot_shop_cat_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_cat_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			
			];
			OPNCustomizerToggles['jot_shop_product_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_product_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			},
			];	
			OPNCustomizerToggles['jot_shop_category_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_category_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];

			OPNCustomizerToggles['jot_shop_product_list_slide_optn'] = [
		    {
				controls: [    
				'jot_shop_product_list_slide_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['jot_shop_feature_product_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_feature_product_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['jot_shop_cat_tb_lst_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_cat_tb_lst_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
			];
			OPNCustomizerToggles['jot_shop_brand_slider_optn'] = [
		    {
				controls: [    
				'jot_shop_brand_slider_speed',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == true){
					return true;
					}
					return false;
				}
			}
			
		];


    });
})( jQuery );