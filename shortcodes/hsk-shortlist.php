<?php
/**
*  Shortlist Page
*/
class HSK_Shortlist_Page
{
	
	function __construct()
	{
		add_shortcode('hsk_shortlist', array($this, 'hsk_shortlist_page'));

	}
	public function hsk_shortlist_page($atts){
		$attr = shortcode_atts( array(
        	
    	), $atts );

		$favouritive = array(0);
		echo '<div class="hsk-talents-content-wrapper hsk-talent-favouritive-items">';
			echo '<div class="hsk-print-header-logo">';
				echo '<div class="hsk_print_logo hsk-column4">';
					if( function_exists('talenthub_hsk_logo') ){
						echo talenthub_hsk_logo();
					}else{
						ssagency_hsk_logo();
					}
				echo '</div>';
				echo '<div class="hsk-column8 header-right-section">';
					$hsk_header_right_text = get_theme_mod('hsk_header_right_text') ? get_theme_mod('hsk_header_right_text') : __('Add Header Right Section', 'hsktalents');
					echo do_shortcode($hsk_header_right_text);
				echo '</div>';
			echo '</div>';

		echo '<div class="hsk-favouritive-item-tabs">';
			echo '<ul class="favouritive-page-tab-items">';
				if(hsk_talents_opt_data('disable_clear_favouritive') != '1'){
					echo '<li class="clear-favouritive-items"><a href="#">'.hsk_talents_opt_data('clear_favouritive_text', __('Clear favouritive', 'hsktalents')).'</a> / </li>';
				}
				if(hsk_talents_opt_data('disable_email_favouritive') != '1'){
					echo '<li class="hsk-share-favouritive"><a href="#">'.hsk_talents_opt_data('share_favouritive_text', __('Share favouritive', 'hsktalents')).'</a> / </li>';
				}
				if(hsk_talents_opt_data('disable_print_favouritive') != '1'){
					echo '<li class="hsk-pdf-icon"><a href="" onclick="window.print()">'.hsk_talents_opt_data('print_favouritive_text', __('Print 	favouritive', 'hsktalents')).'</a></li>';
				}
			echo '</ul>';	
		echo '</div>';
		echo '<div class="hsk-favaroutive-item-count" style="display:none;">'.__("There are currently no models listed in your favourites page. <br />You can add by clicking the 'favourites' button on a talents's  page. <br />Then use the menu below in order to edit your selection and request more info ", 'hsktalents').'</div>';
		if( isset($_SESSION['favouritive']) && (!empty($_SESSION['favouritive'])) ) {
			$favouritive = $_SESSION['favouritive'];
			$args = array( 
				'post_type' => 'talent', // must
				'post__in' => $favouritive 
			);
			$loop = new WP_Query( $args );
				echo '<ul class="hsk-talents-content-wrapper hsk-extra-width">'; 
					while( $loop->have_posts() ) {
						$loop->the_post();
						echo hsk_include_templates('content','talent');
					}
				echo '</ul>';
			
	    	wp_reset_postdata();
		}else{
			echo '<p>'.__("There are currently no models listed in your favourites page. <br />You can add by clicking the 'favourites' button on a talents's  page. <br />Then use the menu below in order to edit your selection and request more info ", 'hsktalents').'</p>';
		}
		echo hsk_favourite_talents_enquiry_form();
		echo '</div>';
	}
}
new HSK_Shortlist_Page;
?>