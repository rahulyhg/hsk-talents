<?php
/**
* Custimize Admin Dashboard Widget
*/
class HSK_Admin_Dashboard_Widgets
{
	
	function __construct()
	{
		if ( !current_user_can('manage_options') ){
			add_action('wp_dashboard_setup', array(&$this,'hsk_add_admin_user_talent_profiles_widget'));
			add_action('wp_dashboard_setup', array(&$this, 'hsk_user_profile_information'));

		}
	}
	
	/**
	 * Current User Created Postes
	 */
	function hsk_admin_user_talent_profiles_widget() {
		$settings = get_option( "hsk_user_dashboard" );
		echo $settings['user_dashbaord_welcome_message'];
	}
	/**
	 * Creating Custom Dashboard widget
	 */
	function hsk_add_admin_user_talent_profiles_widget() {
		$settings = get_option( "hsk_user_dashboard" );
		wp_add_dashboard_widget('hsk_admin_user_talent_profiles_widget', !empty($settings['user_dashbaord_welcome_message_title']) ? $settings['user_dashbaord_welcome_message_title'] : __('User Talent Profiles', 'hsktalents'), array(&$this, 'hsk_admin_user_talent_profiles_widget'));
	}
	/**
	 * Creating User information widget
	 */
	function hsk_user_profile_information() {
		global $wp_meta_boxes;
		wp_add_dashboard_widget('hsk_talent_profile_info', __('User Information', 'hsktalents'), array(&$this, 'hsk_user_info_widget'));
	}

	function hsk_user_info_widget() {
		global $current_user;
		wp_get_current_user();
		echo '<p>Welcome, <strong>'.esc_attr($current_user->display_name).'</strong>,  <a href="'.admin_url( 'profile.php' ).'">'.__('My Profile', 'hsktalents').'</a> | <a href="'.wp_logout_url().'">'.__('Logout', 'hsktalents').'</a></p>';
		echo '<ul>';
			echo '<li><strong>'.__('Your Role', 'hsktalents').'</strong>: '.esc_attr($current_user->roles[0]).'</li>';
			echo '<li><strong>'.__('Email', 'hsktalents').'</strong> : '.esc_attr($current_user->user_email).'</li>';
			if( !empty(get_the_author_meta( 'hsk_phone', $current_user->ID )) ){
				echo '<li><strong>'.__('Phone', 'hsktalents').'</strong> : '.get_the_author_meta( 'hsk_phone', $current_user->ID ).'</li>';
			}
		echo '</ul>';
	}
// End Class	
}
new HSK_Admin_Dashboard_Widgets;
?>