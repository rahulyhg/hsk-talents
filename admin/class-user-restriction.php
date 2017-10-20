<?php
if( !class_exists('HSK_Telant_Access_Restriction') ){
    class HSK_Telant_Access_Restriction{
        protected $option_name = 'restrict-user-roles';
        protected $settings_page_name = 'hsk-restrict-user-roles';
        protected $talent_sulg_name;
        function __construct(){
            global $hsk_role_restrict_opt;
            add_action( 'admin_init' , array( $this, 'hsk_user_restriction_opt_init' ) );
            add_action( 'admin_menu' , array( $this, 'hsk_user_restriction_menu' ) );
            $hsk_role_restrict_opt = (object) get_option('hsk-restrict-user-roles');
            //  add_action('init',array($this,'hsk_remove_post_add_new_role'));
            //$this->hsk_remove_post_add_new_role();
            add_action('admin_head',array($this,'hsk_remove_post_add_new_role'));
        }    
        /**
         * CPT Post Limit resteiction based on user roles
         */    
        function hsk_remove_post_add_new_role(){
            global $hsk_post_limit, $current_user, $wpdb;
            $user_id = $current_user->ID;
            if( !current_user_can('administrator')) { ?>
                <style type="text/css">
                    a.page-title-action{
                        display: none;
                    }
                </style>
            <?php }
            if( !empty($hsk_post_limit) ){
                foreach ($hsk_post_limit['limit'] as $type => $limit) {
                    if( !empty($limit) ){
                        if( $limit == 0 ){
                            $post_limit= $limit;
                        }else{
                            $post_limit=  ($limit) ? $limit : '100';
                        }
                        $select_post_data = !empty($limit) ? $type : '';
                        $post_status = "IN ('publish', 'pending', 'draft', 'future', 'private')";
                        $post_count = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_status ". $post_status ." AND post_author = $user_id AND post_type ='".$type."'");
                       if( $post_count >= $post_limit){ ?>
                        <style type="text/css">
                           #menu-posts-<?php echo $type; ?> ul.wp-submenu {
                                display: none;    
                            }
                        </style>
                       <?php }
                    }
                }                
            }
        }
        function hsk_user_restriction_opt_init(){
            register_setting( $this->option_name, $this->option_name,  array( $this,'hsk_user_roles_opt_validation') );
        }
        function hsk_user_restriction_menu() {
            add_users_page( __('User Role Restrictions', 'hsktalents'),__('User Role Restrictions', 'hsktalents'), 'edit_theme_options', $this->settings_page_name, array( &$this,'hsk_user_restrict_option_settings'));
        }
        /**
         * Getting all post types
         */  
        private function hsk_get_cpt_postes() {
            $args = array(
               'public'   => true,
               '_builtin' => false
            );
            $output = 'names'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'
            $post_types = get_post_types( $args,OBJECT);
            return $post_types;
        }
        /**
         * Option Panel
         */
        public function hsk_user_restrict_option_settings(){
            global $wp_roles, $hsk_role_restrict_opt, $restriction_info, $hsk_talent_cat_opt;            
            unset($hsk_talent_cat_opt['choose-option']);
           // print_r($hsk_talent_cat_opt);
            echo '<div class="wrap hsk-user-roles-restriction-wrapper">';
                echo '<form method="post" action="options.php">';             
                    settings_fields($this->option_name);
                    foreach ($GLOBALS['wp_roles']->roles as $role => $v)
                        $roles[] = $role;

                    $restriction_info = get_option($this->option_name);
                    // post Limit based on limit
                        echo '<h3>'.__('CPT Posts Limit Restriction Based On User Roels', 'hsktalents').'</h3>';
                        echo '<table id="kaya-user-role-content-wrapper" class="table widefat user-limit-rules user-cpt-post-limit">';
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>'.__('CPT Post', 'hsktalents').'</th>';
                                    foreach ($wp_roles->roles as $key => $role) {
                                        echo '<th>'.$role['name'].'</th>';
                                    }
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                foreach ($this->hsk_get_cpt_postes() as $key => $post_type) {   
                                    echo '<tr>';
                                        echo '<th>'.$post_type->label.' </th>';
                                        for ($i=0; $i < count($roles); $i++) {
                                            echo '<td>';
                                                echo '<input type="number" placeholder="2" class="small-text" name="'.$this->option_name.'['.$roles[$i].'][limit]['.$post_type->name.']" value="'.$restriction_info[$roles[$i]]['limit'][$post_type->name].'">';
                                            echo '</td>';
                                        }
                                    echo '</tr>';    
                                } 
                            echo '</tbody>';
                        echo '</table>';
                        // Remove Meta panels Based on user roles
                        $metapanels = array('talent_talent_cat'=>__('Choose Group', 'hsktalents'), 'hsk-featured-talent'=>__('Featured Talent', 'hsktalents'), 'talent_social_share_info' =>__('Socail Sharing Id\'s', 'hsktalents'), 'hsk_talent_status_info' =>__('Talent status', 'hsktalents'), 'tagsdiv-talent_tag' => __('Tags','hsktalents'), 'hsk_talent_unique_id'=> __('Talent Unique ID', 'hsktalents'), 'hsk_talent_status_info'=> __('Talent Status', 'hsktalents'  ));
                        $metabox_panels = array_merge($hsk_talent_cat_opt, $metapanels);
                        echo '<h3>'.__('Remove Metapanels Based On User Roels', 'hsktalents').'<small>'.__('( Check this box to remove metabox panels from talent cpt post) ', 'hsktalents').'</small></h3>';
                        echo '<table id="kaya-user-role-content-wrapper" class="table widefat ">';
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>'.__('Metapanels', 'hsktalents').'</th>';
                                    foreach ($wp_roles->roles as $key => $role) {
                                        echo '<th>'.$role['name'].'</th>';
                                    }
                                echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                                foreach ($metabox_panels as $meta_key => $meta_panel) {   
                                    echo '<tr>';
                                        echo '<th>'.esc_attr($meta_panel).' </th>';
                                        for ($i=0; $i < count($roles); $i++) {
                                            echo '<td>';
                                                $checked = ( isset($restriction_info[$roles[$i]]['metabox'][$meta_key]) && ( $restriction_info[$roles[$i]]['metabox'][$meta_key] == '1' ) ) ? 'checked=checked' :'';
                                                echo '<input type="checkbox" placeholder="2" class="" name="'.$this->option_name.'['.$roles[$i].'][metabox]['.$meta_key.']" '.$checked.' value="1">';
                                            echo '</td>';
                                        }
                                    echo '</tr>';    
                                } 
                            echo '</tbody>';
                        echo '</table>';
                        // End
                    echo '<p class="submit">';
                        submit_button( 'Save Options' ); 
                    echo '</p>';
                    echo '</form>';
            echo '</div>';
        }
        /**
         * Validate input values
         */
        function hsk_user_roles_opt_validation($input) {
            return $input;
        }
    }
    new HSK_Telant_Access_Restriction;
}
?>