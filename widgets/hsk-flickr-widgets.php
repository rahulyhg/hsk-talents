<?php
/**
 * Widget - Flickr Badge Widget
**/
 
class HSK_Flickr_Badges_Widget extends WP_Widget {	
	function __construct() {
		parent::__construct('hsk-fliker-widget',__('HSK - Flickr','hsktalents'),
			array('description' => __('Use this widget to display  flickr images where you need','hsktalents'))
		);
	}	
	function widget( $args, $instance ) {
		$instance = wp_parse_args($instance,array(
			'title'			=> 'Title',
			'type'			=> 'user',
			'flickr_id'		=> '71865026@N00',
			'count'			=> 6,
			'display'		=> 'latest',
			'size'			=> 's',
		));

		$title     	= $instance['title'];
		$type	   	= empty( $instance['type'] ) ? 'user' : $instance['type'];
		$flickr_id 	= $instance['flickr_id'];
		$count 		= (int) $instance['count'];
		$display 	= empty( $instance['display'] ) ? 'latest' : $instance['display'];
		$size 		= isset( $instance['size'] ) ? $instance['size'] : 's';
		// print the before widget
		echo $args['before_widget'];
		if ( $title )
			echo $args['before_title'] . $title . $args['after_title'];
	
		echo "<div class='flickr-images-wrapper'>";	
			$protocol = is_ssl() ? 'https' : 'http';
			if ( ! empty( $instance['flickr_id'] ) ){
				echo "<script type='text/javascript' src='$protocol://www.flickr.com/badge_code_v2.gne?count=$count&amp;display=$display&amp;size=$size&amp;layout=x&amp;source=$type&amp;$type=$flickr_id'></script>";
			}else{
				echo '<p>' . __('Please Enter an Flickr ID', 'hsktalents') . '</p>';
			}
		echo '</div>';		
		// Print the after widget
		echo $args['after_widget'];
	}
	function form( $instance ) {
		$instance = wp_parse_args($instance,array(
			'title'			=> 'Title',
			'type'			=> 'user',
			'flickr_id'		=> '71865026@N00',
			'count'			=> 6,
			'display'		=> 'latest',
			'size'			=> 's',
		));		
		$types = array( 
			'user'  => esc_attr__( 'user', 'hsktalents' ), 
			'group' => esc_attr__( 'group', 'hsktalents' )
		);
		$sizes = array(
			's' => esc_attr__( 'Standard', 'hsktalents' ), 
			't' => esc_attr__( 'Thumbnail', 'hsktalents'),
			'm' => esc_attr__( 'Medium','hsktalents')
		);
		$displays = array( 
			'latest' => esc_attr__( 'latest', 'hsktalents'),
			'random' => esc_attr__( 'random', 'hsktalents' )
		);	
		?>		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','hsktalents'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type', 'hsktalents' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
				<?php foreach ( $types as $key => $type ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['type'], $key ); ?>><?php echo esc_html( $type ); ?></option>
				<?php } ?>
			</select>
			<span><?php _e( 'The type of images from user or group.','hsktalents'); ?></span>			
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID', 'hsktalents'); ?></label>					
			<input id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr( $instance['flickr_id'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number', 'hsktalents'); ?></label>
			<input class="small-text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr( $instance['count'] ); ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Method', 'hsktalents'); ?></label>			
			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
				<?php foreach ( $displays as $key => $display ) { ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['display'], $key ); ?>><?php echo esc_html( $display ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('sizes'); ?>"><?php _e( 'Sizes', 'hsktalents' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
				<?php foreach ( $sizes as $key => $size ) { ?>
					<option value="<?php echo $key; ?>" <?php selected( $instance['size'], $key ); ?>><?php echo $size; ?></option>
				<?php } ?>
			</select>		
		</p>		
		<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Flickr_Badges_Widget");'));
?>