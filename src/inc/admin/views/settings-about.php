<?php
/**
 * View: About
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

?>

<div class="as-tile" id="about">
	<div class="as-tile-body">
		<h2 class="as-tile-title"><?php esc_html_e( 'ABOUT', 'woo-customizer' ); ?></h2>
			<p><?php esc_html_e( 'Hola! I\'m Akshit Sethi, Designer + Developer by profession & Entrepreneur by passion. In love with WWW and Spanish. Travel is life. When I am not coding, I am reading anything worth reading. I create premium WordPress themes & plugins.', 'woo-customizer' ); ?></p>

			<div class="as-share">
				<p><?php esc_html_e( 'Show me some love and connect with me via social channels.', 'woo-customizer' ); ?></p>
				<a href="https://twitter.com/akshitsethi" target="_blank">
					<img src="<?php echo Config::$plugin_url; ?>assets/admin/images/twitter.png" alt="<?php esc_attr_e( 'Twitter', 'woo-customizer' ); ?>" />
				</a>&nbsp;

				<a href="https://www.facebook.com/akshitsethi" target="_blank">
					<img src="<?php echo Config::$plugin_url; ?>assets/admin/images/facebook.png" alt="<?php esc_attr_e( 'Facebook', 'woo-customizer' ); ?>" />
				</a>
			</div><!-- .as-share -->
		</div><!-- .as-section-content -->
	</div><!-- .as-tile-body -->
</div><!-- #about -->
