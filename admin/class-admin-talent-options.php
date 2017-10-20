<?php
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly.
}
/**
* Talent form options class
*/
ob_start(); 
if( !class_exists('HSK_Talent_Opt_Form') ){
    class HSK_Talent_Opt_Form {
        protected $reg_settings = 'talent_meta_options';
        protected $options_data = 'talent_opt_data';
        function __construct(){
            add_action( 'admin_init' , array( $this, 'hsk_talent_opt_init' ) );
            add_action( 'admin_menu' , array( $this, 'hsk_talent_opt_talent_cpt_menu' ) );
        }
        function hsk_talent_opt_init(){
            register_setting( $this->reg_settings, $this->options_data,  array( $this,'hsk_talent_opt_validate') );
        }
        function hsk_talent_opt_talent_cpt_menu() {
            add_submenu_page('edit.php?post_type=talent',  __('Options', 'hsktalents'), __('Options', 'hsktalents'), 'manage_options', 'talent_options_page',  array( $this,'talent_meta_opt_form_section'));
            add_submenu_page('edit.php?post_type=talent', __('Import', 'hsktalents'), __('Import', 'hsktalents'), 'edit_theme_options', 'talent-import', array( &$this,'hsk_talent_opt_import'));
            add_submenu_page('edit.php?post_type=talent', __('Export', 'hsktalents'), __('Export', 'hsktalents'), 'edit_theme_options', 'talent-export', array( &$this,'hsk_talent_opt_export'));
        }
        function hsk_talent_opt_export(){
            hsk_talent_opt_data_export('talent');
        }
        function hsk_talent_admin_meta_options($options, $tab_id, $i){ ?>
            <tr class="options_fields_group">
                <td><img src="<?php echo HSK_PLUGIN_PATH.'/admin/assests/images/drag.gif'; ?>"></td>
                <td>
                    <?php  
                    $options_arg = array('text'=>'true', 'select'=>'true', 'checkbox'=>'true', 'date_cal'=>'true', 'dob'=>'true', 'emailid'=>'true', 'phone_number'=>'true','textarea' => 'true', 'images' => 'true', 'videos' => 'true', 'compcard' => 'true');
                       echo !empty($options['talent_meta_field_name'][$tab_id][$i]) ? $options['talent_meta_field_name'][$tab_id][$i] :''; 
                     ?>
                </td>
                <td> <span> <?php echo !empty($options['talent_meta_label_name'][$tab_id][$i]) ? $options['talent_meta_label_name'][$tab_id][$i] :''; ?> </span>
                    <?php 
                    //hsk_talent_opt_input_field('input_field_label_name', 'Label Name( required )', '', 'text', 'talent', $options, 'talent_meta_label_name', $tab_id, $i );
                    

                    echo '<div class="hsk-options-group-fields">';
                        //hsk_talent_opt_input_field('options_fields_title', 'Heading', '', 'text', 'talent', $options, 'talent_options_field_heading', $tab_id, $i );
                        echo '<div class="hsk-group-field-option">';
                            echo '<label>'.__('Label Name( required )', 'hsktalents').'</label>';
                            hsk_talent_opt_input_field('input_field_label_name', __('Label Name( required )', 'hsktalents'), '', 'text', 'talent', $options, 'talent_meta_label_name', $tab_id, $i );
                        echo '</div>';

                        echo '<div class="hsk-group-field-option">';
                            echo '<label>'.__('Unique Id', 'hsktalents').'</label>';
                            hsk_talent_opt_input_field('input_field_uid_name', '', '', 'text', 'talent', $options, 'talent_meta_label_uid', $tab_id, $i );
                        echo '</div>';

                        echo '<div class="hsk-group-field-option">';
                            echo '<label>'.__('Field Type', 'hsktalents').'</label>';
                            hsk_talent_opt_list_box('talent', $options, 'talent_meta_field_name', $tab_id, $i, $options_arg );
                        echo '</div>';
                        
                        echo '<div class="hsk-group-field-option select_field_select_options talent_meta_field_options">';
                            echo '<label>'.__('Options Area', 'hsktalents').'</label>';    
                            hsk_talent_opt_textarea_field('select_field_select_options', 'Each option on a new line', 'talent', $options, 'talent_meta_field_options', $tab_id, $i );
                        echo '</div>';
                        echo '<div class="hsk-group-field-option input-type-select-date-format talent_meta_field_date_format">';
                            echo '<label>'.__('Date Format', 'hsktalents').'</label>';
                            hsk_talent_opt_date_field('talent', $options, 'talent_meta_field_date_format', $tab_id, $i);
                        echo '</div>';
                        echo '<div class="hsk-group-field-option talent_option_rquired">';
                            echo '<label>'.__('Required', 'hsktalents').'</label>';
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_rquired', $tab_id, $i);
                        echo '</div>';
                       echo '<div class="hsk-group-field-option talent_option_display_search">';
                            echo '<label>'.__('Display On Search', 'hsktalents').'</label>';
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_display_search', $tab_id, $i);
                        echo '</div>';
                        echo '<div class="hsk-group-field-option talent_option_visibility">'; 
                            echo '<label>'.__('Visibility to Public', 'hsktalents').'</label>';  
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_visibility', $tab_id, $i);
                        echo '</div>';
                        echo '<div class="hsk-group-field-option talent_option_search_range">'; 
                            echo '<label>'.__('Search Range', 'hsktalents').'</label>';   
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_search_range', $tab_id, $i);
                        echo '</div>';
                        /*echo '<div class="hsk-group-field-option talent_option_dsiplay_compcard">';
                            echo '<label>'.__('Show on Compard ', 'hsktalents').'</label>';
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_dsiplay_compcard', $tab_id, $i);
                        echo '</div>'; */
                        echo '<div class="hsk-group-field-option talent_option_dsiplay_on_img">';
                            echo '<label>'.__('Thumbnail Info', 'hsktalents').'</label>';    
                            hsk_talent_opt_select_box('talent', $options, 'talent_option_dsiplay_on_img', $tab_id, $i);
                        echo '</div>';  
                        echo '<div class="hsk-group-field-option hsk-user-roles-limits-info input_field_user_role_name">';
                            $roles = get_editable_roles();
                            echo '<ul>';
                                echo '<h5>'.__('Images / Videos Limit Information Based on User Roles', 'hsktalents').'</h5>';
                                foreach ($roles as $role_key => $role) {
                                    echo '<li>';
                                    echo '<label>'.$role['name'].' '.__('Limit','hsktalents').'</label>';
                                    hsk_talent_opt_input_field('input_field_user_role_name', '', '', 'text', 'talent', $options, 'talent_images_'.$role_key.'_limit', $tab_id, $i );
                                    echo '</li>';
                                }
                            echo '</ul>';
                        echo '</div>';    
                        echo '<a href="#" class="button-primary hsk-button-add">'.__('Update Field', 'hsktalents').'</a>';
                        ?>
                    </div>    
                </td>
                <td>
                    <?php echo !empty($options['talent_meta_label_uid'][$tab_id][$i]) ? $options['talent_meta_label_uid'][$tab_id][$i] :'';  ?>
                </td>
                <td class="fields_options_edit">
                    <a href="#" class="edit"><span class="dashicons dashicons-admin-generic"></span></a>
                </td>
                <td class="fields_options_delete">
                    <a href="#" class="delete">X</a>
                </td>
            </tr>
        <?php  }
        function talent_meta_opt_form_section(){   ?>
                <div class="wrap hsk-meta-options-form-group">
                <h2><?php _e('Talent Form Fields','hsktalents'); ?></h2>
                <?php $model_options_data = ''; 
                if ( isset( $_GET['settings-updated'] ) ) {
                    echo "<div class='updated notice is-dismissible'><p>".esc_html__('All Options are successfully saved','hsktalents')."</p></div>";
                } ?>
                <form method="post" action="options.php">
                    <?php settings_fields($this->reg_settings);
                    $options = get_option($this->options_data);
                    //print_r($options);
                    $count=count($options['talent_meta_label_name']); 
                     $tabs_name_count= !empty( $options['tabs_name'] ) ? count($options['tabs_name']) : '';  ?>
                    <div class="hsk_create_opt_fields">
                        <div class="custom_options_field">
                    <div class="generate-tab-new-fields generate-tab-new-fields_0">
                        <input type="text" class="field_group_tab_name" placeholder="<?php _e('Field Group Title', 'hsktalents'); ?>" name="talent_opt_data[tabs_name][]" value="" />
                        <input type="hidden" class="field_group_tab_uid" name="talent_opt_data[tabs_uid][]" value="" />
                        <table class="table widefat">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><?php _e('Field Type', 'hsktalents'); ?></th>
                                    <th><?php _e('Name', 'hsktalents'); ?></th>
                                    <th><?php _e('Field ID', 'hsktalents'); ?></th>
                                    <th><?php _e('Edit', 'hsktalents'); ?></th>
                                    <th><?php _e('Delete', 'hsktalents'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="hsk-options-sortable" class="ui-sortable"> 
                                <?php $i=0;
                                $tab = $tabs_name_count;
                                echo $this->hsk_talent_admin_meta_options($options, $tab, $i); ?>
                            </tbody>                
                        </table>
                        <?php
                       echo '<div class="form-opt-add-button-group"><a href="#" class="add_icon button button-primary" id="create_option">+</a>';
                         echo '<a href="#" class="delete_icon button button-primary" id="delete_options_group">-</a>';
                         echo '</div>';
                    echo '</div>'; ?>
                     
                    <!-- End -->    
                   <?php
                   for ($tab=1; $tab < 100; $tab++) { 
                   if( ( !empty($options['tabs_name'][$tab]) ) &&  ( $options['tabs_name'][$tab] != 'Array') &&  ( $options['tabs_name'][$tab] != '') &&  ( !is_array($options['tabs_name'][$tab]) )){  
                    ?>
                       <div class="generate-tab-new-fields generate-tab-new-fields_<?php echo $tab; ?>">
                        <input type="text"  class="field_group_tab_name" name="talent_opt_data[tabs_name][]" placeholder="<?php _e('Field Group Title', 'hsktalents'); ?>" value="<?php echo $options['tabs_name'][$tab] ?>" />
                        <input type="hidden"  class="field_group_tab_uid" name="talent_opt_data[tabs_uid][]" value="<?php echo $options['tabs_uid'][$tab] ?>" />
                        <table class="table widefat">
                            <thead>
                                <tr>
                                    <tr>
                                    <th></th>                                    
                                    <th><?php _e('Field Type', 'hsktalents'); ?></th>
                                    <th><?php _e('Name', 'hsktalents'); ?></th>
                                    <th><?php _e('Field ID', 'hsktalents'); ?></th>
                                    <th><?php _e('Edit', 'hsktalents'); ?></th>
                                    <th><?php _e('Delete', 'hsktalents'); ?></th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody id="hsk-options-sortable" class="ui-sortable"> 
                                <?php $i=0;
                                $tab_data = $options['tabs_uid'][$tab];
                                echo $this->hsk_talent_admin_meta_options($options, $tab_data, $i); ?>
                                <?php for ($i=1; $i < 100; $i++) { 
                                    echo $opt_data = isset($options['talent_meta_label_name'][$tab][$i]) ? $options['talent_meta_label_name'][$tab][$i] : '';
                                      if( ( !empty($options['talent_meta_label_name'][$tab_data][$i]) ) &&  ( $options['talent_meta_label_name'][$tab_data][$i] != 'Array') &&  ( $options['talent_meta_label_name'][$tab_data][$i] != '') &&  ( !is_array($options['talent_meta_label_name'][$tab_data][$i]) )){ 
                                        echo $this->hsk_talent_admin_meta_options($options, $tab_data, $i);
                                    }
                                } ?>
                            </tbody>                
                        </table>
                        <?php
                        echo '<div class="form-opt-add-button-group"><a href="#" class="add_icon button button-primary" id="create_option">+</a>';
                         echo '<a href="#" class="delete_icon button button-primary" id="delete_options_group">-</a>';
                         echo '</div>';
                    echo '</div>';     }
                }
               
                    echo '</div>';
                    echo '<div class="talent_opt_field_gname"><a href="#" class="add_icon button button-primary" id="talent_opt_field_gname">'.__('Add Group', 'hsktalents').'</a>';
                        echo '<p class="submit">
                        <input type="submit" class="button-primary form-opt-save" value="'.__('Save Changes','hsktalents').'" />
                        </p></div>'; ?>
                   <?php echo '</div>'; ?>
                </form>
            </div>
        <?php   
        }
        function hsk_talent_opt_validate($input) {     
            return $input;
        }
        function hsk_talent_opt_import() {
            hsk_talents_import_meta_options('talent');
        }
    }
}
new HSK_Talent_Opt_Form;
?>