<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );
if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	foreach ($rtwwcpig_fonts as $rtwwcpig_key => $rtwwcpig_value) 
	{
		$rtwwcpig_pkngslp_font_array[$rtwwcpig_key] = $rtwwcpig_value ;
	}

	global $rtwwcpig_watermark_size_array ;
	$rtwwcpig_watermark_size_array = array('D'=>'Original size of image','P'=>'Resize to fit the full page size, keeping aspect ratio','F'=>'Resize to fit the print-area (frame) respecting current page margins, keeping aspect ratio','INT'=>'Resize to full page size minus a margin set by this integer, keeping aspect ratio','array'=>'Specify Width and Height');
	global $rtwwcpig_watermark_pos ;
	$rtwwcpig_watermark_pos = array('P'=>'Centred on the whole page area','F'=>'Centred on the page print-area (frame) respecting page margins','arrays'=>'Specify a position');

	if(isset($_POST['rtwwcpig_submit'])) { ?>

		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
			</button>
		</div> 
		<?php

		woocommerce_update_options( rtwwcpig_pckngslp_watermak_settings() );

		update_option( 'rtwwcpig_pckngslp_watermark_setting_opt', sanitize_post($_POST['rtwwcpig_pckngslp_watermark_setting_opt']) );

	}

	settings_fields('rtwwcpig_watermark_setting');
	$rtwwcpig_get_setting = get_option('rtwwcpig_pckngslp_watermark_setting_opt'); 

	$rtwwcpig_wtrmrk_txt = get_option('rtwwcpig_enable_pckngslp_text_watermark');
	$rtwwcpig_wtrmrk_img = get_option('rtwwcpig_enable_pckngslp_image_watermark');
	$rtwwcpig_wtrmrk_img_dim = get_option('rtwwcpig_pckngslp_watermark_img_dim');
	$rtwwcpig_wtrmrk_img_pos = get_option('rtwwcpig_pckngslp_watermark_img_pos');

	?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_pckngslp_watermak_settings()); ?> 
	</div>

	<input type="hidden" id="pckngslp_show_wtrmrk_txt" value="<?php echo esc_attr($rtwwcpig_wtrmrk_txt); ?>">
	<input type="hidden" id="pckngslp_show_wtrmrk_img" value="<?php echo esc_attr($rtwwcpig_wtrmrk_img); ?>">
	<input type="hidden" id="pckngslp_wtrmrk_img_dim" value="<?php echo esc_attr($rtwwcpig_wtrmrk_img_dim); ?>">
	<input type="hidden" id="pckngslp_wtrmrk_img_pos" value="<?php echo esc_attr($rtwwcpig_wtrmrk_img_pos); ?>">
	<!-- Image watermark -->
	<table id="rtwwcpig_pckngslp_add_watermark_img" class="wp-list-table form-table rtw-table">
		<tr>
			<th class="descr"><?php esc_html_e('Watermark Image:', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
			<td>
				<?php $src_watermark = isset($rtwwcpig_get_setting['rtwwcpig_watermark_img_url'] ) ? $rtwwcpig_get_setting['rtwwcpig_watermark_img_url'] : '';?>
				<div id="rtwwcpig_watermark_img_backgrnd">
					
					<img id="rtwwcpig_watermark_img" src="<?php echo esc_url($src_watermark); ?>" />
					
				</div>
				<div id="rtwwcpig_wtrmrk_img" >
					<input type="hidden" id="rtwwcpig_watermark_img_url"
					name="rtwwcpig_pckngslp_watermark_setting_opt[rtwwcpig_watermark_img_url]"
					value="<?php echo esc_attr($src_watermark); ?>" />
					<button type="button" class="rtwwcpig_watermark_img_upload button"><?php esc_html_e( 'Upload/Add image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button><br>
					<?php if($src_watermark != '') { ?>
						<button type="button" class="rtwwcpig_watermark_remove_img button"><?php esc_html_e( 'Remove image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button>
					<?php } ?>
				</div>
				<div class="descr"><?php esc_html_e('Choose your Watermark Image which you want to show on pdf.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
			</td>
		</tr>
	</table>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
* function for display WooCommerce settings.
*
* @since    1.0.0
*/
function rtwwcpig_pckngslp_watermak_settings()
{
global $rtwwcpig_watermark_pos;
global $rtwwcpig_watermark_size_array ;
global $rtwwcpig_pkngslp_font_array;
$settings =	array(
	'section_title' => array(
		'name'     => '',
		'type'     => 'title',
		'desc'     => '',
		'id'       => 'rtwwcpig_pckngslp_watermark_setting_opt'
	),
	array(
		'name' 		=> esc_html__( 'Show Watermark Text', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want to show Watermark text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip' =>  true,
		'id'   		=> 'rtwwcpig_enable_pckngslp_text_watermark',
		'class'    => 'rtwwcpig_pckngslp_wtrmrk'
	),
	array(
		'id'          => 'rtwwcpig_pckngslp_watermark_font',
		'class'       => 'rtwwcpig_pckngslp_text_add_watermark',
		'option_key'  => 'watermark_font',
		'name'       => esc_html__( 'Watermark Text', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc' => esc_html__( 'Choose the font family of Watermark text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type'        => 'select',
		'options'     => $rtwwcpig_pkngslp_font_array,
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Watermark Rotation', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Enter your required rotation(in degree) for Watermark text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_rotation',
		'class'       => 'rtwwcpig_pckngslp_text_add_watermark',
		'default'	=> '15',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Watermark Text:', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'textarea',
		'desc' 		=> esc_html__( 'Enter Watermark Text which you want to show on PDF.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_text',
		'class'       => 'rtwwcpig_pckngslp_text_add_watermark',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Text Transparency', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Enter the text Transparency of Watermark.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_text_trans',
		'class'       => 'rtwwcpig_pckngslp_text_add_watermark',
		'default'	=> '0.1',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Watermark Image', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want to show Watermark image.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip' =>  true,
		'id'   		=> 'rtwwcpig_enable_pckngslp_image_watermark',
		'class'    => 'rtwwcpig_pckngslp_imgwtrmk'
	),
	array(
		'name' 		=> esc_html__( 'Image Transparency', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Enter the image transparency of Watermark.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_image_trans',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image',
		'default'	=> '0.1',
		'desc_tip' =>  true,
	),
	array(
		'id'          => 'rtwwcpig_pckngslp_watermark_img_dim',
		'option_key'  => 'rtwwcpig_pckngslp_watermark_img_dim',
		'name'       => esc_html__( 'Image Dimention', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc' => esc_html__( 'Choose the font family of Watermark text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type'        => 'select',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image',
		'options'     => $rtwwcpig_watermark_size_array,
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Integer Value', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Set the integer value for position of Watermark Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_water_img_dim_int',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image_dimen_integer',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Image Width', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Set the Width of Watermark Image', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_water_img_dim_width',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image_dimension',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Image Height', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Set the Height of Watermark Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_water_img_dim_height',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image_dimension',
		'desc_tip' =>  true,
	),
	array(
		'id'          => 'rtwwcpig_pckngslp_watermark_img_pos',
		'option_key'  => 'rtwwcpig_pckngslp_watermark_img_pos',
		'name'       => esc_html__( 'Image Position', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc' => esc_html__( 'Choose the font family of Watermark text.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type'        => 'select',
		'class'       => 'rtwwcpig_pckngslp_doc-add-watermark-image-pos-select',
		'options'     => $rtwwcpig_watermark_pos,
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Vertical Position', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Set the vertical position of Watermark Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_img_pos_y',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image_pos',
		'desc_tip' =>  true,
	),
	array(
		'name' 		=> esc_html__( 'Horizontal Position', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'number',
		'desc' 		=> esc_html__( 'Set the horizontal position of Watermark Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'id'   		=> 'rtwwcpig_pckngslp_watermark_img_pos_x',
		'class'     => 'rtwwcpig_pckngslp_add_watermark_image_pos',
		'desc_tip' =>  true,
	),

	'section_end' => array(
		'type' => 'sectionend',
		'id' => 'rtwwcpig_pckngslp_watermark_setting_opt'
	)
);

return $settings;
}
