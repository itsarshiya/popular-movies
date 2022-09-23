<h2><?php esc_html_e( 'Security by SiteGround' ); ?></h2>
<table class="form-table">
<?php
	// Check if we have a secret and print it.
	if ( ! empty( $secret ) ):
?>
<tr>
	<th>
		<label for="user_location"><?php esc_html_e( '2FA Secret Key', 'sg-security' ); ?></label>
	</th>
	<td>
		<text name="sg_security_2fa_secret_key" id="sg_security_2fa_secret_key" disabled="disabled" class="regular-text" rows="1"><b><?php echo $secret; ?></b></text>
		<p class="description"><?php esc_html_e( 'Use the secret key as an alternative to the QR code if you want to import your token to a new Authenticator app.', 'sg-security' ); ?></p>
	</td>
</tr>	
<tr>
	<th>
		<label for="user_location"><?php esc_html_e( '2FA QR Code', 'sg-security' ); ?></label>
	</th>
	<td>
		<img src="<?php echo $qr; ?>" name="sg_security_2fa_qr_code" id="sg_security_2fa_qr_code" disabled="disabled" class="image" ></img>
		<p class="description"><?php esc_html_e( 'Scan the QR code with your device with Authenticator app to have the token automatically added to the app.', 'sg-security' ); ?></p>
	</td>
</tr>
<?php endif; ?>
</table>
