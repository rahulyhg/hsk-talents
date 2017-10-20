<?php
/**
* Creating User Update Profile
*/
class HSK_User_Profile
{
	
	function __construct()
	{
		add_shortcode('hsk_user_profile', array($this, 'hsk_user_profile_form'));
	}
	/**
	 * Creating User Profile Form & Updating User data
	 */
	function hsk_user_profile_form(){ 
		global $current_user, $wp_roles, $error;
		$error = array();    
		$html = '';
		/* If profile was saved, update profile. */
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
			/* Update user password. */
			if ( !empty($_POST['hsk_password'] ) && !empty( $_POST['hsk_re_password'] ) ) {
				if ( $_POST['hsk_password'] == $_POST['hsk_re_password'] )
					wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['hsk_password'] ) ) );
				else
					$error[] = esc_attr(hsk_talents_opt_data('profile_update_pwd_error', __('The passwords you entered do not match. Your password was not updated', 'hsktalents')));
			}
			/* Update user information. */
			if ( !empty( $_POST['url'] ) )
				wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
			if ( !empty( $_POST['email'] ) ){
				if (!is_email(esc_attr( $_POST['email'] )))
				$error[] = esc_attr(hsk_talents_opt_data('email_validate_error', __('Enter Valid Email', 'hsktalents')));
				elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
				$error[] = esc_attr(hsk_talents_opt_data('email_exist_error', __('This Email Already exist, please try with Different  Email', 'hsktalents')));
				else{
				wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
				}
			}

			if ( !empty( $_POST['first-name'] ) )
				update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
			if ( !empty( $_POST['hsk_phone'] ) )
				update_user_meta( $current_user->ID, 'hsk_phone', esc_attr( $_POST['hsk_phone'] ) );
			if ( !empty( $_POST['last-name'] ) )
				update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
			if ( !empty( $_POST['description'] ) )
				update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

			/* Redirect so the page will show updated info.*/
			if ( count($error) == 0 ) {
				//action hook for plugins and extra fields saving
				do_action('edit_user_profile_update', $current_user->ID);
				wp_redirect( get_permalink() .'?update=true'  );
				exit;
			}
		}
		?>
		<?php if ( !is_user_logged_in() ){ ?>
			<p class="warning">
			<?php echo hsk_talents_opt_data('user_logged_in_msg', __('You must be logged in to edit your profile.', 'hsktalents')); ?>
			</p><!-- .warning -->
		<?php } else{
			if(isset($_REQUEST['update']) && ( $_REQUEST['update'] == 'true' )){
				echo '<div class="hsk-result-message hsk-success-msg alert">'.esc_attr(hsk_talents_opt_data('profile_update_success_msg', __('Your Profile has been updated successfully', 'hsktalents'))).'</div>';
			}
			if(isset($_REQUEST['update']) && ( $_REQUEST['update'] == 'fail' )){
				echo '<div class="hsk-result-message hsk-error-msg alert">'.esc_attr( hsk_talents_opt_data('profile_update_error_msg', __('Error, While updating your profile', 'hsktalents')) ).'</div>';
			}
			if ( count($error) > 0 ) echo '<p class="error alert hsk-error-msg alert">' . implode("<br />", $error) . '</p>';
			echo '<h3 class="hsk-title-bottom-border">' . __('Update Information for', 'hsktalents') .'  '.$current_user->user_login.'</h3>';
			echo '<form method="post" id="adduser" class="hsk-form-styles" action="">';
				if( !empty(trim(hsk_talents_opt_data('profile_profile_note'))) ){
						echo '<p class="alert hsk-info-msg">'.esc_attr(hsk_talents_opt_data('profile_profile_note')).'</p>';
					}
				
				echo '<p class="form-username hsk-column6">';
					echo '<label for="first-name">'.__('First Name', 'hsktalents').'</label>';
					echo '<input class="text-input" name="first-name" type="text" id="first-name" value="'.get_the_author_meta( 'first_name', $current_user->ID ).'" />';
				echo '</p>'; //username
				echo '<p class="form-username hsk-column6">';
					echo '<label for="last-name">'.__('Last Name', 'hsktalents').'</label>';
					echo '<input class="text-input" name="last-name" type="text" id="last-name" value="'.get_the_author_meta( 'last_name', $current_user->ID ).'" />';
				echo '</p>'; //form-username
				echo '<p class="form-email hsk-column6">';
					echo '<label for="email">'.__('E-mail *', 'hsktalents').'</label>';
					echo '<input class="text-input" name="email" type="text" id="email" value="'.get_the_author_meta( 'user_email', $current_user->ID ).'" />';
				echo '</p>';//-- email -->
				echo '<p class="form-url hsk-column6">';
					echo '<label for="url">'.__('Website', 'hsktalents').'</label>';
					echo '<input class="text-input" name="url" type="text" id="url" value="'.get_the_author_meta( 'user_url', $current_user->ID ).'" />';
				echo '</p>'; //url -->
				echo '<p class="form-contact hsk-column6">';
					echo '<label for="url">'.__('Contact Number', 'hsktalents').'</label>';
					echo '<input class="text-input" name="hsk_phone" type="text" id="hsk_phone" value="'.get_the_author_meta( 'hsk_phone', $current_user->ID ).'" />';
				echo '</p>'; //-url -->
				
				//action hook for plugin and extra fields
				do_action('edit_user_profile',$current_user); 
				echo '<p class="form-password hsk-column6">';
					echo '<label for="hsk_password">'.__('Password *', 'hsktalents').'</label>';
					echo '<input class="text-input" name="hsk_password" type="password" id="hsk_password" />';
				echo '</p>'; // password -->
				echo '<p class="form-password hsk-column6">';
					echo '<label for="hsk_re_password">'.__('Repeat Password *', 'hsktalents').'</label>';
					echo '<input class="text-input" name="hsk_re_password" type="password" id="hsk_re_password" />';
				echo '</p>'; //password -->
				echo '<p class="form-textarea hsk-column12">';
					echo '<label for="description">'.__('Biographical Information', 'hsktalents').'</label>';
					echo '<textarea name="description" id="description" rows="3" cols="50">'.get_the_author_meta( 'description', $current_user->ID ).'</textarea>';
				echo '</p>'; //textarea -->
				echo '<p class="form-submit button">';
					
					echo '<input name="updateuser" class="hsk-btn-primary" type="submit" id="updateuser" class="submit button" value="'. esc_attr(hsk_talents_opt_data('profile_update_button_text',__('Update Profile', 'hsktalents'))).'" />';
					wp_nonce_field( 'update-user' );
					echo '<input name="action" type="hidden" id="action" value="update-user" />';
				echo '</p>'; //<!-- .form-submit -->
			echo '</form>'; // #adduser -->
			//echo $html;
	 }
	}
// End Class	
}
new HSK_User_Profile;
?>