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
* feature block
******************************/

function lolfmk_print_block_feature_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$feature_title = (lolfmk_find_xml_value($item, 'feature-title')) ? lolfmk_find_xml_value($item, 'feature-title') : '';
	$feature_content = (lolfmk_find_xml_value($item, 'feature-content')) ? lolfmk_find_xml_value($item, 'feature-content') : '';
	$feature_image = (lolfmk_find_xml_value($item, 'feature-image')) ? lolfmk_find_xml_value($item, 'feature-image') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-block-feature item-1-2" data-type="item-block-feature" data-item="Block-Feature">';

	lolfmk_item_btns('Block-Feature', 'yes');
	lolfmk_item_before_inner('Block-Feature');

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

	$ob_feature_title = array(
		'name' => __('Feature Title', 'lollum'),
		'data' => 'feature-title',
		'value' => $feature_title,
		'desc' => __('The title of the block', 'lollum')
	);

	lolfmk_pb_text($ob_feature_title);

	/*** end command ***/

	/*** begin command ***/

	$ob_feature_content = array(
		'name' => __('Feature Content', 'lollum'),
		'data' => 'feature-content',
		'value' => $feature_content,
		'desc' => __('The content of the block', 'lollum')
	);

	lolfmk_pb_textarea($ob_feature_content);

	/*** end command ***/

	/*** begin command ***/

	$ob_feature_image = array(
		'name' => __('Feature Image', 'lollum'),
		'data' => 'feature-image',
		'value' => $feature_image,
		'desc' => __('The image of the block', 'lollum')
	);

	lolfmk_pb_upload($ob_feature_image);

	/*** end command ***/
	
	echo '<input class="item-size xml" type="hidden" value="1-2" data-type="size">';
	
	lolfmk_item_after_inner();		
}