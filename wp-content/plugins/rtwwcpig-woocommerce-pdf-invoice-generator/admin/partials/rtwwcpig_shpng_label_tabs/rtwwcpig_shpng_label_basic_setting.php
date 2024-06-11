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
			woocommerce_update_options( rtwwcpig_shipn_label_basics_settings() );
			update_option( 'rtwwcpig_shipng_label_stng_opt', sanitize_post( $_POST['rtwwcpig_shipng_label_stng_opt'] ));
		}

		$rtwwcpig_get_setting = get_option('rtwwcpig_shipng_label_stng_opt');
	?>

	<div class="rtwwcpig_tab_div">
		<?php woocommerce_admin_fields(rtwwcpig_shipn_label_basics_settings()); ?> 
	</div>

	<table class="wp-list-table form-table rtw-table">
		<tbody>
			<tr>
				<th class="descr"><?php esc_html_e('Set background Image for shiping label PDF.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php $rtwwcpig_src_img = isset($rtwwcpig_get_setting['bck_img_url'] ) ? $rtwwcpig_get_setting['bck_img_url'] : '';?>
					<div id="rtwwcpig_bckgrnd_img">
						<img id="rtwwcpig_bckgrnd_img_btn" src="<?php echo esc_url($rtwwcpig_src_img); ?>"/>
					</div>
					<div id="rtwwcpig_bck_img">
						<input type="hidden" id="rtwwcpig_bck_img_url"
						name="rtwwcpig_shipng_label_stng_opt[bck_img_url]"
						value="<?php echo esc_attr($rtwwcpig_src_img); ?>" />
						<button type="button" class="rtwwcpig_btn_bckgrnd_img_upload button"><?php esc_html_e( 'Upload/Add image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button><br>
						<?php if($rtwwcpig_src_img != ''){ ?>
							<button type="button" class="rtwwcpig_btn_remove_bckgrnd_img button"><?php esc_html_e( 'Remove image', 'rtwwcpig-woocommerce-pdf-invoice-generator'); ?></button>
						<?php } ?>
					</div>
					<div class="descr"><?php esc_html_e('Choose your Image which you want to show as background image in generated Shipping label. ( this will not works if you already set background color. )', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
			<tr>
				<th class="descr"><?php esc_html_e('Select Background color For shiping label PDF', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<?php $rtwwcpig_back_color = isset($rtwwcpig_get_setting['back_color'] ) ? $rtwwcpig_get_setting['back_color'] : ''; ?>
					<div class="wp-picker-container">
						<input class="color-field" type="text" name="rtwwcpig_shipng_label_stng_opt[back_color]" value="<?php echo esc_attr($rtwwcpig_back_color); ?>" />
					</div>
					<div class="descr"><?php esc_html_e('Choose the color for your shiping label pdf background. ( this will not works if you already set background image. )', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></div>
				</td>
			</tr>
		</tbody>
	</table>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}

/**
* function for display woocommerce settings.
*
* @since    1.2.0
*/

function rtwwcpig_shipn_label_basics_settings()
{
$settings =	array(
	'section_title' => array(
		'name'     => '',
		'type'     => 'title',
		'desc'     => '',
		'id'       => 'rtwwcpig_shipng_label_stng_opt'
	),
	array(
		'name' 		=> esc_html__( 'Enable shiping label', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want generate shiping label for orders.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip'  =>  true,
		'id'   		=> 'rtwwcpig_enable_shpng_lbl',
	),
	array(
		'name' 		=> esc_html__( 'Download shiping label', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want to download shiping label of an order  from edit order Page', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip'  =>  true,
		'id'   		=> 'rtwwcpig_download_shpng_lbl',
	),
	array(
		'name' 		=> esc_html__( 'Rtl Support', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want generate shiping label in Arabic or languages which start from right align.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip'  =>  true,
		'id'   		=> 'rtwwcpig_shpng_lbl_rtl',
	),
	array(
		'name' 		=> esc_html__( 'Hide Page No.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'type' 		=> 'checkbox',
		'desc' 		=> esc_html__( 'Check it if you want Hide shiping label page no.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ),
		'desc_tip'  =>  true,
		'id'   		=> 'rtwwcpig_shpng_lbl_page_no'
	),
	'section_end' => array(
		'type' => 'sectionend',
		'id' => 'rtwwcpig_shipng_label_stng_opt'
	)
);

return $settings;
}
