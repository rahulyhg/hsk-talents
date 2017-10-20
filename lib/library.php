<?php
if(isset($_SESSION)){
    session_start();
}
/**
 * Get the all talents options data from "SS Talents" page options
 */
function hsk_talents_opt_data($options_name, $default_opt_data=''){
    global$hsk_talents_opt_data;
    $hsk_talents_opt_data = (object) get_option('ss_talents');
    return !empty($hsk_talents_opt_data->{$options_name}) ? trim($hsk_talents_opt_data->{$options_name}) : trim($default_opt_data);
}
global $hsk_talents_opt_data;

/**
 * Get current page URL
 */
function hsk_current_page(){
    global $wp;
    return home_url(add_query_arg(array(),$wp->request));
}
/**
 * Get All User Roles
 */
function hsk_get_all_roles(){
    global $wp_roles;
    return $roles = $wp_roles->get_names();
}
/**
 * Get User dashbord header top or where you want
 */
function hsk_get_user_dashboard(){
    echo '<ul>';
        do_action('header_top_right_menu');
        $signup_id = hsk_get_id_by_slug('register');
        $signin_id = hsk_get_id_by_slug('login');
        $profile_id = hsk_get_id_by_slug('my-profile');
        if( is_user_logged_in() ){
            do_action('user_loggedin_menu');
            echo '<li><i class="fa fa-user"></i> '. hsk_user_name().'</li>';
            echo '<li><a href="'.esc_url(admin_url('index.php')).'"><i class="fa fa-dashboard"></i> '.esc_html__(' Dashboard', 'hsktalents').'</a></li>';
            if(!empty(hsk_talents_opt_data('profile_page_link', $profile_id))){
                echo '<li><a href="'.get_the_permalink(hsk_talents_opt_data('profile_page_link', $profile_id)).'"><i class="fa fa-edit"></i> '. get_the_title(hsk_talents_opt_data('profile_page_link', $profile_id)).'</a>';
            }
            echo '<li>'.hsk_logout().'</li>';
        }else{
             do_action('user_non_loggedin_menu');
            if(!empty(hsk_talents_opt_data('reg_page_link', $signup_id) ) ){ 
                echo '<li><a href="'.get_the_permalink(hsk_talents_opt_data('reg_page_link', $signup_id)).'"><i class="fa fa-user"></i> '.get_the_title(hsk_talents_opt_data('reg_page_link', $signup_id)).'</a></li>';
            }
            if(!empty(hsk_talents_opt_data('login_page_link', $signin_id))){
                echo '<li><a href="'.get_the_permalink(hsk_talents_opt_data('login_page_link', $signin_id)).'"><i class="fa fa-sign-in"></i> '.get_the_title(hsk_talents_opt_data('login_page_link', $signin_id)).'</a></li>';
            }
        }
    echo '</ul>';
}
/**
 * Shortlist icons
 * @param ( string ) $icon_name
 */
function hsk_favarative_icons($add_icon="fa-heart",$remove_icon="fa-heart"){
    $talent_status = get_post_meta(get_the_ID(), 'hsk_talent_status', true);
    if( hsk_talents_opt_data('disable_favourite_section') != '1' ){
        if( $talent_status == 'talent_available' ){
            echo '<a href="#" title="'.esc_html__('Add to favourite', 'hsktalents').'" class="talent-add-favourite favourite-item-type" data-item-action="add"><i class="fa '.esc_attr($add_icon).'"></i></a>';
            echo '<a href="#" title="'.esc_html__('Remove to favourite', 'hsktalents').'" class="talent-remove-favourite favourite-item-type" data-item-action="remove"><i class="fa '.esc_attr($remove_icon).'"></i></a>';
        }else{
            echo '<span title="'.esc_html__('Out Of Station', 'hsktalents').'" class="talent-add-favourite"><i class="fa fa-plane"></i></span>';
        }
    }
}
/**
 * Shortlist text add in header section or menu section
 */
function hsk_get_favourite_page(){
    $page_id = hsk_get_id_by_slug('favourite');
    if( (hsk_talents_opt_data('disable_favourite_section') != '1') && !empty(hsk_talents_opt_data('favourite_page_link', $page_id))){
        return '<a href="'.get_the_permalink(hsk_talents_opt_data('favourite_page_link', $page_id)).'"><i class="fa fa-bookmark"></i> '. get_the_title(hsk_talents_opt_data('favourite_page_link',$page_id )).'<span class="favouritive-items-count">0</span></a> ';
    }
}

/**
 * Post title
 * @param ( string ) $heading_tag
 */
function hsk_post_title($heading_tag="h5"){
    return '<'.$heading_tag.'><a href="'.get_the_permalink().'">'.get_the_title().'</a></'.$heading_tag.'>';
}

/**
 * Get anchor tag of cureent post link
 * @param $post_id
 * @param $classes
 *        -- for creating any styles of link
 */
function hsk_post_link_open($post_id, $classes=''){
    return '<a href="'.get_the_permalink($post_id).'" title="'.get_the_title($post_id).'" class="'.$classes.'">';
}
function hsk_post_link_close(){
    return '</a>';
}
/**
 * Generate User ID
 */
function hsk_talent_profile_id(){
    $prefix = '';
    return $prefix.substr(uniqid(mt_rand(100000,999999), true), 0, 4); 
    //return get_post_meta(get_the_ID(), 'talent_unique_id', )
}
/**
 * Talent Image Content( desceription, information)
 */
function hsk_get_talent_content($width="500", $height="500"){
    $post_id = get_the_ID();
    echo '<li>';
        echo hsk_post_link_open($post_id);
            echo hsk_post_image($post_id, $width, $height);
        echo hsk_post_link_close();
        echo '<div class="talent-info-wrapper">';
            echo '<h5>'.get_the_title().'</h5>';
            echo hsk_meta_opt_data($post_id);
        echo '</div>';
    echo '</li>';
}
/**
 * Get Author Details
 */
function hsk_get_user_info(){
    global $current_user, $hsk_user_info;
    $hsk_user_info = wp_get_current_user();
    return !empty($hsk_user_info) ? $hsk_user_info : NULL;
}
hsk_get_user_info();
/**
 * Get Current User role
 */
function hsk_current_user_role(){
    global $hsk_user_info, $current_user_role;
    $user_id = $hsk_user_info->ID;
    $user = new WP_User( $user_id );
    if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
        foreach ( $user->roles as $role )
            return $current_user_role = $role;
    }
}    
hsk_current_user_role();
/**
 * Get Logout Link
 */
function hsk_logout(){
    global $hsk_user_info;
    return '<a href="'.wp_logout_url( get_permalink(hsk_talents_opt_data('logout_page_link')) ).'"><i class="fa fa-sign-out"></i> '.esc_attr(hsk_talents_opt_data('logout_button_text', esc_html__('Logout', 'hsktalents'))).'</a> ';
}
/**
 * Get Logout Link
 */
function hsk_user_name(){
    global $hsk_user_info;
    return esc_html__('Hi', 'hsktalents').' '.ucwords(esc_html($hsk_user_info->user_login));
}
/**
 * Get Current User ID
 */
function hsk_user_id(){
    global $hsk_user_info, $hsk_user_id;
    return $hsk_user_id = !empty($hsk_user_info->data->ID) ? esc_html($hsk_user_info->data->ID) : NULL;
}
hsk_user_id();

/**
 * Featured Talent Ribbon Image
 */
function hsk_talent_featured_ribbon_img($post_id){
    if( get_post_meta($post_id, 'featured-talent', true)  == 'yes'){
        return '<span class="hsk-featured-img">'.esc_html__('Featured', 'hsktalents').'</span>';
    }
}

/**
 * Get Talents Page title bar image
 * @param $post_id
 */
function hsk_talent_title_image($post_id, $img_width="150", $img_height="150"){
    if( hsk_talents_opt_data('disable_titlebar_talent_img', '0') != '1' ){
        echo '<div class="avathar">';
            echo hsk_talent_featured_ribbon_img($post_id);
            $thumb = get_the_post_thumbnail_url(esc_attr($post_id));
            if( !empty($thumb) ){
                echo '<img class="wp-post-image" alt="'.get_the_title().'" src="'.hsk_image_crop($thumb, $img_width, $img_height, true, 'tc', false).'" title="'.get_the_title().'">';
            }else{
                echo hsk_talent_placeholder($img_width, $img_height);
            }
        echo '</div>';
    }
}
/**
 * Talent Following and Follow talents
 */
function hsk_follow_talents(){
     global $wpdb;
    $post_id = $_POST['post_id'];
    $post_author_id = $_POST['post_author_id'];
    $follow_user_id = $_POST['follow_user_id'];
    $data_insert = $wpdb->prepare("
        INSERT INTO ".$wpdb->prefix . 'hsk_following'." (follow_postid, followers_user_id, following_user_id)
            VALUES ( %s, %s, %s)", $post_id, $follow_user_id, $post_author_id );
  //echo $wpdb->insert_id;
  if( false === $wpdb->query($data_insert) ){

    echo ''.esc_html__('Faild to inserted', 'hsktalents');
  }else{
    echo ' '.esc_html__('sucessfully inserted', 'hsktalents');
  }
  die();
}
add_action('wp_ajax_hsk_follow_talents', 'hsk_follow_talents');
add_action('wp_ajax_nopriv_hsk_follow_talents', 'hsk_follow_talents');
/**
 * check follow user info
 */
function hsk_follow_post_check($post_id){
    global $wpdb, $hsk_user_id;
    if( !empty($hsk_user_id) && is_user_logged_in() ){
        $get_data = $wpdb->get_results( "SELECT * FROM  ".$wpdb->prefix . 'hsk_following'." WHERE follow_postid = $post_id AND followers_user_id = $hsk_user_id" );
        if( $get_data ){
            return 'true';
        }else{
           return 'false';
        }
    }
}
/**
 * Get all followers  IDs
 */
function hsk_talent_followers_ids($post_id, $limit='4'){
    global $wpdb, $hsk_user_id, $hsk_followers_ids;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $hsk_follwers = $wpdb->get_results( "SELECT * FROM  ".$wpdb->prefix . 'hsk_following'." WHERE follow_postid = $post_id limit $limit" );
        foreach ($hsk_follwers as $key => $hsk_follwer) {
            $hsk_followers_ids[] = $hsk_follwer->followers_user_id;            
        }
        return $hsk_followers_ids;
    //}
}
/**
 * Get all followers Avthars 
 */
function hsk_talent_followers($post_id, $limit='4'){
    global $hsk_followers;
    $hsk_followers = hsk_talent_followers_ids($post_id);
    if( !empty($hsk_followers) ){
        echo '<ul class="hsk-post-followers">';
        foreach (array_unique($hsk_followers) as $key => $hsk_follower) {
            echo '<li>'.get_avatar($hsk_follower).'</li>';
        }
        echo '</ul>';
        if( $limit < 5 ){
            echo '<a class="talent-follow-more" href="'.hsk_current_page().'?rating_more=true">'.esc_html__("View More", 'hsktalents').'</a>';
        } 
    }
}
/**
 * Get all followers Avthars list
 */
function hsk_talent_get_followers_info($post_id){
    global $hsk_user_info;
    //print_r($hsk_user_info);
    $hsk_followers = hsk_talent_followers_ids($post_id);
    if( !empty($hsk_followers) ){
        echo '<ul class="hsk-post-followers-info hsk-extra-width">';
        foreach (array_unique($hsk_followers) as $key => $hsk_follower) {
            echo '<li class="hsk-column-6">';
                echo '<div class="user-avathar">';
                    echo get_avatar($hsk_follower);
                echo '</div>';
                echo '<div class="hsk-follow-info">';
                    echo '<div><strong>'.esc_html__('Name', 'hsktalents').': </strong><span>'.$hsk_user_info->display_name.'</span></div>';
                    echo '<div><strong>'.esc_html__('Role', 'hsktalents').': </strong><span>'.$hsk_user_info->roles[0].'</span></div>';
                echo '</div>';
            echo '</li>';
        }
        echo '</ul>';
    }else{
        echo esc_html__('Be the first follower to this talent, please click to the ', 'hsktalents').'<a href="#hsk-talent-follow">'.esc_html__('follow', 'hsktalents').'</a>';
    }
}
/**
 * Get users following post count
 */
function hsk_follow_post_count($post_id){
    global $wpdb, $hsk_user_id;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $get_data = $wpdb->get_var( "SELECT COUNT(follow_postid) as follow_count FROM  ".$wpdb->prefix . 'hsk_following'." WHERE follow_postid=$post_id" );
        return $get_data;
    //}
}
/**
 * Talents rating 
 */
function hsk_talents_rating(){
    $post_id = get_the_ID();
    if( hsk_user_rating_check($post_id) ){
        return hsk_talent_star_rating($post_id).'<span class="avg-rating-count">('.hsk_talent_rating($post_id).')</span>';
    }else{
        if( is_user_logged_in()){
            $id="hsk-user-rating";
        }else{
            $id="hsk-non-user-logged-in";
        }
       return '<a href="#reviews" class="stars " id="'.$id.'">'.hsk_talent_star_rating($post_id).'<span class="avg-rating-count">('.hsk_talent_rating($post_id).')</span></a>'; 
    }
    
}
/**
 * Talents page title bar buttons
 * Talents voting button
 * Talents Follow Button
 * Talent Enquairy Button
 * Talents Share Button
 */
function hak_talent_profile_buttons(){
    global $post, $hsk_user_info;
    $check_followers = hsk_follow_post_check($post->ID);
    if( is_user_logged_in() ){
        $id = 'hsk-talent-follow';
    }else{
        $id = 'hsk-non-user-logged-in';
    }
    if(isset($_SESSION['favouritive'])) {
        if ( in_array($post->ID, $_SESSION['favouritive']) ) {
            $item_added = 'item_added';
        }else{ $item_added = '';}
    }else{
        $item_added = '';
    }
    echo '<ul class="talent-button-info '.$item_added.'" id="'.$post->ID.'">';
        // Favourite Button Remove
        if( hsk_talents_opt_data('disable_favourite_section') != '1' ){
            if( hsk_talents_opt_data('disable_talents_favourite_button', '0') != '1' ){
                echo '<li>';
                    echo '<a title="'.hsk_talents_opt_data('talent_favarative_button_text', esc_html__('Favourite', 'hsktalents')).'" href="#" class="hsk-talent-favarative  hsk-talent-add-favarative hsk-page-title-button" data-item-action="add"><i class="fa fa-heart"> </i> '. hsk_talents_opt_data('talent_favarative_button_text', esc_html__('Favourite', 'hsktalents')).'</a>'; // Add Favouritive
                    echo '<a title="'.hsk_talents_opt_data('talent_favarative_button_text', esc_html__('Remove', 'hsktalents')).'" href="#" class="hsk-talent-favarative hsk-talent-remove-favarative hsk-page-title-button" data-item-action="remove"><i class="fa fa-heart"> </i> '. esc_html__('Remove', 'hsktalents').'</a>';  // Remove Favouritive
                echo '</li>';
            }
        }
        if( hsk_talents_opt_data('disable_talents_followers', '0') != '1' ){
            if( $check_followers == 'true' ){
                echo '<li><div class="hsk-talent-followed" style=""><i class="fa fa-plus"></i> '.hsk_talents_opt_data('talent_following_button_text', esc_html__('Followers', 'hsktalents')).'</div></li>';
            }else{
                echo '<li><a title="Follow Me" href="#" class="hsk-talent-follow" id="'.$id.'" data-post-id="'.get_the_ID().'" data-user-id="'.$hsk_user_info->ID.'" data-post-author-id="'.$post->post_author.'" style=""><i class="fa fa-plus"></i> '.hsk_talents_opt_data('talent_following_button_text', esc_html__('Followers', 'hsktalents')).'</a> </li>';
            }
        }
        // Enquiry Button
        if( hsk_talents_opt_data('disable_talents_enquiry', '0') != '1' ){
            echo '<li><a title="'.hsk_talents_opt_data('talent_enquiry_button_text', esc_html__('Enquiry', 'hsktalents')).'" href="#" class="hsk-talent-enquiry"><i class="fa fa-phone"></i> '.hsk_talents_opt_data('talent_enquiry_button_text', esc_html__('Enquiry', 'hsktalents')).'</a></li>';
        }
        echo '<li class="hsk-talent-like icon"><a title="I like this Talent" href="#" class="like"><i class="fa fa-thumbs-up"></i></a></li>';
        // Share Button
        if( hsk_talents_opt_data('disable_talents_social_share', '0') != '1' ){
             echo '<li class="hsk-talent-share-icons"><span class="talent-share" title="'.hsk_talents_opt_data('talent_share_button_text', esc_html__('Share', 'hsktalents')).'"> <i class="fa fa-share-alt-square"> </i> '.hsk_talents_opt_data('talent_share_button_text', esc_html__('Share', 'hsktalents')).'</span>';
            
        }
        echo '</ul>';
        echo '<div class="hsk-talent-social-icons">';
                echo '<span class="close-socila-share-icons">X</span>';
                echo '<ul>';
                    ?>
                    <li><a href="<?php echo esc_url( add_query_arg( array('u' => esc_attr(get_the_permalink()), 't' => esc_attr(get_the_title()) ), '//facebook.com/sharer.php')); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php esc_html_e('Share on Facebook', 'hsktalents'); ?>"> <i class="fa fa-facebook"></i></a></li>
                    <li><!-- Twitter -->
                        <a href="<?php echo esc_url( add_query_arg( array('status' =>esc_attr(get_the_title()).' - '.esc_attr(get_the_permalink())), '//twitter.com/home/')); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php esc_html_e('Tweet this!','hsktalents'); ?>">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li><!-- Google plus -->
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li><!-- Linked in -->
                        <a href="<?php echo esc_url( add_query_arg( array('mini'=> 'true', 'title' => esc_attr(get_the_title()) , 'url' =>esc_attr(get_the_permalink())), '//linkedin.com/shareArticle')); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php esc_html_e('Share on LinkedIn','hsktalents'); ?>">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li><!-- Pinterest -->
                        <a href="<?php echo esc_url( add_query_arg( array('url' =>esc_attr(get_the_permalink()),'media' => wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ) ), '//pinterest.com/pin/create/button')); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                    <li><!-- StumbleUpon -->
                        <a href="<?php echo esc_url( add_query_arg( array('url' =>esc_attr(get_the_permalink()), 'title' => esc_attr(get_the_title()) ), '//stumbleupon.com/submit')); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php esc_html_e('Stumble it','hsktalents'); ?>">
                            <i class="fa fa-stumbleupon"></i>
                        </a>
                   </li>
                   <li><!-- Digg -->
                        <a href="<?php echo esc_url( add_query_arg( array('url' =>esc_attr(get_the_permalink()), 'title' => esc_attr(get_the_title()) ), '//digg.com/submit')); ?>"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" title="<?php esc_html_e('Digg this!','hsktalents'); ?>">
                            <i class="fa fa-digg"></i>
                        </a>
                    </li>
                    <?php
                echo '</ul>';
            echo '</div>';
}
/**
 * Talents likes & views
 */
function hsk_talents_likes_views(){
   echo '<ul>';

        //echo '<li>'.esc_html__('Likes', 'hsktalents').' <span class="stat like_count-204870">7139</span></li>';

        if(hsk_talents_opt_data('diable_talent_views', '0') != '1'){
            echo '<li>'.hsk_talents_opt_data('talent_views_text', esc_html__('Views ', 'hsktalents')).': <span class="stat">';
            if(function_exists('hsk_talnet_pofile_count')) { 
                echo hsk_talnet_pofile_count(get_the_ID()); 
            }
            echo '</span></li>';
        }
        if(hsk_talents_opt_data('diable_talent_dedication', '0') != '1'){
           // echo '<li>'.hsk_talents_opt_data('talent_dedication_text', esc_html__('Dedication', 'hsktalents')).' <span class="stat">93%</span></li>';
        }
        if(hsk_talents_opt_data('disable_talent_unique_id', '0') != '1'){
            echo '<li>'.hsk_talents_opt_data('talent_account_id_text', esc_html__('Account ID ', 'hsktalents')).': <span class="stat"> '.hsk_talents_opt_data('talent_unique_id_prefix', 'SSTH').''.get_post_meta(get_the_ID(), 'talent_unique_id', true).'</span></li>';
        }
        
        
        echo '<li>'.hsk_talents_opt_data('talent_following_button_text', esc_html__('Followers', 'hsktalents')).' : <span class="hsk-talent-follow-count"><b>'.hsk_follow_post_count(get_the_ID()).'</b></span>';
        echo '<li>'.esc_html__('Last Modified:', 'hsktalents').' <span class="stat">'.get_the_modified_date().'</span></li>';
    echo '</ul>'; 
}
/**
 * Follow icons
 */
function hsk_social_follow_icons(){
    if( hsk_talents_opt_data('disable_follows_on_section', 0) != '1' ){    
        $talent_fbook_id = get_post_meta(get_the_ID(), 'talent_fbook_id', true) ? get_post_meta(get_the_ID(), 'talent_fbook_id', true) : ''; // getting facebook id
        $talent_twitter_id = get_post_meta(get_the_ID(), 'talent_twitter_id', true) ? get_post_meta(get_the_ID(), 'talent_twitter_id', true) : ''; // getting twitter id
        $talent_instagram_id = get_post_meta(get_the_ID(), 'talent_instagram_id', true) ? get_post_meta(get_the_ID(), 'talent_instagram_id', true) : ''; // getting instagram id

        $talent_pinterest_id = get_post_meta(get_the_ID(), 'talent_pinterest_id', true) ? get_post_meta(get_the_ID(), 'talent_pinterest_id', true) : ''; // getting instagram id

        $talent_google_plus_id = get_post_meta(get_the_ID(), 'talent_google_plus_id', true) ? get_post_meta(get_the_ID(), 'talent_google_plus_id', true) : ''; // getting instagram id

        $talent_linkedin_id = get_post_meta(get_the_ID(), 'talent_linkedin_id', true) ? get_post_meta(get_the_ID(), 'talent_linkedin_id', true) : ''; // getting instagram id

        $talent_linkedin_id = get_post_meta(get_the_ID(), 'talent_instagram_id', true) ? get_post_meta(get_the_ID(), 'talent_instagram_id', true) : ''; // getting instagram id

        $talent_youtube_id = get_post_meta(get_the_ID(), 'talent_youtube_id', true) ? get_post_meta(get_the_ID(), 'talent_youtube_id', true) : ''; // getting instagram id

        $talent_flickr_id = get_post_meta(get_the_ID(), 'talent_flickr_id', true) ? get_post_meta(get_the_ID(), 'talent_flickr_id', true) : ''; // getting instagram id
        // Find value empty or not , if empty remove the divs
        if( !empty($talent_fbook_id) || !empty($talent_fbook_id) || !empty($talent_fbook_id) ){
            echo '<div class="hsk-follow-icons hsk-talents-sidebar">';
               echo '<h5>'. hsk_talents_opt_data('change_follows_on_text', esc_html__('Follow Us On', 'hsktalents')).'</h5>';
                echo '<ul>';
                    if( !empty($talent_fbook_id) ){
                        echo '<li><a target="_blank" title="'.esc_html__('Facebook', 'hsktalents').'" href="http://www.facebook.com/'.esc_attr($talent_fbook_id).'"><i class="fa fa-facebook"></i></a></li>';
                    }
                    if( !empty($talent_twitter_id) ){
                        echo '<li><a target="_blank"  title="'.esc_html__('Twitter', 'hsktalents').'" href="http://www.twitter.com/'.esc_attr($talent_twitter_id).'"><i class="fa fa-twitter"></i></a></li>';
                    }
                    if( !empty($talent_instagram_id) ){
                        echo '<li><a target="_blank"  title="'.esc_html__('Instagram', 'hsktalents').'" href="http://www.instagram.com/'.esc_attr($talent_instagram_id).'"><i class="fa fa-instagram"></i></a></li>';
                    }
                    if( !empty($talent_pinterest_id) ){
                        echo '<li><a target="_blank"  title="'.esc_html__('Pinterest', 'hsktalents').'" href="http://www.pinterest.com/'.esc_attr($talent_pinterest_id).'"><i class="fa fa-pinterest"></i></a></li>';
                    }

                    if( !empty($talent_google_plus_id) ){
                        echo '<li><a target="_blank"  title="'.esc_html__('Google Plus', 'hsktalents').'" href="http://www.plus.google.com/'.esc_attr($talent_google_plus_id).'"><i class="fa fa-google-plus"></i></a></li>';
                    }

                    if( !empty($talent_linkedin_id) ){
                        echo '<li><a target="_blank"  title="'.esc_html__('Linked', 'hsktalents').'" href="http://www.linkedin.com/'.esc_attr($talent_linkedin_id).'"><i class="fa fa-linkedin-square"></i></a></li>';
                    }

                    if( !empty($talent_youtube_id) ){
                        echo '<li><a target="_blank" href="http://www.youtube.com/'.esc_attr($talent_youtube_id).'"><i class="fa fa-youtube"></i></a></li>';
                    }
                    if( !empty($talent_flickr_id) ){
                        echo '<li><a target="_blank" href="http://www.flickr.com/'.esc_attr($talent_flickr_id).'"><i class="fa fa-flickr"></i></a></li>';
                    }
                echo '</ul>';
            echo '</div>';
        }
    }
}
/**
 * Get Talent Tags
 * @param post_id
 */
function hsk_talent_tags($post_id){
    if( hsk_talents_opt_data('disable_tags_section', 0) != '1' ){
        echo '<h5 class="hsk-talents-tags">'. hsk_talents_opt_data('disable_tags_section', esc_html__('Tags', 'hsktalents')).'</h5>';
        echo hsk_talent_tags_list($post_id);
    }
}
function hsk_talent_tags_list($post_id){
    return get_the_term_list( $post_id, 'talent_tag', '', ' ', '' );
}
/*
 * Including single page and taxonomy page of talents
 */
add_filter( 'template_include', 'hsk_set_template');
function hsk_set_template( $template ){
	$template_name = '';
	if ( is_single() && (get_post_type() == 'talent')) {
    $templatefilename = 'single-talent.php';
    if (file_exists(locate_template('hsktalents/'.$templatefilename))) {
       $template = locate_template('hsktalents/'.$templatefilename);
    } else {
        $template = HSK_PLUGIN_DIR . '/templates/' . $templatefilename;
    }
}
if ( is_tax('talent_cat') ) {
   $templatefilename = 'taxonomy-talent_cat.php';
    if ( file_exists(locate_template('hsktalents/'.$templatefilename) ) ) {
        $template = locate_template('hsktalents/'.$templatefilename);
    } else {
        $template = HSK_PLUGIN_DIR . 'templates/' . $templatefilename;
    }
}
if ( is_tag('talent_cat') ) {
    return false;
   $templatefilename = 'tag-talent_cat.php';
    if ( file_exists(locate_template('hsktalents/'.$templatefilename) ) ) {
        $template = locate_template('hsktalents/'.$templatefilename);
    } else {
        $template = HSK_PLUGIN_DIR . 'templates/' . $templatefilename;
    }
}

return $template;
}


/**
 * Tracks and Displays the Count of Post Views
 * @param int post_ID
 */
function hsk_talnet_pofile_count($post_ID) {
    $talent_count_id = 'post_views_count'; 
    $count = get_post_meta($post_ID, $talent_count_id, true);
    if($count == ''){
        $count = 0; // set the counter to zero.
        delete_post_meta($post_ID, $talent_count_id);
        add_post_meta($post_ID, $talent_count_id, '0');
        return $count;
    }else{
        $count++; //increment the counter by 1.
        update_post_meta($post_ID, $talent_count_id, $count);
        if($count == '1'){
            return $count;
        }
        else {
            return $count;
        }
    }
}
/**
 * Customize talents profiles
 */
function hsk_include_templates($slug, $name = ''){
    $template = '';    
    if ( ! $template && $name && file_exists( locate_template("hsktalents/{$slug}-{$name}.php") ) ) {
        $template = locate_template( array("hsktalents/{$slug}-{$name}.php" ) );
    }elseif ( ! $template && $name ) {
       $template = HSK_PLUGIN_PATH . "templates/{$slug}-{$name}.php";
    }elseif ( ! $template && empty( $name ) ) {
        $template = locate_template( array( "{$slug}.php", "hsktalents/{$slug}.php" ) );
    }else{ }

    if ( $template ) {
        //echo 'test';
        load_template( $template, false );
    }
   // echo $template;
}
/**
 * Talent Ratins system
 */
function hsk_talent_rating_form(){
    global $wpdb;
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $post_id = $_POST['post_id'];
    $rating_comment = $_POST['rating_comment'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    //Is it a proxy address
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    //The value of $ip at this point would look something like: "192.0.34.166"
    $rating_ip = ip2long($ip);

    $data_insert = $wpdb->prepare("
        INSERT INTO ".$wpdb->prefix . 'hsk_ratings'." (rating_postid, rating_rating, comment, rating_timestamp, rating_ip, rating_userid)
            VALUES ( %s, %s, %s, %s, %s, %s)", $post_id, $rating, $rating_comment, current_time('mysql', 1), $rating_ip, $user_id );
    //echo $wpdb->insert_id;
    if( false === $wpdb->query($data_insert) ){
        echo ''.esc_html__('Faild to add your rating', 'hsktalents');
    }else{
        echo ' '.esc_html__('Thank you for giving me your valuable rating', 'hsktalents');
    }
    die();
}
add_action('wp_ajax_hsk_talent_rating_form', 'hsk_talent_rating_form');
add_action('wp_ajax_nopriv_hsk_talent_rating_form', 'hsk_talent_rating_form');

/**
 * Get current user review or  not
 * @param int $post_id
 */
function hsk_user_rating_check($post_id){
    global $wpdb, $hsk_user_id;
    if( !empty($hsk_user_id) && is_user_logged_in() ){
        $get_data = $wpdb->get_var( "SELECT rating_postid, rating_userid FROM ".$wpdb->prefix . 'hsk_ratings'." WHERE rating_postid=$post_id AND rating_userid = $hsk_user_id" );
        if( $get_data ){
            return true;
        }else{
            return false;
        }

    }
}

/**
 * Getting star rating
 */
function hsk_talent_star_rating($post_id){
    global $wpdb, $hsk_user_id;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $rating_width = '<div class="star-rating" title="'.esc_html__('Rated ', 'hsktalents').' '. hsk_talent_rating($post_id) .'">';
            $rating_width .= '<span class="rating" style="width:'.((hsk_talent_rating($post_id) / 5) * 100).'%"></span>';
        $rating_width .= '</div>';
        return $rating_width;
    //}
}

/**
 * getting current post's rating & review information
 */
function hsk_talent_rating_info($post_id, $limit='3'){
    global $wpdb, $hsk_user_id, $hsk_user_info;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $rating_info = $wpdb->get_results( "SELECT rating_userid, rating_rating, comment FROM ".$wpdb->prefix . 'hsk_ratings'." WHERE rating_postid=$post_id limit $limit" );
        if(!empty($rating_info)){
        echo '<ul class="hsk-talent-rating-content">';
            foreach ($rating_info as $key => $rating) {
                echo '<li>';
                    echo get_avatar($rating->rating_userid);
                    echo '<div class="description">';
                        echo '<strong>'.$hsk_user_info->user_nicename.'</strong>';
                        echo '<div class="star-rating" title="'.esc_html__('Rated ', 'hsktalents').' '. $rating->rating_rating .'">';
                            echo '<span class="rating" style="width:'.(($rating->rating_rating/5) * 100).'%"><strong>'.$rating->rating_rating.'</strong></span>';
                        echo '</div>';
                        echo '<p>'.$rating->comment.'</p>';
                    echo '</div>';
                echo '</li>'; 
            }
        echo '</ul>';
        if( $limit < 4 ){
            echo '<a class="talent-rating-more" href="'.hsk_current_page().'?rating_more=true">'.esc_html__("View More", 'hsktalents').'</a>';
        } 
    }else{
        echo esc_html__('Be the first review to this talent, please click to the ', 'hsktalents').'<a href="#hsk-talent-rating-add">'.esc_html__('Rate this model', 'hsktalents').'</a>';
    }
    //}
}

/**
 * check if rows exist or not
 */
function hsk_talent_check_rating($post_id){
    global $wpdb, $hsk_user_id, $hsk_talent_rating;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $rating_info = $wpdb->get_results( "SELECT rating_userid, rating_rating, comment FROM ".$wpdb->prefix . 'hsk_ratings'." WHERE rating_postid=$post_id" );
        return $rating_info;
    //}
}
/**
 * Post rating count average
 */
function hsk_talent_rating($post_id){
    global $wpdb, $hsk_user_id;
    //if( !empty($hsk_user_id) && is_user_logged_in() ){
        $count_rating = $wpdb->get_var( "SELECT COUNT(rating_rating)  FROM ".$wpdb->prefix . 'hsk_ratings'." WHERE rating_postid=$post_id" );
        $sum_rating = $wpdb->get_var( "SELECT SUM(rating_rating)  FROM ".$wpdb->prefix . 'hsk_ratings'." WHERE rating_postid=$post_id" );
        if( $count_rating > 0 ){
            $total_rating = number_format($sum_rating / $count_rating, 2);
            update_post_meta( $post_id, 'hsk_rating', $total_rating );
            return $total_rating;
        }else{
            add_post_meta( $post_id, 'hsk_rating', '0', true );
            return '0';
        }
        //return number_format($rating_info,2);
    //}
}
/**
 * Talent Enquirey form
 */
function hsk_talent_enquiry(){
    //check_ajax_referer('hsk_ajax_nonce');
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact_num = esc_attr($_POST['contact_num']);
    $description = esc_attr($_POST['description']);
    $hsk_talent_url = esc_attr($_POST['hsk_talent_url']);
    $subject = esc_html__('A messsage from your website\'s contact form','hsktalents');
    $message = '';
    $message .= PHP_EOL.esc_html__('Name', 'hsktalents').': '.$name;
    $message .= PHP_EOL.esc_html__('Email', 'hsktalents').': '.$email;
    $message .= PHP_EOL.esc_html__('Contact Num', 'hsktalents').': '.$contact_num;
    $message .= PHP_EOL.esc_html__('Description', 'hsktalents').': '.$description.'<br />';
    $message .= $hsk_talent_url;
    $to = get_option('admin_email'); // If you like change this email address
    // replace "noreply@yourdomain.com" with your real email address
    $header = 'From: '.get_option('blogname').' <noreply@yourdomain.com>'.PHP_EOL;
    $header .= 'Reply-To: '.$email.PHP_EOL;
    if ( wp_mail($to, $subject, $message, $header) ) {
        echo ''.esc_html__('Thanks, for the message. We will respond as soon as possible.', 'hsktalents');
     } else {
        echo ''.esc_html__('Some errors occurred.','hsktalents');
     }
    die();
}
add_action('wp_ajax_hsk_talent_enquiry', 'hsk_talent_enquiry');
add_action('wp_ajax_nopriv_hsk_talent_enquiry', 'hsk_talent_enquiry');

/**
 * Favouritive Enquirey form
 */
function hsk_favouritives_enquiry(){
    //check_ajax_referer('hsk_ajax_nonce');
    $favourite_ids = esc_attr($_POST['favourite_ids']);
    $fav_ids = !empty($favourite_ids) ? explode(',', $favourite_ids) : '';
    $sender_name = filter_var($_POST['sender_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $sender_email = filter_var($_POST['sender_email'], FILTER_SANITIZE_EMAIL);
    $receiver_email = filter_var($_POST['receiver_email'], FILTER_SANITIZE_EMAIL);
    $receiver_email_desc = esc_attr($_POST['receiver_email_desc']);
    $subject = $sender_name .' - '.esc_html__('Favouritive Talents Information','hsktalents');
    $message = '<html><body>';
    //$message .= $favourite_ids;
    $message .= '<table cellspacing="10" cellpadding="20"><tr>';
    if( !empty($fav_ids) ){
        foreach ($fav_ids as $key => $id) {
            $post_data = get_post($id);
            $message .= '<td>';
                $message .= '<img src="'.hsk_image_crop(get_the_post_thumbnail_url($id), '150', '150').'" alt="'.get_the_title($id).'">';
                $message .= '<h4><a href="'.get_the_permalink($id).'">'.get_the_title($id).'</a></h4>';
            $message .= '</td>';
        }
    }
    $message .= '</tr></table>';
    $message .= PHP_EOL.esc_html__('Description', 'hsktalents').': '.$receiver_email_desc;
    $message .= "</body></html>";

    $to = get_option('admin_email'); // If you like change this email address
    // replace "noreply@yourdomain.com" with your real email address
    $headers = 'From: '.get_option('blogname').' <'.sanitize_email($receiver_email).'>'.PHP_EOL;
    $headers .= 'Reply-To: '.sanitize_email($sender_email).PHP_EOL;
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if ( wp_mail($receiver_email, $subject, $message, $headers) ) {
        echo ''.esc_html__('Your message has been sucessfully sent', 'hsktalents');
     } else {
        echo ''.esc_html__('Some errors occurred. please try again','hsktalents');
     }
    die();
}
add_action('wp_ajax_hsk_favouritives_enquiry', 'hsk_favouritives_enquiry');
add_action('wp_ajax_nopriv_hsk_favouritives_enquiry', 'hsk_favouritives_enquiry');

/**
 * Create ajax function to add / remove favouritive Items
 */
function hsk_add_items_to_favouritive() {
    if(!session_id()) {
        session_start();
    }       
    // Create favouritive items to seesion list
    if(!isset($_SESSION['favouritive'])) {
        $_SESSION['favouritive'] = array();
    }
    $item_action_type = NULL;
    $fav_item_id = 0;
    if ( isset( $_POST['fav_item_id'] ) && !empty( $_POST['fav_item_id'] ) ) {
        $fav_item_id = $_POST['fav_item_id']; 
    }
    if ( isset( $_POST['item_action_type'] ) && !empty( $_POST['item_action_type'] ) ) {
        $item_action_type = $_POST['item_action_type']; 
    }
    global $hsk_user_id;
    switch($item_action_type) { 
        case "add":
            if(($key = array_search($fav_item_id, $_SESSION['favouritive'])) === false) {
                array_push( $_SESSION['favouritive'], $fav_item_id );
            }
        break;      
        case "remove":
            if(($key = array_search($fav_item_id, $_SESSION['favouritive'])) !== false) {
                unset($_SESSION['favouritive'][$key]);
            }
        break;
        case "empty":
            unset($_SESSION['favouritive']); 
        break;
    }
    die();
}
add_action('wp_ajax_hsk_add_items_to_favouritive', 'hsk_add_items_to_favouritive');
add_action('wp_ajax_nopriv_hsk_add_items_to_favouritive', 'hsk_add_items_to_favouritive');

/**
 * Favouritive Items Count
 */
function hsk_favouritive_items_count(){
    if(!session_id()) {
        session_start();
    }
    if(isset($_SESSION['favouritive'])) {
        echo count($_SESSION['favouritive']);
    } else {
        echo '0';
    }
    die();
}
add_action('wp_ajax_hsk_favouritive_items_count', 'hsk_favouritive_items_count');
add_action('wp_ajax_nopriv_hsk_favouritive_items_count', 'hsk_favouritive_items_count');//for users that are not logged in.

/**
 * Age Calculation based on user date of birth
 */
function hsk_get_age($dob){    
    @list($year, $month, $day) = explode("-", $dob);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 && $month_diff==0) $year_diff--;
    if ($day_diff < 0 && $month_diff < 0) $year_diff--;
    return $year_diff;
}
/**
 * Pagination
 */
function hsk_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"hsk-pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}
/**
 * Get Page Id based on page slug
 */
function hsk_get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
} 
/**
 * Facebook comments
 */
function hsk_facebook_comments(){
    if( hsk_talents_opt_data('enable_single_page_comments') == '1'  ){
        echo '<div class="hsk-talent-single-comment-section"><div class="fb-comments" data-href="" data-numposts="5" data-colorscheme="light"></div></div>';
    }
}
/**
 * Facebook App Script
 */
function hsk_facebooks_post_js(){
    $hsk_facebook_id= hsk_talents_opt_data('hsk_facebook_app_id');
    if( !empty($hsk_facebook_id) ){
    ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo trim($hsk_facebook_id); ?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php }
}
add_action('wp_head', 'hsk_facebooks_post_js');

// Search Function
function hsk_adv_search_form(){
    echo '<form method="get"  class="searchbox s" action="'.home_url().'">';
        echo '<input type="hidden" name="hsk-talents-search" value="hsk-talents-search" />';
        global $hsk_talent_meta_opt, $hsk_talent_cat_opt;
        $tab = 0;
        if( !empty($hsk_talent_meta_opt['tabs_name']) ){
            
                echo '<p class="hsk-column-1">';
                unset($hsk_talent_cat_opt['choose-option']);
                    echo '<select name="talent_cat" id="hsk-talent-options-val">';
                        foreach ($hsk_talent_cat_opt as $key => $hsk_talent_cat_data) {
                            echo '<option value="'.$key.'">'.$hsk_talent_cat_data.'</option>';
                        }                            
                    echo '</select>';
                echo '</p>';
                echo '<input type="hidden" name="s" />';
                foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $user_tab) {
                    $tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
                    echo '<div class="'.$tab_id.' hsk-extra-width">';
                    for ($i=0; $i < 100; $i++) {
                        if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){

                            $id = str_replace(array(' ', ',','-', '/', 'esc_html___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
                            if( $hsk_talent_meta_opt['talent_option_display_search'][$tab_id][$i] == 'true' ){
                                if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'text' ){ // text
                                    echo '<p class="hsk-column-5">';
                                        echo '<label>'.$hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i].'</label><input name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'" type="text"  />';
                                    echo '</p>';
                                }elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'select' ){ // text
                                    if( $hsk_talent_meta_opt['talent_option_search_range'][$tab_id][$i] == 'true' ){
                                        echo '<p class="hsk-column-5 hsk-search-from-to">';
                                            echo '<label>'.$hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i].'</label>';
                                            echo '<select class="hsk-column-2" name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'-from">';
                                                $options = explode("\n", $hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
                                                echo '<option value="">'.esc_html__('Choose One', 'hsktalents').'</option>';
                                                foreach ($options as $key => $value) {
                                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                                }
                                                
                                            echo '</select>';
                                            echo '<select class="hsk-column-2" name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'-to">';
                                                $options = explode("\n", $hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
                                                echo '<option value="">'.esc_html__('Choose One', 'hsktalents').'</option>';
                                                foreach ($options as $key => $value) {
                                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                                }                                            
                                            echo '</select>';
                                        echo '</p>';
                                    }else{
                                        echo '<p class="hsk-column-5">';
                                            echo '<label>'.$hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i].'</label>';
                                            echo '<select name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'">';
                                                $options = explode("\n", $hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
                                                echo '<option value="">'.esc_html__('Choose One', 'hsktalents').'</option>';
                                                foreach ($options as $key => $value) {
                                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                                }                                            
                                            echo '</select>';
                                        echo '</p>';
                                    }
                                }elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'dob' ){
                                        echo '<p class="hsk-column-5 hsk-search-from-to">';
                                            echo '<label>'.$hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i].'</label>';
                                            echo '<select class="hsk-column-2" name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'-from">';
                                                echo '<option value="">'.esc_html__('Choose One', 'hsktalents').'</option>';
                                                foreach (range(1, 80) as $key => $value) {
                                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                                }                                            
                                            echo '</select>';
                                            echo '<select class="hsk-column-2 hsk-last-field" name="'.$hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i].'-to">';
                                                echo '<option value="">'.esc_html__('Choose One', 'hsktalents').'</option>';
                                                foreach (range(1, 80) as $key => $value) {
                                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                                }                                            
                                            echo '</select>';
                                        echo '</p>';
                                    } 
                            }
                        }
                    }
                $tab++;
                echo '</div>';
            }
            
        }
        echo '<input id="search_submit" class="" type="submit" name="submit" value="'.hsk_talents_opt_data('search_button_text', esc_html__('Search', 'hsktalents')).'" />';
    echo '</form>';
}


// Advanced Search database
function hsk_get_adv_search_result(){
     global $hsk_talent_meta_opt;
    $args = array( 
        'post_type'     => 'talent',
        'posts_per_page' => -1,
        'meta_query' => array(
        ) ,
    );
    $args['meta_query'][] = array(
        'key' => 'talents_meta_category',
        'value' => $_REQUEST['talent_cat'],
        'compare' => 'LIKE',
    );
     // Loop Data
    $tab = 0;
            $prefix = 'talent_';
            foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $user_tab) {
                $tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
                for ($i=0; $i < 100; $i++) {
                    if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){
                        //exit();
                        $id = str_replace(array(' ', ',','-', '/', 'esc_html___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
                        if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'text' ){ // text                            
                            if( !empty($_REQUEST[$id]) ){
                                $args['meta_query'][] = array(
                                    'key' => $prefix.$id,
                                    'value' => $_REQUEST[$id], 
                                    'compare' => 'LIKE',
                                );
                            }
                        }
                        // Date Of Birth
                        if($hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'dob' ){ // text 
                            if( (!empty($_REQUEST[$id.'-from']) ) && (!empty($_REQUEST[$id.'-to'])) ){
                                $args['meta_query'][] = array(
                                    'key' => 'search_age_update',
                                    'value' => array($_REQUEST[$id.'-from'], $_REQUEST[$id.'-to']), 
                                    'compare' => 'BETWEEN',
                                );
                            }
                        }
                        // Select Range & Single
                        if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'select' ){ // text 
                            if( $hsk_talent_meta_opt['talent_option_search_range'][$tab_id][$i] == 'true' ){ // Search Range True
                                if( (!empty($_REQUEST[$id.'-from']) ) && (!empty($_REQUEST[$id.'-to'])) ){
                                    echo 'test';
                                    $args['meta_query'][] = array(
                                        'key' => $prefix.$id,
                                        'value' => array($_REQUEST[$id.'-from'], $_REQUEST[$id.'-to']), 
                                        'compare' => 'BETWEEN',
                                    );
                                }
                            }else{ 
                                if( !empty($_REQUEST[$id]) ){                               
                                    $args['meta_query'][] = array(
                                        'key' => $prefix.$id,
                                        'value' => $_REQUEST[$id], 
                                       // 'compare' => '=',
                                    );
                                }
                            }
                        }
                    }
                }
                $tab++;
            } // End
    $loop = new WP_Query($args);
    if ( $loop->have_posts() )  : 
        echo '<div class="hsk-talents-content-wrapper">';
            echo '<ul>';
                while ( $loop->have_posts() ) : $loop->the_post();
                    hsk_include_templates('content','talent');
                endwhile;
            echo '</ul>';
        echo '</div>';
    else:
        echo 'no talents found in this category';
    endif;
}

/**
 * RGBA Color opacity
 */
function talenthub_hsk_hextorgba($color, $opacity = false){
    $default = 'rgb(0,0,0)';    
    
    if (empty($color))
        return $default;    

    if ($color[0] == '#')
        $color = substr($color, 1);
    
    if (strlen($color) == 6)
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    
    elseif (strlen($color) == 3)
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    
    else
        return $default;
       
    $rgb = array_map('hexdec', $hex);    

    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;

        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }    
    return $output;
}
?>