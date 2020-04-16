<?php
/**
 * Settings panel view for the plugin.
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\CustomizeWoo\Config;
require_once 'header.php';

?>

<div class="as-body as-clearfix">
	<div class="as-float-left">
		<div class="as-mobile-menu">
			<a href="javascript:void;">
				<img src="<?php echo Config::$plugin_url; ?>assets/admin/images/toggle.png" alt="<?php esc_attr_e( 'Menu', 'customize-woo' ); ?>" />
			</a>
		</div><!-- .as-mobile-menu -->

		<ul class="as-main-menu">
			<li><a href="#shop"><?php esc_html_e( 'Shop', 'customize-woo' ); ?></a></li>
			<li><a href="#product"><?php esc_html_e( 'Product', 'customize-woo' ); ?></a></li>
			<li><a href="#checkout"><?php esc_html_e( 'Checkout', 'customize-woo' ); ?></a></li>
			<li><a href="#misc"><?php esc_html_e( 'Misc', 'customize-woo' ); ?></a></li>
			<li><a href="#support"><?php esc_html_e( 'Support', 'customize-woo' ); ?></a></li>
			<li><a href="#about"><?php esc_html_e( 'About', 'customize-woo' ); ?></a></li>
		</ul>
	</div><!-- .as-float-left -->

	<div class="as-float-right">
		<?php

			// Tabs
			require_once Config::$plugin_path . 'inc/admin/views/settings-shop.php';
			require_once Config::$plugin_path . 'inc/admin/views/settings-product.php';
			require_once Config::$plugin_path . 'inc/admin/views/settings-checkout.php';
			require_once Config::$plugin_path . 'inc/admin/views/settings-misc.php';
			require_once Config::$plugin_path . 'inc/admin/views/settings-support.php';
			require_once Config::$plugin_path . 'inc/admin/views/settings-about.php';

		?>
	</div><!-- .as-float-right -->
</div><!-- .as-body -->

<?php

require_once 'footer.php';
