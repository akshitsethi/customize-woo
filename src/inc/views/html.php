<?php
/**
 * Renders the html template for the frontend.
 *
 * @since 1.0
 */

use AkshitSethi\Plugins\MaintenanceMode\Config;
use DrewM\MailChimp\MailChimp;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo stripslashes( $this->get_option( sanitize_text_field( $options['title'] ), esc_html__( 'Maintainance Mode', 'classic-coming-soon-maintenance-mode' ) ) ); ?></title>
<?php if ( isset( $options['favicon'] ) && ! empty( $options['favicon'] ) ) : ?>
<link rel="shortcut icon" href="<?php echo esc_url_raw( sanitize_text_field( $options['favicon'] ) ); ?>" />
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo Config::$plugin_url; ?>assets/css/front.css">
<script src="<?php echo Config::$plugin_url; ?>assets/admin/js/webfont.js"></script>
<script type="text/javascript">
	var data = {
		headerFont: '<?php echo $options['header_font']; ?>',
		secondaryFont: '<?php echo $options['secondary_font']; ?>'
	}

	// Font loader
	WebFont.load({
		google: {
			families: data.headerFont === data.secondaryFont ? [data.headerFont] : [data.headerFont, data.secondaryFont]
		}
	});
</script>
<?php

	// Inject styling for the options in the header
	echo $this->head_css( $options );

?>
</head>
<body class="as-plugin">
	<div class="as-ccsmm">
		<div class="as-container">
			<div class="as-content">
				<?php

					// Logo
				if ( ! empty( $options['logo'] ) ) {
					$arrange['logo']  = '<div class="as-logo-container">' . "\r\n";
					$arrange['logo'] .= '<img src="' . esc_url( $options['logo'] ) . '" class="as-logo" />' . "\r\n";
					$arrange['logo'] .= '</div>' . "\r\n";
				}

					// Header text
				if ( ! empty( $options['header_text'] ) ) {
					$arrange['header'] = '<h1 class="as-header-text">' . stripslashes( nl2br( $options['header_text'] ) ) . '</h1>' . "\r\n";
				}

					// Secondary text
				if ( ! empty( $options['secondary_text'] ) ) {
					$arrange['secondary'] = '<p class="as-secondary-text">' . stripslashes( nl2br( $options['secondary_text'] ) ) . '</p>' . "\r\n";
				}

					// Form
				if ( ! empty( $options['mailchimp_api'] ) && ! empty( $options['mailchimp_list'] ) ) {
					// Checking if the form is submitted or not
					if ( isset( $_POST[ Config::PREFIX . 'email' ] ) ) {
						$email = strip_tags( $_POST[ Config::PREFIX . 'email' ] );

						if ( empty( $email ) ) {
							$code     = 'error';
							$response = $this->get_option( esc_html( stripslashes( $options['message_noemail'] ) ), esc_html__( 'Please provide your email address.', 'classic-coming-soon-maintenance-mode' ) );
						} else {
							$email = filter_var( strtolower( trim( $email ) ), FILTER_SANITIZE_EMAIL );

							// Check value for filter_var
							if ( ! $email ) {
								$code     = 'error';
								$response = $this->get_option( esc_html( stripslashes( $options['message_wrong'] ) ), esc_html__( 'Please provide a valid email address.', 'classic-coming-soon-maintenance-mode' ) );
							} else {
								$mailchimp = new MailChimp( esc_html( $options['mailchimp_api'] ) );
								$connect   = $mailchimp->post(
									'lists/' . esc_html( $options['mailchimp_list'] ) . '/members',
									array(
										'email_address' => $email,
										'status'        => 'subscribed',
									)
								);

								// Show the response
								if ( $mailchimp->success() ) {
									$code = 'success';

									// Show the success message
									$response = $this->get_option( esc_html( stripslashes( $options['message_done'] ) ), esc_html__( 'Thank you! We\'ll be in touch!', 'classic-coming-soon-maintenance-mode' ) );
								} else {
									$code     = 'error';
									$response = $mailchimp->getLastError();
								}
							}
						}
					}

					// Subscription form
					// Displaying errors as well if they are set
					$arrange['form'] = '<div class="as-subscription">';

					if ( isset( $code ) && isset( $response ) ) {
						$arrange['form'] .= '<div class="as-alert as-alert-' . $code . '">' . $response . '</div>';
					}

					$arrange['form'] .= '<form role="form" method="post">
							<input type="text" name="' . Config::PREFIX . 'email" placeholder="' . esc_attr( $this->get_option( sanitize_text_field( $options['input_text'] ), esc_html__( 'Enter your email address..', 'classic-coming-soon-maintenance-mode' ) ) ) . '">
							<input type="submit" name="' . Config::PREFIX . 'submit" value="' . esc_attr( $this->get_option( sanitize_text_field( $options['button_text'] ), esc_html__( 'Subscribe', 'classic-coming-soon-maintenance-mode' ) ) ) . '">
						</form>';

					// Antispam text
					if ( ! empty( $options['antispam_text'] ) ) {
						$arrange['form'] .= '<p class="as-anti-spam">' . stripslashes( sanitize_text_field( $options['antispam_text'] ) ) . '</p>';
					}

					$arrange['form'] .= '</div><!-- .as-subscription -->';
				}

					// Custom HTML
					$arrange['html'] = stripslashes( $options['custom_html'] );

					// Echo out sections
				if ( isset( $options['arrange'] ) && ! empty( $options['arrange'] ) ) {
					$sections = explode( ',', esc_html( $options['arrange'] ) );
				} else {
					$sections = Config::$default_options['arrange'];
				}

				foreach ( $sections as $section ) {
					if ( isset( $arrange[ $section ] ) ) {
						echo $arrange[ $section ];
					}
				}

				?>
			</div><!-- .as-content -->
		</div><!-- .as-container -->
	</div><!-- .as-ccsmm -->

<?php

	// Analytics code
if ( isset( $options['analytics'] ) && ! empty( $options['analytics'] ) ) {
	echo '<script>' . stripslashes( $options['analytics'] ) . '</script>' . "\r\n";
}

?>

<!-- Classic Coming Soon & Maintenance Mode Plugin by Akshit Sethi (https://akshitsethi.com) -->
<!-- Twitter: @akshitsethi -->
</body>
</html>
