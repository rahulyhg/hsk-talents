<?php
class HSK_blog_Posts extends WP_Widget
{
	function __construct()
	{
		parent::__construct('hsk-blog-posts',__('HSK - Blog Posts','hsktalents'),
			array('description' => __('Use this widget to display the blog posts','hsktalents'))
		);
	}
	function widget($args, $instance){
		$instance = wp_parse_args($instance, array(
			'style' => '1',
			'columns' => '3',
			'img_width' => '500',
			'img_height' => '350',
			'description_bg' => '#e5e5e5',
			'title_color' => '#151515',
			'title_font_size' => '18',
			'description_color' => '#454545',
			'description_font_size' => '14',
			'meta_info_color' => '#151515',
			'img_date_bg_color' => '#fff',
			'img_date_color' => '#151515',
			'img_meta_info_color' => '#fff',
			'img_meta_info_icons_color' => '#ff00ff',
			'desc_meta_links_color' => '#151515',
			'desc_meta_info_icons_color' => '#ff00ff',
			'disable_meta_info' => 'off',
			'enable_meta_data_info_desc' => 'off',
			'disable_post_img' => '',
			'description_length' => '10',
			'post_limit' => '10',
		));
		echo $args['before_widget'];
			$blog_rand = rand(1,25000);
			$css ='';
			$css .= '.blog-content-wrapper-'.$blog_rand.' .post-meta-info a{color:'.$instance['img_meta_info_color'].'!important;}';
			$css .= '.blog-content-wrapper-'.$blog_rand.' .post-data-wrapper a{color:'.$instance['desc_meta_links_color'].'!important;}';
			$css = preg_replace( '/\s+/', ' ', $css ); 
			echo "<style>\n" .trim( $css ). "\n</style>";
			echo '<div class="blog-content-wrapper blog-content-wrapper-'.$blog_rand.'">';
				$data = new WP_Query('orderby=comment_count&posts_per_page='.$instance['post_limit']);
				echo '<div class="hsk-extra-width">';
				if($data->have_posts()) : while($data->have_posts()) : $data->the_post();
					$imgurl = get_the_post_thumbnail_url();
							if( $instance['style'] == '2' ){
								$image_calss = 'hsk-column4';
								$class = (!empty($imgurl) && ( $instance['disable_post_img'] != 'on' ) ) ? 'hsk-column8' : 'hsk-column-1';
								$columns = 'description-wrapper column1';
							}elseif( $instance['style'] == '1' ){
								$image_calss = '';
								$class = 'fullwidth';
								$columns = 'description-wrapper hsk-column-'.$instance['columns'];
							}else{

							}
						$class_nothumb = !empty($imgurl) ? 'has-featured-image' : 'no-featured-image';	
						$padding = !empty($instance['description_bg']) ? 'padding:30px;' : '';
						$description_bg = !empty($instance['description_bg']) ? 'background-color:'.$instance['description_bg'].';' : '';
						echo '<article class="'.$columns.'" style="'.$description_bg.'">';
							if(!empty($imgurl) ){
								if( $instance['disable_post_img'] != 'on' ){
									echo '<div class="img-wrapper '.$image_calss.'">';
										echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'"><img src="'.hsk_image_crop(get_the_post_thumbnail_url(), $instance['img_width'], $instance['img_height'], 'tc').'" height="'.$instance['img_height'].'" width="'.$instance['img_width'].'"/></a>';
										if( ($instance['disable_meta_info'] != 'on') ){
											echo '<div class="post-date-wrapper" style="background-color:'.$instance['img_date_bg_color'].';">';
												echo '<h5 style="color:'.$instance['img_date_color'].';">'.get_the_date('M, d').'</h5>';
												echo '<h5 style="color:'.$instance['img_date_color'].';">'.get_the_date('Y').'</h5>';
											echo '</div>';
											echo '<div class="post-meta-info" style="color:'.$instance['img_meta_info_icons_color'].';">'; ?>
												<span><i class="fa fa-user"></i><?php echo the_author_posts_link(); ?></span> 
												<span><i class="fa fa-comment"></i><?php echo comments_popup_link( '0', '1', '%'); ?></span> <?php
											echo '</div>';
										}
									echo '</div>';
								}
							}
							echo '<div class="description '.$class.' '.$class_nothumb.'" style=" '.$description_bg.' '.$padding.' color:'.$instance['description_color'].'; ">';
								$shortexcerpt = wp_trim_words( get_the_content(), $num_words = $instance['description_length'], $more = '' ); 
								echo '<h3 style="font-size:'.trim($instance['title_font_size']).'px; line-height:'.ceil(1.4*trim($instance['title_font_size'])).'px;"><a style="color:'.$instance['title_color'].';" href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
								if( ($instance['disable_meta_info'] != 'on' ) || ( $instance['enable_meta_data_info_desc'] == 'on' )  ){
									if(empty($imgurl) || ( $instance['enable_meta_data_info_desc'] == 'on' ) ){
										echo '<div class="post-data-wrapper">'; ?>
											<span><i class="fa fa-calendar" style="color:<?php echo $instance['desc_meta_info_icons_color']; ?>"></i><?php echo get_the_date('M d, Y'); ?></span>
											<span style="color:<?php echo $instance['desc_meta_info_icons_color']; ?>"><i class="fa fa-user"></i><?php echo the_author_posts_link(); ?></span> 
											<span style="color:<?php echo $instance['desc_meta_info_icons_color']; ?>;"><i class="fa fa-comment"></i><?php echo comments_popup_link( '0', '1', '%'); ?></span> <?php
										echo '</div>';
									}
								}
								if( $instance['description_length'] > '0' ){
									echo '<p style="font-size:'.trim($instance['description_font_size']).'px;  line-height:'.ceil(1.6*trim($instance['description_font_size'])).'px; color:'.$instance['description_color'].';">'.$shortexcerpt.'</p>';
								}
							echo '</div>';
							echo '<div class="clear"></div>';
						echo '</article>';
					endwhile;
				endif;
				wp_reset_query();
				echo '</div>';
			echo '</div>';
		echo $args['after_widget'];		
	}
	function form($instance){
		$instance = wp_parse_args($instance, array(
			'style' => '1',
			'columns' => '3',
			'img_width' => '500',
			'img_height' => '350',
			'description_bg' => '#e5e5e5',
			'title_color' => '#151515',
			'title_font_size' => '18',
			'description_color' => '#454545',
			'description_font_size' => '14',
			'meta_info_color' => '#151515',
			'img_date_bg_color' => '#fff',
			'img_date_color' => '#151515',
			'img_meta_info_color' => '#fff',
			'img_meta_info_icons_color' => '#ff00ff',
			'desc_meta_links_color' => '#151515',
			'desc_meta_info_icons_color' => '#ff00ff',
			'disable_meta_info' => 'off',
			'enable_meta_data_info_desc' => 'off',
			'disable_post_img' => '',
			'description_length' => '10',
			'post_limit' => '10',
		)); ?>
		<script type="text/javascript">
	      (function($) {
	      "use strict";
	      $(function() {
			$('.posts_color_picker').each(function(){ // Color pickr
				$(this).wpColorPicker();
			}); // 
			// Disable Fields Based On Styles
			$("#<?php echo $this->get_field_id('style') ?>").change(function () {
				var style = $("#<?php echo $this->get_field_id('style') ?> option:selected").val();
				$(".<?php echo $this->get_field_id('columns'); ?>").hide();
				if( style == '1' ){
					$(".<?php echo $this->get_field_id('columns'); ?>").show();
				}else if(style == '2'){

				}else{

				}
			}).change();
			// End
	      });
	    })(jQuery);
	  </script>
		<p>
			<label for="<?php echo $this->get_field_id('style') ?>">  <?php _e('Blog Post Style','hsktalents')?>  </label>
			<select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style') ?>">
			<option value="1" <?php selected('1', $instance['style']) ?>>1</option>
			<option value="2" <?php selected('2', $instance['style']) ?>>2</option>
			</select>
		</p>
		<p class="<?php echo $this->get_field_id('columns') ?>">
			<label for="<?php echo $this->get_field_id('columns') ?>">  <?php _e('Blog Post Display Columns','hsktalents')?>  </label>
			<select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
			<option value="4" <?php selected('4', $instance['columns']) ?>>4</option>
			<option value="3" <?php selected('3', $instance['columns']) ?>>3</option>
			<option value="2" <?php selected('2', $instance['columns']) ?>>2</option>
			<option value="1" <?php selected('1', $instance['columns']) ?>>1</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('img_width') ?>">  <?php _e('Post Image Width & Height','hsktalents')?>  </label>
			<input type="text" class="small-text" id="<?php echo $this->get_field_id('img_width') ?>" value="<?php echo esc_attr($instance['img_width']) ?>" name="<?php echo $this->get_field_name('img_width') ?>" />X
			<input type="text" class="small-text" id="<?php echo $this->get_field_id('img_height') ?>" value="<?php echo esc_attr($instance['img_height']) ?>" name="<?php echo $this->get_field_name('img_height') ?>" />
			<small><?php _e('px','hsktalents'); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('img_date_bg_color'); ?>"><?php _e('Image Over Date Background Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('img_date_bg_color') ?>" id="<?php echo $this->get_field_id('img_date_bg_color') ?>" class="posts_color_picker" value="<?php echo $instance['img_date_bg_color'] ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('img_date_color'); ?>"><?php _e('Image Over Date Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('img_date_color') ?>" id="<?php echo $this->get_field_id('img_date_color') ?>" class="posts_color_picker" value="<?php echo $instance['img_date_color'] ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('img_meta_info_color'); ?>"><?php _e('Image Over Meta Info Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('img_meta_info_color') ?>" id="<?php echo $this->get_field_id('img_meta_info_color') ?>" class="posts_color_picker" value="<?php echo $instance['img_meta_info_color'] ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('desc_meta_info_icons_color'); ?>"><?php _e('Image Over Meta Info Icons Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('desc_meta_info_icons_color') ?>" id="<?php echo $this->get_field_id('desc_meta_info_icons_color') ?>" class="posts_color_picker" value="<?php echo $instance['desc_meta_info_icons_color'] ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description_bg'); ?>"><?php _e('Post Title & Description Background Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('description_bg') ?>" id="<?php echo $this->get_field_id('description_bg') ?>" class="posts_color_picker" value="<?php echo $instance['description_bg'] ?>" />
		</p>
		<!-- Post title -->
		<p>
			<label for="<?php echo $this->get_field_id('title_color'); ?>"><?php _e('Post Title Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="posts_color_picker" value="<?php echo $instance['title_color'] ?>" />
		</p>
		<p>
		  <label for="<?php echo $this->get_field_id('title_font_size') ?>">  <?php _e('Title Font Size','hsktalents'); ?>  </label>
		  <input type="text" class="small-text" id="<?php echo $this->get_field_id("title_font_size"); ?>" name="<?php echo $this->get_field_name("title_font_size"); ?>" value="<?php echo $instance['title_font_size'] ?> "  />px
		</p>
		<!-- Post meta info -->
		<p>
			<label for="<?php echo $this->get_field_id('desc_meta_links_color'); ?>"><?php _e('Decription Meta Info Link Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('desc_meta_links_color') ?>" id="<?php echo $this->get_field_id('desc_meta_links_color') ?>" class="posts_color_picker" value="<?php echo $instance['desc_meta_links_color'] ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('desc_meta_info_icons_color'); ?>"><?php _e('Decription Meta Info Icons Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('desc_meta_info_icons_color') ?>" id="<?php echo $this->get_field_id('desc_meta_info_icons_color') ?>" class="posts_color_picker" value="<?php echo $instance['desc_meta_info_icons_color'] ?>" />
		</p>
		<!-- Post Description -->
		<p>
			<label for="<?php echo $this->get_field_id('description_color'); ?>"><?php _e('Post Description Color','hsktalents') ?></label>
			<input type="text" name="<?php echo $this->get_field_name('description_color') ?>" id="<?php echo $this->get_field_id('description_color') ?>" class="posts_color_picker" value="<?php echo $instance['description_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('description_font_size') ?>">  <?php _e('Description Font Size','hsktalents'); ?>  </label>
		  	<input type="text" class="small-text" id="<?php echo $this->get_field_id("description_font_size"); ?>" name="<?php echo $this->get_field_name("description_font_size"); ?>" value="<?php echo $instance['description_font_size'] ?> " />px
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('disable_post_img') ?>">  <?php _e('Disable Post Image', 'hsktalents') ?>  </label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_post_img"); ?>" name="<?php echo $this->get_field_name("disable_post_img"); ?>"<?php checked( (bool) $instance["disable_post_img"], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('disable_meta_info') ?>">  <?php _e('Disable Post Meta Data', 'hsktalents') ?>  </label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("disable_meta_info"); ?>" name="<?php echo $this->get_field_name("disable_meta_info"); ?>"<?php checked( (bool) $instance["disable_meta_info"], true ); ?> />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('enable_meta_data_info_desc') ?>">  <?php _e('Enable Post Meta Data On Description Block', 'hsktalents') ?>  </label>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("enable_meta_data_info_desc"); ?>" name="<?php echo $this->get_field_name("enable_meta_data_info_desc"); ?>"<?php checked( (bool) $instance["enable_meta_data_info_desc"], true ); ?> />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('description_length') ?>">  <?php _e('Description Words Limit','hsktalents'); ?>  </label>
		  	<input type="text" class="small-text" id="<?php echo $this->get_field_id("description_length"); ?>" name="<?php echo $this->get_field_name("description_length"); ?>" value="<?php echo $instance['description_length'] ?> " />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('post_limit') ?>">  <?php _e('Posts Limit','hsktalents'); ?>  </label>
		  	<input type="text" class="small-text" id="<?php echo $this->get_field_id("post_limit"); ?>" name="<?php echo $this->get_field_name("post_limit"); ?>" value="<?php echo $instance['post_limit'] ?> " />
		</p>
	<?php	
	}
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_blog_Posts");'));
?>