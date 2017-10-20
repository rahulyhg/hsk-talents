<?php
function hsk_advanced_search($atts){
    $atts = shortcode_atts( array(
        
    ), $atts );
    
    $html ='';
     $html .= '<div class="hsk-advanced-search-wrapper">';
        $html .= '<form method="get" id="searchform"  action="'.home_url('/').'">';
        $html .= '<input type="text" class="field" name="s" id="s" placeholder="'.esc_attr_e( 'Search', 'hsktalents' ).'" />';
        $html .= '<input type="hidden" name="hsk-talents-search" value="hsk-talents-search">';
        $html .='<p>';
            $html .= '<input type="text" name="talent_id_1495132264636" />';
        $html .='</p>';

        $html .='<p>';
            $html .= '<input type="submit" name="hsk-talent-search-submit" value="Search" />';
        $html .='</p>';
        $html .= '</form>';
     $html .= '</div>'; 
    return $html;
}
add_shortcode('hsk_search', 'hsk_advanced_search');
?>