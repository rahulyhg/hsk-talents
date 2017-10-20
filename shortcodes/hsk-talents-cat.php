<?php
/**
* Creating talents list
*/
class HSK_Talents_Cat
{
	
	function __construct()
	{
		add_shortcode('hsk_talents_cat', array($this, 'hsk_talents_cat'));
	}
	function hsk_talents_cat($atts){
		$attr = shortcode_atts( array(
        	'cat_id' => '',
        	'width' => '300',
        	'height' => '150',
        	'border_radius' => '3',
        	'content_align' => 'left',
        	'style' => '1',
        	'count_bg_color' => '#242730',
        	'count_size' => '30',
        	'title_font_size' => '18',
        	'desc_font_size' => '15',
        	'title_color' => '#333',
        	'desc_color' => '#757575',
        	'count_color' => '#fff',
        	'border_color' => '#e5e5e5',

        ), $atts );  
    	global $talents_data;
    	$html = '';
    	$hsk_rand= rand(1,5200);
		$get_talent_terms = get_term_by('id', $attr['cat_id'],'talent_cat');
		$border_color = !empty($attr['border_color']) ? $attr['border_color'] : '#e5e5e5';
		if( !empty($get_talent_terms) ){
			$html .= '<div class="hsk-talent-cat-wrapper align'.$attr['content_align'].' cat-style-'.$attr['style'].'">';
				$html .= '<div class="hsk-talent-cat-image">';
					$cat_img_id = get_term_meta( $attr['cat_id'], 'hsk-talent-cat-img-id', true );
					$count_bg_color = !empty($attr['count_bg_color']) ? 'background-color:'.$attr['count_bg_color'].';' : '#242730';
					//print_r($get_talent_terms);
					if( $attr['style'] == '1' ){
						if( !empty($cat_img_id) ){
							$image_url = wp_get_attachment_image_src($cat_img_id, 'large');
							$html .= '<div class="">';
								$html .= '<a href="'.get_term_link(esc_attr($get_talent_terms->slug), 'talent_cat').'"><img class="hsk-thumbnail" alt="'.get_the_title().'" style="border-radius:'.( !empty($attr['border_radius']) ? esc_attr($attr['border_radius']) : '3' ).'%" src="'.hsk_image_crop(esc_url($image_url[0]), esc_html($attr['width']), esc_html($attr['height']), 't').'" /></a>';
							$html .=  '</div>';
						}
					}elseif( $attr['style'] == '3' ){
						
					}else{
						echo '<div class="hsk-talent-cat-count-wrapper hsk-talent-cat-wrapper'.$atts['style'].'-align'.$attr['content_align'].'" style="'.$count_bg_color.' color:'.$attr['count_color'].'; border-radius:'.( !empty($attr['border_radius']) ? esc_attr($attr['border_radius']) : '3' ).'%; line-height:' .esc_html($attr['height']).'px; width:'.esc_html($attr['width']).'px; height:' .esc_html($attr['height']).'px">';
							echo '<div class="hsk-talent-count" style="font-size:'.$attr['count_size'].'px;">';
								echo esc_attr($get_talent_terms->count);
							echo '</div>';
						echo '</div>';
					}
					$html .= '<div class="description ">';
						if( !empty($get_talent_terms->name) ){
							if( $attr['style'] == '3' ){
								$border_color_width = "border:2px dashed ".$border_color.';';
								$class="cat-style-".$attr['style'];
							}else{
								$border_color_width = '';
								$class="cat-style-".$attr['style'];
							}
							$html .= '<h4 class="'.$class.'" style="'.$border_color_width.' font-size:'.$attr['title_font_size'].'px;"><a style="color:'.$attr['title_color'].';" href="'.get_term_link(esc_attr($get_talent_terms->slug), 'talent_cat').'">'.esc_html($get_talent_terms->name).' ('.esc_attr($get_talent_terms->count).')</a></h4>';
						}
						if( !empty($get_talent_terms->description) ){
							$html .= '<p style="font-size:'.$attr['desc_font_size'].'px; color:'.$attr['title_color'].'; ">'.esc_html($get_talent_terms->description).'</p>';
						}
					$html .='</div>';
				$html .=  '</div>';
			$html .=  '</div>';
		}
		return $html;

	}
}
new HSK_Talents_Cat;