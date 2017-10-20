<?php
function hsk_talent_images($post_id, $images_id){
	return hsk_meta_opt_selected_data($post_id, $images_id);
	//print_r($data);
}
/**
 * Talent Images
 */
function hsk_talent_tab_images_data(){
	$post_id = get_the_ID();
	$talent_img_ids = hsk_talent_images($post_id, 'images');
	if( !empty($talent_img_ids)  ){		   		
		if ( is_array( $talent_img_ids ) ){
			$i=0;
			foreach ($talent_img_ids as $key => $talent_img_id) {
				//print_r($talent_img_id);
				if( is_array($talent_img_id) && !empty($talent_img_id) ){
				$div_id = !empty($talent_img_ids[$i+1]) ? $talent_img_ids[$i+1] : '';
				echo '<div class="hsk-single-talent-gallery hsk-single-talent-content" id="'.$div_id.'">';
				echo '<ul class="hsk-extra-width">';
					foreach ($talent_img_id as $key => $talent_id) {
						$image_url = wp_get_attachment_image_src($talent_id, 'full');
						if( !empty($image_url[0]) ){
							echo '<li><a href="'.esc_url($image_url[0]).'"  data-fancybox="images"><img src="'.mr_image_resize($image_url[0], '', '650', true, '', false).'" alt="'.get_the_title().'" height="480" width="480"></a></li>';
						}
					}
				echo '</ul>';	
				echo '</div>';				
			}
			$i++;
			}
		}
	}
}
/**
 * Image Tabs Name
 */
function hsk_talent_single_tabs(){
	$post_id = get_the_ID();
	$talent_img_ids = hsk_talent_images($post_id, 'images');
	$talent_videos_ids = hsk_talent_images($post_id, 'videos');
	$talent_richeditor_ids = hsk_talent_images($post_id, 'wysiwyg');

	if( !empty($talent_img_ids) || !empty($talent_videos_ids) || !empty($talent_richeditor_ids) ){
	echo '<div class="hsk-talent_tabs-wrapper">';
		echo '<ul>';
		do_action('hsk_talent_tabs_before_images');	
		 // Start Images
		if( !empty($talent_img_ids)  ){		   		
			if ( is_array( $talent_img_ids ) ){
				$i=0;
				foreach ($talent_img_ids as $key => $talent_img_id) {
					if( (is_array($talent_img_id)) && !empty($talent_img_id) ){
						$div_id = !empty($talent_img_ids[$i+1]) ? $talent_img_ids[$i+1] : '';
						$tab_name = !empty($talent_img_ids[$i+2]) ? $talent_img_ids[$i+2] : '';
						echo '<li><a href="#'.$div_id.'">'.$tab_name.'</a></li>';
					}
				$i++;
				}
			}
		} // End Images
		do_action('hsk_talent_tabs_after_images');
		// Start Videos 
		if( !empty($talent_videos_ids)  ){		   		
			if ( is_array( $talent_videos_ids ) ){
				$i=0;
				foreach ($talent_videos_ids as $key => $talent_video_id) {
					if( is_array($talent_video_id) && !empty($talent_video_id) ){
						$div_id = !empty($talent_videos_ids[$i+1]) ? $talent_videos_ids[$i+1] : '';
						$tab_name = !empty($talent_videos_ids[$i+2]) ? $talent_videos_ids[$i+2] : '';
						echo '<li><a href="#'.$div_id.'">'.$tab_name.'</a></li>';
					}
				$i++;
				}				
			}
		}
		do_action('hsk_talent_tabs_after_videos');
		// RIch Text Edior
		if( !empty($talent_richeditor_ids)  ){		   		
			if ( is_array( $talent_richeditor_ids ) ){
				$i=0;
				foreach ($talent_richeditor_ids as $key => $talent_richeditor_id) {
					if( is_array($talent_richeditor_ids) && !empty($talent_richeditor_id) ){
						$div_id = !empty($talent_richeditor_ids[$i+1]) ? $talent_richeditor_ids[$i+1] : '';
						$tab_name = !empty($talent_richeditor_ids[$i+2]) ? $talent_richeditor_ids[$i+2] : '';
						$tab_data = !empty($talent_richeditor_ids[$i]) ? $talent_richeditor_ids[$i] : '';
						if( !empty($tab_data) ){
							echo '<li><a href="#'.$div_id.'">'.ucwords($tab_name).'</a></li>';
						}
					}
				$i = $i+3;
				}				
			}
		}
		// End Vidoes
		do_action('hsk_talent_tabs_after_richtext');
		echo '</ul>';
		echo '</div>';
	}	
}
/**
 * Talent Videos 
 */
function hsk_talent_tab_videos_data(){
	$post_id = get_the_ID();
	$talent_video_ids = hsk_talent_images($post_id, 'videos');
	//print_r($talent_img_ids);
	if( !empty($talent_video_ids)  ){		   		
		if ( is_array( $talent_video_ids ) ){
			$i=0;
				foreach ($talent_video_ids as $key => $talent_video_id) {
					//print_r($talent_img_id);
					if( is_array($talent_video_id) && !empty($talent_video_id) ){
						//print_r($talent_video_id);
					$div_id = !empty($talent_video_ids[$i+1]) ? $talent_video_ids[$i+1] : '';
					echo '<div class="hsk-single-talent-video-gallery hsk-single-talent-content hsk-extra-width" id="'.$div_id.'">';
				echo '<ul>';					
						foreach ($talent_video_id as $key => $talent_id) {
							echo '<li class="hsk-column6">';
								echo wp_oembed_get($talent_id);
							echo '</li>';
						}	
						
				echo '</ul>';	
			echo '</div>';			
					}
				$i++;
				}
		}
	}
}
/**
 * Talent Videos 
 */
function hsk_talent_tab_wysiwyg_data(){
	$post_id = get_the_ID();
	$talent_wysiwyg_ids = hsk_talent_images($post_id, 'wysiwyg');
	//print_r($talent_img_ids);
	if( !empty($talent_wysiwyg_ids)  ){		   		
		if ( is_array( $talent_wysiwyg_ids ) ){
			$i=0;
			//print_r($talent_wysiwyg_ids);
				foreach ($talent_wysiwyg_ids as $key => $talent_wysiwyg_id) {
					//if( is_array($talent_wysiwyg_id) ){
					$div_id = !empty($talent_wysiwyg_ids[$i+1]) ? $talent_wysiwyg_ids[$i+1] : '';
					$tab_data = !empty($talent_wysiwyg_ids[$i]) ? $talent_wysiwyg_ids[$i] : '';
					if( !empty($tab_data) ){
						echo '<div class="hsk-single-talent-video-gallery hsk-single-talent-content hsk-extra-width" id="'.$div_id.'">';
							echo do_shortcode($tab_data);
						echo '</div>';			
					}
				$i = $i+3;
				}
		}
	}
}
/*
 * Talent Video Tab
 */
function hsk_talent_video_single_tabs(){
	
}
?>