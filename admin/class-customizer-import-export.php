<?php
/**
*  Export / Import customz options data
*/
class HSK_Customize_Export_Import
{
    
    function __construct()
    {
        add_action('admin_menu', array(&$this, 'hsktalents_hsk_register_menu'));
    }
    function hsktalents_hsk_register_menu() {
        add_theme_page(__('Customize Export', 'hsktalents'), __('Customize Export', 'hsktalents'), 'edit_theme_options', 'hsk-cusomize-export', array(&$this, 'hsktalents_hsk_export_option'));
    }
    function hsktalents_hsk_export_option() {
        if (!isset($_POST['hsk-cusomize-export'])) {  ?>
            <div class="wrap">
                <div id="icon-tools" class="icon32"><br /></div>
                <h2><?php _e('Export Customize Options', 'hsktalents'); ?></h2>
                <p><?php _e('When you click Backup all options button, system will generate a JSON file.', 'hsktalents'); ?></p>
                <p><?php _e('After exporting, you can either use the backup file to restore your settings on this site again or another WordPress site.', 'hsktalents') ?></p>
                <form method='post'>
                    <p class="submit">
                        <?php wp_nonce_field('hsk-cusomize-export'); ?>
                        <input type='submit' name='hsk-cusomize-export' value='<?php _e('Backup Customize Options', 'hsktalents'); ?>'/>
                    </p>
                </form>
            </div>
            <?php
        }
        elseif (check_admin_referer('hsk-cusomize-export')) {
            $blogname = str_replace(" ", "", get_option('blogname'));
            $date = date("m-d-Y");
            $json_name = $blogname."-".$date; // Namming the filename will be generated.
            $options = get_theme_mods(); // Get all options data, return array

            foreach ($options as $key => $value) {
                $value = maybe_unserialize($value);
                $need_options[$key] = $value;
            }
            $need_options['page_on_front'] .= get_option( 'page_on_front' );
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
new HSK_Customize_Export_Import;
?>