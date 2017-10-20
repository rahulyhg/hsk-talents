<?php
/**
* Creating User Registration form
*/
class HSK_Shortlist_Form extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-shortlist-page',
	    __('HSK - Favourite','hsktalents'),
	    array('description' => __('This is used to display the user shortlisted data', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			

		));
		echo $args['before_widget'];
			echo do_shortcode('[hsk_shortlist]');	
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			
		));
		echo '<p>'.__('For Favourite settings click', 'hsktalents').' <a href="'.admin_url().'/admin.php?page=ss-talents&tab=favourite_page">'.__('here', 'hsktalents').'</a</p>';
		
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Shortlist_Form");'));
?>