<?php
/**
 * Configuration file for the plugin.
 */

namespace AkshitSethi\Plugins\WooCustomizer;

/**
 * Set configuration options.
 *
 * @package AkshitSethi\Plugins\WooCustomizer
 */
class Config {

	public static $plugin_url;
	public static $plugin_path;
	public static $default_options;

	const PLUGIN_SLUG   = 'woo-customizer';
	const SHORT_SLUG    = 'woocustomizer';
	const VERSION       = '1.0.0';
	const DB_OPTION     = 'as_' . self::SHORT_SLUG;
	const PREFIX        = self::SHORT_SLUG . '_';


	/**
	 * Class constructor.
	 */
	public function __construct() {
		self::$plugin_url  = plugin_dir_url( dirname( __FILE__ ) );
		self::$plugin_path = plugin_dir_path( dirname( __FILE__ ) );

		// Default options
		$this->default_options();
	}


	/**
	 * Get plugin name.
	 *
	 * @since 1.0.0
	 */
	public static function get_plugin_name() {
		return esc_html__( 'Woo Customizer', 'woo-customizer' );
	}


	/**
	 * Add default options.
	 *
	 * @since 1.0.0
	 */
	public function default_options() {
		self::$default_options = array();
	}

}

new Config();
