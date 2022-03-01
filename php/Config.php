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
	 * URL to plugin root folder.
	 *
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * Path to plugin root folder.
	 *
	 * @var string
	 */
	public static $plugin_path;

	/**
	 * Default plugin options.
	 *
	 * @var array
	 */
	public static $default_options;

	/**
	 * Plugin slug.
	 *
	 * @var string
	 */
	const SLUG = 'customize-woo';

	/**
	 * Plugin version.
	 *
	 * @var float
	 */
	const VERSION = '@##VERSION##@';

	/**
	 * DB option name.
	 *
	 * @var string
	 */
	const DB_OPTION = 'customizewoo_settings';

	/**
	 * Minimum required WooCommerce version.
	 *
	 * @var float
	 */
	const MIN_WC_VERSION = '3.1.0';


	/**
	 * Class constructor.
	 */
	public function __construct() {
		self::$plugin_url  = plugin_dir_url( dirname( __FILE__ ) );
		self::$plugin_path = plugin_dir_path( dirname( __FILE__ ) );

		self::$default_options = array(
			// Shop.
			'add_to_cart_text'                         => esc_html__( 'Add to Cart', 'customize-woo' ),
			'variable_add_to_cart_text'                => esc_html__( 'Select Options', 'customize-woo' ),
			'grouped_add_to_cart_text'                 => esc_html__( 'View Options', 'customize-woo' ),
			'out_of_stock_add_to_cart_text'            => esc_html__( 'Out of Stock', 'customize-woo' ),
			'external_add_to_cart_text'                => esc_html__( 'Read More', 'customize-woo' ),
			'loop_sale_flash_text'                     => esc_html__( 'Sale!', 'customize-woo' ),
			'loop_shop_per_page'                       => 12,
			'loop_shop_columns'                        => 12,
			'product_thumbnails_columns'               => 12,

			// Product.
			'product_description_tab_title'            => esc_html__( 'Description', 'customize-woo' ),
			'product_description_heading'              => esc_html__( 'Description', 'customize-woo' ),
			'product_reviews_tab_title'                => esc_html__( 'Reviews', 'customize-woo' ),
			'product_additional_information_tab_title' => esc_html__( 'Additional Information', 'customize-woo' ),
			'product_additional_information_heading'   => esc_html__( 'Additional Information', 'customize-woo' ),
			'single_add_to_cart_text'                  => esc_html__( 'Add to Cart', 'customize-woo' ),
			'single_out_of_stock_text'                 => esc_html__( 'Out of stock', 'customize-woo' ),
			'single_backorder_text'                    => esc_html__( 'Available on backorder', 'customize-woo' ),
			'single_sale_flash_text'                   => esc_html__( 'Sale!', 'customize-woo' ),

			// Cart.
			'no_shipping_available_html'               => esc_html__( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'customize-woo' ),
			'shipping_estimate_html'                   => esc_html__( 'Shipping options will be updated during checkout.', 'customize-woo' ),

			// Checkout.
			'checkout_must_be_logged_in_message'       => esc_html__( 'You must be logged in to checkout.', 'customize-woo' ),
			'checkout_login_message'                   => esc_html__( 'Returning customer?', 'customize-woo' ),
			'create_account_default_checked'           => 'checked',
			'order_button_text'                        => esc_html__( 'Place order', 'customize-woo' ),
			'show_terms'                               => true,
			'order_notes_field'                        => true,

			// Authentication.
			'lost_password_confirmation_message'       => esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'customize-woo' ),
			'lost_password_message'                    => esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'customize-woo' ),
			'reset_password_message'                   => esc_html__( 'Enter a new password below.', 'customize-woo' ),

			// Misc.
			'countries_tax_or_vat'                     => esc_html__( 'Tax for USA, VAT for European countries', 'customize-woo' ),
			'countries_inc_tax_or_vat'                 => esc_html__( 'Inc. tax for USA, Inc. VAT for European countries', 'customize-woo' ),
			'countries_ex_tax_or_vat'                  => esc_html__( 'Exc. tax for USA, Exc. VAT for European countries', 'customize-woo' ),
			'order_received_text'                      => esc_html__( 'Thank you. Your order has been received.', 'customize-woo' ),
		);
	}


	/**
	 * Get plugin name.
	 *
	 * @return string
	 */
	public static function get_plugin_name() : string {
		return esc_html__( 'Customize Woo', 'customize-woo' );
	}

	/**
	 * Plugin options sanitization.
	 *
	 * @param string $option_name Name of the option to be sanitized.
	 * @param string $option_type Type of option.
	 *
	 * @return string|int|bool
	 */
	public static function sanitize_option( string $option_name, string $option_type = 'string' ) {
		if ( isset( $_POST[ 'customizewoo_' . $option_name ] ) ) { // phpcs:ignore
			// Boolean.
			if ( 'bool' === $option_type ) {
				return true;
			}

			if ( 'int' === $option_type ) {
				return absint( $_POST[ 'customizewoo_' . $option_name ] ); // phpcs:ignore
			}

			return sanitize_text_field( wp_unslash( $_POST[ 'customizewoo_' . $option_name ] ) ); // phpcs:ignore
		}

		// Return false for boolean values.
		if ( 'bool' === $option_type ) {
			return false;
		}

		if ( isset( self::$default_options[ $option_name ] ) ) {
			return self::$default_options[ $option_name ];
		}

		return ( 'int' === $option_type ) ? 0 : '';
	}

}
