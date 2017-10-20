<?php
/**
* Creating talents list
*/
class HSK_Talent_Widget extends WP_Widget{

	function __construct(){
		// widget actual processes
		parent::__construct(
			'hsk-talent-list', // Base ID
			__('HSK - Talents', 'hsktalents'), // Name
			array( 'description' => __( 'This is used to get all talents as a grid view style', 'hsktalents' )) // Args
		);
	}
	/**
	 * Creating Widget Data
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, array(
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
        	'orderby' => 'id',
        	'title_font_size' => '18',
        	'title_color' => '#fff',
        	'remove_favourite_color' => '#fff',
        	'details_bgcolor' => '#16202a',
        	'details_color' => '#fff',
        	'guttor' => '',
        	'disable_talent_details' => '',
        	'title_bg_color' => '#16202a',
		));
			echo $args['before_widget'];
				//print_r();
			$cat_ids = !empty($instance['cat_ids']) ? implode(',', $instance['cat_ids']) : '';
				echo do_shortcode('[hsk_talents title_font_size="'.$instance['title_font_size'].'" title_color="'.$instance['title_color'].'" order="'.$instance['order'].'" orderby="'.$instance['orderby'].'" filter_tabs="'.$instance['filter_tabs'].'" columns="'.$instance['columns'].'" cat_ids="'.$cat_ids.'" show_talents="'.$instance['show_talents'].'" limit="'.$instance['limit'].'" height="'.$instance['height'].'" pagination="'.$instance['pagination'].'" remove_favourite_color="'.$instance['remove_favourite_color'].'" details_bgcolor="'.$instance['details_bgcolor'].'" details_color="'.$instance['details_color'].'" guttor="'.$instance['guttor'].'" disable_talent_details="'.$instance['disable_talent_details'].'" title_bg_color="'.$instance['title_bg_color'].'"]');
			echo $args['after_widget'];				
	}
	/**
	 * Creating Widget Form
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'columns' => '3',
        	'details_bgcolor' => '#16202a',
        	'details_color' => '#fff',
        	'tabs_bgcolor' => '#587ecc',
        	'tabs_color' => '#fff',
        	'limit' => '-1',
        	'pagination' => 'true',
        	'guttor' => '',
        	'cat_ids' => '',
        	'height' => '500',
        	'show_talents' => 'no',
        	'order' => 'desc',
        	'orderby' => 'id',
        	'title_font_size' => '18',
        	'title_color' => '#fff',
        	'remove_favourite_color' => '#fff',
        	'details_bgcolor' => '#16202a',
        	'details_color' => '#fff',
        	'filter_tabs' => 'false',
        	'disable_talent_details' => '',
        	'title_bg_color' => '#16202a',    	
		));
		?>
		<script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.hsktalents-list').wpColorPicker();
            });
        </script>
		<?php
		$talent_terms=  get_terms('talent_cat','');
	    if( $talent_terms ){
	      foreach ($talent_terms as $talent_term) { 
	        $cat_ids[] = $talent_term->term_id;
	         $cats_name[] = $talent_term->name;
	      }
	      $hsk_talent_cats = array_combine($cat_ids, $cats_name);
	    }else{ $cats_name[] = ''; $cat_ids[] =''; $hsk_talent_cats=''; } ?>
		<p>
			<label for="<?php echo $this->get_field_id('cat_ids') ?>"> <?php _e('Choose Categories ','hsktalents') ?> </label>
				<?php
				if(!empty($hsk_talent_cats)){
					foreach ($hsk_talent_cats as $key => $cat) { 
						if( !empty($instance['cat_ids']) ){
							$checked = in_array($key, $instance['cat_ids']) ? 'checked' : '';
						}else{
							$checked = '';
						} ?>
						<input type="checkbox" name="<?php echo $this->get_field_name('cat_ids') ?>[]" id="<?php echo $this->get_field_id('cat_ids') ?>" class="widefat" value="<?php echo $key ?>" <?php echo $checked; ?> /><?php echo $cat; ?> 
					<?php }
				}
			?>
		<p>
			<label for="filter_tabs"><?php _e('Filter Tabs', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('filter_tabs') ?>" name="<?php echo $this->get_field_name('filter_tabs') ?>">
	        	<option value="false" <?php selected('false', $instance['filter_tabs']) ?>><?php _e('False','hsktalents'); ?></option>
	        	<option value="true" <?php selected('true', $instance['filter_tabs']) ?>><?php _e('True','hsktalents'); ?></option>
	        </select>
		</p>

		<p>
			<label for="align"><?php _e('Display Columns', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
	        	<option value="8" <?php selected('8', $instance['columns']) ?>>8</option>
	        	<option value="7" <?php selected('7', $instance['columns']) ?>>7</option>
	        	<option value="6" <?php selected('6', $instance['columns']) ?>>6</option>
	        	<option value="5" <?php selected('5', $instance['columns']) ?>>5</option>
	        	<option value="4" <?php selected('4', $instance['columns']) ?>>4</option>
	        	<option value="3" <?php selected('3', $instance['columns']) ?>>3</option>
	        	<option value="2" <?php selected('2', $instance['columns']) ?>>2</option>
	        </select>
		</p>

		<p>
			<label for="order"><?php _e('Order', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('order') ?>" name="<?php echo $this->get_field_name('order') ?>">
	        	<option value="desc" <?php selected('desc', $instance['order']) ?>><?php _e('Descending', 'hsktalents') ?></option>
	        	<option value="asc" <?php selected('asc', $instance['order']) ?>><?php _e('Ascending', 'hsktalents') ?></option>
	        </select>
		</p>

		<p>
			<label for="orderby"><?php _e('Order By', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('orderby') ?>" name="<?php echo $this->get_field_name('orderby') ?>">
	        	<option value="id" <?php selected('id', $instance['orderby']) ?>><?php _e('ID', 'hsktalents') ?></option>
	        	<option value="title" <?php selected('title', $instance['orderby']) ?>><?php _e('Title', 'hsktalents') ?></option>
	        	<option value="name" <?php selected('name', $instance['orderby']) ?>><?php _e('Name', 'hsktalents') ?></option>
	        	<option value="date" <?php selected('date', $instance['orderby']) ?>><?php _e('Date', 'hsktalents') ?></option>
	        	<option value="rand" <?php selected('rand', $instance['orderby']) ?>><?php _e('Random', 'hsktalents') ?></option>
	        </select>
		</p>
		<p>
			<label for="show_talents"><?php _e('Show Talents', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('show_talents') ?>" name="<?php echo $this->get_field_name('show_talents') ?>">
	        	<option value="all" <?php selected('all', $instance['show_talents']) ?>><?php _e('All Talents','hsktalents'); ?></option>
	        	<option value="no" <?php selected('no', $instance['show_talents']) ?>><?php _e('No Featured Talents','hsktalents'); ?></option>
	        	<option value="yes" <?php selected('yes', $instance['show_talents']) ?>><?php _e('Featured Talents Only','hsktalents'); ?></option>
	        	<option value="hsk_rating" <?php selected('hsk_rating', $instance['show_talents']) ?>><?php _e('Top Rating Talents','hsktalents'); ?></option>
	        	<option value="post_views_count" <?php selected('post_views_count', $instance['show_talents']) ?>><?php _e('Most Popular Talents','hsktalents'); ?></option>
	        </select>
		</p>
		<p>
		  	<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Images Height', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('height') ?>" id="<?php echo $this->get_field_id('height') ?>" class="small-text" value="<?php echo $instance['height'] ?>" />px
		</p>

		<p>
			<label for="title_font_size"><?php _e('Title Font Size', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('title_font_size') ?>" id="<?php echo $this->get_field_id('title_font_size') ?>" class="small-text" value="<?php echo $instance['title_font_size'] ?>" />px
		</p>
		<p>
			<label for="title_bg_color"><?php _e('Title Background Color', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('title_bg_color') ?>" id="<?php echo $this->get_field_id('title_bg_color') ?>" class="hsktalents-list" value="<?php echo $instance['title_bg_color'] ?>" />
		</p>
		<p>
			<label for="title_color"><?php _e('Title & Favourite Icon Color', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="hsktalents-list" value="<?php echo $instance['title_color'] ?>" />
		</p>
		<p>
			<label for="remove_favourite_color"><?php _e('Remove Favourite Color', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('remove_favourite_color') ?>" id="<?php echo $this->get_field_id('remove_favourite_color') ?>" class="hsktalents-list" value="<?php echo $instance['remove_favourite_color'] ?>" />
		</p>
		<p>
			<label for="details_bgcolor"><?php _e('Hover Details Background Color', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('details_bgcolor') ?>" id="<?php echo $this->get_field_id('details_bgcolor') ?>" class="hsktalents-list" value="<?php echo $instance['details_bgcolor'] ?>" />
		</p>
		<p>
			<label for="details_color"><?php _e('Hover Details Color', 'hsktalents'); ?></label>
	        <input type="text" name="<?php echo $this->get_field_name('details_color') ?>" id="<?php echo $this->get_field_id('details_color') ?>" class="hsktalents-list" value="<?php echo $instance['details_color'] ?>" />
		</p>

		<p>
		  	<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Images Limit', 'hsktalents') ?></label>
		  	<input type="text" name="<?php echo $this->get_field_name('limit') ?>" id="<?php echo $this->get_field_id('limit') ?>" class="small-text" value="<?php echo $instance['limit'] ?>" />
		</p>

		<p>
			<label for="pagination"><?php _e('Pagination', 'hsktalents'); ?></label>
	        <select id="<?php echo $this->get_field_id('pagination') ?>" name="<?php echo $this->get_field_name('pagination') ?>">
	        	<option value="true" <?php selected('true', $instance['pagination']) ?>><?php _e('True','hsktalents'); ?></option>
	        	<option value="false" <?php selected('false', $instance['pagination']) ?>><?php _e('False','hsktalents'); ?></option>
	        </select>
		</p>
		<p>
			<label for="guttor"><?php _e('Guttor', 'hsktalents'); ?></label>
			<?php $guttor = $instance[ 'guttor' ] ? 'checked="checked"' : ''; ?>
			<input class="checkbox" <?php echo $guttor; ?> id="<?php echo $this->get_field_id( 'guttor' ); ?>" name="<?php echo $this->get_field_name( 'guttor' ); ?>" type="checkbox" />
		</p>
		<p>
			<label for="disable_talent_details"><?php _e('Disable Talent Details', 'hsktalents'); ?></label>
			<?php $disable_talent_details = $instance[ 'disable_talent_details' ] ? 'checked="checked"' : ''; ?>
			<input class="checkbox" <?php echo $disable_talent_details; ?> id="<?php echo $this->get_field_id( 'disable_talent_details' ); ?>" name="<?php echo $this->get_field_name( 'disable_talent_details' ); ?>" type="checkbox" />
		</p>	
	<?php }
}
add_action('widgets_init', create_function('', 'return register_widget("HSK_Talent_Widget");'));  	 	 		 	 		 