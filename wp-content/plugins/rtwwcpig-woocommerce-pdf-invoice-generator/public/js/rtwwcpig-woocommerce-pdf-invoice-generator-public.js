( function( $ ) {
	'use strict';
	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $(document).ready(function() {
	 	var rtwwcpig_current_file_name = '';

	 	$(document).on( 'click', '#rtwwcpig_img_btn', function(){
	 		rtwwcpig_current_file_name = $(this).data('rtwwcpig_order_id');
	 		if( rtwwcpig_current_file_name != '' ){
	 			window.location.href = rtwwcpig_global_params.rtwwcpig_home_url+'?rtwwcpig_order_id='+rtwwcpig_current_file_name;
	 		}
	 	});

	 	jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href].rtwwcpig-invoice').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});

    	$(document).on("click",".data_button",function(){
	 		var rtwwcpig_data = {
	 			action 			: 'set_data_in_session',	
	 		};
	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();	
	 			}
	 		});
    	});


	 });

})( jQuery );