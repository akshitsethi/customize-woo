<?php
/**
 * File which gets called on plugin uninstall. Since the plugin does not do any
 * sort of setup, nothing is done over here.
 *
 * @since   1.0.0
 * @package AkshitSethi/Plugins/MaintenanceMode
 */

namespace AkshitSethi\Plugins\MaintenanceMode;

// Prevent unauthorized access
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Composer autoloder file.
require_once __DIR__ . '/vendor/autoload.php';

// Remove options and transients
delete_option( Config::DB_OPTION );
delete_transient( Config::PREFIX . 'email_lists' );
