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
* skill shortcode
******************************/

add_shortcode('lollum_skill', 'lolfmk_skill_shortcode');
function lolfmk_skill_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"name" => '',
		"size" => ''
		), $atts));
	$skill = '<span class="lol-skill-name">'.$name.'</span>';
	$skill = $skill.'<div class="lol-skill">';
	$skill = $skill.'<span class="lol-bar" data-skill="'.$size.'"></span>';
	$skill = $skill.'</div>';
	return apply_filters('lolfmk_skill_shortcode_filter', $skill);
}


/******************************
* button shortcode
******************************/

add_shortcode('lollum_button', 'lolfmk_button_shortcode');
function lolfmk_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"text"=> '',
		"url"=> '',
		"size" => ''
		), $atts));	
	$button = '<p><a href="'.$url.'" class="lol-button '.$size.'">'.$text.'</a></p>';
	return apply_filters('lolfmk_button_shortcode_filter', $button);
}


/******************************
* list shortcode
******************************/

add_shortcode('lollum_list', 'lolfmk_list_shortcode');
function lolfmk_list_shortcode($atts, $content = null) {	
	$list = '<ul class="lol-list">'.do_shortcode($content).'</ul>';
	return apply_filters('lolfmk_list_shortcode_filter', $list);
}


/******************************
* list element shortcode
******************************/

add_shortcode('lollum_list_element', 'lolfmk_list_element_shortcode');
function lolfmk_list_element_shortcode($atts, $content = null) {
	global $lolfmk_fontawesome_version;
	if ($lolfmk_fontawesome_version > 3) {
		$list = '<li><i class="fa fa-check"></i>'.do_shortcode($content).'</li>';
	} else {
		$list = '<li><i class="icon-ok"></i>'.do_shortcode($content).'</li>';
	}
	return apply_filters('lolfmk_list_element_shortcode_filter', $list);
}


/******************************
* price table shortcode
******************************/

add_shortcode('lollum_price_table', 'lolfmk_price_table_shortcode');
function lolfmk_price_table_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"columns"=> ''
		), $atts));
	$price_table = '<div class="lol-price-table columns'.$columns.'">'.do_shortcode($content).'</div>';
	return apply_filters('lolfmk_price_table_shortcode_filter', $price_table);
}


/******************************
* price item shortcode
******************************/

add_shortcode('lollum_price_item', 'lolfmk_price_item_shortcode');
function lolfmk_price_item_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		"name"=> '',
		"popular"=> '',
		"cost"=> '',
		"currency"=> '',
		"plan"=> '',
		"btn_text"=> '',
		"btn_url"=> ''
		), $atts));
	$price_item = '<div class="price-item popular-'.$popular.'">';
	$price_item = $price_item.'<div class="price-name">'.$name.'</div>';
	$price_item = $price_item.'<div class="price-description">';
	$price_item = $price_item.'<div class="price-cost"><span class="price-currency">'.$currency.'</span>'.$cost.'</div>';
	if ($plan != '') {
		$price_item = $price_item.'<div class="price-plan">'.$plan.'</div>';
	}
	$price_item = $price_item.'</div>';
	$price_item = $price_item.'<ul>'.do_shortcode($content).'</ul>';
	$price_item = $price_item.'<div class="price-btn"><a href="'.$btn_url.'" class="lol-button">'.$btn_text.'</a></div>';
	$price_item = $price_item.'</div>';
	return apply_filters('lolfmk_price_item_shortcode_filter', $price_item);
}


/******************************
* price package shortcode
******************************/

add_shortcode('lollum_price_package', 'lolfmk_price_package_shortcode');
function lolfmk_price_package_shortcode($atts, $content = null) {
	$price_package = '<li>'.do_shortcode($content).'</li>';
	return apply_filters('lolfmk_price_package_shortcode_filter', $price_package);
}


/******************************
* dropcap shortcode
******************************/

add_shortcode('lollum_dropcap', 'lolfmk_dropcap_shortcode');
function lolfmk_dropcap_shortcode($atts, $content = null) {
	$dropcap = '<span class="lol-dropcap">'.do_shortcode($content).'</span>';
	return apply_filters('lolfmk_dropcap_shortcode_filter', $dropcap);
}


/******************************
* clean shortcode output
******************************/

function lolfmk_clean_shortcodes($content){   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'lolfmk_clean_shortcodes');


/******************************
* includes
******************************/

require_once('functions-shortcodes.php');


/******************************
* load CSS
******************************/

function lolfmk_load_shortcodes_styles() {
	wp_register_style('lolfmk-shortcodes-css', plugin_dir_url( __FILE__ ).'css/shortcodes.css');
	
	wp_enqueue_style('lolfmk-shortcodes-css');
}

/******************************
* load JS
******************************/

function lolfmk_load_shortcodes_scripts() {
	global $lolfmk_version;

	wp_register_script('lolfmk-shortcodes-js', plugin_dir_url( __FILE__ ).'js/shortcodes.js', array('jquery'), $lolfmk_version, 1);

	wp_enqueue_script('lolfmk-shortcodes-js');
}

/******************************
* check if theme needs these scripts
******************************/

if (get_option('lolfmk_load_shortcodes_scripts') == 'yes') {
	add_action('wp_enqueue_scripts', 'lolfmk_load_shortcodes_styles');
	add_action('wp_enqueue_scripts', 'lolfmk_load_shortcodes_scripts');
}