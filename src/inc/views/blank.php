<?php
/**
 * Renders the blank template for the frontend.
 *
 * @since 1.0.0
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
<link rel="stylesheet" type="text/css" href="<?php echo Config::$plugin_url; ?>assets/css/basic.css">
<?php

	// Custom CSS for the blank template
if ( ! empty( $options['custom_css'] ) ) {
	echo '<style>';
	echo stripslashes( strip_tags( $options['custom_css'] ) );
	echo '</style>';
}

?>
</head>
<body>
<?php

	// Custom HTML
	// Nothing else will be included here since we are serving a blank template
	$custom_html = stripslashes( $options['custom_html'] );

	// Form
if ( ! empty( $custom_html ) && false !== strpos( $custom_html, '{{form}}' ) ) {
	// Form
	if ( ! empty( $options['mailchimp_api'] ) && ! empty( $options['mailchimp_list'] ) ) {
		// Checking if the form is submitted or not
		if ( isset( $_POST[ Config::PREFIX . 'email' ] ) ) {
			$email = strip_tags( $_POST[ Config::PREFIX . 'email' ] );

			if ( empty( $email ) ) {
				$code     = 'error';
				$response = $this->get_option( esc_html( $options['message_noemail'] ), esc_html__( 'Please provide your email address.', 'classic-coming-soon-maintenance-mode' ) );
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
		$subscription_form = '<div class="as-subscription">';

		if ( isset( $code ) && isset( $response ) ) {
			$subscription_form .= '<div class="as-alert as-alert-' . $code . '">' . $response . '</div>';
		}

		$subscription_form .= '<form role="form" method="post">
        <input type="text" name="' . Config::PREFIX . 'email" placeholder="' . esc_attr( $this->get_option( esc_html( $options['input_text'] ), esc_html__( 'Enter your email address..', 'classic-coming-soon-maintenance-mode' ) ) ) . '">
        <input type="submit" name="' . Config::PREFIX . 'submit" value="' . esc_attr( $this->get_option( esc_html( $options['button_text'] ), esc_html__( 'Subscribe', 'classic-coming-soon-maintenance-mode' ) ) ) . '">
			</form>';

		// Antispam text
		if ( ! empty( $options['antispam_text'] ) ) {
			$subscription_form .= '<p class="anti-spam">' . esc_html( stripslashes( $options['antispam_text'] ) ) . '</p>';
		}

		$subscription_form .= '</div><!-- .as-subscription -->';

		// Replace {{form}} placeholder
		$custom_html = str_replace( '{{form}}', $subscription_form, $custom_html );
	}
}

	// Output HTML
	echo $custom_html;

	// Analytics code
if ( isset( $options['analytics'] ) && ! empty( $options['analytics'] ) ) {
	echo '<script>' . stripslashes( $options['analytics'] ) . '</script>' . "\r\n";
}

?>

<!-- Classic Coming Soon & Maintenance Mode Plugin by Akshit Sethi (https://akshitsethi.com) -->
<!-- Twitter: @akshitsethi -->
</body>
</html>
