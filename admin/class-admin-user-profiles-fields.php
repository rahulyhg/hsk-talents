<?php
if (!get_option('hsk_userp_fields')) {
    add_option('hsk_userp_fields', '');
}

add_action('edit_user_profile', 'hsk_extract_extrafields');
add_action('show_user_profile', 'hsk_extract_extrafields');
//add_action('profile_update', 'hsk_update_extrafields');


add_action( 'personal_options_update', 'hsk_update_extrafields' );
add_action( 'edit_user_profile_update', 'hsk_update_extrafields' );

//Administration
add_action('admin_menu', 'hsk_user_profile_menu_page');
add_action('init', 'hsk_profile_page_script');
//add_action( 'admin_init', 'add_hucf_contextual_help' );

function hsk_user_profile_menu_page()
{
    $hucf_page = add_submenu_page(
        'users.php', __('Custom Profile Fields', 'hsktalents'), __('Custom Profile Fields', 'hsktalents'), 'edit_users', 'user-custom-fields',
        'hsk_profile_options_page'
    );
}

function hsk_profile_page_script()
{
    wp_enqueue_script(array("jquery", "jquery-ui-core", "jquery-ui-sortable"));
}


function hsk_extract_extrafields()
{
    if (get_option('hsk_userp_fields')) {

        $all_fields = unserialize(get_option('hsk_userp_fields'));

        if (count($all_fields) > 0) {

            $output = '';

            foreach ($all_fields as $key => $value) {
                $user = wp_get_current_user();
                $allowed_roles = $value[3];
                if( is_array($allowed_roles) ){
                    if( array_intersect($allowed_roles, $user->roles ) ) {
                         $output .= '<tr>
                          <th><label for="hucf' . esc_attr( $value[1] ) . '">' . esc_attr( $value[0] ) . '</label></th>
                          <td><input name="hucf' . esc_attr( $value[1] ) . '" id="hucf' . esc_attr( $value[1] ) . '" type="text" value="' . esc_attr( get_user_meta( hsk_get_user_pro_id(), $value[1], true ) ) . '" class="regular-text code" />&nbsp;<span class="description">' . ( ( isset( $value[2] ) && $value[2] !== '' ) ? esc_attr( stripslashes( $value[2] ) ) : '' ) . '</span></td>
                        </tr>';
                    } 
                }

               
            }
        }

        if ($output != '') {
            echo '<h3>' . __('User Information', 'hsktalents') . '</h3>
                <table class="form-table">';
            echo $output;
            echo '</table>';
        }
    }
}

function hsk_profile_options_page()
{
    // ============
    // = Updating =
    // ============
    if (isset($_POST['hucf_submit'])) {

        $hsk_userp_fields     = $_POST['hsk_userp_fields'];
        $all_fields     = array();
        $error_fields   = array();
        $updating_slugs = array();

        if (is_array($hsk_userp_fields)) {
            foreach ($hsk_userp_fields as $key => $value) {
                if (isset($value['0']) || isset($value['1'])) {

                    $name        = !empty($value['0']) ? $value['0'] : ucfirst($value['1']);
                    $slug        = !empty($value['1']) ? $value['1'] : sanitize_title($value['0']);
                    $description = !empty($value['2']) ? $value['2'] : '';
                    $capability  = !empty($value['3']) ? $value['3'] : 'read';

                    $hsk_userp_fields[$key][0] = $name;
                    $hsk_userp_fields[$key][1] = $slug;
                    $hsk_userp_fields[$key][2] = $description;
                    $hsk_userp_fields[$key][3] = $capability;


                    // Validate the field label
                    if (preg_match('/^[0-9a-z-_]+$/', $slug) === 1 && !in_array($slug, $updating_slugs)) {
                        $updating_slugs[] = $slug;

                        $all_fields[] = array(
                            0 => $name,
                            1 => $slug,
                            2 => $description,
                            3 => $capability,
                        );
                    } else {
                        $error_fields[] = $key;
                    }
                }

            }
        }

        if (count($all_fields) > 0) {
            update_option('hsk_userp_fields', serialize($all_fields));
        } else {
            update_option('hsk_userp_fields', '');
        }

        echo '<div class="updated"><p><strong>' . __('Extra Fields Options Updated.', 'hsktalents') . '</strong></p></div>';

        if (count($error_fields)) {
            echo '<div class="error">
                    <p><strong>' . __( 'However, highlighted fields are not updated because contain errors! Please correct them and update fields again or these fields will be lost.', 'hsktalents' ) . '</strong></p>
                </div>';
        }
    }

    echo '
    <form action="" method="post">
        <div class="wrap">
            <div class="icon32" id="icon-options-general"></div>
            <h2>' . __('User Custom Profile Fields Options', 'hsktalents') . '</h2>';

    echo '
            <form action="" method="post">

                <h3>' . __('Currently defined fields', 'hsktalents') . '</h3>';

    if (isset($hsk_userp_fields) && !empty($hsk_userp_fields)) {
        $all_fields = $hsk_userp_fields;
    }

    if (!isset($all_fields) || empty($all_fields)) {
        $all_fields = get_option('hsk_userp_fields');
        if (!is_array($all_fields)) {
            $all_fields = unserialize($all_fields);
        }
    }

    ?>
    <script type='text/javascript'>
        jQuery(document).ready(function() {
            jQuery('.sortcontainer').sortable({
                axis  : 'y',
                items : 'div',
                stop  : function() {
                    jQuery(this).find('div').each(function(index) {
                        jQuery(this).find('td:eq(0)').html((index + 1) + '.');
                    })
                }
            });
            var tr;
            tr = '';
            jQuery('.add-field').click(function() {
                var randnum = Math.floor((Math.random() * (9999 - 999 + 1)) + 999);<?php global $wp_roles;if ( ! isset( $wp_roles ) )  $wp_roles = new WP_Roles();  $roles = $wp_roles->get_names();     $tr = ''; foreach ($roles as $role_value => $role_name) { $tr .= '<p><input type="checkbox" name="hsk_userp_fields[\' + randnum + \'][3]" value="' . $role_value .'">'.$role_name.'</p>'; } ?> 
                var append = '<div class="field"><table><tbody><tr><th class="num">&nbsp;</th><th class="slug"><?php _e('Meta Key:', 'hsktalents');?></th><th class="name"><?php _e('Field Name:', 'hsktalents');?></th><th class="description"><?php _e( 'Description (Help Text):', 'hsktalents' );?></th><th class="userlevel"><?php _e('Access Level:', 'hsktalents');?></th><th class="actions"></th></tr><tr><td>' + (jQuery('.sortcontainer div').size() + 1) + '.</td><td><input name="hsk_userp_fields[' + randnum + '][1]" type="text" value="" class="regular-text field-slug" size=""/></td><td><input name="hsk_userp_fields[' + randnum + '][0]" type="text" value="" class="regular-text" size=""/></td><td><input name="hsk_userp_fields[' + randnum + '][2]" type="text" value="" class="regular-text" size="80"/></td><td class="hsk-user-roles"><?php echo $tr ?></td><td><input type="button" value="<?php _e('Delete', 'hsktalents');?>" class="delete-field button"></td></tr></tbody></table></div>';
                jQuery('.sortcontainer').append(append);
            });

            jQuery('.sortcontainer').delegate('.delete-field', 'click', function() {
                var parent = jQuery(this).parents('.field');
                if (parent.find('input[type=text]').val() == '' || confirm('Are you sure you want to delete this extra field?')) {
                    parent.remove();
                }

                return false;
            });

            jQuery('[name="hucf_submit"]').click(function() {
                var fields = jQuery(this).parents('form').find('.field');
                var defined_slugs = [],
                    duplicate_slugs = [];

                jQuery(fields).each(function(index) {
                    var slug = jQuery(this).find('.field-slug').val(),
                        table = jQuery(this).find('table');

                    if (jQuery.inArray(slug, defined_slugs) < 0) {
                        defined_slugs.push(slug);
                        table.removeClass('bad-field');
                    }
                    else {
                        duplicate_slugs.push(slug);
                        table.addClass('bad-field');
                    }
                });

                if (duplicate_slugs.length) {
                    alert('<?php _e('Duplicate fields detected. Please fix highlighted.', 'hsktalents'); ?>');

                    return false;
                }

                return true;
            });
        });
    </script>
    <div class="sortcontainer">
<?php
                if (is_array($all_fields) && count($all_fields) > 0) {

                    if (!isset($error_fields)) {
                        $error_fields = array();
                    }

                    $counter = 0;
                    foreach ( $all_fields as $key => $value ) {
                      if ( !isset($value['3']) || empty($value['3']) ) $value['3'] = 'read';
                        if ( in_array( $key, $error_fields) ) $class = ' class="bad-field"'; else $class = '';
                        echo '
                        <div class="field">
                            <table' . $class . '>
                                <tbody>
                                    <tr>
                                        <th class="num">&nbsp;</th>
                                        <th class="slug">' . __('Meta Key:', 'hsktalents') . '</th>
                                        <th class="name">' . __("Field Name:", "hsktalents") . '</th>
                                        <th class="description">' . __("Description (Help Text):", "hsktalents") . '</th>
                                        <th class="userlevel">' . __("Access Level:", "hsktalents") . '</th>
                                        <th class="actions"></th>
                                    </tr>
                                    <tr>
                                        <td>' . ++$counter . '.</td>
                                        <td>
                                            <input name="hsk_userp_fields[' . esc_attr( $key ) . '][1]" type="text" value="' . esc_attr( $value[1] ) . '" class="regular-text field-slug" size="20" />
                                        </td>
                                        <td>
                                            <input name="hsk_userp_fields[' . esc_attr( $key ) . '][0]" type="text" value="' . esc_attr( $value[0] ) . '" class="regular-text" size="30" />
                                        </td>
                                        <td>
                                            <input name="hsk_userp_fields[' . esc_attr( $key ) . '][2]" type="text" value="' . ( isset( $value[2] ) ? htmlspecialchars( stripslashes( $value[2] ), ENT_NOQUOTES ) : '' ) . '" class="regular-text" size="80" />
                                        </td>
                                        <td class="hsk-user-roles">';
                                            global $wp_roles;

                                            if ( ! isset( $wp_roles ) )
                                                $wp_roles = new WP_Roles();
                                                $roles = $wp_roles->get_names();

                                                foreach ($roles as $role_value => $role_name) {
                                                    if( is_array($value[3]) ){
                                                     $checked = in_array($role_value, $value[3] ) ? 'checked' : ''; 
                                                 }
                                                    echo "<p><input type='checkbox' name='hsk_userp_fields[". esc_attr( $key ) ."][3][]' value='" . $role_value ."' ".$checked.">".$role_name."</p>";
                                            }
                                        echo '</td>
                                        <td class="">
                                            <input type="button" value="' . __('Delete', 'hsktalents') . '" onclick="remove_hucf_field();" class="delete-field button">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>';

                    }
                    unset($value);
                }
                    echo '</div>';

                unset($all_fields);


                echo '
                </div>

                <input type="button" value="' . __('Add New Field', 'hsktalents') . '" class="add-field button">

            <p class="submit">
            <input type="submit" name="hucf_submit" class="button-primary" value="' . __('Save Custom Fields', 'hsktalents') . '">
        </p>
    </form>';
}


/**
 * Updates extra fields. Input validation needed, but we don't know what the user wants to accept...
 *
 * @return void
 * @author Vadimk
 */
function hsk_update_extrafields()
{
    $get_user_id = hsk_get_user_pro_id();
    $all_fields  = unserialize(get_option('hsk_userp_fields'));

    $slug2cap = array();

    if (is_array($all_fields)) {
        // This will rewrite any duplicate field setting, anyway it's ambiguous
        foreach ($all_fields as $field) {
            $slug2cap[$field[1]] = $field[3];
        }
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'hucf') === 0) {
            $key = str_replace('hucf', '', $key);

            //if ($key && array_key_exists($key, $slug2cap) && current_user_can($slug2cap[$key])) {
                if (!empty($value)) {
                    hsk_fields_update_option($get_user_id, $key, $value);
                } else {
                    hsk_fields_delete_option($get_user_id, $key, $value);
                }
            //}
        }
    }
}

/**
 * Updates extra field value
 *
 * @param string $get_user_id
 * @param string $hucffield
 * @param string $value
 *
 * @return void
 * @author Vadimk
 */
function hsk_fields_update_option($get_user_id, $hucffield, $value)
{
    hsk_update_user_meta($get_user_id, str_replace('hucf', '', $hucffield), $value);
}

/**
 * Deletes extra field value if nothing was populated
 *
 * @param string $get_user_id
 * @param string $hucffield
 * @param string $value
 *
 * @return void
 * @author Vadimk
 */
function hsk_fields_delete_option($get_user_id, $hucffield, $value)
{
    hsk_delete_user_meta($get_user_id, str_replace('hucf', '', $hucffield), $value);
}

/**
 * Return current editing user_id
 *
 * @return int
 * @author Vadimk
 */
function hsk_get_user_pro_id()
{
    $get_user_id = empty($_GET['user_id']) ? null : $_GET['user_id'];

    if (!isset($get_user_id)) {
        $get_user_id = empty($_POST['user_id']) ? null : $_POST['user_id'];
    }

    if (!isset($get_user_id)) {
        global $current_user;
        wp_get_current_user();
        $get_user_id = $current_user->ID;
    }

    return $get_user_id;
}

// ===========================
// = BACKWARDS COMPATIBILITY =
// ===========================

if (!function_exists('esc_attr')) {
    function esc_attr($text)
    {
        return attribute_escape($text);
    }
}

if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return wp_specialchars($text);
    }
}

if (!function_exists('get_user_meta')) {
    function get_user_meta($userid, $metakey, $single)
    {
        return get_user_meta($userid, $metakey);
    }
}

if (!function_exists('hsk_delete_user_meta')) {
    function hsk_delete_user_meta($get_user_id, $key, $value)
    {
        return delete_usermeta($get_user_id, $key, $value);
    }
}

if (!function_exists('hsk_update_user_meta')) {
    function hsk_update_user_meta($get_user_id, $key, $value)
    {
        return update_usermeta($get_user_id, $key, $value);
    }
}