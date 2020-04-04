<?php
/**
 * Frontend class for the plugin.
 *
 * @package AkshitSethi\Plugins\MaintenanceMode
 */

namespace AkshitSethi\Plugins\MaintenanceMode;

use AkshitSethi\Plugins\MaintenanceMode\Config;

/**
 * Frontend for the plugin.
 *
 * @package    AkshitSethi\Plugins\MaintenanceMode
 * @since      2.0.0
 */
class Front {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}


	/**
	 * Initialize the frontend for the plugin.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Plugin options from the database
		$options = get_option( Config::DB_OPTION );

		// Login URL for the admin
		$login_url = wp_login_url();

		// Checking for the server protocol status
		$protocol = isset( $_SERVER['HTTPS'] ) ? 'https' : 'http';

		// Server address of the current page
		$server_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		// Custom login URL (if provided)
		$options['custom_login_url'] = empty( $options['custom_login_url'] ) ? null : esc_url( $options['custom_login_url'] );

		// Not for the backend
		if ( ! is_admin() ) {
			if ( $options['status'] ) {
				/**
				 * A lot of checks are going on over here.
				 * We are checking for admin role, crawler status, and important WordPress pages to bypass.
				 * If the admin decides to exclude search engine from viewing the plugin, the website will be shown.
				 */
				if ( false === strpos( $server_url, '/wp-login.php' )
					&& false === strpos( $server_url, '/wp-admin/' )
					&& false === strpos( $server_url, '/async-upload.php' )
					&& false === strpos( $server_url, '/upgrade.php' )
					&& false === strpos( $server_url, '/plugins/' )
					&& false === strpos( $server_url, '/xmlrpc.php' )
					&& false === strpos( $server_url, $login_url )
					&& false === strpos( $server_url, $options['custom_login_url'] ) ) {

					// Checking for the search engine option
					if ( $options['exclude_se'] ) {
						if ( $this->check_referrer() ) {
							return;
						}
					}

					// For logged-in users
					if ( $options['show_logged_in'] ) {
						// Checking if the user is logged in or not
						if ( is_user_logged_in() ) {
							return;
						}
					}

					// Render the maintenance mode template
					$this->render_template( $options );
				}
			}
		}
	}


	/**
	 * Checks for the list of crawlers.
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	private function check_referrer() {
		// List of crawlers
		$crawlers = array(
			'Abacho'          => 'AbachoBOT',
			'Accoona'         => 'Acoon',
			'AcoiRobot'       => 'AcoiRobot',
			'Adidxbot'        => 'adidxbot',
			'AltaVista robot' => 'Altavista',
			'Altavista robot' => 'Scooter',
			'ASPSeek'         => 'ASPSeek',
			'Atomz'           => 'Atomz',
			'Bing'            => 'bingbot',
			'BingPreview'     => 'BingPreview',
			'CrocCrawler'     => 'CrocCrawler',
			'Dumbot'          => 'Dumbot',
			'eStyle Bot'      => 'eStyle',
			'FAST-WebCrawler' => 'FAST-WebCrawler',
			'GeonaBot'        => 'GeonaBot',
			'Gigabot'         => 'Gigabot',
			'Google'          => 'Googlebot',
			'ID-Search Bot'   => 'IDBot',
			'Lycos spider'    => 'Lycos',
			'MSN'             => 'msnbot',
			'MSRBOT'          => 'MSRBOT',
			'Rambler'         => 'Rambler',
			'Scrubby robot'   => 'Scrubby',
			'Yahoo'           => 'Yahoo',
		);

		// Checking for the crawler over here
		if ( $this->string_to_array( $_SERVER['HTTP_USER_AGENT'], $crawlers ) ) {
			return true;
		}

		return false;
	}


	/**
	 * Match the user agent with the crawlers array.
	 *
	 * @since 1.0.0
	 * @param string $str User agent
	 * @param array  $crawlers List of crawlers to match against
	 *
	 * @return boolean
	 */
	private function string_to_array( $str, $crawlers ) {
		$regexp = '~(' . implode( '|', array_values( $crawlers ) ) . ')~i';
		return (bool) preg_match( $regexp, $str );
	}


	/**
	 * Renders the frontend template for the plugin.
	 */
	private function render_template( $options ) {
		// Fix for W3 Total Cache plugin
		if ( function_exists( 'wp_cache_clear_cache' ) ) {
			ob_end_clean();
			wp_cache_clear_cache();
		}

		// Fix for WP Super Cache plugin
		if ( function_exists( 'w3tc_pgcache_flush' ) ) {
			ob_end_clean();
			w3tc_pgcache_flush();
		}

		/**
		 * Using the nocache_headers() to ensure that different nocache headers are sent to
		 * different browsers. We don't want any browser to cache the maintainance page.
		 */
		nocache_headers();
		ob_start();

		// Template file
		if ( $options['disable_settings'] ) {
			require_once Config::$plugin_path . 'inc/views/blank.php';
		} else {
			require_once Config::$plugin_path . 'inc/views/html.php';
		}

		ob_flush();
		exit;
	}


	/**
	 * For replacing the blank option with the default one.
	 *
	 * @since 1.0.0
	 * @param string $option The option value to check
	 * @param string $default Default value for the option
	 *
	 * @return string $output
	 */
	private function get_option( $option, $default ) {
		if ( empty( $option ) ) {
			return $default;
		}

		return $option;
	}


	/**
	 * Custom styles for the frontend. Style options are put into inline CSS and then
	 * added to the header.
	 *
	 * @since 1.0.0
	 * @return string $output Custom CSS to be injected to the header
	 */
	private function head_css( $options ) {
		$output = '<style>' . "\r\n";

		// Background cover
		if ( ! empty( $options['bg_cover'] ) ) {
			$output .= 'body{background-image:url("' . esc_url( $options['bg_cover'] ) . '");}' . "\r\n";
		}

		// Background color
		if ( empty( $options['bg_cover'] ) && ! empty( $options['bg_color'] ) ) {
			$output .= 'body{background-color:#' . esc_html( $options['bg_color'] ) . ';}' . "\r\n";
		}

		// Header: font, size, and color
		if ( ! empty( $options['header_font'] ) || ! empty( $options['header_font_size'] ) || ! empty( $options['header_font_color'] ) ) {
			$output .= '.as-header-text{';

			// Header font
			if ( ! empty( $options['header_font'] ) ) {
				$output .= 'font-family:"' . esc_html( $options['header_font'] ) . '", Arial, sans-serif;';
			}

			// Header font size
			if ( ! empty( $options['header_font_size'] ) ) {
				$output .= 'font-size:' . esc_html( $options['header_font_size'] ) . 'px;';
			}

			// Header font color
			if ( ! empty( $options['header_font_color'] ) ) {
				$output .= 'color:#' . esc_html( $options['header_font_color'] ) . ';';
			}

			$output .= '}' . "\r\n";
		}

		// Secondary: font, size, and color
		if ( ! empty( $options['secondary_font'] ) || ! empty( $options['secondary_font_size'] ) || ! empty( $options['secondary_font_color'] ) ) {
			$output .= '.as-secondary-text{';

			// Secondary font
			if ( ! empty( $options['secondary_font'] ) ) {
				$output .= 'font-family:"' . esc_html( $options['secondary_font'] ) . '", Arial, sans-serif;';
			}

			// Secondary font size
			if ( ! empty( $options['secondary_font_size'] ) ) {
				$output .= 'font-size:' . esc_html( $options['secondary_font_size'] ) . 'px;';
			}

			// Secondary font color
			if ( ! empty( $options['secondary_font_color'] ) ) {
				$output .= 'color:#' . esc_html( $options['secondary_font_color'] ) . ';';
			}

			$output .= '}' . "\r\n";
		}

		// Antispam: font, size, and color
		// We apply secondary font family to antispam as well
		if ( ! empty( $options['secondary_font'] ) || ! empty( $options['antispam_font_size'] ) || ! empty( $options['antispam_font_color'] ) ) {
			$output .= '.as-anti-spam{';

			// Secondary font
			if ( ! empty( $options['secondary_font'] ) ) {
				$output .= 'font-family:"' . esc_html( $options['secondary_font'] ) . '", Arial, sans-serif;';
			}

			// Antispam font size
			if ( ! empty( $options['antispam_font_size'] ) ) {
				$output .= 'font-size:' . esc_html( $options['antispam_font_size'] ) . 'px;';
			}

			// Antispam font color
			if ( ! empty( $options['antispam_font_color'] ) ) {
				$output .= 'color:#' . esc_html( $options['antispam_font_color'] ) . ';';
			}

			$output .= '}' . "\r\n";
		}

		// Content: width, position, and alignment
		if ( ! empty( $options['content_overlay'] ) || ( ! empty( $options['content_bg'] ) && ! empty( $options['content_bg_opacity'] ) ) || ! empty( $options['content_border'] ) || ! empty( $options['content_border_width'] ) || ! empty( $options['content_border_radius'] ) || ! empty( $options['content_width'] ) || ! empty( $options['content_position'] ) || ! empty( $options['content_alignment'] ) ) {
			$output .= '.as-content{';

			// Content background
			if ( ! empty( $options['content_bg'] ) ) {
				$output .= 'background-color:#' . esc_html( $options['content_bg'] ) . ';';
			}

			// Content background opacity
			if ( ! empty( $options['content_bg_opacity'] ) ) {
				$output .= 'opacity:' . esc_html( $options['content_bg_opacity'] ) . ';';
			}

			// Content overlay
			if ( $options['content_overlay'] ) {
				$output .= 'padding:30px;';
			}

			// Content border
			if ( ! empty( $options['content_border'] ) ) {
				$output .= 'border:1px solid #' . esc_html( $options['content_border'] ) . ';';
			}

			// Content border width
			if ( ! empty( $options['content_border_width'] ) ) {
				$output .= 'border-width:' . esc_html( $options['content_border_width'] ) . 'px;';
			}

			// Content border radius
			if ( ! empty( $options['content_border_radius'] ) ) {
				$output .= 'border-radius:' . esc_html( $options['content_border_radius'] ) . 'px;';
			}

			// Content width
			if ( ! empty( $options['content_width'] ) ) {
				// Making sure the width is not < 100 and not > 1170
				if ( $options['content_width'] < 100 || $options['content_width'] > 1170 ) {
					$options['content_width'] = '1170';
				}

				$output .= 'max-width:' . esc_html( $options['content_width'] ) . 'px;';
			}

			// Content position
			if ( ! empty( $options['content_position'] ) ) {
				if ( 'center' == $options['content_position'] ) {
					$output .= 'margin-left:auto;margin-right:auto;';
				} elseif ( 'right' == $options['content_position'] ) {
					$output .= 'float:right;';
				} else {
					$output .= 'margin-left:0;margin-right:0;';
				}
			}

			// Content alignment
			if ( ! empty( $options['content_alignment'] ) ) {
				if ( 'right' == $options['content_alignment'] ) {
					$output .= 'text-align:right;';
				} elseif ( 'center' == $options['content_alignment'] ) {
					$output .= 'text-align:center;';
				} else {
					$output .= 'text-align:left;';
				}
			}

			$output .= '}' . "\r\n";

			// Content alignment for the input field
			if ( ! empty( $options['content_alignment'] ) ) {
				$output .= '.as-content input{';
				if ( 'right' == $options['content_alignment'] ) {
					$output .= 'text-align:right;';
				} elseif ( 'center' == $options['content_alignment'] ) {
					$output .= 'text-align:center;';
				} else {
					$output .= 'text-align:left;';
				}
				$output .= '}' . "\r\n";
			}
		}

		// If the default form & button styles need to be ignored
		if ( $options['ignore_form_styles'] ) {
			// Input: size, color, background, border
			if ( ! empty( $options['input_font_size'] ) || ! empty( $options['input_font_color'] ) || ! empty( $options['input_bg'] ) || ! empty( $options['input_border'] ) || ! empty( $options['input_border_width'] ) ) {
				$output .= '.as-content input[type="text"]{';

				// Input font size
				if ( ! empty( $options['input_font_size'] ) ) {
					$output .= 'font-size:' . esc_html( $options['input_font_size'] ) . 'px;';
				}

				// Input color
				if ( ! empty( $options['input_font_color'] ) ) {
					$output .= 'color:#' . esc_html( $options['input_font_color'] ) . ';';
				}

				// Input background
				if ( ! empty( $options['input_bg'] ) ) {
					$output .= 'background:#' . esc_html( $options['input_bg'] ) . ';';
				}

				// Input border
				if ( ! empty( $options['input_border'] ) ) {
					$output .= 'border:1px solid #' . esc_html( $options['input_border'] ) . ';';
				}

				// Input border width
				if ( ! empty( $options['input_border_width'] ) ) {
					$output .= 'border-width:' . esc_html( $options['input_border_width'] ) . 'px;';
				}

				$output .= '}' . "\r\n";
			}

			// Input: background:focus, border:focus
			if ( ! empty( $options['input_bg_hover'] ) || ! empty( $options['input_border_hover'] ) ) {
				$output .= '.as-content input[type="text"]:focus{';

				// Input background:focus
				if ( ! empty( $options['input_bg_hover'] ) ) {
					$output .= 'background:#' . esc_html( $options['input_bg_hover'] ) . ';';
				}

				// Input border:focus
				if ( ! empty( $options['input_border_hover'] ) ) {
					$output .= 'border-color:#' . esc_html( $options['input_border_hover'] ) . ';';
				}

				$output .= '}' . "\r\n";
			}

			// Button: size, color, background, border
			if ( ! empty( $options['button_font_size'] ) || ! empty( $options['button_font_color'] ) || ! empty( $options['button_bg'] ) || ! empty( $options['button_border'] ) || ! empty( $options['button_border_width'] ) ) {
				$output .= '.as-content input[type="submit"]{';

				// Button font size
				if ( ! empty( $options['button_font_size'] ) ) {
					$output .= 'font-size:' . esc_html( $options['button_font_size'] ) . 'px;';
				}

				// Button color
				if ( ! empty( $options['button_font_color'] ) ) {
					$output .= 'color:#' . esc_html( $options['button_font_color'] ) . ';';
				}

				// Button background
				if ( ! empty( $options['button_bg'] ) ) {
					$output .= 'background:#' . esc_html( $options['button_bg'] ) . ';';
				}

				// Button border
				if ( ! empty( $options['button_border'] ) ) {
					$output .= 'border:1px solid #' . esc_html( $options['button_border'] ) . ';';
				}

				// Button border width
				if ( ! empty( $options['button_border_width'] ) ) {
					$output .= 'border-width:' . esc_html( $options['button_border_width'] ) . 'px;';
				}

				$output .= '}' . "\r\n";
			}

			// Button: background:focus, border:focus
			if ( ! empty( $options['button_bg_hover'] ) || ! empty( $options['button_border_hover'] ) ) {
				$output .= '.as-content input[type="submit"]:hover,';
				$output .= '.as-content input[type="submit"]:focus{';

				// Input background:focus
				if ( ! empty( $options['button_bg_hover'] ) ) {
					$output .= 'background:#' . esc_html( $options['button_bg_hover'] ) . ';';
				}

				// Input border:focus
				if ( ! empty( $options['button_border_hover'] ) ) {
					$output .= 'border-color:#' . esc_html( $options['button_border_hover'] ) . ';';
				}

				$output .= '}' . "\r\n";
			}

			// Message: success
			if ( ! empty( $options['success_background'] ) || ! empty( $options['success_color'] ) ) {
				$output .= '.as-alert-success{';

				// Success background
				if ( ! empty( $options['success_background'] ) ) {
					$output .= 'background:#' . esc_html( $options['success_background'] ) . ';';
				}

				// Success color
				if ( ! empty( $options['success_color'] ) ) {
					$output .= 'color:#' . esc_html( $options['success_color'] ) . ';';
				}

				$output .= '}' . "\r\n";
			}

			// Message: error
			if ( ! empty( $options['error_background'] ) || ! empty( $options['error_color'] ) ) {
				$output .= '.as-alert-danger{';

				// Error background
				if ( ! empty( $options['error_background'] ) ) {
					$output .= 'background:#' . esc_html( $options['error_background'] ) . ';';
				}

				// Error color
				if ( ! empty( $options['error_color'] ) ) {
					$output .= 'color:#' . esc_html( $options['error_color'] ) . ';';
				}

				$output .= '}' . "\r\n";
			}
		}

		// Custom CSS
		if ( ! empty( $options['custom_css'] ) ) {
			$output .= stripslashes( strip_tags( $options['custom_css'] ) );
		}

		$output .= '</style>' . "\r\n";

		return $output;
	}

}
