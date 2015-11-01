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
* member block
******************************/

function lolfmk_print_member_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';

	$member_id = (lolfmk_find_xml_value($item, 'member-id')) ? lolfmk_find_xml_value($item, 'member-id') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-member item-'.$size.'" data-type="item-member" data-item="Member">';

	lolfmk_item_btns('Member', 'yes', 'yes');
	lolfmk_item_before_inner('Member');

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

	$lol_members_ids = array();
	$args = array(
		'post_type' => 'lolfmk-team',
		'numberposts' => -1
	);
	$members_array = get_posts($args);
	foreach ($members_array as $members_single) {
		$lol_members_ids[$members_single->ID] = $members_single->post_title;
	}

	$ob_member_id = array(
		'name' => __('Member', 'lollum'),
		'data' => 'member-id',
		'value' => $member_id,
		'options' => $lol_members_ids,
		'desc' => __('Select a member of your team', 'lollum')
	);

	lolfmk_pb_select($ob_member_id);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}