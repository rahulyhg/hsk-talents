<?php
/**
* Talent Options Data Export
*/
function hsk_talent_opt_data_export($opt_cpt_name) {  
    if (!isset($_POST[$opt_cpt_name.'-opt-export'])) {  ?>
        <div class="wrap">
            <div id="icon-tools" class="icon32"><br /></div>
            <h2><?php _e('Talent Options Data Export','hsktalents').'</h2>'; ?>
            <form method='post'>
                <p class="submit">
                    <?php wp_nonce_field($opt_cpt_name.'-export'); ?>
                    <input type='submit' name='<?php echo $opt_cpt_name; ?>-opt-export' value='<?php _e("Dowload Talent Data", 'hsktalents'); ?>' class="button button-primary"/>
                </p>
            </form>
        </div>
        <?php
    }
    elseif (check_admin_referer($opt_cpt_name.'-export')) {
        $blogname = str_replace(" ", "", get_option('blogname'));
        $date = date("m-d-Y");
        $json_name = $blogname."-".$date;
          $options = array($opt_cpt_name.'_opt_data' => get_option($opt_cpt_name.'_opt_data'));     
         foreach ($options as $key => $value) {
            $value = maybe_unserialize($value);
            $need_options[$key] = $value;
        }
        $json_file = json_encode($need_options); // Encode data into json data
        ob_clean();
        echo $json_file;
        header("Content-Type: text/json; charset=" . get_option( 'blog_charset'));
        header("Content-Disposition: attachment; filename=$json_name.json");
        exit();
    }
}
/**
* Import CPT Post Content
*/
function hsk_talents_import_meta_options($opt_cpt_name){ ?>
    <div class="wrap">
        <div id="icon-tools" class="icon32"><br /></div>
        <h2><?php  _e('Options Data Import','hsktalents'); ?> </h2>
        <?php
        if (isset($_FILES[$opt_cpt_name.'-import']) && check_admin_referer($opt_cpt_name.'-import')) {
            if ($_FILES[$opt_cpt_name.'-import']['error'] > 0) {
                wp_die("Please Choose Upload json format file");
            }
            else {
                WP_Filesystem();
                global $wp_filesystem;
                $encode_options = $wp_filesystem->get_contents( $_FILES[$opt_cpt_name.'-import']['tmp_name'] );
                $options = json_decode($encode_options, true);
                $file_name = $_FILES[$opt_cpt_name.'-import']['name']; // Get the name of file
                $file_path = explode('.', $file_name);
                $file_ext = end($file_path);  // Get extension of file
                $file_size = $_FILES[$opt_cpt_name.'-import']['size']; // Get size of file
                if (($file_ext == "json") && ($file_size < 500000)) {
                    foreach ($options as $key => $value) {
                        update_option($key, $value);
                    }                        
                    echo "<div class='updated'><p>".__('All options are restored successfully','hsktalents')."</p></div>";
                }
                else {
                    echo "<div class='error'><p>".__('Invalid file or file size too big.','hsktalents')."</p></div>";
                }
            }
        }  ?>
        <p><?php _e('Click Browse button and choose a json file that you backup before.','hsktalents'); ?> </p>
        <p><?php _e('Press Upload File and Import, WordPress do the rest for you.','hsktalents'); ?></p>
        <form method='post' enctype='multipart/form-data'>
            <p class="submit">
                <?php wp_nonce_field($opt_cpt_name.'-import'); ?>
                <input type='file' name='<?php echo trim($opt_cpt_name); ?>-import' class="button primary-button"  />
                <input type='submit' name='submit' value='<?php _e("Upload File and Import", 'hsktalents') ?>' class="button button-primary"/>
            </p>
        </form>
    </div>
    <?php
}
/**
* Talent Options Functions
*/
$options_arg = array('text'=>'true', 'select'=>'true', 'checkbox'=>'true', 'date_cal'=>'true', 'date'=>'true', 'emailid'=>'true', 'phone_number'=>'true','textarea' => 'true', 'images' => 'true', 'videos' => 'true', 'compcard' => 'true');
function hsk_talent_opt_list_box($post_type, $options, $id, $tab_id, $i, $options_arg ){    ?>
    <select class="form-control input-type-select <?php echo  $id; ?> " name="<?php echo $post_type; ?>_opt_data[<?php echo $id; ?>][<?php echo $tab_id; ?>][]" id="input-type-1">
        <optgroup label="Text"><?php _e('Text', 'hsktalents') ?> <!-- Text Type Group -->
            <option value="text" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'text' ); ?>> <?php _e('Text', 'hsktalents'); ?></option> <!-- Text Field -->

            <option value="website" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'website' ); ?>><?php _e('Website', 'hsktalents'); ?></option> <!-- Website Field --> 
            
            <option value="emailid" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'emailid' ); ?>><?php _e('Email ID', 'hsktalents'); ?></option><!-- Email Field -->
            
            <option value="phone_number" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'phone_number' ); ?>><?php _e('Phone Number', 'hsktalents'); ?></option> <!-- Phone Number Field -->
        </optgroup>

        <optgroup label="Heading"><?php _e('Options Heading', 'hsktalents') ?> <!-- Heading Type Group -->
            <option value="panel_title" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'panel_title' ); ?>><?php _e('Panel Title', 'hsktalents'); ?></option>
        </optgroup>

        <optgroup label="Paragraph"><?php _e('Paragraph', 'hsktalents') ?> <!-- Paragraph Type Group -->
            <option value="textarea" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'textarea' ); ?>><?php _e('Text Area', 'hsktalents'); ?></option> <!-- Small Textarea -->
            <option value="wysiwyg" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'wysiwyg' ); ?>><?php _e('WYSIWYG (Visual Editor)', 'hsktalents'); ?></option> <!-- Small Textarea -->

        </optgroup>

        <optgroup label="Checkboxes"><?php _e('Paragraph', 'hsktalents') ?> <!-- Select / CheckBoxes / Radio Type Group -->
            <option value="checkbox" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'checkbox' ); ?>><?php _e('Checkbox', 'hsktalents'); ?></option> <!-- CheckBox Type-->    
            <option value="select" <?php selected(( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'select' ); ?>><?php _e('Select', 'hsktalents'); ?></option> <!-- Select Type -->
            <option value="radio" <?php selected(( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'radio' ); ?>><?php _e('Radio', 'hsktalents'); ?></option> <!-- Radio Type -->
        </optgroup>
        
        <optgroup label="Date"><?php _e('Date', 'hsktalents') ?> <!-- Date TYpe Group -->
            <option value="date" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'date' ); ?>><?php _e('Date', 'hsktalents'); ?></option>    
            <option value="dob" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'dob' ); ?>><?php _e('Date Of Birth', 'hsktalents'); ?></option>
        </optgroup>
       
        <optgroup label="Media"><?php _e('Media', 'hsktalents') ?> <!-- Media Group -->
            <option value="images" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'images' ); ?>><?php _e('Images', 'hsktalents'); ?></option> <!-- Images Type -->
    
            <option value="compcard" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'compcard' ); ?>><?php _e('Compcard', 'hsktalents'); ?></option> <!-- Compcard -->
    
            <option value="videos" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'videos' ); ?>><?php _e('Videos', 'hsktalents'); ?></option> <!-- Videos -->
        </optgroup>    
    
    </select> 
<?php }
/**
* Meta Options Select Field
*/
function hsk_talent_opt_select_box($post_type, $options, $id, $tab_id, $i){ ?>
    <select class="form-control input-type-select <?php echo $id ?> " name="<?php echo $post_type; ?>_opt_data[<?php echo $id; ?>][<?php echo $tab_id; ?>][]" id="input-type-1">
        <option value="true" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'true' ); ?>><?php _e('True', 'hsktalents') ?></option>
        <option value="false" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'false' ); ?>><?php _e('False', 'hsktalents') ?></option>
    </select> 
<?php }
/**
* Meta Options Date Format
*/
function hsk_talent_opt_date_field($post_type, $options, $id, $tab_id, $i){ ?>
    <select class="form-control input-type-select-date-format <?php echo $id; ?>" name="<?php echo $post_type; ?>_opt_data[<?php echo $id; ?>][<?php echo $tab_id; ?>][]" id="input-type-1">
        <option value="d_m_y" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'd_m_y' ); ?>><?php _e('DD-MM-YYYY', 'hsktalents'); ?></option>
        <option value="y_m_d" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'y_d_m' ); ?>><?php _e('YYYY-MM-DD', 'hsktalents'); ?></option>
        <option value="m_d_y" <?php selected( ( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ), 'm_d_y' ); ?>><?php _e('MM-DD-YYYY', 'hsktalents'); ?></option>
    </select>    
<?php }
/**
* Meta Options Text Field
*/
function hsk_talent_opt_input_field($class='', $placeholder='', $required='', $type='text', $post_type, $options, $id, $tab_id, $i ){ ?>
    <input class="form-control <?php echo $class.' '.$id; ?>" <?php echo $required; ?> type="<?php echo $type; ?>"  placeholder="<?php echo $placeholder; ?>" name="<?php echo $post_type; ?>_opt_data[<?php echo $id; ?>][<?php echo $tab_id; ?>][]" value="<?php echo !empty($options[$id][$tab_id][$i]) ? $options[$id][$tab_id][$i] :''; ?>" />
<?php }
/**
* Meta Options Textarea Field
*/
function hsk_talent_opt_textarea_field($class='', $placeholder='', $post_type, $options,  $id, $tab_id, $i ){
    echo '<textarea cols="50" rows="3" placeholder="'.$placeholder.'" class="'.$class.' '.$id.'" name="'.$post_type.'_opt_data['.$id.']['.$tab_id.'][]" >'.( !empty($options[$id][$tab_id][$i]) ? trim($options[$id][$tab_id][$i]) : '' ).'</textarea>';
}
?>