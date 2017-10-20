<?php
get_header();
echo hsk_non_logged_user_msg(); // Display non-logged in user message, when user click on rivew, follow us buttons and like ...
$post_id = get_the_ID();
echo '<div class="hsk-talent-page-title-wrapper">';
echo '<div class="container">';
	echo '<div class="talent-content-wrapper hsk-column9 ">';
		// Displat talent image, rating and buttons
		hsk_get_talent_img_details($post_id);
	echo '</div>';
	echo '<div class="hsk-column3 talent-details-list">';
		// display talent details( likes, reivew, dedication and Account id)
		hsk_talents_likes_views();
	echo '</div>';
	echo '</div>';
echo '</div>';
// End
echo '<section id="mid-content-wrapper" >';
	echo '<div id="mid-container" class="container">';
		echo '<div class="hsk-column3 hsk-talent-single-left-column">';
			hsk_talent_email_phone_verified();
			// Talents Information
			hsk_get_talent_information($post_id);
			// Talents Social Follow social media icons
			echo hsk_social_follow_icons();
			// Talents Tags
			hsk_get_talent_tags($post_id);
			// Talents followers
			hsk_talent_follwers($post_id);
			// Rating & Reviews
			hsk_get_talent_review_rating($post_id);	
		echo '</div>';
		echo '<div class="hsk-column9 hsk-talent-single-left-column">';
			if( isset($_REQUEST['rating_more']) && ($_REQUEST['rating_more'] == 'true') ){
				echo '<div class="hsk-rating-followers-tab">';
					echo '<ul class="hsk-tabs">';
						echo '<li class="hsk-tab-link current" data-tab="rating-info">'.__('Rating Information', 'hsktalents').'</li>';
						echo '<li class="hsk-tab-link" data-tab="followers-info">'.__('Followers Information', 'hsktalents').'</li>';
					echo '</ul>';
				
					echo '<div id="rating-info" class="tab-content-info current hsk-talent-rating-info">';
						echo hsk_talent_rating_info($post_id, $limit='5000');
					echo '</div>';
					echo '<div id="followers-info" class="tab-content-info hsk-talent-followers-info">';
						hsk_talent_get_followers_info($post_id, $limit='5000');
					echo '</div>';
				echo '</div>'; 
			}else{
				echo '<div class="hsk-talent-tabs-content-wrapper">';
					echo hsk_talent_single_tabs();
					echo hsk_talent_tab_images_data();
					echo hsk_talent_tab_videos_data();
					echo hsk_talent_tab_wysiwyg_data();
				echo '</div>';
			}
			hsk_get_realated_talents();
		echo '</div>';
		// Facebook Comment Section
		echo hsk_facebook_comments();
	echo '</div>';
	echo hsk_rating_form();
	echo hsk_talent_enquiry_form();
echo '</section>';
get_footer();
?>