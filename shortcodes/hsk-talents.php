<?php
/**
* Creating talents list
*/
class HSK_Talents_List
{
	
	function __construct()
	{
		add_shortcode('hsk_talents', array($this, 'hsk_talents'));
	}
	function hsk_talents($atts){
		$attr = shortcode_atts( array(
        	'columns' => '3',
			'filter_tabs' => 'false',
        	'tabs_bgcolor' => '#587ecc',
        	'tabs_color' => '#fff',
        	'limit' => '-1',
        	'pagination' => 'true',
        	'cat_ids' => '',
        	'height' => '500',
        	'show_talents' => 'no',
        	'order' => 'desc',
        	'orderby' => 'ID',
        	'title_font_size' => '18',
        	'title_color' => '#353535',
        	'remove_favourite_color' => '#d22a78',
        	'details_bgcolor' => '#242730',
        	'details_color' => '#fff',
        	'guttor' => 'off',
        	'disable_talent_details' => '',
        	'title_bg_color' => '#d22a78',
    	), $atts );
    	global $talents_data;
    	$hsk_rand= rand(1,5200);
    	$css = '.hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talents-content-wrapper ul li a .talent-info-wrapper, .hsk-talents-data-wrapper'.$hsk_rand.' ul li .hsk-img-zoom-animation-right, .hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talent-info-wrapper{
    			background-color:'.talenthub_hsk_hextorgba($attr['details_bgcolor'], 0.5).';
    		color:'.$attr['details_color'].';
    	}';
    	$css .= '.hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talents-content-wrapper ul li h5 a, .hsk-talents-data-wrapper'.$hsk_rand.' .talent-add-favourite, .hsk-talents-data-wrapper'.$hsk_rand.'.hsk-talent-info-wrapper{
    			font-size:'.$attr['title_font_size'].'px;
    	}';
    	$css .= '.hsk-talents-data-wrapper'.$hsk_rand.' .talent-remove-favourite, .hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talents-post-title a, .hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talent-info-buttons a{
    			color:'.$attr['remove_favourite_color'].';
    	}';
    	$css .= '.hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talents-post-title, .hsk-talents-data-wrapper'.$hsk_rand.' .talent-remove-favourite, .hsk-talents-data-wrapper'.$hsk_rand.' .hsk-talent-info-buttons a{
    			background-color:'.talenthub_hsk_hextorgba($attr['title_bg_color'], '0.5').';
    	}';
    	$css = preg_replace( '/\s+/', ' ', $css ); 
		echo "<style type=\"text/css\">\n" .trim( $css ). "\n</style>";
    	$tabs_bgcolor= !empty($attr['tabs_bgcolor']) ? $attr['tabs_bgcolor'] : '';
    	$tabs_color= !empty($attr['tabs_color']) ? $attr['tabs_color'] : '';
		$talents_data['columns'] = $attr['columns'] ? $attr['columns'] : '4';
		$talents_data['height'] = $attr['height'] ? $attr['height'] : '500';
		$talents_data['details_color'] = $attr['details_color'] ? 'color:'.$attr['details_color'] : 'color:#fff';
		$talents_data['slider'] = 'false';
		$talents_data['disable_talent_details'] = $attr['disable_talent_details'] ? $attr['disable_talent_details'] : ''; 
		echo '<div class="hsk-talents-data-wrapper hsk-talents-data-wrapper'.$hsk_rand.'" data-details_bg="'.$attr['details_bgcolor'].'" data-details_color="'.$attr['details_color'].'" data-font_size="'.$attr['title_font_size'].'" data-remove_fav_color="'.$attr['remove_favourite_color'].'" data-title_bg_color="'.talenthub_hsk_hextorgba($attr['title_bg_color'], '0.5').'">';
			if( $attr['filter_tabs'] == 'true' ){
				echo '<div class="hsk-filter-tabs filter" id="filter" >';
					echo '<ul style="'.$tabs_bgcolor.'">';
						echo '<li class="all" ><a style="'.$tabs_color.'" class="current" href="#" style=""  data-filter="*">'.__('ALL','hsktalents').'</a></li>';
						$category = !empty( $attr['cat_ids']) ? $attr['cat_ids'] : '';
						if( $category ){
							$talent_categories = @explode(',', $category);
							for($i=0;$i<count($talent_categories);$i++){
								$terms[] = get_term_by('id', $talent_categories[$i], 'talent_cat');
							} 
						} else {
							$terms = get_terms( array('taxonomy' => 'talent_cat',  'hide_empty' => false));
						}
						foreach($terms as $term) {
							echo '<li class="cat-'.$term->term_id .'" >';
								echo '<a style="'.$tabs_color.'" href="#" data-filter=".cat-' . $term->term_id . '">' . $term->name . ' </a>';
							echo '</li>';
						}
					echo '</ul>';
				echo '</div>';
			}
			$guttor_class  = ( $attr['guttor'] == 'on' ) ?  'guttor' : 'test';
			echo '<div class="hsk-talents-content-wrapper '.$guttor_class.'">';
				echo '<ul class="hsk-talents-filter-content-wrapper hsk-extra-width">';
				global $paged, $post;
				if( $attr['show_talents'] == 'yes' ){
					$featured_key = "featured-talent";
					$featured_value = 'yes';
				}elseif($attr['show_talents'] == 'no' ){
					$featured_key = "featured-talent";
					$featured_value = 'no';
				}else{
					$featured_key = "";
					$featured_value = '';
				}
				$terms_list = ( !empty( $attr['cat_ids'] )) ? explode(',',  $attr['cat_ids']) : '';
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }	
				if( $terms_list ) {
					if((  $attr['show_talents'] == 'yes' ) || (  $attr['show_talents'] == 'no' ) ){
						$args = array( 'paged' => $paged, 'post_type' => 'talent', 'orderby' => $attr['orderby'], 'posts_per_page' => $attr['limit'],'order' => $attr['order'], 'orderby' => $attr['orderby'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'talent_cat',   'field' => 'id', 'terms' => $terms_list, 'meta_query' => array(array(
								'key' => $featured_key,'value' => $featured_value
						))  ) ));
					}elseif( ($attr['show_talents'] == 'hsk_rating') || ($attr['show_talents'] == 'post_views_count') ){
						$args = array('paged' => $paged, 'post_type' => 'talent',  'taxonomy' => 'talent_cat','term' => '', 'posts_per_page' => $attr['limit'],'order' => $attr['order'], 'orderby' => $attr['orderby'],'meta_key' => $attr['show_talents'], 'orderby' => 'meta_value_num'
						);
					}else{
						$args = array( 'paged' => $paged, 'post_type' => 'talent', 'orderby' => $attr['orderby'], 'orderby' => $attr['orderby'], 'posts_per_page' => $attr['limit'],'order' => $attr['order'],  'tax_query' => array('relation' => 'AND', array( 'taxonomy' => 'talent_cat',   'field' => 'id', 'terms' => $terms_list ) ));
					}
				}else{
					if((  $attr['show_talents'] == 'yes' ) || (  $attr['show_talents'] == 'no' ) ){
						$args = array('paged' => $paged, 'post_type' => 'talent',  'taxonomy' => 'talent_cat','term' => '', 'posts_per_page' => $attr['limit'],'order' => $attr['order'], 'orderby' => $attr['orderby'], 'meta_query' => array(array(
								'key' => $featured_key,'value' => $featured_value
						)));
					}elseif( ($attr['show_talents'] == 'hsk_rating') || ($attr['show_talents'] == 'post_views_count') ){
						$args = array('paged' => $paged, 'post_type' => 'talent',  'taxonomy' => 'talent_cat','term' => '', 'posts_per_page' => $attr['limit'],'order' => $attr['order'], 'orderby' => $attr['orderby'],'meta_key' => $attr['show_talents'], 'orderby' => 'meta_value_num'
						);
					}else{
						$args = array('paged' => $paged, 'post_type' => 'talent', 'order' => $attr['order'], 'orderby' => $attr['orderby'],   'taxonomy' => 'talent_cat','term' => '', 'posts_per_page' => $attr['limit'],'order' => 'DESC');	
					}
				}				
				query_posts($args);
				if( have_posts() ) :
					while( have_posts() ) : the_post();
							global $terms_ids;
							$talent_cats = get_the_terms(get_the_ID(), 'talent_cat');
							$terms_ids = array();
							if( is_array($talent_cats) ){
								foreach ($talent_cats as $talent_cat) {
									$terms_ids[] = 'cat-'.$talent_cat->term_id;
								}
							}
							hsk_include_templates('content','talent');
						endwhile;
					//wp_reset_query();
					//endif;	
				echo '</ul>';
				if( $attr['pagination'] == 'true' ){
					if (function_exists("hsk_pagination")) {
					    echo hsk_pagination();
					}
				}
				wp_reset_query();
					endif;
			echo '</div>';
		echo '</div>';
			//return $talents_data;
	}
}
new HSK_Talents_List;