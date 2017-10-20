<?php
class HSK_Client_Logos extends WP_Widget {
	function __construct() {
		parent::__construct('hsk-clients-logos',
	    __('HSK - Client Logos','hsktalents'),
	    array('description' => __('This is used to display the clinet logo images', 'hsktalents'))
	    );

	}

	function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title'        => '',
			'columns'      => '4',
			'logo_image1'  => '',
			'logo_link1'   => '',
			'logo_image2'  => '',
			'logo_link2'   => '',
			'logo_image3'  => '',
			'logo_link3'   => '',
			'logo_image4'  => '',
			'logo_link4'   => '',
			'logo_image5'  => '',
			'logo_link5'   => '',
			'logo_image6'  => '',
			'logo_link6'   => '',
			'logo_image7'  => '',
			'logo_link7'   => '',
			'logo_image8'  => '',
			'logo_link8'   => '',
			'logo_image9'  => '',
			'logo_link9'   => '',
			'logo_image10'  => '',
			'logo_link10'   => '',
		));

		$title       = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');

		$image_array = array();
		$link_array  = array();

		$j = 0;
		for ( $i = 1; $i < 6; $i++ ) {
			$image_link = 'logo_link'.$i;
			$image_url  = 'logo_image'.$i;
			$image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
			$image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
			array_push( $link_array, $image_link );
			array_push( $image_array, $image_url );
			$j++;
		}

		echo $args['before_widget']; ?>

			<div class="clients-column-wrapper">
			<?php if ( !empty( $title ) ) { ?>
				<?php echo $before_title. esc_html( $title ) . $after_title; ?>
			<?php }

			$output = '';
			if ( !empty( $image_array ) ) {
				$output .= '<ul class="hsk-extra-width">';
				for ( $i = 1; $i < 11; $i++ ) {
					$j = $i - 1;
					if( !empty( $image_array[$j] ) ) {
						$output .= '<li class="hsk-column-5">';
						if( !empty( $link_array[$j] ) ) {
							$output .= '<a href="'.esc_url($link_array[$j]).'" class="logo-link" target="_blank"><img src="'.esc_url($image_array[$j]).'"></a>';
						} else {
							$output .= '<img alt="'.get_the_title().'" src="'.esc_url($image_array[$j]).'">';
						}
						$output .= '</li>';
					}
				}
				$output .= '</ul>';
				echo $output;
			}
			?>
			</div>
		<?php
		echo $args['after_widget'];
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title'        => '',
			'columns'      => '4',
			'logo_image1'  => '',
			'logo_link1'   => '',
			'logo_image2'  => '',
			'logo_link2'   => '',
			'logo_image3'  => '',
			'logo_link3'   => '',
			'logo_image4'  => '',
			'logo_link4'   => '',
			'logo_image5'  => '',
			'logo_link5'   => '',
			'logo_image6'  => '',
			'logo_link6'   => '',
			'logo_image7'  => '',
			'logo_link7'   => '',
			'logo_image8'  => '',
			'logo_link8'   => '',
			'logo_image9'  => '',
			'logo_link9'   => '',
			'logo_image10'  => '',
			'logo_link10'   => '',
		));	?>
	<div class="widgets-fields-group-panel"> 
	<h4><?php esc_html_e( 'Add your clients logo Here', 'hsktalents' ); ?></h4>
	<?php
		for ( $i = 1; $i < 11 ; $i++ ) {
			$image_link = 'logo_link'.$i;
			$image_url = 'logo_image'.$i;
	?>
	<p>
		<label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php esc_html_e( 'Logo Link ', 'hsktalents' ); echo $i; ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php esc_html_e( 'Logo Image ', 'hsktalents' ); echo $i; ?></label>
		<div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
			<div class="custom_media_preview">
				<?php if ( $instance[ $image_url ] != '' ) : ?>
					<img class="custom_media_preview_default" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url( $instance[ $image_url ] ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo esc_url( $instance[$image_url] ); ?>" style="margin-top:5px;" />
			<button class="custom_media_upload button button-secondary button-large" id="<?php echo $this->get_field_id( $image_url ); ?>" data-choose="<?php esc_attr_e( 'Choose an image', 'hsktalents' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'hsktalents' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'hsktalents' ); ?></button>
		</div>
	</p>

	<?php } // Loop ending
	echo '</div>';
	}

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Client_Logos");'));
?>