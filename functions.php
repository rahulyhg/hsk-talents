<?php
/*
function __autoload($classes){
	require_once 'shortcodes/'.$classes.'.php';
	echo 'shortcodes/'.$class.'.php';
} */
/**
 * Image resize Cropping Functionality
 * @param $imgurl 
 * @param $width
 * @param $height
 * @param $crop
 *        -- (bool) true / false
 */
if(!function_exists('hsk_image_crop')){
	function hsk_image_crop($imgurl, $width, $height, $crop=true, $align='c', $retina=false){
		return mr_image_resize($imgurl, $width, $height, $crop=true, $align='c', $retina=false);
	}
}
/**
 * Get post image based on post ID
 * @param int post_id
 * @param int width
 * @param int height
 */
function hsk_post_image($post_id, $width, $height){
	$imgurl=wp_get_attachment_url( get_post_thumbnail_id() );
	if( $imgurl ){
		return sprintf('<img  src="'.hsk_image_crop($imgurl, $width, $height, true).'" alt="'.get_the_title($post_id).'" width="'.$width.'" height="'.$height.'">');
	}else{
		return hsk_talent_placeholder($width, $height);
	}
}

/**
 * Get default image
 * @param int width
 * @param int height
 */
function hsk_talent_placeholder($width, $height){
	$default_img = HSK_PLUGIN_PATH . 'includes/assests/images/talent-placeholder.jpg';
	return apply_filters('hsk_talent_placeholder', '<img src="' . $default_img . '" alt="' . esc_attr__( 'Talent placeholder Image', 'hsktalents' ) . '" height = "'.$height.'" width= "'.$width.'" class="wp-post-image"  />',  $width, $height );

}

/**
 * Get default image
 * @param int width
 * @param int height
 */
function hsk_placeholder($width, $height){
	$default_img = HSK_PLUGIN_PATH . 'includes/assests/images/placeholder.png';
	return apply_filters('hsk_placeholder', '<img src="' . $default_img . '" alt="' . esc_attr__( 'Default Image', 'hsktalents' ) . '" height = "'.$height.'" width= "'.$width.'" class="wp-post-image"  />',  $width, $height );

}
/**
 * Convert String to array
 * @param (string) string array_sting
 */
if( !function_exists('hsk_string_to_array') ){
  function hsk_string_to_array($array_sting){
     $array_sting = trim(nl2br($array_sting));
     $array_sting = str_replace('<br />', ",", trim($array_sting));
     $array_sting =  preg_replace( "/\r|\n/", "", trim($array_sting) );
     return trim($array_sting);
  }
}

/**
 * display non logged in user message, like please login
 */
function hsk_non_logged_user_msg(){
	if( !is_user_logged_in() ){ // Non-Logged users rating and followers
		$non_logged_msg = hsk_talents_opt_data('user_logged_in_msg',__('Please, First You Need To Login', 'hsktalents'));
		return '<div class="hsk-non-user-logged-in alert hsk-error-msg">'.$non_logged_msg.'</div>';
	}
}

/**
 * Get Talent information based on post id
 * @param (int) post_id
 */
function hsk_meta_opt_data($post_id, $related="true"){
	global $hsk_talent_meta_opt;
	$tab = 0;
	if( !empty($hsk_talent_meta_opt['tabs_name']) ){
		echo '<ul>';
		foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $user_tab) {
			$tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
			
			for ($i=0; $i < 100; $i++) {
				if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){

					$id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
					$talent_cat_id = get_post_meta(get_the_ID(), 'talents_meta_category', true);
					//echo $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i];
					if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'text' ){ // text
						$opt_val = get_post_meta($post_id, 'talent_'.$id , true);
					}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'dob' ){ // Date Of Birth
						$age_data = get_post_meta($post_id, 'talent_'.$id , true);
						$opt_val = !empty($age_data) ? hsk_get_age($age_data) : '';
					}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'panel_title' ){ // Pane title
						//echo $tab_info = get_post_meta($post_id, 'talent_'.$id , true);
						if( ($tab_id == $talent_cat_id) || ($talent_cat_id == '')  ){
							if( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ){
								$opt_val = '</ul><ul><h6>'.$hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i].'</h6>';
							}else{
								$opt_val = '';
							}
						}
					}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'website' ){ // website Link
						$url_info = get_post_meta($post_id, 'talent_'.$id , true);
						if( !empty($url_info) ){
							$opt_val = '<a target="_blank" t href="'.esc_url($url_info).'">'.$url_info.'</a>';
						}else{
							$opt_val = '';
						}
					}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'checkbox' ){ // text
						$options_data = get_post_meta($post_id, 'talent_'.$id , false);
						$opt_val = implode(',', $options_data);
					}elseif( ($hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'images') || ( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'videos' ) ||  ( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'compcard' ) || ( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'textarea' ) || ( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'wysiwyg' ) || ($hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'panel_title') ){ // text
						$opt_val = '';
					}else{
						$opt_val = get_post_meta($post_id, 'talent_'.$id , true);
					}
					if( !empty($opt_val) && ( $hsk_talent_meta_opt['talent_option_visibility'][$tab_id][$i] == 'true') ) {
						if(( ($hsk_talent_meta_opt['talent_option_dsiplay_on_img'][$tab_id][$i] == 'true') && !is_single() ) || is_single() ){
							if( ($hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] != 'panel_title') || ($related== 'false') && ($hsk_talent_meta_opt['talent_option_dsiplay_on_img'][$tab_id][$i] != 'panel_title')  ){

								if( ($tab_id == $talent_cat_id) || ($talent_cat_id == '')  ){
									if( ($related== 'false') && ($hsk_talent_meta_opt['talent_option_dsiplay_on_img'][$tab_id][$i] == 'true') ){
										echo '<li><span><b>'.trim($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]).'</b> : '.$opt_val.'</span></li>';
									}elseif($related== 'true'){
										echo '<li><span><b>'.trim($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]).'</b> : '.$opt_val.'</span></li>';
									}else{

									}
								}
							}else{
								echo $opt_val;
							}
						}
					}
				}
			}
			
			$tab++;
		}
		echo '</ul>';
	}
}

/**
 * Get talent post images, videos and textarea data for creating tabs and other...
 * @param (int) post_id
 * @param (string) field_name ex: image, video, texarea like
 */
function hsk_meta_opt_selected_data($post_id, $field_name){
	global $hsk_talent_meta_opt, $opt_val;
	$tab = 0;
	$opt_val = '';
	if( !empty($hsk_talent_meta_opt['tabs_name']) ){
		//echo '<ul>';
		foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $user_tab) {
			$tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
			
			for ($i=0; $i < 100; $i++) {
				if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){

					$id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
					$opt_id = 'talent_'.$id;
					if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] === $field_name ){ // text
						//$opt_val[] = $hsk_talent_meta_opt['talent_options_field_heading'][$tab_id][$i];
						if( $field_name == 'checkbox' ){
							$val = false;
							$opt_val[] = get_post_meta($post_id, $opt_id , $val);
							$opt_val[] =  $opt_id;
							$opt_val[] = $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i];
							//echo !empty($opt_val) ? '<li>'.implode(', ', $opt_val).'</li>' : '';
						}elseif( ($field_name == 'images') || ( $field_name == 'compcard' ) ){
							$val = false;
							$opt_val[] = get_post_meta($post_id, $opt_id , $val);
							$opt_val[] =  $opt_id;
							$opt_val[] = $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i];
							//echo !empty($opt_val) ? '<li>'.implode(', ', $opt_val).'</li>' : '';
						}elseif( ($field_name == 'wysiwyg' ) ){
							$val = true;
							$opt_val[] = get_post_meta($post_id, $opt_id , $val);
							$opt_val[] =  $opt_id;
							$opt_val[] = $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i];
							//echo !empty($opt_val) ? '<li>'.implode(', ', $opt_val).'</li>' : '';
						}else{
							$val = true;
							$opt_val[] = get_post_meta($post_id, $opt_id , $val);
							$opt_val[] =  $opt_id;
							$opt_val[] = $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i];
							//echo !empty($opt_val) ? '<li>'.trim($opt_val).'</li>' : '';
						}
					}
					
				}
			}
			$tab++;
		}
		//echo '</ul>';
		//if( !empty($opt_val) ){
		//	return $opt_val = array_map("unserialize", array_unique(array_map("serialize", $opt_val)));
		//}else{
			return $opt_val;
		//}
		//return $opt_val;
	}
}
// Talent Data

/**
 * Get talent post images, videos and textarea data for creating tabs and other...
 * @param (int) post_id
 * @param (string) field_name ex: image, video, texarea like
 */
function hsk_meta_opt_field_data($post_id, $field_name){
	global $hsk_talent_meta_opt, $opt_val;
	$tab = 0;
	$opt_val = '';
	if( !empty($hsk_talent_meta_opt['tabs_name']) ){
		//echo '<ul>';
		foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $user_tab) {
			$tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
			
			for ($i=0; $i < 100; $i++) {
				if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){

					$id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
					$opt_id = 'talent_'.$id;
					if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] === $field_name ){ // text
						return $opt_id;
					}
					
				}
			}
			$tab++;
		}
			return $opt_val;
	}
}

/**
 * Enquiry form
 */
function hsk_talent_enquiry_form(){
    echo '<div class="hsk-talent-enquiry-form">';
        echo '<div class="hsk-talents-form">';
            echo '<span class="enquiry-form-close">X</span>';
            echo '<div class="hsk-talent-enquiry-msg"></div>';
            echo '<div class="hsk-form-styles">';
                echo '<input type="hidden" name="hsk_talent_url" id="hsk_talent_url" value="'.get_the_permalink().'">';
                echo '<p>';
                    echo '<input type="text" required name="hsk_enquiery_name" id="hsk_enquiery_name" value="" placeholder="'.__('Name', 'hsktalents').'">';
                echo '</p>';
                echo '<p>';
                    echo '<input type="email" required name="hsk_enquiery_email" id="hsk_enquiery_email" value="" placeholder="'.__('Email', 'hsktalents').'">';
                echo '</p>';
                echo '<p>';
                    echo '<input type="number" required name="hsk_enquiery_contact_num" id="hsk_enquiery_contact_num"  value="" placeholder="'.__('Phone number', 'hsktalents').'">';
                echo '</p>';
                echo '<p>';
                    echo '<textarea required name="hsk_enquiery_description" id="hsk_enquiery_description"  placeholder="'.__('Enquiry description','hsktalents').'"></textarea>';
                echo '</p>';
                echo '<p class="button">';
                    echo '<input type="submit" name="hsk_talent_submit" id="hsk_talent_enquiry_submit" value="'. __("Talent Enquiry", "hsktalent").'">';
                echo '</p>';

            echo '</div>';
        echo '</div>';
    echo '</div>';
}


/**
 * Rating Fileds
 */
function hsk_rating_form(){
	global $hsk_user_id;
	?>
	<div class="hsk-rating-form-wrapper">
		<div id="hsk-rating-form" class="hsk-form-styles">
			<span class="hsk-form-close">X</span>
			<fieldset class="rating">
				<div> 			
					<input type="hidden" name="hsk_user_id" id="hsk_user_id" value="<?php echo $hsk_user_id; ?>">
					<input type="hidden" name="hsk_post_id" id="hsk_post_id" value="<?php echo get_the_ID(); ?>">
					<input class="hsk_rating" type="radio" id="star5" name="hsk_rating" value="5" required />
					<label class = "full" for="star5" title="Awesome - 5 stars"></label>
					<input class="hsk_rating" type="radio" id="star4" name="hsk_rating" value="4" required />
					<label class = "full" for="star4" title="Pretty good - 4 stars"></label>
					<input class="hsk_rating" type="radio" id="star3" name="hsk_rating" value="3" required />
					<label class = "full" for="star3" title="Meh - 3 stars"></label>
					<input class="hsk_rating" type="radio" id="star2" name="hsk_rating" value="2" required />
					<label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
					<input class="hsk_rating" type="radio" id="star1" name="hsk_rating" value="1" required />
					<label class = "full" for="star1" title="Sucks big time - 1 star"></label>
				</div>	        
				<p>
					<textarea name="hsk_rating_comment" id="hsk_rating_comment" placeholder="<?php _e('Your Rating Comment', 'hsktalents'); ?>"></textarea>
				</p>
				<p class="button">
					<input type="submit" name="hsk_talent_submit" id="hsk_talent_submit" value="<?php _e('Your Rating', 'hsktalents'); ?>">
				</p>
			</fieldset>
    	</div>
    </div>
	<?php
}
/**
 * Displat talent image, rating and buttons
 *  @param (int) $post_id
 */
function hsk_get_talent_img_details($post_id){
	echo '<div class="talent-content-details" id="hsk-talent-rating-add-info">';
		hsk_talent_title_image($post_id);
		echo '<div class="hsk-title-rating-wrapper">';		
			echo '<h3>'.get_the_title().'</h3>';
			if( hsk_talents_opt_data('disable_talents_rating', '0') != '1' ){
				echo hsk_talents_rating();
			}
		echo '</div>';
		hak_talent_profile_buttons();
	echo '</div>';
}
/**
 * Display Talant information in Talent single page
 * @param (int) $post_id
 */
function hsk_get_talent_information($post_id){
	echo '<div class="talent-single-info-wrapper hsk-talents-sidebar">';
		//echo '<h5>'.esc_html__('Talent Information', 'hsktalents').'</h5>';
		echo hsk_meta_opt_data($post_id, 'true');
	echo '</div>';
}
/**
 * Display Talant information in Talent single page
 * @param (int) $post_id
 */
function hsk_get_talent_info($post_id){
	echo hsk_meta_opt_data($post_id, 'true');
}
/**
 * Display Talent Tags in talent single page
 * * @param (int) $post_id
 */
function hsk_get_talent_tags($post_id){
	if( false != get_the_term_list( $post_id, 'talent_tag' ) ) {
		echo '<div class="hsk-talents-sidebar hsk-talents-tags">';
			hsk_talent_tags($post_id);
		echo '</div>';
	}
}
/**
 * Display Talent followers in talent single page
 * @param (int) $post_id
 */
function hsk_talent_follwers($post_id){
	if( !empty(hsk_talent_followers_ids($post_id)) ){
		if( hsk_talents_opt_data('disable_talents_followers', '0') != '1' ){
			echo '<div class="hsk-talents-sidebar hsk-talents-followers">';
				echo '<h5>'.hsk_talents_opt_data('talent_following_button_text', __('Followers', 'hsktalents')).'</h5>';
				hsk_talent_followers($post_id);
			echo '</div>';
		}
	}
}
/**
 * Display Talants rating in talent single page
 * @param (int) $post_id
 */
function hsk_get_talent_review_rating($post_id){
	if(!empty(hsk_talent_check_rating($post_id)) ){
		if( hsk_talents_opt_data('disable_talents_rating', '0') != '1' ){
			echo '<div class="hsk-talents-sidebar hsk-talents-rating-info">';
				echo '<h5>'.hsk_talents_opt_data('review_rating_text_change', __('Review & Rating', 'hsktalents')).'</h5>';
				echo hsk_talent_rating_info($post_id);
			echo '</div>';
		}
	}
}
/**
 * Talent Email & Phone number Verification
 * @param (int) $post_id
 */
function hsk_talent_email_phone_verified(){
	echo '<div class="hsk-talents-sidebar hsk-talents-phone-email-info">';
		echo '<h5>'.hsk_talents_opt_data('email_phone_trust', __('TRUST', 'hsktalents')).'</h5>';
		$email = get_post_meta(get_the_ID(), 'hsk_email_verified', true);
		$phone = get_post_meta(get_the_ID(), 'hsk_phone_verified', true);
		//if($email){
		echo '<div class="email-phone-verification">';	
			echo '<i class="fa fa-envelope"></i>';
			echo (!empty($email) && ( $email == '1' ) ) ? '<span title="'.__('Email ID verified', 'hsktalents').'" class="hsk-talent-verified fa fa-check"></span>' : '<span title="'.__('Email ID Not verified', 'hsktalents').'" class="fa fa-close"></span>';
		echo '</div>';	
		//}
		//if($email){
		echo '<div class="email-phone-verification">';
			echo '<i class="fa fa-phone"></i>';
			echo (!empty($phone) && ( $phone == '1' ) ) ? '<span title="'.__('Phone Number verified', 'hsktalents').'" class="hsk-talent-verified fa fa-check"></span>' : '<span title="'.__('Phone Number Not verified', 'hsktalents').'" class="fa fa-close"></span>';
		echo '</div>';	
		//}
	echo '</div>';
}

function hsk_talents_email_phone_verify(){
	echo '<div class="hsk-talents-sidebar hsk-talents-phone-email-info">';
		echo '<strong>'.hsk_talents_opt_data('email_phone_trust', __('TRUST', 'hsktalents')).'</strong>';
		$email = get_post_meta(get_the_ID(), 'hsk_email_verified', true);
		$phone = get_post_meta(get_the_ID(), 'hsk_phone_verified', true);
		//if($email){
		echo '<ul class="email-phone-content-wrapper">';
			echo '<li class="email-phone-verification">';	
				echo '<i class="fa fa-envelope"></i>';
				echo (!empty($email) && ( $email == '1' ) ) ? '<span title="'.__('Email ID verified', 'hsktalents').'" class="fa fa-check"></span>' : '<span title="'.__('Email ID Not verified', 'hsktalents').'" class="fa fa-close"></span>';
			echo '</li>';	
			//}
			//if($email){
			echo '<li class="email-phone-verification">';
				echo '<i class="fa fa-phone"></i>';
				echo (!empty($phone) && ( $phone == '1' ) ) ? '<span title="'.__('Phone Number verified', 'hsktalents').'" class="fa fa-check"></span>' : '<span title="'.__('Phone Number Not verified', 'hsktalents').'" class="fa fa-close"></span>';
			echo '</li>';
		echo '</ul>';
		//}
	echo '</div>';
}
/**
 * Rating data
 */
function hsk_user_rating($post_id){
	echo '<div class="hsk-talents-sidebar hsk-talents-rating-infobox">';
		echo '<div class="hsk-rating-info-wrap">';
			echo '<strong>'.hsk_talents_opt_data('rating_info_text', __('Review & Rating', 'hsktalents')).'</strong>';
			echo hsk_talent_star_rating($post_id);
		echo '</div>';
		echo '<div class="hsk_view_more_text">';
			echo '<a href="#hsk-rating-info">'.__('VIEW MORE','hsktalents').'</a>';
		echo '</div>';
	echo '</div>';	
}

function hsk_user_following($post_id){
	echo '<div class="hsk-talents-sidebar hsk-talents-follow-infobox">';
		echo '<div class="hsk-rating-info-wrap">';
			echo '<strong>'.hsk_talents_opt_data('followers_info_text', __('Followes', 'hsktalents')).'</strong>';
			echo '<div class="hsk-followers-count">'.hsk_follow_post_count(get_the_ID()).'</div>';
		echo '</div>';
		echo '<div class="hsk_view_more_text">';
			echo '<a href="#hsk-followers-info">'.__('VIEW MORE','hsktalents').'</a>';
		echo '</div>';
	echo '</div>';	
}
/**
 * Get Talent Single Page Related Talents
 */
function hsk_get_realated_talents(){
	global $post;
	if( hsk_talents_opt_data('disable_related_talents', '0') != '1' ){
		echo '<div class="hsk-related-talents-wrapper">';
			$hsk_talent_tax = wp_get_object_terms( $post->ID, 'talent_cat', array('fields' => 'ids') );
			$args = array(
				'post_type' => 'talent',
				'post_status' => 'publish',
				'posts_per_page' => '-1',
				'orderby' => 'rand',
				'tax_query' => array(
			array(
				'taxonomy' => 'talent_cat',
				'field' => 'id',
				'terms' => $hsk_talent_tax
			)),
			'post__not_in' => array ($post->ID),
			);
			$related_items = new WP_Query( $args );
			// loop over query
			if ($related_items->have_posts()) :
				echo '<h3 class="hsk-title-style1">'.hsk_talents_opt_data('related_talents_title', __('Related Talents', 'hsktalents')).'</h3>';
				echo '<div id="hsk-related-talents" class="owl-carousel owl-theme">';
					while ( $related_items->have_posts() ) : $related_items->the_post();
						$post_id = get_the_ID();
						echo '<div>';
							echo '<div class="hsk-img-zoom-animation-right">';
								echo hsk_post_image($post_id, '500', '500');
									echo hsk_post_link_open($post_id);
										echo '<div class="talent-info-wrapper">';
											echo hsk_meta_opt_data($post_id, 'false');
										echo '</div>';	
									echo hsk_post_link_close();
							echo '</div>';
							echo '<div class="hsk-talent-title-wrapper">';
								echo hsk_post_title();
	   							echo hsk_favarative_icons();
							echo '</div>';
						echo '</div>';
					endwhile;
				echo '</div>';
			endif;
		echo '</div>';
		// Reset Post Data
		wp_reset_postdata();
	}	
}


/**
 *list ShortEnquiry form
 */
function hsk_favourite_talents_enquiry_form(){
    echo '<div class="hsk-favourite-enquiry-form">';
        echo '<div class="hsk-favourite-form">';
            echo '<span class="enquiry-form-close">X</span>';
            echo '<div class="hsk-favourite-enquiry-msg"></div>';
            echo '<div class="hsk-form-styles">';
                echo '<input type="hidden" name="favourite_ids" id="favourite_ids" value="'.(!empty($_SESSION['favouritive']) ? implode(',',$_SESSION['favouritive']) : '').'">';
                echo '<p>';
                    echo '<input type="text" required name="sender_name" id="sender_name" value="" placeholder="'.__('Sender Name', 'hsktalents').'">';
                echo '</p>';
                echo '<p>';
                    echo '<input type="email" required name="sender_email" id="sender_email" value="" placeholder="'.__('Sender Email', 'hsktalents').'">';
                echo '</p>';
                echo '<p>';
                    echo '<input type="email" required name="receiver_email" id="receiver_email" value="" placeholder="'.__('Receiver Email', 'hsktalents').'">';
                echo '</p>';

                echo '<p>';
                    echo '<textarea required name="receiver_email_desc" id="receiver_email_desc" value="" placeholder="'.__('Description','hsktalents').'"></textarea>';
                echo '</p>';
                echo '<p class="button">';
                    echo '<input type="submit" name="hsk_favouritive_submit" id="hsk_favouritive_submit" value="'. __("Favouritive Enquiry", "hsktalent").'">';
                    echo '<img id="favouritive-submit-loader-img" src="'.HSK_PLUGIN_PATH.'includes/assests/images/ajax-loader.gif" style="display:none;" />';
                echo '</p>';

            echo '</div>';
        echo '</div>';
    echo '</div>';
}
function hsk_talent_cpt_post_add_meta(){
	$args = array( 'post_type' => 'talent', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	  $dob_id = hsk_meta_opt_field_data(get_the_ID(), 'dob');
	  $age = get_post_meta(get_the_ID(), $dob_id, true );
	  update_post_meta(get_the_ID(), 'search_age_update' , hsk_get_age($age));
	endwhile;
}
add_action('init', 'hsk_talent_cpt_post_add_meta');
?>