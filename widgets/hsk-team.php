<?php
/**
* Creating Icon Boxes
*/
class HSK_Team extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-team',
	    __('HSK - Team','hsktalents'),
	    array('description' => __('This is used to create team image with descriptons', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'name' => 'Team Member Name',
			'image_uri' => '',
			'designation' => '',
			'description' => '',
			'text_align' => 'Left',
			'description_letter_space' => '0',
			'title_letter_space' => '0',
			'designation_letter_space' => '0',
			'title_font_weight' => 'normal',
			'title_font_size' => '18',
			'title_color' => '#252525',
			'designation_color' => '#95969a',
			'description_color' => '#252525',
			'designation_font_size' => '11',
			'description_font_size' => '13',
			'img_width' => '150',
			'img_height' => '150',
			'img_border_radius_top' => '0',
			'img_border_radius_right' => '0',
			'img_border_radius_bottom' => '0',
			'img_border_radius_left' => '0',

		));
		echo $args['before_widget'];
			echo do_shortcode('[hsk_team img_url="'.$instance['image_uri'].'" name="'.$instance['name'].'"  designation="'.$instance['designation'].'" description="'.$instance['description'].'" title_font_size ="'.$instance['title_font_size'].'" title_color="'.$instance['title_color'].'" designation_color="'.$instance['designation_color'].'" description_color="'.$instance['description_color'].'"  description_font_size="'.$instance['description_font_size'].'" designation_font_size="'.$instance['description_font_size'].'" img_height="'.$instance['img_height'].'" img_width="'.$instance['img_width'].'" img_border_radius_top="'.$instance['img_border_radius_top'].'" img_border_radius_right="'.$instance['img_border_radius_right'].'" img_border_radius_bottom="'.$instance['img_border_radius_bottom'].'" img_border_radius_left="'.$instance['img_border_radius_left'].'" text_align="'.$instance['text_align'].'" description_letter_space="'.$instance['description_letter_space'].'" title_letter_space="'.$instance['title_letter_space'].'" designation_letter_space="'.$instance['description_letter_space'].'" title_font_weight="'.$instance['title_font_weight'].'"]');	
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'name' => 'Team Member Name',
			'img_url' => '',
			'designation' => '',
			'description' => '',
			'text_align' => 'left',
			'description_letter_space' => '0',
			'title_letter_space' => '0',
			'designation_letter_space' => '0',
			'title_font_weight' => 'normal',
			'title_font_size' => '18',
			'title_color' => '#252525',
			'designation_color' => '#95969a',
			'description_color' => '#252525',
			'designation_font_size' => '11',
			'description_font_size' => '13',
			'img_width' => '150',
			'img_height' => '150',
			'img_border_radius_top' => '0',
			'img_border_radius_right' => '0',
			'img_border_radius_bottom' => '0',
			'img_border_radius_left' => '0',
			'image_uri' => ''
		));
		$button_rand = rand(9999,2541414); 
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsktalents-button').wpColorPicker();
                $(document).on("click", ".upload_image_button<?php echo $button_rand; ?>", function (e) {
		          e.preventDefault();
		          var $button = $(this);
		            // Create the media frame.
		            var file_frame = wp.media.frames.file_frame = wp.media({
		               title: '<?php esc_html_e('Upload Team Member Image', 'hsktalents'); ?>',
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
	      <input class="widefat" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" type="text" value="<?php echo esc_url( $instance['image_uri'] ); ?>" />
	      <button class="upload_image_button<?php echo $button_rand; ?> button button-primary"><?php esc_html_e('Upload Team Member Image', 'hsktalents'); ?></button>
	    </p>
		<p>
		  	<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Team Member Name', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('name') ?>" id="<?php echo $this->get_field_id('name') ?>" class="widefat" value="<?php echo $instance['name'] ?>" />
		</p>
		
		<p>
		  	<label for="<?php echo $this->get_field_id('designation'); ?>"><?php _e('Designation', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('designation') ?>" id="<?php echo $this->get_field_id('designation') ?>" class="widefat" value="<?php echo $instance['designation'] ?>" />
		</p>
		<p>
			<label for="description"><?php _e('Small Description About Team Member', 'hsktalents'); ?></label>
		  	<textarea name="<?php echo $this->get_field_name('description') ?>" id="<?php echo $this->get_field_id('description') ?>" class="widefat" value="<?php echo $instance['description'] ?>" > <?php echo $instance['description'] ?> </textarea>
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('title_font_size'); ?>"><?php _e('Title Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-text" value="<?php echo $instance['title_font_size'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_letter_space'); ?>"><?php _e('Title Letter Spacing', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_letter_space') ?>" id="<?php echo $this->get_field_id('title_letter_space') ?>" class="small-text" value="<?php echo $instance['title_letter_space'] ?>" />px
		</p>
		<p>
			<label for="title_font_weight"><?php _e('Title Font Weight', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
	        	<option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>><?php _e('Normal','hsktalents') ?></option>
	        	<option value="medium" <?php selected('medium', $instance['title_font_weight']) ?>><?php _e('Medium','hsktalents') ?></option>
	        	<option value="700" <?php selected('700', $instance['title_font_weight']) ?>><?php _e('Bold','hsktalents') ?></option>
	        </select>
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Title Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['title_color'] ?>" />
		</p>
		
		<p>
		  	<label for="<?php echo $this->get_field_id('designation_font_size'); ?>"><?php _e('Designation Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('designation_font_size') ?>" id="<?php echo $this->get_field_id('designation_font_size') ?>" class="small-text" value="<?php echo $instance['designation_font_size'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('designation_letter_space'); ?>"><?php _e('Designation Letter Spacing', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('designation_letter_space') ?>" id="<?php echo $this->get_field_id('designation_letter_space') ?>" class="small-text" value="<?php echo $instance['designation_letter_space'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('designation_color'); ?>"><?php _e('Designation Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('designation_color') ?>" id="<?php echo $this->get_field_id('designation_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['designation_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('description_font_size'); ?>"><?php _e('Description Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('description_font_size') ?>" id="<?php echo $this->get_field_id('description_font_size') ?>" class="small-text" value="<?php echo $instance['description_font_size'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('description_letter_space'); ?>"><?php _e('Description Letter Spacing', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('description_letter_space') ?>" id="<?php echo $this->get_field_id('description_letter_space') ?>" class="small-text" value="<?php echo $instance['description_letter_space'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('description_color'); ?>"><?php _e('Description Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('description_color') ?>" id="<?php echo $this->get_field_id('description_color') ?>" class="small-text hsktalents-button" value="<?php echo $instance['description_color'] ?>" />
		</p>



		<p>
		  	<label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('Image Width & Height', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('img_width') ?>" id="<?php echo $this->get_field_id('img_width') ?>" class="small-text" value="<?php echo $instance['img_width'] ?>" />X
		  	<input type="text" name="<?php echo $this->get_field_name('img_height') ?>" id="<?php echo $this->get_field_id('img_height') ?>" class="small-text" value="<?php echo $instance['img_height'] ?>" />px
		</p>

		<p class="measurement-inputs">
		  	<label for="<?php echo $this->get_field_id('img_border_radius_top'); ?>"><?php _e('Image Border Radius', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('img_border_radius_top') ?>" placeholder="<?php _e('Top', 'hsktalents') ?>" id="<?php echo $this->get_field_id('img_border_radius_top') ?>" class="small-text" value="<?php echo $instance['img_border_radius_top'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('img_border_radius_right') ?>" id="<?php echo $this->get_field_id('border_radius_right') ?>" placeholder="<?php _e('Right', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['img_border_radius_right'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('img_border_radius_bottom') ?>" id="<?php echo $this->get_field_id('img_border_radius_bottom') ?>" placeholder="<?php _e('Bottom', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['img_border_radius_bottom'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('img_border_radius_left') ?>" id="<?php echo $this->get_field_id('img_border_radius_left') ?>" class="small-text" placeholder="<?php _e('Left', 'hsktalents') ?>" value="<?php echo $instance['img_border_radius_left'] ?>" />Px
		</p>
		<p>
			<label for="text_align"><?php _e('Image & Description Alignment', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('text_align') ?>" name="<?php echo $this->get_field_name('text_align') ?>">
	        	<option value="left" <?php selected('left', $instance['text_align']) ?>><?php _e('Left','hsktalents') ?></option>
	        	<option value="right" <?php selected('right', $instance['text_align']) ?>><?php _e('Right','hsktalents') ?></option>
	        	<option value="center" <?php selected('center', $instance['text_align']) ?>><?php _e('Center','hsktalents') ?></option>
	        </select>
		</p>

		
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Team");'));
?>