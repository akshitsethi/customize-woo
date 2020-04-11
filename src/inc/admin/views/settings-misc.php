<?php
/**
 * Misc settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

?>

<div class="as-tile" id="misc">
	<form method="post" class="as-misc-form">
		<div class="as-tile-body">
			<h2 class="as-tile-title"><?php esc_html_e( 'MISC', 'woo-customizer' ); ?></h2>
			<p><?php esc_html_e( 'Configure other options for the WooCommerce.', 'woo-customizer' ); ?></p>

			<div class="as-section-content">
				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'countries_tax_or_vat'; ?>" class="as-strong"><?php esc_html_e( 'Tax Label', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'countries_tax_or_vat'; ?>" id="<?php echo Config::PREFIX . 'countries_tax_or_vat'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_countries_tax_or_vat'] ) ); ?>" placeholder="<?php esc_attr_e( 'Taxes label text', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the Taxes label.', 'woo-customizer' ); ?></p>
					</div>

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'countries_inc_tax_or_vat'; ?>" class="as-strong"><?php esc_html_e( 'Including Tax Label', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'countries_inc_tax_or_vat'; ?>" id="<?php echo Config::PREFIX . 'countries_inc_tax_or_vat'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_countries_inc_tax_or_vat'] ) ); ?>" placeholder="<?php esc_attr_e( 'Including taxes label text', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the including Taxes label.', 'woo-customizer' ); ?></p>
					</div>
				</div>

				<div class="as-double-group as-clearfix">
					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'countries_ex_tax_or_vat'; ?>" class="as-strong"><?php esc_html_e( 'Excluding Tax Label', 'woo-customizer' ); ?></label>
						<input type="text" name="<?php echo Config::PREFIX . 'countries_ex_tax_or_vat'; ?>" id="<?php echo Config::PREFIX . 'countries_ex_tax_or_vat'; ?>" value="<?php echo esc_attr( stripslashes( $options['woocommerce_countries_ex_tax_or_vat'] ) ); ?>" placeholder="<?php esc_attr_e( 'Excluding taxes label text', 'woo-customizer' ); ?>" class="as-form-control">

						<p class="as-form-help-block"><?php esc_html_e( 'Changes the excluding Taxes label.', 'woo-customizer' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</form>
</div><!-- #misc -->
