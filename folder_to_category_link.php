<?php
/**
 * Plugin Name: Folder To Category Link
 * Plugin URI:  https://github.com/naimurhasan/folder-to-category-link-wp-pluign/blob/master/README.md
 * Description: One click Link folder with category of uploaded media
 * Version: 1.0
 * Author: Naimur
 * Author URI: https://naimurhasan.github.io/
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

add_action( 'admin_menu', 'fctl_extra_post_info_menu');

if (!function_exists('fctl_extra_post_info_menu')){
	function fctl_extra_post_info_menu(){
		$page_title = 'WordPress Media Category Fix';
		$menu_title = 'Folder to Category';
		$capability = 'manage_options';
		$menu_slug  = 'folder-to-category-link';
		$icon_url   = 'dashicons-media-code';
		$position   = 4;
		$function   = 'extra_post_info_page';
	
		add_menu_page(
			$page_title,
			$menu_title,
			$capability,
			$menu_slug,
			function(){
				$required_plugin_installed = true;
				//required plugn installation alert
				include_once('check_required_plugins.php');
	
				//display setting page
				if($required_plugin_installed){
					include_once('display_page.php');
				}
				
			},
			$icon_url,
			$position);
	}
}
