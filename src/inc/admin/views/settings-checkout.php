<?php
/**
 * Checkout settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

?>

<div class="as-tile" id="checkout">
	<form method="post" class="as-checkout-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'CHECKOUT', 'woo-customizer' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Checkout page.', 'woo-customizer' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'must_be_logged_in_message'; ?>" class="as-strong"><?php esc_html_e( 'Must be Logged-in Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'must_be_logged_in_message'; ?>" id="<?php echo Config::PREFIX . 'must_be_logged_in_message'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_must_be_logged_in_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Must be logged-in message on checkout page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the message displayed when a customer must be logged in to checkout.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'coupon_message'; ?>" class="as-strong"><?php esc_html_e( 'Coupon Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'coupon_message'; ?>" id="<?php echo Config::PREFIX . 'coupon_message'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_coupon_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Coupon message text on checkout page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the message displayed if the coupon form is enabled on checkout.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'login_message'; ?>" class="as-strong"><?php esc_html_e( 'Login Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'login_message'; ?>" id="<?php echo Config::PREFIX . 'login_message'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_login_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Login message text on product page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the message displayed if customers can login at checkout.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'create_account_default_checked'; ?>" class="as-strong"><?php esc_html_e( 'Create Account Checkbox Default', 'woo-customizer' ); ?></label>
						<select name="<?php echo Config::PREFIX . 'create_account_default_checked'; ?>" id="<?php echo Config::PREFIX . 'create_account_default_checked'; ?>">
							<option value="checked"<?php echo selected( esc_attr( $options['woocommerce_create_account_default_checked'] ), 'checked' ); ?>><?php esc_html_e( 'Checked', 'woo-customizer' ); ?></option>
							<option value="unchecked"<?php echo selected( esc_attr( $options['woocommerce_create_account_default_checked'] ), 'unchecked' ); ?>><?php esc_html_e( 'Unchecked', 'woo-customizer' ); ?></option>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Control the default state for the Create Account checkbox.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'order_button_text'; ?>" class="as-strong"><?php esc_html_e( 'Order Button Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'order_button_text'; ?>" id="<?php echo Config::PREFIX . 'order_button_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_order_button_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Place order button text on product page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the "Place Order" button text on checkout.', 'woo-customizer' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #checkout -->
