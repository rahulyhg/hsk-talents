<?php
add_shortcode("social_group","hsk_social_icons_group");
function hsk_social_icons_group($atts, $content=NULL){
   extract(shortcode_atts(array(
      'color' => '#fff',
      'bgcolor' => '#353535',
      'size' => '16',
      'hover_bgcolor' => '#151515',
      'hover_color' => '#858585',
      'border_radius' => '5',
      'padding' => '10',
   ), $atts));

   $html = '';
   $html .='<div class="social-media-icons-wrapper">';
    $html .='<ul data-color="'.$color.'" data-padding="'.$padding.'" data-borderradius="'.$border_radius.'"  style="font-size:'.$size.'px;" data-bgcolor="'.$bgcolor.'" data-hovercolor="'.$hover_color.'" data-hoverbgcolor="'.$hover_bgcolor.'">';
        $html .= do_shortcode($content);
    $html .='</ul>';
   $html .='</div>';
   return $html;
} 
add_shortcode("icon","hsk_socila_icons");
function hsk_socila_icons($atts, $content=NULL){
   extract(shortcode_atts(array(
        'icon' => 'fa-facebook',
        'link' => '#',
   ), $atts));

   $html = '';
   $html .='<li>';
    $html .= '<a href="'.$link.'"><i class="fa '.$icon.'"></i></a>';
   $html .='</li>';
   return $html;
}   
?>