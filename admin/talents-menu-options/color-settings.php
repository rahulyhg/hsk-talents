<!-- Form Color Section -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Form Color Section', 'hsktalents'); ?></h3>
        <div class="inside">
        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Colors applied for "Login / Registation / Forgot password and Profile " forms', 'hsktalents') ?></p>
            <table class="form-table">
                <tr>
                    <th><label for="form_fields_bg_color"><?php _e('Form Fields BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="form_fields_bg_color" name="form_fields_bg_color" value="<?php echo isset($settings['form_fields_bg_color']) ? esc_html( stripslashes( $settings["form_fields_bg_color"] ) ) : '#fcfcfc'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="form_fields_border_color"><?php _e('Form Fields Border Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="form_fields_border_color" name="form_fields_border_color" value="<?php echo isset($settings['form_fields_border_color']) ? esc_html( stripslashes( $settings["form_fields_border_color"] ) ) : '#f3f3f3'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="form_fields_color"><?php _e('Form Fields Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="form_fields_color" name="form_fields_color" value="<?php echo isset($settings['form_fields_color']) ? esc_html( stripslashes( $settings["form_fields_color"] ) ) : '#c9c9c9'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="form_field_error_border_color"><?php _e('Form Fields Error Border Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="form_field_error_border_color" name="form_field_error_border_color" value="<?php echo isset($settings['form_field_error_border_color']) ? esc_html( stripslashes( $settings["form_field_error_border_color"] ) ) : '#fcfcfc'; ?>" />
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
</div>

<!-- Talent Detials Section -->
<div id="poststuff" class="ui-sortable meta-box-sortables hsk-taxonomy-admin-colors">
    <div class="postbox">
        <h3><?php _e('Talents Taxonomy Colors', 'hsktalents'); ?></h3> 
        <div class="inside">
            <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Colors applied for Talent taxonomy page.(when add to talent categories to menu( Goto > Appearance > menu ))', 'hsktalents'); ?></p>
            <table class="form-table">
                <tr>
                    <th><label for="talent_details_bg_color"><?php _e('Talents Detials BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_details_bg_color" name="talent_details_bg_color" value="<?php echo isset($settings['talent_details_bg_color']) ? esc_html( stripslashes( $settings["talent_details_bg_color"] ) ) : '#16202a'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_details_color"><?php _e('Talents Details Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_details_color" name="talent_details_color" value="<?php echo isset($settings['talent_details_color']) ? esc_html( stripslashes( $settings["talent_details_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_title_color"><?php _e('Title Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_title_color" name="talent_title_color" value="<?php echo isset($settings['talent_title_color']) ? esc_html( stripslashes( $settings["talent_title_color"] ) ) : '#353535'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_favourite_icon_color"><?php _e('Favarative Icon Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_favourite_icon_color" name="talent_favourite_icon_color" value="<?php echo isset($settings['talent_favourite_icon_color']) ? esc_html( stripslashes( $settings["talent_favourite_icon_color"] ) ) : '#353535'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_favourite_active_icon_color"><?php _e('Favarative Active Icon Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_favourite_active_icon_color" name="form_button_bg_color" value="<?php echo isset($settings['talent_favourite_active_icon_color']) ? esc_html( stripslashes( $settings["talent_favourite_active_icon_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Talent Single page Button Colors -->
<!-- Talent Detials Section -->
<div id="poststuff" class="ui-sortable meta-box-sortables talent-single-page-title-buttons-colors">
    <div class="postbox">
        <h3><?php _e('Talents Single Page Titlebar Buttons Color Section', 'hsktalents'); ?></h3>
        <div class="inside">
        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Colors applied for "Talent Single page" Page titlebar ', 'hsktalents'); ?>
        </p>
            <?php _e('Click this attatchment for more ', 'hsktalents'); ?><a target="_blnak" href="<?php echo HSK_PLUGIN_PATH . 'admin/assests/images/single-page-titlebar.jpg'; ?>"><?php _e(' information', 'hsktalents') ?></a>
         </p>   
            <table class="form-table">

                <tr>
                    <th><label for="talent_titlebar_bg_color"><?php _e('Talent Single Page Titlebar BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_titlebar_bg_color" name="talent_titlebar_bg_color" value="<?php echo isset($settings['talent_titlebar_bg_color']) ? esc_html( stripslashes( $settings["talent_titlebar_bg_color"] ) ) : '#16202a'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_titlebar_img_left_border_color"><?php _e('Talent Single Page Title Image Border Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_titlebar_img_left_border_color" name="talent_titlebar_img_left_border_color" value="<?php echo isset($settings['talent_titlebar_img_left_border_color']) ? esc_html( stripslashes( $settings["talent_titlebar_img_left_border_color"] ) ) : '#ffffff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_titlebar_title_color"><?php _e('Talent Single Page Title Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_titlebar_title_color" name="talent_titlebar_title_color" value="<?php echo isset($settings['talent_titlebar_title_color']) ? esc_html( stripslashes( $settings["talent_titlebar_title_color"] ) ) : '#ffffff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_titlebar_content_color"><?php _e('Talent Single Page Content Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_titlebar_content_color" name="talent_titlebar_content_color" value="<?php echo isset($settings['talent_titlebar_content_color']) ? esc_html( stripslashes( $settings["talent_titlebar_content_color"] ) ) : '#999'; ?>" />
                    </td>
                </tr>

                <tr>
                    <th><label for="talent_titlebar_rating_color"><?php _e('Titlebar Rating Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_titlebar_rating_color" name="talent_titlebar_rating_color" value="<?php echo isset($settings['talent_titlebar_rating_color']) ? esc_html( stripslashes( $settings["talent_titlebar_rating_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_favarative_button_bg_color"><?php _e('Favarative Button BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_favarative_button_bg_color" name="talent_favarative_button_bg_color" value="<?php echo isset($settings['talent_favarative_button_bg_color']) ? esc_html( stripslashes( $settings["talent_favarative_button_bg_color"] ) ) : '#555863'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_favarative_button_color"><?php _e('Favarative Button Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_favarative_button_color" name="talent_favarative_button_color" value="<?php echo isset($settings['talent_favarative_button_color']) ? esc_html( stripslashes( $settings["talent_favarative_button_color"] ) ) : '#353535'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_following_button_bg_color"><?php _e('Following Button BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_following_button_bg_color" name="talent_following_button_bg_color" value="<?php echo isset($settings['talent_following_button_bg_color']) ? esc_html( stripslashes( $settings["talent_following_button_bg_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_following_button_color"><?php _e('Following Button Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_following_button_color" name="talent_following_button_color" value="<?php echo isset($settings['talent_following_button_color']) ? esc_html( stripslashes( $settings["talent_following_button_color"] ) ) : '#353535'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_enquiery_button_bg_color"><?php _e('Enquiery Button BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_enquiery_button_bg_color" name="talent_enquiery_button_bg_color" value="<?php echo isset($settings['talent_enquiery_button_bg_color']) ? esc_html( stripslashes( $settings["talent_enquiery_button_bg_color"] ) ) : '#555863'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_enquiery_button_color"><?php _e('Enquiery Button Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_enquiery_button_color" name="talent_enquiery_button_color" value="<?php echo isset($settings['talent_enquiery_button_color']) ? esc_html( stripslashes( $settings["talent_enquiery_button_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_share_button_bg_color"><?php _e('Shareon Button BG Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_share_button_bg_color" name="talent_share_button_bg_color" value="<?php echo isset($settings['talent_share_button_bg_color']) ? esc_html( stripslashes( $settings["talent_share_button_bg_color"] ) ) : '#353535'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_share_button_color"><?php _e('Share on Button Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_share_button_color" name="talent_share_button_color" value="<?php echo isset($settings['talent_share_button_color']) ? esc_html( stripslashes( $settings["talent_share_button_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Talent Left Section Color Settings -->
<div id="poststuff" class="ui-sortable meta-box-sortables single-page-left-section-colors">
    <div class="postbox">
        <h3><?php _e('Talents Single Page Left Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Colors applied for "Talent Single page" Left Section', 'hsktalents'); ?>
            </p>
            <table class="form-table">
                <tr>
                    <th><label for="talent_left_section_title_bg_color"><?php _e('Title Background Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_title_bg_color" name="talent_left_section_title_bg_color" value="<?php echo isset($settings['talent_left_section_title_bg_color']) ? esc_html( stripslashes( $settings["talent_left_section_title_bg_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_title_color"><?php _e('Title Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_title_color" name="talent_left_section_title_color" value="<?php echo isset($settings['talent_left_section_title_color']) ? esc_html( stripslashes( $settings["talent_left_section_title_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_content_bg_color"><?php _e('Content BG Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_content_bg_color" name="talent_left_section_content_bg_color" value="<?php echo isset($settings['talent_left_section_content_bg_color']) ? esc_html( stripslashes( $settings["talent_left_section_content_bg_color"] ) ) : '#f5f5f5'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_content_color"><?php _e('Content Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_content_color" name="talent_left_section_content_color" value="<?php echo isset($settings['talent_left_section_content_color']) ? esc_html( stripslashes( $settings["talent_left_section_content_color"] ) ) : '#555'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_content_link_color"><?php _e('Content Link Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_content_link_color" name="talent_left_section_content_link_color" value="<?php echo isset($settings['talent_left_section_content_link_color']) ? esc_html( stripslashes( $settings["talent_left_section_content_link_color"] ) ) : '#555'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_content_link_hover_color"><?php _e('Content Link Hover Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_content_link_hover_color" name="talent_left_section_content_link_hover_color" value="<?php echo isset($settings['talent_left_section_content_link_hover_color']) ? esc_html( stripslashes( $settings["talent_left_section_content_link_hover_color"] ) ) : '#555'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_left_section_rating_color"><?php _e('Rating Color ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_left_section_rating_color" name="talent_left_section_rating_color" value="<?php echo isset($settings['talent_left_section_rating_color']) ? esc_html( stripslashes( $settings["talent_left_section_rating_color"] ) ) : '#555'; ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Talent Right Section Color Settings -->
<div id="poststuff" class="ui-sortable meta-box-sortables single-page-right-section-colors">
    <div class="postbox">
        <h3><?php _e('Talents Single Page Right Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Colors applied for "Talent Single page" Right Section', 'hsktalents'); ?>
            </p>
            <table class="form-table">
                <tr>
                    <th><label for="talent_right_section_tabs_bg_color"><?php _e('Tabs Background Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_right_section_tabs_bg_color" name="talent_right_section_tabs_bg_color" value="<?php echo isset($settings['talent_right_section_tabs_bg_color']) ? esc_html( stripslashes( $settings["talent_right_section_tabs_bg_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_right_section_tabs_color"><?php _e('Tabs Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_right_section_tabs_color" name="talent_right_section_tabs_color" value="<?php echo isset($settings['talent_right_section_tabs_color']) ? esc_html( stripslashes( $settings["talent_right_section_tabs_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <!-- Tab Active BG Color -->
                <tr>
                    <th><label for="talent_right_section_tabs_active_bg_color"><?php _e('Tabs Active Background Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_right_section_tabs_active_bg_color" name="talent_right_section_tabs_active_bg_color" value="<?php echo isset($settings['talent_right_section_tabs_active_bg_color']) ? esc_html( stripslashes( $settings["talent_right_section_tabs_active_bg_color"] ) ) : '#d22a78'; ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_right_section_tabs_active_link_color"><?php _e('Tabs Active Link Color', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" class="hsk-talents-color-pickr" id="talent_right_section_tabs_active_link_color" name="talent_right_section_tabs_active_link_color" value="<?php echo isset($settings['talent_right_section_tabs_active_link_color']) ? esc_html( stripslashes( $settings["talent_right_section_tabs_active_link_color"] ) ) : '#fff'; ?>" />
                    </td>
                </tr>
                <!-- End -->
            </table>
        </div>
    </div>
</div>