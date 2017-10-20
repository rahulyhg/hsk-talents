<?php
class HSK_Woo_products_Slider extends WP_Widget {
	function __construct() {
		parent::__construct('hsk-woo-products-slider',
	    __('HSK - Products Slider','hsktalents'),
	    array('description' => __('This is used to create user all products as a slider', 'hsktalents'))
	    );

	}

	function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title' =>'',		
			'subtitle' =>'',
			'choose_products_type' =>'',
			'product_category' =>'',
			'product_number' =>'0',
			'hide_thumbnail_mask' =>'0',
			'product_hover_bg_color' => '#d22a78',
			'product_hover_color' => '#fff',
			'product_title_color' => '#353535',
			'product_rating_color' => '#d22a78',
			'product_price_color' => '',
		));
		$woo_rand = rand(1,5000);
		$css = '.hsk-woo-slider-wrapper'.$woo_rand.' .hsk-woo-slider-wrapper .featured-img .featured-hover-wrapper{
            background:'.talenthub_hsk_hextorgba($instance['product_hover_bg_color'], '0.5').'!important;
            color:'.$instance['product_hover_color'].'!important;
        }
        .hsk-woo-slider-wrapper'.$woo_rand.' .hsk-woo-sales-tag{
            background-color:'.talenthub_hsk_hextorgba($instance['product_hover_bg_color']).'!important;
            color:'.$instance['product_hover_color'].'!important;
        }
        .hsk-woo-slider-wrapper'.$woo_rand.' .hsk-woo-slider-wrapper .featured-img .featured-hover-wrapper .featured-hover-block a{
        	 color:'.$instance['product_hover_color'].'!important;
        	 border-color:'.$instance['product_hover_color'].'!important;
        }
        .hsk-woo-slider-wrapper'.$woo_rand.' .featured-content-wrapper h3 a{
        	color:'.$instance['product_title_color'].'!important;
        }
        .hsk-woo-slider-wrapper'.$woo_rand.' .woocommerce-product-rating span{
        	color:'.$instance['product_rating_color'].'!important;
        }
        .hsk-woo-slider-wrapper'.$woo_rand.' .woocommerce-Price-amount ins amount {
        	color:'.$instance['product_price_color'].'!important;
        }';
        echo '<style type="text/css" >'.preg_replace('/\s+/', ' ', $css).'</style>';
		global $post;
		$title            = apply_filters( 'widget_title', isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '');
		$subtitle         = isset( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : '';
		$choose_products_type           = isset( $instance[ 'choose_products_type' ] ) ? $instance[ 'choose_products_type' ] : '';
		$product_category         = isset( $instance[ 'product_category' ] ) ? $instance[ 'product_category' ] : '';
		$product_number   = isset( $instance[ 'product_number' ] ) ? $instance[ 'product_number' ] : '';
		$hide_thumbnail_mask = isset( $instance[ 'hide_thumbnail_mask' ] ) ? $instance[ 'hide_thumbnail_mask' ] : 0;

		if ( $choose_products_type == 'featured' ) {
			$args = array(
				'post_type'        => 'product',
				'posts_per_page'   => $product_number,
				'tax_query' => array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					),
				)
			);
		} elseif ( $choose_products_type == 'sale' ) {
			$args = array(
				'post_type'      => 'product',
				'meta_query'     => array(
				'relation' => 'OR',
					array( // Simple products type
						'key'           => '_sale_price',
						'value'         => 0,
						'compare'       => '>',
						'type'          => 'numeric'
					),
					array( // Variable products type
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
					)
				),
				'posts_per_page'   => $product_number
			);
		} elseif ( $choose_products_type == 'product_category' ){
			$args = array(
				'post_type' => 'product',
				'tax_query' => array(
					array(
						'taxonomy'  => 'product_cat',
						'field'     => 'id',
						'terms'     => $product_category
					)
				),
				'posts_per_page' => $product_number
			);
		} else {
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $product_number
			);
		}
//		echo $args['before_widget']; ?>
			<div class="hsk-woo-slider-content-wrapper hsk-woo-slider-wrapper<?php echo $woo_rand; ?> clearfix">
				<div class="hsk-woo-slider-wrapper owl-carousel" data-columns="<?php echo $instance['product_number']?>">
				<?php
				$featured_query = new WP_Query( $args );
				while ($featured_query->have_posts()) :
					$featured_query->the_post();
					$product = wc_get_product( $featured_query->post->ID ); ?>
					<div>
					<?php
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id,'hsktalents-square', false); ?>
						<figure class="featured-img">
							<?php if($image_url[0]) { ?>
								<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" alt="<?php the_title(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>"></a>
							<?php } else { ?>
								<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" alt="<?php the_title(); ?>"><img src="<?php echo talenthub_hsk_product_placeholder_img(); ?>" alt="<?php the_title_attribute(); ?>"></a>
							<?php } ?>
							<?php if ( $product->is_on_sale() ) : ?>
								<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="hsk-woo-sales-tag">' . esc_html__( 'Sale!', 'hsktalents' ) . '</div>', $post, $product ); ?>
							<?php endif; ?>
							<?php if ($average = $product->get_average_rating()) : ?>
							    <?php echo '<div class="product-star-rating star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'hsktalents' ), $average).'" style="color:'.$instance['product_rating_color'].'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'hsktalents' ).'</span></div>'; ?>
							<?php endif; ?>
							<?php if ( $hide_thumbnail_mask != 1 ) : ?>
								<div class="featured-hover-wrapper">
									<div class="featured-hover-block">
										<?php if($image_url[0]) { ?>
										<a href="<?php echo esc_url( $image_url[0] ); ?>" class="zoom" data-rel="prettyPhoto"><i class="fa fa-search-plus"> </i></a>
										<?php } else {?>
										<a href="<?php echo talenthub_hsk_product_placeholder_img(); ?>"  class="zoom" data-rel="prettyPhoto"><i class="fa fa-search-plus"> </i></a>
										<?php }
										woocommerce_template_loop_add_to_cart( $product ); ?>
									</div>
								</div><!-- featured hover end -->
							<?php endif; ?>
						</figure>
						<div class="featured-content-wrapper">
							<h3 class="featured-title"> <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $price_html = $product->get_price_html() ) : ?>
								<span class="price" style="color:<?php echo $instance['product_price_color']; ?>"><?php echo $price_html; ?></span>
							<?php endif; ?>
						</div><!-- featured content wrapper -->
					</div>
				<?php
				endwhile;
				?>
				</div>
			</div>

		<?php wp_reset_postdata(); ?>
		<?php
//		echo $after_widget;
	}
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'title' =>'',		
			'subtitle' =>'',
			'choose_products_type' =>'',
			'product_category' =>'',
			'product_number' =>'0',
			'hide_thumbnail_mask' =>'0',
			'product_hover_bg_color' => '#d22a78',
			'product_hover_color' => '#fff',
			'product_title_color' => '#353535',
			'product_rating_color' => '#d22a78',
			'product_price_color' => '',
		));
		?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('#<?php echo $this->get_field_id( 'choose_products_type' ); ?>').change(function(){
				var product_type = jQuery('#<?php echo $this->get_field_id( 'choose_products_type' ); ?>').find('option:selected').val();
				jQuery('.<?php echo $this->get_field_id( 'product_category' ); ?>').css('display', 'none');
				if(product_type == 'product_category'){
					jQuery('.<?php echo $this->get_field_id( 'product_category' ); ?>').css('display', 'block');
				}
			}).change();

			jQuery('.woo-slider-color-pickr').wpColorPicker(); // Color Pickr
		});			
		</script>
		<?php
		$title            = esc_attr( $instance[ 'title' ] );
		$subtitle         = esc_textarea( $instance[ 'subtitle' ] );
		$choose_products_type           = $instance[ 'choose_products_type' ];
		$product_category         = absint( $instance[ 'product_category' ] );
		$product_number   = absint( $instance[ 'product_number' ] );
		$hide_thumbnail_mask = $instance[ 'hide_thumbnail_mask' ] ? 'checked="checked"' : '';
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'choose_products_type' ); ?>"><?php esc_html_e( 'Product Type:', 'hsktalents' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'choose_products_type' ); ?>" name="<?php echo $this->get_field_name( 'choose_products_type' ); ?>">
				<option value="latest" <?php selected( $instance['choose_products_type'], 'latest'); ?>><?php esc_html_e( 'Latest Products', 'hsktalents' ); ?></option>
				<option value="featured" <?php selected( $instance['choose_products_type'], 'featured'); ?>><?php esc_html_e( 'Featured Products', 'hsktalents' ); ?></option>
				<option value="sale" <?php selected( $instance['choose_products_type'], 'sale'); ?>><?php esc_html_e( 'On Sale Products', 'hsktalents' ); ?></option>
				<option value="product_category" <?php selected( $instance['choose_products_type'], 'product_category'); ?>><?php esc_html_e( 'Certain Category', 'hsktalents' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'product_number' ); ?>"><?php esc_html_e( 'Number of Products:', 'hsktalents' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'product_number' ); ?>" name="<?php echo $this->get_field_name( 'product_number' ); ?>" type="number" value="<?php echo $product_number; ?>" />
		</p>
	   	<p>
		  	<label for="<?php echo $this->get_field_id('product_hover_bg_color'); ?>"><?php _e('Product Hover BG Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('product_hover_bg_color') ?>" id="<?php echo $this->get_field_id('product_hover_bg_color') ?>" class="woo-slider-color-pickr" value="<?php echo $instance['product_hover_bg_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('product_hover_color'); ?>"><?php _e('Product Hover Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('product_hover_color') ?>" id="<?php echo $this->get_field_id('product_hover_color') ?>" class="woo-slider-color-pickr" value="<?php echo $instance['product_hover_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('product_title_color'); ?>"><?php _e('Product Title Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('product_title_color') ?>" id="<?php echo $this->get_field_id('product_title_color') ?>" class="woo-slider-color-pickr" value="<?php echo $instance['product_title_color'] ?>" />
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('product_rating_color'); ?>"><?php _e('Product Rating Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('product_rating_color') ?>" id="<?php echo $this->get_field_id('product_title_color') ?>" class="woo-slider-color-pickr" value="<?php echo $instance['product_title_color'] ?>" />
		</p>
	   	<p>
		  	<label for="<?php echo $this->get_field_id('product_price_color'); ?>"><?php _e('Product Price Color', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('product_price_color') ?>" id="<?php echo $this->get_field_id('product_price_color') ?>" class="woo-slider-color-pickr" value="<?php echo $instance['product_price_color'] ?>" />
		</p>

	<?php }

}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Woo_products_Slider");'));
?>