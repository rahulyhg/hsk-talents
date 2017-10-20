<?php
get_header();
echo '<section id="mid-content-wrapper" >';
	echo '<div id="mid-container" class="container">';
		echo '<div class="hsk-talents-content-wrapper hsk-talent-taxonomy-wrapper">';
			echo '<ul>';
				global $cat_info;
			 	$talent_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			 	$cat_info['columns'] = hsk_talents_opt_data('display_cat_columns', 4);
			 	$cat_info['height'] = hsk_talents_opt_data('cat_height', 400);
			 	$cat_limit = hsk_talents_opt_data('cat_limit', 400);
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				    elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				    else { $paged = 1; }
					$args = array('paged' => $paged, 'posts_per_page' => $cat_limit, 'orderby'=>'DESC', 'order'=>'id', 'post_type' => 'talent', 'talent_cat' => $talent_term->slug);
						query_posts($args);
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						hsk_include_templates('content','talent');
					endwhile;
					if (function_exists("hsk_pagination")) {
					    echo hsk_pagination();
					}
					wp_reset_query();
				endif;	
			echo '</ul>';
		echo '</div>';
	echo '</div>';	
echo '</section>';		
get_footer();
?>