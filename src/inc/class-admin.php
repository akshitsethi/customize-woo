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
		add_action( 'wp_ajax_' . Config::PREFIX . 'support', array( $this, 'support_ticket' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'shop', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'product', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'checkout', array( $this, 'save_options' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'misc', array( $this, 'save_options' ) );

		add_filter( 'plugin_row_meta', array( $this, 'meta_links' ), 10, 2 );
	}


	/**
	 * Adds menu for the plugin.
	 */
	public function add_menu() {
		if ( is_admin() && current_user_can( 'manage_options' ) ) {
			$menu = add_submenu_page(
				'woocommerce',
				esc_html__( 'Customizer', 'customize-woo' ),
				esc_html__( 'Customizer', 'customize-woo' ),
				'manage_options',
				Config::PREFIX . 'options',
				array( $this, 'settings' )
			);

			// Loading JS conditionally.
			add_action( 'load-' . $menu, array( $this, 'load_scripts' ) );
		}
	}


	/**
	 * Scripts for the plugin options page.
	 */
	public function admin_scripts() {
		wp_enqueue_style( Config::SHORT_SLUG . '-admin', Config::$plugin_url . 'assets/admin/css/admin.css', false, Config::VERSION );

		// Localize and enqueue script
		wp_enqueue_script( Config::SHORT_SLUG . '-admin', Config::$plugin_url . 'assets/admin/js/admin.js', array( 'jquery' ), Config::VERSION, true );

		$localize = array(
			'prefix'       => Config::PREFIX,
			'save_text'    => esc_html__( 'Save Changes', 'customize-woo' ),
			'support_text' => esc_html__( 'Ask for Support', 'customize-woo' ),
			'save_changes' => esc_html__( 'Please save your changes first.', 'customize-woo' ),
			'processing'   => esc_html__( 'Processing..', 'customize-woo' ),
			'nonce'        => wp_create_nonce( Config::PREFIX . 'nonce' ),
		);
		wp_localize_script( Config::SHORT_SLUG . '-admin', Config::PREFIX . 'admin_l10n', $localize );
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
		if ( strpos( $file, 'customize-woo.php' ) !== false ) {
			$new_links = array(
				'<a href="https://www.facebook.com/akshitsethi" target="_blank">' . esc_html__( 'Facebook', 'customize-woo' ) . '</a>',
				'<a href="https://twitter.com/akshitsethi" target="_blank">' . esc_html__( 'Twitter', 'customize-woo' ) . '</a>',
			);

			$links = array_merge( $links, $new_links );
		}

		return $links;
	}


	/**
	 * Processes plugin options via an AJAX call.
	 */
	public function save_options() {
		// Current options
		$options = get_option( Config::DB_OPTION );

		// If the options do not exist
		if ( ! $options ) {
			$options = array();
		}

		// Default response
		$response = array(
			'code'     => 'error',
			'response' => esc_html__( 'There was an error processing the request. Please try again later.', 'customize-woo' ),
		);

		// Check for _nonce
		if ( empty( $_POST['_nonce'] ) || ! wp_verify_nonce( $_POST['_nonce'], Config::PREFIX . 'nonce' ) ) {
			$response['response'] = esc_html__( 'Request does not seem to be a valid one. Please try again by refreshing the page.', 'customize-woo' );
		} else {
			// Check for action to determine the options to be updated
			$section = str_replace( Config::PREFIX, '', sanitize_text_field( $_POST['action'] ) );

			// Ensure $section is not empty
			if ( ! empty( $section ) ) {
				if ( in_array( $section, array( 'shop', 'product', 'checkout', 'misc' ) ) ) {
					// Filter and sanitize options
					if ( 'shop' === $section ) {
						$section_options = array(
							'add_to_cart_text'          => sanitize_text_field( $_POST[ Config::PREFIX . 'add_to_cart_text' ] ),
							'variable_add_to_cart_text' => sanitize_text_field( $_POST[ Config::PREFIX . 'variable_add_to_cart_text' ] ),
							'grouped_add_to_cart_text'  => sanitize_text_field( $_POST[ Config::PREFIX . 'grouped_add_to_cart_text' ] ),
							'out_of_stock_add_to_cart_text' => sanitize_text_field( $_POST[ Config::PREFIX . 'out_of_stock_add_to_cart_text' ] ),
							'external_add_to_cart_text' => sanitize_text_field( $_POST[ Config::PREFIX . 'external_add_to_cart_text' ] ),
							'loop_sale_flash_text'      => sanitize_text_field( $_POST[ Config::PREFIX . 'loop_sale_flash_text' ] ),
							'loop_shop_per_page'        => absint( $_POST[ Config::PREFIX . 'loop_shop_per_page' ] ),
							'loop_shop_columns'         => absint( $_POST[ Config::PREFIX . 'loop_shop_columns' ] ),
							'woocommerce_product_thumbnails_columns' => absint( $_POST[ Config::PREFIX . 'product_thumbnails_columns' ] ),
						);
					} elseif ( 'product' === $section ) {
						$section_options = array(
							'woocommerce_product_description_tab_title' => sanitize_text_field( $_POST[ Config::PREFIX . 'description_tab_title' ] ),
							'woocommerce_product_description_heading' => sanitize_text_field( $_POST[ Config::PREFIX . 'description_heading' ] ),
							'woocommerce_product_reviews_tab_title' => sanitize_text_field( $_POST[ Config::PREFIX . 'reviews_tab_title' ] ),
							'woocommerce_product_additional_information_tab_title' => sanitize_text_field( $_POST[ Config::PREFIX . 'additional_information_tab_title' ] ),
							'woocommerce_product_additional_information_heading' => sanitize_text_field( $_POST[ Config::PREFIX . 'additional_information_heading' ] ),
							'single_add_to_cart_text'  => sanitize_text_field( $_POST[ Config::PREFIX . 'single_add_to_cart_text' ] ),
							'single_out_of_stock_text' => sanitize_text_field( $_POST[ Config::PREFIX . 'single_out_of_stock_text' ] ),
							'single_backorder_text'    => sanitize_text_field( $_POST[ Config::PREFIX . 'single_backorder_text' ] ),
							'single_sale_flash_text'   => sanitize_text_field( $_POST[ Config::PREFIX . 'single_sale_flash_text' ] ),
						);
					} elseif ( 'checkout' === $section ) {
						$section_options = array(
							'woocommerce_must_be_logged_in_message' => sanitize_text_field( $_POST[ Config::PREFIX . 'must_be_logged_in_message' ] ),
							'woocommerce_coupon_message' => sanitize_text_field( $_POST[ Config::PREFIX . 'coupon_message' ] ),
							'woocommerce_login_message'  => sanitize_text_field( $_POST[ Config::PREFIX . 'login_message' ] ),
							'woocommerce_create_account_default_checked' => sanitize_text_field( $_POST[ Config::PREFIX . 'create_account_default_checked' ] ),
							'woocommerce_order_button_text' => sanitize_text_field( $_POST[ Config::PREFIX . 'order_button_text' ] ),
						);
					} elseif ( 'misc' === $section ) {
						$section_options = array(
							'woocommerce_countries_tax_or_vat'     => sanitize_text_field( $_POST[ Config::PREFIX . 'countries_tax_or_vat' ] ),
							'woocommerce_countries_inc_tax_or_vat' => sanitize_text_field( $_POST[ Config::PREFIX . 'countries_inc_tax_or_vat' ] ),
							'woocommerce_countries_ex_tax_or_vat'  => sanitize_text_field( $_POST[ Config::PREFIX . 'countries_ex_tax_or_vat' ] ),
						);
					}

					// Merge the arrays
					$options = array_merge( $options, $section_options );

					// Update options
					update_option( Config::DB_OPTION, $options );

					// Success
					$response['code']     = 'success';
					$response['response'] = esc_html__( 'Options have been updated successfully.', 'customize-woo' );
				}
			}
		}

		// Headers for JSON format
		header( 'Content-Type: application/json' );
		echo json_encode( $response );

		// Exit for AJAX functions
		exit;
	}


	/**
	 * Creates support ticket via the options panel.
	 */
	public function support_ticket() {
		// Storing response in an array
		$response = array(
			'code'     => 'error',
			'response' => esc_html__( 'Please fill in both the fields to create your support ticket.', 'customize-woo' ),
		);

		// Filter and sanitize
		if ( ! empty( $_POST[ Config::PREFIX . 'support_email' ] ) && ! empty( $_POST[ Config::PREFIX . 'support_issue' ] ) ) {
			$admin_email = sanitize_text_field( $_POST[ Config::PREFIX . 'support_email' ] );
			$issue       = htmlentities( $_POST[ Config::PREFIX . 'support_issue' ] );
			$subject     = '[' . Config::get_plugin_name() . ' v' . Config::VERSION . '] by ' . $admin_email;
			$body        = "Email: $admin_email \r\nIssue: $issue";
			$headers     = 'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email;

			// Send email
			if ( wp_mail( '19bbdec26d2d11ea94e7033192a1a3c3@tickets.tawk.to', $subject, $body, $headers ) ) {
				// Success
				$response = array(
					'code'     => 'success',
					'response' => esc_html__( 'I have received your support ticket and will get back to you shortly!', 'customize-woo' ),
				);
			} else {
				// Failure
				$response = array(
					'code'     => 'error',
					'response' => esc_html__( 'There was an error creating the support ticket. You can try again later or send me an email directly at akshitsethi@gmail.com', 'customize-woo' ),
				);
			}
		}

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

		// Admin email
		$admin_email = sanitize_email( get_option( 'admin_email', '' ) );

		// Settings page
		require_once Config::$plugin_path . 'inc/admin/views/settings.php';
	}

}
