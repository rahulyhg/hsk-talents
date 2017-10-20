<?php
/**
* Creating talents Categories
*/
class HSK_Talent_cat_Widget extends WP_Widget{

	function __construct(){
		// widget actual processes
		parent::__construct(
			'hsk-talent-list', // Base ID
			__('HSK - Talents Categories', 'hsktalents'), // Name
			array( 'description' => __( 'This is to create category images, title and description', 'hsktalents' )) // Args
		);
	}
	/**
	 * Creating Widget Data
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, array(
			'style' => '1',
			'cat_id' => '97',
        	'width' => '300',
        	'height' => '150',
        	'border_radius' => '3',
        	'content_align' => 'left',
        	'count_bg_color' => '#242730',
        	'count_size' => '30',
        	'title_font_size' => '18',
        	'desc_font_size' => '15',
        	'title_color' => '#333',
        	'desc_color' => '#757575',
        	'count_color' => '#fff',
        	'border_color' => '#e5e5e5',
		));
			echo $args['before_widget'];
				echo do_shortcode('[hsk_talents_cat style="'.$instance['style'].'" count_size="'.$instance['count_size'].'"  cat_id="'.$instance['cat_id'].'"  content_align="'.$instance['content_align'].'" height="'.$instance['height'].'" width="'.$instance['width'].'" border_radius="'.$instance['border_radius'].'" count_bg_color="'.$instance['count_bg_color'].'" count_color="'.$instance['count_color'].'" title_color = "'.$instance['title_color'].'" title_font_size="'.$instance['title_font_size'].'" desc_font_size= "'.$instance['desc_font_size'].'" desc_color="'.$instance['desc_color'].'" ]' );
			echo $args['after_widget'];				
	}
	/**
	 * Creating Widget Form
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'style' => '1',
			'cat_id' => '97',
        	'width' => '300',
        	'height' => '150',
        	'border_radius' => '3',
        	'content_align' => 'left',
        	'style' => '1',
        	'count_bg_color' => '#242730',
        	'count_size' => '30',
        	'title_font_size' => '18',
        	'desc_font_size' => '15',
        	'title_color' => '#333',
        	'desc_color' => '#757575',
        	'count_color' => '#fff',
        	'border_color' => '#e5e5e5',
		)); 
		$talent_terms = get_terms( array('taxonomy' => 'talent_cat',  'hide_empty' => false)); ?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsk-talent-cat-color').wpColorPicker();

                $('#<?php echo $this->get_field_id('style'); ?>').change(function(){
                	var display_type = $(this).find('option:selected').val();
                		$('.<?php echo $this->get_field_id('border_color'); ?>').hide();
                		$('.<?php echo $this->get_field_id('count_color'); ?>').hide();
                		$('.<?php echo $this->get_field_id('count_size'); ?>').hide();
						$('.<?php echo $this->get_field_id('count_bg_color'); ?>').hide();
						$('.<?php echo $this->get_field_id('height'); ?>').show();
						$('.<?php echo $this->get_field_id('width'); ?>').show();

                	if( display_type == '2' ){
                		$('.<?php echo $this->get_field_id('count_bg_color'); ?>').show();
                		$('.<?php echo $this->get_field_id('count_color'); ?>').show();
                		$('.<?php echo $this->get_field_id('count_size'); ?>').show();
                	}else if( display_type == '1' ){
                		//alert('test')
                	}if( display_type == '3' ){
                		$('.<?php echo $this->get_field_id('border_color'); ?>').show();
                		$('.<?php echo $this->get_field_id('width'); ?>').hide();
						$('.<?php echo $this->get_field_id('height'); ?>').hide();
                	}else{	

                	}
                }).change();
            });
        </script>
		<p>
			<label for="style"><?php _e('style', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style') ?>">
	        	<option value="1" <?php selected('1', $instance['style']) ?>>1</option>
	        	<option value="2" <?php selected('2', $instance['style']) ?>>2</option>
	        	<option value="3" <?php selected('3', $instance['style']) ?>>3</option>
	        </select>
		</p>

		<?php if( !empty($talent_terms) ){ ?>		
			<p>
			  	<label for="<?php echo $this->get_field_id('cat_id'); ?>"><?php _e('Category ID', 'hsktalents') ?></label>
			  	 <select id="<?php echo $this->get_field_id('cat_id') ?>" name="<?php echo $this->get_field_name('cat_id') ?>">
			  	 <?php 
			  	 foreach ($talent_terms as $talent_term) { ?>
			  	 	<option value="<?php echo trim($talent_term->term_id); ?>" <?php selected(trim($talent_term->term_id), $instance['cat_id']) ?>><?php echo trim($talent_term->name) ?></option>
			  	 <?php } ?>	        	
		        </select>
			</p>
		<?php } ?>
		<p class="<?php echo $this->get_field_id('width'); ?>">
		  	<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Images / Category Count Width', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('width') ?>" id="<?php echo $this->get_field_id('width') ?>" class="small-text" value="<?php echo $instance['width'] ?>" />px
		</p>
		<p class="<?php echo $this->get_field_id('height'); ?>">
		  	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Images / Category Count Height', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="small-text" value="<?php echo $instance['height'] ?>" />px
		</p>
	
		<p class="<?php echo $this->get_field_id('count_bg_color'); ?>">
		  	<label for="<?php echo $this->get_field_id('count_bg_color'); ?>"><?php _e('Category Count Background Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('count_bg_color') ?>" id="<?php echo $this->get_field_id('count_bg_color') ?>" class="small-text hsk-talent-cat-color" value="<?php echo $instance['count_bg_color'] ?>" />
		</p>
		<p class="<?php echo $this->get_field_id('count_color'); ?>">
		  	<label for="<?php echo $this->get_field_id('count_color'); ?>"><?php _e('Category Count Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('count_color') ?>" id="<?php echo $this->get_field_id('count_color') ?>" class="small-text hsk-talent-cat-color" value="<?php echo $instance['count_color'] ?>" />
		</p>
		<p class="<?php echo $this->get_field_id('count_size'); ?>">
		  	<label for="<?php echo $this->get_field_id('count_size'); ?>"><?php _e('Category Count Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('count_size') ?>" id="<?php echo $this->get_field_id('count_size') ?>" class="small-text" value="<?php echo $instance['count_size'] ?>" />px
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Category Title Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="small-text hsk-talent-cat-color" value="<?php echo $instance['title_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('title_font_size'); ?>"><?php _e('Title Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-text" value="<?php echo $instance['title_font_size'] ?>" />px
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('desc_color'); ?>"><?php _e('Category Description Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_color') ?>" id="<?php echo $this->get_field_id('desc_color') ?>" class="small-text hsk-talent-cat-color" value="<?php echo $instance['desc_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('desc_font_size'); ?>"><?php _e('Description Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('desc_font_size') ?>" id="<?php echo $this->get_field_id('desc_font_size') ?>" class="small-text" value="<?php echo $instance['desc_font_size'] ?>" />px
		</p>
		<p class="<?php echo $this->get_field_id('border_color'); ?>">
		  	<label for="<?php echo $this->get_field_id('border_color'); ?>"><?php _e('Border Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('border_color') ?>" id="<?php echo $this->get_field_id('border_color') ?>" class="small-text hsk-talent-cat-color" value="<?php echo $instance['border_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('border_radius'); ?>"><?php _e('Border Radius', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('border_radius') ?>" id="<?php echo $this->get_field_id('border_radius') ?>" class="small-text" value="<?php echo $instance['border_radius'] ?>" />%
		</p>

		<p>
			<label for="content_align"><?php _e('Align', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('content_align') ?>" name="<?php echo $this->get_field_name('content_align') ?>">
	        	<option value="left" <?php selected('left', $instance['content_align']) ?>><?php _e('Left','hsktalents'); ?></option>
	        	<option value="right" <?php selected('right', $instance['content_align']) ?>><?php _e('Right','hsktalents'); ?></option>
	        	<option value="center" <?php selected('center', $instance['content_align']) ?>><?php _e('Center','hsktalents'); ?></option>
	        </select>
		</p>

	<?php }
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Talent_cat_Widget");'));  	 	 		 	 		