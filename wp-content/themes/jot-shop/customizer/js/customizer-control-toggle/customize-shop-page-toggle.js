( function( $ ) {
//**********************************/
// Slider settings
//**********************************/
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
         OPNCustomizerToggles ['jot_shop_pagination'] = [
		    {
				controls: [    
				'jot_shop_pagination_loadmore_btn_text',
				],
				callback: function(sliderspdoptn){
					if(sliderspdoptn == 'click'){
					return true;
					}
					return false;
				}
			},
			
			];


    });
})( jQuery );