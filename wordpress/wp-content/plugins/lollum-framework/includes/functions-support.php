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
* check theme support function
******************************/

function lolfmk_current_theme_supports($feature) {
	global $lolfmk_theme_features;
	if (isset($lolfmk_theme_features[$feature])) {
		if ($lolfmk_theme_features[$feature] == 'yes') {
			return true;
		}
	}
}

/******************************
* check post type support function
******************************/

function lolfmk_current_theme_pt_supports($pt) {
	global $lolfmk_supported_post_types;
	if (isset($lolfmk_supported_post_types[$pt])) {
		if ($lolfmk_supported_post_types[$pt] == 'yes') {
			return true;
		}
	}
}

/******************************
* check plugin function
******************************/

function lolfmk_check_plugin_function_bl($feature) {
	return true;
}