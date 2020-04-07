<?php
/**
 * Product settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

?>

<div class="as-tile" id="product">
	<form method="post" class="as-product-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'PRODUCT', 'woo-customizer' ); ?></h2>
			<p><?php esc_html_e( 'Configure options for the WooCommerce Product page.', 'woo-customizer' ); ?></p>

			<div class="as-section-content">
        <div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'description_tab_title'; ?>" class="as-strong"><?php esc_html_e( 'Product Description Tab Title', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'description_tab_title'; ?>" id="<?php echo Config::PREFIX . 'description_tab_title'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['description_tab_title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Product description tab title', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the product description tab title.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'additional_information_tab_title'; ?>" class="as-strong"><?php esc_html_e( 'Additional Information Tab Title', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'additional_information_tab_title'; ?>" id="<?php echo Config::PREFIX . 'additional_information_tab_title'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['additional_information_tab_title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Additional information tab title', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the additional information tab title.', 'woo-customizer' ); ?></p>
					</div>
				</div>

        <div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'description_heading'; ?>" class="as-strong"><?php esc_html_e( 'Product Description Tab Heading', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'description_heading'; ?>" id="<?php echo Config::PREFIX . 'description_heading'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['description_heading'] ) ); ?>" placeholder="<?php esc_attr_e( 'Product description tab heading', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the product description tab heading.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'additional_information_heading'; ?>" class="as-strong"><?php esc_html_e( 'Additional Information Tab Heading', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'additional_information_heading'; ?>" id="<?php echo Config::PREFIX . 'additional_information_heading'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['additional_information_heading'] ) ); ?>" placeholder="<?php esc_attr_e( 'Additional information tab heading', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the additional information tab heading.', 'woo-customizer' ); ?></p>
					</div>
				</div>

        <div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'single_add_to_cart_text'; ?>" class="as-strong"><?php esc_html_e( 'Add to Cart Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'single_add_to_cart_text'; ?>" id="<?php echo Config::PREFIX . 'single_add_to_cart_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['single_add_to_cart_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Add to Cart text for all product types', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the Add to Cart button text on the single product page for all product types.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'single_out_of_stock_text'; ?>" class="as-strong"><?php esc_html_e( 'Out of Stock Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'single_out_of_stock_text'; ?>" id="<?php echo Config::PREFIX . 'single_out_of_stock_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['single_out_of_stock_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Out of Stock text on product page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the out of stock on product pages.', 'woo-customizer' ); ?></p>
					</div>
				</div>

        <div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'single_backorder_text'; ?>" class="as-strong"><?php esc_html_e( 'Backorder Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'single_backorder_text'; ?>" id="<?php echo Config::PREFIX . 'single_backorder_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['single_backorder_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Backorder text on product page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the backorder on product pages.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'single_sale_flash_text'; ?>" class="as-strong"><?php esc_html_e( 'Sale Badge Text', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'single_sale_flash_text'; ?>" id="<?php echo Config::PREFIX . 'single_sale_flash_text'; ?>" value="<?php echo esc_attr( stripslashes( $options['product']['single_sale_flash_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Sale badge text on product page', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes text for the sale flash on product pages.', 'woo-customizer' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #product -->
