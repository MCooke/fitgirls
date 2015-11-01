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
* progress circle block
******************************/

function lolfmk_print_progress_circle_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$skill = (lolfmk_find_xml_value($item, 'skill')) ? lolfmk_find_xml_value($item, 'skill') : '';
	$level = (lolfmk_find_xml_value($item, 'level')) ? lolfmk_find_xml_value($item, 'level') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-progress-circle item-'.$size.'" data-type="item-progress-circle" data-item="Progress-Circle">';

	lolfmk_item_btns('Progress-Circle', 'yes', 'yes');
	lolfmk_item_before_inner('Progress-Circle');

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

	$ob_skill = array(
		'name' => __('Skill', 'lollum'),
		'data' => 'skill',
		'value' => $skill,
		'desc' => __('The name of the skill', 'lollum')
	);

	lolfmk_pb_text($ob_skill);

	/*** end command ***/

	/*** begin command ***/

	$ob_level = array(
		'name' => __('Level', 'lollum'),
		'data' => 'level',
		'value' => $level,
		'desc' => __('The level of the skill', 'lollum')
	);

	lolfmk_pb_text($ob_level);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}