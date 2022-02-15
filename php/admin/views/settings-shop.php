<?php
/**
 * Shop settings view for the plugin
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

?>

<div class="as-tile" id="shop">
	<form method="post" class="as-shop-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'SHOP', 'customize-woo' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Shop page.', 'customize-woo' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_add_to_cart_text" class="as-strong"><?php esc_html_e( 'Simple Product', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_add_to_cart_text" id="customizewoo_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for simple products', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for simple products on all loop pages.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_variable_add_to_cart_text" class="as-strong"><?php esc_html_e( 'Variable Product', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_variable_add_to_cart_text" id="customizewoo_variable_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['variable_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for variable products', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for variable products on all loop pages.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_grouped_add_to_cart_text" class="as-strong"><?php esc_html_e( 'Grouped Product', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_grouped_add_to_cart_text" id="customizewoo_grouped_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['grouped_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for grouped products', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for grouped products on all loop pages.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_out_of_stock_add_to_cart_text" class="as-strong"><?php esc_html_e( 'Out of Stock Product', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_out_of_stock_add_to_cart_text" id="customizewoo_out_of_stock_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['out_of_stock_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for out of stock products', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for out of stock products on all loop pages.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_external_add_to_cart_text" class="as-strong"><?php esc_html_e( 'External Product', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_external_add_to_cart_text" id="customizewoo_external_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['external_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart button text for external products', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the add to cart button text for external products.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_loop_sale_flash_text" class="as-strong"><?php esc_html_e( 'Sale Badge Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_loop_sale_flash_text" id="customizewoo_loop_sale_flash_text" value="<?php echo esc_attr( stripslashes( $options['loop_sale_flash_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add text for Sale badge', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the sale flash on all loop pages.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_loop_shop_per_page" class="as-strong"><?php esc_html_e( 'Products Displayed Per Page', 'customize-woo' ); ?></label>
						<select name="customizewoo_loop_shop_per_page" id="customizewoo_loop_shop_per_page">
							<?php

								// Loading font sizes with the help of a loop
								for ( $i = 1; $i < 100; $i++ ) {
									echo '<option value="' . $i . '"' . selected( esc_attr( $options['loop_shop_per_page'] ), $i ) . '>' . $i . '</option>';
								}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of products displayed per page.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_loop_shop_columns" class="as-strong"><?php esc_html_e( 'Product Columns Displayed Per Page', 'customize-woo' ); ?></label>
						<select name="customizewoo_loop_shop_columns" id="customizewoo_loop_shop_columns">
							<?php

								// Loading font sizes with the help of a loop
								for ( $i = 1; $i < 100; $i++ ) {
									echo '<option value="' . $i . '"' . selected( esc_attr( $options['loop_shop_columns'] ), $i ) . '>' . $i . '</option>';
								}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of product columns displayed per page.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_product_thumbnails_columns" class="as-strong"><?php esc_html_e( 'Product Thumbnail Columns Displayed', 'customize-woo' ); ?></label>
						<select name="customizewoo_product_thumbnails_columns" id="customizewoo_product_thumbnails_columns">
							<?php

								// Loading font sizes with the help of a loop
								for ( $i = 1; $i < 100; $i++ ) {
									echo '<option value="' . $i . '"' . selected( esc_attr( $options['woocommerce_product_thumbnails_columns'] ), $i ) . '>' . $i . '</option>';
								}

							?>
						</select>

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the number of products thumbnail columns displayed.', 'customize-woo' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #shop -->
