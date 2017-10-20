<?php
/**
 * Talent form meta options data
 */
function hsk_talent_meta_opt(){
	global $hsk_talent_meta_opt;
	$hsk_talent_meta_opt = get_option('talent_opt_data');
	return $hsk_talent_meta_opt;
}
hsk_talent_meta_opt();
/**
 * Talent Cat Group Options
 */
function hsk_talent_cat_options(){
	global $hsk_talent_cat_opt;
	$talent_options = get_option('talent_opt_data');
	$cat_id = isset($talent_options['field_group_tab_uid']) ? $talent_options['field_group_tab_uid'] : '';
	$cat_name[] = __('Choose Option', 'hsktalents');
	$hsk_talent_cat_opt ='';
	if( !empty($talent_options) ){
		foreach ($talent_options['tabs_name'] as $key => $opt_name) {
			if( !empty($opt_name) ){
				$cat_name[] = $opt_name;
			}
		}
		$cat_id[] = 'choose-option';
		foreach ($talent_options['tabs_uid'] as $key => $opt_id) {
			if( !empty($opt_id) ){
				$cat_id[] = $opt_id;
			}
		}
		$hsk_talent_cat_opt = array_combine($cat_id, $cat_name);
	}
	return $hsk_talent_cat_opt;
}
hsk_talent_cat_options();

/**
 * Creating default user role 
 */
add_role(
    'user',
    __( 'User', 'hsktalents' ),
    array(
        'read'         => true,  // true allows this capability
        'upload_files'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

/**
 * Disable Woo commerce forcable admin disable access
 */
add_filter( 'woocommerce_prevent_admin_access', '__return_false' );
add_filter( 'woocommerce_disable_admin_bar', '__return_false' );

/**
 * Get admin post limit data
 */
function hsk_post_limit(){
	global $hsk_post_limit, $current_user_role;
	$post_limit = get_option('restrict-user-roles');
	$hsk_post_limit = !empty($post_limit[$current_user_role]) ? $post_limit[$current_user_role] : '';
	return $hsk_post_limit; 
}
hsk_post_limit();

/**
 * Restrict metabox panels based on user roles
 */
function hsk_post_meta_panel(){
	global $hsk_post_meta_panel, $current_user_role;
	$metaboxes = get_option('restrict-user-roles');
	$hsk_post_meta_panel = !empty($metaboxes[$current_user_role]['metabox']) ? $metaboxes[$current_user_role]['metabox'] : '';
	return $hsk_post_meta_panel; 
}
hsk_post_meta_panel();
global $hsk_post_meta_panel;

function remove_post_custom_fields() {
	global $hsk_post_meta_panel;
	if( !empty($hsk_post_meta_panel) ){
		if( !empty($hsk_post_meta_panel) ){
		foreach ($hsk_post_meta_panel as $key => $value) {
			//foreach ($meta_opt as $key => $metabox) {
				remove_meta_box( $key , 'talent' , 'normal' );
				remove_meta_box( $key , 'talent' , 'side' );
				remove_meta_box( $key , 'talent' , 'core' ); 
			//}
			
		}
	}
		//remove_meta_box( 'submitdiv', 'talent', 'side' );
	}
	
}
add_action( 'do_meta_boxes' , 'remove_post_custom_fields' );
?>