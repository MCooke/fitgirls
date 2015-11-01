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
* image text block
******************************/

function lolfmk_print_image_text_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$text_image = (lolfmk_find_xml_value($item, 'text-image')) ? lolfmk_find_xml_value($item, 'text-image') : '';
	$src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$image_link = (lolfmk_find_xml_value($item, 'image-link')) ? lolfmk_find_xml_value($item, 'image-link') : '';

	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-image-text item-'.$size.'" data-type="item-image-text" data-item="Image-Text">';

	lolfmk_item_btns('Image-Text', 'yes', 'yes');
	lolfmk_item_before_inner('Image-Text');

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

	$ob_text_image = array(
		'name' => __('Text Image', 'lollum'),
		'data' => 'text-image',
		'value' => $text_image,
		'desc' => __('Type the title of the block', 'lollum')
	);

	lolfmk_pb_text($ob_text_image);

	/*** end command ***/

	/*** begin command ***/

	$ob_image_src = array(
		'name' => __('Image URL', 'lollum'),
		'data' => 'image-src',
		'value' => $src,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_image_src);

	/*** end command ***/

	/*** begin command ***/

	$ob_image_link = array(
		'name' => __('Image Link', 'lollum'),
		'data' => 'image-link',
		'value' => $image_link,
		'desc' => __('The URL to point to (optional)', 'lollum')
	);

	lolfmk_pb_text($ob_image_link);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';
	
	lolfmk_item_after_inner();
}