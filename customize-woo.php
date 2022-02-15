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
	 * @var array
	 */
	protected static $default_options = array();

	/**
	 * Class Constructor.
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );

		self::$default_options = array(
			// Shop
			'add_to_cart_text'                           => esc_html__( 'Add to Cart', 'customize-woo' ),
			'variable_add_to_cart_text'                  => esc_html__( 'Select Options', 'customize-woo' ),
			'grouped_add_to_cart_text'                   => esc_html__( 'View Options', 'customize-woo' ),
			'out_of_stock_add_to_cart_text'              => esc_html__( 'Out of Stock', 'customize-woo' ),
			'external_add_to_cart_text'                  => esc_html__( 'Read More', 'customize-woo' ),
			'loop_sale_flash_text'                       => esc_html__( 'Sale!', 'customize-woo' ),
			'loop_shop_per_page'                         => 12,
			'loop_shop_columns'                          => 12,
			'woocommerce_product_thumbnails_columns'     => 12,

			// Product
			'woocommerce_product_description_tab_title'  => esc_html__( 'Description', 'customize-woo' ),
			'woocommerce_product_description_heading'    => esc_html__( 'Description', 'customize-woo' ),
			'woocommerce_product_reviews_tab_title'      => esc_html__( 'Reviews', 'customize-woo' ),
			'woocommerce_product_additional_information_tab_title' => esc_html__( 'Additional Information', 'customize-woo' ),
			'woocommerce_product_additional_information_heading' => esc_html__( 'Additional Information', 'customize-woo' ),
			'single_add_to_cart_text'                    => esc_html__( 'Add to Cart', 'customize-woo' ),
			'single_out_of_stock_text'                   => esc_html__( 'Out of stock', 'customize-woo' ),
			'single_backorder_text'                      => esc_html__( 'Available on backorder', 'customize-woo' ),
			'single_sale_flash_text'                     => esc_html__( 'Sale!', 'customize-woo' ),

			// Cart
			'woocommerce_no_shipping_available_html'     => esc_html__( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'customize-woo' ),
			'woocommerce_shipping_estimate_html'         => esc_html__( 'Shipping options will be updated during checkout.', 'customize-woo' ),

			// Checkout
			'woocommerce_checkout_must_be_logged_in_message' => esc_html__( 'You must be logged in to checkout.', 'customize-woo' ),
			'woocommerce_checkout_login_message'         => esc_html__( 'Returning customer?', 'customize-woo' ),
			'woocommerce_create_account_default_checked' => 'checked',
			'woocommerce_order_button_text'              => esc_html__( 'Place order', 'customize-woo' ),
			'woocommerce_checkout_show_terms'            => true,
			'woocommerce_enable_order_notes_field'       => true,

			// Authentication
			'woocommerce_lost_password_confirmation_message' => esc_html( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'customize-woo' ),
			'woocommerce_lost_password_message'          => esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'customize-woo' ),
			'woocommerce_reset_password_message'         => esc_html__( 'Enter a new password below.', 'customize-woo' ),

			// Misc
			'woocommerce_countries_tax_or_vat'           => esc_html__( 'Tax for USA, VAT for European countries', 'customize-woo' ),
			'woocommerce_countries_inc_tax_or_vat'       => esc_html__( 'Inc. tax for USA, Inc. VAT for European countries', 'customize-woo' ),
			'woocommerce_countries_ex_tax_or_vat'        => esc_html__( 'Exc. tax for USA, Exc. VAT for European countries', 'customize-woo' ),
			'woocommerce_thankyou_order_received_text'   => esc_html__( 'Thank you. Your order has been received.', 'customize-woo' ),
		);
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
			self::$default_options = array_merge( self::$default_options, $options );
		}

		update_option( Config::DB_OPTION, self::$default_options );
	}

}

// Initialize plugin.
$customize_woo = new CustomizeWoo();

/**
 * To be run on plugin activation.
 */
register_activation_hook( __FILE__, array( $customize_woo, 'activate' ) );
