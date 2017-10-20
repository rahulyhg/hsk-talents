<?php
class HSK_Admin_User_Profile_Fields
{
    public function __construct()
    {
        // add actions for the profile customisation
        add_action( 'personal_options_update', array($this, 'hsk_update_profile_data') );
        add_action( 'edit_user_profile_update', array($this, 'hsk_update_profile_data') );

        add_action('show_user_profile', array($this, 'hsk_user_custom_profile_filds'));
        add_action('edit_user_profile', array($this, 'hsk_user_custom_profile_filds'));
        add_filter('user_contactmethods', array($this, 'hsk_admin_contact_extra_fields'));     
    }

    /**
     * Add new custom fields to the profile page
     *
     * @param $profileuser
     */
    public function hsk_user_custom_profile_filds( $profileuser )
    {
        $hsk_user_info = get_user_meta( $profileuser->ID, 'hsk_user_social_share', true );
        if( is_admin() ){ ?>
            <h2><?php _e('Social Sharing', 'hsktalents'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><label for="hsk_user_facebook"><?php _e('Facebook', 'hsktalents'); ?></label></th>
                    <td><input type="text" name="hsk_user_facebook" id="hsk_user_facebook" value="<?php if(isset($hsk_user_info['hsk_user_facebook'])){ echo esc_attr($hsk_user_info['hsk_user_facebook']); } ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="hsk_user_twitter"><?php _e('Twitter', 'hsktalents'); ?></label></th>
                    <td><input type="text" name="hsk_user_twitter" id="hsk_user_twitter" value="<?php if(isset($hsk_user_info['hsk_user_twitter'])){ echo esc_attr($hsk_user_info['hsk_user_twitter']); } ?>" class="regular-text" /></td>
                </tr>
                <tr>
                    <th><label for="hsk_user_gplus"><?php _e('Google+', 'hsktalents'); ?></label></th>
                    <td><input type="text" name="hsk_user_gplus" id="hsk_user_gplus" value="<?php if(isset($hsk_user_info['hsk_user_gplus'])){ echo esc_attr($hsk_user_info['hsk_user_gplus']); } ?>" class="regular-text" /></td>
                </tr>            
            </table>
        <?php
        }else{
            $user_facebook = isset($hsk_user_info['hsk_user_facebook']) ? esc_attr($hsk_user_info['hsk_user_facebook']) : '';
            $user_twitter = isset($hsk_user_info['hsk_user_twitter']) ? esc_attr($hsk_user_info['hsk_user_twitter']) : '';
            $user_gplus = isset($hsk_user_info['hsk_user_gplus']) ? esc_attr($hsk_user_info['hsk_user_gplus']) : '';
            $html= '';
            $html .= '<p class="hsk-column6">';
                $html .= '<label for="hsk_user_facebook">'.__('Facebook', 'hsktalents').'</label>';
                $html .= '<input type="text" name="hsk_user_facebook" id="hsk_user_facebook" value="'.$user_facebook.'" class="regular-text" />';
            $html .= '</p>';
            $html .= '<p class="hsk-column6">';
                $html .= '<label for="hsk_user_twitter">'.__('Twitter', 'hsktalents').'</label>';
                $html .= '<input type="text" name="hsk_user_twitter" id="hsk_user_twitter" value="'.$user_twitter.'" class="regular-text" />';
            $html .= '</p>';
            $html .= '<p class="hsk-column6">';
                $html .= '<label for="hsk_user_gplus">'.__('Google+', 'hsktalents').'</label>'; 
                $html .= '<input type="text" name="hsk_user_gplus" id="hsk_user_gplus" value="'.$user_gplus.'" class="regular-text" />';
            $html .= '</p>';
            return $html;
        }
    }
    /**
     * Update new fields on the user profile page
     *
     * @param $user_id
     */
    public function hsk_update_profile_data( $user_id )
    {
        $hsk_user_info = array();

        if(!empty( $_POST['hsk_user_facebook'] ))
        {
            $hsk_user_info['hsk_user_facebook'] = sanitize_text_field( $_POST['hsk_user_facebook'] );
        }
        if(!empty( $_POST['hsk_user_gplus'] ))
        {
            $hsk_user_info['hsk_user_gplus'] = sanitize_text_field( $_POST['hsk_user_gplus'] );
        }
        if(!empty( $_POST['hsk_user_twitter'] ))
        {
            $hsk_user_info['hsk_user_twitter'] = sanitize_text_field( $_POST['hsk_user_twitter'] );
        }

        if(!empty($hsk_user_info))
        {
            update_user_meta( $user_id, 'hsk_user_social_share', $hsk_user_info);
        }
    }

    /**
     * Add Custom Fields to contact info Section
     *
     * @param $user_contactmethods
     */         
    function hsk_admin_contact_extra_fields($user_contactmethods){     
      $user_contactmethods['hsk_phone'] = __('Contact Number', 'hsktalents');
     // $user_contactmethods['facebook'] = 'Facebook Username';     
      return $user_contactmethods;
    }
}
new HSK_Admin_User_Profile_Fields;
?>