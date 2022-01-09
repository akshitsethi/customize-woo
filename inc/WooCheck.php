<?php
/**
 * Class to check for the presence of WooCommerce plugin.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

/**
 * Check if the WooCommerce plugin is active or not and render the admin
 * message accordingly.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */
class WooCheck {

	/**
	 * Helper function to determine whether a plugin is active.
	 *
	 * @param string $plugin_name plugin file name (plugin-filename.php)
	 * @return boolean
	 */
	public function is_plugin_active( string $plugin_name ) : bool {
		$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$active_plugins = array_merge( $active_plugins, array_keys( get_site_option( 'active_sitewide_plugins', array() ) ) );
		}

		$plugin_filenames = array();

		foreach ( $active_plugins as $plugin ) {
			if ( false !== strpos( $plugin, '/' ) ) {
				list( , $filename ) = explode( '/', $plugin );
			} else {
				$filename = $plugin;
			}

			$plugin_filenames[] = $filename;
		}

		return in_array( $plugin_name, $plugin_filenames );
	}

	/**
	 * Renders a notice when WooCommerce version is outdated.
	 *
	 * @since 1.0.0
	 */
	public function inactive_notice() {
		$message = sprintf(
			/* translators: %1$s - plugin name, %2$s - link to plugins page, %3$s - closing anchor tag, %4$s - plugin version */
			esc_html__( '%1$s won\'t work properly as it requires WooCommerce. Please %2$sactivate%3$s WooCommerce version %4$s or newer.', 'customize-woo' ),
			'<strong>' . Config::get_plugin_name() . '</strong>',
			'<a href="' . self_admin_url( 'plugins.php' ) . '">',
			'</a>',
			Config::MIN_WC_VERSION
		);
		?>

		<div class="error">
			<p><?php echo $message; ?></p>
		</div><!-- .error -->

		<?php
	}

}
