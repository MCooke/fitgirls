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
* image parallax block
******************************/

function lolfmk_print_image_parallax_admin($item = null) {
	global $lolfmk_margin_full;
	$src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$parallax_effect = (lolfmk_find_xml_value($item, 'parallax-effect')) ? lolfmk_find_xml_value($item, 'parallax-effect') : '';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-image-parallax item-1-1" data-type="item-image-parallax" data-item="Image-Parallax">';

	lolfmk_item_btns('Image-Parallax', 'yes');
	lolfmk_item_before_inner('Image-Parallax');

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

	$ob_image_src = array(
		'name' => __('Image Background', 'lollum'),
		'data' => 'image-src',
		'value' => $src,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_image_src);

	/*** end command ***/

	/*** begin command ***/

	$ob_parallax = array(
		'name' => __('Parallax Effect', 'lollum'),
		'data' => 'parallax-effect',
		'value' => $parallax_effect,
		'options' => array('parallax-yes', 'parallax-no'),
		'desc' => __('Select "parallax-yes" for a parallax effect', 'lollum')
	);

	lolfmk_pb_simple_select($ob_parallax);

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