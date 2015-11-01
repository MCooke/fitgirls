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
* text-banner block
******************************/

function lolfmk_print_block_text_banner_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$banner_title = (lolfmk_find_xml_value($item, 'banner-title')) ? lolfmk_find_xml_value($item, 'banner-title') : '';
	$banner_subtitle = (lolfmk_find_xml_value($item, 'banner-subtitle')) ? lolfmk_find_xml_value($item, 'banner-subtitle') : '';
	$banner_link = (lolfmk_find_xml_value($item, 'banner-link')) ? lolfmk_find_xml_value($item, 'banner-link') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-block-text-banner item-1-1" data-type="item-block-text-banner" data-item="Block-Text-Banner">';

	lolfmk_item_btns('Block-Text-Banner', 'yes');
	lolfmk_item_before_inner('Block-Text-Banner');

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

	$ob_banner_title = array(
		'name' => __('Banner Title', 'lollum'),
		'data' => 'banner-title',
		'value' => $banner_title,
		'desc' => __('The title of the block', 'lollum')
	);

	lolfmk_pb_text($ob_banner_title);

	/*** end command ***/

	/*** begin command ***/

	$ob_banner_subtitle = array(
		'name' => __('Banner Subtitle', 'lollum'),
		'data' => 'banner-subtitle',
		'value' => $banner_subtitle,
		'desc' => __('The subtitle of the block', 'lollum')
	);

	lolfmk_pb_textarea($ob_banner_subtitle);

	/*** end command ***/

	/*** begin command ***/

	$ob_banner_link = array(
		'name' => __('Banner Link', 'lollum'),
		'data' => 'banner-link',
		'value' => $banner_link,
		'desc' => __('The link of the block', 'lollum')
	);

	lolfmk_pb_text($ob_banner_link);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();		
}