<?php
/**
 * Setup for unit tests.
 *
 * @package AkshitSethi\Plugins\CustomizeWoo
 */

$root_dir = dirname( dirname( __FILE__ ) );

require_once "{$root_dir}/vendor/autoload.php";
require_once "{$root_dir}/vendor/antecedent/patchwork/Patchwork.php";

WP_Mock::setUsePatchwork( true );
WP_Mock::bootstrap();
