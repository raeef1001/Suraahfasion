/*************************************/
// Ribbon Hide N Show control
/*************************************/
( function( $ ){
OPNControlTrigger.addHook( 'jot-shop-toggle-control', function( argument, api ){
OPNCustomizerToggles ['jot_shop_ribbon_background'] = [
		     {
				controls:[    
				'jot_shop_ribbon_bg_background_image',
				
				],
				callback: function(layout){
					if(layout=='image'){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [  
				'jot_shop_ribbon_video_poster_image',
				'jot_shop_ribbon_bg_video',
				'jot_shop_enable_youtube_video' ,
			    
				],
				callback: function(layout1){
					if(layout1 =='video'){
					return true;
					}else{
					return false;	
					}
				}
			},	
		];	

		//youtube video

		OPNCustomizerToggles ['jot_shop_enable_youtube_video'] = [
		     {
				controls:[    
				'jot_shop_youtube_video_link',
				
				],
				callback: function(layout){
					if(layout==1){
					return true;
					}else{
					return false;	
					}
				}
			},	
			{
				controls: [  
				'jot_shop_ribbon_video_poster_image',
				'jot_shop_ribbon_bg_video', 
			    
				],
				callback: function(layout1){
					if(layout1 ==1){
					return false;
					}else{
					return true;	
					}
				}
			},	
		];

	});
})( jQuery );