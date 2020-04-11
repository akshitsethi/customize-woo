<?php
/**
 * Shop settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

?>

<div class="as-tile" id="shop">
	<form method="post" class="as-shop-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'SHOP', 'woo-customizer' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Shop page.', 'woo-customizer' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'add_to_cart_text'; ?>" class="as-strong"><?php esc_html_e( 'Simple Product', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'add_to_cart_text'; ?>" id="<?php echo Config::PREFIX . 'add_to_cart_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for simple products', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for simple products on all loop pages.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'variable_add_to_cart_text'; ?>" class="as-strong"><?php esc_html_e( 'Variable Product', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'variable_add_to_cart_text'; ?>" id="<?php echo Config::PREFIX . 'variable_add_to_cart_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['variable_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for variable products', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for variable products on all loop pages.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'grouped_add_to_cart_text'; ?>" class="as-strong"><?php esc_html_e( 'Grouped Product', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'grouped_add_to_cart_text'; ?>" id="<?php echo Config::PREFIX . 'grouped_add_to_cart_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['grouped_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for grouped products', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for grouped products on all loop pages.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'out_of_stock_add_to_cart_text'; ?>" class="as-strong"><?php esc_html_e( 'Out of Stock Product', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'out_of_stock_add_to_cart_text'; ?>" id="<?php echo Config::PREFIX . 'out_of_stock_add_to_cart_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['out_of_stock_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for out of stock products', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for out of stock products on all loop pages.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'loop_sale_flash_text'; ?>" class="as-strong"><?php esc_html_e( 'Sale Badge Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'loop_sale_flash_text'; ?>" id="<?php echo Config::PREFIX . 'loop_sale_flash_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['loop_sale_flash_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add text for Sale badge', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the sale flash on all loop pages.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'loop_shop_per_page'; ?>" class="as-strong"><?php esc_html_e( 'Products Displayed Per Page', 'woo-customizer' ); ?></label>
						<select name="<?php echo Config::PREFIX . 'loop_shop_per_page'; ?>" id="<?php echo Config::PREFIX . 'loop_shop_per_page'; ?>">
							<?php

								// Loading font sizes with the help of a loop
							for ( $i = 1; $i < 100; $i++ ) {
								echo '<option value="' . $i . '"' . selected( esc_attr( $options['loop_shop_per_page'] ), $i ) . '>' . $i . '</option>';
							}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of products displayed per page.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'loop_shop_columns'; ?>" class="as-strong"><?php esc_html_e( 'Product Columns Displayed Per Page', 'woo-customizer' ); ?></label>
						<select name="<?php echo Config::PREFIX . 'loop_shop_columns'; ?>" id="<?php echo Config::PREFIX . 'loop_shop_columns'; ?>">
							<?php

								// Loading font sizes with the help of a loop
							for ( $i = 1; $i < 100; $i++ ) {
								echo '<option value="' . $i . '"' . selected( esc_attr( $options['loop_shop_columns'] ), $i ) . '>' . $i . '</option>';
							}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of product columns displayed per page.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'product_thumbnails_columns'; ?>" class="as-strong"><?php esc_html_e( 'Product Thumbnail Columns Displayed', 'woo-customizer' ); ?></label>
						<select name="<?php echo Config::PREFIX . 'product_thumbnails_columns'; ?>" id="<?php echo Config::PREFIX . 'product_thumbnails_columns'; ?>">
							<?php

								// Loading font sizes with the help of a loop
							for ( $i = 1; $i < 100; $i++ ) {
								echo '<option value="' . $i . '"' . selected( esc_attr( $options['woocommerce_product_thumbnails_columns'] ), $i ) . '>' . $i . '</option>';
							}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of products thumbnail columns displayed.', 'woo-customizer' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #shop -->
