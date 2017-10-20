<?php
class HSK_Team_Social_Widget extends WP_Widget{
  public function __construct(){
    global $julia_plugin_name;
    parent::__construct(  'team-member',
        __('HSK - Team Style-2', 'hsktalents'),
    array( 'description' => __('Dsiplay team members information along social media icons', 'hsktalents'), 'class' => '' )
    );
  }
  public function widget( $args , $instance ){
    $instance = wp_parse_args($instance, array(
        'image_url' => '', 
        'team_member_name' => 'Member Name',
        'designation' => 'Programmer',
        'link' => '#',
        'description' => '',
        'team_member_name_bgcolor' => '#000',
        'team_member_color' => '#fff',
        'team_member_size' => '16',
        'team_member_letter_space' =>'0',
        'team_member_style' => 'normal',
        'team_member_weight' => 'normal',
        'img_width' => '500',
        'img_height' => '500',
        'designation_color' => '#f6f6f6',
        'designation_font_size' => '13',
        'designation_letter_space' => '',
        'designation_font_style' => 'normal',
        'designation_font_weight' => 'normal',
        'description_color' => '',
        'description_size' => '14',
        'description_style' => 'normal',
        'description_font_weight' => 'normal',
        'social_icon_1' => 'fa-facebook',
        'social_icon_link_1' => '#',
        'social_icon_2' => 'fa-facebook',
        'social_icon_link_2' => '#',
        'social_icon_3' => 'fa-facebook',
        'social_icon_link_3' => '#',  
        'social_icon_4' => 'fa-facebook',
        'social_icon_link_4' => '#',  
        'social_icon_5' => 'fa-facebook',
        'social_icon_link_5' => '#',
        'img_width' => '500',
        'img_height' => '500',
        'description_letter_space' => '0',
      ));
    echo $args['before_widget'];
      echo '<div class="team-member-content-wrapper">';
          echo '<div class="team-member-image">';
            $img_url = get_template_directory_uri().'/images/default_image.jpg';
            if( !empty($instance['image_url']) ){
              echo '<img alt="team image" src="'.hsk_image_crop($instance['image_url'], $instance['img_width'], $instance['img_height']).'">';
            }else{
              echo '<img alt="team image" src="'.hsk_image_crop($img_url, $instance['img_width'], $instance['img_height']).'">';
            }
            // Img Description
            echo '<div class="team-title-designation">';
               echo '<h5><a style="color:'.$instance['team_member_color'].'; font-size:'.$instance['team_member_size'].'px; letter-spacing:'.$instance['team_member_letter_space'].'px; font-weight:'.$instance['team_member_weight'].'; font-style:'.$instance['team_member_style'].'; " href="'.$instance['link'].'">'.$instance['team_member_name'].'</a></h5>';
              echo '<strong style="color:'.$instance['designation_color'].'; font-size:'.$instance['designation_font_size'].'px; letter-spacing:'.$instance['designation_letter_space'].'px; font-weight:'.$instance['designation_font_weight'].'; font-style:'.$instance['designation_font_style'].'; ">'.$instance['designation'].'</strong>';
            echo '</div>';
            // Social Share Icons
            echo '<div class="team-social-follow-icons">';
              echo '<ul>';
              for($i = 1; $i<=4; $i++ ){
                  if( !empty($instance['social_icon_'.$i]) ){
                    echo '<li><a style="color:'.$instance['team_member_color'].';  background-color:'.$instance['team_member_name_bgcolor'].'; " href="'.$instance['link'].'" target="_blank"><i class="fa '.$instance['social_icon_'.$i].'"></i></a></li>';
                  }
              }
              echo '</ul>';
            echo '</div>';
          echo '</div>';
          if( !empty($instance['description']) ){
            echo '<div class="team-member-description">';
              echo '<p style="color:'.$instance['description_color'].'; font-size:'.$instance['description_size'].'px; letter-spacing:'.$instance['description_letter_space'].'px; font-weight:'.$instance['description_font_weight'].'; font-style:'.$instance['description_style'].';">'.$instance['description'].'</p>';
            echo '</div>';
          }
      echo '</div>';
   echo $args['after_widget'];
  }
  public function form( $instance ){
      $instance = wp_parse_args( $instance, array(
        'image_url' => '', 
        'team_member_name' => 'Member Name',
        'designation' => 'Programmer',
        'link' => '#',
        'description' => '',
        'team_member_name_bgcolor' => '#000',
        'team_member_color' => '#fff',
        'team_member_size' => '16',
        'team_member_letter_space' =>'0',
        'team_member_style' => 'normal',
        'team_member_weight' => 'normal',
        'img_width' => '500',
        'img_height' => '500',
        'designation_color' => '#f6f6f6',
        'designation_font_size' => '13',
        'designation_letter_space' => '',
        'designation_font_style' => 'normal',
        'designation_font_weight' => 'normal',
        'description_color' => '',
        'description_size' => '14',
        'description_style' => 'normal',
        'description_font_weight' => 'normal',
        'social_icon_1' => 'fa-facebook',
        'social_icon_link_1' => '#',
        'social_icon_2' => 'fa-facebook',
        'social_icon_link_2' => '#',
        'social_icon_3' => 'fa-facebook',
        'social_icon_link_3' => '#',  
        'social_icon_4' => 'fa-facebook',
        'social_icon_link_4' => '#',  
        'social_icon_5' => 'fa-facebook',
        'social_icon_link_5' => '#',
        'img_width' => '500',
        'img_height' => '500',
        'description_letter_space' =>'0',  
        
  ));
      $button_rand = rand(1000,2055555);
  ?>
  <script type='text/javascript'>
    (function($) {
      "use strict";
      $(function() {
        $('.team-member-color-picker').each(function(){
          $(this).wpColorPicker();
        });
      });
    })(jQuery);
  </script> 
  <script type='text/javascript'>
      jQuery(document).ready(function($) {
        $(document).on("click", ".upload_image_button<?php echo $button_rand; ?>", function (e) {
      e.preventDefault();
      var $button = $(this);
        // Create the media frame.
        var file_frame = wp.media.frames.file_frame = wp.media({
           title: '<?php esc_html_e('Upload Team Member Image', 'hsktalents'); ?>',
           library: { // remove these to show all
              type: 'image' // specific mime
           },
           button: {
              text: 'Select'
           },
           multiple: false  // Set to true to allow multiple files to be selected
        });
   
        // When an image is selected, run a callback.
        file_frame.on('select', function () {
           // We set multiple to false so only get one image from the uploader
   
           var attachment = file_frame.state().get('selection').first().toJSON();
   
           $button.siblings('input').val(attachment.url);
   
        });
   
        // Finally, open the modal
        file_frame.open();
     });
      });
    </script>
    <p>
      <input class="widefat" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" type="text" value="<?php echo esc_url( $instance['image_url'] ); ?>" />
      <button class="upload_image_button<?php echo $button_rand; ?> button button-primary"><?php esc_html_e('Upload Team Member Image', 'hsktalents'); ?></button>
    </p>
      <p>
        <label for="<?php echo $this->get_field_id('img_width'); ?>"><?php esc_html_e('Image Width & Height', 'hsktalents') ?></label>
        <input type="text" name="<?php echo $this->get_field_name('img_width') ?>" id="<?php echo $this->get_field_id('img_width') ?>" class="small-text" value="<?php echo esc_attr($instance['img_width']) ?>" />X
        <input type="text" name="<?php echo $this->get_field_name('img_height') ?>" id="<?php echo $this->get_field_id('img_height') ?>" class="small-text" value="<?php echo esc_attr($instance['img_height']) ?>" />px
    </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('team_member_name') ?>"><?php esc_html_e('Team Member Name','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('team_member_name') ?>" id="<?php echo $this->get_field_id('team_member_name') ?>" class="" value="<?php echo esc_attr($instance['team_member_name']) ?>" 
          />
      </p>

      <p class="">
          <label for="<?php echo $this->get_field_id('designation') ?>"><?php esc_html_e('Team Member Name','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('designation') ?>" id="<?php echo $this->get_field_id('designation') ?>" class="" value="<?php echo esc_attr($instance['designation']) ?>" 
          />
      </p>
      <p>
           <label for="<?php echo $this->get_field_id('description') ?>"><?php esc_html_e('Description','hsktalents'); ?></label>
          <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>"  name="<?php echo $this->get_field_name('description'); ?>" ><?php echo $instance['description']; ?></textarea>
      </p>

      <?php 
        for ($i=1; $i < 5; $i++) { ?>
          
          <p>
             <label for="<?php echo $this->get_field_id('social_icon_'.$i) ?>"><?php echo esc_attr__('Socail Media Icon' ,'hsktalents').''.$i; ?></label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_'.$i) ?>" id="<?php echo $this->get_field_id('social_icon_'.$i) ?>" class="" value="<?php echo esc_attr($instance['social_icon_'.$i]) ?>" >
           </p>
           <p>
             <label for="<?php echo $this->get_field_id('social_icon_link_'.$i) ?>"><?php echo esc_attr__('Socail Media Icon Link' ,'hsktalents').''.$i; ?></label>
            <input type="text" name="<?php echo $this->get_field_name('social_icon_link_'.$i) ?>" id="<?php echo $this->get_field_id('social_icon_link_'.$i) ?>" class="" value="<?php echo esc_attr($instance['social_icon_link_'.$i]) ?>" >
           </p>
        <?php } ?>


      <p class="">
          <label for="<?php echo $this->get_field_id('team_member_color') ?>"><?php esc_html_e('Team Member Name Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('team_member_color') ?>" id="<?php echo $this->get_field_id('team_member_color') ?>" class="team-member-color-picker" value="<?php echo esc_attr($instance['team_member_color']) ?>" 
          />
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('team_member_size') ?>">  <?php esc_html_e('Team Member Name Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('team_member_size') ?>" name="<?php echo $this->get_field_name('team_member_size') ?>" value="<?php echo esc_attr($instance['team_member_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('team_member_letter_space') ?>">  <?php esc_html_e('Team Member Name Letter Space','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('team_member_letter_space') ?>" name="<?php echo $this->get_field_name('team_member_letter_space') ?>" value="<?php echo esc_attr($instance['team_member_letter_space']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="one_fourth_last">
          <label for="<?php echo $this->get_field_id('team_member_style') ?>"> <?php esc_html_e('Team Member Name Font Style','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('team_member_style') ?>" name="<?php echo $this->get_field_name('team_member_style') ?>">
          <option value="normal" <?php selected('normal', $instance['team_member_style']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="italic" <?php selected('italic', $instance['team_member_style']) ?>>  <?php esc_html_e('Italic','hsktalents') ?></option>
          </select>
      </p>
    <p class="">
          <label for="<?php echo $this->get_field_id('team_member_weight') ?>"> <?php esc_html_e('Team Member Name Font Weight','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('team_member_weight') ?>" name="<?php echo $this->get_field_name('team_member_weight') ?>">
          <option value="normal" <?php selected('normal', $instance['team_member_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="bold" <?php selected('bold', $instance['team_member_weight']) ?>>  <?php esc_html_e('Bold','hsktalents') ?></option>
          </select>
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('designation_color') ?>"><?php esc_html_e('Designation Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('designation_color') ?>" id="<?php echo $this->get_field_id
          ('designation_color') ?>" class="team-member-color-picker" value="<?php echo $instance['designation_color'] ?>" 
          />
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('designation_font_size') ?>">  <?php esc_html_e('Designation Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('designation_font_size') ?>" name="<?php echo $this->get_field_name('designation_font_size') ?>" value="<?php echo esc_attr($instance['designation_font_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
          </p>
          <p class="">
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
      <p class="">
          <label for="<?php echo $this->get_field_id('designation_font_weight') ?>"> <?php esc_html_e('Designation Font Weight','hsktalents') ?></label>
          <select id="<?php echo $this->get_field_id('designation_font_weight') ?>" name="<?php echo $this->get_field_name('designation_font_weight') ?>">
          <option value="normal" <?php selected('normal', $instance['designation_font_weight']) ?>> <?php esc_html_e('Normal', 'hsktalents') ?>   </option>
          <option value="bold" <?php selected('bold', $instance['designation_font_weight']) ?>>  <?php esc_html_e('Bold','hsktalents') ?></option>
          </select>
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('description_color') ?>"><?php esc_html_e('Description Color','hsktalents'); ?></label>
          <input type="text" name="<?php echo $this->get_field_name('description_color') ?>" id="<?php echo $this->get_field_id('description_color') ?>" class="team-member-color-picker" value="<?php echo esc_attr($instance['description_color']) ?>"  />
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('description_size') ?>">  <?php esc_html_e('Description Font Size','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_size') ?>" name="<?php echo $this->get_field_name('description_size') ?>" value="<?php echo esc_attr($instance['description_size']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="">
          <label for="<?php echo $this->get_field_id('description_letter_space') ?>">  <?php esc_html_e('Description Letter Spacing','hsktalents') ?>  </label>
          <input type="text" class="small-text" id="<?php echo $this->get_field_id('description_letter_space') ?>" name="<?php echo $this->get_field_name('description_letter_space') ?>" value="<?php echo esc_attr($instance['description_letter_space']) ?>" />
          <small>  <?php esc_html_e('px','hsktalents') ?>  </small> 
      </p>
      <p class="">
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
    
<?php  }
 }
 add_action('widgets_init', create_function('', 'return register_widget("HSK_Team_Social_Widget");'));
 ?>