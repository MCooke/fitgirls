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
* add shortcode buttons
******************************/

add_action('init', 'lolfmk_add_button');  
function lolfmk_add_button() {  
	if (current_user_can('edit_posts') &&  current_user_can('edit_pages')) {  
		add_filter('mce_external_plugins', 'lolfmk_add_plugin');
		add_filter('mce_buttons_3', 'lolfmk_register_button');
	}
}


/******************************
* register shortcode buttons
******************************/

function lolfmk_register_button($buttons) {
	array_push($buttons, "lollum_button", "lollum_skill", "lollum_price", "lollum_list", "lollum_dropcap", "separator");
	return $buttons;  
}


/******************************
* register tinymce
******************************/

function lolfmk_add_plugin($plugin_array) {  
   $plugin_array['lollum_skill'] = plugin_dir_url( __FILE__ ).'tinymce/skill.js';
	$plugin_array['lollum_button'] = plugin_dir_url( __FILE__ ).'tinymce/button.js';
	$plugin_array['lollum_price'] = plugin_dir_url( __FILE__ ).'tinymce/price.js';
	$plugin_array['lollum_list'] = plugin_dir_url( __FILE__ ).'tinymce/list.js';
	$plugin_array['lollum_dropcap'] = plugin_dir_url( __FILE__ ).'tinymce/dropcap.js';
	return $plugin_array;  
}


/******************************
* register admin scripts
******************************/

add_action('admin_print_scripts-post.php', 'lolfmk_manager_js');
add_action('admin_print_scripts-post-new.php', 'lolfmk_manager_js');
function lolfmk_manager_js() {
	if (is_admin()) {
		global $lolfmk_version;
		wp_register_script('popup', plugin_dir_url( __FILE__ ).'tinymce/js/popup.js', array('jquery'), $lolfmk_version, 1);
		wp_enqueue_script('popup');
	}
}