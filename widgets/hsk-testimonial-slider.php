<?php
/* Testimonial Slider */
class HSK_Testimonial_Slider extends WP_Widget{
  public function __construct(){
    parent::__construct(  'hsk-testimonial-slider',
        esc_html__('HSK - Testimonial Slider', 'hsktalents'),
    array( 'description' => esc_html__('This is used to create a testionial slider', 'hsktalents') )
    );
  }
  public function widget( $args , $instance ){
    $instance = wp_parse_args($instance, array( 
        'style' => '1',
        'columns' => '1',
        'bgcolor' => '',
        'slider_columns' => '1',
        'title_color' => '#fff',
        'description_color' => '#fff',
        'testimonial_cats' => '',
        'description_size' => '14',
        'description_style' =>  esc_html__('normal', 'hsktalents'),
        'description_letter_space' => '0',
        'description_font_weight' =>  esc_html__('normal','hsktalents'),
        'title_size' => '16',
        'title_font_wight' =>  esc_html__('normal','hsktalents'),
        'title_letter_space' => '0',
        'title_font_style' =>  esc_html__('normal','hsktalents'),
        'designation_color' => '#fff',
        'designation_font_size' => '14',
        'designation_letter_space' => '0',
        'designation_font_style' => 'normal',
        'designation_font_weight' => 'normal',
        'thumbnails_border_color' => '#fff',
      ));
    echo $args['before_widget'];
    $bgcolor = !empty($instance['bgcolor']) ? 'Background-color:'.$instance['bgcolor'].'; padding:30px;' : '';
    echo '<div class="testimonial-wrapper-data">';
    echo "<span class='tesimonial-content-quotes'> </span>";
      echo '<div class="testimonial-slider-content-wrapper owl-carousel" data-columns="'.$instance['columns'].'">';
          
          $loop = new WP_Query(array('post_type' => 'testimonial', 'orderby' => 'menu_order', 'posts_per_page' =>10,'order' => 'DESC'));
          if( $loop->have_posts() ) : while( $loop->have_posts() ) : $loop->the_post();
              global $post;
              $client_link=get_post_meta(get_the_ID(),'testimonial_client_link' ,true);
              $client_description=get_post_meta(get_the_ID(),'testimonial_description',true);
              $client_designation= get_post_meta($post->ID,'t_client_designation',true);
                echo '<div class="testimonial-content-wrappper testimonial-style-'.$instance['style'].'">';
                  // Description
                  $img_url = wp_get_attachment_url(get_post_thumbnail_id());
                  echo '<div class="description-with-img" style="'.$bgcolor.'">';
                    if( $instance['style'] == '2' ){
                      if( !empty($img_url) ){
                        echo '<img src="'.hsk_image_crop($img_url, '100', 100, 't').'" class="" alt="'.get_the_title().'" />'; 
                      }else{
                        $img_url = get_template_directory_uri().'/images/testimonial.png';
                        echo '<img src="'.hsk_image_crop($img_url, '100', 100, 't').'" class="" alt="'.get_the_title().'" />'; 
                      }
                    }
                    echo '<p style="font-size:'.$instance['description_size'].'px; font-style:'.$instance['description_style'].'; line-height:'.(  ceil($instance['description_size']) * 1.8 ).'px; color:'.$instance['description_color'].';">'.$client_description.'</p>';
                    // title
                    if( $instance['style'] == '1' ){
                      if( !empty($img_url) ){
                        echo '<img src="'.hsk_image_crop($img_url, '100', 100, 't').'" class="" alt="'.get_the_title().'" />'; 
                      }else{
                        $img_url = get_template_directory_uri().'/images/testimonial.png';
                        echo '<img src="'.hsk_image_crop($img_url, '100', 100, 't').'" class="" alt="'.get_the_title().'" />'; 
                      }

                      echo '</div>';
                    }
                  
                  echo '<div class="title-wrapper-section">';
                    echo '<h6 style="color:'.$instance['title_color'].'; font-size:'.$instance['title_size'].'px; font-weight:'.$instance['title_font_wight'].'; font-style:'.$instance['title_font_style'].';"><strong>'.get_the_title().'</strong></h6> - ';
                    // Designation
                    echo '<span class="designation" style="color:'.$instance['designation_color'].'; font-size:'.$instance['designation_font_size'].'px; letter-spacing:'.$instance['designation_letter_space'].'px; font-style:'.$instance['designation_font_style'].'; font-weight:'.$instance['designation_font_weight'].';">'.$client_designation.'</span>';
                  echo '</div>';
                  if( $instance['style'] == '2' ){
                    echo '</div>';
                  }
                echo '</div>';
            endwhile;          
            wp_reset_postdata(); 
          endif;
      echo '</div>';
      echo '</div>';
   echo $args['after_widget'];
  }
  public function form( $instance ){
      $instance = wp_parse_args( $instance, array(
        'style' => '1',
        'columns' => '1',
        'bgcolor' => '',
        'slider_columns' => '1',
        'title_color' => '#fff',
        'description_color' => '#fff',
        'testimonial_cats' => '',
        'description_size' => '14',
        'description_style' =>  esc_html__('normal', 'hsktalents'),
        'description_letter_space' => '0',
        'description_font_weight' =>  esc_html__('normal','hsktalents'),
        'title_size' => '16',
        'title_font_wight' =>  esc_html__('normal','hsktalents'),
        'title_letter_space' => '0',
        'title_font_style' =>  esc_html__('normal','hsktalents'),
        'designation_color' => '#fff',
        'designation_font_size' => '14',
        'designation_letter_space' => '0',
        'designation_font_style' => 'normal',
        'designation_font_weight' => 'normal',
        'thumbnails_border_color' => '#fff',
  ));
  ?>
  <script type='text/javascript'>
    (function($) {
      "use strict";
      $(function() {
        $('.test-colors-picker').each(function(){
          $(this).wpColorPicker();
        });
      });
    })(jQuery);
  </script>
      <p>
        <label for="align"><?php esc_html_e('Style', 'hsktalents'); ?></label>
          <select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style') ?>">
            <option value="1" <?php selected('1', $instance['style']) ?>>3</option>
            <option value="2" <?php selected('2', $instance['style']) ?>>2</option>
          </select>
      </p>
      <p>
        <label for="align"><?php esc_html_e('Display Columns', 'hsktalents'); ?></label>
          <select id="<?php echo $this->get_field_id('columns') ?>" name="<?php echo $this->get_field_name('columns') ?>">
            <option value="3" <?php selected('3', $instance['columns']) ?>>3</option>
            <option value="2" <?php selected('2', $instance['columns']) ?>>2</option>
            <option value="1" <?php selected('1', $instance['columns']) ?>>1</option>
          </select>
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('bgcolor') ?>"><?php esc_html_e('Content Background Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('bgcolor') ?>" id="<?php echo $this->get_field_id('bgcolor') ?>" class="test-colors-picker" value="<?php echo esc_attr($instance['bgcolor']) ?>"  />
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('description_color') ?>"><?php esc_html_e('Description Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('description_color') ?>" id="<?php echo $this->get_field_id('description_color') ?>" class="test-colors-picker" value="<?php echo esc_attr($instance['description_color']) ?>"  />
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('description_size') ?>">  <?php esc_html_e('Description Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_size') ?>" name="<?php echo $this->get_field_name('description_size') ?>" value="<?php echo esc_attr($instance['description_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('description_letter_space') ?>">  <?php esc_html_e('Description Letter Spacing','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_letter_space') ?>" name="<?php echo $this->get_field_name('description_letter_space') ?>" value="<?php echo esc_attr($instance['description_letter_space']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('description_style') ?>"> <?php esc_html_e('Description Font Style','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('description_style') ?>" name="<?php echo $this->get_field_name('description_style') ?>">
          <option value="normal" <?php selected('normal', $instance['description_style']) ?>> <?php esc_html_e('Normal','hsktalents') ?>   </option>
          <option value="italic" <?php selected('italic', $instance['description_style']) ?>>  <?php esc_html_e('Italic','hsktalents') ?></option>
          </select>
      </p>
        <p class="one_fourth_last">
          <label for="<?php echo $this->get_field_id('description_font_weight') ?>"> <?php esc_html_e('Description Font Weight','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('description_font_weight') ?>" name="<?php echo $this->get_field_name('description_font_weight') ?>">
          <option value="normal" <?php selected('normal', $instance['description_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="bold" <?php selected('bold', $instance['description_font_weight']) ?>>  <?php esc_html_e('Bold','hsktalents') ?></option>
          </select>
      </p>
    <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('title_color') ?>"><?php esc_html_e('Client Name Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('title_color') ?>" id="<?php echo $this->get_field_id('title_color') ?>" class="test-colors-picker" value="<?php echo esc_attr($instance['title_color']) ?>" 
          />
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('title_size') ?>">  <?php esc_html_e('Client Name Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_size') ?>" name="<?php echo $this->get_field_name('title_size') ?>" value="<?php echo esc_attr($instance['title_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('title_letter_space') ?>">  <?php esc_html_e('Client Name Letter Space','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('title_letter_space') ?>" name="<?php echo $this->get_field_name('title_letter_space') ?>" value="<?php echo esc_attr($instance['title_letter_space']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth_last">
          <label for="<?php echo $this->get_field_id('title_font_style') ?>"> <?php esc_html_e('Client Name Font Style','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('title_font_style') ?>" name="<?php echo $this->get_field_name('title_font_style') ?>">
          <option value="normal" <?php selected('normal', $instance['title_font_style']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="italic" <?php selected('italic', $instance['title_font_style']) ?>>  <?php esc_html_e('Italic','hsktalents') ?></option>
          </select>
      </p>
    <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('title_font_wight') ?>"> <?php esc_html_e('Client Name Font Weight','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('title_font_wight') ?>" name="<?php echo $this->get_field_name('title_font_wight') ?>">
          <option value="normal" <?php selected('normal', $instance['title_font_wight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="bold" <?php selected('bold', $instance['title_font_wight']) ?>>  <?php esc_html_e('Bold','hsktalents') ?></option>
          </select>
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('designation_color') ?>"><?php esc_html_e('Designation Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('designation_color') ?>" id="<?php echo $this->get_field_id('designation_color') ?>" class="test-colors-picker" value="<?php echo $instance['designation_color'] ?>" 
          />
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('designation_font_size') ?>">  <?php esc_html_e('Designation Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('designation_font_size') ?>" name="<?php echo $this->get_field_name('designation_font_size') ?>" value="<?php echo esc_attr($instance['designation_font_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
          </p>
          <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('designation_letter_space') ?>">  <?php esc_html_e('Designation Letter Space','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('designation_letter_space') ?>" name="<?php echo $this->get_field_name('designation_letter_space') ?>" value="<?php echo esc_attr($instance['designation_letter_space']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth_last">
          <label for="<?php echo $this->get_field_id('designation_font_style') ?>"> <?php esc_html_e('Designation Font Style','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('designation_font_style') ?>" name="<?php echo $this->get_field_name('designation_font_style') ?>">
          <option value="normal" <?php selected('normal', $instance['designation_font_style']) ?>> <?php esc_html_e('Normal','hsktalents') ?>   </option>
          <option value="italic" <?php selected('italic', $instance['designation_font_style']) ?>>  <?php esc_html_e('Italic','hsktalents') ?></option>
          </select>
      </p>
      <p class="one_fourth">
          <label for="<?php echo $this->get_field_id('designation_font_weight') ?>"> <?php esc_html_e('Designation Font Weight','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('designation_font_weight') ?>" name="<?php echo $this->get_field_name('designation_font_weight') ?>">
          <option value="normal" <?php selected('normal', $instance['designation_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="bold" <?php selected('bold', $instance['designation_font_weight']) ?>>  <?php esc_html_e('Bold','hsktalents') ?></option>
          </select>
      </p>
<?php  }
 }
 add_action('widgets_init', create_function('', 'return register_widget("HSK_Testimonial_Slider");'));
 ?>