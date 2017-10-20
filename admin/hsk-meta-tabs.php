<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
global $hsk_meta_boxes;
// Testimonial 
$hsk_meta_boxes[] = array(
		'id' => 'hsk_testimonial_options',
		'title' => __('Settings', 'hsktalents'),
		'pages' => array( 'testimonial' ),
		'priority' => 'high',
		'context' => 'normal',
			'fields' => array(
			array(
				'name' => __('Client Description', 'hsktalents'),
				'id' => 'testimonial_description',
				'type'	=> 'textarea',
			),
			array(
				'name' => __('Client Designation', 'hsktalents'),
				'id' => 't_client_designation',
				'type'	=> 'text',
			),
			array(
				'name' => __('Client Link', 'hsktalents'),
				'id' => 'testimonial_client_link',
				'type'	=> 'url',
			),
		)
	);
// Email & Phone Verified
if (current_user_can('administrator')) {
	$hsk_meta_boxes[] = array(
		'id' => 'hsk_talent_email_phone_verified',
		'title' => __('Email & Phone Verification Settings', 'hsktalents'),
		'pages' => array( 'talent' ),
		'priority' => 'high',
		'context' => 'normal',
			'fields' => array(
			array(
				'name' => __('Email ID Verified', 'hsktalents'),
				'desc' => __('Check this box to verified talent email id', 'hsktalents'),
				'id' => 'hsk_email_verified',
				'type'	=> 'checkbox',
			),
			array(
				'name' => __('Phone Number Verified', 'hsktalents'),
				'desc' => __('Check this box to verified talent phone number', 'hsktalents'),
				'id' => 'hsk_phone_verified',
				'type'	=> 'checkbox',
			),
		)
	);
}
// Talent Compcard
$hsk_meta_boxes[] = array(
	'id' => 'hsk_talent_unique_id',
	'title' => __('Talent Unique ID', 'hsktalents'),
	'pages' => array( 'talent' ),
	'priority' => 'high',
	'context' => 'normal',
		'fields' => array(
		array(
			'name' => '',
			'desc' => '',
			'id' => 'talent_unique_id',
			'type'	=> 'text',
			'std' => hsk_talent_profile_id(),
		),
	)
);

// Social share
$hsk_meta_boxes[] = array(
	'id' => 'talent_social_share_info',
	'title' => __('Social Sharing ID\'s', 'hsktalents'),
	'pages' => array( 'talent' ),
	'priority' => 'high',
	'context' => 'normal',
		'fields' => array(
		array(
			'name' => __('Facebook ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_fbook_id',
			'type'	=> 'text',
		),
		array(
			'name' => __('Twitter ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_twitter_id',
			'type'	=> 'text',
		),
		array(
			'name' => __('Instagram ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_instagram_id',
			'type'	=> 'text',
		),

		array(
			'name' => __('Pinterest ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_pinterest_id',
			'type'	=> 'text',
		),
		array(
			'name' => __('Google Plus ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_google_plus_id',
			'type'	=> 'text',
		),
		array(
			'name' => __('Linkedin ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_linkedin_id',
			'type'	=> 'text',
		),

		array(
			'name' => __('Youtube ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_youtube_id',
			'type'	=> 'text',
		),
		array(
			'name' => __('Flickr ID','hsktalents'),
			'desc' => '',
			'id' => 'talent_flickr_id',
			'type'	=> 'text',
		),
	)
);

$hsk_meta_boxes[] = array(
	'id' => 'hsk_talent_status_info',
	'title' => __('Talent Status', 'hsktalents'),
	'pages' => array( 'talent' ),
	'priority' => 'low',
	'context' => 'side',
		'fields' => array(
			array(
			'name' => '',
			'desc' => '',
			'id' => 'hsk_talent_status',
			'type'	=> 'select',
			'options' => array(
				'talent_available' => __('Available','hsktalents'),
				'talent_not_available' => __('Out of Station', 'hsktalents')
			)
		),
	)
);

/********************* META BOX REGISTERING ***********************/
/**
 * Register meta boxes
 *
 * @return void
 */
function hsk_meta_boxes_register()
{
	global $hsk_meta_boxes;
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $hsk_meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
add_action( 'admin_init', 'hsk_meta_boxes_register' );

// Meta Tabs Details
add_filter( 'rwmb_meta_boxes', 'talent_edit_meta_boxes', 20 );
function talent_edit_meta_boxes( $hsk_meta_boxes )
{	
	global $hsk_talent_meta_opt, $hsk_talent_cat_opt, $current_user_role;
	//print_r($hsk_talent_cat_opt);
	if( !empty($hsk_talent_cat_opt) ){
		$hsk_meta_boxes[] = array(
			'id' => 'talent_talent_cat',
			'title' => __('Choose Group', 'hsktalents'),
			'pages' => array( 'talent' ),
			'priority' => 'high',
			'context' => 'normal',
				'fields' => array(
					array(
						'name' 	=> __('Choose Talent Group','hsktalents'),
						'id' 	=> 'talents_meta_category',
						'type'	=> 'select',
						'options' => $hsk_talent_cat_opt,
					),

			)
		);
	}
	$tab = 0;
	if( !empty($hsk_talent_meta_opt['tabs_name']) ){
		foreach ($hsk_talent_meta_opt['tabs_name'] as $key => $opt_tab_name) {
			$hsk_meta_boxes[] = array(
			'id' => $hsk_talent_meta_opt['tabs_uid'][$tab],
			'title' => $opt_tab_name,
			'pages' => array( 'talent' ),
			'priority' => 'high',
			'context' => 'normal',
				'fields' => array()
			);
			foreach ( $hsk_meta_boxes as $k => $meta_box )
		    {
		        if ( isset( $meta_box['id'] ) && $hsk_talent_meta_opt['tabs_uid'][$tab] == $meta_box['id'] )
		        {
		        	for ($i=0; $i < 100; $i++){
						$tab_id = $hsk_talent_meta_opt['tabs_uid'][$tab];
						if( ( !empty($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) ) &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != 'Array') &&  ( $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i] != '') &&  ( !is_array($hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i]) )){

							$id = str_replace(array(' ', ',','-', '/', '___'), '_', trim(strtolower($hsk_talent_meta_opt['talent_meta_label_uid'][$tab_id][$i])));
							$required = $hsk_talent_meta_opt['talent_option_rquired'][$tab_id][$i] ? $hsk_talent_meta_opt['talent_option_rquired'][$tab_id][$i] : '';
							if( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'text' ){ // text
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'text',
					                'class' =>  ''.$required.' talent_'.$id,
					                'required'  => $required,
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'emailid' ){ // text
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'email',
					                'class' =>  'talent_'.$id,
					                'std'  => 'name@email.com',
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'website' ){ // text
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'url',
					                'class' =>  'talent_'.$id,
					                'std'  => '',
					                'placeholder'  => 'http://www.google.com',
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'select' ){ // Select
								$field_opt_string = hsk_string_to_array($hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
								$field_opt_array = str_replace("'", ".", trim($field_opt_string));
								$field_opt_array = explode(',', trim($field_opt_array));
								$field_opt = array_filter(array_combine($field_opt_array, $field_opt_array));
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'select',
					                'options' => $field_opt,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'panel_title' ){ // Select
								$field_opt_string = hsk_string_to_array($hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
								$field_opt_array = str_replace("'", ".", trim($field_opt_string));
								$field_opt_array = explode(',', trim($field_opt_array));
								$field_opt = array_filter(array_combine($field_opt_array, $field_opt_array));
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'type' => 'heading',
									'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'checkbox' ){ //checkbox
								$field_opt_string = hsk_string_to_array($hsk_talent_meta_opt['talent_meta_field_options'][$tab_id][$i]);
								$field_opt_array = str_replace("'", ".", trim($field_opt_string));
								$field_opt_array = explode(',', trim($field_opt_array));
								$field_opt = array_filter(array_combine($field_opt_array, $field_opt_array));
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'checkbox_list',
					                'options' => $field_opt,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'date' ){ // Select
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type'       => 'date',
									// jQuery date picker options. See here http://api.jqueryui.com/datepicker
									'js_options' => array(
										'appendText'      => esc_html__( '(yyyy-mm-dd)', 'hsktalents' ),
										'dateFormat'      => esc_html__( 'yy-mm-dd', 'hsktalents' ),
										'changeMonth'     => true,
										'changeYear'      => true,
										'showButtonPanel' => true,
									),
					                //'options' => $field_opt,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'date_cal' ){ //date
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'text',
					                //'options' => $field_opt,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'videos' ){ // Select
								
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'text',
					                'clone' =>true,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'phone_number' ){ //date
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'number',
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'textarea' ){ //date
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'textarea',
					                'clone' =>true,
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'wysiwyg' ){ //date
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'wysiwyg',
					                'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'dob' ){ //date
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'date',
					                'js_options' => array(
										'appendText'      => __( '(yyyy-mm-dd)', 'hsktalents' ),
										'autoSize'        => true,
										'buttonText'      => __( 'Select Date', 'hsktalents' ),
										'dateFormat'      => __( 'yy-mm-dd', 'hsktalents' ),
										'numberOfMonths'  => 1,
										'showButtonPanel' => true,
									),
					                'class' =>  'talent_'.$id
			            		);
			            		$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => 'Age In Years',
					                'id'   => 'age_years',
					                'type' => 'hidden',
					                'std' => ( !empty(get_post_meta(212,'talent_'.$id,true)) ? get_post_meta(212,'talent_'.$id,true) : ''),
					                'placeholder' => ( !empty(get_post_meta(212,'talent_'.$id,true)) ? hsk_get_age(get_post_meta(212,'talent_'.$id,true)) : ''),
					                 'class' =>  'talent_'.$id
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'images' ){ //date
								
								$hsk_meta_boxes[$k]['fields'][] = array( //current_user_role
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'image_advanced',
					                'class' =>  'talent_'.$id,
					                'max_file_uploads' => (!empty($hsk_talent_meta_opt['talent_images_'.$current_user_role.'_limit'][$tab_id][$i]) ? $hsk_talent_meta_opt['talent_images_'.$current_user_role.'_limit'][$tab_id][$i] : '100'),
			            		);
							}elseif( $hsk_talent_meta_opt['talent_meta_field_name'][$tab_id][$i] == 'compcard' ){ //date
								
								$hsk_meta_boxes[$k]['fields'][] = array(
					               	'name' => $hsk_talent_meta_opt['talent_meta_label_name'][$tab_id][$i],
					                'id'   => 'talent_'.$id,
					                'type' => 'image_advanced',
					                'class' =>  'talent_'.$id,
					                'max_file_uploads' => 5
			            		);
							}
							
						}
					}
		        }
		    }
			$tab++;
			}
		}	
	return $hsk_meta_boxes;
}

/**
 * Add a meta box to the post editing screen
 */
function hsk_featured_talent_post() {
    add_meta_box( 'hsk-featured-talent', __( 'Featured Talent', 'hsktalents' ), 'hsk_talent_featured_callback', 'talent', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'hsk_featured_talent_post' );
 
/**
 * Outputs the content of the meta box
 */
 
function hsk_talent_featured_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'hsk-talent-nonce' );
    $hsk_stored_meta = get_post_meta( $post->ID );   ?> 
	<p>
		<span class="hsk-row-title"><?php _e( 'Check if this is a featured Talent ', 'hsktalents' )?></span>
		<div class="hsk-row-content">
			<label for="featured-talent">
				<input type="checkbox" name="featured-talent" id="featured-talent" value="yes" <?php if ( isset ( $hsk_stored_meta['featured-talent'] ) ) checked( $hsk_stored_meta['featured-talent'][0], 'yes' ); ?> />
				<?php _e( 'Featured Talent', 'hsktalents' )?>
			</label>
		</div>
	</p>   
 
<?php
}
 
/**
 * Saves the custom meta input
 */
function hsk_save( $post_id ) {
 
    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'hsk-talent-nonce' ] ) && wp_verify_nonce( $_POST[ 'hsk-talent-nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    } 
	// Checks for input and saves - save checked as yes and unchecked at no
	if( isset( $_POST[ 'featured-talent' ] ) ) {
	    update_post_meta( $post_id, 'featured-talent', 'yes' );
	} else {
	    update_post_meta( $post_id, 'featured-talent', 'no' );
	}
 
}
add_action( 'save_post', 'hsk_save' );
?>