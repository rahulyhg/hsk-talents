<?php
/**
 * Adding Shortlist menu in header section
 */
function hsk_favourative_header_section(){
    echo '<li>'.hsk_get_favourite_page().'</li>';
}
add_action('header_top_right_menu', 'hsk_favourative_header_section');
?>