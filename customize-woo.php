<?php
/**
 * Plugin Name: Customize Woo
 * Description: Plugin to help customise WooCommerce with the help of actions and filters.
 * Version: @##VERSION##@
 * Runtime: 7.3+
 * Author: akshitsethi
 * Text Domain: customize-woo
 * Domain Path: i18n
 * Author URI: https://akshitsethi.com
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

// Stop execution if the file is called directly.
defined( 'ABSPATH' ) || exit;

// Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin class where all the action happens.
 *
 * @category    Plugins
 * @package     AkshitSethi\Plugins\CustomizeWoo
 */
class CustomizeWoo {

	/**
	 * Class Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Initialize plugin when all the plugins have been loaded.
	 *
	 * @return void
	 */
	public function init() : void {
		if ( ! $this->check_woocommerce() ) {
			return;
		}

		new Config();
		new Admin();
		new Front();

		load_plugin_textdomain( Config::SLUG, false, Config::$plugin_path . 'i18n/' );
	}

	/**
	 * Checks whether WooCommerce plugin is active or not.
	 *
	 * @return bool
	 */
	public function check_woocommerce() : bool {
		$woo_check = new WooCheck();

		if ( false === $woo_check->is_plugin_active( 'woocommerce.php' ) ) {
			add_action( 'admin_notices', array( $woo_check, 'inactive_notice' ) );

			return false;
		}

		return true;
	}

	/**
	 * Attached to the activation hook.
	 *
	 * @return void
	 */
	public function activate() : void {
		$options = get_option( Config::DB_OPTION );

		if ( $options ) {
			Config::$default_options = array_merge( Config::$default_options, $options );
		}

		update_option( Config::DB_OPTION, Config::$default_options );
	}

}

// Initialize plugin.
$customize_woo = new CustomizeWoo();

/**
 * To be run on plugin activation.
 */
register_activation_hook( __FILE__, array( $customize_woo, 'activate' ) );
