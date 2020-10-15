<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file. 
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_scripts() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'generatepress-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'generatepress_child_enqueue_scripts', 100 );

//CUSTOM CODE STARTS HERE

//Convert date into format readable by PHP, and then convert it into a string
function nice_date($date) {
	echo date ("F Y", strtotime($date));
}

//Pulls in the background image
function nice_background($image_field) {
	echo 'background-image : url(' . get_field($image_field) . ')';
}