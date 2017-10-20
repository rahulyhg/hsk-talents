<?php
// Add Shortcode
function talenthub_hsk_img_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'title' => '',
			'width' => '480',
			'height' => '480',
			'url' => '',
			'description' =>'',
			'title_below_img' => 'true',
			'button_text' => '',
			'button_link' => '#',
			'title_color' => '#353535',
			'desc_color' => '#757575',
			'button_color' => '#51a3df',
			'button_hover_color' => '#353535',
			'title_font_size' => '18',
			'desc_font_size' => '14',
			'title_font_weight' => 'normal',
			'position' => 'center',
		),
		$atts,
		'img'
	);
	// Return image HTML code
	$html = '';
	$hsk_rand= rand(1,5200);
    	$css = '.hsk-image-content-wrapper'.$hsk_rand.' .description .image-button-text a:hover{
    		color:'.$atts['button_hover_color'].'!important;
    	}';
    	$css = preg_replace( '/\s+/', ' ', $css ); 
		echo "<style type=\"text/css\">\n" .trim( $css ). "\n</style>";

	$html .= '<div class="hsk-image-content-wrapper hsk-image-content-wrapper'.$hsk_rand.'  hsk-image-position-'.$atts['position'].'">';
		if( $atts['title_below_img'] != 'true' ){
			if( !empty($atts['title']) ){
				$html .= '<h3 class="above-img-title" style="text-align:'.$atts['position'].'; color:'.esc_attr($atts['title_color']).'; font-size:'.$atts['title_font_size'].'px; font-weight:'.$atts['title_font_weight'].'; line-height:'.ceil(1.5*$atts['title_font_size']).'px;">'.esc_html($atts['title']).'</h3>';
			}
		}
		if( !empty($atts['url']) ){
			if(!empty($atts['button_link'])){
				$html .= '<a href="'.esc_url($atts['button_link']).'">';
			}
			$html .= '<img src="' . hsk_image_crop(esc_url($atts['url']), $atts['width'], $atts['height'], 't'). '" width="' . $atts['width'] . '" height="' . $atts['height'] . '">';
			if(!empty($atts['button_link'])){
				$html .= '</a>';
			}
		}

		$html .=  '<div class="description" style="text-align:'.$atts['position'].';">';
			if( $atts['title_below_img'] == 'true' ){
				if( !empty($atts['title']) ){
					$html .= '<h3 class="below-img-title" style="font-size:'.$atts['title_font_size'].'px; font-weight:'.$atts['title_font_weight'].';  color:'.esc_attr($atts['title_color']).'; line-height:'.ceil(1.5*$atts['title_font_size']).'px;">'.esc_html($atts['title']).'</h3>';
				}
			}
			if( !empty($atts['description']) ){
				$html .= '<p style="color:'.esc_attr($atts['desc_color']).'; font-size:'.$atts['desc_font_size'].'px; line-height:'.ceil(1.65*$atts['desc_font_size']).'px;">'.trim($atts['description']).'</p>';
			}
				
			if(!empty($atts['button_text'])){
				$html .= '<p data-hover="'.esc_attr($atts['button_hover_color']).'" class="image-button-text"><a style="color:'.esc_attr($atts['button_color']).'" href="'.esc_url($atts['button_link']).'">'.esc_html($atts['button_text']).'</a></p>';
			}
		$html .=  '</div>';
	$html .= '</div>';

	return $html;

}
add_shortcode( 'image', 'talenthub_hsk_img_shortcode' );
?>