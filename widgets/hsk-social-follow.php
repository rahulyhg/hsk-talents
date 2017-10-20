<?php
/**
* Creating Icon Boxes
*/
class HSK_Social_Media_Icons extends WP_Widget
{
	
	public function __construct(){
	    parent::__construct('hsk-social-follow-icons',
	    __('HSK - Social Follow Icons','hsktalents'),
	    array('description' => __('This is used to add social follow icons any where', 'hsktalents'))
	    );
	}
	public function widget($args, $instance){		
		$instance = wp_parse_args( $instance, array(
			'social_media_follow_icons' => 'Facebook | fa-facebook | http://www.facebook.com/username
											Twitter | fa-twitter | http://www.twitter.com/username',
			'position' => 'left',
			'icon_bg_color' => '#222',
			'icon_color' => '#fff',
			'icon_size' => '14',
			'icon_padding' => '30',
			'icon_hover_bg_color' => '#fff',
			'icon_hover_color' => '#222',
			'icon_border_radius_t' => '3',
			'icon_border_radius_r' => '3',
			'icon_border_radius_b' => '3',
			'icon_border_radius_l' => '3',
			'margin_top' => '0',
			'margin_bottom' => '0',

		));
		echo $args['before_widget'];
			if( trim(!empty($instance['social_media_follow_icons'])) ){
				$rand = rand(1,25000);
				$css = '.hsk-socila-media-follow-icons.hsk-social-icon'.$rand.' ul li a:hover{
						background-color:'.$instance['icon_hover_bg_color'].'!important;
						color:'.$instance['icon_hover_color'].'!important;
					}';
				echo '<style type="text/css" >'.preg_replace('/\s+/', ' ', $css).'</style>';
				echo '<div class="hsk-socila-media-follow-icons hsk-social-icon'.$rand.'" style="text-align:'.$instance['position'].'; margin:'.$instance['margin_top'].'px '.$instance['margin_bottom'].'px; ">';
					$social_media_list = nl2br($instance['social_media_follow_icons']);
					$border_radius = 'border-radius:'.$instance['icon_border_radius_t'].'px '.$instance['icon_border_radius_r'].'px '.$instance['icon_border_radius_b'].'px '.$instance['icon_border_radius_l'].'px;';

					$social_media_array = explode("\n", $social_media_list);
					echo '<ul>';
					foreach ($social_media_array as $key => $social_media_group) {
						$soial_media_icons = explode('|', $social_media_group);
						echo '<li><a target="_blank" style="background-color:'.$instance['icon_bg_color'].'; color:'.$instance['icon_color'].'; font-size:'.$instance['icon_size'].'px; width:'.$instance['icon_padding'].'px; height:'.$instance['icon_padding'].'px; line-height:'.$instance['icon_padding'].'px; '.$border_radius.'" href="'.trim($soial_media_icons[2]).'" title="'.esc_attr($soial_media_icons[0]).'"><i style="line-height:'.$instance['icon_padding'].'px; " class="fa '. $soial_media_icons[1].'"></i></a></li>';
					}
					echo '</ul>';
				echo '</div>';
			}
		echo $args['after_widget'];
		
	}

	function form($instance){
		$instance = wp_parse_args( $instance, array(
			'social_media_follow_icons' => 'Facebook | fa-facebook | http://www.facebook.com/username
											Twitter | fa-twitter | http://www.twitter.com/username',
			'position' => 'left',
			'icon_bg_color' => '#222',
			'icon_color' => '#fff',
			'icon_size' => '14',
			'icon_padding' => '30',
			'icon_hover_bg_color' => '#fff',
			'icon_hover_color' => '#222',
			'icon_border_radius_t' => '3',
			'icon_border_radius_r' => '3',
			'icon_border_radius_b' => '3',
			'icon_border_radius_l' => '3',
			'margin_top' => '0',
			'margin_bottom' => '0',
		)); 
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsk-icon-color').wpColorPicker();
            });
        </script>
		<p>
			<label for="social_media_follow_icons"><?php _e('Add Social Media Follow Icons', 'hsktalents'); ?></label>
		  	<textarea name="<?php echo $this->get_field_name('social_media_follow_icons') ?>" id="<?php echo $this->get_field_id('social_media_follow_icons') ?>" class="widefat" value="<?php echo $instance['social_media_follow_icons'] ?>" > <?php echo $instance['social_media_follow_icons'] ?> </textarea>
		  	<small><?php _e('Ex:','hsktalents'); echo 'Facebook | fa-facebook | http://www.facebook.com/username <br>   Twitter | fa-twitter | http://www.twitter.com/username' ?></small><br />
		  	<small><?php _e('<strong style="color:red;">Note:</strong>Please add social media follow icons above format only', 'hsktalents') ?></small>
		</p>
		
		<p>
		  	<label for="<?php echo $this->get_field_id('icon_bg_color'); ?>"><?php _e('Icon Background Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_bg_color') ?>" id="<?php echo $this->get_field_id('icon_bg_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['icon_bg_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('icon_color'); ?>"><?php _e('Icon Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_color') ?>" id="<?php echo $this->get_field_id('icon_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['icon_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('icon_hover_bg_color'); ?>"><?php _e('Icon Hover Background Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_hover_bg_color') ?>" id="<?php echo $this->get_field_id('icon_hover_bg_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['icon_hover_bg_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('icon_hover_color'); ?>"><?php _e('Icon Hover Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_hover_color') ?>" id="<?php echo $this->get_field_id('icon_hover_color') ?>" class="small-text hsk-icon-color" value="<?php echo $instance['icon_hover_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Font Size', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_size') ?>" id="<?php echo $this->get_field_id('icon_size') ?>" class="small-text" value="<?php echo $instance['icon_size'] ?>" />px
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('icon_padding'); ?>"><?php _e('Icon Padding', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_padding') ?>" id="<?php echo $this->get_field_id('icon_padding') ?>" class="small-text" value="<?php echo $instance['icon_padding'] ?>" />px
		</p>

		<p class="measurement-inputs">
		  	<label for="<?php echo $this->get_field_id('icon_border_radius_t'); ?>"><?php _e('Icon Border Radius', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('icon_border_radius_t') ?>" placeholder="<?php _e('Top', 'hsktalents') ?>" id="<?php echo $this->get_field_id('icon_border_radius_t') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_t'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('icon_border_radius_r') ?>" id="<?php echo $this->get_field_id('icon_border_radius_r') ?>" placeholder="<?php _e('Right', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_r'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('icon_border_radius_b') ?>" id="<?php echo $this->get_field_id('icon_border_radius_b') ?>" placeholder="<?php _e('Bottom', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['icon_border_radius_b'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('icon_border_radius_l') ?>" id="<?php echo $this->get_field_id('icon_border_radius_l') ?>" class="small-text" placeholder="<?php _e('Left', 'hsktalents') ?>" value="<?php echo $instance['icon_border_radius_l'] ?>" />Px
		</p>

		<p class="measurement-inputs">
		  	<label for="<?php echo $this->get_field_id('margin_top'); ?>"><?php _e('Margin', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('margin_top') ?>" placeholder="<?php _e('Top', 'hsktalents') ?>" id="<?php echo $this->get_field_id('margin_top') ?>" class="small-text" value="<?php echo $instance['margin_top'] ?>" />

		  	<input type="text" name="<?php echo $this->get_field_name('margin_bottom') ?>" id="<?php echo $this->get_field_id('margin_bottom') ?>" placeholder="<?php _e('Bottom', 'hsktalents') ?>" class="small-text" value="<?php echo $instance['margin_bottom'] ?>" />px

		</p>

		<p>
			<label for="position"><?php _e('Icon Position', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('position') ?>" name="<?php echo $this->get_field_name('position') ?>">
	        	<option value="left" <?php selected('left', $instance['position']) ?>><?php _e('Left','hsktalents') ?></option>
	        	<option value="right" <?php selected('right', $instance['position']) ?>><?php _e('Right','hsktalents') ?></option>
	        	<option value="center" <?php selected('center', $instance['position']) ?>><?php _e('Center','hsktalents') ?></option>
	        </select>
		</p>
		<?php
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Social_Media_Icons");'));
?>