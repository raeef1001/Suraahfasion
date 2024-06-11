/**
 * Button control in customizer
 *
 * @package Jot Shop
 */
wp.customize.controlConstructor['jot-shop-buttonset'] = wp.customize.Control.extend({
	ready: function() {
		'use strict';
		var control = this;
		// Change the value
		this.container.on( 'click', 'input', function() {
			control.setting.set( jQuery( this ).val() );
		});
	}

});

