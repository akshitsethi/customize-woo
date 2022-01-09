<?php
/**
 * File which gets called on plugin uninstall. Since the plugin does not do any
 * sort of setup, nothing is done over here.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

namespace AkshitSethi\Plugins\CustomizeWoo;

// Prevent unauthorized access.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Composer autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Remove plugin settings.
delete_option( Config::DB_OPTION );
