<?php


	require_once 'custom_assets/php/all.php';

	function remove_themefunction() {
	   
	}
	// Call 'remove_thematic_actions' (above) during WP initialization
	//add_action('init','remove_themefunction');
	remove_action('init','dahztheme_testimonials');

	

	require_once 'includes/admin/functions/post-types.php';

	//add_action( 'init', 'dahztheme_testimonials_custom' );
?>