<?php add_shortcode( 'test_page', 'hsk_instagram' );
add_action( 'http_request_args', 'hsk_http_request_args', 10, 2 );
function hsk_http_request_args( $args, $url ) {
    $args['sslverify'] = false;
    return $args;
}
 function hsk_instagram( $atts, $content = null ) {
 	extract(shortcode_atts(array(
		'count' => 9,
		'user_id' =>'User ID',
		'access_token' => 'Add your access token',
		'height' => '80',
		'width' => '80',
		), $atts));
    // define main output
    $str    = "";
    $str   .= "<div class='instgram-feed-images-wrapper'>";
    $instgram_api_data = wp_remote_get( "https://api.instagram.com/v1/users/{$user_id}/media/recent?access_token={$access_token}&count={$count}" );

    if ( is_wp_error( $instgram_api_data ) ) {
        // error handling
        $error_message = $instgram_api_data->get_error_message();
        $str      = "Something went wrong: $error_message";
    } else {
        // processing further
        $instagram_data    = json_decode( $instgram_api_data['body'] );
        $instgram_user_info = array();
        $n         = 0;
        
        // get username and actual thumbnail
        foreach ( $instagram_data->data as $user_info ) {
            $instgram_user_info[ $n ]['user']      = $user_info->user->username;
            $instgram_user_info[ $n ]['thumbnail'] = $user_info->images->thumbnail->url;
            $n++;
        }
        // create main string, pictures embedded in links
        foreach ( $instgram_user_info as $data ) {
        	$str .= '<div class="instagram-user-images" width="'.$width.'" height="'.$height.'">';
            	$str .= '<a target="_blank" href="http://instagram.com/'.$data['user'].'"><img src="'.$data['thumbnail'].'" alt="'.$data['user'].'" width="'.$width.'" height="'.$height.'"></a> ';
            $str .= '</div>';
        }
    }
    $str   .= "</div>";
    return $str;
}

/**
*  Instagram Widgets
*/
class HSK_Instagram_Widget extends WP_Widget
{
	
	function __construct()
	{
		parent::__construct('hsk-instagram',__('HSK - Instagram','hsktalents'),
			array('description' => __('Use this widget to display instagram feeds','hsktalents'))
		);
	}
	function widget($args, $instance){
		$instance = wp_parse_args($instance, array(
			'count' => 9,
			'user_id' =>'User ID',
			'access_token' => 'Add your access token',
			'height' => '80',
			'width' => '80',
		));
		
		echo do_shortcode('[test_page count="'.$instance['img_count'].'" user_id="'.$instance['user_id'].'" access_token="'.$instance['access_token'].'" width="'.$instance['width'].'" width="'.$instance['height'].'"]');
	}
	function form($instance){
		$instance = wp_parse_args($instance, array(
			'count' => 3,
			'user_id' =>'205142375',
			'access_token' => '205142375.3a81a9f.38c100be598a4a0e9a31aef7b1e9c2e3',
			'height' => '80',
			'width' => '80',	
		)); ?>
		

        <p>
		    <label for="<?php echo $this->get_field_id('user_id') ?>">  <?php _e("Instgram User ID",'hsktalents')?>  </label>
		    <input type="text" name="<?php echo $this->get_field_name('user_id') ?>" id="<?php echo $this->get_field_id('user_id') ?>" class="widefat" value="<?php echo $instance['user_id'] ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('access_token') ?>">  <?php _e("Instgram Access Token Key",'hsktalents')?>  </label>
		    <input type="text" name="<?php echo $this->get_field_name('access_token') ?>" id="<?php echo $this->get_field_id('access_token') ?>" class="widefat" value="<?php echo $instance['access_token'] ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('count') ?>">  <?php _e("Instgram Images Count",'hsktalents')?>  </label>
		    <input type="text" name="<?php echo $this->get_field_name('count') ?>" id="<?php echo $this->get_field_id('count') ?>" class="widefat" value="<?php echo $instance['count'] ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('width') ?>">  <?php _e("Instgram Images Width",'hsktalents')?>  </label>
		    <input type="text" name="<?php echo $this->get_field_name('width') ?>" id="<?php echo $this->get_field_id('width') ?>" class="small-text" value="<?php echo $instance['width'] ?>" />
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id('height') ?>">  <?php _e("Instgram Images Count",'hsktalents')?>  </label>
		    <input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="small-text" value="<?php echo $instance['height'] ?>" />px
		</p>

	<?php		
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Instagram_Widget");'));