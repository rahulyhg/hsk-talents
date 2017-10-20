<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('General Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th><label for="user_logged_in_msg"><?php _e('User Logged In Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="user_logged_in_msg" name="user_logged_in_msg" cols="100" rows="2"><?php echo isset($settings['user_logged_in_msg']) ? esc_html( stripslashes( $settings["user_logged_in_msg"] ) ) : __('Please, you must login', 'hsktalents'); ?></textarea>
                    </td>
                </tr>
                <!--  facebook id -->
                <tr>
                    <th><label for="hsk_facebook_app_id"><?php _e('Add Your Facebook App Id', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="hsk_facebook_app_id" name="hsk_facebook_app_id" value="<?php echo isset($settings['hsk_facebook_app_id']) ? esc_html( stripslashes( $settings["hsk_facebook_app_id"] ) ) : ''; ?>" />
                    </td>
                </tr>
                <!-- Disable single page facebook comments -->
                <tr>
                    <th><label for="enable_single_page_comments"><?php _e('Enable Single Page Facebook Comments', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="enable_single_page_comments" name="enable_single_page_comments" value="1"<?php checked( 1 == ( isset( $settings['enable_single_page_comments'] ) ? $settings['enable_single_page_comments'] : '0' ) ); ?> />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>