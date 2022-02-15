<?php
/**
 * Authentication settings view for the plugin
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

?>

<div class="as-tile" id="authentication">
	<form method="post" class="as-authentication-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'AUTHENTICATION', 'customize-woo' ); ?></h2>
			<p><?php esc_html_e( 'Configure options related to WooCommerce authentication.', 'customize-woo' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_lost_password_message" class="as-strong"><?php esc_html_e( 'Lost Password Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_lost_password_message" id="customizewoo_lost_password_message" value="<?php echo esc_attr( stripslashes( $options['woocommerce_lost_password_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Lost password text', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text shown on the lost password screen.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_lost_password_confirmation_message" class="as-strong"><?php esc_html_e( 'Lost Password Confirmation Message', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_lost_password_confirmation_message" id="customizewoo_lost_password_confirmation_message" value="<?php echo esc_attr( stripslashes( $options['woocommerce_lost_password_confirmation_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Lost password confirmation message', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for lost password confirmation message.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_reset_password_message" class="as-strong"><?php esc_html_e( 'Reset Password Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_reset_password_message" id="customizewoo_reset_password_message" value="<?php echo esc_attr( stripslashes( $options['woocommerce_reset_password_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Reset password text', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text shown on the reset password screen.', 'customize-woo' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #authentication -->
