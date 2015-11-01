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
* mailchimp block
******************************/

function lolfmk_print_mailchimp_admin($item = null) {
	$block_title = (lolfmk_find_xml_value($item, 'block-title')) ? lolfmk_find_xml_value($item, 'block-title') : '';
	$action_url = (lolfmk_find_xml_value($item, 'action-url')) ? lolfmk_find_xml_value($item, 'action-url') : '';
	$btn_text = (lolfmk_find_xml_value($item, 'btn-text')) ? lolfmk_find_xml_value($item, 'btn-text') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-mailchimp item-1-1" data-type="item-mailchimp" data-item="Mailchimp">';

	lolfmk_item_btns('Mailchimp', 'yes');
	lolfmk_item_before_inner('Mailchimp');

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

	$action_url = array(
		'name' => __('Action URL', 'lollum'),
		'data' => 'action-url',
		'value' => $action_url,
		'desc' => __('The URL for the form action (see documentation).', 'lollum')
	);

	lolfmk_pb_textarea($action_url);

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

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';

	lolfmk_item_after_inner();
}