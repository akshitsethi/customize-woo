<?php
/**
 * Product settings view for the plugin
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

?>

<div class="as-tile" id="product">
	<form method="post" class="as-product-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'PRODUCT', 'customize-woo' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Product page.', 'customize-woo' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_description_tab_title" class="as-strong"><?php esc_html_e( 'Product Description Tab Title', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_description_tab_title" id="customizewoo_description_tab_title" value="<?php echo esc_attr( stripslashes( $options['product_description_tab_title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Product description tab title', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the product description tab title.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_description_heading" class="as-strong"><?php esc_html_e( 'Product Description Tab Heading', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_description_heading" id="customizewoo_description_heading" value="<?php echo esc_attr( stripslashes( $options['product_description_heading'] ) ); ?>" placeholder="<?php esc_attr_e( 'Product description tab heading', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the product description tab heading.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_reviews_tab_title" class="as-strong"><?php esc_html_e( 'Reviews Tab Title', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_reviews_tab_title" id="customizewoo_reviews_tab_title" value="<?php echo esc_attr( stripslashes( $options['product_reviews_tab_title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Reviews tab title', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the reviews tab title.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label class="as-strong"><?php esc_html_e( 'Reviews Tab Heading', 'customize-woo' ); ?></label>
						<p class="as-form-help-block"><?php esc_html_e( 'Unfortunately, WooCommerce does not provide a method to modify this.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_additional_information_tab_title" class="as-strong"><?php esc_html_e( 'Additional Information Tab Title', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_additional_information_tab_title" id="customizewoo_additional_information_tab_title" value="<?php echo esc_attr( stripslashes( $options['product_additional_information_tab_title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Additional information tab title', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the additional information tab title.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_additional_information_heading" class="as-strong"><?php esc_html_e( 'Additional Information Tab Heading', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_additional_information_heading" id="customizewoo_additional_information_heading" value="<?php echo esc_attr( stripslashes( $options['product_additional_information_heading'] ) ); ?>" placeholder="<?php esc_attr_e( 'Additional information tab heading', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the additional information tab heading.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_single_add_to_cart_text" class="as-strong"><?php esc_html_e( 'Add to Cart Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_single_add_to_cart_text" id="customizewoo_single_add_to_cart_text" value="<?php echo esc_attr( stripslashes( $options['single_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart text for all product types', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the Add to Cart button text on the single product page for all product types.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_single_out_of_stock_text" class="as-strong"><?php esc_html_e( 'Out of Stock Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_single_out_of_stock_text" id="customizewoo_single_out_of_stock_text" value="<?php echo esc_attr( stripslashes( $options['single_out_of_stock_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Out of Stock text on product page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the out of stock on product pages.', 'customize-woo' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="customizewoo_single_backorder_text" class="as-strong"><?php esc_html_e( 'Backorder Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_single_backorder_text" id="customizewoo_single_backorder_text" value="<?php echo esc_attr( stripslashes( $options['single_backorder_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Backorder text on product page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the backorder on product pages.', 'customize-woo' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="customizewoo_single_sale_flash_text" class="as-strong"><?php esc_html_e( 'Sale Badge Text', 'customize-woo' ); ?></label>
						<input type="text" name="customizewoo_single_sale_flash_text" id="customizewoo_single_sale_flash_text" value="<?php echo esc_attr( stripslashes( $options['single_sale_flash_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Sale badge text on product page', 'customize-woo' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the sale flash on product pages.', 'customize-woo' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #product -->
