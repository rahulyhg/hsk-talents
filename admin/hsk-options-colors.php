<?php
function hsk_talent_opt_colors(){

// Form Color Section
$form_fields_bg_color = hsk_talents_opt_data('form_fields_bg_color', '#ffffff');
$form_fields_border_color = hsk_talents_opt_data('form_fields_border_color', '#e5e5e5');
$form_fields_color = hsk_talents_opt_data('form_fields_color', '#333333');
$form_field_error_border_color = hsk_talents_opt_data('form_field_error_border_color', '#ff0000');

// Talent Grid or Category Colors
$talent_details_bg_color = hsk_talents_opt_data('talent_details_bg_color', '#8ed600');
$talent_details_color = hsk_talents_opt_data('talent_details_color', '#ffffff');
$talent_title_color = hsk_talents_opt_data('talent_title_color', '#ffffff');
$talent_favourite_icon_color = hsk_talents_opt_data('talent_favourite_icon_color', '#ffffff');
$talent_favourite_active_icon_color = hsk_talents_opt_data('talent_favourite_active_icon_color', '#353535');

// Talent Single Page title Backgroud Colors
$talent_favarative_button_bg_color = hsk_talents_opt_data('talent_favarative_button_bg_color', '#d22a78');
$talent_favarative_button_color = hsk_talents_opt_data('talent_favarative_button_color', '#353535');
$talent_following_button_bg_color = hsk_talents_opt_data('talent_following_button_bg_color', '#fff');
$talent_following_button_color = hsk_talents_opt_data('talent_following_button_color', '#353535');
$talent_enquiery_button_bg_color = hsk_talents_opt_data('talent_enquiery_button_bg_color', '#8e8e8e');
$talent_enquiery_button_color = hsk_talents_opt_data('talent_enquiery_button_color', '#ffffff');
$talent_share_button_bg_color = hsk_talents_opt_data('talent_share_button_bg_color', '#d22a78');
$talent_share_button_color = hsk_talents_opt_data('talent_share_button_color', '#fff');
$talent_titlebar_bg_color = hsk_talents_opt_data('talent_titlebar_bg_color', '#222222');
$talent_titlebar_title_color = hsk_talents_opt_data('talent_titlebar_title_color', '#fff');
$talent_titlebar_rating_color = hsk_talents_opt_data('talent_titlebar_rating_color', '#d22a78');
$talent_titlebar_img_left_border_color = hsk_talents_opt_data('talent_titlebar_img_left_border_color', '#d22a78');
$talent_titlebar_content_color = hsk_talents_opt_data('talent_titlebar_content_color', '#757575');
// Talent Single Left Section Colors
$talent_left_section_title_bg_color = hsk_talents_opt_data('talent_left_section_title_bg_color', '#8ed600');
$talent_left_section_title_color = hsk_talents_opt_data('talent_left_section_title_color', '#ffffff');
$talent_left_section_content_bg_color = hsk_talents_opt_data('talent_left_section_content_bg_color', '#f5f5f5');
$talent_left_section_content_color = hsk_talents_opt_data('talent_left_section_content_color', '#555555');
$talent_left_section_rating_color = hsk_talents_opt_data('talent_left_section_rating_color', '#689a01');
$talent_left_section_link_color = hsk_talents_opt_data('talent_left_section_content_link_color', '#353535');
$talent_left_section_link_hover_color = hsk_talents_opt_data('talent_left_section_content_link_hover_color', '#689a01');

// Talent Single Right Section Colors
$talent_right_section_tabs_bg_color = hsk_talents_opt_data('talent_right_section_tabs_bg_color', '#8ed600');
$talent_right_section_tabs_color = hsk_talents_opt_data('talent_right_section_tabs_color', '#ffffff');
$talent_right_section_tabs_active_bg_color = hsk_talents_opt_data('talent_right_section_tabs_active_bg_color', '#689a01');
$talent_right_section_tabs_active_link_color = hsk_talents_opt_data('talent_right_section_tabs_active_link_color', '#ffffff');

// Favourive Page Buttons Colors
$favourite_buttons_bg_color = hsk_talents_opt_data('favourite_buttons_bg_color', '#f5f5f5');
$favourite_buttons_color = hsk_talents_opt_data('favourite_buttons_color', '#353535');
$favourite_buttons_hover_color = hsk_talents_opt_data('favourite_buttons_hover_color', '#689a01');

// Favourive Page Buttons Colors
$search_form_bg_color = hsk_talents_opt_data('search_form_bg_color', '#16202a');
$search_form_fields_border_color = hsk_talents_opt_data('search_form_fields_border_color', '#f2f3ee');
$search_form_fields_color = hsk_talents_opt_data('search_form_fields_color', '#404040');
$search_form_button_bg_color = hsk_talents_opt_data('search_form_button_bg_color', '#d22978');
$search_form_button_color = hsk_talents_opt_data('search_form_button_color', '#fff');
$search_form_label_color = hsk_talents_opt_data('search_form_label_color', '#ffffff');


// Applying styles
$css = '';

//  Start Input Fields Colors
$css .='.hsk-form-styles input, .hsk-form-styles textarea, .hsk-form-styles select{
			background-color:'.$form_fields_bg_color.';
			border-color:'.$form_fields_border_color.';
			color:'.$form_fields_color.';
		}
		.hsk-form-styles input.hsk-error-field{
			border-color:'.$form_field_error_border_color.'!important;
		}';
// End;
// Talent Grid or Category Colors
$css .="[class^='hsk-img-'] .talent-info-wrapper, [class*=' hsk-img-'] .talent-info-wrapper{
			background-color:".$talent_details_bg_color.";
			color:".$talent_details_color.";
		}
		.hsk-talent-title-wrapper h5 a{
			color:".$talent_title_color.";
		}
		.talent-add-favourite{
			color:".$talent_favourite_icon_color.";
		}
		.talent-remove-favourite.favourite-item-type{
			color:".$talent_favourite_active_icon_color.";
		}";
// End;

//  Single Page buttons Colors Settings
$css .='.single-talent .hsk-talent-page-title-wrapper{
			background-color:'.$talent_titlebar_bg_color.';
		}
		.single-talent .hsk-talent-page-title-wrapper, .single-talent .hsk-talent-page-title-wrapper span, .single-talent .hsk-talent-page-title-wrapper strong, .single-talent .hsk-talent-page-title-wrapper ul li{
			color:'.$talent_titlebar_content_color.';

		}
		.hsk-talent-page-title-wrapper .avathar{
			border-left-color:'.$talent_titlebar_img_left_border_color.';
		}
		.single-talent .talent-content-details h3{
			color:'.$talent_titlebar_title_color.';
		}
		.hsk-title-rating-wrapper .star-rating, .hsk-title-rating-wrapper .star-rating span, .single-talent .hsk-talent-page-title-wrapper .avg-rating-count{
			color:'.$talent_titlebar_rating_color.';
		}
		.hsk-talent-favarative.hsk-page-title-button, a.hsk-talent-vote, a.hsk-talent-follow, a.hsk-talent-enquiry, .hsk-talent-followed, a.hsk-page-title-button, .hsk-page-title-button{
			background-color:'.$talent_favarative_button_bg_color.';
			color:'.$talent_favarative_button_color.';
		}
		.talent-button-info .hsk-talent-followed, .talent-button-info .hsk-talent-follow{
			background-color:'.$talent_following_button_bg_color.';
			color:'.$talent_following_button_color.';
		}
		.hsk-talent-follow-count{
			color:'.$talent_following_button_bg_color.';
		}
		a.hsk-talent-enquiry{
			background-color:'.$talent_enquiery_button_bg_color.';
			color:'.$talent_enquiery_button_color .';
		}
		.hsk-talent-share-icons .talent-share, .hsk-talent-social-icons ul li a{
			background-color:'.$talent_share_button_bg_color.';
			color:'.$talent_share_button_color.'!important;
		}
		 .hsk-talent-social-icons ul li a:hover{
			background-color:'.$talent_share_button_color.';
			color:'.$talent_share_button_bg_color.'!important;
		}';
// End;

//  Single Page Left Colors Settings
$css .='.hsk-talents-sidebar h5, .hsk-talents-sidebar h6{
			background-color:'.$talent_left_section_title_bg_color.'!important;
			color:'.$talent_left_section_title_color.';
		}
		.hsk-talents-sidebar{
			background-color:'.$talent_left_section_content_bg_color.';
			color:'.$talent_left_section_content_color.';
		}
		.hsk-talents-sidebar a{
			color:'.$talent_left_section_link_color.';
		}
		.hsk-talents-sidebar a:hover{
			color:'.$talent_left_section_link_hover_color.';
		}
		.hsk-talents-sidebar .star-rating span, .hsk-talents-sidebar .star-rating{
			background-color:'.$talent_left_section_content_bg_color.';
			color:'.$talent_left_section_rating_color.';
		}';
// End;

//  Single Page Right Colors Settings
$css .='.hsk-related-talents-wrapper h3, .hsk-talent_tabs-wrapper ul, .hsk-talent_tabs-wrapper ul li a, .hsk-rating-followers-tab .hsk-tabs{
			background-color:'.$talent_right_section_tabs_bg_color.';
			color:'.$talent_right_section_tabs_color.';
		}
		.hsk-talent_tabs-wrapper ul li.tab-active::after, .hsk-rating-followers-tab .hsk-tabs li.current::after{
			border-top-color:'.$talent_right_section_tabs_active_bg_color.';
			
		}
		.hsk-talent_tabs-wrapper ul li.tab-active a, .hsk-talent_tabs-wrapper ul li.tab-active, .hsk-rating-followers-tab .hsk-tabs li.current {
			background-color:'.$talent_right_section_tabs_active_bg_color.';
			color:'.$talent_right_section_tabs_active_link_color.';
		}';

//  Favourite Page Colors Settings
$css .='.hsk-favouritive-item-tabs{
			background-color:'.$favourite_buttons_bg_color.';
			color:'.$favourite_buttons_color.';
		}
		.hsk-favouritive-item-tabs a{
			color:'.$favourite_buttons_color.';
		}
		.hsk-favouritive-item-tabs a:hover{
			color:'.$favourite_buttons_hover_color.';
		}';		
// End;		
$css .='.hsk-search-form-content-wrapper, span.close-search-wrapper{
			background-color:'.$search_form_bg_color.';
			color:'.$search_form_label_color.';
			
		}
		.hsk-search-form-content-wrapper input, .hsk-search-form-content-wrapper textarea, .hsk-search-form-content-wrapper select, .hsk-search-form-content-wrapper input:focus{
			border-color:'.$search_form_fields_border_color.';
			color:'.$search_form_fields_color.';
		}
		.hsk-search-form-content-wrapper label{
			color:'.$search_form_label_color.';	
		}
		input#search_submit{
			background-color:'.$search_form_button_bg_color.';
			color:'.$search_form_button_color.';
		}
		input#search_submit{
			border-color:'.$search_form_button_bg_color.';
		}';

echo '<style type="text/css" >'.preg_replace('/\s+/', ' ', $css).'</style>';
}
add_action('wp_head','hsk_talent_opt_colors');
?>