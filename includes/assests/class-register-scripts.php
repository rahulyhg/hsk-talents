<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists('HSK_FE_Enqueue_Scripts') ){
	
	/**
	 * Class Enqueue Script & Styles
	 */
	class HSK_FE_Enqueue_Scripts
	{
		
		/*
		 * Load constructor
		 */
		function __construct()
		{

			add_action( 'wp_enqueue_scripts', array($this, 'hsk_enqueue_scripts'), 11 );
			add_action( 'wp_enqueue_scripts', array($this, 'hsk_enqueue_styles') , 11  );
			add_action( 'wp_enqueue_scripts', array($this, 'sl_enqueue_scripts' ), 10);
		}
		function sl_enqueue_scripts() {
			wp_localize_script( 'simple-likes-public-js', 'simpleLikes', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'like' => __( 'Like', 'hsktalents' ),
				'unlike' => __( 'Unlike', 'hsktalents' )
			) ); 
		}

		/*
		 * Enqueue scripts
		 */
		function hsk_enqueue_scripts(){
			wp_enqueue_script('jquery-masonry');
			wp_localize_script( 'jquery', 'hsk_ajax', array('ajax_url' => admin_url( 'admin-ajax.php' ),
				'like' => __( 'Like', 'hsktalents' ),
				'unlike' => __( 'Unlike', 'hsktalents'),
			 ));
			wp_enqueue_script( 'hsk-owl-carosal', HSK_PLUGIN_PATH . 'includes/assests/js/owl.carousel.min.js', array(), '', 'true' );
			wp_enqueue_script( 'hsk-isotope', HSK_PLUGIN_PATH . 'includes/assests/js/isotope.min.js', array(), '', 'true' );
			wp_enqueue_script( 'fancybox', HSK_PLUGIN_PATH . 'includes/assests/js/jquery.fancybox.min.js', array(), '', 'true' );
			wp_enqueue_script( 'hsk-talents-scripts', HSK_PLUGIN_PATH . 'includes/assests/js/scripts.js', array(), '', 'true' );
			
		}

		/*
		 * Enqueue styles
		 */
		function hsk_enqueue_styles(){
			wp_enqueue_style( 'hsk-carosal', HSK_PLUGIN_PATH . 'includes/assests/css/owl.carousel.min.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'hsk_style', HSK_PLUGIN_PATH . 'includes/assests/css/styles.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'hsk_talents', HSK_PLUGIN_PATH . 'includes/assests/css/hsk-talents.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'fancybox', HSK_PLUGIN_PATH . 'includes/assests/css/jquery.fancybox.min.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'hsk_shortcodes', HSK_PLUGIN_PATH . 'includes/assests/css/shortcodes.css', '', HSK_VERSION, 'all', true );
			wp_enqueue_style( 'hsk_responsive', HSK_PLUGIN_PATH . 'includes/assests/css/responsive.css', '', HSK_VERSION, 'all', true );

		}
	}
	new HSK_FE_Enqueue_Scripts;
}
?>