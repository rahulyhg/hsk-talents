<?php
// Add Shortcode
function talenthub_hsk_row_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(
		'class' => '',
		'id' => '',
		'bg_image_url' => '',
		'bg_color' => '',
		'margin_bottom'=>'30',
		'full_container' => 'false',
		'container_padding_t_b' => '0',
		'container_padding_l_r' => '0',
		),
		$atts,
		'row'
	);
	// Return image HTML code
	$html = '';
	$fullwidth_container = ( $atts['full_container'] == 'true' ) ? 'hsk-fullwidth-container' : "";
	$bg_image_url = !empty($atts['bg_image_url']) ? 'background-image:url('.esc_url($atts['bg_image_url']).')': '' ;
	$bg_color = !empty($atts['bg_color']) ? 'background-color:'.$atts['bg_color'].';': '' ; 
	$html .= '<div class="hsk-row '. $fullwidth_container.'" id="'.$atts['id'].'" style="'.$bg_image_url. $bg_color.' margin-bottom:'.$atts['margin_bottom'].'px; padding:'.$atts['container_padding_t_b'].'px; '.$atts['container_padding_l_r'].'px; '.$atts['container_padding_l_r'].'px; '.$atts['container_padding_t_b'].'px; ">';
		$html .= '<div class="hsk-extra-width">';
		$html .= do_shortcode( hsk_shortcode_unautop( shortcode_unautop( hsk_up_shortcodes( $content ) ) ) );
		$html .= '</div>';
	$html .= '</div>';
	return $html;

}
add_shortcode( 'row', 'talenthub_hsk_row_shortcode' );

// Column1
function talenthub_hsk_column12_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_1'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column12">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;

}
add_shortcode( 'column_1', 'talenthub_hsk_column12_shortcode' );

// Column2
function talenthub_hsk_column2_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_6'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column6">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;

}
add_shortcode( 'column_6', 'hsk_column2 _shortcode' );

// Column3
function talenthub_hsk_column3_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_4'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column3">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;

}
add_shortcode( 'column_4', 'talenthub_hsk_column3_shortcode' );

// Column4
function talenthub_hsk_column4_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_3'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column4">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;

}
add_shortcode( 'column_3', 'talenthub_hsk_column4_shortcode' );

// Column5
function talenthub_hsk_column5_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_5'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column2">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;

}
add_shortcode( 'column_5', 'talenthub_hsk_column5_shortcode' );

// Column6
function talenthub_hsk_column6_shortcode( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(), $atts, 'column_6'
	);
	// Return image HTML code
	$html = '';
	$html .= '<div class="hsk-column2">';
		$html .= do_shortcode($content);
	$html .= '</div>';
	return $html;
}
add_shortcode( 'column_6', 'talenthub_hsk_column6_shortcode' );
?>