<?php
/*
Plugin Name: Lollum Framework
Plugin URI: http://www.lollum.com
Description: Extra functionality for Lollum themes.
Author: Lollum
Author URI: http://www.lollum.com
Version: 1.7
*/

/******************************
* localize plugin
******************************/

function lolfmk_load_textdomain() {
	load_plugin_textdomain('lollum', false, dirname(plugin_basename( __FILE__ )).'/includes/languages/');
}
add_action('init', 'lolfmk_load_textdomain');


/******************************
* global variables
******************************/

$lolfmk_version = '1.7';
$lolfmk_pre = 'lolfmkbox_';
$lolfmk_theme_name = str_replace(' ', '_', strtolower(wp_get_theme()));
$lolfmk_theme_features = get_option('lolfmk_supported_features');
$lolfmk_supported_blocks = array();
$lolfmk_support_page_builder = get_option('lolfmk_support_page_builder');
$lolfmk_supported_post_types = get_option('lolfmk_supported_post_types');
$lolfmk_fontawesome_version = get_option('lolfmk_fontawesome_version');
$lolfmk_margin_full = get_option('lolfmk_margin_full');
$lolfmk_link_slider = get_option('lolfmk_link_slider');


/******************************
* includes
******************************/

require_once('update-notifier.php');
require_once('includes/scripts.php');
require_once('includes/functions-support.php');
if (isset($lolfmk_support_page_builder) && ($lolfmk_support_page_builder == 'yes')) {
	require_once('includes/builder/data-builder.php');
}
require_once('includes/functions-metaboxes.php');
require_once('includes/shortcodes/shortcodes.php');
require_once('includes/love/functions-love.php');