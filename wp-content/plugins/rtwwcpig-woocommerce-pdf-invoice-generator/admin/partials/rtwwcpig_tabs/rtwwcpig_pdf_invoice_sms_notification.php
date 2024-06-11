<?php

$rtwwcpig_purchase_code_details = get_option( 'rtwwcpig_verification_done', array() );

if(!empty($rtwwcpig_purchase_code_details) && is_array($rtwwcpig_purchase_code_details) && !empty($rtwwcpig_purchase_code_details) && isset($rtwwcpig_purchase_code_details['status']) &&  $rtwwcpig_purchase_code_details['status'] == true && isset($rtwwcpig_purchase_code_details['purchase_code']) && $rtwwcpig_purchase_code_details['purchase_code'] != '' )
{ 
	settings_fields('rtwwcpig_sms_setting');
	$rtwwcpig_get_setting = get_option( 'rtwwcpig_sms_setting_opt');
	$doc = "";

	?>
	<div class="rtwwcpig_sms_desc"><?php esc_html_e("You have to add user's Mobile-no manually for sending the SMS notification in your twilio account or buy premium Account. For more info -- ","rtwwcpig-woocommerce-pdf-invoice-generator"); ?><a class="rtwwcpig_twilio_link" target="_blank" href='https://support.twilio.com/hc/en-us/articles/223136107-How-does-Twilio-s-Free-Trial-work-'><?php esc_html_e("Click Here","rtwwcpig-woocommerce-pdf-invoice-generator"); ?></a></div>
	<table class="wp-list-table form-table rtw-table">
		<tbody>
			<tr>
				<th class="descr"><?php esc_html_e('SMS Notification', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></th>
				<td>
					<input type="checkbox" class="rtwwcpig_sms_setting" name="rtwwcpig_sms_setting_opt[rtwwcpig_sms_notification]" value="1" <?php echo isset( $rtwwcpig_get_setting['rtwwcpig_sms_notification'] ) && $rtwwcpig_get_setting['rtwwcpig_sms_notification'] == 1 ? esc_html('checked="checked"') : ''; ?> />
					<div class="descr"><?php esc_html_e('Enable if you want to enable SMS notification.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?><a class="rtwwcpig_sms" target="_blank" href="https://www.twilio.com/try-twilio"><?php esc_html_e('Sinup here in Twilio.', 'rtwwcpig-woocommerce-pdf-invoice-generator');?></a></div>
				</td>
			</tr>
			<tr class="rtwwcpig_accont_setting <?php if( !isset( $rtwwcpig_get_setting['rtwwcpig_sms_notification'] ) ) { echo 'rtwwcpig_hide'; } ?>">
				<th class="descr"><?php esc_html_e('Twilio Account SID', 'rtwwcfp-wordpress-contact-form-7-pdf');?></th>
				<td>
					<input type="text" name="rtwwcpig_sms_setting_opt[twilio_sid]"
					value="<?php echo esc_attr( isset ( $rtwwcpig_get_setting['twilio_sid'] ) ? $rtwwcpig_get_setting['twilio_sid'] : ''); ?>" />
					<div class="descr"><?php esc_html_e('Enter your twilio account SID.', 'rtwwcfp-wordpress-contact-form-7-pdf');?></div>
				</td>
			</tr>
			<tr class="rtwwcpig_auth_setting <?php if( !isset( $rtwwcpig_get_setting['rtwwcpig_sms_notification'] ) ) { echo 'rtwwcpig_hide'; } ?>">
				<th class="descr"><?php esc_html_e('Twilio Auth Token', 'rtwwcfp-wordpress-contact-form-7-pdf');?></th>
				<td>
					<input type="text" name="rtwwcpig_sms_setting_opt[twilio_auth_token]"
					value="<?php echo esc_attr( isset ( $rtwwcpig_get_setting['twilio_auth_token'] ) ? $rtwwcpig_get_setting['twilio_auth_token'] : ''); ?>" />
					<div class="descr"><?php esc_html_e('Enter your twilio auth token.', 'rtwwcfp-wordpress-contact-form-7-pdf');?></div>
				</td>
			</tr>
			<tr class="rtwwcpig_phone_setting <?php if( !isset( $rtwwcpig_get_setting['rtwwcpig_sms_notification'] ) ) { echo 'rtwwcpig_hide'; } ?>">
				<th class="descr"><?php esc_html_e('Twilio Phone No.', 'rtwwcfp-wordpress-contact-form-7-pdf');?></th>
				<td>
					<input type="text" name="rtwwcpig_sms_setting_opt[twilio_phone_no]"
					value="<?php echo esc_attr( isset ( $rtwwcpig_get_setting['twilio_phone_no'] ) ? $rtwwcpig_get_setting['twilio_phone_no'] : ''); ?>" />
					<div class="descr"><?php esc_html_e('Enter your twilio account phone number.', 'rtwwcfp-wordpress-contact-form-7-pdf');?></div>
				</td>
			</tr>
		</tbody>
	</table>
<?php }