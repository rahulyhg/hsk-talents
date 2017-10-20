<?php
/**
 * Talent CPT Settings
 */
class HSK_Talents_CPT

{
    public $post_type_name;

    public $post_type_args;

    public $post_type_labels;

    public $name;

    /* Class constructor */
    public function __construct()
    {
        add_action( 'admin_init', array(&$this,'hsk_add_talent_cap_admin'));
        add_action('init', array(&$this,'hsk_register_talent_post' ));
        add_action('init', array(&$this,'hsk_register_talent_taxonomy'));
        add_action('init', array(&$this,'hsk_talent_tgs_init'));
        add_filter( 'manage_edit-talent_columns', array(&$this,'hsk_add_talent_columns'));
        add_action( 'manage_talent_posts_custom_column', array(&$this,'hsk_manage_talent_columns'), 10, 2 );
    }

    public function register_post_talent($name)
    {

        // Capitilize the words and make it plural

        $name = ucwords(str_replace('_', ' ', $name));
        $plural = $name . 's';

        // We set the default labels based on the post type name and plural. We overwrite them with the given labels.

        return array(
            'name' => esc_attr($plural),
            'singular_name' => esc_attr($name),
            'add_new' => esc_html__('Add New', 'hsktalents'),
            'add_new_item' => sprintf(__('Add New %s ', 'hsktalents'), $name) ,
            'edit_item' => sprintf(__('Edit %s ', 'hsktalents'), $name) ,
            'new_item' => sprintf(__('New %s ', 'hsktalents'), $name) ,
            'all_items' => sprintf(__('All %s ', 'hsktalents'), $name) ,
            'view_item' => sprintf(__('View %s ', 'hsktalents'), $name) ,
            'search_items' => sprintf(__('Search %s ', 'hsktalents'), $name) ,
            'not_found' => sprintf(__('No %s  found', 'hsktalents'), strtolower($plural)) ,
            'not_found_in_trash' => sprintf(__('No  %s found in Trash', 'hsktalents'), strtolower($plural)) ,
            'parent_item_colon' => '',
            'menu_name' => $plural
        );
    }

    function hsk_register_talent_post()
    {
        $args = array(
            'labels' => $this->register_post_talent('Talent') ,
            'public' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => array(
                'with_front' => false
            ) ,
            'query_var' => true,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => array(
                'title',
                '',
                '',
                'thumbnail',
                '',
                ''
            ),
            'capability_type' => 'talent',
            'capabilities' => array(
                'publish_posts' => 'publish_talents',
                'edit_posts' => 'edit_talents',
                'edit_others_posts' => 'edit_others_talents',
                'read_private_posts' => 'read_private_talents',
                'edit_post' => 'edit_talent',
                'delete_post' => 'delete_talent',
                'read_post' => 'read_talent',
                'create_posts' => 'create_talents',
                'delete_others_posts' => 'delete_others_talents',
                'delete_private_posts' => 'delete_private_talents',
                'delete_posts' => 'delete_talents',
                'delete_published_posts' => 'delete_published_talents',
                'edit_private_posts' => 'edit_private_talents',
                'edit_published_posts' => 'edit_published_talents',
            ),
            'map_meta_cap' => true
        );
        register_post_type('talent', $args);
    }

    function hsk_register_talent_taxonomy()
    {
        register_taxonomy('talent_cat', array(
            'talent'
        ) , array(
            'hierarchical' => true,
            'labels' => $this->register_post_talent('Talent Categorie') ,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'talents-cat'
            ),
            'capabilities'       => array(
                'manage_terms'  => 'manage_talent_cat',
                'edit_terms'    => 'edit_talent_cat',
                'delete_terms'  => 'delete_talent_cat',
                'assign_terms'  => 'assign_talent_cat'
            )
        ));
    }

    function hsk_talent_tgs_init()
    {
        // create a new taxonomy
        register_taxonomy('talent_tag', 'talent', array(
            'label' => __('Talent Tags', 'hsktalents') ,
            'rewrite' => array(
                'slug' => 'talent_tag'
            ) ,
        ));
    }
    function hsk_add_talent_columns( $columns ) {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Talent Name', 'hsktalents' ),
            'talent_category' => __( 'Category' , 'hsktalents'),
            'talent_tag' => __( 'Tags', 'hsktalents' ),
            'author' => __( 'Author' , 'hsktalents'),
            'thumbnail' => __( 'Thumbnail' , 'hsktalents'),
            'date' => __( 'Date' , 'hsktalents')
        );
        return $columns;
    }
    function hsk_manage_talent_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        /* If displaying the 'duration' column. */
         case 'thumbnail':          
            echo the_post_thumbnail(array(100,100));
            break;

            /* If displaying the 'genre' column. */
            case 'talent_category' :
                $terms = get_the_terms($post->ID, 'talent_cat');
                if ( !empty($terms) ) {
                    foreach ( $terms as $term ){
                     $post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
                    }
                    echo implode( ', ', $post_terms );
                } else {
                    echo '<em>'.__('No terms', 'hsktalents').'</em>';
                }
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }
    function hsk_add_talent_cap_admin() {
        // gets the administrator role
        $admins = get_role( 'administrator' );
        $admins->add_cap( 'create_talents' );
        $admins->add_cap( 'edit_talent' ); 
        $admins->add_cap( 'edit_talents' ); 
        $admins->add_cap( 'edit_others_talents' ); 
        $admins->add_cap( 'publish_talents' ); 
        $admins->add_cap( 'read_talent' ); 
        $admins->add_cap( 'read_private_talents' ); 
        $admins->add_cap( 'delete_talent' );
        $admins->add_cap( 'edit_private_talents' );
        $admins->add_cap( 'edit_published_talents' );
        $admins->add_cap( 'delete_others_talents' );
        $admins->add_cap( 'delete_published_talents' );
        $admins->add_cap( 'delete_private_talents' );
        $admins->add_cap( 'delete_talent_cat' );
        $admins->add_cap( 'delete_talent_cat' );
        $admins->add_cap( 'delete_talents' );
        $admins->add_cap( 'manage_talent_cat' );
        $admins->add_cap( 'assign_talent_cat' );
        $admins->add_cap( 'edit_talent_cat' );
    }
    
}
new HSK_Talents_CPT
?>