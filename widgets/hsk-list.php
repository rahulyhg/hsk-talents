<?php
/**
*  list widget
*/

class List_Widget extends WP_Widget
{
	
	function __construct()
	{
		parent::__construct('list-widget',__('HSK - List','hsktalents'),
			array('description' => __('Use this widget to display the  list items','hsktalents'))
		);
	}
	function widget($args, $instance){
		$instance = wp_parse_args($instance, array(
			'list_content' => '<li>Sed eleifend, metus ac convallis</li>
<li><i class="fa fa-cogs"></i> Sed eleifend, metus ac convallis</li>
<li><a href="#"><i class="fa fa-cogs"></i> Sed eleifend, metus ac convallis</a></li>',
			'list_data_color' => '#353535',
			'list_data_icon_color' => '#353535',
			'list_data_hover_color' => '000fff',
		));
		echo $args['before_widget'];
			echo '<div class="list-data-content-wrapper">';
				$datalist_color = !empty( $instance['list_data_color']) ?  $instance['list_data_color'] : '#353535';
				$datalist_icon_color = !empty( $instance['list_data_icon_color']) ?  $instance['list_data_icon_color'] : $datalist_color;
				$datalist_hover_color = !empty( $instance['list_data_hover_color']) ?  $instance['list_data_hover_color'] : $datalist_color;				
				echo '<ul data-list-color="'.$datalist_color.'" data-list-icon-color="'.$datalist_icon_color.'" data-list-hover-color="'.$datalist_hover_color.'" >';
					echo $instance['list_content'];
				echo '</ul>';
			echo '</div>';
		echo $args['after_widget'];
	}
	function form($instance){
		$instance = wp_parse_args($instance, array(
			'list_content' => '<li>Sed eleifend, metus ac convallis</li>
<li><i class="fa fa-cogs"></i> Sed eleifend, metus ac convallis</li>
<li><a href="http://www.google.com"><i class="fa fa-cogs"></i> Sed eleifend, metus ac convallis</a></li>',
			'list_data_color' => '#353535',
			'list_data_icon_color' => '#353535',
			'list_data_hover_color' => '000fff',
		));
		?>

		<script type="text/javascript">
	      (function($) {
	      "use strict";
	      $(function() {
			$('.list-data-color-pickr').each(function(){ // Color pickr
				$(this).wpColorPicker();
			});
	      });
	    })(jQuery);
	  </script>
		<?php
		echo '<p>';
			echo "<label for=".$this->get_field_id('list_content').">"._e('List Content', 'hsktalents')."</label>";
			echo '<textarea class="widefat" id="'.$this->get_field_id('list_content').'"  name="'.$this->get_field_name('list_content').'" >'.$instance['list_content'].'</textarea>';
		echo '</p>';
		echo '<p>';
			echo "<label for=".$this->get_field_id('list_data_icon_color').">"._e('List Data Icon Color', 'hsktalents')."</label>";
			echo '<input type="text" class="list-data-color-pickr" id="'.$this->get_field_id('list_data_icon_color').'"  value="'.$instance['list_data_icon_color'].'" name="'.$this->get_field_name('list_data_icon_color').'" />';
		echo '</p>';	
		echo '<p>';
			echo "<label for=".$this->get_field_id('list_data_color').">"._e('List Data Color', 'hsktalents')."</label>";
			echo '<input type="text" class="list-data-color-pickr" id="'.$this->get_field_id('list_data_color').'"  value="'.$instance['list_data_color'].'" name="'.$this->get_field_name('list_data_color').'" />';
		echo '</p>';

		echo '<p>';
			echo "<label for=".$this->get_field_id('list_data_hover_color').">"._e('List Data Hover Color', 'hsktalents')."</label>";
			echo '<input type="text" class="list-data-color-pickr" id="'.$this->get_field_id('list_data_hover_color').'"  value="'.$instance['list_data_hover_color'].'" name="'.$this->get_field_name('list_data_hover_color').'" />';
		echo '</p>';
		echo '<small>'.__('For icons click', 'hsktalents').'<a target="_blank" href="'.esc_url('http://fontawesome.io/icons/').'">'.__('here', 'hsktalents').'</a></small>';
	}
}
add_action('widgets_init', create_function('', 'return register_widget("List_Widget");'));
?>