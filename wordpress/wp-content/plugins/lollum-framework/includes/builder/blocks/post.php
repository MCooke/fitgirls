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
* post block
******************************/

function lolfmk_print_post_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$post_id = (lolfmk_find_xml_value($item, 'post-id')) ? lolfmk_find_xml_value($item, 'post-id') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-post item-'.$size.'" data-type="item-post" data-item="Post">';

	lolfmk_item_btns('Post', 'yes', 'yes');
	lolfmk_item_before_inner('Post');

	/*** begin command ***/

	$ob_element_id = array(
		'name' => __('Element ID', 'lollum'),
		'data' => 'element-id',
		'value' => $element_id,
		'desc' => __('The ID of the element (optional)', 'lollum')
	);

	lolfmk_pb_text($ob_element_id);

	/*** end command ***/

	/*** begin command ***/

	$ob_header_text = array(
		'name' => __('Header Text', 'lollum'),
		'data' => 'header-text',
		'value' => $header_text,
		'desc' => __('The text of the header (optional)', 'lollum')
	);

	lolfmk_pb_text($ob_header_text);

	/*** end command ***/

	/*** begin command ***/

	$lol_post_ids = array();
	$args = array(
		'post_type' => 'post',
		'numberposts' => -1
	);
	$posts_array = get_posts($args);
	foreach ($posts_array as $posts_single) {
		$lol_post_ids[$posts_single->ID] = $posts_single->post_title;
	}

	$ob_post_id = array(
		'name' => __('Post Title', 'lollum'),
		'data' => 'post-id',
		'value' => $post_id,
		'options' => $lol_post_ids,
		'desc' => __('Select your post', 'lollum')
	);

	lolfmk_pb_select($ob_post_id);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}