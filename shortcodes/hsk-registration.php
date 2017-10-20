<?php
/**
*  User Registration form
*/
class HSK_Registration
{	
	function __construct()
	{
		add_shortcode('hsk_registration', array($this, 'hsk_registration_form'));
		add_action('wp_ajax_hsk_register_user', array($this,'hsk_new_user_registration'));
		add_action('wp_ajax_nopriv_hsk_register_user', array($this,'hsk_new_user_registration'));
	
	}
	public function hsk_registration_form($atts){
		$attr = shortcode_atts( array(
        	$columns = '3',
        	$bgcolor = '#587ecc',
        	$color = '#fff',
        	$role_title = __('Tell us who you are', 'hsktalents'),
    	), $atts );

		$all_user_roles = hsk_get_all_roles();
		$excelde_roles = array('administrator');
		$user_roles = array_diff(array_keys($all_user_roles), $excelde_roles);
		//echo 'This is registration form';
		if ( is_user_logged_in() )
        	return '<p class="hsk-warning-msg alert hsk-user-reg-alert-msg">'.hsk_user_name().', '.hsk_logout().'</p>';
        
		$html = '<div class="hsk-registration-form hsk-form-styles">';
			// $html .= '<h3 class="hsk-title-bottom-border">'.__('User Registration Form', 'hsktalents').'</h3>';
			$html .= '<div class="hsk-loading" style="display:none;">'.__('Please wait...', 'hsktalents').'</div>';
			$html .= '<div class="hsk-result-message alert hsk-success-msg"  style="display:none;">'.hsk_talents_opt_data('reg_success_msg', __('You have success fully registred', 'hsktalents')).'</div>';
    		$html .= '<div class="hsk-result-message "></div>';
			$html .= '<form action="" method="post">';
				if( !empty($user_roles) ){
					$html.=  '<p  class="hsk-column12">';
    					$html .= '<select required id="hsk_user_role" name="user_role">';
    						$html .= '<option value="">'.(!empty($attr['role_title']) ? esc_attr($attr['role_title']) :__('Tell us who you are', 'hsktalents')).'</option>';
		    				foreach ($user_roles as $role_key => $user_role) {
		    					$html .= '<option value="'.esc_attr($user_role).'">'.esc_attr($user_role).'</option>';
		    				}
		    			$html .= '</select>';
	    			$html .= '</p>';
    			}
				$html .= '<p class="hsk-column4">';
					$html .= '<label>'.__('User Name', 'hsktalents').'</label>';
					$html .= '<input type="text" name="hsk_user_name" id="hsk_user_name" value="" />';
				$html .= '</p>';
				$html .= '<p class="hsk-column4">';
					$html .= '<label>'.__('First Name', 'hsktalents').'</label>';
					$html .= '<input type="text" name="hsk_fname" id="hsk_fname" value="" />';
				$html .= '</p>';
				$html .= '<p class="hsk-column4 hsk-last">';
					$html .= '<label>'.__('Last Name', 'hsktalents').'</label>';
					$html .= '<input type="text" name="hsk_lname" id="hsk_lname" value="" />';
				$html .= '</p>';
				$html .= '<p class="hsk-column4">';
					$html .= '<label>'.__('Email', 'hsktalents').'</label>';
					$html .= '<input type="text" name="hsk_email" id="hsk_email" value="" />';
				$html .= '</p>';
				$html .= '<p class="hsk-column4">';
					$html .= '<label>'.__('Phone Number', 'hsktalents').'</label>';
					$html .= '<input type="number" name="hsk_phone_number" id="hsk_phone_number" value="" />';
				$html .= '</p>';
				wp_nonce_field('hsk_user_add','hsk_user_add_nonce', true, true );
				$html .= '<p style="clear:both;" class="">';
				$html .= '<input type="submit" class="hsk-btn-primary" id="hsk_user_reg_submit" value="'.hsk_talents_opt_data('reg_button_text', __('Signup!!!', 'hsktalents')).'">';
			$html .= '</form>';
		$html .= '</div>';
		return $html;

	}
	function hsk_new_user_registration() {
 
  // Verify nonce
  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'hsk_user_add' ) )
    die( 'Ooops, something went wrong, please try again later.' );
 
    $username = sanitize_text_field( $_POST['hsk_user_name']);
    $fname = sanitize_text_field( $_POST['hsk_fname']);
    $email    = sanitize_text_field( $_POST['hsk_email']);
    $lname     = sanitize_text_field( $_POST['hsk_lname']);
    $hsk_phone_number     = sanitize_text_field( $_POST['hsk_phone_number']);
 	$password = wp_generate_password( 6, true, true );
 	$user_role =$_POST['hsk_user_role'];
    $userdata = array(
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $email,
        'first_name' => $fname,
        'last_name'   => $lname,
        'role' => $user_role
    );

    // Return
    if(email_exists($email) ) {
    	echo hsk_talents_opt_data('email_exist_error', __('This Email Already exist, please try with Different  Email', 'hsktalents'));
    }else{
    	$user_id = wp_insert_user( $userdata );
    	if( !is_wp_error($user_id) ) {
    		$admin_email = get_option('admin_email');
    			$user_confirmation_mail_msg = hsk_talents_opt_data('reg_email_message', __('Your account has been set up and you can log in using the following details. Once you have logged in, please ensure that you visit the Site Admin and change you password so that you dont forget it in the future.', 'hsktalents'));

				$confirmation_subject =  hsk_talents_opt_data('reg_email_subject', __('User Login Details', 'hsktalents')) .get_bloginfo('name');
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "From:".$admin_email."\r\n";
				$headers .= "Reply-To: ".$admin_email."" . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
				$confirmation_message = '<html><body>';
				$confirmation_message .= __('Hi ','hsktalents').$fname.' '.$lname.',<br /></br />'.__(' Thank you for registering with', 'hsktalents').get_bloginfo('name').' '.$user_confirmation_mail_msg.' <br /><br />'
				.'<strong>'.__('Username: ','hsktalents').'</strong> '.trim($username)
				.'<br /><strong>Password:</strong> '.trim($password)
				.'<br /><br />';
				$confirmation_message .=  '</body></html>';// Sending email

				$admin_msg = '<html><body>';
				$admin_msg .= $fname.' '.$name. ' '.__('Registred with', 'hsktalents').' '.get_bloginfo('name').' '.$user_confirmation_mail_msg.' <br /><br />';
				$admin_msg .='<strong>'.__('Email','hsktalents').':</strong> '.$email.'<br /><br />';			
				$admin_msg .=  '</body></html>';// Sending email
				$email = wp_mail($email, $confirmation_subject, $confirmation_message, $headers);
				wp_mail($admin_email, $confirmation_subject, $admin_msg, $headers);
	        echo '1';
	    } else {
	        echo $user_id->get_error_message();
	    }
	}
  die();
 
}
}
new HSK_Registration;
?>