<?php
/*
# =================================================
# template-contact.php
#
# Template Name: Contact
# =================================================
*/
?>

<?php
	$errors = array();
	$isError = false;

	$errorName = __( 'Please enter your name.', 'tuts' );
	$errorEmail = __( 'Please enter a valid email address.', 'tuts' );
	$errorMessage = __( 'Please enter a message.', 'tuts' );

	/* Get the posted variables and validate them. */
	if ( isset( $_POST['is-submitted'] ) ) {
		$name = $_POST['cName'];
		$email = $_POST['cEmail'];
		$message = $_POST['cMessage'];

		/* Check the name. */
		if ( ! tuts_validate_length( $name, 2 ) ) {
			$isError = true;
			$errors['errorName'] = $errorName;
		}

		/* Check the email. */
		if ( ! is_email( $email ) ) {
			$isError = true;
			$errors['errorEmail'] = $errorEmail;
		}

		/* Check the message. */
		if ( ! tuts_validate_length( $message, 2 ) ) {
			$isError = true;
			$errors['errorMessage'] = $errorMessage;
		}

		/* If there's no error, send email. */
		if ( ! $isError ) {
			/* Get admin email. */
			$emailReceiver = get_option( 'admin_email' );

			$emailSubject = sprintf( __( 'You have been contacted by %s', 'tuts' ), $name );
			$emailBody    = sprintf( __( 'You have been contacted by %1$s. Their message is:', 'tuts' ), $name ) . PHP_EOL . PHP_EOL;
			$emailBody    .= $message . PHP_EOL . PHP_EOL;
			$emailBody    .= sprintf( __( 'You can contact %1$s via email at %2$s', 'tuts' ), $name, $email );
			$emailBody    .= PHP_EOL . PHP_EOL;

			$emailHeaders[] = "Reply-To: $email" . PHP_EOL;

			$emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
		}
	}
?>

<?php
/* Load header.php */
get_header();
?>

<!-- Jumbotron -->
<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1><?php _e( 'Thanks for getting in touch.', 'tuts' ); ?></h1>

                <p class="lead">
                    <?php _e( 'I can\'t wait to hear from you.', 'tuts' ); ?>
                </p>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end jumbotron -->
</div> <!-- end container-fluid -->

<!-- Contact Form -->
<div class="page-contact container-fluid">
    <div class="row">
        <div class="col-md-6">
            <?php if ( isset( $emailIsSent ) && $emailIsSent ) : ?>
                <div class="alert alert-success">
                    <?php _e( 'Your message has been sucessfully sent, thank you!', 'tuts' ); ?>
                </div> <!-- end alert -->
            <?php else : ?>

                <p>
                    <?php _e( 'I\'m glad you\'ve decided to contact me. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla pariatur totam quam, repellendus, molestias id veniam. Aspernatur officiis, ducimus quasi.', 'tuts' ); ?>
                </p>

                <?php if ( isset( $isError ) && $isError ) : ?>
                    <div class="alert alert-danger">
                        <?php _e( 'Sorry, it seems there was an error.', 'tuts' ); ?>
                    </div> <!-- end alert -->
                <?php endif; ?>
            <?php endif; ?>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <?php if ( ! isset( $emailIsSent ) || isset( $isError ) && $isError ) : ?>
    <div class="row">
        <div class="contact-form col-md-6">
            <form role="form" action="<?php the_permalink(); ?>" method="post">
                <div class="form-group <?php if ( isset( $errors['errorName'] ) ) echo "has-error"; ?>">
                    <label for="contact-name"><?php _e( 'Name', 'tuts' ); ?></label>
                    <input type="text" class="form-control" id="contact-name" name="cName" placeholder="<?php _e( 'Enter your name', 'tuts' ); ?>" value="<?php if ( isset( $_POST['cName'] ) ) { echo $_POST['cName']; } ?>">
                    <?php if ( isset( $errors['errorName'] ) ) : ?>
    				    <p class="help-block"><?php echo $errors['errorName']; ?></p>
    				<?php endif; ?>
                </div> <!-- end form-group -->
                <div class="form-group <?php if ( isset( $errors['errorEmail'] ) ) echo "has-error"; ?>">
                    <label for="contact-email"><?php _e( 'E-mail Address', 'tuts' ); ?></label>
                    <input type="email" class="form-control" id="contact-email" name="cEmail" placeholder="<?php _e( 'Enter your e-mail address', 'tuts' ); ?>" value="<?php if ( isset( $_POST['cEmail'] ) ) { echo $_POST['cEmail']; } ?>">
                    <?php if ( isset( $errors['errorEmail'] ) ) : ?>
    				    <p class="help-block"><?php echo $errors['errorEmail']; ?></p>
    				<?php endif; ?>
                </div> <!-- end form-group -->
                <div class="form-group <?php if ( isset( $errors['errorMessage'] ) ) echo "has-error"; ?>">
                    <label for="contact-message"><?php _e( 'Message', 'tuts' ); ?></label>
                    <textarea class="form-control" rows="3" id="contact-message" name="cMessage" placeholder="<?php _e( 'Enter your message', 'tuts' ); ?>"><?php if ( isset( $_POST['cMessage'] ) ) { echo $_POST['cMessage']; } ?></textarea>
                    <?php if ( isset( $errors['errorMessage'] ) ) : ?>
    				    <p class="help-block"><?php echo $errors['errorMessage']; ?></p>
    				<?php endif; ?>
                </div> <!-- end form-group -->

                <input type="hidden" name="is-submitted" id="is-submitted" value="true">
                <button type="submit" class="btn btn-default"><?php _e( 'Submit', 'tuts' ); ?></button>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <?php endif; ?>
</div> <!-- end container-fluid -->

<?php
/* Load footer.php */
get_footer();
?>
