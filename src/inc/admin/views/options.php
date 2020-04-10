<?php
/**
 * Options for the admin panel
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\WooCustomizer\Config;

print_r( Config::$plugin_path );

?>
<div class="as-options-wrapper">
	<form method="post" class="as-options-form" id="<?php echo Config::PREFIX . 'form'; ?>">
  <?php

	// Include required files for the tab options
	require_once 'settings-shop.php';

	?>
  </form><!-- .as-options-form -->
</div><!-- .as-options-wrapper -->
