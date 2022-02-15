<?php
/**
 * Configuration file for the plugin.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

/**
 * Set configuration options.
 */
class Config {

	/**
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * @var string
	 */
	public static $plugin_path;

	/**
	 * @var array
	 */
	public static $default_options;

	/**
	 * @var string
	 */
	const SLUG = 'customize-woo';

	/**
	 * @var float
	 */
	const VERSION = '@##VERSION##@';

	/**
	 * @var string
	 */
	const DB_OPTION = 'customizewoo_settings';

	/**
	 * @var float
	 */
	const MIN_WC_VERSION = '3.1.0';


	/**
	 * Class constructor.
	 */
	public function __construct() {
		self::$plugin_url  = plugin_dir_url( dirname( __FILE__ ) );
		self::$plugin_path = plugin_dir_path( dirname( __FILE__ ) );
	}


	/**
	 * Get plugin name.
	 *
	 * @return void
	 */
	public static function get_plugin_name() : string {
		return esc_html__( 'Customize Woo', 'customize-woo' );
	}

}
