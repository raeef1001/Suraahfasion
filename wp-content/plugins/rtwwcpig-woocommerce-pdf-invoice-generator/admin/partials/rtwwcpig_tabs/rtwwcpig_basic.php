<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	if(isset($_POST['rtwwcpig_submit'])) 
		{ ?>
			<div class="notice notice-success is-dismissible">
				<p><strong><?php esc_html_e('Settings saved.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></strong></p>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text"><?php esc_html_e('Dismiss this notices.','rtwwcpig-woocommerce-pdf-invoice-generator'); ?></span>
				</button>
			</div> 
			<?php
			woocommerce_update_options( rtwwcpig_basics_settings() );

			update_option( 'rtwwcpig_basic_setting_opt', sanitize_post($_POST['rtwwcpig_basic_setting_opt']) );
		}

		global $rtwwcpig_dsply ;
		settings_fields('rtwwcpig_basic_setting');
		$rtwwcpig_get_setting = get_option('rtwwcpig_basic_setting_opt');
		$rtwwcpig_get_wc_sttng = get_option('rtwwcpig_enable_paswrd'); 

	?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_basics_settings()); ?> 
	</div>

	<input type="hidden" id="pswrd_enable_val" value="<?php echo esc_attr($rtwwcpig_get_wc_sttng); ?>">
	<table class="wp-list-table form-table rtw-table">
		<tbody>
			<tr>
				<th class="descr"><?php esc_html_e('Image For Button:', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php $rtwwcpig_image_url = isset($rtwwcpig_get_setting['img_url'] ) ? $rtwwcpig_get_setting['img_url'] : '';?>
					<div id="rtwwcpig_btn_img">
						<img id="rtwwcpig_img_btn" src="<?php echo esc_url($rtwwcpig_image_url); ?>" />
					</div>
					<div id="rtwwcpig_image_url" >
						<input type="hidden" id="rtwwcpig_img_url"
						name="rtwwcpig_basic_setting_opt[img_url]"
						value="<?php echo esc_attr($rtwwcpig_image_url); ?>" />
						<button type="button" class="rtwwcpig_btn_img_upload button"><?php esc_html_e( 'Upload/Add image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button><br>
						<?php if($rtwwcpig_image_url != ''){ ?>
							<button type="button" class="rtwwcpig_btn_remove_img button"><?php esc_html_e( 'Remove image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button>
						<?php } ?>
					</div>
					<div class="descr"><?php esc_html_e('Choose your Image which you want to show on `Download PDF Invoice` Button in Order Edit Page.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Height For Button:', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<input type="text" name="rtwwcpig_basic_setting_opt[btn_img_height]"
					value="<?php echo esc_attr( isset ( $rtwwcpig_get_setting['btn_img_height'] ) ? $rtwwcpig_get_setting['btn_img_height'] : ''); ?>" />
					<div class="descr"><?php esc_html_e('Enter the Height of Button Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Width For Button:', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<input type="text" name="rtwwcpig_basic_setting_opt[btn_img_width]"
					value="<?php echo esc_attr( isset ( $rtwwcpig_get_setting['btn_img_width'] ) ? $rtwwcpig_get_setting['btn_img_width'] : ''); ?>" />
					<div class="descr"><?php esc_html_e('Enter the Width of Button Image.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Set background Image for PDF', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php $rtwwcpig_src_img = isset($rtwwcpig_get_setting['bck_img_url'] ) ? $rtwwcpig_get_setting['bck_img_url'] : '';?>
					<div id="rtwwcpig_bckgrnd_img">
						
						<img id="rtwwcpig_bckgrnd_img_btn" src="<?php echo esc_url($rtwwcpig_src_img); ?>"/>
						
					</div>
					<div id="rtwwcpig_bck_img">
						<input type="hidden" id="rtwwcpig_bck_img_url"
						name="rtwwcpig_basic_setting_opt[bck_img_url]"
						value="<?php echo esc_attr($rtwwcpig_src_img); ?>" />
						<button type="button" class="rtwwcpig_btn_bckgrnd_img_upload button"><?php esc_html_e( 'Upload/Add image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button><br>
						<?php if($rtwwcpig_src_img != ''){ ?>
							<button type="button" class="rtwwcpig_btn_remove_bckgrnd_img button"><?php esc_html_e( 'Remove image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button>
						<?php } ?>
					</div>
					<div class="descr"><?php esc_html_e('Choose your Image which you want to show as background image in generated PDF Invoice. ( this will not works if you already set background color. )', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Select Background color For PDF', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php $rtwwcpig_back_color = isset($rtwwcpig_get_setting['back_color'] ) ? $rtwwcpig_get_setting['back_color'] : ''; ?>
					<div class="wp-picker-container">
						<input class="color-field" type="text" name="rtwwcpig_basic_setting_opt[back_color]" value="<?php echo esc_attr($rtwwcpig_back_color); ?>" />
					</div>
					<div class="descr"><?php esc_html_e('Choose the color for your pdf background. ( this will not works if you already set background image. )', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr> 
		</tbody>
	</table>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
 * function for display WooCommerce settings.
 *
 * @since    1.0.0
 */ 
function rtwwcpig_basics_settings()
{
	$settings =	array(
		'section_title' => array(
			'name'     => '',
			'type'     => 'title',
			'desc'     => '',
			'id'       => 'rtwwcpig_basic_setting_opt'
		),
		array(
			'name' 		=> esc_html__( 'Rtl Support', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want generate pdf in Arabic or languages which start from right align.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_rtl',
		),
		array(
			'name' 		=> esc_html__( 'Enable Password Protection', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want to enable Password Protection.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_enable_paswrd',
			'class'     =>  'rtwwcpig_pswrd_prtcn'
		),
		array(
			'id'          => 'rtwwcpig_add_pswrd_protctn',
			'option_key'  => 'rtwwcpig_add_pswrd_protctn',
			'class'       => 'rtwwcpig_add_pswrd_protctn',
			'name'        => esc_html__( 'For User Password', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' 		  => esc_html__( 'Chosee which type of password you want to set for user.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type'        => 'radio',
			'desc_tip'    =>  true,
			'options'     => array(
				'protctn_type_ordr_id'   => esc_html__( 'Order ID', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'protctn_type_email'  => esc_html__( 'E-mail', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			)
		),
		array(
			'name' 		=> esc_html__( 'Admin Password', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'text',
			'desc' 		=> esc_html__( 'Enter the password for Admin by which he can access all the pdf.By default "12345678" is set', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'id'   		=> 'rtwwcpig_admin_pswrd',
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Hide Page No.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'checkbox',
			'desc' 		=> esc_html__( 'Check it if you want Hide PDF page no.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_page_no'
		),
		array(
			'name' 		=> esc_html__( 'Name Of The PDF Invoice', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'text',
			'desc' 		=> esc_html__( 'You can set the name for generated pdf invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc_tip'  =>  true,
			'id'   		=> 'rtwwcpig_custm_pdf_name'
		),
				array(
			'id'          => 'rtwwcpig_nmbrng_method',
			'option_key'  => 'rtwwcpig_nmbrng_method',
			'name'       => esc_html__( 'Numbering Method', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'desc' => esc_html__( 'Select numbering method for generated PDF invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator.' ),
			'default'     => '',
			'type'        => 'select',
			'options'     => array(
				'ordr_suf_pre'  => esc_html__( 'Order Number Plus Suffix/Prefix', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
				'ordr_nmbr'  => esc_html__( 'Order Number', 'rtwwcpig-woocommerce-pdf-invoice-generator' )
			),
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Prefix', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'text',
			'desc' 		=> esc_html__( 'Enter the prefix value for PDF invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'id'   		=> 'rtwwcpig_prefix',
			'default'	=> '',
			'desc_tip' =>  true,
		),
		array(
			'name' 		=> esc_html__( 'Suffix', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'type' 		=> 'text',
			'desc' 		=> esc_html__( 'Enter the suffix value for PDF invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
			'id'   		=> 'rtwwcpig_suffix',
			'default'	=> '',
			'desc_tip' =>  true,
		),
		'section_end' => array(
			'type' => 'sectionend',
			'id' => 'wc_settings_tab_demo_section_end'
		)
	);

	return $settings;
}