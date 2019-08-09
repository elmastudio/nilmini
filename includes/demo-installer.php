<?php
/**
 * Demo Installer content, One Click Demo Import plugin required
 * See: https://wordpress.org/plugins/one-click-demo-import/
 *
 * @package Nilmini
 * @since Nilmini 1.0.5
 */

function ocdi_import_files() {
	return array(

		array(
			'import_file_name'             => 'Demo Nilmini',
			'categories'                   => array( 'Blog' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo/nilmini-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo/nilmini-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'assets/demo/nilmini-customizer.dat',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );
