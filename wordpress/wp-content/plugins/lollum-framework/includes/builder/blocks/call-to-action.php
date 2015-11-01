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
* call to action block
******************************/

function lolfmk_print_call_to_action_admin($item = null) {
	global $lolfmk_margin_full;
	$block_title = (lolfmk_find_xml_value($item, 'block-title')) ? lolfmk_find_xml_value($item, 'block-title') : '';
	$text_color = (lolfmk_find_xml_value($item, 'text-color')) ? lolfmk_find_xml_value($item, 'text-color') : '';
	$btn_text = (lolfmk_find_xml_value($item, 'btn-text')) ? lolfmk_find_xml_value($item, 'btn-text') : '';
	$btn_url = (lolfmk_find_xml_value($item, 'btn-url')) ? lolfmk_find_xml_value($item, 'btn-url') : '';
	$bg_color = (lolfmk_find_xml_value($item, 'bg-color')) ? lolfmk_find_xml_value($item, 'bg-color') : '#ffffff';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-call-to-action item-1-1" data-type="item-call-to-action" data-item="Call-To-Action">';

	lolfmk_item_btns('Call-To-Action', 'yes');
	lolfmk_item_before_inner('Call-To-Action');

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

	$ob_block_title = array(
		'name' => __('Block Title', 'lollum'),
		'data' => 'block-title',
		'value' => $block_title,
		'desc' => __('The title of the block', 'lollum')
	);

	lolfmk_pb_text($ob_block_title);

	/*** end command ***/

	/*** begin command ***/

	$ob_text_color = array(
		'name' => __('Text Color', 'lollum'),
		'data' => 'text-color',
		'value' => $text_color,
		'options' => array('dark', 'light'),
		'desc' => __('Select the color of the text', 'lollum')
	);

	lolfmk_pb_simple_select($ob_text_color);

	/*** end command ***/

	/*** begin command ***/

	$ob_btn_text = array(
		'name' => __('Button Text', 'lollum'),
		'data' => 'btn-text',
		'value' => $btn_text,
		'desc' => __('The text of the button', 'lollum')
	);

	lolfmk_pb_text($ob_btn_text);

	/*** end command ***/

	/*** begin command ***/

	$ob_btn_url = array(
		'name' => __('Button URL', 'lollum'),
		'data' => 'btn-url',
		'value' => $btn_url,
		'desc' => __('The URL of the button', 'lollum')
	);

	lolfmk_pb_text($ob_btn_url);

	/*** end command ***/

	/*** begin command ***/

	$ob_bg_color = array(
		'name' => __('Background Color', 'lollum'),
		'data' => 'bg-color',
		'value' => $bg_color,
		'desc' => __('Select a background color', 'lollum')
	);

	lolfmk_pb_color($ob_bg_color);

	/*** end command ***/

	if ($lolfmk_margin_full != '' && $lolfmk_margin_full == 'yes') {

	/*** begin command ***/

	$ob_margin = array(
		'name' => __('Margin Bottom', 'lollum'),
		'data' => 'margin-bottom',
		'value' => $margin,
		'options' => array('yes', 'no'),
		'desc' => __('Select "no" to remove the margin of this block', 'lollum')
	);

	lolfmk_pb_simple_select($ob_margin);

	/*** end command ***/

	}

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();
}