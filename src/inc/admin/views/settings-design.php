<?php
/**
 * Design settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;

?>

<div class="as-tile" id="design">
	<div class="as-tile-body">
		<h2 class="as-tile-title"><?php esc_html_e( 'DESIGN', 'classic-coming-soon-maintenance-mode' ); ?></h2>
		<p><?php esc_html_e( 'Design settings for the plugin. You have the option to modify every aspect of the maintenance page design as per your requirements.', 'classic-coming-soon-maintenance-mode' ); ?></p>

		<div class="as-section-content">
			<div class="as-upload-group as-clearfix">
				<div class="as-form-group border-fix">
					<div class="as-upload-element">
						<label class="as-strong"><?php esc_html_e( 'Logo', 'classic-coming-soon-maintenance-mode' ); ?></label>

						<?php if ( ! empty( $options['logo'] ) ) : ?>
							<span class="as-preview-area"><img src="<?php echo esc_attr( $options['logo'] ); ?>" /></span>
						<?php else : ?>
							<span class="as-preview-area"><?php esc_html_e( 'Select or upload via WP native uploader', 'classic-coming-soon-maintenance-mode' ); ?></span>
						<?php endif; ?>

						<input type="hidden" name="<?php echo Config::PREFIX . 'logo'; ?>" id="<?php echo Config::PREFIX . 'logo'; ?>" value="<?php echo esc_attr( $options['logo'] ); ?>">
						
						<div class="as-flex">
							<button type="button" name="<?php echo Config::PREFIX . 'logo_upload'; ?>" id="<?php echo Config::PREFIX . 'logo_upload'; ?>" class="as-btn as-upload"><?php esc_html_e( 'Select', 'classic-coming-soon-maintenance-mode' ); ?></button>
							<span class="as-upload-append">
								<?php if ( ! empty( $options['logo'] ) ) : ?>
									&nbsp;<a href="javascript:;" class="as-remove-image"><?php esc_html_e( 'Remove', 'classic-coming-soon-maintenance-mode' ); ?></a>
								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>

				<div class="as-form-group border-fix">
					<div class="as-upload-element">
						<label class="as-strong"><?php esc_html_e( 'Favicon', 'classic-coming-soon-maintenance-mode' ); ?></label>

						<?php if ( ! empty( $options['favicon'] ) ) : ?>
							<span class="as-preview-area"><img src="<?php echo esc_attr( $options['favicon'] ); ?>" /></span>
						<?php else : ?>
							<span class="as-preview-area"><?php esc_html_e( 'Select or upload via WP native uploader', 'classic-coming-soon-maintenance-mode' ); ?></span>
						<?php endif; ?>

						<input type="hidden" name="<?php echo Config::PREFIX . 'favicon'; ?>" id="<?php echo Config::PREFIX . 'favicon'; ?>" value="<?php echo esc_attr( $options['favicon'] ); ?>">
						
						<div class="as-flex">
							<button type="button" name="<?php echo Config::PREFIX . 'favicon_upload'; ?>" id="<?php echo Config::PREFIX . 'favicon_upload'; ?>" class="as-btn as-upload"><?php esc_html_e( 'Select', 'classic-coming-soon-maintenance-mode' ); ?></button>
							<span class="as-upload-append">
								<?php if ( ! empty( $options['favicon'] ) ) : ?>
									&nbsp;<a href="javascript:;" class="as-remove-image"><?php esc_html_e( 'Remove', 'classic-coming-soon-maintenance-mode' ); ?></a>
								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>

				<div class="as-form-group border-fix">
					<div class="as-upload-element">
						<label class="as-strong"><?php esc_html_e( 'Background Cover Image', 'classic-coming-soon-maintenance-mode' ); ?></label>

						<?php if ( ! empty( $options['bg_cover'] ) ) : ?>
							<span class="as-preview-area"><img src="<?php echo esc_attr( $options['bg_cover'] ); ?>" /></span>
						<?php else : ?>
							<span class="as-preview-area"><?php esc_html_e( 'Select or upload via WP native uploader', 'classic-coming-soon-maintenance-mode' ); ?></span>
						<?php endif; ?>

						<input type="hidden" name="<?php echo Config::PREFIX . 'bg'; ?>" id="<?php echo Config::PREFIX . 'bg'; ?>" value="<?php echo esc_attr( $options['bg_cover'] ); ?>">

						<div class="as-flex">
							<button type="button" name="<?php echo Config::PREFIX . 'bg_upload'; ?>" id="<?php echo Config::PREFIX . 'bg_upload'; ?>" class="as-btn as-upload"><?php esc_html_e( 'Select', 'classic-coming-soon-maintenance-mode' ); ?></button>
							<span class="as-upload-append">
								<?php if ( ! empty( $options['bg_cover'] ) ) : ?>
									&nbsp;<a href="javascript:;" class="as-remove-image"><?php esc_html_e( 'Remove', 'classic-coming-soon-maintenance-mode' ); ?></a>
								<?php endif; ?>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay'; ?>" class="as-strong"><?php esc_html_e( 'Content Overlay', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="checkbox" class="as-form-ios" name="<?php echo Config::PREFIX . 'overlay'; ?>" value="1"<?php checked( true, esc_attr( $options['content_overlay'] ) ); ?>>

					<p class="as-form-help-block"><?php esc_html_e( 'If enabled, applies transparent background to the content section of the maintenance page.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay_opacity'; ?>" class="as-strong"><?php esc_html_e( 'Content Overlay Opacity', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'overlay_opacity'; ?>" id="<?php echo Config::PREFIX . 'overlay_opacity'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 0.05; $i < 1; $i += 0.05 ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['content_bg_opacity'] ), $i ) . '>' . str_pad( $i, 4, '0', STR_PAD_RIGHT ) . '</option>';
						}

							// Option for NO opacity
							echo '<option value="1"' . selected( esc_html( $options['content_bg_opacity'] ), '1' ) . '>1.00</option>';

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Background opacity for the content overlay.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay_color'; ?>" class="as-strong"><?php esc_html_e( 'Content Overlay Background Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'overlay_color'; ?>" id="<?php echo Config::PREFIX . 'overlay_color'; ?>" value="<?php echo esc_attr( $options['content_bg'] ); ?>" placeholder="<?php esc_html_e( 'Background color for the content overlay', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select background color for the content overlay.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay_border_color'; ?>" class="as-strong"><?php esc_html_e( 'Content Border Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'overlay_border_color'; ?>" id="<?php echo Config::PREFIX . 'overlay_border_color'; ?>" value="<?php echo esc_attr( $options['content_border'] ); ?>" placeholder="<?php esc_html_e( 'Border color for the content overlay', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select border color for the content section.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay_border_width'; ?>" class="as-strong"><?php esc_html_e( 'Content Border Width', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'overlay_border_width'; ?>" id="<?php echo Config::PREFIX . 'overlay_border_width'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 1; $i < 21; $i++ ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['content_border_width'] ), $i ) . '>' . $i . esc_html__( 'px', 'classic-coming-soon-maintenance-mode' ) . '</option>';
						}

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Border size for the content section.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'overlay_border_radius'; ?>" class="as-strong"><?php esc_html_e( 'Content Border Radius', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'overlay_border_radius'; ?>" id="<?php echo Config::PREFIX . 'overlay_border_radius'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 0; $i < 41; $i++ ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['content_border_radius'] ), $i ) . '>' . $i . esc_html__( 'px', 'classic-coming-soon-maintenance-mode' ) . '</option>';
						}

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Border radius for the content section.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'width'; ?>" class="as-strong"><?php esc_html_e( 'Content Width (in px)', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'width'; ?>" id="<?php echo Config::PREFIX . 'width'; ?>" value="<?php echo esc_attr( $options['content_width'] ); ?>" placeholder="<?php esc_html_e( 'Set content width for the page', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

					<p class="as-form-help-block"><?php esc_html_e( 'Set maximum width of the content (in pixels) for the maintenance page. Provide only numeric value. Example: Entering 400 will set the width of the content to 400px. Defaults to 440px.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'color'; ?>" class="as-strong"><?php esc_html_e( 'Background Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'color'; ?>" id="<?php echo Config::PREFIX . 'color'; ?>" value="<?php echo esc_attr( $options['bg_color'] ); ?>" placeholder="<?php esc_html_e( 'Background color for the page', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select background color for the page. If the background cover image is set, this option will be ignored.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'position'; ?>" class="as-strong"><?php esc_html_e( 'Content Position', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'position'; ?>" id="<?php echo Config::PREFIX . 'position'; ?>">
						<option value="left"<?php selected( 'left', esc_attr( $options['content_position'] ) ); ?>><?php esc_html_e( 'Left', 'classic-coming-soon-maintenance-mode' ); ?></option>
						<option value="center"<?php selected( 'center', esc_attr( $options['content_position'] ) ); ?>><?php esc_html_e( 'Center', 'classic-coming-soon-maintenance-mode' ); ?></option>
						<option value="right"<?php selected( 'right', esc_attr( $options['content_position'] ) ); ?>><?php esc_html_e( 'Right', 'classic-coming-soon-maintenance-mode' ); ?></option>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'For the position of the content on the maintenance page. Does not work if the width is set to maximum which is 1170px.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'alignment'; ?>" class="as-strong"><?php esc_html_e( 'Content Alignment', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'alignment'; ?>" id="<?php echo Config::PREFIX . 'alignment'; ?>">
						<option value="left"<?php selected( 'left', esc_attr( $options['content_alignment'] ) ); ?>><?php esc_html_e( 'Left', 'classic-coming-soon-maintenance-mode' ); ?></option>
						<option value="center"<?php selected( 'center', esc_attr( $options['content_alignment'] ) ); ?>><?php esc_html_e( 'Center', 'classic-coming-soon-maintenance-mode' ); ?></option>
						<option value="right"<?php selected( 'right', esc_attr( $options['content_alignment'] ) ); ?>><?php esc_html_e( 'Right', 'classic-coming-soon-maintenance-mode' ); ?></option>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'For the alignment of the text on the maintenance page. Make it left, center, or right.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'header_font'; ?>" class="as-strong"><?php esc_html_e( 'Header Font', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'header_font'; ?>" id="<?php echo Config::PREFIX . 'header_font'; ?>" class="as-google-fonts">
						<?php

							// Default fonts
						foreach ( Config::DEFAULT_FONTS as $font ) {
							echo '<option value="' . $font . '"' . selected( $font, esc_attr( $options['header_font'] ) ) . '>' . $font . '</option>' . "\n";
						}

							echo '<option disabled>-- ' . esc_html__( 'Google Fonts', 'classic-coming-soon-maintenance-mode' ) . ' --</option>' . "\n";

							// Listing fonts from the array
						foreach ( Config::GOOGLE_FONTS as $font ) {
							echo '<option value="' . $font . '"' . selected( $font, esc_attr( $options['header_font'] ) ) . '>' . $font . '</option>' . "\n";
						}

						?>
					</select>

					<h3><?php esc_html_e( 'This is how this font is going to look!', 'classic-coming-soon-maintenance-mode' ); ?></h3>
					<p class="as-form-help-block"><?php esc_html_e( 'Font for the header text. Listing a total of 668 Google web fonts.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'secondary_font'; ?>" class="as-strong"><?php esc_html_e( 'Secondary Font', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'secondary_font'; ?>" id="<?php echo Config::PREFIX . 'secondary_font'; ?>" class="as-google-fonts">
						<?php

							// Default fonts
						foreach ( Config::DEFAULT_FONTS as $font ) {
							echo '<option value="' . $font . '"' . selected( $font, esc_attr( $options['secondary_font'] ) ) . '>' . $font . '</option>' . "\n";
						}

							echo '<option disabled>-- ' . esc_html__( 'Google Fonts', 'classic-coming-soon-maintenance-mode' ) . ' --</option>' . "\n";

							// Google fonts
						foreach ( Config::GOOGLE_FONTS as $font ) {
							echo '<option value="' . $font . '"' . selected( $font, esc_attr( $options['secondary_font'] ) ) . '>' . $font . '</option>' . "\n";
						}

						?>
					</select>

					<h3><?php esc_html_e( 'This is how this font is going to look!', 'classic-coming-soon-maintenance-mode' ); ?></h3>
					<p class="as-form-help-block"><?php esc_html_e( 'Font for the secondary text. Listing a total of 668 Google web fonts.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'header_size'; ?>" class="as-strong"><?php esc_html_e( 'Header Text Size', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'header_size'; ?>" id="<?php echo Config::PREFIX . 'header_size'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 6; $i < 81; $i++ ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['header_font_size'] ), $i ) . '>' . $i . esc_html__( 'px', 'classic-coming-soon-maintenance-mode' ) . '</option>';
						}

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Font size for the header text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'secondary_size'; ?>" class="as-strong"><?php esc_html_e( 'Secondary Text Size', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'secondary_size'; ?>" id="<?php echo Config::PREFIX . 'secondary_size'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 6; $i < 81; $i++ ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['secondary_font_size'] ), $i ) . '>' . $i . esc_html__( 'px', 'classic-coming-soon-maintenance-mode' ) . '</option>';
						}

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Font size for the secondary text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'header_color'; ?>" class="as-strong"><?php esc_html_e( 'Header Text Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'header_color'; ?>" id="<?php echo Config::PREFIX . 'header_color'; ?>" value="<?php echo esc_attr( $options['header_font_color'] ); ?>" placeholder="<?php esc_html_e( 'Font color for the Header text', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select font color for the header text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'secondary_color'; ?>" class="as-strong"><?php esc_html_e( 'Secondary Text Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'secondary_color'; ?>" id="<?php echo Config::PREFIX . 'secondary_color'; ?>" value="<?php echo esc_attr( $options['secondary_font_color'] ); ?>" placeholder="<?php esc_html_e( 'Font color for the Secondary text', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select font color for the secondary text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'antispam_size'; ?>" class="as-strong"><?php esc_html_e( 'Antispam Text Size', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<select name="<?php echo Config::PREFIX . 'antispam_size'; ?>" id="<?php echo Config::PREFIX . 'antispam_size'; ?>">
						<?php

							// Loading font sizes with the help of a loop
						for ( $i = 6; $i < 61; $i++ ) {
							echo '<option value="' . $i . '"' . selected( esc_attr( $options['antispam_font_size'] ), $i ) . '>' . $i . esc_html__( 'px', 'classic-coming-soon-maintenance-mode' ) . '</option>';
						}

						?>
					</select>

					<p class="as-form-help-block"><?php esc_html_e( 'Font size for the antispam text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'antispam_color'; ?>" class="as-strong"><?php esc_html_e( 'Antispam Text Color', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'antispam_color'; ?>" id="<?php echo Config::PREFIX . 'antispam_color'; ?>" value="<?php echo esc_attr( $options['antispam_font_color'] ); ?>" placeholder="<?php esc_html_e( 'Font color for the Antispam text', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control jscolor {required:false}">

					<p class="as-form-help-block"><?php esc_html_e( 'Select font color for the antispam text.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div><!-- #design -->
