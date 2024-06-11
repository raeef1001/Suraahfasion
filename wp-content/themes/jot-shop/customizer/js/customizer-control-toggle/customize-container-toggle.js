/*********************************/
// Sidebar hide and show control
/*********************************/
( function( $ ){
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
OPNCustomizerToggles ['jot_shop_default_container'] = [
		    {
				controls: [    
				'jot_shop_conatiner_maxwidth',
				'jot_shop_conatiner_top_btm',
				],
				callback: function(layout){
					if(layout=='fullwidth'){
					return false;
					}
					return true;
				}
			},
			{
				controls: [    
				'jot_shop_conatiner_width',  
				],
				callback: function(layout){
					if(layout =='boxed'){
					return false;
					}
					return true;
				}
			},		
		];
	});
})( jQuery );