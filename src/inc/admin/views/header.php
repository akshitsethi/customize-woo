<?php
/**
 * View: Header
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;

?>

<div class="as-cnt-fix">
	<div class="as-header as-clearfix">
		<img src="<?php echo Config::$plugin_url; ?>assets/admin/images/lrg-icon.png" alt="<?php echo esc_attr_e( 'Widgets Bundle', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-logo">
		<p>
			<strong><?php esc_html_e( 'Classic Coming Soon & Maintenance Mode', 'classic-coming-soon-maintenance-mode' ); ?></strong>
			<span><?php esc_html_e( 'by', 'classic-coming-soon-maintenance-mode' ); ?> <a href="https://akshitsethi.com/" target="_blank"><?php esc_html_e( 'Akshit Sethi', 'classic-coming-soon-maintenance-mode' ); ?></a></span>
		</p>

		<div class="as-header-right">
			<input type="submit" id="<?php echo Config::PREFIX . 'submit'; ?>" name="<?php echo Config::PREFIX . 'submit'; ?>" class="as-btn" value="<?php esc_html_e( 'Save Changes', 'classic-coming-soon-maintenance-mode' ); ?>" data-tab="basic">
		</div><!-- .as-header-right -->
	</div><!-- .as-header -->
