(function( $ ) {
	'use strict';

	
	 jQuery(document).ready(function() {
	 	var rtwwcpig_val = jQuery('#pswrd_enable_val').val();
	 	var rtwwcpig_val_2 = jQuery('#show_wtrmrk_txt').val();
	 	var rtwwcpig_val_3 = jQuery('#show_wtrmrk_img').val();
	 	var rtwwcpig_val_4 = jQuery('#wtrmrk_img_dim').val();
	 	var rtwwcpig_val_5 = jQuery('#wtrmrk_img_pos').val();
	 	var rtwwcpig_val_6 = jQuery('#pckngslp_show_wtrmrk_txt').val();
	 	var rtwwcpig_val_7 = jQuery('#pckngslp_show_wtrmrk_img').val();
	 	var rtwwcpig_val_8 = jQuery('#pckngslp_wtrmrk_img_dim').val();
	 	var rtwwcpig_val_9 = jQuery('#pckngslp_wtrmrk_img_pos').val();
	 	var rtwwcpig_val_10 = jQuery('#credi_note_show_wtrmrk_txt').val();
	 	var rtwwcpig_val_11 = jQuery('#credi_note_show_wtrmrk_img').val();
	 	var rtwwcpig_val_12 = jQuery('#credi_note_wtrmrk_img_dim').val();
	 	var rtwwcpig_val_13 = jQuery('#credi_note_wtrmrk_img_pos').val();

	 	if (rtwwcpig_val != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_add_pswrd_protctn").closest('tr').hide();
	 		jQuery("#admin_pswrd").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_4 != 'INT')
	 	{
	 		jQuery(".rtwwcpig_add_watermark_image_dimen_integer").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_4 != 'array')
	 	{
	 		jQuery(".rtwwcpig_add_watermark_image_dimension").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_5 != 'arrays')
	 	{
	 		jQuery("#rtwwcpig_watermark_img_pos_y").closest('tr').hide();
	 		jQuery("#rtwwcpig_watermark_img_pos_x").closest('tr').hide();
	 	}
	 	if (rtwwcpig_val_2 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_text_add_watermark").closest('tr').hide();
	 	}
	 	if (rtwwcpig_val_3 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_add_watermark_image").closest('tr').hide();
	 		jQuery(".rtwwcpig_add_watermark_image_dimen_integer").closest('tr').hide();
	 		jQuery(".rtwwcpig_add_watermark_image_dimension").closest('tr').hide();
	 		jQuery(".rtwwcpig_doc-add-watermark-image-pos-select").closest('tr').hide();
	 		jQuery(".rtwwcpig_add_watermark_image_pos").closest('tr').hide();
	 		jQuery("#rtwwcpig_add_watermark_img").hide();
	 	}
	 	if(rtwwcpig_val_8 != 'INT')
	 	{
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image_dimen_integer").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_8 != 'array')
	 	{
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image_dimension").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_12 != 'array')
	 	{
	 		jQuery(".rtwwcpig_creditnote_add_watermark_image_dimension").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_9 != 'arrays')
	 	{
	 		jQuery("#rtwwcpig_pckngslp_watermark_img_pos_y").closest('tr').hide();
	 		jQuery("#rtwwcpig_pckngslp_watermark_img_pos_x").closest('tr').hide();
	 	}
	 	if(rtwwcpig_val_13 != 'arrays')
	 	{
	 		jQuery("#rtwwcpig_creditnote_watermark_img_pos_y").closest('tr').hide();
	 		jQuery("#rtwwcpig_creditnote_watermark_img_pos_x").closest('tr').hide();
	 	}
	 	if (rtwwcpig_val_6 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_pckngslp_text_add_watermark").closest('tr').hide();
	 	}
	 	if (rtwwcpig_val_10 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_creditnote_text_add_watermark").closest('tr').hide();
	 	}
	 	if (rtwwcpig_val_7 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image").closest('tr').hide();
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image_dimen_integer").closest('tr').hide();
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image_dimension").closest('tr').hide();
	 		jQuery(".rtwwcpig_pckngslp_doc-add-watermark-image-pos-select").closest('tr').hide();
	 		jQuery(".rtwwcpig_pckngslp_add_watermark_image_pos").closest('tr').hide();
	 		jQuery("#rtwwcpig_pckngslp_add_watermark_img").hide();
	 	}
	 	if (rtwwcpig_val_11 != 'yes') 
	 	{
	 		jQuery(".rtwwcpig_creditnote_add_watermark_image").closest('tr').hide();
	 		jQuery(".rtwwcpig_creditnote_add_watermark_image_dimen_integer").closest('tr').hide();
	 		jQuery(".rtwwcpig_creditnote_add_watermark_image_dimension").closest('tr').hide();
	 		jQuery(".rtwwcpig_creditnote_doc-add-watermark-image-pos-select").closest('tr').hide();
	 		jQuery(".rtwwcpig_creditnote_add_watermark_image_pos").closest('tr').hide();
	 		jQuery("#rtwwcpig_creditnote_add_watermark_img").hide();
	 	}
	 	jQuery('.rtwwcpig_watermark_img_upload').on('click',function(){
	 		var rtwwcpig_inputField = jQuery(this).parent('div');
	 		tb_show('watermark', 'media-upload.php?TB_iframe=true');
	 		window.send_to_editor = function(html)
	 		{  
	 			var rtwwcpig_url = jQuery(html).find('img').attr('src');
	 			if(typeof rtwwcpig_url == 'undefined')
	 				rtwwcpig_url = jQuery(html).attr('src');	
	 			jQuery( '#rtwwcpig_watermark_img_url' ).val( rtwwcpig_url );
	 			jQuery( '#rtwwcpig_watermark_img_backgrnd' ).find( 'img' ).attr( 'src', rtwwcpig_url );
	 			jQuery( '.rtwwcpig_watermark_remove_img' ).show();
	 			jQuery( '#rtwwcpig_watermark_img_backgrnd' ).show();
	 			jQuery( '#rtwwcpig_watermark_img' ).show();
	 			tb_remove();
	 		};
	 		return false;
	 	});
	 	jQuery( document ).on( 'click', '.rtwwcpig_watermark_remove_img', function() {
	 		jQuery('#rtwwcpig_watermark_img_url').val('');
	 		jQuery('#rtwwcpig_watermark_img').attr('src', '');
	 		jQuery(this).hide();
	 		jQuery( '#rtwwcpig_watermark_img' ).hide();
	 		return false;
	 	});

	 	jQuery('.rtwwcpig_watermark_img_upload_for_cmplet_order').on('click',function(){
	 		var rtwwcpig_inputField = jQuery(this).parent('div');
	 		tb_show('watermark', 'media-upload.php?TB_iframe=true');
	 		window.send_to_editor = function(html)
	 		{  
	 			var rtwwcpig_url = jQuery(html).find('img').attr('src');
	 			if(typeof rtwwcpig_url == 'undefined')
	 				rtwwcpig_url = jQuery(html).attr('src');	
	 			jQuery( '#rtwwcpig_watermark_img_for_cmplt_ordr' ).val( rtwwcpig_url );
	 			jQuery( '#rtwwcpig_watermark_for_cmplt_ordr' ).find( 'img' ).attr( 'src', rtwwcpig_url );
	 			jQuery( '.rtwwcpig_watermark_remove_img_for_cmplt_order' ).show();
	 			jQuery( '#rtwwcpig_watermark_for_cmplt_ordr' ).show();
	 			jQuery( '#rtwwcpig_img_for_cmplt_ordr' ).show();
	 			tb_remove();
	 		};
	 		return false;
	 	});
	 	jQuery( document ).on( 'click', '.rtwwcpig_watermark_remove_img_for_cmplt_order', function() {
	 		jQuery('#rtwwcpig_watermark_img_for_cmplt_ordr').val('');
	 		jQuery('#rtwwcpig_img_for_cmplt_ordr').attr('src', '');
	 		jQuery(this).hide();
	 		jQuery( '#rtwwcpig_img_for_cmplt_ordr' ).hide();
	 		return false;
	 	}); 

	 	jQuery('.rtwwcpig_btn_img_upload').on('click',function(){
	 		var rtwwcpig_inputField = jQuery(this).parent('div');
	 		tb_show('Button_img', 'media-upload.php?TB_iframe=true');
	 		window.send_to_editor = function(html)
	 		{  
	 			var rtwwcpig_url = jQuery(html).find('img').attr('src');
	 			if(typeof rtwwcpig_url == 'undefined')
	 				rtwwcpig_url = jQuery(html).attr('src');	
	 			jQuery( '#rtwwcpig_img_url' ).val( rtwwcpig_url );
	 			jQuery( '#rtwwcpig_btn_img' ).find( 'img' ).attr( 'src', rtwwcpig_url );
	 			jQuery( '.rtwwcpig_btn_remove_img' ).show();
	 			jQuery( '#rtwwcpig_img_btn' ).show();
	 			tb_remove();
	 		};
	 		return false;
	 	});
	 	jQuery( document ).on( 'click', '.rtwwcpig_btn_remove_img', function() {
	 		jQuery('#rtwwcpig_img_url').val('');
	 		jQuery('#rtwwcpig_img_btn').attr('src', '');
	 		jQuery(this).hide();
	 		jQuery( '#rtwwcpig_img_btn' ).hide();
	 		return false;
	 	});

	 	$(document).on( 'change', '.rtwwcpig_template_select', function(){
	 		if( $(this).val() == '1' ){
	 			$(document).find( '.rtwwcpig_template_1' ).show();
	 			$(document).find( '.rtwwcpig_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_template_6' ).hide();
	 		}
	 		if( $(this).val() == '2' ){
	 			$(document).find( '.rtwwcpig_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_template_2' ).show();
	 			$(document).find( '.rtwwcpig_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_template_6' ).hide();
	 		}
	 		if( $(this).val() == '3' ){
	 			$(document).find( '.rtwwcpig_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_template_3' ).show();
	 			$(document).find( '.rtwwcpig_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_template_6' ).hide();
	 		}
	 		if( $(this).val() == '4' ){
	 			$(document).find( '.rtwwcpig_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_template_4' ).show();
	 			$(document).find( '.rtwwcpig_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_template_6' ).hide();
	 		}
	 		if( $(this).val() == '5' ){
	 			$(document).find( '.rtwwcpig_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_template_5' ).show();
	 			$(document).find( '.rtwwcpig_template_6' ).hide();
	 		}
	 		if( $(this).val() == '6' ){
	 			$(document).find( '.rtwwcpig_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_template_6' ).show();
	 		}
	 	});

	 	$(document).on( 'change', '.rtwwcpig_credit_note_template_select', function(){
	 		if( $(this).val() == '1' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).show();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).hide();
	 		}
	 		if( $(this).val() == '2' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).show();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).hide();
	 		}
	 		if( $(this).val() == '3' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).show();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).hide();
	 		}
	 		if( $(this).val() == '4' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).show();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).hide();
	 		}
	 		if( $(this).val() == '5' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).show();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).hide();
	 		}
	 		if( $(this).val() == '6' ){
	 			$(document).find( '.rtwwcpig_credit_note_template_1' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_2' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_3' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_4' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_5' ).hide();
	 			$(document).find( '.rtwwcpig_credit_note_template_6' ).show();
	 		}
	 	});

	 	jQuery('.rtwwcpig_btn_bckgrnd_img_upload').on('click',function(){
	 		var rtwwcpig_inputField = jQuery(this).parent('div');
	 		tb_show('Background_img', 'media-upload.php?TB_iframe=true');
	 		window.send_to_editor = function(html)
	 		{  
	 			var rtwwcpig_url = jQuery(html).find('img').attr('src');
	 			if(typeof rtwwcpig_url == 'undefined')
	 				rtwwcpig_url = jQuery(html).attr('src');	
	 			jQuery( '#rtwwcpig_bck_img_url' ).val( rtwwcpig_url );
	 			jQuery( '#rtwwcpig_bckgrnd_img' ).find( 'img' ).attr( 'src', rtwwcpig_url );
	 			jQuery( '.rtwwcpig_btn_remove_bckgrnd_img' ).show();
	 			jQuery( '#rtwwcpig_bckgrnd_img_btn' ).show();
	 			tb_remove();
	 		};
	 		return false;
	 	});

	 	jQuery('.rtwwcpig_credit_note_bckgrnd_img_upload').on('click',function(){
	 		var rtwwcpig_inputField = jQuery(this).parent('div');
	 		tb_show('Background_img', 'media-upload.php?TB_iframe=true');
	 		window.send_to_editor = function(html)
	 		{  
	 			var rtwwcpig_credit_note_url = jQuery(html).find('img').attr('src');
	 			if(typeof rtwwcpig_credit_note_url == 'undefined')
	 				rtwwcpig_credit_note_url = jQuery(html).attr('src');	
	 			jQuery( '#rtwwcpig_credit_note_bck_img_url' ).val( rtwwcpig_credit_note_url );
	 			jQuery( '#rtwwcpig_credit_note_bckgrnd_img' ).find( 'img' ).attr( 'src', rtwwcpig_credit_note_url );
	 			jQuery( '.rtwwcpig_btn_remove_credit_note_bckgrnd_img' ).show();
	 			jQuery( '#rtwwcpig_credit_note_bckgrnd_img_btn' ).show();
	 			tb_remove();
	 		};
	 		return false;
	 	});

	 	jQuery( document ).on( 'click', '.rtwwcpig_btn_remove_credit_note_bckgrnd_img', function() {
	 		jQuery('#rtwwcpig_credit_note_bck_img_url').val('');
	 		jQuery('#rtwwcpig_credit_note_bckgrnd_img_btn').attr('src', '');
	 		jQuery(this).hide();
	 		jQuery( '#rtwwcpig_credit_note_bckgrnd_img_btn' ).hide();
	 		return false;
	 	});

	 	jQuery( document ).on( 'click', '.rtwwcpig_btn_remove_bckgrnd_img', function() {
	 		jQuery('#rtwwcpig_bck_img_url').val('');
	 		jQuery('#rtwwcpig_bckgrnd_img_btn').attr('src', '');
	 		jQuery(this).hide();
	 		jQuery( '#rtwwcpig_bckgrnd_img_btn' ).hide();
	 		return false;
	 	});
	 	jQuery('.woocommerce-help-tip').tipTip({
	 		'attribute': 'data-tip',
	 		'fadeIn': 50,
	 		'fadeOut': 50,
	 		'delay': 200
	 	});

	 	$('.color-field').wpColorPicker(); 
	 	
	 	jQuery(document).on('click', '.rtwwcpig_wtrmrk', function(){
	 		rtwwcpig_showHideCheck('rtwwcpig_text_add_watermark', this);
	 	});

	 	jQuery(document).on('click', '.rtwwcpig_pckngslp_wtrmrk', function(){
	 		rtwwcpig_pckngslp_showHideCheck('rtwwcpig_pckngslp_text_add_watermark', this);
	 	});

	 	jQuery(document).on('click', '.rtwwcpig_credinote_wtrmrk', function(){
	 		rtwwcpig_creditnote_showHideCheck('rtwwcpig_creditnote_text_add_watermark', this);
	 	});

	 	jQuery(document).on('click', '#table_border', function(){
	 		rtwwcpig_showHideCheck('table_brdr_class', this);
	 	});
	 	jQuery(document).on('click', '#table_th_border', function(){
	 		rtwwcpig_showHideCheck('table_td_class', this);
	 	});
	 	jQuery(document).on('click', '#table_td_border', function(){
	 		rtwwcpig_showHideCheck('table_th_class', this);
	 	});
	 	
	 	jQuery(document).on('click', '.rtwwcpig_imgwtrmk', function(){
	 		rtwwcpig_imgshowHideCheck('rtwwcpig_add_watermark_image', this);
	 	});

	 	jQuery(document).on('click', '.rtwwcpig_pckngslp_imgwtrmk', function(){
	 		rtwwcpig_pckngslp_imgshowHideCheck('rtwwcpig_pckngslp_add_watermark_image', this);
	 	});

	 	jQuery(document).on('click', '.rtwwcpig_creditnote_imgwtrmk', function(){
	 		rtwwcpig_creditnote_imgshowHideCheck('rtwwcpig_creditnote_add_watermark_image', this);
	 	}); 
	 	
	 	jQuery(document).on('click', '#rtwwcpig_enable_paswrd', function(){
	 		rtwwcpig_addPasswordprotctn('rtwwcpig_add_pswrd_protctn', this);
	 	});

	 	jQuery(document).on('change', '.rtwwcpig_doc-add-watermark-image-pos-select', function(){
	 		rtwwcpig_showHidePos();
	 	});

	 	jQuery(document).on('change', '.rtwwcpig_creditnote_doc-add-watermark-image-pos-select', function(){
	 		rtwwcpig_creditnote_showHidePos();
	 	});

	 	jQuery(document).on('change', '.rtwwcpig_pckngslp_doc-add-watermark-image-pos-select', function(){
	 		rtwwcpig_pckngslp_showHidePos();
	 	}); 

	 	jQuery(document).on('change', '#rtwwcpig_watermark_img_dim', function(){
	 		var rtwwcpig_value=jQuery("#rtwwcpig_watermark_img_dim").val();
	 		rtwwcpig_showHideImage(rtwwcpig_value);
	 	});

	 	jQuery(document).on('change', '#rtwwcpig_pckngslp_watermark_img_dim', function(){
	 		var rtwwcpig_v =jQuery("#rtwwcpig_pckngslp_watermark_img_dim").val();
	 		rtwwcpig_pckngslp_showHideImage(rtwwcpig_v);
	 	});

	 	jQuery(document).on('change', '#rtwwcpig_creditnote_watermark_img_dim', function(){
	 		var rtwwcpig_v =jQuery("#rtwwcpig_creditnote_watermark_img_dim").val();
	 		rtwwcpig_creditnote_showHideImage(rtwwcpig_v);
	 	});

	 	jQuery(document).on('click', '#enable_packing_slip', function(){
	 		$('#rtwwcpig_pkng_slp_frmt').toggle();
	 	});

	 	jQuery(document).on('click', '.rtwwcpig_sms_setting', function(){
	 		if (jQuery(this).prop('checked')) {
	 			jQuery(document).find('.rtwwcpig_accont_setting').show();
	 			jQuery(document).find('.rtwwcpig_auth_setting').show();
	 			jQuery(document).find('.rtwwcpig_phone_setting').show();
	 		}else{
	 			jQuery(document).find('.rtwwcpig_accont_setting').hide();
	 			jQuery(document).find('.rtwwcpig_auth_setting').hide();
	 			jQuery(document).find('.rtwwcpig_phone_setting').hide();
	 		}
	 	});

	 	jQuery(document).on('click', '#rtwwcpig_dlt_profrma', function(){
	 		var order_id = jQuery("#rtwwcpig_dlt_profrma").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_delete_invoice',
	 			order_id 		: order_id,
	 			rtwwcpig_security_check	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};
	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if(data)
	 				{
	 					$('#rtwwcpig_dlt_profrma').hide();
	 					$('#rtwwcpig_prfrm_btn').hide();
	 					$('#rtwwcpig_regnrt_invoice').show();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}
	 			}
	 		});
	 	});

	 	$(document).on('click','.rtwwqcp-faq-heading' ,function(){
	 		
	 		if ($(this).next('.rtwwqcp-faq-desc').is(':hidden')){
	 			$('.rtwwqcp-faq-heading').removeClass('active');
	 			$('.rtwwqcp-faq-desc').slideUp("3000");
	 			$(this).addClass('active');
	 			$(this).next('.rtwwqcp-faq-desc').slideToggle("3000");
	 		}
	 		else{
	 			$('.rtwwqcp-faq-heading').removeClass('active');
	 			$('.rtwwqcp-faq-desc').slideUp("3000");
	 		}

	 	});
	 	
	 	jQuery(document).on('click', '#rtwwcpig_dlt_nrml', function(){
	 		var order_id = jQuery("#rtwwcpig_dlt_nrml").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_delete_invoice',
	 			order_id 		: order_id,
	 			rtwwcpig_security_check	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};
	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if(data)
	 				{
	 					$('#rtwwcpig_dlt_nrml').hide();
	 					$('#rtwwcpig_nrml_btn').hide();
	 					$('#rtwwcpig_regnrt_invoice').show();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}	
	 			}
	 		});
	 	});

	 	jQuery(document).on('click', '#rtwwcpig_dlt_shiping_lbl', function(){
	 		var order_id = jQuery("#rtwwcpig_dlt_shiping_lbl").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_delete_shiping_lbl',
	 			order_id 		: order_id,
	 			rtwwcpig_security_check	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};
	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if(data)
	 				{
	 					$('#rtwwcpig_shiping_lbl').hide();
	 					$('#rtwwcpig_dlt_shiping_lbl').hide();
	 					$('#rtwwcpig_regnrt_shipping_lbl').show();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}	
	 			}
	 		});
	 	});

	 	jQuery(document).on('click', '#rtwwcpig_dlt_pckng_slp', function(){
	 		var order_id = jQuery("#rtwwcpig_dlt_pckng_slp").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_delete_packng_slp',
	 			order_id 		: order_id,
	 			rtwwcpig_security_check	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};
	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if(data)
	 				{
	 					$('#rtwwcpig_pckng_slp').hide();
	 					$('#rtwwcpig_dlt_pckng_slp').hide();
	 					$('#rtwwcpig_regnrt_pckng_slp').show();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}	
	 			}
	 		});
	 	});

	 	jQuery(document).on('click', '#rtwwcpig_regnrt_invoice', function(){
	 		var order_id = jQuery("#rtwwcpig_regnrt_invoice").attr('data-order_id');
	 		var order_status = jQuery("#rtwwcpig_regnrt_invoice").attr('data-order_status');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_regnrate_invoice',
	 			order_id 		: order_id,
	 			order_status    : order_status,
	 			rtwwcpig_security_check	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};

	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if( data )
	 				{
	 					if (order_status == 'completed') 
	 					{
	 						$('#rtwwcpig_dlt_nrml').show();
	 						$('#rtwwcpig_nrml_btn').show();
	 						$('#rtwwcpig_regnrt_invoice').hide();
	 					}
	 					else
	 					{
	 						$('#rtwwcpig_dlt_profrma').show();
	 						$('#rtwwcpig_prfrm_btn').show();
	 						$('#rtwwcpig_regnrt_invoice').hide();
	 					}
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}
	 			}
	 		});
	 	});


	 	jQuery(document).on('click', '#rtwwcpig_regnrt_shipping_lbl', function(){
	 		var order_id = jQuery("#rtwwcpig_regnrt_shipping_lbl").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_regnrate_shipping_lbl',
	 			order_id 		: order_id,
	 			rtwwcpig_security	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};

	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if( data )
	 				{
	 					$('#rtwwcpig_shiping_lbl').show();
	 					$('#rtwwcpig_dlt_shiping_lbl').show();
	 					$('#rtwwcpig_regnrt_shipping_lbl').hide();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}
	 			}
	 		});
	 	});

	 	jQuery(document).on('click', '#rtwwcpig_regnrt_pckng_slp', function(){
	 		var order_id = jQuery("#rtwwcpig_regnrt_pckng_slp").attr('data-order_id');
	 		var rtwwcpig_data = {
	 			action 			: 'rtwwcpig_regnrate_packng_slp',
	 			order_id 		: order_id,
	 			rtwwcpig_security	: rtwwcpig_ajax_param.rtwwcpig_nonce	
	 		};

	 		$.blockUI({ message: '' });
	 		$.ajax({
	 			type: "POST",
	 			url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl,
	 			data: rtwwcpig_data,
	 			dataType: 'json',
	 			success: function( data ) {
	 				$.unblockUI();
	 				if( data )
	 				{
	 					$('#rtwwcpig_pckng_slp').show();
	 					$('#rtwwcpig_dlt_pckng_slp').show();
	 					$('#rtwwcpig_regnrt_pckng_slp').hide();
	 				}
	 				else
	 				{
	 					alert( data.rtwwcpig_message );
	 				}
	 			}
	 		});
	 	});

	 	var rules = {
	        rtwwcpig_purchase_code 	: { required: true }
	    };
	    var messages = {
	        rtwwcpig_purchase_code 	: { required: 'Required' }
	    };
	    $(document).find( "#rtwwcpig_verify" ).validate({
	        rules: rules,
	        messages: messages
		});
		$(document).on('click', '#rtwwcpig_verify_code', function(){
			if( $(document).find( "#rtwwcpig_verify" ).valid() )
			{
				var rtwwcpig_purchase_code = $(document).find('.rtwwcpig_purchase_code').val();

				var data = {	
					action	  		:'rtwwcpig_verify_purchase_code',
					purchase_code 	: rtwwcpig_purchase_code,
					security_check 	: rtwwcpig_ajax_param.rtwwcpig_nonce	
				};
				$.blockUI({ message: '',
				timeout: 20000000 });
				$.ajax({
					url: rtwwcpig_ajax_param.rtwwcpig_ajaxurl, 
					type: "POST",  
					data: data,
					dataType :'json',	
					success: function(response) 
					{  
						if( response.status )
						{
							$(document).find('.rtwwcpig_notice_success').removeClass('rtwwcpig_hide');
							$(document).find('.rtwwcpig_msg_response').addClass('rtwwcpig_success');
							$(document).find('.rtwwcpig_msg_response').html(response.message);
							window.setTimeout(function(){ 
								window.location.reload(true);
							}, 3000);
						}
						else{
							$(document).find('.rtwwcpig_notice_error').removeClass('rtwwcpig_hide');
							$(document).find('.rtwwcpig_msg_response').addClass('rtwwcpig_failed');
							$(document).find('.rtwwcpig_msg_response').html(response.message);
						}
						$.unblockUI();
					}
				});
			}
		});
		$(document).on('click', '.notice-dismiss', function(){
			var htmls = '';
			htmls = '<div class="notice notice-error is-dismissible"><p><strong class="rtwwcpig_msg_response"></strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"></span></button></div>';

			$(document).find('.rtwwcpig_notice_error').html(htmls);
			
			$(document).find('.rtwwcpig_notice_error').addClass('rtwwcpig_hide');
		});

		jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href]#rtwwcpig_prfrm_btn').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});

    	jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href]#rtwwcpig_nrml_btn').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});
    	jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href]#rtwwcpig_shiping_lbl').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});
    	jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href]#rtwwcpig_pckng_slp').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});
    	jQuery(document).ready(function () {
          setTimeout(function () {
                jQuery('a[href]#rtwwcpig_img_btn').each(function () {
                    var href = this.href;
                    jQuery(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        window.open(href, '_self');
                    });
                });
          	}, 500);
    	});
	});

})( jQuery );

	/**
	 *
	 * @since    1.0.0
	 * for show/hide image.
	 */

	 function rtwwcpig_showHideCheck(rtwwcpig_id,rtwwcpig_check) 
	 { 
	 	if (rtwwcpig_check.checked) 
	 	{ 
	 		jQuery('.rtwwcpig_text_add_watermark').closest("tr").show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_text_add_watermark').closest("tr").hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide invoice.
	 */

	 function rtwwcpig_pckngslp_showHideCheck(rtwwcpig_id,rtwwcpig_check) 
	 { 
	 	if (rtwwcpig_check.checked) 
	 	{ 
	 		jQuery('.rtwwcpig_pckngslp_text_add_watermark').closest("tr").show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_pckngslp_text_add_watermark').closest("tr").hide();
	 	}
	 }

	 function rtwwcpig_creditnote_showHideCheck(rtwwcpig_id,rtwwcpig_check) 
	 { 
	 	if (rtwwcpig_check.checked) 
	 	{ 
	 		jQuery('.rtwwcpig_creditnote_text_add_watermark').closest("tr").show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_creditnote_text_add_watermark').closest("tr").hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide watermak image.
	 */

	 function rtwwcpig_imgshowHideCheck(rtwwcpig_id,rtwwcpig_check)
	 {
	 	if(rtwwcpig_check.checked)
	 	{
	 		var rtwwcpig_value = jQuery("#rtwwcpig_watermark_img_dim").val();
	 		var rtwwcpig_value1 = jQuery("#rtwwcpig_watermark_img_pos").val();			
	 		jQuery('.rtwwcpig_add_watermark_image').closest("tr").show();
	 		jQuery('.rtwwcpig_doc-add-watermark-image-pos-select').closest("tr").show();
	 		jQuery('#rtwwcpig_add_watermark_img').show();
	 		if (rtwwcpig_value == 'array') 
	 		{
	 			jQuery('.rtwwcpig_add_watermark_image_dimension').closest("tr").show();
	 		}
	 		if (rtwwcpig_value == 'INT') 
	 		{
	 			jQuery('.rtwwcpig_add_watermark_image_dimen_integer').closest("tr").show();
	 		}
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image').closest("tr").hide();
	 		jQuery('.rtwwcpig_doc-add-watermark-image-pos-select').closest("tr").hide();
	 		jQuery('#rtwwcpig_add_watermark_img').hide();
	 		jQuery('.rtwwcpig_add_watermark_image_dimension').closest("tr").hide();
	 		jQuery('.rtwwcpig_add_watermark_image_dimen_integer').closest("tr").hide();
	 		jQuery('.rtwwcpig_add_watermark_image_pos').closest("tr").hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide packing slip.
	 */

	 function rtwwcpig_pckngslp_imgshowHideCheck(rtwwcpig_id,rtwwcpig_check)
	 {
	 	if(rtwwcpig_check.checked)
	 	{
	 		var rtwwcpig_val = jQuery("#rtwwcpig_pckngslp_watermark_img_dim").val();
	 		var rtwwcpig_val1 = jQuery("#rtwwcpig_pckngslp_watermark_img_pos").val();			
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image').closest("tr").show();
	 		jQuery('.rtwwcpig_pckngslp_doc-add-watermark-image-pos-select').closest("tr").show();
	 		jQuery('#rtwwcpig_pckngslp_add_watermark_img').show();
	 		if (rtwwcpig_val == 'array') 
	 		{
	 			jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimension').closest("tr").show();
	 		}
	 		if (rtwwcpig_val == 'INT') 
	 		{
	 			jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimen_integer').closest("tr").show();
	 		}
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image').closest("tr").hide();
	 		jQuery('.rtwwcpig_pckngslp_doc-add-watermark-image-pos-select').closest("tr").hide();
	 		jQuery('#rtwwcpig_pckngslp_add_watermark_img').hide();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimension').closest("tr").hide();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimen_integer').closest("tr").hide();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_pos').closest("tr").hide();
	 	}
	 }

	 function rtwwcpig_creditnote_imgshowHideCheck(rtwwcpig_id,rtwwcpig_check)
	 {
	 	if(rtwwcpig_check.checked)
	 	{
	 		var rtwwcpig_val = jQuery("#rtwwcpig_creditnote_watermark_img_dim").val();
	 		var rtwwcpig_val1 = jQuery("#rtwwcpig_creditnote_watermark_img_pos").val();			
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image').closest("tr").show();
	 		jQuery('.rtwwcpig_creditnote_doc-add-watermark-image-pos-select').closest("tr").show();
	 		jQuery('#rtwwcpig_creditnote_add_watermark_img').show();
	 		if (rtwwcpig_val == 'arrays') 
	 		{
	 			jQuery('.rtwwcpig_creditnote_add_watermark_image_dimension').closest("tr").show();
	 		}
	 		if (rtwwcpig_val == 'INT') 
	 		{
	 			jQuery('.rtwwcpig_creditnote_add_watermark_image_dimen_integer').closest("tr").show();
	 		}
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image').closest("tr").hide();
	 		jQuery('.rtwwcpig_creditnote_doc-add-watermark-image-pos-select').closest("tr").hide();
	 		jQuery('#rtwwcpig_creditnote_add_watermark_img').hide();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimension').closest("tr").hide();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimen_integer').closest("tr").hide();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_pos').closest("tr").hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide watermak image position.
	 */

	 function rtwwcpig_showHideImage(rtwwcpig_value)
	 { 
	 	if(rtwwcpig_value=='array')
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image_dimension').closest('tr').show();
	 		jQuery('.rtwwcpig_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 	if(rtwwcpig_value=='INT')
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image_dimen_integer').closest('tr').show();
	 		jQuery('.rtwwcpig_add_watermark_image_dimension').closest('tr').hide();
	 	}
	 	if(rtwwcpig_value!='INT' && rtwwcpig_value!='array')
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image_dimension').closest('tr').hide();
	 		jQuery('.rtwwcpig_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide packing slip watermark image position.
	 */

	 function rtwwcpig_pckngslp_showHideImage(rtwwcpig_v)
	 { 
	 	if(rtwwcpig_v =='array')
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimension').closest('tr').show();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 	if(rtwwcpig_v =='INT')
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimen_integer').closest('tr').show();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimension').closest('tr').hide();
	 	}
	 	if(rtwwcpig_v !='INT' && rtwwcpig_v !='array')
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimension').closest('tr').hide();
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 }

	 function rtwwcpig_creditnote_showHideImage(rtwwcpig_v)
	 { 
	 	if(rtwwcpig_v =='array')
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimension').closest('tr').show();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 	if(rtwwcpig_v =='INT')
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimen_integer').closest('tr').show();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimension').closest('tr').hide();
	 	}
	 	if(rtwwcpig_v !='INT' && rtwwcpig_v !='array')
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimension').closest('tr').hide();
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_dimen_integer').closest('tr').hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide password protection.
	 */

	 function rtwwcpig_addPasswordprotctn(rtwwcpig_id,rtwwcpig_check){
	 	
	 	if (rtwwcpig_check.checked) 
	 	{
	 		jQuery("."+rtwwcpig_id).closest('tr').show();
	 		jQuery("#admin_pswrd").closest('tr').show();
	 		
	 	}
	 	else
	 	{
	 		jQuery("."+rtwwcpig_id).closest('tr').hide();
	 		jQuery("#admin_pswrd").closest('tr').hide();
	 		
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide packing slip watermark image position.
	 */


	 function rtwwcpig_showHidePos() {
	 	var rtwwcpig_value=jQuery(".rtwwcpig_doc-add-watermark-image-pos-select").val();
	 	if(rtwwcpig_value=='arrays')
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image_pos').closest('tr').show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_add_watermark_image_pos').closest('tr').hide();
	 	}
	 }
	 
	  function rtwwcpig_creditnote_showHidePos() {
	 	var rtwwcpig_value=jQuery(".rtwwcpig_creditnote_doc-add-watermark-image-pos-select").val();
	 	if(rtwwcpig_value=='arrays')
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_pos').closest('tr').show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_creditnote_add_watermark_image_pos').closest('tr').hide();
	 	}
	 }

	/**
	 *
	 * @since    1.0.0
	 * for show/hide packing slip in table.
	 */

	 function rtwwcpig_pckngslp_showHidePos() {
	 	var rtwwcpig_val=jQuery(".rtwwcpig_pckngslp_doc-add-watermark-image-pos-select").val();
	 	if(rtwwcpig_val =='arrays')
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_pos').closest('tr').show();
	 	}
	 	else
	 	{
	 		jQuery('.rtwwcpig_pckngslp_add_watermark_image_pos').closest('tr').hide();
	 	}
	 }
