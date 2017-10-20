<?php
/**
*  Saerch Widgets
*/
class HSK_Feature_Boxes_Widget extends WP_Widget
{
	
	function __construct()
	{
		parent::__construct('feature-box-widget',__('HSK - Hover / Feature Boxes','hsktalents'),
			array('description' => __('Use this widget to display descriptions as a slide','hsktalents'))
		);
	}
	function widget($args, $instance){
		$instance = wp_parse_args($instance, array(
			'icon_name' => 'fa-cogs',
			'title' => 'Add Title Here',
			'description' => 'Add your Own Description',
			'container_bg_color' => '#e5e5e5',
			'icon_color' => '#353535',
			'title_color' => '#353535',
			'hover_content_bg_color' => '#353535',
			'hover_content_color' => '#fff',
			'link' => '#',
			'container_padding_tb' => '50',
			'icon_size' => '32',
			'title_size' => '16',
			'title_font_weight' => 'normal',
			'description_size' => '14',
		));
			echo $args['before_widget'];
				$padding = !empty($instance['container_padding_tb']) ? 'padding-top:'.$instance['container_padding_tb'].'px; padding-bottom:'.$instance['container_padding_tb'].'px;' : '50';
				$bgcolor = !empty($instance['container_bg_color']) ? ($instance['container_bg_color']) : '#e5e5e5';
				echo '<div class="feature-box-content-wrapper">';
					echo '<div class="feature-box-title-icon" style="'.$padding.' background-color:'.$bgcolor.'">';
						if(!empty($instance['icon_name'])){
							if( empty($instance['hover_content_color']) ){
								echo '<a style="font-size:'.$instance['icon_size'].'px; color:'.$instance['icon_color'].';" href="'.$instance['link'].'">';
							}
							echo '<i style="font-size:'.$instance['icon_size'].'px; color:'.$instance['icon_color'].';" class="fa '.$instance['icon_name'].'"></i></a>';
							if( empty($instance['hover_content_color']) ){
								echo '</a>';
							}
						}
						if(!empty($instance['title'])){
							echo '<h3 style="font-size:'.$instance['title_size'].'px; color:'.$instance['title_color'].'; font-weight:'.$instance['title_font_weight'].'; ">'.$instance['title'].'</h3>';
						}
					echo '</div>';
					if( !empty($instance['description']) ){
						echo '<div class="feature-box-hover-details-wrapper" style="background-color:'.$instance['hover_content_bg_color'].';">';
							echo '<p style="font-size:'.$instance['description_size'].'px; line-height:'.ceil(1.5*$instance['description_size']).'px; color:'.$instance['hover_content_color'].';" > '.$instance['description'].'</p>';
							echo '<a style="color:'.$instance['hover_content_color'].';" href="'.$instance['link'].'" class="feature-box-link"><i class="fa fa-link"></i></a>';
						echo '</div>';
					}
				echo '</div>';
			echo $args['after_widget'];
	}
	function form($instance){
		$instance = wp_parse_args($instance, array(
			'icon_name' => 'fa-cogs',
			'title' => 'Add Title Here',
			'description' => 'Add your Own Description',
			'container_bg_color' => '#e5e5e5',
			'icon_color' => '#353535',
			'title_color' => '#353535',
			'hover_content_bg_color' => '#353535',
			'hover_content_color' => '#fff',
			'link' => '#',
			'container_padding_tb' => '50',
			'icon_size' => '32',
			'title_size' => '16',
			'title_font_weight' => 'normal',
			'description_size' => '14',
		)); ?>
		 <script type='text/javascript'>
	        jQuery(document).ready(function($) {
		        jQuery('.featured_box_color_pickr').each(function(){
		          jQuery(this).wpColorPicker();
		        }); 
		     });
	     </script>
	    <div class="widgets-fields-group-panel"> 
			<h4><?php _e('Container Settings', 'hsktalents') ?></h4>     
	         <p>
	        	<label for="<?php echo $this->get_field_id('container_padding_tb') ?>">  <?php _e('Container Padding Top & Bottom','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('container_padding_tb') ?>" id="<?php echo $this->get_field_id('container_padding_tb') ?>" class="small-text" value="<?php echo $instance['container_padding_tb'] ?>" />px
	        </p>
			<p>
	          <label for="<?php echo $this->get_field_id('container_bg_color') ?>">  <?php _e('Container Background Color','hsktalents') ?>  </label>
	          <input type="text" name="<?php echo $this->get_field_name('container_bg_color') ?>" id="<?php echo $this->get_field_id('container_bg_color') ?>" class="featured_box_color_pickr" value="<?php echo $instance['container_bg_color'] ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('hover_content_bg_color') ?>">  <?php _e('Hover Content BG Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('hover_content_bg_color') ?>" id="<?php echo $this->get_field_id('hover_content_bg_color') ?>" class="featured_box_color_pickr" value="<?php echo $instance['hover_content_bg_color'] ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('hover_content_color') ?>">  <?php _e('Hover Content Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('hover_content_color') ?>" id="<?php echo $this->get_field_id('hover_content_color') ?>" class="featured_box_color_pickr" value="<?php echo $instance['hover_content_color'] ?>" />
	        </p>
		</div>   
	    <div class="widgets-fields-group-panel">
	     	<h4><?php _e('Icon Settings', 'hsktalents') ?></h4> 
		    <p>
	        	<label for="<?php echo $this->get_field_id('icon_name') ?>">  <?php _e('Icon Name','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_name') ?>" id="<?php echo $this->get_field_id('icon_name') ?>" class="widefat" value="<?php echo $instance['icon_name'] ?>" />
	        	<small><?php _e('For awesome icons click', 'hsktalents');?><a target="_blank" href="<?php echo esc_url('http://fontawesome.io/icons/'); ?>"><?php _e(' here ', 'hsktalents'); ?></a></small>
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('link') ?>">  <?php _e('Link','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('link') ?>" id="<?php echo $this->get_field_id('link') ?>" class="widefat" value="<?php echo $instance['link'] ?>" />
	        </p>
	         <p>
	        	<label for="<?php echo $this->get_field_id('icon_size') ?>">  <?php _e('Icon Size','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_size') ?>" id="<?php echo $this->get_field_id('icon_size') ?>" class="small-text" value="<?php echo $instance['icon_size'] ?>" />px
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('icon_color') ?>">  <?php _e('Icon Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_color') ?>" id="<?php echo $this->get_field_id('icon_color') ?>" class="featured_box_color_pickr" value="<?php echo $instance['icon_color'] ?>" />
	        </p>
		</div>
		<div class="widgets-fields-group-panel">
	     	<h4><?php _e('Title Settings', 'hsktalents') ?></h4>       
	        <p>
	        	<label for="<?php echo $this->get_field_id('title') ?>">  <?php _e('Title','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" class="widefat" value="<?php echo $instance['title'] ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('title_size') ?>">  <?php _e('Title Font Size','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('title_size') ?>" id="<?php echo $this->get_field_id('title_size') ?>" class="small-text" value="<?php echo $instance['title_size'] ?>" />px
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('title_font_weight') ?>"> <?php _e('Title Font Weight','hsktalents') ?></label>
			        <select id="<?php echo $this->get_field_id('title_font_weight') ?>" name="<?php echo $this->get_field_name('title_font_weight') ?>">
			        	<option value="normal" <?php selected('normal', $instance['title_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
			        	<option value="bold" <?php selected('bold', $instance['title_font_weight']) ?>> <?php esc_html_e('Bold', 'hsktalents') ?>   </option>
			        </select>
	        </p>
	         <p>
	        	<label for="<?php echo $this->get_field_id('title_color') ?>">  <?php _e('Title Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="featured_box_color_pickr" value="<?php echo $instance['title_color'] ?>" />
	        </p>
	    </div>
		<div class="widgets-fields-group-panel"> 
			<h4><?php _e('Description Settings', 'hsktalents') ?></h4>       
	        <p>
	        	<label for="<?php echo $this->get_field_id('description') ?>">  <?php _e('Description','hsktalents') ?>  </label>
	        	<textarea type="text" id="<?php echo $this->get_field_id('description') ?>"  name="<?php echo $this->get_field_name('description') ?>" class="widefat" ><?php echo trim(esc_attr( $instance['description'] )) ?></textarea>
	        	<small><?php _e('Use  short descriptions for better appearance', 'hsktalents'); ?></small>
	        </p>	        
	       
	        <p>
	        	<label for="<?php echo $this->get_field_id('description_size') ?>">  <?php _e('Description Font Size','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('description_size') ?>" id="<?php echo $this->get_field_id('description_size') ?>" class="small-text" value="<?php echo $instance['description_size'] ?>" />px
	        </p>
	    </div>     
	<?php		
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Feature_Boxes_Widget");'));
?>