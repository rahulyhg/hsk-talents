<?php
/**
* Creating Icon Boxes
*/
class Talenthub_HSK_Icon_Box extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-icon-box',
	    __('HSK - Icon Box','hsktalents'),
	    array('description' => __('This is used to display the icon box with title and description', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'icon' => 'fa-home',
			'icon_box_style' => '1',
			'title' => __('Icon Title','hsktalents'),
			'description' => __('Icon Desciption','hsktalents'),
			'icon_bg_color' => '#242730',
			'icon_color' => '#fff',
			'color' => '#d22a78',
			'title_color' => '#333',
			'desc_color' => '#787878',
			'title_font_size' => '16',
			'icon_size' => '18',
			'desc_size' => '14',
			'icon_align' => 'left',
			'style' => '1',
			'icon_border_color' => '',
			'content_border_color' => '',
			'icon_border_radius' => '',			
			'icon_border_radius_t' => '',
			'icon_border_radius_b' => '',
			'icon_border_radius_l' => '',
			'icon_border_radius_r' => '',
			'content_bg_color' => '#f8f8f8',
			'container_padding' => '15',
			'title_font_weight' => 'normal',
			'desc_font_size' => '14',
		));
		echo $args['before_widget'];
			echo do_shortcode('[icon_box style="'.$instance['icon_box_style'].'" icon="'.$instance['icon'].'" title="'.$instance['title'].'" description="'.$instance['description'].'" icon_align="'.$instance['icon_align'].'" icon_bg_color="'.$instance['icon_bg_color'].'" icon_color="'.$instance['icon_color'].'" icon_size="'.$instance['icon_size'].'" icon_border_color="'.$instance['icon_border_color'].'" icon_border_radius_t="'.$instance['icon_border_radius_t'].'" icon_border_radius_r="'.$instance['icon_border_radius_r'].'" icon_border_radius_b="'.$instance['icon_border_radius_b'].'" icon_border_radius_l="'.$instance['icon_border_radius_l'].'" title_color="'.$instance['title_color'].'" desc_color="'.$instance['desc_color'].'" desc_size="'.$instance['desc_font_size'].'" content_border_color="'.$instance['content_border_color'].'" title_size="'.$instance['title_font_size'].'" title_weight="'.$instance['title_font_weight'].'" container_padding="'.$instance['container_padding'].'" content_bg_color="'.$instance['content_bg_color'].'" ] ');
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'icon' => 'fa-home',
			'icon_box_style' => '1',
			'title' => __('Icon Title','hsktalents'),
			'description' => __('Icon Desciption','hsktalents'),
			'icon_bg_color' => '#242730',
			'icon_color' => '#fff',
			'color' => '#d22a78',
			'title_color' => '#333',
			'desc_color' => '#787878',
			'title_font_size' => '16',
			'icon_size' => '18',
			'desc_size' => '14',
			'icon_align' => 'left',
			'style' => '1',
			'icon_border_color' => '',
			'content_border_color' => '',
			'icon_border_radius' => '',			
			'icon_border_radius_t' => '',
			'icon_border_radius_b' => '',
			'icon_border_radius_l' => '',
			'icon_border_radius_r' => '',
			'content_bg_color' => '#f8f8f8',
			'container_padding' => '15',
			'title_font_weight' => 'normal',
			'desc_font_size' => '14',
		)); 
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsk-icon-color').wpColorPicker();
            });
        </script>
        <div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('General Settings', 'hsktalents') ?></h4> 
			<p>
				<label for="icon_box_style"><?php _e('Icon Box Styles', 'hsktalents'); ?></label>
		        <select id="<?php echo $this->get_field_id('icon_box_style') ?>" name="<?php echo $this->get_field_name('icon_box_style') ?>">
		        	<option value="1" <?php selected('1', $instance['icon_box_style']) ?>><?php _e('Style-1','hsktalents') ?></option>
		        	<option value="2" <?php selected('2', $instance['icon_box_style']) ?>><?php _e('Style-2','hsktalents') ?></option>
		        	<option value="3" <?php selected('3', $instance['icon_box_style']) ?>><?php _e('Style-3','hsktalents') ?></option>
		        </select>
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('content_bg_color'); ?>"><?php _e('Container Background Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('content_bg_color') ?>" id="<?php echo $this->get_field_id('content_bg_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['content_bg_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('container_padding'); ?>"><?php _e('Container Padding', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('container_padding') ?>" id="<?php echo $this->get_field_id('container_padding') ?>" class="small-text" value="<?php echo $instance['container_padding'] ?>" />px
			</p>
		</div>
		<div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('Icons Settings', 'hsktalents') ?></h4> 	
			<p>
			  	<label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon Name', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('icon') ?>" id="<?php echo $this->get_field_id('icon') ?>" class="widefat" value="<?php echo esc_attr($instance['icon']) ?>" />
			  	<small><?php _e('For awesome icons click', 'hsktalents');?><a target="_blank" href="<?php echo esc_url('http://fontawesome.io/icons/'); ?>"><?php _e(' here ', 'hsktalents'); ?></a></small>
			</p>

			<p>
			  	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" />
			</p>
			<p>
				<label for="description"><?php _e('Description', 'hsktalents'); ?></label>
			  	<textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?> </textarea>
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('icon_bg_color'); ?>"><?php _e('Icon Background Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('icon_bg_color') ?>" id="<?php echo $this->get_field_id('icon_bg_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['icon_bg_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('icon_color'); ?>"><?php _e('Icon Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('icon_color') ?>" id="<?php echo $this->get_field_id('icon_color') ?>" class="hsk-icon-color" value="<?php echo $instance['icon_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Size', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('icon_size') ?>" id="<?php echo $this->get_field_id('icon_size') ?>" class="small-text" value="<?php echo $instance['icon_size'] ?>" />px
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('icon_border_color'); ?>"><?php _e('Icon Border Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('icon_border_color') ?>" id="<?php echo $this->get_field_id('icon_border_color') ?>" class=" hsk-icon-color" value="<?php echo $instance['icon_border_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('icon_border_radius_t'); ?>"><?php _e('Icon Border Radius', 'hsktalents') ?></label>
			  	<?php _e('Top', 'hsktalents') ?><input type="text" name="<?php echo $this->get_field_name('icon_border_radius_t') ?>" id="<?php echo $this->get_field_id('icon_border_radius_t') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_t'] ?>" />
			  	<?php _e('Right', 'hsktalents') ?><input type="text" name="<?php echo $this->get_field_name('icon_border_radius_r') ?>" id="<?php echo $this->get_field_id('icon_border_radius_r') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_r'] ?>" />
			  	<?php _e('Bottom', 'hsktalents') ?><input type="text" name="<?php echo $this->get_field_name('icon_border_radius_b') ?>" id="<?php echo $this->get_field_id('icon_border_radius_b') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_b'] ?>" />
			  	<?php _e('Left', 'hsktalents') ?><input type="text" name="<?php echo $this->get_field_name('icon_border_radius_l') ?>" id="<?php echo $this->get_field_id('icon_border_radius_l') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_l'] ?>" />px
			</p>
			<p>
				<label for="icon_align"><?php _e('Icon Position', 'hsktalents'); ?></label>
		        <select id="<?php echo $this->get_field_id('icon_align') ?>" name="<?php echo $this->get_field_name('icon_align') ?>">
		        	<option value="left" <?php selected('left', $instance['icon_align']) ?>><?php _e('Left','hsktalents') ?></option>
		        	<option value="right" <?php selected('right', $instance['icon_align']) ?>><?php _e('Right','hsktalents') ?></option>
		        	<option value="center" <?php selected('center', $instance['icon_align']) ?>><?php _e('Center','hsktalents') ?></option>
		        </select>
			</p>
		</div>
		<div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('Title Settings', 'hsktalents') ?></h4> 
			<p>
			  	<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['title_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('title_font_size'); ?>"><?php _e('Title Font Size', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-width" value="<?php echo $instance['title_font_size'] ?>" />px
			</p>
			
			<p>
				<label for="title_font_weight"><?php _e('Title Font Weight', 'hsktalents'); ?></label>
		        <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
		        	<option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>><?php _e('Normal','hsktalents') ?></option>
		        	<option value="400" <?php selected('400', $instance['title_font_weight']) ?>><?php _e('Medium','hsktalents') ?></option>
		        	<option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>><?php _e('Bold','hsktalents') ?></option>
		        </select>
			</p>
		</div>
		<div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('Description Settings', 'hsktalents') ?></h4> 
			<p>
			  	<label for="<?php echo $this->get_field_id('desc_color'); ?>"><?php _e('Description Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['desc_color'] ?>" />
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('desc_font_size'); ?>"><?php _e('Description Font Size', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('desc_font_size') ?>" id="<?php echo $this->get_field_id('desc_font_size') ?>" class="small-text" value="<?php echo $instance['desc_font_size'] ?>" />px
			</p>
			<p>
			  	<label for="<?php echo $this->get_field_id('content_border_color'); ?>"><?php _e('Content Border Color', 'hsktalents') ?></label>
			  	<input type="text" name="<?php echo $this->get_field_name('content_border_color') ?>" id="<?php echo $this->get_field_id('content_border_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['content_border_color'] ?>" />
			</p>
		</div>	
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("Talenthub_HSK_Icon_Box");'));
?>