<?php
/**
* Creating talents list
*/
class HSK_Talents_Cat_Slider
{
	
	function __construct()
	{
		add_shortcode('hsk_talents_cat_slider', array($this, 'hsk_talents_cat_slider'));
	}
	function hsk_talents_cat_slider($atts){
		$attr = shortcode_atts( array(
        	'cat_ids' => '19',
        	'width' => '300',
        	'height' => '450',
        	'title_font_size' => '18',
        	'title_color' => '#333',

        ), $atts );
    	global $talents_data;
    	$html = '';
    	$taxonomy = 'talent_cat';
		$category_terms = get_terms($taxonomy); // Get all terms of a taxonomy
		$cat_ids = !empty($atts['cat_ids']) ? explode(',', $atts['cat_ids']) : '';
		if ( $category_terms && !is_wp_error( $category_terms ) ) :
			$html .= '<div class="hsk-talents-cat-wrapper owl-carousel">';
		        foreach ( $category_terms as $cat ) {
		        	$cat_img_id = get_term_meta( $cat->term_id, 'hsk-talent-cat-img-id', true ); 
		        	$cat_img = wp_get_attachment_image_src($cat_img_id, 'large');
		        	if(!empty($cat_img)){
		        		$cat_img_url = $cat_img[0];
		        	}else{
		        		$cat_img_url = HSK_PLUGIN_PATH . 'includes/assests/images/talent-placeholder.jpg';;
		        	}
			        	$html .= '<div class="talents-cat-content-wrapper">';
			            	$html .= '<a href="'.get_term_link(esc_attr($cat->slug), 'talent_cat').'"><img alt="'.esc_html($cat->name).'" class="" style="" src="'.hsk_image_crop(esc_url($cat_img_url), $attr['width'], $attr['height'], 't').'" /></a>';
		            	$html .= '<h3>'.esc_html($cat->name).'</h3>';
		            $html .= '</div>';
		        }
		    $html .= '</div>';
		endif;
		return $html;
	}
}
new HSK_Talents_Cat_Slider;