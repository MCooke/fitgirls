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
* embed video block
******************************/

function lolfmk_print_embed_video_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$block_video_embed = (lolfmk_find_xml_value($item, 'block-video-embed')) ? lolfmk_find_xml_value($item, 'block-video-embed') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-embed-video item-'.$size.'" data-type="item-embed-video" data-item="Embed-Video">';

	lolfmk_item_btns('Embed-Video', 'yes', 'yes');
	lolfmk_item_before_inner('Embed-Video');

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

	$ob_block_video_embed = array(
		'name' => __('Embed Code', 'lollum'),
		'data' => 'block-video-embed',
		'value' => $block_video_embed,
		'desc' => __('The embed code of the video (Youtube and Vimeo)', 'lollum')
	);

	lolfmk_pb_textarea($ob_block_video_embed);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}