<?php
function hsk_button($atts){
    $atts = shortcode_atts( array(
        'name' => 'Your Button Name',
        'link' => '#',
        'btn_bg_color' => '',
        'btn_hover_bg_color' => '',
        'btn_color' => '',
        'btn_hover_color' => '',
        'font_size' => '',
        'padding_left_right' => '20',
        'padding_top_bottom' => '10',
        'border_radius_top' => '0',
        'border_radius_right' => '0',
        'border_radius_bottom' => '0',
        'border_radius_left' => '0',
        'position' => 'left',
        'letter_space' => '0',
        'font_weight' => 'normal',
    ), $atts );
    
    $html ='';
    $rand = rand(1,8200);
        $css = '.hsk-btn-wrapper.hsk-btn-'.$rand.' a:hover{
            background-color:'.$atts['btn_hover_bg_color'].'!important;
            color:'.$atts['btn_hover_color'].'!important;
        }';
                echo '<style type="text/css" >'.preg_replace('/\s+/', ' ', $css).'</style>';
                //echo $atts['btn_hover_bg_color'];
        $border_radius ='border-radius:'.$atts['border_radius_top'].'px '.$atts['border_radius_right'].'px '.$atts['border_radius_bottom'].'px '.$atts['border_radius_left'].'px;';
        $colors = 'background-color:'.$atts['btn_bg_color'].'; color:'.$atts['btn_color'].';';
        $html .= '<div class="hsk-btn-wrapper hsk-btn-'.$rand.'" style="text-align:'.$atts['position'].';">';
            $html .= '<a href="'.esc_url( $atts['link'] ).'" style="letter-spacing:'.$atts['letter_space'].'px; font-size:'.$atts['font_size'].'px; font-weight:'.$atts['font_weight'].'; padding:'.$atts['padding_top_bottom'].'px '.$atts['padding_left_right'].'px;'.$border_radius.' '. $colors .'">'.esc_attr($atts['name']).'</a>';
        $html .= '</div>'; 
    return $html;
}
add_shortcode('hsk_button', 'hsk_button');
?>