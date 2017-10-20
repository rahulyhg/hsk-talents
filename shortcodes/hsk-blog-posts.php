<?php
function hsk_blog_recent_posts($atts, $content = null) {
   extract(shortcode_atts(array(
   	  'columns' => '3',
      'limit' => 10,
      'container_bg_color' => '#fff',
      'order' => 'desc',
      'orderby' => 'id',
      'include_title' => 'true',
      'include_date' => 'false',
      'include_meta_data' => 'true',
      'include_description' => 'true',
      'desc_length' => '30',
      'include_image' => 'true',
      'include_link' => 'true',
      'cat_id' => '',
      'img_height' => '400',
      'img_width' => '480',
      'title_font_size' => '18',
      'title_color' => '#252525',
      'title_font_weight' => '',
      'title_font_style' => '',
      'meta_info_font_size' => '13',
      'meta_info_font_color' => '#757575',
      'meta_info_font_weight' => 'normal',
      'meta_info_font_style' => 'normal',
      'description_font_size' => '15',
      'description_color' => '#555',
      'include_comments' => 'true',
      'image_postion' => 'center',
      'date_bg_color' => '#d22a78',
      'date_color' => '#fff',
      'enable_slider' => 'false',
		'enable_container_border' => 'false',
		'enable_hover_effect' => 'false',
		'description_padding' => '15',
		'blog_title' => '',
   ), $atts));

   $html = '';
   $cates = !empty($cat_id) ? explode(',', $cat_id) : ''; 
   $container_border_color = ( $enable_container_border == 'true' ) ? 'posts-contianer-styles' : '';
   $blog_hover_effect = ( $enable_hover_effect == 'true' ) ? 'posts-contianer-styles-hover' : '';
   $slider_calss= ( $enable_slider == 'true' ) ? 'enable-blog-post-slider owl-carousel' : 'blog-post-gallery';
   $grid_columns= ( $enable_slider == 'true' ) ? '' : 'hsk-column-'.$columns.' ';
   $html .= '<div class="blog-post-content-wrapper '.$slider_calss.' '.$blog_hover_effect.'">';
	   $html .= '<h3>'.$blog_title.'</h3>';
	   //$html .= '<ul>';
	   query_posts(array('orderby' => 'date','category__in' => $cates, 'order' => 'DESC' , 'posts_per_page' => $limit));
	   if (have_posts()) :
	   	$count = '1';
	      while (have_posts()) : the_post();
	      if( $count == $columns ){
	         	$count = '0';
	         	$last = 'last';
	         }else{
	         	$last = '';
	         }
	         if( $image_postion == 'left' ){
		        	$class = 'img-align-left';
		        }elseif( $image_postion == 'top'){
		        	$class = 'img-align-top';
		        }elseif( $image_postion == 'right' ){
		        	$class = 'img-align-right';
		        }else{
		        	$class = 'img-align-top';
		        }
	        $html .= '<div class="'.$grid_columns.' '.$container_border_color.' '.$last.' '.$class.' blog-post-loop-wrapper " style="background-color:'.$container_bg_color.';">';
	         	$thumbnail = get_the_post_thumbnail_url();
	         	$comments_count = wp_count_comments();
		        if(  !empty($thumbnail) && ( $include_image == 'true' ) ){
		         	$html .= '<div class="post-featured-image-wrapper">';
		         		$html .= '<a href="'.get_the_permalink().'"><img src="'.hsk_image_crop(get_the_post_thumbnail_url(), $img_width, $img_height, 't').'" height="'.$img_height.'" width="'.$img_width.'"/></a>';
		         		if( $include_date == 'true' ){
			         		$html .= '<div class="date_added" style="background-color:'.$date_bg_color.'; color:'.$date_color.'">';
								$html .= '<span style="color:'.$date_color.'" class="day">'.get_the_time('d').'</span>';
								$html .= '<span style="color:'.$date_color.'" class="month">'.get_the_time('M').'</span>';
							$html .= '</div>';
						}
		         	$html .= '</div>';
		        }
		        if( ( $include_description == 'true' ) || ( $include_title == 'true' ) ){
		         	$html .= '<div class="description" style="padding:'.$description_padding.'px;">';
		         		if( $include_title == 'true' ){
			         		$html .= '<h4><a style="font-size:'.$title_font_size.'px; font-weight:'.$title_font_weight.'; font-style:'.$title_font_style.'; color:'.$title_color.';" href="'.get_permalink().'">'.get_the_title().'</a></h4>';
			         	}
			         	if( $include_meta_data == 'true' ){
			         		$html .='<div class="hsk-post-meta-info" style="font-size:'.$meta_info_font_size.'px; font-weight:'.$meta_info_font_weight.'; font-style:'.$meta_info_font_style.'; color:'.$meta_info_font_color.';">';
				         		$html .= '<span class="post-author-link">' .__('Posted By', 'hsktalents'). ' '.get_the_author_posts_link().'</span>, ';
				         		$html .= '<span class="post-date">' .__('Posted On', 'hsktalents'). ' '.get_the_time('F jS, Y').'</span>';
				         		//$html .= '<span class="post-date">' .($comments_count->total_comments).'</span>';
			         		$html .='</div>';
			         	}
			         	//$html .= 'By'. get_the_author_posts_link(). 'on' .get_the_time('F jS, Y');
			         	if( $include_description == 'true' ){
			         		$html .= '<p style="font-size:'.$description_font_size.'px; color:'.$description_color.';">'.wp_trim_words( get_the_content(), $desc_length ).'</p>';
			         	}
			         $html .= '</div>';
			    }
	         $html .= '</div>';
	         $count++;

	      endwhile;
	   endif;
	  // $html .= '</ul>';
	$html .= '</div>';   
   wp_reset_query();

   return $html;
}
 add_shortcode('hsk_blog_posts', 'hsk_blog_recent_posts');
?>