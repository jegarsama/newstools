<?php
/**
 * Plugin Name: Goodlayers Contact Widget
 * Description: Contact From Widget.
 * Version: 1.0
 * Author: Sittipol Sunthornpiyakul
 * Author URI: http://www.saintdo.me
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'contact_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function contact_widget() {
	register_widget( 'contact' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class contact extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function contact() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'contact-widget', 'description' => __('Contact From Widget.', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'contact-widget', __('Contact (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		wp_reset_query();
		
		/* Our variables from the widget settings. */
		$title = apply_filters('Last From Port', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if($title) echo $before_title . $title . $after_title;
		
		//If the form is submitted
		if(isset($_POST['submitted'])) {

			//Check to see if the honeypot captcha field was filled in
			if(trim($_POST['checking']) !== '') {
				$captchaError = true;
			} else {
			
				//Check to make sure that the name field is not empty
				if(trim($_POST['widget-contactName']) === '') {
					$nameError = 'Please enter your name';
					$hasError = true;
				} else {
					$name = trim($_POST['widget-contactName']);
				}
				
				//Check to make sure sure that a valid email address is submitted
				if(trim($_POST['widget-email']) === '')  {
					$emailError = 'Please enter a valid email address';
					$hasError = true;
				} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['widget-email']))) {
					$emailError = 'Please enter a valid email address';
					$hasError = true;
				} else {
					$email = trim($_POST['widget-email']);
				}
					
				//Check to make sure comments were entered	
				if(trim($_POST['widget-comments']) === '') {
					$commentError = 'Please enter message';
					$hasError = true;
				} else {
					if(function_exists('stripslashes')) {
						$comments = stripslashes(trim($_POST['widget-comments']));
					} else {
						$comments = trim($_POST['widget-comments']);
					}
				}
					
				//If there is no error, send the email
				if(!isset($hasError)) {

					$emailTo = $instance['email'];
					$subject = 'Contact Form Submission from '.$name;
					$sendCopy = isset($_POST['sendCopy'])? trim($_POST['sendCopy']): false;
					$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
					$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
					
					@mail($emailTo, $subject, $body, $headers);

					if($sendCopy == true) {
						$subject = 'You emailed Your Name';
						$headers = 'From: Your Name <noreply@somedomain.com>';
						mail($email, $subject, $body, $headers);
					}

					$emailSent = true;

				}
			}
		} 
		
		// Translator words
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_name = get_option(THEME_SHORT_NAME.'_translator_name_contact_widget', 'Name');
			$translator_email = get_option(THEME_SHORT_NAME.'_translator_email_contact_widget', 'Email');
			$translator_message = get_option(THEME_SHORT_NAME.'_translator_message_contact_widget', 'Message');
			$translator_require = get_option(THEME_SHORT_NAME.'_translator_require_contact_widget', '* Require');
			$translator_submit = get_option(THEME_SHORT_NAME.'_translator_submit_contact_widget', 'Submit');
			$translator_please_wait = get_option(THEME_SHORT_NAME.'_translator_please_wait_contact_widget', 'Please Wait...');
			$translator_send_complete = get_option(THEME_SHORT_NAME.'_translator_sending_complete_contact_widget', 'Thanks! Your email was sent');
		}else{
			$translator_name =  __('Name','gdl_front_end');
			$translator_email = __('Email','gdl_front_end');
			$translator_message = __('Message','gdl_front_end');
			$translator_require = __('* Require','gdl_front_end');
			$translator_submit = __('Submit','gdl_front_end');
			$translator_please_wait = __('Please Wait...','gdl_front_end');
			$translator_send_complete = __('Thanks! Your email was sent','gdl_front_end');
		}
		
		?>
		
		<script type="text/javascript">
			/* Contact Form Widget*/
			jQuery(document).ready(function() {
				jQuery('form#contactForm').submit(function() {
					jQuery('form#contactForm .error').remove();
					var hasError = false;
					jQuery('.requiredField').each(function() {
						if(jQuery.trim(jQuery(this).val()) == '') {
							var labelText = jQuery(this).prev('label').text();
							jQuery(this).parent().append('<div class="error"><?php echo $translator_require; ?></div>');
							hasError = true;
							
						} else if(jQuery(this).hasClass('email')) {
							var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
								var labelText = jQuery(this).prev('label').text();
								jQuery(this).parent().append('<div class="error"><?php echo $translator_require; ?></div>');
								hasError = true;
							}
						}
					});
					
					if(!hasError) {
						jQuery('form#contactForm li.buttons button').fadeOut('normal', function() {
							jQuery(this).parent().append('<?php echo $translator_please_wait; ?>');
						});
						var formInput = jQuery(this).serialize();
						jQuery.post(jQuery(this).attr('action'),formInput, function(data){
							jQuery('form#contactForm').slideUp("fast", function() {				   
								jQuery(this).before('<p class="thanks"><?php echo $translator_send_complete; ?></p>');
							});
						});
					}
					
					return false;
					
				});
			});			
		</script>			
				
		<div class="contact-widget-whole"> 				
					<?php if(isset($hasError) || isset($captchaError)) { ?>
						<p class="error"><?php echo get_option(THEME_SHORT_NAME.'_translator_sending_error_contact_widget','There was an error submitting the form.'); ?><p>
					<?php } ?>
						<div class="contact-widget">
								<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							
									<ol class="forms">
										<li><label><?php echo $translator_name; ?></label>
											<input type="text" name="widget-contactName" id="widget-contactName" value="<?php if(isset($_POST['widget-contactName'])) echo $_POST['widget-contactName'];?>" class="requiredField" />
										</li>
										<?php if(!empty($nameError) && $nameError != '') { ?>
												<span class="error"><?php echo $nameError;?></span>
										<?php } ?>
										<li><label><?php echo $translator_email; ?></label>
											<input type="text" name="widget-email" id="widget-email" value="<?php if(isset($_POST['widget-email']))  echo $_POST['widget-email'];?>" class="requiredField email" />
										</li>
										<?php if(!empty($emailError) && $emailError != '') { ?>
												<span class="error"><?php echo $emailError;?></span>
										<?php } ?>
										<li class="textarea"><label><?php echo $translator_message; ?></label>
											<textarea name="widget-comments" id="widget-commentsText" class="requiredField"><?php if(isset($_POST['widget-comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['widget-comments']); } else { echo $_POST['widget-comments']; } } ?></textarea>
										</li>
										<?php if(!empty($commentError) && $commentError != '') { ?>
												<span class="error"><?php echo $commentError;?></span> 
										<?php } ?>
										<li class="screenReader"><label class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></li>
										<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" class="button"><?php echo $translator_submit; ?></button></li>
									</ol>
								</form>
						</div>
						<div class="clear alignleft"></div>
												
		<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "</div>";
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Contact Widget', 'gdl_back_office'), 'email' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Widget Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" class="width100" />
		</p>		
		
	<?php
	}
}

?>