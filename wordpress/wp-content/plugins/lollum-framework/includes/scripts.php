<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Framework
 * @author Lollum <support@lollum.com>
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

/******************************
* load admin CSS
******************************/

function lolfmk_load_admin_styles() {
	wp_register_style('lolfmk-metaboxes-css', plugin_dir_url( __FILE__ ).'css/metaboxes.css');
	wp_register_style('lolfmk-minicolors-css', plugin_dir_url( __FILE__ ).'lib/minicolors/minicolors.css');
	wp_register_style('lolfmk-google-sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
	
	wp_enqueue_style('lolfmk-minicolors-css');
	wp_enqueue_style('lolfmk-metaboxes-css');
	wp_enqueue_style('lolfmk-google-sans');
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts-post.php', 'lolfmk_load_admin_styles');
add_action('admin_print_scripts-post-new.php', 'lolfmk_load_admin_styles');


/******************************
* load admin JS
******************************/

function lolfmk_load_admin_scripts() {
	global $lolfmk_version;

	wp_register_script('lolfmk-metaboxes-js', plugin_dir_url( __FILE__ ).'js/metaboxes.js', array('jquery','media-upload','thickbox'), $lolfmk_version, 1);
	wp_register_script('lolfmk-minicolors-js', plugin_dir_url( __FILE__ ).'lib/minicolors/minicolors.min.js', array('jquery'), $lolfmk_version, 1);
	wp_register_script('lolfmk-builder-js', plugin_dir_url( __FILE__ ).'js/builder.js', array('jquery'), $lolfmk_version, 1);

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('iris');
	wp_enqueue_script('lolfmk-minicolors-js');
	wp_enqueue_script('lolfmk-metaboxes-js');
	wp_enqueue_script('lolfmk-builder-js');
}
add_action('admin_print_scripts-post.php', 'lolfmk_load_admin_scripts');
add_action('admin_print_scripts-post-new.php', 'lolfmk_load_admin_scripts');

/******************************
* load front JS
******************************/

function lolfmk_load_front_scripts() {
	if (!is_admin()) {
		global $lolfmk_version;
		
		if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
			wp_register_script('lolfmk-jquery-cookie', plugin_dir_url( __FILE__ ).'js/jquery-cookie.js', array('jquery'), $lolfmk_version, 1);
			wp_enqueue_script('lolfmk-jquery-cookie');
		}
		
		wp_register_script('lolfmk-google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '3.0', 1);
		wp_register_script('lolfmk-google-maps', plugin_dir_url( __FILE__ ).'js/google-maps.js', array('jquery', 'lolfmk-google-maps-api'), $lolfmk_version, 1);
		wp_register_script('lolfmk-prettyPhoto', plugin_dir_url( __FILE__ ).'vendor/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), $lolfmk_version, 1);
		
	}
}
add_action('wp_enqueue_scripts', 'lolfmk_load_front_scripts');


/******************************
* load front CSS
******************************/

function lolfmk_load_front_styles() {
	if (!is_admin()) {
		global $lolfmk_version;
		
		wp_register_style('lolfmk-prettyPhoto-css', plugin_dir_url( __FILE__ ).'vendor/prettyPhoto/css/prettyPhoto.css', $lolfmk_version);
		
	}
}
add_action('wp_enqueue_scripts', 'lolfmk_load_front_styles');