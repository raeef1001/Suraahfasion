/****************/
// Main header	
/****************/
( function( $ ) {
//**********************************/
// Main Header settings
//**********************************/
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
		OPNCustomizerToggles ['jot_shop_main_header_option'] = [
		    {
				controls: [    
				'jot_shop_main_hdr_btn_txt', 
				'jot_shop_main_hdr_btn_lnk',
				'jot_shop_main_hdr_calto_txt',
				'jot_shop_main_hdr_calto_nub',
				'jot_shop_main_hdr_calto_email',
				'jot_shop_main_header_widget_redirect'
				],
				callback: function(headeroptn){
					if (headeroptn =='none'){
					return false;
					}
					return true;
				}
			},	
			 {
				controls: [    
				'jot_shop_main_hdr_btn_txt', 
				'jot_shop_main_hdr_btn_lnk',
				],
				callback: function(layout){
					if(layout=='button'){
					return true;
					}
					return false;
				}
			},
			 {
				controls: [    
				'jot_shop_main_hdr_calto_txt',
				'jot_shop_main_hdr_calto_nub',
				'jot_shop_main_hdr_calto_email',
				],
				callback: function(layout){
					if(layout=='callto'){
					return true;
					}
					return false;
				}
			},
			{
				controls: [    
				'jot_shop_main_header_widget_redirect'
				],
				callback: function(layout){
					if(layout=='widget'){
					return true;
					}
					return false;
				}
			},
			 
		];	
		OPNCustomizerToggles ['jot_shop_sticky_header'] = [
		    {
				controls: [    
				'jot_shop_sticky_header_effect', 
				],
				callback: function(headeroptn){
					if (headeroptn == true){
					return true;
					}
					return false;
				}
			},	
		];	
    });
})( jQuery );