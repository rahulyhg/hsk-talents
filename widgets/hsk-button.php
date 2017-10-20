<?php
/**
* Creating Icon Boxes
*/
class HSK_Button extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-button',
	    __('HSK - Button','hsktalents'),
	    array('description' => __('Display more button and link where you want', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'name' => 'Your Button Name',
	        'link' => '#',
	        'btn_bg_color' => '#d22a78',
	        'btn_hover_bg_color' => '#689a01',
	        'btn_color' => '#ffffff',
	        'btn_hover_color' => '#ffffff',
	        'font_size' => '15',
	        'padding_left_right' => '20',
	        'padding_top_bottom' => '10',
	        'border_radius_top' => '0',
	        'border_radius_right' => '0',
	        'border_radius_bottom' => '0',
	        'border_radius_left' => '0',
	        'position' => 'left',
	        'letter_space' => '0',
	        'font_weight' => 'normal',

		));
		echo $args['before_widget'];
			echo do_shortcode('[hsk_button link="'.$instance['link'].'" name="'.$instance['name'].'" btn_bg_color="'.$instance['btn_bg_color'].'" btn_color="'.$instance['btn_color'].'"  btn_hover_bg_color="'.$instance['btn_hover_bg_color'].'" btn_hover_color="'.$instance['btn_hover_color'].'"   font_weight="'.$instance['font_weight'].'" font_size="'.$instance['font_size'].'" padding_top_bottom="'.$instance['padding_top_bottom'].'" padding_left_right="'.$instance['padding_left_right'].'" border_radius_top="'.$instance['border_radius_top'].'"  border_radius_right="'.$instance['border_radius_right'].'" border_radius_bottom="'.$instance['border_radius_bottom'].'" border_radius_left="'.$instance['border_radius_left'].'" letter_space="'.$instance['letter_space'].'" position="'.$instance['position'].'" ]');	
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'name' => 'Your Button Name',
	        'link' => '#',
	        'btn_bg_color' => '#d22a78',
	        'btn_hover_bg_color' => '#689a01',
	        'btn_color' => '#ffffff',
	        'btn_hover_color' => '#ffffff',
	        'font_size' => '15',
	        'padding_left_right' => '20',
	        'padding_top_bottom' => '10',
	        'border_radius_top' => '0',
	        'border_radius_right' => '0',
	        'border_radius_bottom' => '0',
	        'border_radius_left' => '0',
	        'position' => 'left',
	        'letter_space' => '0',
	        'font_weight' => 'normal',
		)); 
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsktalents-button').wpColorPicker();
            });
        </script>
        <div class="widgets-fields-group-panel">
	     	<h4><?php _e('Image Content Settings', 'hsktalents') ?></h4>
		<p>
		  	<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Button Name', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('name') ?>" id="<?php echo $this->get_field_id('name') ?>" class="widefat" value="<?php echo $instance['name'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Button Link', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('link') ?>" id="<?php echo $this->get_field_id('link') ?>" class="widefat" value="<?php echo $instance['link'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('btn_bg_color'); ?>"><?php _e('Button Background Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('btn_bg_color') ?>" id="<?php echo $this->get_field_id('btn_bg_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['btn_bg_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('btn_color'); ?>"><?php _e('Button Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('btn_color') ?>" id="<?php echo $this->get_field_id('btn_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['btn_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('btn_hover_bg_color'); ?>"><?php _e('Button Hover Background Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('btn_hover_bg_color') ?>" id="<?php echo $this->get_field_id('btn_hover_bg_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['btn_hover_bg_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('btn_hover_color'); ?>"><?php _e('Button Hover Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('btn_hover_color') ?>" id="<?php echo $this->get_field_id('btn_hover_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['btn_hover_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('font_size'); ?>"><?php _e('Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('font_size') ?>" id="<?php echo $this->get_field_id('font_size') ?>" class="small-text" value="<?php echo $instance['font_size'] ?>" />px
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('padding_top_bottom'); ?>"><?php _e('Padding Top & Bottom', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('padding_top_bottom') ?>" id="<?php echo $this->get_field_id('padding_top_bottom') ?>" class="small-text" value="<?php echo $instance['padding_top_bottom'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('padding_left_right'); ?>"><?php _e('Padding Left & Right', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('padding_left_right') ?>" id="<?php echo $this->get_field_id('padding_left_right') ?>" class="small-text" value="<?php echo $instance['padding_left_right'] ?>" />px
		</p>
		
		<p>
		  	<label for="<?php echo $this->get_field_id('letter_space'); ?>"><?php _e('Letter Space', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('letter_space') ?>" id="<?php echo $this->get_field_id('letter_space') ?>" class="small-text" value="<?php echo $instance['letter_space'] ?>" />px
		</p> 
		<p class="measurement-inputs">
		  	<label for="<?php echo $this->get_field_id('border_radius_top'); ?>"><?php _e('Icon Border Radius', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('border_radius_top') ?>" placeholder="<?php _e('Top', 'hsktalents') ?>" id="<?php echo $this->get_field_id('border_radius_top') ?>" class="small-text" value="<?php echo $instance['border_radius_top'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('border_radius_right') ?>" id="<?php echo $this->get_field_id('border_radius_right') ?>" placeholder="<?php _e('Right', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['border_radius_right'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('border_radius_bottom') ?>" id="<?php echo $this->get_field_id('border_radius_bottom') ?>" placeholder="<?php _e('Bottom', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['border_radius_bottom'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('border_radius_left') ?>" id="<?php echo $this->get_field_id('border_radius_left') ?>" class="small-text" placeholder="<?php _e('Left', 'hsktalents') ?>" value="<?php echo $instance['border_radius_left'] ?>" />Px
		</p>
		<p>
			<label for="position"><?php _e('Button Position', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('position') ?>" name="<?php echo $this->get_field_name('position') ?>">
	        	<option value="left" <?php selected('left', $instance['position']) ?>><?php _e('Left','hsktalents') ?></option>
	        	<option value="right" <?php selected('right', $instance['position']) ?>><?php _e('Right','hsktalents') ?></option>
	        	<option value="center" <?php selected('center', $instance['position']) ?>><?php _e('Center','hsktalents') ?></option>
	        </select>
		</p>

		<p>
			<label for="font_weight"><?php _e('Button Font Weight', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('font_weight') ?>" name="<?php echo $this->get_field_name('font_weight') ?>">
	        	<option value="normal" <?php selected('normal', $instance['font_weight']) ?>><?php _e('Normal','hsktalents') ?></option>
	        	<option value="400" <?php selected('medium', $instance['font_weight']) ?>><?php _e('Medium','hsktalents') ?></option>
	        	<option value="700" <?php selected('700', $instance['font_weight']) ?>><?php _e('Bold','hsktalents') ?></option>
	        </select>
		</p>
	</div>	
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Button");'));
?>