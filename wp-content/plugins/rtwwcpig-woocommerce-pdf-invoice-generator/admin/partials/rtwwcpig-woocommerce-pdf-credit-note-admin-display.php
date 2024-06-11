<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.redefiningtheweb.com
 * @since      1.4.0
 *
 * @package    Rtwwcpig_WooCommerce_Pdf_Invoice_Generator
 * @subpackage Rtwwcpig_WooCommerce_Pdf_Invoice_Generator/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{
	global $rtwwcpig_credit_note_font_array;
	global $rtwwcpig_page_size;

	$rtwwcpig_basic_active = '';
	$rtwwcpig_header_active = '';
	$rtwwcpig_footer_active = '';
	$rtwwcpig_css_active = '';
	$rtwwcpig_watermark_active = '';
	$rtwwcpig_credit_note_format_active = '';

	$rtwwcpig_custom_fonts = get_option('rtwwcpig_custom_fonts', array());
	if(!class_exists('mPDF'))
	{	
		include(RTWWCPIG_DIR ."includes/mpdf/autoload.php");
	}
	$rtwwcpig_mpdf = new \Mpdf\Mpdf();
	$rtwwcpig_merge_font = array();

	if( !empty( $rtwwcpig_custom_fonts ) ) 
	{
		foreach( $rtwwcpig_custom_fonts as $key=> $value )
		{
			$rtwwcpig_merge_font[$key] = $key;
		}
	}

	foreach ($rtwwcpig_mpdf->fontdata as $rtwwcpig_key=> $rtwwcpig_value)
	{
		$rtwwcpig_mpdf_font[$rtwwcpig_key] = $rtwwcpig_key;
	}
	$rtwwcpig_fonts = array_merge( $rtwwcpig_mpdf_font, $rtwwcpig_merge_font );

	if (isset($_GET['rtwwcpig_tab'])) 
	{
		if ($_GET['rtwwcpig_tab'] == "rtwwcpig_basic") 
		{
			$rtwwcpig_basic_active = "nav-tab-active";
		}
		if($_GET['rtwwcpig_tab'] == "rtwwcpig_header")
		{
			$rtwwcpig_header_active = "nav-tab-active";
		}
		elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_footer") 
		{
			$rtwwcpig_footer_active = "nav-tab-active";
		}
		elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_css") 
		{
			$rtwwcpig_css_active = "nav-tab-active";
		}
		elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_watermark") 
		{
			$rtwwcpig_watermark_active = "nav-tab-active";
		}
		elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_credit_note_format") 
		{
			$rtwwcpig_credit_note_format_active = "nav-tab-active";
		}
	}
	else
	{
		$rtwwcpig_basic_active = "nav-tab-active";
	} 

	?>

	<div class="main-wrapper">
		<div class="rtwwcpig_admin_wrapper">
			<h2 class="rtw-main-heading">
				<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/Plugin_icon.png' ); ?>" alt="">
				<span><?php echo esc_html__('WooCommerce PDF Invoice & Packing Slip Generator','rtwwcpig-woocommerce-pdf-invoice-generator');?></span>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=rtwwcpig-pdf-invoice-settings&rtwwcpig_action=delete_purchase_code' ) );?>" class="purchase_code"><?php esc_html_e( 'Remove Purchase Code', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></a>
			</h2>
			<nav class="<?php echo esc_attr( 'rtw-navigation-wrapper nav-tab-wrapper' ); ?>">
					<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo  esc_attr($rtwwcpig_basic_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=rtwwcpig_basic');?>">
						<div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/basic.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note Basic','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
						<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo esc_attr($rtwwcpig_header_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=rtwwcpig_header');?>"><div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/header.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note Header','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
						<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo esc_attr($rtwwcpig_footer_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=rtwwcpig_footer');?>"><div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/footer.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note Footer','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
					<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo esc_attr($rtwwcpig_css_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=rtwwcpig_css');?>">
						<div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/css.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note CSS','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
					<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo esc_attr($rtwwcpig_watermark_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=rtwwcpig_watermark');?>"><div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/watermark.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note WaterMark','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
					<a class="<?php echo esc_attr( 'nav-tab' ); ?> <?php echo esc_attr($rtwwcpig_credit_note_format_active);?>" href="<?php echo esc_url(get_admin_url().'admin.php?page=rtwwcpig-pdf-credit-note-settings&rtwwcpig_tab=credit_note');?>">
						<div class="rtwwcpig_tab_icon">
							<img src="<?php echo esc_url( RTWWCPIG_URL.'assets/Packing-Slip-format.png' ); ?>" alt="">
						</div><?php echo esc_html__('Credit Note Format','rtwwcpig-woocommerce-pdf-invoice-generator');?>
					</a>
				</nav>
				<?php 
				settings_errors();
				?>

				
				<form enctype="multipart/form-data" action=" "  method="post" />
				<?php
				if(isset($_GET['rtwwcpig_tab']))
				{
					if($_GET['rtwwcpig_tab'] == "rtwwcpig_basic")
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_basic_setting.php');
					}
					elseif($_GET['rtwwcpig_tab'] == "rtwwcpig_header")
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_header_setting.php');
					}
					elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_footer") 
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_footer_setting.php');
					}
					elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_css") 
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_css_setting.php');
					}
					elseif ($_GET['rtwwcpig_tab'] == "rtwwcpig_watermark") 
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_watermark_setting.php');
					}
					elseif($_GET['rtwwcpig_tab'] == "credit_note")
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_format.php');
					}
					elseif($_GET['rtwwcpig_tab'] == "rtwwcpig_credit_note_help_section")
					{
						include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_help.php');
					}
				}
				else
				{
					include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_credit_note_tabs/rtwwcpig_credit_note_basic_setting.php');
				}
				if(!isset($_GET['rtwwcpig_tab']) || $_GET['rtwwcpig_tab'] != "rtwwcpig_credit_note_help_section"){
					?>
					<p class="submit">
						<input type="submit" value="<?php esc_attr_e('Save changes','rtwwcpig-woocommerce-pdf-invoice-generator');?>" class="rtw-button" name="rtwwcpig_submit">
					</p>
				</form>
			<?php } ?>
		</div>
	</div>

	<footer class="rtwwcpig-footer">
		<p>
			<span>
				<?php esc_html_e( 'WooCommerce PDF Invoice & Packing Slip Generator By', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
			</span>
			<a href="<?php echo esc_url( 'https://www.codecanyon.net/user/redefiningtheweb/portfolio' ); ?>" target="_blank">
				<?php esc_html_e( 'RedefiningTheWeb', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
			</a>
		</p>
		<a href="<?php echo esc_url( "https://redefiningtheweb.com/docs/woocommerce-pdf-invoice-generator/overview/" ) ?>" target="_blank" class="rtwwcpig-button">
			<?php esc_html_e( 'Documentation', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
		</a>
		<a href="<?php echo esc_url( "https://codecanyon.net/item/woocommerce-pdf-invoice-packing-slip-generator/reviews/24179339" ); ?>" class="rtwwcpig-button">
			<?php esc_html_e( '5-Stars Rating', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
		</a>
	</footer>
	<?php
}else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}
