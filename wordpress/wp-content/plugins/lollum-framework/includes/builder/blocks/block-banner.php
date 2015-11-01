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
* banner block
******************************/

function lolfmk_print_block_banner_admin($item = null) {
	global $lolfmk_margin_full;
	$block_title = (lolfmk_find_xml_value($item, 'block-title')) ? lolfmk_find_xml_value($item, 'block-title') : '';
	$block_content = (lolfmk_find_xml_value($item, 'block-content')) ? lolfmk_find_xml_value($item, 'block-content') : '';
	$text_color = (lolfmk_find_xml_value($item, 'text-color')) ? lolfmk_find_xml_value($item, 'text-color') : '';
	$block_image = (lolfmk_find_xml_value($item, 'block-image')) ? lolfmk_find_xml_value($item, 'block-image') : '';
	$alt_image = (lolfmk_find_xml_value($item, 'alt-image')) ? lolfmk_find_xml_value($item, 'alt-image') : '';
	$btn_text = (lolfmk_find_xml_value($item, 'btn-text')) ? lolfmk_find_xml_value($item, 'btn-text') : '';
	$btn_url = (lolfmk_find_xml_value($item, 'btn-url')) ? lolfmk_find_xml_value($item, 'btn-url') : '';
	$bg_color = (lolfmk_find_xml_value($item, 'bg-color')) ? lolfmk_find_xml_value($item, 'bg-color') : '#ffffff';
	$bg_src = (lolfmk_find_xml_value($item, 'bg-src')) ? lolfmk_find_xml_value($item, 'bg-src') : '';
	$parallax_effect = (lolfmk_find_xml_value($item, 'parallax-effect')) ? lolfmk_find_xml_value($item, 'parallax-effect') : '';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-block-banner item-1-1" data-type="item-block-banner" data-item="Block-Banner">';

	lolfmk_item_btns('Block-Banner', 'yes');
	lolfmk_item_before_inner('Block-Banner');

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

	$ob_block_content = array(
		'name' => __('Block Content', 'lollum'),
		'data' => 'block-content',
		'value' => $block_content,
		'desc' => __('The content of the block', 'lollum')
	);

	lolfmk_pb_textarea($ob_block_content);

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

	$ob_block_image = array(
		'name' => __('Block Image', 'lollum'),
		'data' => 'block-image',
		'value' => $block_image,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_block_image);

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

	/*** begin command ***/

	$ob_bg_src = array(
		'name' => __('Background Image', 'lollum'),
		'data' => 'bg-src',
		'value' => $bg_src,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_bg_src);

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