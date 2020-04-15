<?php
/**
 * Configuration file for the plugin.
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

/**
 * Set configuration options.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */
class Config {

	public static $plugin_url;
	public static $plugin_path;
	public static $default_options;

	const PLUGIN_SLUG    = 'customize-woo';
	const SHORT_SLUG     = 'customizewoo';
	const VERSION        = '1.0.4';
	const DB_OPTION      = 'as_' . self::SHORT_SLUG;
	const PREFIX         = self::SHORT_SLUG . '_';
	const MIN_WC_VERSION = '3.1.0';


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
		return esc_html__( 'Customize Woo', 'customize-woo' );
	}


	/**
	 * Add default options.
	 *
	 * @since 1.0.0
	 */
	public function default_options() {
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

			// Misc
			'woocommerce_countries_tax_or_vat'           => esc_html__( 'Tax for USA, VAT for European countries', 'customize-woo' ),
			'woocommerce_countries_inc_tax_or_vat'       => esc_html__( 'Inc. tax for USA, Inc. VAT for European countries', 'customize-woo' ),
			'woocommerce_countries_ex_tax_or_vat'        => esc_html__( 'Exc. tax for USA, Exc. VAT for European countries', 'customize-woo' ),
		);
	}

}

new Config();
