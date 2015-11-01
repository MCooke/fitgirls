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
* divider block
******************************/

function lolfmk_print_divider_admin($item = null) {
	$divider_text = (lolfmk_find_xml_value($item, 'divider-text')) ? lolfmk_find_xml_value($item, 'divider-text') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-divider item-'.$size.'" data-type="item-divider" data-item="Divider">';

	lolfmk_item_btns('Divider', 'yes', 'yes');
	lolfmk_item_before_inner('Divider');

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
		'name' => __('Divider Text', 'lollum'),
		'data' => 'divider-text',
		'value' => $divider_text,
		'desc' => __('The text of the divider', 'lollum')
	);

	lolfmk_pb_text($ob_header_text);

	/*** end command ***/
	
	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';
	
	lolfmk_item_after_inner();
}