<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

$required_message = ' plugin is required. Please install &amp; activate in this site.';

if ( !is_plugin_active( 'wp-media-categories/wp-media-categories.php' ) || !is_plugin_active( 'filebird-wordpress-media-library-folders/filebird.php' )){

	echo '<div class="error notice">';
	echo "<h1>Required Plugins Are Missing</h1>";
	echo "<p>To use '<strong>Folder to Category Link<storng/>' Plugin.</p>";
	echo '<ol>';
	// check wp media categories plugin
	if ( !is_plugin_active( 'wp-media-categories/wp-media-categories.php' ) ) {
		echo '<li><a href="https://wordpress.org/plugins/wp-media-categories/" target="_blank">WP Media Categories</a>'.$required_message.'</li>';
	}
	// check filebird plugin
	if ( !is_plugin_active( 'filebird-wordpress-media-library-folders/filebird.php' )) {
		echo '<li><a href="https://wordpress.org/plugins/filebird/" target="_blank">FileBird</a>'.$required_message.'</li>';
	}
	echo '</ol></div>';
	$required_plugin_installed = false;
}


