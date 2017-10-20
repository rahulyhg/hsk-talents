<?php
/**
 * Version 0.0.3
 *
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'HSK_Theme_Demo_Importer' ) ) {

	require_once 'importer/hsk-demo-importer.php'; //load admin theme data importer

	class HSK_Theme_Demo_Importer extends HSK_Theme_Importer {

		/**
		 * @var string
		 */
		public $theme_options_framework = 'hsk';

		/**
		 * Holds a copy of the object for easy reference.
		 *
		 * @since 0.0.1
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Set the key to be used to store theme options
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $theme_option_name       = 'my_theme_options_name'; //set theme options name here (key used to save theme options). Optiontree option name will be set automatically

		public $theme_customize_file_name='customize.json';
		/**
		 * Set name of the theme options file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $theme_options_file_name = 'theme_options.txt';

		/**
		 * Set name of the widgets json file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widgets_file_name       = 'widgets.json';

		/**
		 * Set name of the Talent options as a json file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $toptions_file_name       = 'toptions.json';

		/**
		 * Set name of the content file
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $content_demo_file_name  = 'content.xml';

		public $pods_data  = 'demo.json';

		/**
		 * Holds a copy of the widget settings
		 *
		 * @since 0.0.2
		 *
		 * @var string
		 */
		public $widget_import_results;

		/**
		 * Constructor. Hooks all interactions to initialize the class.
		 *
		 * @since 0.0.1
		 */
		public function __construct() {

			$this->demo_files_path = dirname(__FILE__) . '/demo-files/'; //can

			self::$instance = $this;
			parent::__construct();

		}

		/**
		 * Add menus - the menus listed here largely depend on the ones registered in the theme
		 *
		 * @since 0.0.1
		 */
		public function set_demo_menus(){

			// Menus to Import and assign - you can remove or add as many as you want
			$top_menu    = get_term_by('name', 'Primary', 'nav_menu');
			$main_menu   = get_term_by('name', 'Footer', 'nav_menu');

			set_theme_mod( 'nav_menu_locations', array(
					'primary' => $main_menu->term_id,
					'footer' => $footer_menu->term_id
				)
			);

			$this->flag_as_imported['menus'] = true;

		}

	}

	new HSK_Theme_Demo_Importer;
}