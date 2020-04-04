<?php
/**
 * Frontend class for the plugin.
 *
 * @package AkshitSethi\Plugins\WooCustomizer
 */

namespace AkshitSethi\Plugins\WooCustomizer;

use AkshitSethi\Plugins\WooCustomizer\Config;

/**
 * Frontend for the plugin.
 *
 * @package    AkshitSethi\Plugins\WooCustomizer
 * @since      1.0.0
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
	public function init() {}

}
