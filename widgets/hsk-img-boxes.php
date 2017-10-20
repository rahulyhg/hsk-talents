<?php
/**
* Creating Image Boxes
*/
class HSK_Image_Box extends WP_Widget
{
	public function __construct(){
	    parent::__construct('hsk-image-box',
	    __('HSK - Image Box','hsktalents'),
	    array('description' => __('This is used to display image with title and description', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'width' => '480',
			'height' => '480',
			'image_uri' => '',
			'description' =>'',
			'title_below_img' => 'true',
			'button_text' => '',
			'button_link' => '#',
			'title_color' => '#353535',
			'desc_color' => '#757575',
			'button_color' => '#51a3df',
			'button_hover_color' => '#353535',
			'title_font_size' => '18',
			'desc_font_size' => '14',
			'title_font_weight' => 'normal',
			'position' => 'left',
		));
		echo $args['before_widget'];
			echo do_shortcode('[image url="'.$instance['image_uri'].'" title="'.$instance['title'].'" width="'.$instance['width'].'" height="'.$instance['height'].'" description="'.$instance['description'].'" title_below_img="'.$instance['title_below_img'].'" button_text="'.$instance['button_text'].'" button_link="'.$instance['button_link'].'" title_color="'.$instance['title_color'].'" desc_color="'.$instance['desc_color'].'" button_color="'.$instance['button_color'].'" button_hover_color="'.$instance['button_hover_color'].'" title_font_size="'.$instance['title_font_size'].'" title_font_weight="'.$instance['title_font_weight'].'" position="'.$instance['position'].'" ] ');
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'title' => '',
			'width' => '480',
			'height' => '480',
			'image_uri' => '',
			'description' =>'',
			'title_below_img' => 'true',
			'button_text' => '',
			'button_link' => '#',
			'title_color' => '#353535',
			'desc_color' => '#757575',
			'button_color' => '#51a3df',
			'button_hover_color' => '#353535',
			'title_font_size' => '18',
			'desc_font_size' => '14',
			'title_font_weight' => 'normal',
			'position' => 'left',
		));
		$rand_image = rand(858585,25888452);
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsk-imgboxes-color').wpColorPicker();
              	$(document).on("click", ".upload_image_button<?php echo $rand_image; ?>", function (e) {
		          e.preventDefault();
		          var $button = $(this);
		            // Create the media frame.
		            var file_frame = wp.media.frames.file_frame = wp.media({
		               title: '<?php esc_html_e('Upload Imagebox Image', 'hsktalents'); ?>',
		               library: { // remove these to show all
		                  type: 'image' // specific mime
		               },
		               button: {
		                  text: 'Select'
		               },
		               multiple: false  // Set to true to allow multiple files to be selected
		            });
		       
		            // When an image is selected, run a callback.
		            file_frame.on('select', function () {
		               // We set multiple to false so only get one image from the uploader
		       
		               var attachment = file_frame.state().get('selection').first().toJSON();
		       
		               $button.siblings('input').val(attachment.url);
		       
		            });
		       
		            // Finally, open the modal
		            file_frame.open();
		         });
            });
        </script>
		<p>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" type="text" value="<?php echo esc_url( $image_uri ); ?>" />
	      <button class="upload_image_button<?php echo $rand_image; ?> button button-primary"><?php esc_html_e('Upload Imagebox Image', 'hsktalents'); ?></button>
	   </p>
		<p>
		  	<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Image Width & Height', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('width') ?>" id="<?php echo $this->get_field_id('width') ?>" class="small-text" value="<?php echo esc_attr($instance['width']) ?>" />X
		  	<input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="small-text" value="<?php echo esc_attr($instance['height']) ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Image Title', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo esc_attr($instance['title']) ?>" />
		</p>
		<p>
			<label for="description"><?php _e('Description', 'hsktalents'); ?></label>
		  	<textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?> </textarea>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="widefat hsk-imgboxes-color" value="<?php echo $instance['title_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_font_size'); ?>"><?php _e('Title Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-width" value="<?php echo $instance['title_font_size'] ?>" />px
		</p>
		<p>
			<label for="title_below_img"><?php _e('Title Below Image', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('title_below_img') ?>" name="<?php echo $this->get_field_name('title_below_img') ?>">
	        	<option value="true" <?php selected('true', $instance['title_below_img']) ?>><?php _e('True','hsktalents') ?></option>
	        	<option value="false" <?php selected('false', $instance['title_below_img']) ?>><?php _e('False','hsktalents') ?></option>
	        </select>
		</p>

		<p>
			<label for="title_font_weight"><?php _e('Title Font Weight', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
	        	<option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>><?php _e('Normal','hsktalents') ?></option>
	        	<option value="400" <?php selected('400', $instance['title_font_weight']) ?>><?php _e('Medium','hsktalents') ?></option>
	        	<option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>><?php _e('Bold','hsktalents') ?></option>
	        </select>
		</p>
		
		<p>
		  	<label for="<?php echo $this->get_field_id('desc_color'); ?>"><?php _e('Description Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="widefat hsk-imgboxes-color" value="<?php echo $instance['desc_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('desc_font_size'); ?>"><?php _e('Description Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_font_size') ?>" id="<?php echo $this->get_field_id('desc_font_size') ?>" class="small-width" value="<?php echo $instance['desc_font_size'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('button_text') ?>" id="<?php echo $this->get_field_id('button_text') ?>" class="small-width" value="<?php echo $instance['button_text'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button Link', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('button_link') ?>" id="<?php echo $this->get_field_id('button_link') ?>" class="widefat" value="<?php echo $instance['button_link'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('button_color'); ?>"><?php _e('Button Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('button_color') ?>" id="<?php echo $this->get_field_id('button_color') ?>" class="small-text hsk-imgboxes-color" value="<?php echo $instance['button_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('button_hover_color'); ?>"><?php _e('Button Hover Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('button_hover_color') ?>" id="<?php echo $this->get_field_id('button_hover_color') ?>" class="small-text hsk-imgboxes-color" value="<?php echo $instance['button_hover_color'] ?>" />
		</p>
		<p>
			<label for="position"><?php _e('position', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('position') ?>" name="<?php echo $this->get_field_name('position') ?>">
	        	<option value="left" <?php selected('left', $instance['position']) ?>><?php _e('Left','hsktalents') ?></option>
	        	<option value="right" <?php selected('right', $instance['position']) ?>><?php _e('Right','hsktalents') ?></option>
	        	<option value="center" <?php selected('center', $instance['position']) ?>><?php _e('Center','hsktalents') ?></option>
	        </select>
		</p>
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Image_Box");'));
?>