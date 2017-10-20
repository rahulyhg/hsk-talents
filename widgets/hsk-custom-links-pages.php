<?php
class HSK_Custom_Links_Fields_Widget extends WP_Widget{
	public function __construct(){
		parent::__construct('hsk-custom-link-fields',__('HSK - Custom Links','hsktalents'),
			array('description' => __('This widget is used to create custom links  and as well as display logout link if it is enable.','hsktalents'))
		);
	}
	public function widget( $args,$instance){
		$instance = wp_parse_args($instance,array(
			'custom_link_title1' => '',
			'custom_link_title2' => '',
			'custom_link_title3' => '',
			'custom_link_title4' => '',
			'custom_link_title5' => '',
			'custom_link_title6' => '',
			'custom_link_title7' => '',
			'custom_link_title8' => '',
			'custom_link_title9' => '',
			'custom_link_title10' => '',
			'custom_link1' => '',
			'custom_link2' => '',
			'custom_link3' => '',
			'custom_link4' => '',
			'custom_link5' => '',
			'custom_link6' => '',
			'custom_link7' => '',
			'custom_link8' => '',
			'custom_link9' => '',
			'custom_link10' => '',
			'enable_logout_link' => '',
			'link_target_location' => '',

		));
		echo $args['before_widget'];
			echo '<div class="custom-links-generate">';
			echo '<ul>';
				$target_location = ( $instance['link_target_location'] == 'on' ) ? '_blank' : '_self';
				for ($i=1; $i < 11; $i++) {
					if( !empty($instance['custom_link_title'.$i]) && !empty($instance['custom_link'.$i]) ){
						echo '<li><a target="'.$target_location.'" href="'.esc_url($instance['custom_link'.$i]).'">'.esc_attr($instance['custom_link_title'.$i]).'</a></li>';
					}
				}
				if( is_user_logged_in() ){
					if( $instance['enable_logout_link'] == 'on' ){
						echo '<li><a href="'.wp_logout_url( get_permalink() ).'">'.__('Logout','hsktalents').'</a></li>';
					}
				}
			echo '</ul>';
			echo '</div>';
		echo $args['after_widget'];
	}
	public function form($instance){
		$instance = wp_parse_args($instance,array(
			'custom_link_title1' => '',
			'custom_link_title2' => '',
			'custom_link_title3' => '',
			'custom_link_title4' => '',
			'custom_link_title5' => '',
			'custom_link_title6' => '',
			'custom_link_title7' => '',
			'custom_link_title8' => '',
			'custom_link_title9' => '',
			'custom_link_title10' => '',
			'custom_link1' => '',
			'custom_link2' => '',
			'custom_link3' => '',
			'custom_link4' => '',
			'custom_link5' => '',
			'custom_link6' => '',
			'custom_link7' => '',
			'custom_link8' => '',
			'custom_link9' => '',
			'custom_link10' => '',
			'enable_logout_link' => '',
			'link_target_location' => '',

		));

		for ($i=1; $i < 11 ; $i++) { 
			echo '<p>';
				echo '<label for="'.$this->get_field_id( 'custom_link_title'.$i ).'" style="display:block; font-weight:bold;">'.__('Add Custom Link & Title - '.$i, 'hsktalents').'</label>';
        		echo '<input class="" type="text" id="'.$this->get_field_id(  'custom_link_title'.$i ).'" Placeholder="'.__('Add Custom Link Title - '.$i, 'hsktalents').'" name="'.$this->get_field_name(  'custom_link_title'.$i ).'" value="'.esc_attr(  $instance['custom_link_title'.$i] ).'">';
        		echo '<input class="" type="text" id="'.$this->get_field_id(  'custom_link'.$i ).'"  Placeholder="'.__('Add Custom Link - '.$i, 'hsktalents').'" name="'.$this->get_field_name(  'custom_link'.$i ).'" value="'.esc_attr(  $instance['custom_link'.$i] ).'">';
    		echo '</p>';
		}

		echo '<p>';
			echo '<label for="'.$this->get_field_id('enable_logout_link').'">'. __('Enable Logout Link', 'hsktalents').'</label>'; ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_logout_link"); ?>" name="<?php echo $this->get_field_name("enable_logout_link"); ?>"<?php checked( (bool) $instance["enable_logout_link"], true ); ?> />
		<?php echo '</p>';

		echo '<p>';
			echo '<label for="'.$this->get_field_id('link_target_location').'">'. __('Enable Target Location Blank page', 'hsktalents').'</label>'; ?>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("link_target_location"); ?>" name="<?php echo $this->get_field_name("link_target_location"); ?>"<?php checked( (bool) $instance["link_target_location"], true ); ?> />
		<?php echo '</p>';
		
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Custom_Links_Fields_Widget");'));
?>