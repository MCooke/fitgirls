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
* info block
******************************/

function lolfmk_print_info_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$text = (lolfmk_find_xml_value($item, 'info-text')) ? lolfmk_find_xml_value($item, 'info-text') : '';
	$address = (lolfmk_find_xml_value($item, 'info-address')) ? lolfmk_find_xml_value($item, 'info-address') : '';
	$tel = (lolfmk_find_xml_value($item, 'info-tel')) ? lolfmk_find_xml_value($item, 'info-tel') : '';
	$fax = (lolfmk_find_xml_value($item, 'info-fax')) ? lolfmk_find_xml_value($item, 'info-fax') : '';
	$email = (lolfmk_find_xml_value($item, 'info-email')) ? lolfmk_find_xml_value($item, 'info-email') : '';
	$web = (lolfmk_find_xml_value($item, 'info-web')) ? lolfmk_find_xml_value($item, 'info-web') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-info item-'.$size.'" data-type="item-info" data-item="Info">';

	lolfmk_item_btns('Info', 'yes', 'yes');
	lolfmk_item_before_inner('Info');

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

	$ob_info_text = array(
		'name' => __('Info Text', 'lollum'),
		'data' => 'info-text',
		'value' => $text,
		'desc' => __('Type the text of your info block', 'lollum')
	);

	lolfmk_pb_textarea($ob_info_text);

	/*** end command ***/

	/*** begin command ***/

	$ob_info_address = array(
		'name' => __('Info Address', 'lollum'),
		'data' => 'info-address',
		'value' => $address,
		'desc' => __('Type your company address', 'lollum')
	);

	lolfmk_pb_text($ob_info_address);

	/*** end command ***/

	/*** begin command ***/

	$ob_info_tel = array(
		'name' => __('Info Tel', 'lollum'),
		'data' => 'info-tel',
		'value' => $tel,
		'desc' => __('Type your company phone number', 'lollum')
	);

	lolfmk_pb_text($ob_info_tel);

	/*** end command ***/

	/*** begin command ***/

	$ob_info_fax = array(
		'name' => __('Info Fax', 'lollum'),
		'data' => 'info-fax',
		'value' => $fax,
		'desc' => __('Type your company fax number', 'lollum')
	);

	lolfmk_pb_text($ob_info_fax);

	/*** end command ***/

	/*** begin command ***/

	$ob_info_email = array(
		'name' => __('Info E-mail', 'lollum'),
		'data' => 'info-email',
		'value' => $email,
		'desc' => __('Type your company email', 'lollum')
	);

	lolfmk_pb_text($ob_info_email);

	/*** end command ***/

	/*** begin command ***/

	$ob_info_web = array(
		'name' => __('Info Web', 'lollum'),
		'data' => 'info-web',
		'value' => $web,
		'desc' => __('Type your company website', 'lollum')
	);

	lolfmk_pb_text($ob_info_web);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}