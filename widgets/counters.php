<?php
/**
*  Counters Widgets
*/
class HSK_Counters_Widget extends WP_Widget
{
	
	function __construct()
	{
		parent::__construct('counter-box-widget',__('HSK - Counters','hsktalents'),
			array('description' => __('Use this widget to display the counters','hsktalents'))
		);
	}
	function widget($args, $instance){
		$instance = wp_parse_args($instance, array(
			'icon_name' => 'fa-cogs',
			'description' => 'Add your Own Description',
			'container_bg_color' => '#353535',
			'icon_color' => '#fff',
			'counter_color' => '#fff',
			'container_padding_tb' => '50',
			'container_padding_lr' => '50',
			'icon_size' => '32',
			'counter_size' => '30',
			'counter_font_weight' => 'bold',
			'description_size' => '14',
			'counter_num_end' => '150',
			'container_border_color'=> '#1515151',
			'description_color' => '#fff',
			'position' => 'left',
			'counter_plus' => '',
		));
			echo $args['before_widget'];
				$padding = ( !empty($instance['container_padding_tb']) || !empty($instance['container_padding_lr']) ) ? 'padding:'.$instance['container_padding_tb'].'px '.$instance['container_padding_lr'].'px;' : '';
				$bg_color = !empty($instance['container_bg_color']) ? 'background:'.$instance['container_bg_color'].';' : 'background-color:#35355';
				$container_border_color = !empty($instance['container_border_color']) ? 'border:1px solid '.$instance['container_border_color'].';' : '';
				$linheight = ( $instance['position'] == 'center' ) ? 'line-height:'.ceil(1.5*$instance['counter_size']).'px; ' : '';
				echo '<div class="counters-content-wrapper counter-wrapper-aligin-'.$instance['position'].'" style="'.$padding.' '.$bg_color.' '.$container_border_color.'">';
					echo '<div class="counter-wrapper">';
						if(!empty($instance['icon_name'])){
							echo '<div class="counter-icons">';
								echo '<i style="font-size:'.$instance['icon_size'].'px; color:'.$instance['icon_color'].';" class="fa '.$instance['icon_name'].'"></i></a>';
							echo '</div>';	
						}
						$counter_plus = ( !empty($instance['counter_plus']) ) ? $instance['counter_plus'] : '';
						if(!empty($instance['counter_num_end'])){
							echo  '<div class="hsk-counter" style="font-size:'.$instance['counter_size'].'px; '.$linheight.' color:'.$instance['counter_color'].'; font-weight:'.$instance['counter_font_weight'].';" data-counter="'.$instance['counter_num_end'].'"> <span style="font-size:'.$instance['counter_size'].'px;">'.$instance['counter_num_end'].' </span> '.$counter_plus.' </div>';
						}
					echo '</div>';
					if( !empty($instance['description']) ){
						echo '<p style="font-size:'.$instance['description_size'].'px; line-height:'.ceil(1.5*$instance['description_size']).'px; color:'.$instance['description_color'].';" > '.$instance['description'].'</p>';
					}
				echo '</div>';
			echo $args['after_widget'];
	}
	function form($instance){
		$instance = wp_parse_args($instance, array(
			'icon_name' => 'fa-cogs',
			'description' => 'Add your Own Description',
			'container_bg_color' => '#353535',
			'icon_color' => '#fff',
			'counter_color' => '#fff',
			'container_padding_tb' => '50',
			'container_padding_lr' => '50',
			'icon_size' => '32',
			'counter_size' => '30',
			'counter_font_weight' => 'bold',
			'description_size' => '14',
			'counter_num_end' => '150',
			'container_border_color'=> '#1515151',
			'description_color' => '#fff',
			'position' => 'left',
			'counter_plus' => '',
		)); ?>
		 <script type='text/javascript'>
	        jQuery(document).ready(function($) {
		        jQuery('.counter_box_color_pickr').each(function(){
		          jQuery(this).wpColorPicker();
		        }); 
		     });
	     </script> 
	    	     <div class="widgets-fields-group-panel">
	     	<h4><?php _e('Counter Icon Settings', 'hsktalents') ?></h4>
		    <p>
	        	<label for="<?php echo $this->get_field_id('icon_name') ?>">  <?php _e('Icon Name','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_name') ?>" id="<?php echo $this->get_field_id('icon_name') ?>" class="widefat" value="<?php echo $instance['icon_name'] ?>" />
	        	<small><?php _e('For awesome icons click', 'hsktalents');?><a target="_blank" href="<?php echo esc_url('http://fontawesome.io/icons/'); ?>"><?php _e(' here ', 'hsktalents'); ?></a></small>
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('icon_size') ?>">  <?php _e('Icon Size','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_size') ?>" id="<?php echo $this->get_field_id('icon_size') ?>" class="small-text" value="<?php echo $instance['icon_size'] ?>" />px
        	</p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('icon_color') ?>">  <?php _e('Icon Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('icon_color') ?>" id="<?php echo $this->get_field_id('icon_color') ?>" class="counter_box_color_pickr" value="<?php echo $instance['icon_color'] ?>" />
	        </p>
	     </div>
	    <div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('Counter Settings', 'hsktalents') ?></h4>  
	        <p>
	        	<label for="<?php echo $this->get_field_id('counter_num_end') ?>">  <?php _e('Counter Number','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('counter_num_end') ?>" id="<?php echo $this->get_field_id('counter_num_end') ?>" class="widefat" value="<?php echo $instance['counter_num_end'] ?>" />
	        </p>
	        <p>
        	<label for="<?php echo $this->get_field_id('counter_plus') ?>">  <?php _e('Counter Plus Sign(+)','hsktalents') ?>  </label>
        	<input type="text" name="<?php echo $this->get_field_name('counter_plus') ?>" id="<?php echo $this->get_field_id('counter_plus') ?>" class="small-text" value="<?php echo $instance['counter_plus'] ?>" />
        </p>
	         <p>
	        	<label for="<?php echo $this->get_field_id('counter_size') ?>">  <?php _e('Count Number Font Size','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('counter_size') ?>" id="<?php echo $this->get_field_id('counter_size') ?>" class="small-text" value="<?php echo $instance['counter_size'] ?>" />px
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('counter_font_weight') ?>"> <?php _e('Count Number Font Weight','hsktalents') ?></label>
			        <select id="<?php echo $this->get_field_id('counter_font_weight') ?>" name="<?php echo $this->get_field_name('counter_font_weight') ?>">
			        	<option value="normal" <?php selected('normal', $instance['counter_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
			        	<option value="bold" <?php selected('bold', $instance['counter_font_weight']) ?>> <?php esc_html_e('Bold', 'hsktalents') ?>   </option>
			        </select>
	        </p>
	         <p>
	        	<label for="<?php echo $this->get_field_id('counter_color') ?>">  <?php _e('Count Number Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('counter_color') ?>" id="<?php echo $this->get_field_id('counter_color') ?>" class="counter_box_color_pickr" value="<?php echo $instance['counter_color'] ?>" />
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
	         <p>
	        	<label for="<?php echo $this->get_field_id('description_color') ?>">  <?php _e('Description Color','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('description_color') ?>" id="<?php echo $this->get_field_id('description_color') ?>" class="counter_box_color_pickr" value="<?php echo $instance['description_color'] ?>" />
	        </p>
	     </div>
	    <div class="widgets-fields-group-panel"> 
	    	<h4><?php _e('counters Bg Colors / positions Settings', 'hsktalents') ?></h4>   
			<p>
	          <label for="<?php echo $this->get_field_id('container_bg_color') ?>">  <?php _e('Counters Container Background Color','hsktalents') ?>  </label>
	          <input type="text" name="<?php echo $this->get_field_name('container_bg_color') ?>" id="<?php echo $this->get_field_id('container_bg_color') ?>" class="counter_box_color_pickr" value="<?php echo $instance['container_bg_color'] ?>" />
	        </p>
	        <p>
	          <label for="<?php echo $this->get_field_id('container_border_color') ?>">  <?php _e('Counters Container Border Color','hsktalents') ?>  </label>
	          <input type="text" name="<?php echo $this->get_field_name('container_border_color') ?>" id="<?php echo $this->get_field_id('container_border_color') ?>" class="counter_box_color_pickr" value="<?php echo $instance['container_border_color'] ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo $this->get_field_id('container_padding_lr') ?>">  <?php _e('Container Padding Top & Bottom, Right & Left','hsktalents') ?>  </label>
	        	<input type="text" name="<?php echo $this->get_field_name('container_padding_lr') ?>" id="<?php echo $this->get_field_id('container_padding_lr') ?>" class="small-text" value="<?php echo $instance['container_padding_lr'] ?>" />X
	        	<input type="text" name="<?php echo $this->get_field_name('container_padding_lr') ?>" id="<?php echo $this->get_field_id('container_padding_lr') ?>" class="small-text" value="<?php echo $instance['container_padding_lr'] ?>" />px
	        </p> 	      
	        <p>
	        	<label for="<?php echo $this->get_field_id('position') ?>"> <?php _e('Position','hsktalents') ?></label>
			        <select id="<?php echo $this->get_field_id('position') ?>" name="<?php echo $this->get_field_name('position') ?>">
			        	<option value="left" <?php selected('left', $instance['position']) ?>> <?php esc_html_e('Left', 'hsktalents') ?>   </option>
			        	<option value="center" <?php selected('center', $instance['position']) ?>> <?php esc_html_e('Center', 'hsktalents') ?>   </option>
			        </select>
	        </p>
    	</div>
	<?php		
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Counters_Widget");'));
?>