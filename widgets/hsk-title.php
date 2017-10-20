<?php
/**
* Creating Page Titlebar
*/
class HSK_Custom_Title extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-add-page-title',
	    __('HSK - Title & Description','hsktalents'),
	    array('description' => __('Add custom title along with title descriptions', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'title' => __('Welcome to Sites Spark', 'hsktalents'),
			'align' => 'left',
			'description' => '',
			'margin_bottom' => '30',
			'title_color' => '#353535',
			'desc_color' => '#757575',
			'title_font_size' => '18',
			'desc_font_size' => '14',
			'title_bottom_border_url' => '',
			'border_img_width' => '30',
			'disable_bottom_border' => '',
			'title_font_weight' => 'normal',
			'desc_font_weight' => 'normal',
			'bottom_border_color' => '#e5e5e5',
			'border_strip_color' => '#d22a78',
		));
		echo $args['before_widget'];
			echo do_shortcode('[title title="'.$instance['title'].'" title_font_weight="'.$instance['title_font_weight'].'" title_bottom_border_url="'.$instance['title_bottom_border_url'].'" border_img_width="'.$instance['border_img_width'].'" align="'.$instance['align'].'" margin_bottom="'.$instance['margin_bottom'].'" title_color="'.$instance['title_color'].'" desc_color="'.$instance['desc_color'].'" title_font_size="'.$instance['title_font_size'].'" desc_font_weight = "'.$instance['desc_font_weight'].'" desc_font_size="'.$instance['desc_font_size'].'" disable_bottom_border="'.$instance['disable_bottom_border'].'" bottom_border_color="'.$instance['bottom_border_color'].'" border_strip_color="'.$instance['border_strip_color'].'" ]'.$instance['description'].'[/title]');
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'title' => __('Add Your Custom Title', 'hsktalents'),
			'description' => '',
			'align' => 'left',
			'margin_bottom' => '30',
			'title_color' => '#353535',
			'desc_color' => '#757575',
			'title_font_size' => '18',
			'desc_font_size' => '14',
			'title_bottom_border_url' => '',
			'border_img_width' => '30',
			'disable_bottom_border' => '',
			'title_font_weight' => 'normal',
			'desc_font_weight' => 'normal',
			'bottom_border_color' => '#e5e5e5',
			'border_strip_color' => '#d22a78',
		)); 
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsk-title-color').wpColorPicker();
            });
        </script>
		<p>
		  	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Custom Title', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" />
		</p>
		<p>
			<label for="description"><?php esc_html_e('Description', 'hsktalents'); ?></label>
		  	<textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?> </textarea>
		</p>
		<p>
			<label for="align"><?php esc_html_e('Title & Description Position', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('align') ?>" name="<?php echo $this->get_field_name('align') ?>">
	        	<option value="left" <?php selected('left', $instance['align']) ?>><?php esc_html_e('Left','hsktalents') ?></option>
	        	<option value="right" <?php selected('right', $instance['align']) ?>><?php esc_html_e('Right','hsktalents') ?></option>
	        	<option value="center" <?php selected('center', $instance['align']) ?>><?php esc_html_e('Center','hsktalents') ?></option>
	        </select>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_bottom_border_url'); ?>"><?php esc_html_e('Enter Title Border Bottom Image URL', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_bottom_border_url') ?>" id="<?php echo $this->get_field_id('title_bottom_border_url') ?>" class="widefat" value="<?php echo $instance['title_bottom_border_url'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('border_img_width'); ?>"><?php esc_html_e('Enter Title Border Bottom Width', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('border_img_width') ?>" id="<?php echo $this->get_field_id('border_img_width') ?>" class="small-width" value="<?php echo $instance['border_img_width'] ?>" />%
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php esc_html_e('Title Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat hsk-title-color" value="<?php echo $instance['title_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('desc_color'); ?>"><?php esc_html_e('Description Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat hsk-title-color" value="<?php echo $instance['desc_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('title_font_size'); ?>"><?php esc_html_e('Title Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-width" value="<?php echo $instance['title_font_size'] ?>" />px
		</p>
		<p>
			<label for="title_font_weight"><?php esc_html_e('Title Font Weight', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
	        	<option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>><?php esc_html_e('Normal','hsktalents') ?></option>
	        	<option value="400" <?php selected('400', $instance['title_font_weight']) ?>><?php esc_html_e('Medium','hsktalents') ?></option>
	        	<option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>><?php esc_html_e('Bold','hsktalents') ?></option>
	        </select>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('desc_font_size'); ?>"><?php esc_html_e('Description Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_font_size') ?>" id="<?php echo $this->get_field_id('desc_font_size') ?>" class="small-width" value="<?php echo $instance['desc_font_size'] ?>" />px
		</p>
		<p>
			<label for="desc_font_weight"><?php esc_html_e('Description Font Weight', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('desc_font_weight') ?>" name="<?php echo $this->get_field_name('desc_font_weight') ?>">
	        	<option value="normal" <?php selected('normal', $instance['desc_font_weight']) ?>><?php esc_html_e('Normal','hsktalents') ?></option>
	        	<option value="400" <?php selected('400', $instance['desc_font_weight']) ?>><?php esc_html_e('Medium','hsktalents') ?></option>
	        	<option value="bold" <?php selected('bold', $instance['desc_font_weight']) ?>><?php esc_html_e('Bold','hsktalents') ?></option>
	        </select>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('bottom_border_color'); ?>"><?php esc_html_e('Title & Description Bottom Border Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('bottom_border_color') ?>" id="<?php echo $this->get_field_id('bottom_border_color') ?>" class="widefat hsk-title-color" value="<?php echo $instance['bottom_border_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('border_strip_color'); ?>"><?php esc_html_e('Bottom Border Strip Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('border_strip_color') ?>" id="<?php echo $this->get_field_id('border_strip_color') ?>" class="widefat hsk-title-color" value="<?php echo $instance['border_strip_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('margin_bottom'); ?>"><?php esc_html_e('Margin Bottom', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('margin_bottom') ?>" id="<?php echo $this->get_field_id('margin_bottom') ?>" class="small-width" value="<?php echo $instance['margin_bottom'] ?>" />px
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('disable_bottom_border') ?>">  <?php esc_html_e('Disable Title Bottom Border', 'hsktalents')?>  </label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_bottom_border"); ?>" name="<?php echo $this->get_field_name("disable_bottom_border"); ?>"<?php checked( (bool) $instance["disable_bottom_border"], true ); ?> />
		</p>

		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Custom_Title");'));
?>