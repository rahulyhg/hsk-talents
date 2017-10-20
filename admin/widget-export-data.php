<?php
function hsk_widgets_add_import_export_page() {
	$page_hook = add_management_page(
		esc_html__( 'HSK Widgets Export', 'hsktalents' ), esc_html__( 'Widget Export', 'hsktalents' ), 'edit_theme_options', // capability (can manage Appearance > Widgets)
		'hsktalents', // menu slug
		'hsk_widgets_import_export_page_content' // callback for displaying page content
	);
}

add_action( 'admin_menu', 'hsk_widgets_add_import_export_page' ); // register post type

function hsk_widgets_import_export_page_content() {	?>
	<div class="wrap">		
		<h3 class="title"><?php echo esc_html_x( 'Export Widgets', 'heading', 'hsktalents' ); ?></h3>
		<p class="submit">
			<a href="<?php echo esc_url( admin_url( basename( $_SERVER['PHP_SELF'] ) . '?page=' . $_GET['page'] . '&export=1' ) ); ?>" id="wie-export-button" class="button button-primary"><?php echo esc_html_x( 'Export Widgets', 'button', 'hsktalents' ); ?></a>
		</p>
	</div>
	<?php

}

function hsk_widgets_available_widgets() {
	global $wp_registered_widget_controls;
	$widget_controls = $wp_registered_widget_controls;
	$available_widgets = array();
	foreach ( $widget_controls as $widget ) {
		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) {
			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];
		}

	}
	return apply_filters( 'hsk_widgets_available_widgets', $available_widgets );
}

function hsk_widgets_generate_export_data() {
	$available_widgets = hsk_widgets_available_widgets();
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$instances = get_option( 'widget_' . $widget_data['id_base'] );
		if ( ! empty( $instances ) ) {
			foreach ( $instances as $instance_id => $instance_data ) {
				if ( is_numeric( $instance_id ) ) {
					$unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
					$widget_instances[$unique_instance_id] = $instance_data;
				}
			}
		}
	}
	$sidebars_widgets = get_option( 'sidebars_widgets' ); // get sidebars and their unique widgets IDs
	$sidebars_widget_instances = array();
	foreach ( $sidebars_widgets as $sidebar_id => $widget_ids ) {
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}

		if ( ! is_array( $widget_ids ) || empty( $widget_ids ) ) {
			continue;
		}
		foreach ( $widget_ids as $widget_id ) {

			if ( isset( $widget_instances[$widget_id] ) ) {
				$sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];
			}
		}
	}
	$data = apply_filters( 'wie_unencoded_export_data', $sidebars_widget_instances );
	$encoded_data = json_encode( $data );
	return apply_filters( 'hsk_widgets_generate_export_data', $encoded_data );
}

function hsk_widgets_send_export_file() {
	if ( ! empty( $_GET['export'] ) ) {
		$site_url = site_url( '', 'http' );
		$site_url = trim( $site_url, '/\\' );
		$filename = str_replace( 'http://', '', $site_url );
		$filename = str_replace( array( '/', '\\' ), '-', $filename );
		$filename .= '-widgets.json'; // append
		$filename = apply_filters( 'hsk_widget_export_file', $filename );
		$file_contents = hsk_widgets_generate_export_data();
		$filesize = strlen( $file_contents );
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename=' . $filename );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . $filesize );
		@ob_end_clean();
		flush();
		echo $file_contents;
		exit;
	}
}
add_action( 'load-tools_page_hsktalents', 'hsk_widgets_send_export_file' );
?>