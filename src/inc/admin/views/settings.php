<?php
/**
 * Settings panel view for the plugin.
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;
require_once 'header.php';

?>

<div class="as-body as-clearfix">
	<div class="as-float-left">
		<div class="as-mobile-menu">
			<a href="javascript:void;">
				<img src="<?php echo Config::$plugin_url; ?>assets/admin/images/toggle.png" alt="<?php esc_attr_e( 'Menu', 'classic-coming-soon-maintenance-mode' ); ?>" />
			</a>
		</div><!-- .as-mobile-menu -->

		<ul class="as-main-menu">
			<li><a href="#basic"><?php esc_html_e( 'Basic', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#email"><?php esc_html_e( 'Email', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#design"><?php esc_html_e( 'Design', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#form"><?php esc_html_e( 'Form', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#advanced"><?php esc_html_e( 'Advanced', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#support"><?php esc_html_e( 'Support', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
			<li><a href="#about"><?php esc_html_e( 'About', 'classic-coming-soon-maintenance-mode' ); ?></a></li>
		</ul>
	</div><!-- .as-float-left -->

	<div class="as-float-right">
		<?php

			// Tabs
			require_once 'settings-basic.php';
			require_once 'settings-email.php';
			require_once 'settings-design.php';
			require_once 'settings-form.php';
			require_once 'settings-advanced.php';
			require_once 'settings-support.php';
			require_once 'settings-about.php';

		?>
	</div><!-- .as-float-right -->
</div><!-- .as-body -->

<?php

require_once 'footer.php';
