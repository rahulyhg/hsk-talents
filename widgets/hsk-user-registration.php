<?php
/**
* Creating User Registration form
*/
class HSK_User_Registration_Form extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-user-registration-form',
	    __('HSK - User Registration Form','hsktalents'),
	    array('description' => __('This is used to create user registration form based on user roles', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			

		));
		echo $args['before_widget'];
			echo do_shortcode('[hsk_registration]');	
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			
		));
		echo '<p>'.__('For user registration form settings click', 'hsktalents').' <a href="'.admin_url().'/admin.php?page=ss-talents&tab=reg_login">'.__('here', 'hsktalents').'</a</p>';
		
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_User_Registration_Form");'));
?>