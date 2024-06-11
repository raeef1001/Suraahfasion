<?php 

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{ ?>
	<div class="rtwwcpig-help-wrapper">
		<div class="rtwwcpig-help-section-heading"><?php esc_html_e( 'Know How It Works', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></div>
		<div class="rtwwcpig-column">
			<div class="rtwwcpig-inner-content">
				<div class="rtwwcpig-help-image">
					<img src="<?php echo esc_url(RTWWCPIG_URL.'assets/document.png'); ?>">
				</div>
				<a target="_blank" href="<?php echo esc_url('https://redefiningtheweb.com/docs/woocommerce-pdf-invoice-generator/overview/'); ?>" class="rtwwcpig-button"><?php esc_html_e( 'Documentation', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></a>
			</div>
		</div>
		<div class="rtwwcpig-column">
			<div class="rtwwcpig-inner-content">
				<div class="rtwwcpig-help-image">
					<img src="<?php echo esc_url(RTWWCPIG_URL.'assets/support.png'); ?>">
				</div>
				<a target="_blank" href="<?php echo esc_url('https://redefiningtheweb.freshdesk.com/support/tickets/new'); ?>" class="rtwwcpig-button"><?php esc_html_e( 'Support Desk', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></a>
			</div>
		</div>
		
		<div class="rtwwqcp-column rtwwqcp-faq-column">
			<div class="rtwwdcp-inner-content">
				<div class="rtwwqcp-help-image">
					<img src="<?php echo esc_url(RTWWCPIG_URL.'assets/faq.png'); ?>">
				</div>
				<div class="rtwwqcp-faq-wrapper">
					<div class="rtwwqcp-faq-content">
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How to Generate Normal PDF Invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<?php esc_html_e( 'You need to follow following steps :', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
							<ol>
								<li><?php esc_html_e( 'Please first enable the Normal Invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'First click on the PDF invoice setting menu from WooCommerce menu.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'Now select a completed status in Select the status option.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'Also enable the Download from edit order page option so that you can delete or regenerate the PDF invoice again from edit order page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
							</ol>
						</div>
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How To Generate Proforma Invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<ol>
								<li><?php esc_html_e( 'Please first enable the Proforma Invoice.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'Now select the any status except completed in Select the status option in Normal invoice setting tab', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'Also enable the Download from edit order page option so that you can delete or regenerate the PDF packing slip again from edit order page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
							</ol>
						</div>
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How To Download PDF Inovice From My Account Page :', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<ol>
								<li><?php esc_html_e( 'For download the PDF invoice from my account page please enable the Download the from my account page option in normarl invoice setting tab as well as Proforma invoice setting tab.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
							</ol>
						</div>
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How to download Invoice From Order detial page.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<ol>
								<li><?php esc_html_e( 'Please enable the Download From order Detail Page option in Normal invoice setting tab as well as proforma invoice tab.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'You can also download PDF invoice and Packing slip from Order list page, For this you have to enable the Download from Order List Page option in Normal invoice setting tab.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
							</ol>
						</div>
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How to generate Packing Slip.?', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<ol>
								<li><?php esc_html_e( 'Enable the Packing Slip option from Packing Slip setting menu.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
								<li><?php esc_html_e( 'Also please repeat the all previous setting as PDF invoice setting.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></li>
							</ol>
						</div>
						<h5 class="rtwwqcp-faq-heading"><?php esc_html_e( 'How To Generate shipping Label.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?></h5>
						<div class="rtwwqcp-faq-desc">
							<?php esc_html_e( 'First please goto PDF Shipping Label Setting menu then enable the Shipping Label Option.', 'rtwwcpig-woocommerce-pdf-invoice-generator' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
<?php }else{
	include_once(RTWWCPIG_DIR.'/admin/partials/rtwwcpig_html/rtwwcpig_purchase_code_verification.php');
}
