<!-- Search Form Form Color Section -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Search Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th><label for="disable_search"><?php _e('Disable Search', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_search" name="disable_search" value="1"<?php checked( 1 == ( isset( $settings['disable_search'] ) ? $settings['disable_search'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_button_text"><?php _e('Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="search_button_text" name="search_button_text" value="<?php echo isset($settings['search_button_text']) ? esc_html( stripslashes( $settings["search_button_text"] ) ) : __('Search', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_bg_color"><?php _e('Form Background Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_bg_color" name="search_form_bg_color" value="<?php echo isset($settings['search_form_bg_color']) ? esc_html( stripslashes( $settings["search_form_bg_color"] ) ) : '#16202a'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_label_color"><?php _e('Form Label Colors', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_label_color" name="search_form_label_color" value="<?php echo isset($settings['search_form_label_color']) ? esc_html( stripslashes( $settings["search_form_label_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_fields_border_color"><?php _e('Form Fields Border Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_fields_border_color" name="search_form_fields_border_color" value="<?php echo isset($settings['search_form_fields_border_color']) ? esc_html( stripslashes( $settings["search_form_fields_border_color"] ) ) : '#f2f3ee'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_fields_color"><?php _e('Form Fields Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_fields_color" name="search_form_fields_color" value="<?php echo isset($settings['search_form_fields_color']) ? esc_html( stripslashes( $settings["search_form_fields_color"] ) ) : '#404040'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_button_bg_color"><?php _e('Form Button BG Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_button_bg_color" name="search_form_button_bg_color" value="<?php echo isset($settings['search_form_button_bg_color']) ? esc_html( stripslashes( $settings["search_form_button_bg_color"] ) ) : '#d22978'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="search_form_button_color"><?php _e('Form Button Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="search_form_button_color" name="search_form_button_color" value="<?php echo isset($settings['search_form_button_color']) ? esc_html( stripslashes( $settings["search_form_button_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
</div>