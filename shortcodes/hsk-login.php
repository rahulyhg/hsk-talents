<?php
/**
*  User Registration form
*/
class HSK_Login_Form
{
	
	function __construct()
	{
		add_shortcode('hsk_login', array($this, 'hsk_login_form'));

		//add_action( 'wp_ajax_nopriv_ajaxlogin', array($this, 'hsk_ajax_login' ));
		add_action('wp_ajax_hsk_ajax_login', array($this,'hsk_ajax_login'));
		add_action('wp_ajax_nopriv_hsk_ajax_login', array($this,'hsk_ajax_login'));

	}
	public function hsk_login_form($atts){
		$attr = shortcode_atts( array(
        	$columns = '3',
        	$bgcolor = '#587ecc',
        	$color = '#fff',
    	), $atts );

    	//echo 'This is registration form';	
		if ( is_user_logged_in() )
        	return '<p class="hsk-warning-msg alert hsk-user-reg-alert-msg">'.hsk_user_name().', '.hsk_logout().'</p>';

		$html = '<div class="hsk-login-form hsk-form-styles">';
			$html .= '<div id="hsk_login_status" class="hsk-result-msg hsk-error-msg"></div>';
			$html .= '<form action="">';
				$html .= '<p>';
					$html .= '<label>'.__('User Name', 'hsktalents').'</label>';
					$html .= '<input type="text" id="user_name" name="user_name" value="" />';
				$html .= '</p>';
				$html .= '<p>';
					$html .= '<label>'.__('Password', 'hsktalents').'</label>';
					$html .= '<input type="password" id="password" name="password" value="" />';
				$html .= '</p>';
				$html .= wp_nonce_field( 'ajax-login-nonce', 'security' );
				$html .= '<p style="clear:both;" class="button">';
				$html .= '<input type="submit" class="hsk-btn-primary" id="hsk_user_login_btn" value="'.__('Login', 'hsktalents').'">';
				if(!empty(hsk_talents_opt_data('forgot_password_page_link')) || (!empty(hsk_talents_opt_data('forgot_password_page_link'))) ) {
					$html .= '<ul>';
						if(!empty(hsk_talents_opt_data('forgot_password_page_link'))){
							$html .= '<li><a href="'.get_the_permalink(hsk_talents_opt_data('forgot_password_page_link')).'">'.get_the_title(hsk_talents_opt_data('forgot_password_page_link')).'</a></li>';
						}
						if(!empty(hsk_talents_opt_data('forgot_password_page_link')))
						$html .= '<li><a href="'.get_the_permalink(hsk_talents_opt_data('reg_page_link')).'">'.get_the_title(hsk_talents_opt_data('reg_page_link')).'</a></li>';
					$html .= '</ul>';
				}
				
			$html .= '</form>';
		$html .= '</div>';
		return $html;

	}
	/**
	 * Ajax User login function
	 */
	function hsk_ajax_login(){
	    // First check the nonce, if it fails the function will break
	    check_ajax_referer( 'ajax-login-nonce', 'security' );
	    // Nonce is checked, get the POST data and sign user on
	    $info = array();
	    $info['user_login'] = $_POST['username'];
	    $info['user_password'] = $_POST['password'];
	    $info['remember'] = true;
	    $user_signon = wp_signon( $info, false );
	    if ( is_wp_error($user_signon) ){
	        echo json_encode(array('loggedin'=>false, 'message'=> hsk_talents_opt_data('login_error_msg', __('Error Login, Please check your user name / password.', 'hsktalents')) ));
	    } else {
	        echo json_encode(array('loggedin'=>true, 'message'=> hsk_talents_opt_data('login_success_msg', __('Pleas Wait, you are logging', 'hsktalents')), 'redirect_url' => esc_url(get_the_permalink(hsk_talents_opt_data('login_success_page_redirect'))) ));
	    }
	    die();
	}
}
new HSK_Login_Form;
?>