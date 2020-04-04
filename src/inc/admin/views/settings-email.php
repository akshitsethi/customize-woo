<?php
/**
 * Email settings view for the plugin
 *
 * @since 1.0.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;
use DrewM\MailChimp\MailChimp;

?>

<div class="as-tile" id="email">
	<div class="as-tile-body">
		<h2 class="as-tile-title"><?php esc_html_e( 'EMAIL', 'classic-coming-soon-maintenance-mode' ); ?></h2>
		<p><?php esc_html_e( 'Email settings for the plugin. You can configure your MailChimp account API with this plugin to store collected emails in an list.', 'classic-coming-soon-maintenance-mode' ); ?></p>

		<div class="as-section-content">
			<div class="as-form-group">
				<label for="<?php echo Config::PREFIX . 'api'; ?>" class="as-strong"><?php esc_html_e( 'MailChimp API', 'classic-coming-soon-maintenance-mode' ); ?></label>
				<input type="text" name="<?php echo Config::PREFIX . 'api'; ?>" id="<?php echo Config::PREFIX . 'api'; ?>" value="<?php echo esc_attr( $options['mailchimp_api'] ); ?>" placeholder="<?php esc_attr_e( 'MailChimp API', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

				<p class="as-form-help-block"><?php echo sprintf( esc_html__( 'Provide your MailChimp API over here. %1$sClick here%2$s to know how to get this information. In case you don\'t want to enable subscription option, just leave this field blank.', 'classic-coming-soon-maintenance-mode' ), '<a href="https://mailchimp.com/help/about-api-keys/" target="_blank">', '</a>' ); ?></p>
			</div>

			<div class="as-form-group">
				<label for="<?php echo Config::PREFIX . 'list'; ?>" class="as-strong"><?php esc_html_e( 'MailChimp List', 'classic-coming-soon-maintenance-mode' ); ?></label>
				<div class="as-ajax-response">
					<?php

						// Fetch lists from Mailchimp if the API key is provided
					if ( ! empty( $options['mailchimp_api'] ) ) {
						// Try to fetch from the transient
						$cached_data = get_transient( Config::PREFIX . 'email_lists' );

						// Transient present?
						if ( $cached_data ) {
							echo '<select name="' . Config::PREFIX . 'list" id="' . Config::PREFIX . 'list">';

							foreach ( $cached_data as $key => $value ) {
								echo '<option value="' . $key . '"' . selected( $key, esc_attr( $options['mailchimp_list'] ) ) . '>' . $value . '</option>';
							}

							echo '</select>';

							// Show the refresh button
							$this->refresh_button();

							echo '<p class="as-form-help-block">' . esc_html__( 'Select your MailChimp list in which you would like to store the subscribers data.', 'classic-coming-soon-maintenance-mode' ) . '</p>';
						} else {
							try {
								// Array to set transient
								$list_data = array();

								// API call
								$mailchimp = new MailChimp( esc_html( $options['mailchimp_api'] ) );

								// Fetch lists
								$lists = $mailchimp->get( 'lists' );

								// API call went fine?
								if ( $mailchimp->success() ) {
									if ( count( $lists['lists'] ) > 0 ) {
										echo '<select name="' . Config::PREFIX . 'list" id="' . Config::PREFIX . 'list">';

										foreach ( $lists['lists'] as $list ) {
											echo '<option value="' . $list['id'] . '"' . selected( $list['id'], esc_attr( $options['mailchimp_list'] ) ) . '>' . $list['name'] . '</option>';

											// Add to array
											$list_data[ sanitize_text_field( $list['id'] ) ] = sanitize_text_field( $list['name'] );
										}

										echo '</select>';

										// Show the refresh button
										$this->refresh_button();

										echo '<p class="as-form-help-block">' . esc_html__( 'Select your MailChimp list in which you would like to store the subscribers data.', 'classic-coming-soon-maintenance-mode' ) . '</p>';

										// Set transient for future calls
										// Expiry after one month
										set_transient( Config::PREFIX . 'email_lists', $list_data, 60 * 60 * 24 * 30 );
									} else {
										echo '<p class="as-form-help-block">' . esc_html__( 'It seems that there is no list created for this account. Why not create one on the MailChimp website and then try here.', 'classic-coming-soon-maintenance-mode' ) . '</p>';
									}
								} else {
									echo '<p class="as-form-help-block">' . $mailchimp->getLastError() . '</p>';
								}
							} catch ( Exception $e ) {
								echo '<p class="as-form-help-block">' . $e->getMessage() . '<p>';
							}
						}
					} else {
						echo '<p class="as-form-help-block">' . esc_html__( 'Provide your MailChimp API key in the above box and click on `Save Changes` option. Your lists will appear over here.', 'classic-coming-soon-maintenance-mode' ) . '</p>';
					}

					?>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'message_noemail'; ?>" class="as-strong"><?php esc_html_e( 'Message: No Email', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'message_noemail'; ?>" id="<?php echo Config::PREFIX . 'message_noemail'; ?>" value="<?php echo esc_attr( stripslashes( $options['message_noemail'] ) ); ?>" placeholder="<?php esc_attr_e( 'Message when email is not provided', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

					<p class="as-form-help-block"><?php esc_html_e( 'Message to show if the user forgets to provide email address.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'message_error'; ?>" class="as-strong"><?php esc_html_e( 'Message: Invalid Request', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'message_error'; ?>" id="<?php echo Config::PREFIX . 'message_error'; ?>" value="<?php echo esc_attr( stripslashes( $options['message_error'] ) ); ?>" placeholder="<?php esc_attr_e( 'Message when user is already subscribed', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

					<p class="as-form-help-block"><?php esc_html_e( 'Message to show if there is an invalid request (usually an error while processing the request).', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>

			<div class="as-double-group as-clearfix">
				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'message_wrong'; ?>" class="as-strong"><?php esc_html_e( 'Message: General Error', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'message_wrong'; ?>" id="<?php echo Config::PREFIX . 'message_wrong'; ?>" value="<?php echo esc_attr( stripslashes( $options['message_wrong'] ) ); ?>" placeholder="<?php esc_attr_e( 'Message when anything goes wrong while subscribing', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

					<p class="as-form-help-block"><?php esc_html_e( 'Message to show if user provides an invalid email address.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>

				<div class="as-form-group">
					<label for="<?php echo Config::PREFIX . 'message_done'; ?>" class="as-strong"><?php esc_html_e( 'Message: Successfully Subscribed', 'classic-coming-soon-maintenance-mode' ); ?></label>
					<input type="text" name="<?php echo Config::PREFIX . 'message_done'; ?>" id="<?php echo Config::PREFIX . 'message_done'; ?>" value="<?php echo esc_attr( stripslashes( $options['message_done'] ) ); ?>" placeholder="<?php esc_attr_e( 'Success message when the user gets subscribed', 'classic-coming-soon-maintenance-mode' ); ?>" class="as-form-control">

					<p class="as-form-help-block"><?php esc_html_e( 'Message to show when the user gets subscribed successfully.', 'classic-coming-soon-maintenance-mode' ); ?></p>
				</div>
			</div>
		</div>
	</div>
</div><!-- #email -->
