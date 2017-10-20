<?php
function hideAdminBar() { ?>
<style type="text/css">.show-admin-bar { display: none; }</style>
<?php }
//add_action('admin_print_scripts-profile.php', 'hideAdminBar');

function hsk_talents_hide_admin_bar_links() {
    global $wp_admin_bar;
    //Remove WordPress Logo Menu Items
    $wp_admin_bar->remove_menu('wp-logo'); // Removes WP Logo and submenus completely, to remove individual items, use the below mentioned codes
    $wp_admin_bar->remove_menu('about'); // 'About WordPress'
    $wp_admin_bar->remove_menu('wporg'); // 'WordPress.org'
    $wp_admin_bar->remove_menu('documentation'); // 'Documentation'
    $wp_admin_bar->remove_menu('support-forums'); // 'Support Forums'
    $wp_admin_bar->remove_menu('feedback'); // 'Feedback'

    //Remove Site Name Items
    $wp_admin_bar->remove_menu('site-name'); // Removes Site Name and submenus completely, To remove individual items, use the below mentioned codes
    $wp_admin_bar->remove_menu('view-site'); // 'Visit Site'
    $wp_admin_bar->remove_menu('dashboard'); // 'Dashboard'
    $wp_admin_bar->remove_menu('themes'); // 'Themes'
    $wp_admin_bar->remove_menu('widgets'); // 'Widgets'
    $wp_admin_bar->remove_menu('menus'); // 'Menus'

    // Remove Comments Bubble
    $wp_admin_bar->remove_menu('comments');

    //Remove Update Link if theme/plugin/core updates are available
    $wp_admin_bar->remove_menu('updates');

    //Remove '+ New' Menu Items
    $wp_admin_bar->remove_menu('new-content'); // Removes '+ New' and submenus completely, to remove individual items, use the below mentioned codes
    $wp_admin_bar->remove_menu('new-post'); // 'Post' Link
    $wp_admin_bar->remove_menu('new-media'); // 'Media' Link
    $wp_admin_bar->remove_menu('new-link'); // 'Link' Link
    $wp_admin_bar->remove_menu('new-page'); // 'Page' Link
    $wp_admin_bar->remove_menu('new-user'); // 'User' Link

    // Remove 'Howdy, username' Menu Items
    $wp_admin_bar->remove_menu('user-info'); // 'username'
    $wp_admin_bar->remove_menu('edit-profile'); // 'Edit My Profile'
    $wp_admin_bar->remove_menu('logout'); // 'Log Out'

}
if( !current_user_can('administrator')){
    add_action( 'wp_before_admin_bar_render', 'hsk_talents_hide_admin_bar_links' );
}


function hsk_talents_admin_bar_logout( $wp_admin_bar ) {
    if ( is_user_logged_in() ) {
        $wp_admin_bar->add_menu(
            array(
                'id'     => 'hsk-top-admin-loggout',
                'parent' => 'top-secondary',
                'title'  => __( 'Log out', 'hsktalents' ),
                'href'   => wp_logout_url(),
            )
        );
        $wp_admin_bar->add_menu(
            array(
                'id'     => 'hsk-top-admin-profile',
                'parent' => 'top-secondary',
                'title'  => __( 'Profile', 'hsktalents' ),
                'href'   => '<span class="dashicons dashicons-admin-users"> </span> '.get_edit_profile_url( get_current_user_id() ),
            )
        );
        $wp_admin_bar->add_menu(
            array(
                'id'     => 'hsk-top-admin-view-site',
               // 'parent' => 'top-secondary',
                'title'  => __( 'Visit Site', 'hsktalents' ),
                'href'   => esc_url( home_url('/') ),
            )
        );
    }
}
if(!current_user_can('administrator')){
    add_action( 'admin_bar_menu', 'hsk_talents_admin_bar_logout', 1 );
}

/**
* Admin Dashboard settings based on user role permission
*/
class HSK_Admin_User_Role_Permissions
{    
    function __construct()
    {
        // Show only posts and media related to logged in author
        add_action('pre_get_posts', array(&$this,'hsk_user_roles_upload_access') );
        add_action('wp_dashboard_setup', array(&$this,'hsk_user_roles_dashboard_widgets'));
        add_filter( 'admin_bar_menu', array(&$this, 'hsk_talents_change_admin_howdy_text'),25 );  
        add_action('wp_dashboard_setup', array(&$this,'hsk_remove_activity_dashboard_widget' ));
        add_action('publish_post',array(&$this, 'hsk_talent_send_author_email_when_published'));
        //add_action( 'admin_head',  array(&$this,'hsk_disable_all_user_nification', 1 ));
        if( is_admin() && !current_user_can('edit_others_posts') ) { // Removed Admin Profiel Color Picker
            remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker');
        }
        add_action('after_setup_theme', array($this, 'hsk_remove_admin_bar'));
        // Remove admin bar option from profile page
        if (!current_user_can('administrator') && is_admin()) {
            add_filter('show_admin_bar', '__return_false');
        }
    }

    /**
    * Remove Admin bar from front end user only not to the admin
    */
    function hsk_remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
    /** 
     * Replace Howdy, admin
     */  
    function hsk_talents_change_admin_howdy_text( $wp_admin_bar ) {  
        $my_account=$wp_admin_bar->get_node('my-account');  
        $newtitle = str_replace( 'Howdy,', 'Logged in as', $my_account->title );              
        $wp_admin_bar->add_node( array(  
            'id' => 'my-account',  
            'title' => $newtitle,  
        ) );  
    } 
    /**
     *  Show only posts and media related to logged in author
     */
    function hsk_user_roles_upload_access($wp_query){
        global $current_user;
        if( is_admin() && !current_user_can('edit_others_posts') ) {
            $wp_query->set( 'author', $current_user->ID );
            add_filter('views_edit-talent', array(&$this,'hsk_user_roles_post_counts'));
        }
    }

    /** 
     * Remove dashboard items
     */      
    function hsk_user_roles_dashboard_widgets() {  
        global $wp_meta_boxes;  
        $user = wp_get_current_user();
        $allowed_roles = array('editor', 'administrator', 'author');
        if( array_intersect($allowed_roles, $user->roles ) ) { }
        else{    
            //Right Now - Comments, Posts, Pages at a glance  
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);  
            //Recent Comments  
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);  
            //Incoming Links  
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  
            //Plugins - Popular, New and Recently updated WordPress Plugins  
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);          
            //Wordpress Development Blog Feed  
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);  
            //Other WordPress News Feed  
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);  
            //Quick Press Form  
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);  
            //Recent Drafts List  
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_activity']);
        }
    }
    function hsk_remove_activity_dashboard_widget() {
        remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
    }
    /**
    * Disable All notification extra data
    */
    function hsk_disable_all_user_nification()
    {
        if (!current_user_can('update_core')) {
            remove_action( 'admin_notices', 'update_nag', 3 );
        }
    }

    /**
     * Notify author when post has been published
     */
    function hsk_talent_send_author_email_when_published($post_id){  
        // get the post's author ID  
        $post_author_id = get_post_field( 'post_author', $post_id ); 
        //get e-mail address from post meta field using our post_author_id 
        $email_address = get_the_author_meta('user_email', $post_author_id);      
        $subject = __('Your post has been published.', 'hsktalents'); 
        $body = __('Thank you for your submission!', 'hsktalents');      
        wp_mail($email_address, $subject, $body); 
    }
// End Class
}
new HSK_Admin_User_Role_Permissions();

/**
 * Add Talent Category Upload Images
 */
if ( ! class_exists( 'HSK_Talent_Cat_Upload_Image' ) ) {
    class HSK_Talent_Cat_Upload_Image {
        public function __construct() {
        }
     
        /*
         * Initialize the class and start calling our hooks and filters
         * @since 1.0.0
         */
        public function init() {
            add_action( 'talent_cat_add_form_fields', array ( $this, 'hsk_talent_cat_form_fields' ), 10, 2 );
            add_action( 'created_talent_cat', array ( $this, 'hsk_talent_save_category_image' ), 10, 2 );
            add_action( 'talent_cat_edit_form_fields', array ( $this, 'hsk_talent_update_cat_image' ), 10, 2 );
            add_action( 'edited_talent_cat', array ( $this, 'hsk_updated_category_image' ), 10, 2 );
        }
     
        /*
         * Add a form field in the new category page
         * @since 1.0.0
         */
        public function hsk_talent_cat_form_fields ( $taxonomy ) { ?>
            <div class="form-field term-group">
                <label for="hsk-talent-cat-img-id"><?php _e('Upload Image', 'hsktalents'); ?></label>
                <input type="hidden" id="hsk-talent-cat-img-id" name="hsk-talent-cat-img-id" class="custom_media_url" value="">
                <div id="hsk-talent-cat-image-wrapper">
                    <img class="custom_media_image" src="" style="display:none; margin:0;padding:0;max-height:100px;float:none;" />
                </div>
                <p>
                    <input type="button" class="button button-secondary hsk_talent_cat_media_button" id="hsk_talent_cat_media_button" name="hsk_talent_cat_media_button" value="<?php _e( 'Upload Category Image', 'hsktalents' ); ?>" />
                    <input type="button" class="button button-secondary hsk_talent_cat_media_remove" id="hsk_talent_cat_media_remove" name="hsk_talent_cat_media_remove" value="<?php _e( 'Remove Image', 'hsktalents' ); ?>" />
                </p>
            </div>
            <?php
        }
     
        /*
         * Save the lent category talent form field
         * @since 1.0.0
         */
        public function hsk_talent_save_category_image ( $term_id, $tt_id ) {
           if( isset( $_POST['hsk-talent-cat-img-id'] ) && '' !== $_POST['hsk-talent-cat-img-id'] ){
             $image = $_POST['hsk-talent-cat-img-id'];
             add_term_meta( $term_id, 'hsk-talent-cat-img-id', $image, true );
           }
         }
     
        /*
         * Edit the form field
         * @since 1.0.0
         */
        public function hsk_talent_update_cat_image ( $term, $taxonomy ) { ?>
            <tr class="form-field term-group-wrap">
                <th scope="row"><label for="hsk-talent-cat-img-id"><?php _e( 'Image', 'hsktalents' ); ?></label></th>
                <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'hsk-talent-cat-img-id', true ); ?>
                    <input type="hidden" id="hsk-talent-cat-img-id" name="hsk-talent-cat-img-id" value="<?php echo $image_id; ?>">
                    <div id="hsk-talent-cat-image-wrapper">
                        <?php if ( $image_id ) { ?>
                        <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary hsk_talent_cat_media_button" id="hsk_talent_cat_media_button" name="hsk_talent_cat_media_button" value="<?php _e( 'Add Image', 'hsktalents' ); ?>" />
                        <input type="button" class="button button-secondary hsk_talent_cat_media_remove" id="hsk_talent_cat_media_remove" name="hsk_talent_cat_media_remove" value="<?php _e( 'Remove Image', 'hsktalents' ); ?>" />
                    </p>
                </td>
            </tr>
        <?php
        }

        /*
         * Update the form field value
         * @since 1.0.0
         */
        public function hsk_updated_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['hsk-talent-cat-img-id'] ) && '' !== $_POST['hsk-talent-cat-img-id'] ){
                $image = $_POST['hsk-talent-cat-img-id'];
                update_term_meta ( $term_id, 'hsk-talent-cat-img-id', $image );
            } else {
                update_term_meta ( $term_id, 'hsk-talent-cat-img-id', '' );
            }
        }
    }
    $talent_cat_image = new HSK_Talent_Cat_Upload_Image();
    $talent_cat_image->init();
}
?>