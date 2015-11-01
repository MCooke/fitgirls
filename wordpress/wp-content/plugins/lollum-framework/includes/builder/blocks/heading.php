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
* heading block
******************************/

function lolfmk_print_heading_admin($item = null) {
	$heading_text = (lolfmk_find_xml_value($item, 'heading-text')) ? lolfmk_find_xml_value($item, 'heading-text') : '';
	$heading_sub = (lolfmk_find_xml_value($item, 'heading-sub')) ? lolfmk_find_xml_value($item, 'heading-sub') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-heading item-1-1" data-type="item-heading" data-item="Heading">';

	lolfmk_item_btns('Heading', 'yes');
	lolfmk_item_before_inner('Heading');

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

	$ob_heading_text = array(
		'name' => __('Heading Text', 'lollum'),
		'data' => 'heading-text',
		'value' => $heading_text,
		'desc' => __('The text of the heading', 'lollum')
	);

	lolfmk_pb_text($ob_heading_text);

	/*** end command ***/

	/*** begin command ***/

	$ob_heading_sub = array(
		'name' => __('Subtitle Heading', 'lollum'),
		'data' => 'heading-sub',
		'value' => $heading_sub,
		'desc' => __('Add a subtitle in your heading', 'lollum')
	);

	lolfmk_pb_textarea($ob_heading_sub);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();		
}