<?php
/**
 * Plugin Name: Woo Customizer
 * Description: Plugin to help customise WooCommerce with the help of actions and filters.
 * Version: 1.0.0
 * Runtime: 5.6+
 * Author: akshitsethi
 * Text Domain: woo-customizer
 * Domain Path: i18n
 * Author URI: https://akshitsethi.com
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace AkshitSethi\Plugins\WooCustomizer;

// Stop execution if the file is called directly
defined( 'ABSPATH' ) || exit;

// Composer autoloder file.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin class where all the action happens.
 *
 * @category    Plugins
 * @package     AkshitSethi\Plugins\WooCustomizer
 * @since       1.0.0
 */
class WooCustomizer {

	/**
	 * Class Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}


	/**
	 * Initialize plugin when all the plugins have been loaded.
	 *
	 * @since 2.0.0
	 */
	public function init() {
		// Initialize front and admin
		new Admin();
		new Front();
	}


	/**
	 * Loads textdomain for the plugin.
	 *
	 * @since 2.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( Config::PLUGIN_SLUG, false, Config::$plugin_path . 'i18n/' );
	}


	/**
	 * Attached to the activation hook.
	 */
	public function activate() {
		// Check for existing options in the database
		$options = get_option( Config::DB_OPTION );

		// Present? Overwrite the default options
		if ( $options ) {
			$options = array_merge( Config::$default_options, $options );
		} else {
			$options = Config::$default_options;
		}

		// Update `wp_options` table
		update_option( Config::DB_OPTION, $options );
	}


	/**
	 * Attached to the de-activation hook.
	 */
	public function deactivate() {
		/**
		 * @todo Nothing to be done here for now.
		 */
	}

}

// Initialize plugin
$woo_customizer = new WooCustomizer();

/**
 * Hooks for plugin activation & deactivation.
 */
register_activation_hook( __FILE__, array( $woo_customizer, 'activate' ) );
register_deactivation_hook( __FILE__, array( $woo_customizer, 'deactivate' ) );
