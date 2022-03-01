<?php
/**
 * Settings panel view for the plugin.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

use AkshitSethi\Plugins\CustomizeWoo\Config;
require_once 'header.php';

?>

<div class="as-body as-clearfix">
	<div class="as-float-left">
		<div class="as-mobile-menu">
			<a href="javascript:void;">
				<img src="<?php echo esc_url( Config::$plugin_url ); ?>assets/admin/images/toggle.png" alt="<?php esc_attr_e( 'Menu', 'customize-woo' ); ?>" />
			</a>
		</div><!-- .as-mobile-menu -->

		<ul class="as-main-menu">
			<li><a href="#shop"><?php esc_html_e( 'Shop', 'customize-woo' ); ?></a></li>
			<li><a href="#product"><?php esc_html_e( 'Product', 'customize-woo' ); ?></a></li>
			<li><a href="#cart"><?php esc_html_e( 'Cart', 'customize-woo' ); ?></a></li>
			<li><a href="#checkout"><?php esc_html_e( 'Checkout', 'customize-woo' ); ?></a></li>
			<li><a href="#authentication"><?php esc_html_e( 'Authentication', 'customize-woo' ); ?></a></li>
			<li><a href="#misc"><?php esc_html_e( 'Misc', 'customize-woo' ); ?></a></li>
		</ul>
	</div><!-- .as-float-left -->

	<div class="as-float-right">
		<?php

			// Tabs.
			require_once Config::$plugin_path . 'php/admin/views/settings-shop.php';
			require_once Config::$plugin_path . 'php/admin/views/settings-product.php';
			require_once Config::$plugin_path . 'php/admin/views/settings-cart.php';
			require_once Config::$plugin_path . 'php/admin/views/settings-checkout.php';
			require_once Config::$plugin_path . 'php/admin/views/settings-authentication.php';
			require_once Config::$plugin_path . 'php/admin/views/settings-misc.php';

		?>
	</div><!-- .as-float-right -->
</div><!-- .as-body -->

<?php

require_once 'footer.php';
