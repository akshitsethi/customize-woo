<?php
/**
 * Admin class for the plugin.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

use AkshitSethi\Plugins\CustomizeWoo\Config;

/**
 * Admin options for the plugin.
 *
 * @package    AkshitSethi\Plugins\CustomizeWoo
 * @since      2.0.0
 */
class Admin {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu' ), PHP_INT_MAX );
		add_action( 'wp_ajax_customizewoo_support', array( $this, 'support_ticket' ) );
		add_action( 'wp_ajax_customizewoo_shop', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_customizewoo_product', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_customizewoo_cart', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_customizewoo_checkout', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_customizewoo_authentication', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_customizewoo_misc', array( $this, 'save_options' ) );

		add_filter( 'plugin_row_meta', array( $this, 'meta_links' ), 10, 2 );
	}

	/**
	 * Adds menu for the plugin.
	 */
	public function add_menu() {
		if ( ! is_admin() ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$menu = add_submenu_page(
			'woocommerce',
			esc_html__( 'Customizer', 'customize-woo' ),
			esc_html__( 'Customizer', 'customize-woo' ),
			'manage_options',
			'customizewoo_options',
			array( $this, 'settings' )
		);

		// Load JS conditionally.
		add_action( 'load-' . $menu, array( $this, 'load_scripts' ) );
	}

	/**
	 * Scripts for the plugin options page.
	 */
	public function admin_scripts() {
		wp_enqueue_style( Config::SLUG . '-admin', Config::$plugin_url . 'assets/admin/css/admin.css', false, Config::VERSION );

		// Localize and enqueue script
		wp_enqueue_script( Config::SLUG . '-admin', Config::$plugin_url . 'assets/admin/js/admin.js', array( 'jquery' ), Config::VERSION, true );

		$localize = array(
			'prefix'       => 'customizewoo_',
			'save_text'    => esc_html__( 'Save Changes', 'customize-woo' ),
			'support_text' => esc_html__( 'Ask for Support', 'customize-woo' ),
			'save_changes' => esc_html__( 'Please save your changes first.', 'customize-woo' ),
			'processing'   => esc_html__( 'Processing..', 'customize-woo' ),
			'nonce'        => wp_create_nonce( 'customizewoo_nonce' ),
		);
		wp_localize_script( Config::SLUG . '-admin', 'customizewoo_admin_l10n', $localize );
	}

	/**
	 * Adds action to load scripts via the scripts hook for admin.
	 */
	public function load_scripts() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Adds custom links to the meta on the plugins page.
	 *
	 * @param array  $links Array of links for the plugins
	 * @param string $file  Name of the main plugin file
	 *
	 * @return array
	 */
	public function meta_links( $links, $file ) {
		if ( false === strpos( $file, 'customize-woo.php' ) ) {
			return;
		}

		$new_links = array(
			'<a href="https://www.facebook.com/akshitsethi" target="_blank">' . esc_html__( 'Facebook', 'customize-woo' ) . '</a>',
			'<a href="https://twitter.com/akshitsethi" target="_blank">' . esc_html__( 'Twitter', 'customize-woo' ) . '</a>',
		);

		return array_merge( $links, $new_links );
	}


	/**
	 * Processes plugin options via an AJAX call.
	 */
	public function save_options() {
		// Check & verify nonce
		if ( empty( $_POST['_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_nonce'], 'customizewoo_nonce' ) ) {
			return;
		}

		// Check for action to determine the options to be updated
		$section = str_replace( 'customizewoo_', '', sanitize_text_field( $_POST['action'] ) );

		// Ensure $section is not empty
		if ( empty( $section ) ) {
			return;
		}

		if ( ! in_array( $section, array( 'shop', 'product', 'cart', 'checkout', 'authentication', 'misc' ) ) ) {
			return;
		}

		// Default response
		$response = array(
			'code'     => 'error',
			'response' => esc_html__( 'There was an error processing the request. Please try again later.', 'customize-woo' ),
		);

		// Current options
		$options = get_option( Config::DB_OPTION );

		// If the options do not exist
		if ( ! $options ) {
			$options = array();
		}

		// Filter & sanitize options
		if ( 'shop' === $section ) {
			$section_options = array(
				'add_to_cart_text'                       => sanitize_text_field( $_POST['customizewoo_add_to_cart_text'] ),
				'variable_add_to_cart_text'              => sanitize_text_field( $_POST['customizewoo_variable_add_to_cart_text'] ),
				'grouped_add_to_cart_text'               => sanitize_text_field( $_POST['customizewoo_grouped_add_to_cart_text'] ),
				'out_of_stock_add_to_cart_text'          => sanitize_text_field( $_POST['customizewoo_out_of_stock_add_to_cart_text'] ),
				'external_add_to_cart_text'              => sanitize_text_field( $_POST['customizewoo_external_add_to_cart_text'] ),
				'loop_sale_flash_text'                   => sanitize_text_field( $_POST['customizewoo_loop_sale_flash_text'] ),
				'loop_shop_per_page'                     => absint( $_POST['customizewoo_loop_shop_per_page'] ),
				'loop_shop_columns'                      => absint( $_POST['customizewoo_loop_shop_columns'] ),
				'woocommerce_product_thumbnails_columns' => absint( $_POST['customizewoo_product_thumbnails_columns'] ),
			);
		}

		if ( 'product' === $section ) {
			$section_options = array(
				'woocommerce_product_description_tab_title' => sanitize_text_field( $_POST['customizewoo_description_tab_title'] ),
				'woocommerce_product_description_heading' => sanitize_text_field( $_POST['customizewoo_description_heading'] ),
				'woocommerce_product_reviews_tab_title'   => sanitize_text_field( $_POST['customizewoo_reviews_tab_title'] ),
				'woocommerce_product_additional_information_tab_title' => sanitize_text_field( $_POST['customizewoo_additional_information_tab_title'] ),
				'woocommerce_product_additional_information_heading' => sanitize_text_field( $_POST['customizewoo_additional_information_heading'] ),
				'single_add_to_cart_text'                 => sanitize_text_field( $_POST['customizewoo_single_add_to_cart_text'] ),
				'single_out_of_stock_text'                => sanitize_text_field( $_POST['customizewoo_single_out_of_stock_text'] ),
				'single_backorder_text'                   => sanitize_text_field( $_POST['customizewoo_single_backorder_text'] ),
				'single_sale_flash_text'                  => sanitize_text_field( $_POST['customizewoo_single_sale_flash_text'] ),
			);
		}

		if ( 'cart' === $section ) {
			$section_options = array(
				'woocommerce_no_shipping_available_html' => sanitize_text_field( $_POST['customizewoo_no_shipping_available_html'] ),
				'woocommerce_shipping_estimate_html'     => sanitize_text_field( $_POST['customizewoo_shipping_estimate_html'] ),
			);
		}

		if ( 'checkout' === $section ) {
			$section_options = array(
				'woocommerce_checkout_must_be_logged_in_message' => sanitize_text_field( $_POST['customizewoo_must_be_logged_in_message'] ),
				'woocommerce_checkout_login_message'   => sanitize_text_field( $_POST['customizewoo_login_message'] ),
				'woocommerce_create_account_default_checked' => sanitize_text_field( $_POST['customizewoo_create_account_default_checked'] ),
				'woocommerce_order_button_text'        => sanitize_text_field( $_POST['customizewoo_order_button_text'] ),
				'woocommerce_checkout_show_terms'      => isset( $_POST['customizewoo_show_terms'] ) ? true : false,
				'woocommerce_enable_order_notes_field' => isset( $_POST['customizewoo_order_notes_field'] ) ? true : false,
			);
		}

		if ( 'authentication' === $section ) {
			$section_options = array(
				'woocommerce_lost_password_confirmation_message' => sanitize_text_field( $_POST['customizewoo_lost_password_confirmation_message'] ),
				'woocommerce_lost_password_message'  => sanitize_text_field( $_POST['customizewoo_lost_password_message'] ),
				'woocommerce_reset_password_message' => sanitize_text_field( $_POST['customizewoo_reset_password_message'] ),
			);
		}

		if ( 'misc' === $section ) {
			$section_options = array(
				'woocommerce_countries_tax_or_vat'         => sanitize_text_field( $_POST['customizewoo_countries_tax_or_vat'] ),
				'woocommerce_countries_inc_tax_or_vat'     => sanitize_text_field( $_POST['customizewoo_countries_inc_tax_or_vat'] ),
				'woocommerce_countries_ex_tax_or_vat'      => sanitize_text_field( $_POST['customizewoo_countries_ex_tax_or_vat'] ),
				'woocommerce_thankyou_order_received_text' => sanitize_text_field( $_POST['customizewoo_order_received_text'] ),
			);
		}

		// Merge the arrays
		$options = array_merge( $options, $section_options );

		// Update options
		update_option( Config::DB_OPTION, $options );

		// Success
		$response['code']     = 'success';
		$response['response'] = esc_html__( 'Options have been updated successfully.', 'customize-woo' );

		// Headers for JSON format
		header( 'Content-Type: application/json' );
		echo json_encode( $response );

		// Exit for AJAX functions
		exit;
	}

	/**
	 * Displays settings page for the plugin.
	 */
	public function settings() {
		// Plugin options
		$options = get_option( Config::DB_OPTION );

		// Settings page
		require_once Config::$plugin_path . 'php/admin/views/settings.php';
	}

}
