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
* blog full block
******************************/

function lolfmk_print_blog_full_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$blog_type = (lolfmk_find_xml_value($item, 'blog-type')) ? lolfmk_find_xml_value($item, 'blog-type') : '';
	$post_category = (lolfmk_find_xml_value($item, 'post-category')) ? lolfmk_find_xml_value($item, 'post-category') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-blog-full item-1-1" data-type="item-blog-full" data-item="Blog-Full">';

	lolfmk_item_btns('Blog-Full', 'yes');
	lolfmk_item_before_inner('Blog-Full');

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

	$ob_blog_type = array(
		'name' => __('Blog Type', 'lollum'),
		'data' => 'blog-type',
		'value' => $blog_type,
		'options' => array('recent', 'category', 'random'),
		'desc' => __('Display your posts sorted by date, by category or in random order', 'lollum')
	);

	lolfmk_pb_simple_select($ob_blog_type);

	/*** end command ***/

	/*** begin command ***/

	$lol_categories = get_categories('hide_empty=0&orderby=name');
	$lol_wp_cats = array();  
	foreach ($lol_categories as $category_list) {  
		$lol_wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
	}

	$ob_post_cats = array(
		'name' => __('Post Category', 'lollum'),
		'data' => 'post-category',
		'value' => $post_category,
		'options' => $lol_wp_cats,
		'desc' => __('Select your category (works only if you select "category" in "Blog Type")', 'lollum')
	);

	lolfmk_pb_select($ob_post_cats);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';

	lolfmk_item_after_inner();
}