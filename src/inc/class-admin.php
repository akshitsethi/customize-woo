<?php
/**
 * Admin class for the plugin.
 *
 * @package AkshitSethi\Plugins\WooCustomizer
 */

namespace AkshitSethi\Plugins\WooCustomizer;

use AkshitSethi\Plugins\WooCustomizer\Config;

/**
 * Admin options for the plugin.
 *
 * @package    AkshitSethi\Plugins\WooCustomizer
 * @since      2.0.0
 */
class Admin {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'support', array( $this, 'support_ticket' ) );
		add_action( 'wp_ajax_' . Config::PREFIX . 'options', array( $this, 'save_options' ) );

		add_filter( 'plugin_row_meta', array( $this, 'meta_links' ), 10, 2 );
	}


	/**
	 * Adds menu for the plugin.
	 */
	public function add_menu() {
		if ( is_admin() && current_user_can( 'manage_options' ) ) {
			$menu = add_options_page(
				esc_html__( 'Woo Customizer', 'woo-customizer' ),
				esc_html__( 'Woo Customizer', 'woo-customizer' ),
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
			'prefix'        => Config::PREFIX,
			'save_text'     => esc_html__( 'Save Changes', 'woo-customizer' ),
			'support_text'  => esc_html__( 'Ask for Support', 'woo-customizer' ),
			'nonce'         => wp_create_nonce( Config::PREFIX . 'nonce' ),
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
		if ( strpos( $file, 'woo-customizer.php' ) !== false ) {
			$new_links = array(
				'<a href="https://www.facebook.com/akshitsethi" target="_blank">' . esc_html__( 'Facebook', 'woo-customizer' ) . '</a>',
				'<a href="https://twitter.com/akshitsethi" target="_blank">' . esc_html__( 'Twitter', 'woo-customizer' ) . '</a>',
			);

			$links = array_merge( $links, $new_links );
		}

		return $links;
	}


	/**
	 * Processes plugin options via an AJAX call.
	 */
	public function save_options() {
		// Default response
		$response = array(
			'code'     => 'success',
			'response' => esc_html__( 'Options have been updated successfully.', 'woo-customizer' ),
		);

		// Check for _nonce
		if ( empty( $_POST['_nonce'] ) || ! wp_verify_nonce( $_POST['_nonce'], Config::PREFIX . 'nonce' ) ) {
			$response['code']     = 'error';
			$response['response'] = esc_html__( 'Request does not seem to be a valid one. Try again by refreshing the page.', 'woo-customizer' );
		}

		// Filter and sanitize options
		$options = array(
			
		);

		// Update options
		update_option( Config::DB_OPTION, $options );

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
			'response' => esc_html__( 'Please fill in both the fields to create your support ticket.',  ),
		);

		// Filter and sanitize
		if ( ! empty( $_POST[ Config::PREFIX . 'support_email' ] ) && ! empty( $_POST[ Config::PREFIX . 'support_issue' ] ) ) {
			$admin_email = sanitize_text_field( $_POST[ Config::PREFIX . 'support_email' ] );
			$issue       = htmlentities( $_POST[ Config::PREFIX . 'support_issue' ] );
			$subject     = '[' . Config::get_plugin_name() . 'v' . Config::VERSION . '] by ' . $admin_email;
			$body        = "Email: $admin_email \r\nIssue: $issue";
			$headers     = 'From: ' . $admin_email . "\r\n" . 'Reply-To: ' . $admin_email;

			// Send email
			if ( wp_mail( '19bbdec26d2d11ea94e7033192a1a3c3@tickets.tawk.to', $subject, $body, $headers ) ) {
				// Success
				$response = array(
					'code'     => 'success',
					'response' => esc_html__( 'I have received your support ticket and will get back to you shortly!',  ),
				);
			} else {
				// Failure
				$response = array(
					'code'     => 'error',
					'response' => esc_html__( 'There was an error creating the support ticket. You can try again later or send me an email directly at akshitsethi@gmail.com',  ),
				);
			}
		}

		// Headers for JSON format
		header( 'Content-Type: application/json' );
		echo json_encode( $response );

		// Exit
		// For AJAX functions
		exit();
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
