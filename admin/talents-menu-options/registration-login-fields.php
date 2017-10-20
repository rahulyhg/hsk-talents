<!-- Registration Form -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('User Registration Settings', 'hsktalents'); ?><span> </span></h3>
        <div class="inside">
            <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('The below setting applied for registration pages only', 'hsktalents'); ?></p>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="reg_page_link"><?php echo __('Choose Registration Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('register');
                        //print_r($page_id);
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => !empty($settings["reg_page_link"]) ? esc_html( stripslashes( $settings["reg_page_link"] ) ) :$page_id,
                            'echo'                  => 0,
                            'name'                  => 'reg_page_link',
                            'id'                    => 'reg_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Registration Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Select user registration page, it will display header top right postion', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="email_validate_error"><?php _e('Email Validate Error Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="email_validate_error" name="email_validate_error" cols="100" rows="2"><?php echo isset($settings['email_validate_error']) ? esc_html( stripslashes( $settings["email_validate_error"] ) ) : __('Enter Valid Email', 'hsktalents'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="email_exist_error"><?php _e('Email Exist Error Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="email_exist_error" name="email_exist_error" cols="100" rows="2"><?php echo isset($settings['email_exist_error']) ? esc_html( stripslashes( $settings["email_exist_error"] ) ) : __('Email Already Exist', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Email already exist error message', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="user_exist_error"><?php _e('User Exist Error Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="user_exist_error" name="user_exist_error" cols="100" rows="2"><?php echo isset($settings['user_exist_error']) ? esc_html( stripslashes( $settings["user_exist_error"] ) ) : __('User Already Exist', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('User name already exist error message', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="reg_success_msg"><?php _e('Registration Success Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="reg_success_msg" name="reg_success_msg" cols="100" rows="2"><?php echo isset($settings['reg_success_msg']) ? esc_html( stripslashes( $settings["reg_success_msg"] ) ) : __('You Have Registred Successfully, Please Login with your login credentials', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Success message for, when user registration completed successfully', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="reg_email_subject"><?php _e('Email Subject', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="reg_email_subject" name="reg_email_subject" cols="100" rows="2"><?php echo isset($settings['reg_email_subject']) ? esc_html( stripslashes( $settings["reg_email_subject"] ) ) : __('User Login Details', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('email Subject message for registred users', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="reg_email_message"><?php _e('After Registration Email Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="reg_email_message" name="reg_email_message" cols="100" rows="2"><?php echo isset($settings['reg_email_message']) ? esc_html( stripslashes( $settings["reg_email_message"] ) ) : __('Registration Email Body', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Email message for, registerd users only', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="reg_button_text"><?php _e('Registration Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="reg_button_text" name="reg_button_text" value="<?php echo isset($settings['reg_button_text']) ? esc_html( stripslashes( $settings["reg_button_text"] ) ) : __('Register Me', 'hsktalents'); ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- End -->
<!-- Login Form -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('User Login Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="login_page_link"><?php echo __('Choose Login Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('login');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["login_page_link"]) ? esc_html( stripslashes( $settings["login_page_link"] ) ) :$page_id,
                            'echo'                  => 0,
                            'name'                  => 'login_page_link',
                            'id'                    => 'login_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Login Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="login_success_page_redirect"><?php echo __('After Login Redirect Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('login');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["login_success_page_redirect"]) ? esc_html( stripslashes( $settings["login_success_page_redirect"] ) ) :'',
                            'echo'                  => 0,
                            'name'                  => 'login_success_page_redirect',
                            'id'                    => 'login_success_page_redirect', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('After Login Redirect Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Select user login page, it will display header top right postion', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="login_error_msg"><?php _e('Login Failure Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="login_error_msg" name="login_error_msg" cols="100" rows="2"><?php echo isset($settings['login_error_msg']) ? esc_html( stripslashes( $settings["login_error_msg"] ) ) : __('Error Login, Please check your user name / password.', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Error message display, when user enter invalid username / password', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="login_success_msg"><?php _e('Login Success Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="login_success_msg" name="login_success_msg" cols="100" rows="2"><?php echo isset($settings['login_success_msg']) ? esc_html( stripslashes( $settings["login_success_msg"] ) ) : __('Pleas Wait, you are logging ', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Success message display, when user enter current username & password and it redirecting.', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="login_button_text"><?php _e('Login Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="login_button_text" name="login_button_text" value="<?php echo isset($settings['login_button_text']) ? esc_html( stripslashes( $settings["login_button_text"] ) ) : __('Login', 'hsktalents'); ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- End-->
<!-- Login Form -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Forgot Password Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="forgot_password_page_link"><?php echo __('Forgot Password Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('forgot-password');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["forgot_password_page_link"]) ? esc_html( stripslashes( $settings["forgot_password_page_link"] ) ) :$page_id,
                            'echo'                  => 0,
                            'name'                  => 'forgot_password_page_link',
                            'id'                    => 'forgot_password_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Forgot Password Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                    </td>
                </tr>
                <tr>
                    <th><label for="forgot_password_form_msg"><?php _e('Forgot Password Form Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="forgot_password_form_msg" name="forgot_password_form_msg" cols="100" rows="2"><?php echo isset($settings['forgot_password_form_msg']) ? esc_html( stripslashes( $settings["forgot_password_form_msg"] ) ) : __('Please Enter your email id, the password will send your email', 'hsktalents'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="forgot_password_button_text"><?php _e('Forgot Password Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="forgot_password_button_text" name="forgot_password_button_text" value="<?php echo isset($settings['forgot_password_button_text']) ? esc_html( stripslashes( $settings["forgot_password_button_text"] ) ) : __('Forgot Password', 'hsktalents'); ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Profile Page Settings -->
<!-- Login Form -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Profile Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="profile_page_link"><?php echo __('Profile Page','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('my-profile');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["profile_page_link"]) ? esc_html( stripslashes( $settings["profile_page_link"] ) ) :$page_id,
                            'echo'                  => 0,
                            'name'                  => 'profile_page_link',
                            'id'                    => 'profile_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Profile Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Select user Profile page, it will display header top right postion after user logged in', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="profile_profile_note"><?php _e('user profile note', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="profile_profile_note" name="profile_profile_note" cols="100" rows="2"><?php echo isset($settings['profile_profile_note']) ? esc_html( stripslashes( $settings["profile_profile_note"] ) ) : ''; ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('user profile note', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="profile_update_success_msg"><?php _e('Profile Update Success Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="profile_update_success_msg" name="profile_update_success_msg" cols="100" rows="2"><?php echo isset($settings['profile_update_success_msg']) ? esc_html( stripslashes( $settings["profile_update_success_msg"] ) ) : __('Your Profile has been updated successfully', 'hsktalents'); ?></textarea>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('suecess message for user after updated profile page, it will display header top right postion after user logged in', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="profile_update_pwd_error"><?php _e('Password Not-Match Error Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="profile_update_pwd_error" name="profile_update_pwd_error" cols="100" rows="2"><?php echo isset($settings['profile_update_pwd_error']) ? esc_html( stripslashes( $settings["profile_update_pwd_error"] ) ) :__('The passwords you entered do not match. Your password was not updated', 'hsktalents'); ?></textarea>
                       
                    </td>
                </tr>
                <tr>
                    <th><label for="profile_update_error_msg"><?php _e('Profile Update Error Message', 'hsktalents'); ?></label></th>
                    <td>
                        <textarea id="profile_update_error_msg" name="profile_update_error_msg" cols="100" rows="2"><?php echo isset($settings['profile_update_error_msg']) ? esc_html( stripslashes( $settings["profile_update_error_msg"] ) ) : __('Error, While updating your profile', 'hsktalents'); ?></textarea>
                         <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Error message for user while updating profile', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="profile_update_button_text"><?php _e('Profile Update Button Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="profile_update_button_text" name="profile_update_button_text" value="<?php echo isset($settings['profile_update_button_text']) ? esc_html( stripslashes( $settings["profile_update_button_text"] ) ) : __('Update Your Profile', 'hsktalents'); ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- Logout Section -->
<!-- Login Form -->
<div id="poststuff" class="ui-sortable meta-box-sortables">
    <div class="postbox">
        <h3><?php _e('Logout Settings', 'hsktalents'); ?></h3>
        <div class="inside">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="logout_page_link"><?php echo __('Logout Redirect Page Link','hsktalents'); ?></label></th>
                    <td>
                        <?php
                        $page_id = hsk_get_id_by_slug('signin');
                        $args = array(
                            'depth'                 => 0,
                            'child_of'              => 0,
                            'selected'              => isset($settings["logout_page_link"]) ? esc_html( stripslashes( $settings["logout_page_link"] ) ) : $page_id,
                            'echo'                  => 0,
                            'name'                  => 'logout_page_link',
                            'id'                    => 'logout_page_link', // string
                            'class'                 => null, // string
                            'show_option_none'      => __('Choose Logout Redirect Page', 'hsktalents'), // string
                            'show_option_no_change' => null, // string
                            'option_none_value'     => null, // string
                        );
                        echo wp_dropdown_pages( $args ); ?>
                        <p><strong class="hsk-hilight"><?php _e('Note: ', 'hsktalents') ?></strong><?php _e('Select user Logout page, it works when user logout.', 'hsktalents'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><label for="logout_button_text"><?php _e('Logout Text', 'hsktalents'); ?></label></th>
                    <td>
                        <input type="text" id="logout_button_text" name="logout_button_text" value="<?php echo isset($settings['logout_button_text']) ? esc_html( stripslashes( $settings["logout_button_text"] ) ) : __('Logout', 'hsktalents'); ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>