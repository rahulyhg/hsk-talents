<?php
/*
 * Plugin Name: HSK Talents
 * Plugin URI: https://themeforest.net/user/sitesspark
 * Version: 1.0
 * Author: Sites Spark
 * Description: Create Mutltiple talent profiles like model, voice actors, agency, singers like...
 * Author URI: https://themeforest.net/user/sitesspark
 * License: GPLv2 or later
 * Text Domain: hsktalents
 */

/**
* Creating Talents Class
*/
if( !class_exists('HSK_Talents') ){

	class HSK_Talents
	{
		/**
		 * HSK Talents version.
		 *
		 * @var string
		 */
		public $version = '1.0';

		/**
		 * The single instance of the class.
		 *
		 * @var HSK Talents
		 */
		protected static $_instance = NULL;

	    /**
	     * Creates a new instance if there isn't one.
	     *
	     * HSK Talents main HooK
	     */
	    public static function getinstance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
		/**
	     * HSK Talents Contructor Load all files and functions
	     */
		function __construct()
		{
			include (ABSPATH . 'wp-includes/pluggable.php');
			$this->hsk_constants();
			$this->hsk_load_fe_files();
			$this->hsk_load_admin_files();
			$this->hsk_shortcodes_files();
			$this->hsk_widgets_files();
			$this->hsk_lang_translation();
		}

		/**
		 * Define HSK Talents Constants.
		 */
		private function hsk_constants() {
			define( 'HSK_PLUGIN_FILE', __FILE__ );
			define( 'HSK_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'HSK_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			define( 'HSK_VERSION', $this->version );
			define('HSK_PLUGIN_PATH', plugin_dir_url(__FILE__ ));
		}

		/*
		 * Load Frontend Dependent Files
		 */
		public function hsk_load_fe_files(){
			include_once HSK_PLUGIN_DIR . 'lib/library.php';
			include_once HSK_PLUGIN_DIR . 'includes/assests/class-register-scripts.php';
			include_once HSK_PLUGIN_DIR . 'functions.php';
			include_once HSK_PLUGIN_DIR . 'lib/talent-single-data.php';
			include_once HSK_PLUGIN_DIR . 'includes/mr-image-resize.php';
			include_once HSK_PLUGIN_DIR . 'includes/functions.php';
			include_once HSK_PLUGIN_DIR . 'lib/hsk-action-hooks.php';
			include_once HSK_PLUGIN_DIR . 'lib/hsk-post-likes.php';
		}
		/*
		 * Load Admin Dependent Files
		 */
		public function hsk_load_admin_files(){
			include_once HSK_PLUGIN_DIR . 'admin/assests/class-admin-scripts.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-talent-cpt.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-testimonial-cpt.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-talent-options.php';
			include_once HSK_PLUGIN_DIR . 'admin/custom-meta-options-func.php';
			include_once HSK_PLUGIN_DIR . 'admin/hsk-meta-tabs.php';
			include_once HSK_PLUGIN_DIR . 'admin/hsk-admin-functions.php';
			include_once HSK_PLUGIN_DIR . 'admin/hsk-db-updates.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-profile-custom-fields.php';
			include_once HSK_PLUGIN_DIR . 'admin/options-panel.php';
			include_once HSK_PLUGIN_DIR . 'admin/hsk-options-colors.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-functions.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-user-restriction.php';
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-dashboard-widgets.php';
			include_once HSK_PLUGIN_DIR . 'admin/onclick-demo-importer.php'; // Sample demo importer
			include_once HSK_PLUGIN_DIR . 'admin/sstalents-import-export.php'; // talent options import
			include_once HSK_PLUGIN_DIR . 'admin/widget-export-data.php'; // Widget Export
			include_once HSK_PLUGIN_DIR . 'admin/siteorigen-video-bg.php'; // Video BG
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-dashboard-settings.php'; // Dashboard Settings
			include_once HSK_PLUGIN_DIR . 'admin/class-admin-user-profiles-fields.php'; //custom profileds// user
			include_once HSK_PLUGIN_DIR . 'admin/class-customizer-import-export.php'; // customizer export 
		}
		/**
		 * Loading Shortcodes
		 */
		public function hsk_shortcodes_files(){
			$this->hsk_files_load_path('shortcodes');
		}
		/**
		 * Loading widges
		 */
		public function hsk_widgets_files(){
			$this->hsk_files_load_path('widgets');
		}
		/**
		 * including folder files and classes
		 */
		public function hsk_files_load_path($path_name){
			foreach ( glob( plugin_dir_path( __FILE__ )."/".$path_name."/*.php" ) as $path )
	    	require_once $path;	
		}
		/** 
		 * Text Transaltion
		 */
	    public  function hsk_lang_translation() {
	        $locale = apply_filters( 'plugin_locale', get_locale(), 'hsktalents' );
	        load_textdomain( 'hsktalents', trailingslashit( WP_LANG_DIR ) . '/' . $locale . '.mo' );
	        load_plugin_textdomain( 'hsktalents', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	    }	
	}
	
	/**
	 * Create Instance class function
	 */
	function hsk_talents() {
		return HSK_Talents::getinstance();
	}
	/**
	 * Load Class Globally
	 */
	$GLOBALS['hsk_talents'] = hsk_talents();
}
?>