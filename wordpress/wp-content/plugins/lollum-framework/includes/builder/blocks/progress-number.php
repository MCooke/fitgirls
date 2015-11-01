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
* progress number block
******************************/

function lolfmk_print_progress_number_admin($item = null) {
	$progress_description = (lolfmk_find_xml_value($item, 'progress-description')) ? lolfmk_find_xml_value($item, 'progress-description') : '';
	$progress_number_from = (lolfmk_find_xml_value($item, 'progress-number-from')) ? lolfmk_find_xml_value($item, 'progress-number-from') : '0';
	$progress_number_to = (lolfmk_find_xml_value($item, 'progress-number-to')) ? lolfmk_find_xml_value($item, 'progress-number-to') : '';
	$progress_icon = (lolfmk_find_xml_value($item, 'progress-icon')) ? lolfmk_find_xml_value($item, 'progress-icon') : 'fa-';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';
				
	echo '<div class="page-item item-progress-number item-'.$size.'" data-type="item-progress-number" data-item="Progress-Number">';

	lolfmk_item_btns('Progress-Number', 'yes', 'yes');
	lolfmk_item_before_inner('Progress-Number');

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

	$ob_progress_description = array(
		'name' => __('Progress Number Description', 'lollum'),
		'data' => 'progress-description',
		'value' => $progress_description,
		'desc' => __('The description of the progress number', 'lollum')
	);

	lolfmk_pb_text($ob_progress_description);

	/*** end command ***/

	/*** begin command ***/

	$ob_progress_number_from = array(
		'name' => __('From', 'lollum'),
		'data' => 'progress-number-from',
		'value' => $progress_number_from,
		'desc' => __('The number to start counting from', 'lollum')
	);

	lolfmk_pb_text($ob_progress_number_from);

	/*** end command ***/

	/*** begin command ***/

	$ob_progress_number_to = array(
		'name' => __('To', 'lollum'),
		'data' => 'progress-number-to',
		'value' => $progress_number_to,
		'desc' => __('The number to stop counting at', 'lollum')
	);

	lolfmk_pb_text($ob_progress_number_to);

	/*** end command ***/

	/*** begin command ***/

	$ob_progress_icon = array(
		'name' => __('Icon Progress Number', 'lollum'),
		'data' => 'progress-icon',
		'value' => $progress_icon,
		'desc' => __('Select the icon of the progress number (Reference <a href="http://fortawesome.github.io/Font-Awesome/icons/">here</a>)', 'lollum')
	);

	lolfmk_pb_text($ob_progress_icon);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';
	
	lolfmk_item_after_inner();
}