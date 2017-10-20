<?php
global $talents_data, $terms_ids;
$post_id = get_the_ID();
$term_ids = $terms_ids ? implode(' ', $terms_ids) : '';
global $cat_info;
$cat_columns = $cat_info['columns'] ? $cat_info['columns'] : '4';
$cat_height= $cat_info['height'] ? $cat_info['height'] : '400';
$columns = $talents_data['columns'] ? $talents_data['columns'] : $cat_columns;
$height = $talents_data['height'] ? $talents_data['height'] : $cat_height;
$enable_slider = ($talents_data['slider'] == 'true' ) ? 'true' : '';
if(isset($_SESSION['favouritive'])) {
	if ( in_array($post_id, $_SESSION['favouritive']) ) {
		$item_added = 'item_added';
	}else{ $item_added = '';}
}else{
	$item_added = '';
}
if( $enable_slider != 'true' ){
	echo '<li class="all '.$term_ids.' hsk-column-'.$columns.' '.$item_added.'" id="'.get_the_ID().'">';
}else{
	echo '<div class="'.$item_added.'" id="'.get_the_ID().'">';
}
	echo '<div class="hsk-img-zoom-animation-right">';
		echo hsk_post_image($post_id,'450',$height);
		echo hsk_post_link_open($post_id);
			echo '<div class="talent-info-wrapper">';
		echo hsk_meta_opt_data($post_id);
	echo '</div>';
		echo hsk_post_link_close();
	echo '</div>';
	echo '<div class="hsk-talent-title-wrapper">';
		echo hsk_post_title();
		echo hsk_favarative_icons();
	echo '</div>';
if( $enable_slider != 'true' ){	
	echo '</li>';
}else{
	echo '</div>';
}
?>