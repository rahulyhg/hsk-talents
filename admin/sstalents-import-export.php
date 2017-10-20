<?php
/**
*  Export / Import customz options data
*/
class HSK_Talents_Export_Import
{
    
    function __construct()
    {
        add_action('admin_menu', array(&$this, 'hsk_talent_options_export_page'));
    }
    function hsk_talent_options_export_page() {
        add_management_page( __('HSK-Talents Export', 'hsktalents'), __('HSK-Talents export', 'hsktalents'), 'edit_theme_options', 'hsk-talent-settings-export', array(&$this, 'hsk_talent_export_option_data'));
    }
    function hsk_talent_export_option_data() {
        if (!isset($_POST['hsk-talents-settings-export'])) {  ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"><br /></div>
                <h2><?php _e('Export Options', 'hsktalents'); ?></h2>
                <p><?php _e('When you click Backup all options button, system will generate a JSON file.', 'hsktalents'); ?></p>
                <p><?php _e('After exporting, you can either use the backup file to restore your settings on this site again or another WordPress site.', 'hsktalents') ?></p>
                <form method='post'>
                    <p class="submit">
                        <?php wp_nonce_field('hsk-talents-export'); ?>
                        <input type='submit' name='hsk-talents-settings-export' value='<?php _e('Backup Options', 'hsktalents'); ?>'/>
                    </p>
                </form>
            </div>
            <?php
        }
        elseif (check_admin_referer('hsk-talents-export')) {
            $blogname = str_replace(" ", "", get_option('blogname'));
            $date = date("m-d-Y");
            $json_name = $blogname."-talent-settings-".$date; // Namming the filename will be generated.
            $options = get_option('ss_talents'); // Get all options data, return array
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

// End Class
}
new HSK_Talents_Export_Import;
?>