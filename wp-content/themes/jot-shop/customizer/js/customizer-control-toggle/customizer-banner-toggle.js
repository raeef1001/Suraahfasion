/*************************************/
// Banner Hide N Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
OPNCustomizerToggles ['jot_shop_banner_layout'] = [
		     

		     {
				controls: [    
				'jot_shop_bnr_1_img',
				'jot_shop_bnr_1_url',
				'jot_shop_bnr_2_img',
				'jot_shop_bnr_2_url',
				'jot_shop_bnr_3_img',
				'jot_shop_bnr_3_url',
				'jot_shop_bnr_4_img',
				'jot_shop_bnr_4_url',
				'jot_shop_bnr_5_img',
				'jot_shop_bnr_5_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-four'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'jot_shop_bnr_1_img',
				'jot_shop_bnr_1_url',
				'jot_shop_bnr_2_img',
				'jot_shop_bnr_2_url',
				'jot_shop_bnr_3_img',
				'jot_shop_bnr_3_url',
				'jot_shop_bnr_4_img',
				'jot_shop_bnr_4_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-five' ||  layout=='bnr-four'){
					return true;
					}else{
					return false;	
					}
				}
			},	
		    {
				controls: [    
				'jot_shop_bnr_1_img',
				'jot_shop_bnr_1_url',
				'jot_shop_bnr_2_img',
				'jot_shop_bnr_2_url',
				'jot_shop_bnr_3_img',
				'jot_shop_bnr_3_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'jot_shop_bnr_1_img',
				'jot_shop_bnr_1_url',
				'jot_shop_bnr_2_img',
				'jot_shop_bnr_2_url',
				
				],
				callback: function(layout){
					if(layout=='bnr-two'|| layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five' || layout=='bnr-six'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [    
				'jot_shop_bnr_1_img',
				'jot_shop_bnr_1_url',	
				],
				callback: function(layout){
					if(layout=='bnr-one' || layout=='bnr-two'|| layout=='bnr-three' || layout=='bnr-four' || layout=='bnr-five' || layout=='bnr-six'){
					return true;
					}else{
					return false;	
					}
				}
			},	
				
		];	
	});
})( jQuery );