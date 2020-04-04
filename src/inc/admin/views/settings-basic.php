<?php
/**
 * Basic settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;

?>

<div class="as-options-wrapper">
	<form method="post" class="as-options-form" id="<?php echo Config::PREFIX . 'form'; ?>">
		<div class="as-tile" id="basic">
			<div class="as-tile-body">
				<h2 class="as-tile-title"><?php esc_html_e( 'BASIC', 'classic-coming-soon-maintenance-mode' ); ?></h2>
				<p><?php esc_html_e( 'Configure the core settings. Make sure you configure these options carefully as they are important for the working of the plugin.', 'classic-coming-soon-maintenance-mode' ); ?></p>

				<div class="as-section-content">
					<div class="as-double-group as-clearfix">
						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'status'; ?>" class="as-strong"><?php esc_html_e( 'Enable Maintenance Mode?', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="checkbox" class="as-form-ios" name="<?php echo Config::PREFIX . 'status'; ?>" value="1"<?php checked( true, esc_attr( $options['status'] ) ); ?>>

							<p class="as-form-help-block"><?php esc_html_e( 'Set the plugin status. Do you want to enable Maintenance Mode for your website?', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>

						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'title'; ?>" class="as-strong"><?php esc_html_e( 'Page Title', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="text" name="<?php echo Config::PREFIX . 'title'; ?>" id="<?php echo Config::PREFIX . 'title'; ?>" value="<?php echo esc_attr( stripslashes( $options['title'] ) ); ?>" placeholder="<?php esc_attr_e( 'Please provide a Page Title', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

							<p class="as-form-help-block"><?php esc_html_e( 'Provide title for the maintenance page.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>
					</div>

					<div class="as-double-group as-clearfix">
						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'header'; ?>" class="as-strong"><?php esc_html_e( 'Header Text', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<textarea name="<?php echo Config::PREFIX . 'header'; ?>" id="<?php echo Config::PREFIX . 'header'; ?>" rows="3" placeholder="<?php esc_attr_e( 'Header text for the maintenance page', 'classic-coming-soon-maintenance-mode' ); ?>"><?php echo esc_textarea( stripslashes( $options['header_text'] ) ); ?></textarea>

							<p class="as-form-help-block"><?php esc_html_e( 'Provide header text for the maintenance page. It is not recommended to leave this blank.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>

						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'secondary'; ?>" class="as-strong"><?php esc_html_e( 'Secondary Text', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<textarea name="<?php echo Config::PREFIX . 'secondary'; ?>" id="<?php echo Config::PREFIX . 'secondary'; ?>" rows="3" placeholder="<?php esc_attr_e( 'Secondary text for the maintenance page', 'classic-coming-soon-maintenance-mode' ); ?>"><?php echo esc_textarea( stripslashes( $options['secondary_text'] ) ); ?></textarea>

							<p class="as-form-help-block"><?php esc_html_e( 'Provide secondary text for the maintenance page. It is not recommended to leave this blank.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>
					</div>

					<div class="as-double-group as-clearfix">
						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'antispam'; ?>" class="as-strong"><?php esc_html_e( 'Anti Spam Text', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="text" name="<?php echo Config::PREFIX . 'antispam'; ?>" id="<?php echo Config::PREFIX . 'antispam'; ?>" value="<?php echo esc_attr( stripslashes( $options['antispam_text'] ) ); ?>" placeholder="<?php esc_attr_e( 'Please provide a Anti-spam Text', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

							<p class="as-form-help-block"><?php esc_html_e( 'Provide anti-spam text for the maintenance page.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>

						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'custom_login'; ?>" class="as-strong"><?php esc_html_e( 'Custom login URL', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="text" name="<?php echo Config::PREFIX . 'custom_login'; ?>" id="<?php echo Config::PREFIX . 'custom_login'; ?>" value="<?php echo esc_attr( $options['custom_login_url'] ); ?>" placeholder="<?php esc_attr_e( 'Custom login URL', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

							<p class="as-form-help-block"><?php esc_html_e( 'In case you are using any plugin for custom login, provide your custom login URL over here. This plugin should be able to detect your custom login automatically in most of the situations. In case it fails to do so, you can provide the custom login URL over here.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>
					</div>

					<div class="as-double-group as-clearfix">
						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'showlogged'; ?>" class="as-strong"><?php esc_html_e( 'Show normal website to logged in users?', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="checkbox" class="as-form-ios" name="<?php echo Config::PREFIX . 'showlogged'; ?>" value="1"<?php checked( true, esc_attr( $options['show_logged_in'] ) ); ?>>

							<p class="as-form-help-block"><?php esc_html_e( 'Enable this option if you want logged in users to view the website normally while visitors see the maintenance page.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>

						<div class="as-form-group">
							<label for="<?php echo Config::PREFIX . 'excludese'; ?>" class="as-strong"><?php esc_html_e( 'Exclude Search Engines?', 'classic-coming-soon-maintenance-mode' ); ?></label>
							<input type="checkbox" class="as-form-ios" name="<?php echo Config::PREFIX . 'excludese'; ?>" value="1"<?php checked( true, esc_attr( $options['exclude_se'] ) ); ?>>

							<p class="as-form-help-block"><?php esc_html_e( 'Do you want to exclude search engines from viewing maintenance page? This will enable search engines to view your regular website and not the Maintenance Mode page even if the plugin is enabled.', 'classic-coming-soon-maintenance-mode' ); ?></p>
						</div>
					</div>

					<label for="<?php echo Config::PREFIX . 'arrange'; ?>" class="as-strong"><?php esc_html_e( 'Arrange Elements', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<p class="as-form-help-block"><?php esc_html_e( 'Select the order in which you would like to display the sections on the maintenance page. To change the order, simply drag the items and arrange as per your preference.', 'classic-coming-soon-maintenance-mode' ); ?></p>

					<div class="as-elements">
						<ul id="arrange-items">
							<?php

								// Set arrange elements to default value
								$arrange = Config::$default_options['arrange'];

							if ( ! empty( $options['arrange'] ) ) {
								$arrange = explode( ',', $options['arrange'] );
							}

								// list items
							foreach ( $arrange as $item ) {
								if ( 'html' == $item ) {
									echo '<li data-id="' . esc_attr( $item ) . '">' . esc_html__( 'Custom HTML', 'classic-coming-soon-maintenance-mode' ) . '</li>';
								} else {
									echo '<li data-id="' . esc_attr( $item ) . '">' . ucfirst( esc_attr( $item ) ) . '</li>';
								}
							}

							?>
						</ul>

						<input type="hidden" name="<?php echo Config::PREFIX . 'arrange'; ?>" id="<?php echo Config::PREFIX . 'arrange'; ?>" value="<?php echo esc_attr( $options['arrange'] ); ?>">
					</div><!-- .as-elements -->

					<div class="as-form-group">
						<label for="<?php echo Config::PREFIX . 'analytics'; ?>" class="as-strong"><?php esc_html_e( 'Analytics Code', 'classic-coming-soon-maintenance-mode' ); ?></label>
						<textarea name="<?php echo Config::PREFIX . 'analytics'; ?>" id="<?php echo Config::PREFIX . 'analytics'; ?>" rows="5" placeholder="<?php esc_attr_e( 'Analytics code for the maintenance page', 'classic-coming-soon-maintenance-mode' ); ?>"><?php echo esc_textarea( stripslashes( $options['analytics'] ) ); ?></textarea>

						<p class="as-form-help-block"><?php echo sprintf( esc_html__( 'Provide analytics code for the maintenance page. Please provide code without the %1$s tag.', 'classic-coming-soon-maintenance-mode' ), '<i style="color: #f96773">&lt;script&gt;</i>' ); ?></p>
					</div>
				</div>
			</div>
		</div><!-- #basic -->
