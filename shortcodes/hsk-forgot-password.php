<?php
/**
*  User Registration form
*/
class HSK_Forgot_Password_Form
{
	
	function __construct()
	{
		add_shortcode('hsk_forgot_password', array($this, 'hsk_forgot_pwd_form'));	
	}
	public function hsk_forgot_pwd_form($attr){
		$attr = shortcode_atts( array(
        	$columns = '3',
        	$bgcolor = '#587ecc',
        	$color = '#fff',
    	), $attr );

    	//echo 'This is registration form';
		if ( is_user_logged_in() )
        	return '<p class="hsk-warning-msg alert hsk-user-reg-alert-msg">'.hsk_user_name().', '.hsk_logout().'</p>';
        
        $html ='';
		$html .= '<div class="hsk-forgot-password-form hsk-form-styles">';
			$html .= '<form action="">';
				$html .= '<div class="hsk-column12">';
					if( !empty(hsk_talents_opt_data('forgot_password_form_msg')) ){
						$html .= '<p class="alert hsk-info-msg">'.esc_attr(hsk_talents_opt_data('forgot_password_form_msg')).'<br /></p>';
					}
					$html .= '<p>';
						$html .= '<label>'.__('Email', 'hsktalents').'</label>';
						$html .= '<input type="text" name="user_email" value="" />';
					$html .= '</p>';
					$html .= '<p style="clear:both;" class="button">';
				$html .= '<input type="submit"  class="hsk-btn-primary" value="'.esc_attr(hsk_talents_opt_data('forgot_password_button_text', __('Forgot Password', 'hsktalents'))).'">';
				$html .= '</div>';
			$html .= '</form>';
		$html .= '</div>';
		return $html;

	}
}
new HSK_Forgot_Password_Form;
?>