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
* video block
******************************/

function lolfmk_print_block_video_admin($item = null) {
	$block_title = (lolfmk_find_xml_value($item, 'block-title')) ? lolfmk_find_xml_value($item, 'block-title') : '';
	$block_subtitle = (lolfmk_find_xml_value($item, 'block-subtitle')) ? lolfmk_find_xml_value($item, 'block-subtitle') : '';
	$text_color = (lolfmk_find_xml_value($item, 'text-color')) ? lolfmk_find_xml_value($item, 'text-color') : '';
	$block_video_embed = (lolfmk_find_xml_value($item, 'block-video-embed')) ? lolfmk_find_xml_value($item, 'block-video-embed') : '';
	$bg_color = (lolfmk_find_xml_value($item, 'bg-color')) ? lolfmk_find_xml_value($item, 'bg-color') : '#ffffff';
	$src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$parallax_effect = (lolfmk_find_xml_value($item, 'parallax-effect')) ? lolfmk_find_xml_value($item, 'parallax-effect') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-block-video item-1-1" data-type="item-block-video" data-item="Block-Video">';

	lolfmk_item_btns('Block-Video', 'yes', 'yes');
	lolfmk_item_before_inner('Block-Video');

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

	$ob_block_subtitle = array(
		'name' => __('Block Subtitle', 'lollum'),
		'data' => 'block-subtitle',
		'value' => $block_subtitle,
		'desc' => __('The subtitle of the block', 'lollum')
	);

	lolfmk_pb_text($ob_block_subtitle);

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

	$ob_block_video_embed = array(
		'name' => __('Embed Code', 'lollum'),
		'data' => 'block-video-embed',
		'value' => $block_video_embed,
		'desc' => __('The embed code of the video (Youtube and Vimeo)', 'lollum')
	);

	lolfmk_pb_textarea($ob_block_video_embed);

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
	
	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();		
}