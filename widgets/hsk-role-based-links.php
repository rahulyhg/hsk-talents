<?php
class HSK_Roles_Based_Links_Widget extends WP_Widget{
	public function __construct(){
		parent::__construct('roles-based-custom-links',__('HSK - Roles Based Custom Links','hsktalents'),
			array('description' => __('This widget to display custom links or page links based on user roles.','hsktalents'))
		);
	}
	public function widget( $args,$instance){
		$instance = wp_parse_args($instance,array(
			'custom_page_link1' => '',
			'custom_page_roles1' => '',
			'custom_page_link2' => '',
			'custom_page_roles2' => '',
			'custom_page_link3' => '',
			'custom_page_roles3' => '',
			'custom_page_link4' => '',
			'custom_page_roles4' => '',
			'custom_page_link5' => '',
			'custom_page_roles5' => '',
			'custom_page_link6' => '',
			'custom_page_roles6' => '',
			'custom_page_link7' => '',
			'custom_page_roles7' => '',
			'custom_page_link8' => '',
			'custom_page_roles8' => '',
			'custom_page_link9' => '',
			'custom_page_roles9' => '',
			'custom_page_link10' => '',
			'custom_page_roles10' => '',
			'add_custom_class' => '',
			'link_type1' => '',
			'link_type2' => '',
			'link_type3' => '',
			'link_type4' => '',
			'link_type5' => '',
			'link_type6' => '',
			'link_type7' => '',
			'link_type8' => '',
			'link_type9' => '',
			'link_type10' => '',

			'custom_link1' => '',
			'custom_link2' => '',
			'custom_link3' => '',
			'custom_link4' => '',
			'custom_link5' => '',
			'custom_link6' => '',
			'custom_link7' => '',
			'custom_link8' => '',
			'custom_link9' => '',
			'custom_link10' => '',

		));
		echo $args['before_widget'];
			echo '<div class="display-links-on-roles '.(!empty($instance['add_custom_class']) ? $instance['add_custom_class'] : '').'">';
				echo '<ul>';
					for ($i=1; $i < 11 ; $i++) { 
						if((!empty($instance['custom_page_link'.$i])) || ( !empty($instance['custom_link'.$i] ) ) ){
				            if( !empty($instance['custom_page_roles'.$i] && is_array($instance['custom_page_roles'.$i])) ){
				                foreach ($instance['custom_page_roles'.$i] as $key => $role) {
				                    if( current_user_can( $role ) ){
				                        if( $instance['link_type'.$i] == 'custom_link' ){
				                            if( !empty($instance['custom_link'.$i] ) ){
				                                $custom_link_pages = explode('||', $instance['custom_link'.$i] );
				                                echo '<li><a href="'.$custom_link_pages[1].'">'.$custom_link_pages[0].'</a></li>';
				                            }
				                        }elseif( $instance['link_type'.$i] == 'page_link' ){
				                            echo '<li><a href="'.get_the_permalink($instance['custom_page_link'.$i]).'">'.get_the_title( $instance['custom_page_link'.$i] ).'</a></li>';
				                        }
				                    }
				                }
				            }else{
				                if( $instance['link_type'.$i] == 'custom_link' ){
		                            if( !empty($instance['custom_link'.$i] ) ){
		                                $custom_link_pages = explode('||', $instance['custom_link'.$i] );
		                                echo '<li><a href="'.$custom_link_pages[1].'">'.$custom_link_pages[0].'</a></li>';
		                            }
		                        }elseif( $instance['link_type'.$i] == 'page_link' ){
		                            echo '<li><a href="'.get_the_permalink($instance['custom_page_link'.$i]).'">'.get_the_title( $instance['custom_page_link'.$i] ).'</a></li>';
		                        }
				            }
				        }
				    }
				echo '</ul>';
			echo '</div>';
		echo $args['after_widget'];
	}
	public function form($instance){
		$instance = wp_parse_args($instance,array(
			'custom_page_link1' => '',
			'custom_page_roles1' => '',
			'custom_page_link2' => '',
			'custom_page_roles2' => '',
			'custom_page_link3' => '',
			'custom_page_roles3' => '',
			'custom_page_link4' => '',
			'custom_page_roles4' => '',
			'custom_page_link5' => '',
			'custom_page_roles5' => '',
			'custom_page_link6' => '',
			'custom_page_roles6' => '',
			'custom_page_link7' => '',
			'custom_page_roles7' => '',
			'custom_page_link8' => '',
			'custom_page_roles8' => '',
			'custom_page_link9' => '',
			'custom_page_roles9' => '',
			'custom_page_link10' => '',
			'custom_page_roles10' => '',
			'add_custom_class' => '',
			'link_type1' => '',
			'link_type2' => '',
			'link_type3' => '',
			'link_type4' => '',
			'link_type5' => '',
			'link_type6' => '',
			'link_type7' => '',
			'link_type8' => '',
			'link_type9' => '',
			'link_type10' => '',

			'custom_link1' => '',
			'custom_link2' => '',
			'custom_link3' => '',
			'custom_link4' => '',
			'custom_link5' => '',
			'custom_link6' => '',
			'custom_link7' => '',
			'custom_link8' => '',
			'custom_link9' => '',
			'custom_link10' => '',
		)); 
		global $wp_roles;
		//if ( ! isset( $wp_roles ) ){
			$wp_roles = new WP_Roles();
			$roles = $wp_roles->get_names();
		//}
		?>
		<script type="text/javascript">
	      (function($) {
	      "use strict";
	      $(function() {
	      	$('.custom-menu-links-type').each(function(){
	      		$(this).change(function () {
					$(this).parent().next().hide();
					$(this).parent().next().next().hide();
					var link_type = $(this).find("option:selected").val(); 
					switch(link_type)
					{
					case 'page_link':
						$(this).parent().next().show();
						break; 
					case 'custom_link':
						$(this).parent().next().next().show();
						break;   	    
					}
				}).change();
	      	});		
	      });
	    })(jQuery);
	  </script>
		<?php 
		for ($i=1; $i < 11 ; $i++) { ?>
			
			<div class="custom-pages-based-on-roles" style="clear:both; background-color:#f9f9f9; padding:15px; border:1px solid #eee; margin-bottom:10px;">
				<p style="width:30%; margin-rihgt:1.5%; float:left;">
					<label for="<?php echo $this->get_field_id('link_type'.$i) ?>"  style="display:block; font-weight:bold;"> <?php _e('Choose Link','hsktalents') ?> </label>
					<select id="<?php echo $this->get_field_id('link_type'.$i) ?>" class="custom-menu-links-type widefat" name="<?php echo $this->get_field_name('link_type'.$i) ?>">
						<option value="page_link" <?php selected('date', $instance['link_type'.$i]) ?>>  <?php esc_html_e('Page Links','hsktalents') ?>  </option>
						<option value="custom_link" <?php selected('custom_link', $instance['link_type'.$i]) ?>><?php esc_html_e('Custom Link', '') ?> </option>
					</select>
				</p>
				<p style="width:68.5%; float:left;">
		        	<label for="<?php echo $this->get_field_id('custom_page_link'.$i); ?>" style="display:block; font-weight:bold;"><?php _e('Custom Page Link', 'hsktalents'); ?></label>
		        	<?php wp_dropdown_pages(array('id' => $this->get_field_id('custom_page_link'.$i),'name' => $this->get_field_name('custom_page_link'.$i), 'selected' => $instance['custom_page_link'.$i], 'class' => 'widefat', 'show_option_none' => __('Choose Page', 'hsktalents'))); ?>
		    	</p>
		    	<p style="width:68.5%; float:left;">
		        	<label for="<?php echo $this->get_field_id('custom_link'.$i); ?>" style="display:block; font-weight:bold;"><?php _e('Custom Page Link', 'hsktalents'); ?></label>
		        	<textarea  class="widefat" id="<?php echo $this->get_field_id('custom_link'.$i); ?>" placeholder="Title || http://www.google.com"  name="<?php echo $this->get_field_name('custom_link'.$i); ?>"><?php echo $instance['custom_link'.$i] ?></textarea>
		        	<small>Custom Link Title || Custom Link URL(add http://)</small>
		    	</p>
		    	<p style="clear:both;">
		        	<label for="<?php echo $this->get_field_id('custom_page_roles'.$i); ?>" style="display:block; font-weight:bold;"><?php _e('Check the role to display the above page link', 'hsktalents'); ?></label>
		        	<?php 
					if( !empty($roles) ){
						foreach ($roles as $role_value => $role_name) {
							if( !empty($instance['custom_page_roles'.$i]) ){
								$checked = in_array($role_value, $instance['custom_page_roles'.$i]) ? 'checked' : 'none';
							}else{
								$checked = '';
							}
							echo '<label style="display:inline-block; margin-right:10px; margin-bottom:5px;"><input type="checkbox" id ="'.$this->get_field_id('custom_page_roles'.$i).'" name="'.$this->get_field_name('custom_page_roles'.$i).'[]" '.$checked.' value="' . $role_value . '">'.$role_name.'</label>';
					  	}
				  	}
					?>
					<small style="display: block;"> <b><?php _e('Note: ', 'hsktalents'); ?></b><?php _e('  If you want to display the custom links / page links for all roles please leave it empty', 'hsktalents') ?></small>
		    	</p>
	    	</div>
	    <?php } ?>
	    <p>
			<label for="<?php echo $this->get_field_id('add_custom_class'); ?>"><?php _e("Add Custom Class For Customization", 'hsktalents'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('add_custom_class'); ?>"  value="<?php echo $instance['add_custom_class'] ?>" name="<?php echo $this->get_field_name('add_custom_class'); ?>" />
		</p>	

	<?php }
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Roles_Based_Links_Widget");'));
?>