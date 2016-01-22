<?php

	// Register Script
function custom_scripts() {

	wp_register_script( 'custom', get_stylesheet_directory_uri() .'/custom_assets/js/main.js' );
	
	wp_enqueue_script( 'custom' );

}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );

?>