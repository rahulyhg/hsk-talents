<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Talent Category Section', 'hsktalents'); ?></h3>
        <div class="inside">
            <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('The below setting applied for "Talents Taxonomy" pages (For taxonomy pages Goto > Appearance > menu)', 'hsktalents'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="display_cat_columns"><?php _e('Display Columns', 'hsktalents'); ?></label></th>
                    <td>
                        <select name="display_cat_columns" id="display_cat_columns">
                            <option value="8" <?php selected('8', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>      <?php esc_html_e('8', 'hsktalents') ?>  </option>
                            <option value="7" <?php selected('7', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>   <?php esc_html_e('7', 'hsktalents') ?>  </option>
                            <option value="6" <?php selected('6', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>   <?php esc_html_e('6', 'hsktalents') ?>  </option>
                            <option value="5" <?php selected('5', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>   <?php esc_html_e('5', 'hsktalents') ?>  </option>
                            <option value="4" <?php selected('4', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>      <?php esc_html_e('4', 'hsktalents') ?>  </option>
                            <option value="3" <?php selected('3', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>   <?php esc_html_e('3', 'hsktalents') ?>  </option>
                            <option value="2" <?php selected('2', isset($settings["display_cat_columns"]) ? $settings["display_cat_columns"] : '') ?>>   <?php esc_html_e('2', 'hsktalents') ?>  </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="cat_height"><?php _e('Images Height', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="cat_height" name="cat_height" value="<?php echo isset($settings['cat_height']) ? esc_html( stripslashes( $settings["cat_height"] ) ) : '500'; ?>" />px
                    </td>
                </tr>
                 <tr>
                    <th><label for="cat_limit"><?php _e('Limit Images', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="cat_limit" name="cat_limit" value="<?php echo isset($settings['cat_limit']) ? esc_html( stripslashes( $settings["cat_limit"] ) ) : '100'; ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Talent Single Page Settings -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Talents Single Page Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <?php _e('Click this attatchment for more ', 'hsktalents'); ?><a target="_blnak" href="<?php echo HSK_PLUGIN_PATH . 'admin/assests/images/talent-single-page.jpg'; ?>"><?php _e(' information', 'hsktalents') ?></a>
            <table class="form-table">
                <tr>
                    <th><label for="disable_talents_favourite_button"><?php _e('Disable Favourite Button', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talents_favourite_button" name="disable_talents_favourite_button" value="1"<?php checked( 1 == ( isset( $settings['disable_talents_favourite_button'] ) ? $settings['disable_talents_favourite_button'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_favarative_button_text"><?php _e('favourite Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_favarative_button_text" name="talent_favarative_button_text" value="<?php echo isset($settings['talent_favarative_button_text']) ? esc_html( stripslashes( $settings["talent_favarative_button_text"] ) ) : __('Favarative', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="disable_talents_followers"><?php _e('Disable Following / Followers Section ', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talents_followers" name="disable_talents_followers" value="1"<?php checked( 1 == ( isset( $settings['disable_talents_followers'] ) ? $settings['disable_talents_followers'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_following_button_text"><?php _e('Following Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_following_button_text" name="talent_following_button_text" value="<?php echo isset($settings['talent_following_button_text']) ? esc_html( stripslashes( $settings["talent_following_button_text"] ) ) : __('Following', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="disable_talents_enquiry"><?php _e('Disable Talents Enquiry Section', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talents_enquiry" name="disable_talents_enquiry" value="1"<?php checked( 1 == ( isset( $settings['disable_talents_enquiry'] ) ? $settings['disable_talents_enquiry'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_enquiry_button_text"><?php _e('Enquiry Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_enquiry_button_text" name="talent_enquiry_button_text" value="<?php echo isset($settings['talent_enquiry_button_text']) ? esc_html( stripslashes( $settings["talent_enquiry_button_text"] ) ) : __('En', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="disable_talents_social_share"><?php _e('Disable Talents Social Share Section', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talents_social_share" name="disable_talents_social_share" value="1"<?php checked( 1 == ( isset( $settings['disable_talents_social_share'] ) ? $settings['disable_talents_social_share'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_share_button_text"><?php _e('Share On Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_share_button_text" name="talent_share_button_text" value="<?php echo isset($settings['talent_share_button_text']) ? esc_html( stripslashes( $settings["talent_share_button_text"] ) ) : __('Share On', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="disable_titlebar_talent_img"><?php _e('Disable Titlebar Talent Image', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_titlebar_talent_img" name="disable_titlebar_talent_img" value="1"<?php checked( 1 == ( isset( $settings['disable_titlebar_talent_img'] ) ? $settings['disable_titlebar_talent_img'] : '0' ) ); ?> />
                    </td>
                </tr>
                <!-- Rating -->
                <tr>
                    <th><label for="disable_talents_rating"><?php _e('Disable Talents Rating Section', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talents_rating" name="disable_talents_rating" value="1"<?php checked( 1 == ( isset( $settings['disable_talents_rating'] ) ? $settings['disable_talents_rating'] : '0' ) ); ?> />
                    </td>
                </tr>

                <tr>
                    <th><label for="review_rating_text_change"><?php _e('Review & Rating Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="review_rating_text_change" placeholder="<?php _e('Review & Rating', 'hsktalents'); ?>" name="review_rating_text_change" value="<?php echo isset($settings['review_rating_text_change']) ? esc_html( stripslashes( $settings["review_rating_text_change"] ) ) : __('Review & Rating', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <!-- Account ID Chanage Text --> 
                <tr>
                    <th><label for="disable_talent_unique_id"><?php _e('Disable Talent Unique ID', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_talent_unique_id" name="disable_talent_unique_id" value="1"<?php checked( 1 == ( isset( $settings['disable_talent_unique_id'] ) ? $settings['disable_talent_unique_id'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_account_id_text"><?php _e('Account ID Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_account_id_text" placeholder="<?php _e('Account ID Text Change', 'hsktalents'); ?>" name="talent_account_id_text" value="<?php echo isset($settings['talent_account_id_text']) ? esc_html( stripslashes( $settings["talent_account_id_text"] ) ) : __('Account ID', 'hsktalents'); ?>" />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_unique_id_prefix"><?php _e('Talent Unique ID Prefix', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_unique_id_prefix" name="talent_unique_id_prefix" value="<?php echo isset($settings['talent_unique_id_prefix']) ? esc_html( stripslashes( $settings["talent_unique_id_prefix"] ) ) : 'HSK'; ?>" />
                    </td>
                </tr>
                <!-- VIews Chanage Text --> 
                
                <tr>
                    <th><label for="diable_talent_views"><?php _e('Disable Talent Views', 'hsktalents'); ?></label></th>
                    <td>
                         <input type="checkbox" id="diable_talent_views" name="diable_talent_views" value="1"<?php checked( 1 == ( isset( $settings['diable_talent_views'] ) ? $settings['diable_talent_views'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_views_text"><?php _e('Talents Views Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_views_text" placeholder="<?php _e('Talents Views Text Change', 'hsktalents'); ?>" name="talent_views_text" value="<?php echo isset($settings['talent_views_text']) ? esc_html( stripslashes( $settings["talent_views_text"] ) ) : __('Views', 'hsktalents'); ?>" />
                    </td>
                </tr>
                
                <!-- Dedication Chanage Text --> 
                
                <tr>
                    <th><label for="diable_talent_dedication"><?php _e('Disable Talent Dedication', 'hsktalents'); ?></label></th>
                    <td>
                         <input type="checkbox" id="diable_talent_dedication" name="diable_talent_dedication" value="1"<?php checked( 1 == ( isset( $settings['diable_talent_dedication'] ) ? $settings['diable_talent_dedication'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="talent_dedication_text"><?php _e('Talent Dedication Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="talent_dedication_text" placeholder="<?php _e('Talent Dedication Text Change', 'hsktalents'); ?>" name="talent_dedication_text" value="<?php echo isset($settings['talent_dedication_text']) ? esc_html( stripslashes( $settings["talent_dedication_text"] ) ) : __('Dedication', 'hsktalents'); ?>" />
                    </td>
                </tr>
                
                <!-- Fallow Us Buttons -->
                 <tr>
                    <th><label for="disable_follows_on_section"><?php _e('Disable Follows Us On Section', 'hsktalents'); ?></label></th>
                    <td>
                       <input type="checkbox" id="disable_follows_on_section" name="disable_follows_on_section" value="1"<?php checked( 1 == ( isset( $settings['disable_follows_on_section'] ) ? $settings['disable_follows_on_section'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr>
                    <th><label for="change_follows_on_text"><?php _e('Follow Us On Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="change_follows_on_text" placeholder="<?php _e('Follow Us On', 'hsktalents'); ?>"name="change_follows_on_text" value="<?php echo isset($settings['change_follows_on_text']) ? esc_html( stripslashes( $settings["change_follows_on_text"] ) ) : __('Follow Us On', 'hsktalents'); ?>" />
                    </td>
                </tr>

                <!-- Tags -->
                 <tr>
                    <th><label for="disable_tags_section"><?php _e('Disable Tags Section', 'hsktalents'); ?></label></th>
                    <td>
                       <input type="checkbox" id="disable_tags_section" name="disable_tags_section" value="1"<?php checked( 1 == ( isset( $settings['disable_tags_section'] ) ? $settings['disable_tags_section'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr class="change_tags_text">
                    <th><label for="change_tags_text"><?php _e('Tags Text Change', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="change_tags_text" placeholder="<?php _e('Tags', 'hsktalents'); ?>" name="change_tags_text" value="<?php echo isset($settings['change_tags_text']) ? esc_html( stripslashes( $settings["change_tags_text"] ) ) : __('Tags', 'hsktalents'); ?>" />
                    </td>
                </tr>

                <!-- Related Talents Section -->
                 <tr>
                    <th><label for="disable_related_talents"><?php _e('Disable Related Talents', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="checkbox" id="disable_related_talents" name="disable_related_talents" value="1"<?php checked( 1 == ( isset( $settings['disable_related_talents'] ) ? $settings['disable_related_talents'] : '0' ) ); ?> />
                    </td>
                </tr>
                <tr class="related_talents_title">
                    <th><label for="related_talents_title"><?php _e('Related Posts Talents Title', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="related_talents_title" name="related_talents_title" value="<?php echo isset($settings['related_talents_title']) ? esc_html( stripslashes( $settings["related_talents_title"] ) ) : __('Related Talents', 'hsktalents'); ?>" />
                    </td>
                </tr>   
            </table>
        </div>
    </div>
</div>