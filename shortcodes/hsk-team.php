<?php
function hsk_Team($atts){
    $atts = shortcode_atts( array(
        'name' => 'Team Member Name',
        'img_url' => '',
        'designation' => '',
        'description' => '',
        'text_align' => 'left',
        'letter_space' => '0',
        'title_font_weight' => 'normal',
        'title_font_size' => '18',
        'title_color' => '#252525',
        'designation_color' => '#95969a',
        'description_color' => '#252525',
        'designation_font_size' => '11',
        'description_font_size' => '13',
        'img_width' => '150',
        'img_height' => '150',
        'img_border_radius_top' => '0',
        'img_border_radius_right' => '0',
        'img_border_radius_bottom' => '0',
        'img_border_radius_left' => '0',
        'description_letter_space' => '0',
        'title_letter_space' => '0',
        'designation_letter_space' => '0',
    ), $atts );
    
    $html ='';
        $html .= '<div class="hsk-team-content-wrapper align'.$atts['text_align'].'">';
            $border_radius ='border-radius:'.$atts['img_border_radius_top'].'px '.$atts['img_border_radius_right'].'px '.$atts['img_border_radius_bottom'].'px '.$atts['img_border_radius_left'].'px;';

            $html .= '<div class="team-image-wrapper" style=" '.$border_radius.' ">';
                $html .= '<img  src="'.hsk_image_crop($atts['img_url'],$atts['img_width'], $atts['img_height'], true).'" class="team-img-wrapper" style="'.$border_radius.'"/>';
            $html .='</div>';
            $html .= '<div class="description" style="text-align:'.$atts['text_align'].'">';
                if(!empty($atts['name'])): $html .= '<h3 style="font-weight:'.$atts['title_font_weight'].'; letter-spacing:'.$atts['title_letter_space'].'px; font-size:'.$atts['title_font_size'].'px; color:'.$atts['title_color'].'">'.trim($atts['name']).'</h3>'; endif;
                if(!empty($atts['designation'])): $html .= '<span style="letter-spacing:'.$atts['designation_letter_space'].'px; letter-spacing:'.$atts['designation_letter_space'].'px; font-size:'.$atts['designation_font_size'].'px; color:'.$atts['designation_color'].';">'.trim(do_shortcode($atts['designation'])).'</span>'; endif;
                if(!empty($atts['description'])): $html .= '<p style="letter-spacing:'.$atts['designation_letter_space'].'px; letter-spacing:'.$atts['description_letter_space'].'px; font-size:'.$atts['description_font_size'].'px; color:'.$atts['description_color'].'">'.trim($atts['description']).'</p>'; endif;
            $html .= '</div>';
        $html .= '</div>'; 
    return $html;
}
add_shortcode('hsk_team', 'hsk_team');
?>