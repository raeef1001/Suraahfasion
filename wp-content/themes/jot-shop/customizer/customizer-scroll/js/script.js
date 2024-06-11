/**
 * Script for the customizer auto scrolling.
 *
 * Sends the section name to the preview.
 *

 * @package  Jot Shop
 *
 * @author   ThemeHunk
 */
/* global wp */
jQuery(document).ready(function() {
var thunk_customize_scroller = function ( $ ) {
	'use strict';
	$(
		function () {
				var customize = wp.customize;
				
				$('ul[id*="jot-shop-panel-frontpage"] .accordion-section').each(
					function (){
						
						$( this ).on(
							'click', function(){
								var section = $( this ).attr( 'aria-owns' );
								customize.previewer.send( 'clicked-customizer', section );
							}
						);
					}
				);
		}
	);
};
thunk_customize_scroller( jQuery );
});
