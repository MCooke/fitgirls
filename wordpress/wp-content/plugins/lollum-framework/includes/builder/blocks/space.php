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
* space block
******************************/

function lolfmk_print_space_admin($item = null) {
	$space_height = (lolfmk_find_xml_value($item, 'space-height')) ? lolfmk_find_xml_value($item, 'space-height') : '30';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-space item-1-1" data-type="item-space" data-item="Space">';

	lolfmk_item_btns('Space', 'yes', null);
	lolfmk_item_before_inner('Space');

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

	$ob_space = array(
		'name' => __('Height amount', 'lollum'),
		'data' => 'space-height',
		'value' => $space_height,
		'desc' => __('Type the height (in pixels) of this element', 'lollum')
	);

	lolfmk_pb_text($ob_space);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();
}