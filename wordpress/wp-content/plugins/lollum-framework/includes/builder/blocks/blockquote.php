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
* blockquote block
******************************/

function lolfmk_print_blockquote_admin($item = null) {
	$blockquote_text = (lolfmk_find_xml_value($item, 'blockquote-text')) ? lolfmk_find_xml_value($item, 'blockquote-text') : '';
	$blockquote_author = (lolfmk_find_xml_value($item, 'blockquote-author')) ? lolfmk_find_xml_value($item, 'blockquote-author') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-blockquote item-1-1" data-type="item-blockquote" data-item="Blockquote">';

	lolfmk_item_btns('Blockquote', 'yes');
	lolfmk_item_before_inner('Blockquote');

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

	$ob_blockquote_text = array(
		'name' => __('Blockquote Text', 'lollum'),
		'data' => 'blockquote-text',
		'value' => $blockquote_text,
		'desc' => __('The content of the blockquote', 'lollum')
	);

	lolfmk_pb_textarea($ob_blockquote_text);

	/*** end command ***/

	/*** begin command ***/

	$ob_blockquote_author = array(
		'name' => __('Blockquote Author', 'lollum'),
		'data' => 'blockquote-author',
		'value' => $blockquote_author,
		'desc' => __('The author of the blockquote', 'lollum')
	);

	lolfmk_pb_text($ob_blockquote_author);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();		
}