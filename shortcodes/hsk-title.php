<?php
// Add Shortcode
function hsk_talents_title_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(
		'title' => esc_attr__('Add Your Custom Title', 'hsktalents'),
		'align' => 'left',
		'margin_bottom' => '30',
		'title_color' => '#353535',
		'desc_color' => '#757575',
		'title_font_size' => '18',
		'desc_font_size' => '14',
		'title_bottom_border_url' => '',
		'border_img_width' => '',
		'disable_bottom_border' => '',
		'desc_font_weight' => 'normal',
		'title_font_weight' => 'normal',
		'bottom_border_color' => '#e5e5e5',
		'border_strip_color' => '#d22a78',
		), $atts);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-custom-title-wrapper hsk-custom-title-'.$atts['align'].'" style="text-align:'.$atts['align'].'; margin-bottom:'.$atts['margin_bottom'].'px;">';
		if(!empty($atts['title'])){
			$html .= '<h3 style="font-weight:'.$atts['title_font_weight'].'; line-height:'.( ceil($atts['title_font_size'] * 1.3) ).'px; font-size:'.$atts['title_font_size'].'px; color:'.$atts['title_color'].';">'.esc_attr($atts['title']);
			if( $atts['disable_bottom_border'] != 'on' ){
				if( !empty($atts['title_bottom_border_url']) ){
					$html .= '<span class="title-border-bottom-url" style="width:'.$atts['border_img_width'].'%;"><img src="'.$atts['title_bottom_border_url'].'" /></span>';
				}else{
					$html .= '<span class="title-border-bottom"  style="border-color:'.$atts['bottom_border_color'].';"> <span class="title-border-strip" style="background-color:'.$atts['border_strip_color'].';"></span> </span>';
				}
			}
			$html .= '</h3>';
		}
		$html .= '<p style="font-weight:'.$atts['desc_font_weight'].'; line-height:'.( ceil($atts['desc_font_size'] * 1.9) ).'px; font-size:'.$atts['desc_font_size'].'px; color:'.$atts['desc_color'].';">'.do_shortcode( $content ) .'</p>';
	$html .= '</div>';
	return $html;

}
add_shortcode( 'title', 'hsk_talents_title_shortcode' );
?>