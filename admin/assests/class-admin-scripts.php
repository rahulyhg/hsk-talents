<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists('HSK_Admin_Enqueue_Scripts') ){
	
	/**
	 * Class Enqueue Script & Styles
	 */
	class HSK_Admin_Enqueue_Scripts
	{
		
		/*
		 * Load constructor
		 */
		function __construct()
		{

			add_action( 'admin_enqueue_scripts', array($this, 'hsk_admin_enqueue_scripts'), 11 );
			add_action( 'admin_enqueue_scripts', array($this, 'hsk_admin_enqueue_styles') , 11  );
		}

		/*
		 * Enqueue scripts
		 */
		function hsk_admin_enqueue_scripts(){
			wp_enqueue_media();
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'hsk-admin-scripts', HSK_PLUGIN_PATH . 'admin/assests/js/hsk-admin-scripts.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'cpt-form-opt', HSK_PLUGIN_PATH . 'admin/assests/js/cpt-form-opt.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
		}

		/*
		 * Enqueue styles
		 */
		function hsk_admin_enqueue_styles(){ 
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'hsk-talent-admin-styles', HSK_PLUGIN_PATH . 'admin/assests/css/hsk-talent-admin-styles.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'meta-opt-form', HSK_PLUGIN_PATH . 'admin/assests/css/meta-opt-form-style.css', '', HSK_VERSION, 'all', true );
			if(!current_user_can('administrator')){
				wp_enqueue_style( 'admin-ui-styles', HSK_PLUGIN_PATH . 'admin/assests/css/admin-ui-styles.css', '', HSK_VERSION, 'all', true );
			}
		}
	}
	new HSK_Admin_Enqueue_Scripts;
}
?>