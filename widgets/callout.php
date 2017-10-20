<?php

  class HSK_Callout_Box extends WP_Widget{
    public function __construct(){ 
      parent::__construct('hsk-colloutboxes',__('HSK - Callout Box','hsktalents'),
      array( 'description' => __('Use this widget to display the callout boxes', 'hsktalents')

      ));
    }
    public function widget($args, $instance){
      $instance = wp_parse_args($instance, array(
         'callout_box_style' => '1',
        'cbox_container_padding_lr' => '0',
        'cbox_container_padding_tb' => '50',
        'callout_text' => 'Add your Own Content Here',
        'callout_description' => 'Add your title description here',
        'cbox_button_text_1' => 'View More',
        'cbox_button_text_2' => 'Read More',
        'cbox_button_link_1' => '#',
        'cbox_button_link_2' => '#',
        'cbox_button_bg_color_1' => '#f5f5f5',
        'cbox_button_bg_color_2' => '#f6f6f6',
        'cbox_button_color_1' => '#f6f6f6',
        'cbox_button_color_2' => '#f5f5f5',
        'cbox_button_hover_bg_color_1' => '',
        'cbox_button_hover_bg_color_2' => '',
        'cbox_button_hover_color_1' => '',
        'cbox_button_hover_color_2' => '',
        'cbox_button_padding_tb' => '7',
        'cbox_button_padding_lr' => '25',
        'cbox_title_font_size' => '30',
        'cbox_title_font_weight' => 'bold',
        'cbox_title_font_style' => 'normal',
        'cbox_title_padding_bottom' => '10',
        'cbox_title_color' => '#353535',
        'cbox_description_font_size' => '15',
        'cbox_description_font_weight' => 'bold',
        'cbox_description_font_style' => 'normal',
        'cbox_description_padding_bottom' => '10',
        'cbox_description_color' => '#757575',
        'cbox-content-wrraper-style' => '',
        'cbox_content_position' => 'center',
      ));
      echo $args['before_widget'];
      $cox_rand = rand(10,2500);
      $css = '.cbox-content-wrraper-'.$cox_rand.' .cbox-content-button-1 a:hover{background-color:'.$instance['cbox_button_hover_bg_color_1'].'!important; color:'.$instance['cbox_button_hover_color_1'].'!important;}';
      $css .= '.cbox-content-wrraper-'.$cox_rand.' .cbox-content-button-2 a:hover{background-color:'.$instance['cbox_button_hover_bg_color_2'].'!important; color:'.$instance['cbox_button_hover_color_2'].'!important;}';
       $css = preg_replace( '/\s+/', ' ', $css ); 
     echo "<style type=\"text/css\">\n" .trim( $css ). "\n</style>";
      $conent_position = ($instance['callout_box_style'] == '2') ? 'text-align:'.$instance['cbox_content_position'].';' : '';      
      echo '<div class="cbox-content-wrraper cbox-content-wrraper-style'. $instance['callout_box_style'].'  cbox-content-wrraper-'.$cox_rand.'" style="padding:'.$instance['cbox_container_padding_tb'].'px '.$instance['cbox_container_padding_lr'].'px; '.$conent_position.' ">';
        
        echo '<div class="cbox-title-description-wrapper">';
          if(!empty($instance['callout_text'])){
             echo '<h3 style="color:'.$instance['cbox_title_color'].'; font-size:'.$instance['cbox_title_font_size'].'px; line-height:'.ceil(1.3*$instance['cbox_title_font_size']).'px; font-weight:'.$instance['cbox_title_font_weight'].'; font-style:'.$instance['cbox_title_font_style'].'; padding-bottom:'.$instance['cbox_title_padding_bottom'].'px;">'.$instance['callout_text'].'</h3>';
          }
          if(trim($instance['callout_description'])){
             echo '<p style="color:'.$instance['cbox_description_color'].'; font-size:'.$instance['cbox_description_font_size'].'px; font-weight:'.$instance['cbox_description_font_weight'].'; line-height:'.ceil(1.6*$instance['cbox_description_font_size']).'px; font-style:'.$instance['cbox_description_font_style'].'; padding-bottom:'.$instance['cbox_description_padding_bottom'].'px;">'.$instance['callout_description'].'</p>';
          }
        echo '</div>';
        if(!empty($instance['cbox_button_text_1'])){
          echo '<div class="cbox-content-button-1 cbox-content-button" style="color:'.$instance['cbox_button_color_1'].';">';
            echo '<a href="'.$instance['cbox_button_link_1'].'" style="padding:'.$instance['cbox_button_padding_tb'].'px '.$instance['cbox_button_padding_lr'].'px; background-color:'.$instance['cbox_button_bg_color_1'].'; color:'.$instance['cbox_button_color_1'].';">'.$instance['cbox_button_text_1'].'</a>';
          echo '</div>';
        }
        if( $instance['callout_box_style'] == '2' ){
          if(!empty($instance['cbox_button_text_2'])){
            echo '<div class="cbox-content-button-1 cbox-content-button" style="color:'.$instance['cbox_button_color_2'].'; ">';
              echo '<a href="'.$instance['cbox_button_link_2'].'" style="padding:'.$instance['cbox_button_padding_tb'].'px '.$instance['cbox_button_padding_lr'].'px; background-color:'.$instance['cbox_button_bg_color_2'].'; color:'.$instance['cbox_button_color_2'].';">'.$instance['cbox_button_text_2'].'</a>';
            echo '</div>';
          }
        }
      echo '</div>';
      echo $args['after_widget'];
    }

    public function form( $instance ){
      $instance = wp_parse_args($instance, array(
        'callout_box_style' => '1',
        'cbox_container_padding_lr' => '0',
        'cbox_container_padding_tb' => '50',
        'callout_text' => 'Add your Own Content Here',
        'callout_description' => 'Add your title description here',
        'cbox_button_text_1' => 'View More',
        'cbox_button_text_2' => 'Read More',
        'cbox_button_link_1' => '#',
        'cbox_button_link_2' => '#',
        'cbox_button_bg_color_1' => '#f5f5f5',
        'cbox_button_bg_color_2' => '#f6f6f6',
        'cbox_button_color_1' => '#353535',
        'cbox_button_color_2' => '#353535',
        'cbox_button_hover_bg_color_1' => '',
        'cbox_button_hover_bg_color_2' => '',
        'cbox_button_hover_color_1' => '',
        'cbox_button_hover_color_2' => '',
        'cbox_button_padding_tb' => '7',
        'cbox_button_padding_lr' => '25',
        'cbox_title_font_size' => '30',
        'cbox_title_font_weight' => 'bold',
        'cbox_title_font_style' => 'normal',
        'cbox_title_padding_bottom' => '10',
        'cbox_title_color' => '#353535',
        'cbox_description_font_size' => '15',
        'cbox_description_font_weight' => 'bold',
        'cbox_description_font_style' => 'normal',
        'cbox_description_padding_bottom' => '10',
        'cbox_description_color' => '#757575',
        'cbox_content_position' => 'center',
      )); ?>
      <script type="text/javascript">
       jQuery(document).ready(function($) {
            $("#<?php echo $this->get_field_id('callout_box_style') ?>").on('change', function(){
               var $cbox_val = $(this).find('option:selected').val();
               $(".<?php echo $this->get_field_id('cbox_button_text_2') ?>").show();
               $(".<?php echo $this->get_field_id('cbox_content_position') ?>").show();
               if( $cbox_val == '1' ){
                  $(".<?php echo $this->get_field_id('cbox_button_text_2') ?>").hide();
                  $(".<?php echo $this->get_field_id('cbox_content_position') ?>").hide();
               }
            }).change();
            $('.cbox-color-pickr').each(function(){ // Color pickr
              $(this).wpColorPicker();
            });
        });
      </script>
      <div class="widgets-fields-group-panel"> 
         <h4><?php esc_html_e('General Settings', 'hsktalents') ?></h4>  
          <p>
            <label for="<?php echo $this->get_field_id('callout_box_style') ?>">  <?php esc_html_e('Select Callout Box Style','hsktalents') ?> </label>
            <select id="<?php echo $this->get_field_id('callout_box_style') ?>" name="<?php echo $this->get_field_name('callout_box_style') ?>">
              <option value="1" <?php selected('1', $instance['callout_box_style']) ?>> <?php esc_html_e('Style - 1', 'hsktalents') ?> </option>
              <option value="2" <?php selected('2', $instance['callout_box_style']) ?>> <?php esc_html_e('Style - 2', 'hsktalents') ?> </option>
            </select>
          </p>
          <p> <!-- Container Padding -->
              <label for="<?php echo $this->get_field_id('cbox_container_padding_lr') ?>"> <?php esc_html_e('Container Padding Left & Right','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_container_padding_lr') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_container_padding_lr') ?>" value = "<?php echo $instance['cbox_container_padding_lr'] ?>" />
              <small>px</small>
          </p>
          <p> <!-- Container Padding -->
              <label for="<?php echo $this->get_field_id('cbox_container_padding_tb') ?>"> <?php esc_html_e('Container Padding Top & Bottom','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_container_padding_tb') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_container_padding_tb') ?>" value = "<?php echo $instance['cbox_container_padding_tb'] ?>" />
              <small>px</small>
          </p>
      </div>  
      <div class="widgets-fields-group-panel"> 
         <h4><?php esc_html_e('Title Section', 'hsktalents') ?></h4>   
          <p> <!-- title -->
            <lable for="<?php echo $this->get_field_id('callout_text') ?>">  <?php esc_html_e('Callout Box Content','hsktalents') ?>  </label>
            <textarea type="text" id="<?php echo $this->get_field_id('description') ?>" class="widefat" name="<?php echo $this->get_field_name('callout_text') ?>" value = "<?php echo esc_attr( $instance['callout_text'] ) ?>" > <?php echo esc_attr( $instance['callout_text'] ) ?></textarea>
          </p>
           <p> <!-- Title Font Settings -->
              <label for="<?php echo $this->get_field_id('cbox_title_font_size') ?>"> <?php esc_html_e('Title Font Size','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_title_font_size') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_title_font_size') ?>" value = "<?php echo $instance['cbox_title_font_size'] ?>" />
              <small>px</small>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_title_color') ?>"> <?php esc_html_e('Title Color','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_title_color') ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_title_color') ?>" value = "<?php echo $instance['cbox_title_color'] ?>" />
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_title_font_weight') ?>">  <?php esc_html_e('Title Font Weight','hsktalents') ?> </label>
              <select id="<?php echo $this->get_field_id('cbox_title_font_weight') ?>" name="<?php echo $this->get_field_name('cbox_title_font_weight') ?>">
                <option value="300" <?php selected('300', $instance['cbox_title_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?> </option>
                <option value="bold" <?php selected('bold', $instance['cbox_title_font_weight']) ?>> <?php esc_html_e('Bold', 'hsktalents') ?> </option>
              </select>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_title_font_style') ?>">  <?php esc_html_e('Title Font Style','hsktalents') ?> </label>
              <select id="<?php echo $this->get_field_id('cbox_title_font_style') ?>" name="<?php echo $this->get_field_name('cbox_title_font_style') ?>">
                <option value="normal" <?php selected('normal', $instance['cbox_title_font_style']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?> </option>
                <option value="italic" <?php selected('italic', $instance['cbox_title_font_style']) ?>> <?php esc_html_e('Italic', 'hsktalents') ?> </option>
              </select>
          </p>
           <p>
              <label for="<?php echo $this->get_field_id('cbox_title_padding_bottom') ?>"> <?php esc_html_e('Title Bottom Space','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_title_padding_bottom') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_title_padding_bottom') ?>" value = "<?php echo $instance['cbox_title_padding_bottom'] ?>" />
              <small>px</small>
          </p>
      </div>
      <div class="widgets-fields-group-panel"> 
         <h4><?php esc_html_e('Description Section', 'hsktalents') ?></h4>     
          <p> <!-- Description -->
            <lable for="<?php echo $this->get_field_id('callout_description') ?>">  <?php esc_html_e('Callout Description','hsktalents') ?>  </label>
            <textarea type="text" id="<?php echo $this->get_field_id('callout_description') ?>" class="widefat" name="<?php echo $this->get_field_name('callout_description') ?>" value = "<?php echo esc_attr( $instance['callout_description'] ) ?>" > <?php echo esc_attr( $instance['callout_description'] ) ?></textarea>
          </p>
          <p> <!-- Deription Font Settings -->
              <label for="<?php echo $this->get_field_id('cbox_description_font_size') ?>"> <?php esc_html_e('Description Font Size','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_description_font_size') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_description_font_size') ?>" value = "<?php echo $instance['cbox_description_font_size'] ?>" />
              <small>px</small>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_description_font_weight') ?>">  <?php esc_html_e('Description Font Weight','hsktalents') ?> </label>
              <select id="<?php echo $this->get_field_id('cbox_description_font_weight') ?>" name="<?php echo $this->get_field_name('cbox_description_font_weight') ?>">
                <option value="300" <?php selected('300', $instance['cbox_description_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?> </option>
                <option value="bold" <?php selected('bold', $instance['cbox_description_font_weight']) ?>> <?php esc_html_e('Bold', 'hsktalents') ?> </option>
              </select>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_description_font_style') ?>">  <?php esc_html_e('Title Font Style','hsktalents') ?> </label>
              <select id="<?php echo $this->get_field_id('cbox_description_font_style') ?>" name="<?php echo $this->get_field_name('cbox_description_font_style') ?>">
                <option value="300" <?php selected('300', $instance['cbox_description_font_style']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?> </option>
                <option value="bold" <?php selected('bold', $instance['cbox_description_font_style']) ?>> <?php esc_html_e('Bold', 'hsktalents') ?> </option>
              </select>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_description_padding_bottom') ?>"> <?php esc_html_e('Description Bottom Space','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_description_padding_bottom') ?>" class="small-text" name="<?php echo $this->get_field_name('cbox_description_padding_bottom') ?>" value = "<?php echo $instance['cbox_description_padding_bottom'] ?>" />
              <small>px</small>
          </p>
          <p>
              <label for="<?php echo $this->get_field_id('cbox_description_color') ?>"> <?php esc_html_e('Description Color','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_description_color') ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_description_color') ?>" value = "<?php echo $instance['cbox_description_color'] ?>" />
              <small>px</small>
          </p>
      </div>
      <div class="widgets-fields-group-panel"> 
           
          <?php
          for ($i=1; $i < 3 ; $i++) { ?>
                 <h4><?php echo esc_html__('Button ', 'hsktalents').' '.$i ?></h4> 
                
               <div class="cbox_button_wrapper <?php echo $this->get_field_id('cbox_button_text_'.$i) ?>">  
              <p> <!-- Button Tet -->
                <label for="<?php echo $this->get_field_id('cbox_button_text_'.$i) ?>"> <?php echo esc_html__('Button Text ','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_text_'.$i) ?>" class="widefat" name="<?php echo $this->get_field_name('cbox_button_text_'.$i) ?>" value = "<?php echo $instance['cbox_button_text_'.$i] ?>" />
              </p>
              <p> <!-- link -->
                <label for="<?php echo $this->get_field_id('cbox_button_link_'.$i) ?>"> <?php echo esc_html__('Button Link ','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_link_'.$i) ?>" class="widefat" name="<?php echo $this->get_field_name('cbox_button_link_'.$i) ?>" value = "<?php echo $instance['cbox_button_link_'.$i] ?>" />
              </p>
              <p> <!-- Background color -->
                <label for="<?php echo $this->get_field_id('cbox_button_bg_color_'.$i) ?>"> <?php echo esc_html__('Button Background Color','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_bg_color_'.$i) ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_button_bg_color_'.$i) ?>" value = "<?php echo $instance['cbox_button_bg_color_'.$i] ?>" />
              </p>
              <p> <!-- color -->
                <label for="<?php echo $this->get_field_id('cbox_button_color_'.$i) ?>"> <?php echo esc_html__('Button Color','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_color_'.$i) ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_button_color_'.$i) ?>" value = "<?php echo $instance['cbox_button_color_'.$i] ?>" />
              </p>
              <p> <!-- Background color -->
                <label for="<?php echo $this->get_field_id('cbox_button_hover_bg_color_'.$i) ?>"> <?php echo esc_html__('Button Hover background Color','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_hover_bg_color_'.$i) ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_button_hover_bg_color_'.$i) ?>" value = "<?php echo $instance['cbox_button_hover_bg_color_'.$i] ?>" />
              </p>
              <p> <!-- color -->
                <label for="<?php echo $this->get_field_id('cbox_button_hover_color_'.$i) ?>"> <?php echo esc_html__('Button Hover Color','hsktalents').' '.$i ?>  </label>
                <input type="text" id="<?php echo $this->get_field_id('cbox_button_hover_color_'.$i) ?>" class="cbox-color-pickr" name="<?php echo $this->get_field_name('cbox_button_hover_color_'.$i) ?>" value = "<?php echo $instance['cbox_button_hover_color_'.$i] ?>" />
              </p>
            </div>
            <hr>

          <?php } ?>
          <p> <!-- Button Padding -->
              <label for="<?php echo $this->get_field_id('cbox_button_padding_lr') ?>"> <?php esc_html_e('Button Padding Left & Right','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_button_padding_lr') ?>" class="widefat" name="<?php echo $this->get_field_name('cbox_button_padding_lr') ?>" value = "<?php echo $instance['cbox_button_padding_lr'] ?>" />
          </p>
          <p> <!-- Button Padding -->
              <label for="<?php echo $this->get_field_id('cbox_button_padding_tb') ?>"> <?php esc_html_e('Button Padding Top & Bottom','hsktalents') ?>  </label>
              <input type="text" id="<?php echo $this->get_field_id('cbox_button_padding_tb') ?>" class="widefat" name="<?php echo $this->get_field_name('cbox_button_padding_tb') ?>" value = "<?php echo $instance['cbox_button_padding_tb'] ?>" />
          </p>
        </div>
      <div class="widgets-fields-group-panel"> 
         <h4><?php esc_html_e('Content Positions', 'hsktalents') ?></h4>   
          <p class="<?php echo $this->get_field_id('cbox_content_position') ?>">
            <label for="<?php echo $this->get_field_id('cbox_content_position') ?>">  <?php esc_html_e('Callout Box Content Position','hsktalents') ?> </label>
              <select id="<?php echo $this->get_field_id('cbox_content_position') ?>" name="<?php echo $this->get_field_name('cbox_content_position') ?>">
                <option value="left" <?php selected('left', $instance['cbox_content_position']) ?>> <?php esc_html_e('Left', 'hsktalents') ?> </option>
                <option value="center" <?php selected('center', $instance['cbox_content_position']) ?>> <?php esc_html_e('Center', 'hsktalents') ?> </option>
              </select>
          </p>
      </div>    
      <?php 
    }
  }
add_action('widgets_init', create_function('', 'return register_widget("HSK_Callout_Box");'));
?>