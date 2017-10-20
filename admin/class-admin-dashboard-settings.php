<?php
add_action( 'init', 'hsk_talents_adshboard_admin_init' );
add_action( 'admin_menu', 'hsk_talents_dashboard_settings_page_init' );
global $talents_dashbaord_page_ids;
$talents_dashbaord_page_ids = array(
    'general' => array(
        'upload_dashboard_log_img' => array(
            'value' => '',
        ),
        'user_dashbaord_welcome_message_title' => array(
            'value' => '',
        ),
        'user_dashbaord_welcome_message' => array(
          'value' => '',
        ),
        'user_dashboard_footer_copy_rights_text' => array(
               'value' => esc_html__('Add Copy rights text here', 'hsktalents') 
        ),
        'title' => esc_html__('General', 'hsktalents')
    ),
);
function hsk_talents_adshboard_admin_init() {
    global $talents_dashbaord_page_ids;
    $settings = get_option( "hsk_user_dashboard" );
    if ( empty( $settings ) ) {
        $settings = array(
            'reg_page_link' => '',
        );
        add_option( "hsk_user_dashboard", $settings, '', 'yes' );
    }   
}

function hsk_talents_dashboard_settings_page_init() {
   $settings_page = add_menu_page(esc_html__("Settings", 'hsktalents'), esc_html__('Settings', 'hsktalents'), 'edit_theme_options', 'hsk-user-dashboard', 'hsk_talents_dashboard_settings_page' );
    add_action( "load-{$settings_page}", 'hsk_talents_load_dashboard_settings_page' );
}

function hsk_talents_load_dashboard_settings_page() {
    if ( ( isset($_POST["hsk-user-dashboard-settings-submit"]) && $_POST["hsk-user-dashboard-settings-submit"] ) == 'Y' ) {
        check_admin_referer( "hsk-user-dashboard-settings-page" );
        hsk_talents_save_dashboard_settings();
        $url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
        wp_redirect(admin_url('admin.php?page=hsk-user-dashboard&'.$url_parameters));
        exit;
    }
}

function hsk_talents_save_dashboard_settings() {
    global $pagenow, $talents_dashbaord_page_ids;
    $settings = get_option( "hsk_user_dashboard" );
    
    if ( $pagenow == 'admin.php' && $_GET['page'] == 'hsk-user-dashboard' ){ 
        if ( isset ( $_GET['tab'] ) )
            $tab = $_GET['tab']; 
        else
            $tab = 'general'; 

            foreach ($talents_dashbaord_page_ids as $key => $talents_page_id) {
                foreach ($talents_page_id as $ids => $talents_id) {
                        if( $tab == $key  ){
                             $settings[$ids]  = $_POST[$ids] ? $_POST[$ids] : $talents_id['value'];
                        }
                    }  
            }
    }
    
    $updated = update_option( "hsk_user_dashboard", $settings );
}

function hsk_talents_dashboard_admin_tabs( $current = 'general' ) {
    global $talents_dashbaord_page_ids;
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
      foreach ($talents_dashbaord_page_ids as $key => $talents_page_id) {
            $class = ( $key == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=hsk-user-dashboard&tab=$key'>".$talents_page_id['title']."</a>";
        }
    echo '</h2>';
}

function hsk_talents_dashboard_settings_page() {
    global $pagenow;
    $settings = get_option( "hsk_user_dashboard" );  ?>
    <div class="wrap hsk-talent-dasboard-options-wrapper">
        <h2><?php _e('Page Settings', 'hsktalents'); ?></h2>        
        <?php
            if ( 'true' == ( isset( $_GET['updated']) && esc_attr( $_GET['updated'] )) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>';            
            if ( isset ( $_GET['tab'] ) ) hsk_talents_dashboard_admin_tabs($_GET['tab']); else hsk_talents_dashboard_admin_tabs('general');
        ?>
        <div id="poststuff">
            <form method="post" action="<?php admin_url( 'admin.php?page=hsk-user-dashboard' ); ?>">
                <?php  wp_nonce_field( "hsk-user-dashboard-settings-page" );                 
                if ( $pagenow == 'admin.php' && $_GET['page'] == 'hsk-user-dashboard' ){                 
                    if ( isset ( $_GET['tab'] ) ) $active_tab = $_GET['tab']; 
                    else $active_tab = 'general';                     
                    
                    if($active_tab == 'general') {
                        //include_once 'talents-menu-options/general-settings.php';
                        // Upload Logo image
                       // echo '<div class="user-dashhboard-files" id="upload_dashboard_log_img_info">'; ?>
                          <div class="inside">
                            <table class="form-table">
                                <tr>
                              <?php    
                                  echo '<th><label>'.esc_html__('User Dashboard Logo Image', 'hsktalents').'</label></th>';
                                  echo '<td>';
                                    $image_thumb = '';
                                    if( isset($settings['upload_dashboard_log_img']) ) {
                                    $image_thumb = wp_get_attachment_thumb_url( $settings['upload_dashboard_log_img'] );
                                    }
                                    echo '<img id="upload_dashboard_log_img_preview" class="image_preview" src="'.$image_thumb.'" /><br/>' . "\n";
                                    echo '<input id="upload_dashboard_log_img_button" type="button" data-uploader_title="' . esc_html__( 'Upload an image' , 'hsktalents' ) . '" data-uploader_button_text="' . esc_html__( 'Use image' , 'hsktalents' ) . '" class="image_upload_button button" value="'. esc_html__( 'Upload Dashboard Logo Image' , 'hsktalents' ) . '" />' . "\n";
                                    echo '<input id="upload_dashboard_log_img_delete" type="button" class="image_delete_button button" value="'. esc_html__( 'Remove image' , 'hsktalents' ) . '" />' . "\n";
                                    echo '<input id="upload_dashboard_log_img" class="image_data_field" type="hidden" name="upload_dashboard_log_img" value="' . ( !empty($settings['upload_dashboard_log_img']) ? $settings['upload_dashboard_log_img'] : '' ) . '"/><br/>' . "\n";
                                  echo '</td>';
                              echo '</tr>';    
                        // Add userdashboard message Title
                            echo '<tr class="user-dashhboard-files" id="user_dashbaord_welcome_message_title">';
                              echo '<th><label>'.esc_html__('User Dashoard Welcome Message', 'hsktalents').'</lable></th>';
                              echo '<td><input type="text" class="widefat" id="user_dashbaord_welcome_message_title" name="user_dashbaord_welcome_message_title" placeholder="" value="' .(!empty($settings['user_dashbaord_welcome_message_title']) ? $settings['user_dashbaord_welcome_message_title'] : __('User Dashoard Title', 'hsktalents')) . '" /></td>'. "\n";
                            echo '</tr>';
                          // Add userdashboard message
                          echo '<tr class="user-dashhboard-files" id="user_dashbaord_welcome_message">';
                            echo '<th><label>'.esc_html__('User Dashoard Welcome Message', 'hsktalents').'</lable></th>';
                            echo '<td><textarea id="user_dashbaord_welcome_message" rows="5" cols="150" name="user_dashbaord_welcome_message" placeholder="">' . (!empty($settings['user_dashbaord_welcome_message']) ? $settings['user_dashbaord_welcome_message'] : __('User Dashboard Description','hsktalents')) . '</textarea></td>'. "\n";
                          echo '</tr>';

                        // Footer Copy Rights Text
                        echo '<tr class="user-dashhboard-files" id="user_dashboard_footer_copy_rights_text">';
                        echo '<th><label>'.esc_html__('User Dashoard Welcome Message', 'hsktalents').'</lable></th>';
                        echo '<td><textarea class="widefat" id="user_dashboard_footer_copy_rights_text" rows="2" cols="20" name="user_dashboard_footer_copy_rights_text" placeholder="">' . ( !empty($settings['user_dashboard_footer_copy_rights_text']) ? $settings['user_dashboard_footer_copy_rights_text'] : __('Copy rights sitesspark.com', 'hsktalents') ) . '</textarea></td>'. "\n";
                        echo '</tr>';
                    }
                }
                ?>
                <tr><td>
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="hsk-user-dashboard-settings-submit" value="Y" />
                </p>
                </td></tr>
            </table>
        </div>
            </form>
        </div>
    </div>
<?php
}

/**
 * Load settings JS & CSS
 * @return void
 */
 add_action( 'admin_print_styles', 'hsk_user_dashboard_admin_enqueue_scripts' );
function hsk_user_dashboard_admin_enqueue_scripts() {
  wp_enqueue_media();
}

function hsk_user_dashboard_admin_scripts(){ ?>
  <script type="text/javascript">
    var file_frame;

    jQuery.fn.uploadMediaFile = function( button, preview_media ) {
        var button_id = button.attr('id');
        var field_id = button_id.replace( '_button', '' );
        var preview_id = button_id.replace( '_button', '_preview' );

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
          file_frame.open();
          return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
          title: jQuery( this ).data( 'uploader_title' ),
          button: {
            text: jQuery( this ).data( 'uploader_button_text' ),
          },
          multiple: false
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
          attachment = file_frame.state().get('selection').first().toJSON();
          jQuery("#"+field_id).val(attachment.id);
          if( preview_media ) {
            jQuery("#"+preview_id).attr('src',attachment.sizes.thumbnail.url);
          }
        });

        // Finally, open the modal
        file_frame.open();
    }

    jQuery('.image_upload_button').click(function() {
        jQuery.fn.uploadMediaFile( jQuery(this), true );
    });

    jQuery('.image_delete_button').click(function() {
        jQuery(this).closest('td').find( '.image_data_field' ).val( '' );
        jQuery( '.image_preview' ).remove();
        return false;
    });
  </script>
<?php }
add_action('admin_footer', 'hsk_user_dashboard_admin_scripts');

function hsk_talent_admin_dashboard_settings(){
  global $talents_dashbaord_page_ids;
    $settings = get_option( "hsk_user_dashboard" );
    $daboard_logo_img = !empty($settings['upload_dashboard_log_img']) ? $settings['upload_dashboard_log_img'] :'';
    $image_id= wp_get_attachment_image_src($daboard_logo_img, 'full');
    $css = '';
    $css .= '#adminmenuwrap::before{
        background-image:url('.$image_id[0].')!important;
    }';
    echo '<style type="text/css" >'.preg_replace('/\s+/', ' ', $css).'</style>';
}
add_action('admin_head', 'hsk_talent_admin_dashboard_settings');

global $user_dashboard_settinsg;
$user_dashboard_settinsg = get_option('hsk_user_dashboard');
if( !empty($user_dashboard_settinsg['user_dashboard_footer_copy_rights_text']) ){
    add_filter( 'admin_footer_text', 'hsk_talents_dashboard_footer_text' );
    /**
     * Modify the footer text inside of the WordPress admin area.
     *
     * @since 1.0.0
     *
     * @param string $text  The default footer text.
     * @return string $text Amended footer text.
     */
    function hsk_talents_dashboard_footer_text( $text ) {
        global $user_dashboard_settinsg;
        return $user_dashboard_settinsg['user_dashboard_footer_copy_rights_text'];
    }
}
?>