<?php
// Add Shortcode
function hsk_talents_icon_box( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'icon' => 'fa-home',
			'title' => esc_attr__('Icon Title','hsktalents'),
			'description' => esc_attr__('Icon Desciption','hsktalents'),
			'icon_bg_color' => '#242730',
			'icon_color' => '#fff',
			'color' => '#d22a78',
			'title_color' => '#333',
			'desc_color' => '#787878',
			'title_size' => '16',
			'icon_size' => '18',
			'desc_size' => '13',
			'icon_align' => 'left',
			'style' => '1',
			'icon_border_color' => '',
			'content_border_color' => '',
			'icon_border_radius' => '',
			'content_bg_color' => '',
			'icon_border_radius_t' =>'0',
			'icon_border_radius_r' => '0',
			'icon_border_radius_b' => '0',
			'icon_border_radius_l' => '0',
			'title_weight' => 'normal',
			'container_padding' => '0',
		),
		$atts,
		'icon_box'
	);
	// Return image HTML code

	$html = '';
	if( !empty($atts['icon']) ){
		$padding = !empty($atts['icon_bg_color']) ? 'margin-'.( ($atts['icon_align'] == 'left') ? 'right' : 'left').':20px; ' : 'margin-'.( ($atts['icon_align'] == 'left') ? 'right' : 'left').':20px;'; // Icon Alignment
	}else{
		$padding ='';
	}

	$icon_background = !empty($atts['icon_bg_color']) ? 'background-color:'.$atts['icon_bg_color'].';' : ''; // Icon BG Color
	if( !empty($icon_background) ){
		$icon_class="icon-with-bg";
		$icon_width_height =  'width:'.(ceil($atts['icon_size'] * 2.5)).'px; height:'.(ceil($atts['icon_size'] * 2.5)).'px; line-height:'.(ceil($atts['icon_size'] * 2.5)).'px;';// Icon Width & Height
	}else{
		$icon_width_height = '';
		$icon_class="icon-without-bg";
	}
	$icon_top =  (ceil($atts['icon_size'] * 2.5) / 2 );



	$title_line_height = 'line-height:'.ceil($atts['title_size'] * 1.3).'px;'; // Title Line Height

	$border_color = !empty($atts['content_border_color']) ? 'border:1px solid '.$atts['content_border_color'].';' : ''; // Content Border Color
	$icon_border_radius = 'border-radius:'.$atts['icon_border_radius_t'].'px '.$atts['icon_border_radius_r'].'px '.$atts['icon_border_radius_b'].'px '.$atts['icon_border_radius_l'].'px;'; // icon border radius

	$icon_border_color = !empty($atts['icon_border_color']) ? 'border:1px solid '.$atts['icon_border_color'].';' : ''; // Icon Border Color

	$content_bg_color = !empty($atts['content_bg_color']) ? 'background-color:'.$atts['content_bg_color'].';' : '';

	if( $atts['style'] == '3' ){
		$html .= '<div class="hsk-icon-box-icon-wrapper hsk-icon-box-'.$atts['icon_align'].'-icon icon-box-style'.$atts['style'].'" style=" '.$border_color. $content_bg_color.'padding:'.$atts['container_padding'].'px;">';
		$html .= "<div class='hsk-icon-box-icon icon-box-style".$atts['style']." ".$icon_class."' style='".$padding. ' '. $icon_width_height." color:".esc_attr($atts['icon_color'])."; " .$icon_background. $icon_border_radius. $icon_border_color ."  font-size:".esc_attr($atts['icon_size'])."px;'>";
		$before_icon = '';
		$after_icon = '';
	}elseif( $atts['style'] == '2' ){
		$icon_align = ( $atts['icon_align'] == 'center' ) ? 'right:0px; left:0px;' : $atts['icon_align'].':0px;';
		$before_icon = "<span  class='hsk-icon-container' style='". $icon_width_height.' 	'.$icon_border_radius. $icon_border_color." color:".esc_attr($atts['icon_color'])."; " .$icon_background. "  font-size:".esc_attr($atts['icon_size'])."px;'>";
		$after_icon = '</span>';
		$html .= "<div class='hsk-icon-box-icon-wrapper icon-box-style".$atts['style']."' style='".$border_color. 'padding:'.ceil($icon_top + 20).'px '.$atts['container_padding'].'px '.$atts['container_padding'].'px;' . $content_bg_color."'>";
		$html .= '<div class="hsk-icon-container-wrapper" style="top:-'.$icon_top.'px; '.$icon_align.'">';
	}else{
		$html .= '<div class="hsk-icon-box-icon-wrapper hsk-icon-box-'.$atts['icon_align'].'-icon icon-box-style'.$atts['style'].'" style=" '.$border_color. $content_bg_color.'padding:'.$atts['container_padding'].'px;">';
		$html .= "<div class='hsk-icon-box-icon icon-box-style".$atts['style']."' style='".$padding. ' '. $icon_width_height." color:".esc_attr($atts['icon_color'])."; " .$icon_background. $icon_border_radius. $icon_border_color ."  font-size:".esc_attr($atts['icon_size'])."px;'>";
		$before_icon = '';
		$after_icon = '';
	}

	$html .= $before_icon."<i class='fa ".esc_html($atts['icon'])."' style='line-height: ".(ceil($atts['icon_size'] * 1.2))."px;'></i>".$after_icon;
	$html .= '</div>';
	$html .= '<div class="description description'.$atts['style'].' " style="text-align:'.$atts['icon_align'].';">';
		if( !empty($atts['description']) || !empty($atts['title']) ){
			if( !empty($atts['title']) ){
				$html .= "<h3 style='color:".esc_html($atts['title_color'])."; ".$title_line_height." font-size:".esc_attr($atts['title_size'])."px; font-weight:".$atts['title_weight']."'>".esc_html($atts['title'])."</h3>";
			}
			if( !empty($atts['description']) ){
				$html .= "<p style='color:".esc_attr($atts['desc_color'])."; font-size:".esc_attr($atts['desc_size'])."px; line-height:".ceil(1.6*esc_attr($atts['desc_size']))."px; '>".$atts['description']."</p>";
			}
		}
	$html .= '</div>';
	$html .= '</div>';

	return $html;

}
add_shortcode( 'icon_box', 'hsk_talents_icon_box' );
?>