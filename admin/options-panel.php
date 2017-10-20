<?php
add_action( 'init', 'hsk_talents_admin_init' );
add_action( 'admin_menu', 'hsk_talents_settings_page_init' );
global $talents_page_tabs_data;
$talents_page_tabs_data = array(
    'general' => array(
        'user_logged_in_msg' => array(
            'value' => __('Please, you must login', 'hsktalents'),
        ),
        'hsk_facebook_app_id' => array(
            'value' => '',
        ),
        'enable_single_page_comments' => array(
            'value' => '',
        ),
        'title' => __('General', 'hsktalents')
    ),
    'reg_login' => array(
        'reg_page_link' => array(
            'value' => '',
        ),
        'email_exist_error' => array(
            'value' => __('Email Already Exist', 'hsktalents')
        ),
        'email_validate_error' => array(
            'value' => __('Enter Valid Email', 'hsktalents')
        ),
        'user_exist_error' => array(
            'value' => __('User Already Exist', 'hsktalents')
        ),
        'reg_success_msg' => array(
            'value' => __('You Have Registred Successfully, Please Login with your login credentials', 'hsktalents')
        ),
        'reg_email_subject' => array(
            'value' => __('User Login Details', 'hsktalents')
        ),
        'reg_email_message' => array(
            'value' => __('Thankyou registering with us, please login with above user name & password. For any assistance please contact admin ', 'hsktalents')
        ),
        'reg_button_text' => array(
            'value' => __('Register', 'hsktalents')
        ),
        'login_page_link' => array(
            'value' => __('User Login Details', 'hsktalents')
        ),
        'login_success_page_redirect' => array(
            'value' => '',
        ),
        'login_error_msg' => array(
            'value' => __('Error Login, Please check your user name / password.', 'hsktalents')
        ),
        'login_success_msg' => array(
            'value' => __('Please wait, your are logging', 'hsktalents')
        ),
        'forgot_password_page_link' => array(
            'value' => '',
        ),
        'forgot_password_form_msg' => array(
            'value' => __('Please Enter your email id, the password will send your email', 'hsktalents')
        ),
        'forgot_password_button_text' => array(
            'value' => __('Forgot Password', 'hsktalents')
        ),
        'logout_page_link' => array(
            'value' => '',
        ),
        'logout_button_text' => array(
            'value' => __('Logout', 'hsktalents')
        ),
        'profile_page_link' => array(
            'value' => '',
        ),
        'profile_profile_note' => array(
            'value' => '',
        ),
        'profile_update_success_msg' =>array(
            'value' => __('Your Profile has been updated successfully', 'hsktalents'),
        ),
        'profile_update_button_text' => array(
            'value' => __('Update Profile', 'hsktalents')
        ),
        'profile_update_error_msg' =>array(
            'value' => __('Error, While updating your profile', 'hsktalents'),
        ),
        'profile_update_pwd_error' => array(
            'value' => __('The passwords you entered do not match. Your password was not updated', 'hsktalents')
        ),
        'title' => __('Registration / Login', 'hsktalents')
    ),
    'talents_settings' => array(
        'display_cat_columns' => array(
            'value' => '4',
        ),
        'cat_height' => array(
            'value' => '500',
        ),
        'cat_limit' => array(
            'value' => '-1',
        ),
        'disable_talents_favourite_button' => array(
            'value' => '0',
        ),
        'talent_favarative_button_text' => array(
            'value' => __('Favarative', 'hsktalents'),
        ),
        'talent_following_button_text' => array(
            'value' => __('Following', 'hsktalents'),
        ),
        'talent_enquiry_button_text' => array(
            'value' => __('Enquiry', 'hsktalents'),
        ),
        'talent_share_button_text' => array(
            'value' => __('Share On', 'hsktalents'),
        ),
        'talent_views_text' => array(
                'value' => __('Talents Views Text Change', 'hsktalents'),
            ),
        'diable_talent_views' => array(
                'value' => '0',
            ),
        'disable_tags_section' => array(
            'value' => '0',
        ),
        'change_tags_text' => array(
            'value' => __('Tags', 'hsktalents'),
        ),
        'disable_follows_on_section' => array(
            'value' => '0',
        ),
        'change_follows_on_text' => array(
            'value' => __('Follow Us On', 'hsktalents'),
        ),
         'talent_dedication_text' => array(
            'value' => __('Dedication', 'hsktalents'),
        ),
        'diable_talent_dedication' => array(
            'value' => '0',
        ),
        'disable_talent_unique_id' => array(
            'value' => '0',
        ),
        'talent_account_id_text' => array(
            'value' => __('Account ID', 'hsktalents'),
        ),
        'talent_unique_id_prefix' => array(
            'value' => 'HSK',
        ),
        'disable_titlebar_talent_img' => array(
            'value' => '0',
        ),
        'disable_talents_rating' => array(
            'value' => '0',
        ),
        'review_rating_text_change' => array(
            'value' => __('Review & Rating', 'hsktalents'),
        ),
        'disable_talents_shortlist' => array(
            'value' => '0',
        ),
        'disable_talents_followers' => array(
            'value' => '0',
        ),
        'disable_talents_enquiry' => array(
            'value' => '0',
        ),
        'disable_talents_social_share' => array(
            'value' => '0',
        ),
        'disable_related_talents' => array(
            'value' => '0',
        ),
        'related_talents_title' => array(
            'value' => '__("Related Talents", "hsk")',
        ),

        'title' => __('Talents', 'hsktalents')
    ),
    /**
     * Favourite Section Settings
     */
    'favourite_page' => array(
        'favourite_page_link' => array(
            'value' => '',
        ),
        'disable_favourite_section' => array(
            'value' => '',
        ),  
        'clear_favouritive_text' => array(
            'value' => __('Clear favouritive', 'hsktalents'),
        ),
        'share_favouritive_text' => array(
            'value' => __('Share favouritive', 'hsktalents'),
        ),
        'print_favouritive_text' => array(
            'value' => __('Print favouritive', 'hsktalents'),
        ), 

        'disable_clear_favouritive' => array(
            'value' => '',
        ),
        'disable_email_favouritive' => array(
            'value' => '',
        ),
        'disable_print_favouritive' => array(
            'value' => '',
        ),

        'favourite_buttons_bg_color' => array(
            'value' => '#fcfcfc',
        ),
        'favourite_buttons_color' => array(
            'value' => '#353535',
        ),

        'favourite_buttons_hover_color' => array(
            'value' => '#d22a78',
        ),



        'title' =>__('Favourite (Shortlist) Section', 'hsktalents')
    ),
    /**
     * Color Section Settings
     */
    'search_color' => array(
        'disable_search' => array(
            'value' => '',
        ),
        'search_form_bg_color' => array(
            'value' => '#242730',
        ),
        'search_form_fields_border_color' => array(
            'value' => '#f2f3ee',
        ),
        'search_form_fields_color' => array(
            'value' => '#404040',
        ),
        'search_form_button_bg_color' => array(
            'value' => '#d22978',
        ),
        'search_form_button_color' => array(
            'value' => '#fff',
        ),
        'search_form_label_color' => array(
            'value' => '#fff',
        ),
        'search_button_text' => array(
            'value' => __('Search', 'hsktalents'),
        ),
        'title' => __('Search Section', 'hsktalents'),
    ),
    /**
     * Color Section Settings
     */
    'colors' => array(
        'talent_details_bg_color' => array(
            'value' => '#242730',
        ),
        'talent_details_color' => array(
            'value' => '#fff',
        ),
        'talent_title_color' => array(
            'value' => '#353535',
        ),
        'talent_favourite_active_icon_color' => array(
            'value' => '#d22a78',
        ),
        'talent_titlebar_bg_color' => array(
            'value' => '#242730',
        ),
        'talent_titlebar_img_left_border_color' => array(
            'value' => '#fff',
        ),
        'talent_titlebar_title_color' => array(
            'value' => '#fff',
        ),
        'talent_titlebar_content_color' => array(
            'value' => '#999',
        ),

        'talent_titlebar_rating_color' => array(
            'value' => '#555863',
        ),
        'talent_favarative_button_bg_color' => array(
            'value' => '#555863',
        ),
        'talent_favarative_button_color' => array(
            'value' => '#fff',
        ),
        'talent_following_button_bg_color' => array(
            'value' => '#d22a78',
        ),
        'talent_following_button_color' => array(
            'value' => '#242730',
        ),
        'talent_enquiery_button_bg_color' => array(
            'value' => '#353535',
        ),
        'talent_enquiery_button_color' => array(
            'value' => '#fff',
        ),
        'talent_enquiery_button_color' => array(
            'value' => '#fff',
        ),
        'talent_share_button_bg_color' => array(
            'value' => '#353535',
        ),
        'talent_share_button_color' => array(
            'value' => '#fff',
        ),

        'talent_left_section_title_bg_color' => array(
            'value' => '#d22a78',
        ),
        'talent_left_section_title_color' => array(
            'value' => '#fff',
        ),
        'talent_left_section_content_bg_color' => array(
            'value' => '#f5f5f5',
        ),
        'talent_left_section_content_color' => array(
            'value' => '#555',
        ),
        'talent_left_section_content_link_color' => array(
            'value' => '#555',
        ),
        'talent_left_section_content_link_hover_color' => array(
            'value' => '#353535',
        ),
        'talent_left_section_rating_color' => array(
            'value' => '#555',
        ),


        'talent_right_section_tabs_bg_color' => array(
            'value' => '#d22a78',
        ),
        'talent_right_section_tabs_color' => array(
            'value' => '#555',
        ),
        'talent_right_section_tabs_active_bg_color' => array(
            'value' => '#d22a78',
        ),
        'talent_right_section_tabs_active_link_color' => array(
            'value' => '#fff',
        ),

        'title' => __('Colors', 'hsktalents'),
    ),
);
function hsk_talents_admin_init() {
    global $talents_page_tabs_data;
    $settings = get_option( "ss_talents" );
    if ( empty( $settings ) ) {
        $settings = array(
            'reg_page_link' => '',
        );
        add_option( "ss_talents", $settings, '', 'yes' );
    }   
}

function hsk_talents_settings_page_init() {
    $settings_page = add_menu_page(__(' Hsk Talents', 'hsktalents'), __('Hsk Talents', 'hsktalents'), 'edit_theme_options', 'ss-talents', 'hsk_talents_settings_page' );
    add_action( "load-{$settings_page}", 'hsk_talents_load_settings_page' );
}

function hsk_talents_load_settings_page() {
    if ( ( isset($_POST["ss-talents-settings-submit"]) && $_POST["ss-talents-settings-submit"] ) == 'Y' ) {
        check_admin_referer( "ss-talents-settings-page" );
        hsk_talents_save_settings();
        $url_parameters = isset($_GET['tab'])? 'updated=true&tab='.$_GET['tab'] : 'updated=true';
        wp_redirect(admin_url('admin.php?page=ss-talents&'.$url_parameters));
        exit;
    }
}

function hsk_talents_save_settings() {
    global $pagenow, $talents_page_tabs_data;
    $settings = get_option( "ss_talents" );
    
    if ( $pagenow == 'admin.php' && $_GET['page'] == 'ss-talents' ){ 
        if ( isset ( $_GET['tab'] ) )
            $tab = $_GET['tab']; 
        else
            $tab = 'general'; 

            foreach ($talents_page_tabs_data as $key => $talents_page_id) {
                foreach ($talents_page_id as $ids => $talents_id) {
                        if( $tab == $key  ){
                             $settings[$ids]  = $_POST[$ids] ? $_POST[$ids] : $talents_id['value'];
                        }
                    }  
            }
    }
    
    $updated = update_option( "ss_talents", $settings );
}

function hsk_talents_admin_tabs( $current = 'general' ) {
    global $talents_page_tabs_data;
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
      foreach ($talents_page_tabs_data as $key => $talents_page_id) {
            $class = ( $key == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=ss-talents&tab=$key'>".$talents_page_id['title']."</a>";
        }
    echo '</h2>';
}

function hsk_talents_settings_page() {
    global $pagenow;
    $settings = get_option( "ss_talents" );  ?>
    <div class="wrap hsk-talent-options-wrapper">
        <h2><?php _e('HSK Talents Options Page Settings', 'hsktalents'); ?></h2>        
        <?php
            if ( 'true' == ( isset( $_GET['updated']) && esc_attr( $_GET['updated'] )) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>';            
            if ( isset ( $_GET['tab'] ) ) hsk_talents_admin_tabs($_GET['tab']); else hsk_talents_admin_tabs('general');
        ?>
        <div id="poststuff">
            <form method="post" action="<?php admin_url( 'admin.php?page=ss-talents' ); ?>">
                <?php  wp_nonce_field( "ss-talents-settings-page" );                 
                if ( $pagenow == 'admin.php' && $_GET['page'] == 'ss-talents' ){                 
                    if ( isset ( $_GET['tab'] ) ) $active_tab = $_GET['tab']; 
                    else $active_tab = 'general';                     
                    
                    if($active_tab == 'general') {
                        include_once 'talents-menu-options/general-settings.php';
                    }
                    if($active_tab == 'reg_login') {
                        include_once 'talents-menu-options/registration-login-fields.php';
                    }
                    if($active_tab == 'talents_settings') {
                        include_once 'talents-menu-options/talent-settings.php';
                    }
                    if($active_tab == 'favourite_page') {
                        include_once 'talents-menu-options/favourite-settings.php';
                    }
                    if($active_tab == 'colors') {
                        include_once 'talents-menu-options/color-settings.php'; 
                    }
                    if($active_tab == 'search_color') {
                        include_once 'talents-menu-options/search-form-colors.php'; 
                    }
                }
                ?>
                <p class="submit" style="clear: both;">
                    <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
                    <input type="hidden" name="ss-talents-settings-submit" value="Y" />
                </p>
            </form>
        </div>

    </div>
<?php
}


?>