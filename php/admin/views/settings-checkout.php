<?php
/**
 * Checkout settings view for the plugin
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

?>

<div class="as-tile" id="checkout">
	<form method="post" class="as-checkout-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'CHECKOUT', 'customize-woo' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Checkout page.', 'customize-woo' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_must_be_logged_in_message" class="as-strong"><?php esc_html_e( 'Must be Logged-in Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_must_be_logged_in_message" id="customizewoo_must_be_logged_in_message" value="<?php echo esc_attr( stripslashes( $options['woocommerce_checkout_must_be_logged_in_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Must be logged-in message on checkout page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the message displayed when a customer must be logged in to checkout.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_login_message" class="as-strong"><?php esc_html_e( 'Login Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_login_message" id="customizewoo_login_message" value="<?php echo esc_attr( stripslashes( $options['woocommerce_checkout_login_message'] ) ); ?>" placeholder="<?php esc_attr_e( 'Login message text on product page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the message displayed if customers can login at checkout.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_create_account_default_checked" class="as-strong"><?php esc_html_e( 'Create Account Checkbox Default', 'customize-woo' ); ?></label>
						<select name="customizewoo_create_account_default_checked" id="customizewoo_create_account_default_checked">
							<option value="checked"<?php echo selected( esc_attr( $options['woocommerce_create_account_default_checked'] ), 'checked' ); ?>><?php esc_html_e( 'Checked', 'customize-woo' ); ?></option>
							<option value="unchecked"<?php echo selected( esc_attr( $options['woocommerce_create_account_default_checked'] ), 'unchecked' ); ?>><?php esc_html_e( 'Unchecked', 'customize-woo' ); ?></option>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Control the default state for the Create Account checkbox.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_order_button_text" class="as-strong"><?php esc_html_e( 'Order Button Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_order_button_text" id="customizewoo_order_button_text" value="<?php echo esc_attr( stripslashes( $options['woocommerce_order_button_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Place order button text on product page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the "Place Order" button text on checkout.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_show_terms" class="as-strong"><?php esc_html_e( 'Show Checkout Terms', 'customize-woo' ); ?></label>
						<input type="checkbox" class="as-form-ios" name="customizewoo_show_terms" value="1"<?php checked( true, esc_attr( $options['woocommerce_checkout_show_terms'] ) ); ?>>

						<p class="as-form-help-block"><?php esc_html_e( 'Show or hide Terms & Conditions checkbox on checkout page.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_order_notes_field" class="as-strong"><?php esc_html_e( 'Show Order Notes Field', 'customize-woo' ); ?></label>
						<input type="checkbox" class="as-form-ios" name="customizewoo_order_notes_field" value="1"<?php checked( true, esc_attr( $options['woocommerce_enable_order_notes_field'] ) ); ?>>

						<p class="as-form-help-block"><?php esc_html_e( 'Show or hide Order notes field on checkout page.', 'customize-woo' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #checkout -->
