<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Favourite (Shortlist) Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <!-- Disable Favouritive Section -->
                <tr>
                    <th><label for="disable_favourite_section"><?php _e('Disable Favourite Section', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_favourite_section" name="disable_favourite_section" value="1"<?php checked( 1 == ( isset( $settings['disable_favourite_section'] ) ? $settings['disable_favourite_section'] : '0' ) ); ?> />
                        <?php echo '<br /><small>'.__('Disable all Favourite( Shortlist ) section in theme', 'hsktalents').'</small>'; ?>
                    </td>
                </tr>
                <!-- Favouritive Page Link Selection -->
                <tr>
                    <th scope="row"><label for="favourite_page_link"><?php echo __('Choose Favourite Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('favourite');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["favourite_page_link"]) ? esc_html( stripslashes( $settings["favourite_page_link"] ) ) :$page_id,
                            'echo'                  => 0,
                            'name'                  => 'favourite_page_link',
                            'id'                    => 'favourite_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Favourite Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Favorative Page buttons settings -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Favourite (Shortlist) Page Buttons Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">

                <!-- Disable Favouritive Section -->
                <tr>
                    <th><label for="disable_clear_favouritive"><?php _e('Disable Clear Favourite', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_clear_favouritive" name="disable_clear_favouritive" value="1"<?php checked( 1 == ( isset( $settings['disable_clear_favouritive'] ) ? $settings['disable_clear_favouritive'] : '0' ) ); ?> />
                        <?php echo '<br /><small>'.__('Disable Clear Favourite Button', 'hsktalents').'</small>'; ?>
                    </td>
                </tr>
                <!-- Clear List Section-->
                <tr>
                    <th><label for="clear_favouritive_text"><?php _e('Clear favouritive Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="clear_favouritive_text" name="clear_favouritive_text" value="<?php echo isset($settings['clear_favouritive_text']) ? esc_html( stripslashes( $settings["clear_favouritive_text"] ) ) : __('Clear favouritive', 'hsktalents'); ?>" />
                    </td>
                </tr>

                <!-- Disable Favouritive Section -->
                <tr>
                    <th><label for="disable_email_favouritive"><?php _e('Disable Share Favourite Button', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_email_favouritive" name="disable_email_favouritive" value="1"<?php checked( 1 == ( isset( $settings['disable_email_favouritive'] ) ? $settings['disable_email_favouritive'] : '0' ) ); ?> />
                        <?php echo '<br /><small>'.__('Disable Share Favourite Button', 'hsktalents').'</small>'; ?>
                    </td>
                </tr>
                <!-- Share List Section-->
                <tr>
                    <th><label for="share_favouritive_text"><?php _e('Share favouritive Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="share_favouritive_text" name="share_favouritive_text" value="<?php echo isset($settings['share_favouritive_text']) ? esc_html( stripslashes( $settings["share_favouritive_text"] ) ) : __('Share favouritive', 'hsktalents'); ?>" />
                    </td>
                </tr>

                <!-- Disable Favouritive Section -->
                <tr>
                    <th><label for="disable_print_favouritive"><?php _e('Disable Print Button', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_print_favouritive" name="disable_print_favouritive" value="1"<?php checked( 1 == ( isset( $settings['disable_print_favouritive'] ) ? $settings['disable_print_favouritive'] : '0' ) ); ?> />
                        <?php echo '<br /><small>'.__('Disable Clear Favourite Button', 'hsktalents').'</small>'; ?>
                    </td>
                </tr>
                <!-- print List Section-->
                <tr>
                    <th><label for="print_favouritive_text"><?php _e('Print Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="print_favouritive_text" name="print_favouritive_text" value="<?php echo isset($settings['print_favouritive_text']) ? esc_html( stripslashes( $settings["print_favouritive_text"] ) ) : __('Print favouritive', 'hsktalents'); ?>" />
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>

<!-- Form Color Section -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Favourite Page Buttons Color Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th><label for="favourite_buttons_bg_color"><?php _e('Buttons Background Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="favourite_buttons_bg_color" name="favourite_buttons_bg_color" value="<?php echo isset($settings['favourite_buttons_bg_color']) ? esc_html( stripslashes( $settings["favourite_buttons_bg_color"] ) ) : '#fcfcfc'; ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th><label for="favourite_buttons_color"><?php _e('Buttons Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="favourite_buttons_color" name="favourite_buttons_color" value="<?php echo isset($settings['favourite_buttons_color']) ? esc_html( stripslashes( $settings["favourite_buttons_color"] ) ) : '#fcfcfc'; ?>" />
                    </td>
                </tr>
                
                <tr>
                    <th><label for="favourite_buttons_hover_color"><?php _e('Buttons Hover Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="favourite_buttons_hover_color" name="favourite_buttons_hover_color" value="<?php echo isset($settings['favourite_buttons_hover_color']) ? esc_html( stripslashes( $settings["favourite_buttons_hover_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>


            </table>
        </div>
    </div>
</div>