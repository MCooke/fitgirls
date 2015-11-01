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
* heading wide block
******************************/

function lolfmk_print_heading_wide_admin($item = null) {
	$heading_text = (lolfmk_find_xml_value($item, 'heading-text')) ? lolfmk_find_xml_value($item, 'heading-text') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-heading-wide item-1-1" data-type="item-heading-wide" data-item="Heading-Wide">';

	lolfmk_item_btns('Heading-Wide', 'yes');
	lolfmk_item_before_inner('Heading-Wide');

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

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();		
}