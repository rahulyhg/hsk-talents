<?php
/**
* Creating Facebook Like
*/
class HSK_Facebook_Likebox extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-facebook-likebox',
	    __('HSK - Facebook Likebox','hsktalents'),
	    array('description' => __('This is used to display facebook likebox widget, with faces', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'facebook_page' => '',
			'show_faces' => 'true',
			'data_stream' => 'true',
			'height' => '400',
			'show_header' => 'true',
		));
		echo $args['before_widget'];
			echo '<div class="fb-like-box" data-href="http://www.facebook.com/'.$instance['facebook_page'].'" data-width=""data-header="'.$instance['height'].'"  data-show-faces="'.$instance['show_faces'].'" data-stream="'.$instance['data_stream'].'" data-header="'.$instance['show_header'].'"></div>';
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'facebook_page' => '',
			'show_faces' => 'true',
			'data_stream' => 'true',
			'height' => '400',
			'show_header' => 'true',
		));
		?>
		<p>
		  	<label for="<?php echo $this->get_field_id('facebook_page'); ?>"><?php _e('Facebook Page Name', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('facebook_page') ?>" id="<?php echo $this->get_field_id('facebook_page') ?>" class="widefat" value="<?php echo $instance['facebook_page'] ?>" />
		  	<small>Ex:sitesspark</small>
		</p>
		<p>
			<label for="show_faces"><?php _e('Show Faces', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('show_faces') ?>" name="<?php echo $this->get_field_name('show_faces') ?>">
	        	<option value="true" <?php selected('true', $instance['show_faces']) ?>><?php _e('True', 'hsktalents') ?></option>
	        	<option value="false" <?php selected('false', $instance['show_faces']) ?>><?php _e('False', 'hsktalents') ?></option>
	        </select>
		</p>
		<p>
			<label for="data_stream"><?php _e('Stream', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('data_stream') ?>" name="<?php echo $this->get_field_name('data_stream') ?>">
	        	<option value="true" <?php selected('true', $instance['data_stream']) ?>><?php _e('True', 'hsktalents') ?></option>
	        	<option value="false" <?php selected('false', $instance['data_stream']) ?>><?php _e('False', 'hsktalents') ?></option>
	        </select>
		</p>
		<p>
			<label for="show_header"><?php _e('Show Header', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('show_header') ?>" name="<?php echo $this->get_field_name('show_header') ?>">
	        	<option value="true" <?php selected('true', $instance['show_header']) ?>><?php _e('True', 'hsktalents') ?></option>
	        	<option value="false" <?php selected('false', $instance['show_header']) ?>><?php _e('False', 'hsktalents') ?></option>
	        </select>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="widefat" value="<?php echo $instance['height'] ?>" />px
		</p>
		<?php 
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Facebook_Likebox");'));
?>