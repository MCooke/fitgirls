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
* image block
******************************/

function lolfmk_print_image_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$alt_image = (lolfmk_find_xml_value($item, 'alt-image')) ? lolfmk_find_xml_value($item, 'alt-image') : '';
	$src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$image_alignment = (lolfmk_find_xml_value($item, 'image-alignment')) ? lolfmk_find_xml_value($item, 'image-alignment') : '';
	$image_link = (lolfmk_find_xml_value($item, 'image-link')) ? lolfmk_find_xml_value($item, 'image-link') : '';
	$image_lightbox = (lolfmk_find_xml_value($item, 'image-lightbox')) ? lolfmk_find_xml_value($item, 'image-lightbox') : '';

	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-image item-'.$size.'" data-type="item-image" data-item="Image">';

	lolfmk_item_btns('Image', 'yes', 'yes');
	lolfmk_item_before_inner('Image');

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

	$ob_alt_image = array(
		'name' => __('Alt Image', 'lollum'),
		'data' => 'alt-image',
		'value' => $alt_image,
		'desc' => __('Type the alt attribute of your image', 'lollum')
	);

	lolfmk_pb_text($ob_alt_image);

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

	/*** begin command ***/

	$ob_image_lightbox = array(
		'name' => __('Lightbox', 'lollum'),
		'data' => 'image-lightbox',
		'value' => $image_lightbox,
		'options' => array('no', 'yes'),
		'desc' => __('Select "yes" to enable the lightbox feature. Remember that you need to insert the URL of this image in "Image Link"', 'lollum')
	);

	lolfmk_pb_simple_select($ob_image_lightbox);

	/*** end command ***/

	/*** begin command ***/

	$ob_image_alignment = array(
		'name' => __('Image Alignment', 'lollum'),
		'data' => 'image-alignment',
		'value' => $image_alignment,
		'options' => array('left', 'center', 'right'),
		'desc' => __('Select the alignment of the image', 'lollum')
	);

	lolfmk_pb_simple_select($ob_image_alignment);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';
	
	lolfmk_item_after_inner();
}