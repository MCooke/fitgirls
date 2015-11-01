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
* FAQs block
******************************/

function lolfmk_print_faqs_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$faq_layout = (lolfmk_find_xml_value($item, 'faq-layout')) ? lolfmk_find_xml_value($item, 'faq-layout') : '';
	$faq_type = (lolfmk_find_xml_value($item, 'faq-type')) ? lolfmk_find_xml_value($item, 'faq-type') : '';
	$faq_description = (lolfmk_find_xml_value($item, 'faq-description')) ? lolfmk_find_xml_value($item, 'faq-description') : '';
	$faq_category = (lolfmk_find_xml_value($item, 'faq-category')) ? lolfmk_find_xml_value($item, 'faq-category') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-faqs item-1-1" data-type="item-faqs" data-item="FAQs">';

	lolfmk_item_btns('FAQs', 'yes');
	lolfmk_item_before_inner('FAQs');

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

	$ob_faq_layout = array(
		'name' => __('Layout', 'lollum'),
		'data' => 'faq-layout',
		'value' => $faq_layout,
		'options' => array('1', '2'),
		'desc' => __('Select the layout of your faqs', 'lollum')
	);

	lolfmk_pb_simple_select($ob_faq_layout);

	/*** end command ***/

	/*** begin command ***/

	$ob_faq_type = array(
		'name' => __('Filterable', 'lollum'),
		'data' => 'faq-type',
		'value' => $faq_type,
		'options' => array('yes', 'no'),
		'desc' => __('Select the state of the toggle on page load (layout 1 only)', 'lollum')
	);

	lolfmk_pb_simple_select($ob_faq_type);

	/*** end command ***/

	/*** begin command ***/

	$ob_faq_description = array(
		'name' => __('FAQ Description', 'lollum'),
		'data' => 'faq-description',
		'value' => $faq_description,
		'desc' => __('The desciption of this section (layout 2 only)', 'lollum')
	);

	lolfmk_pb_textarea($ob_faq_description);

	/*** end command ***/

	/*** begin command ***/

	$faq_categories = get_terms("faqs-categories");
	$lol_faqs = array(
		'all' => 'All'
	);
	foreach ($faq_categories as $faq_cat) {  
		$lol_faqs[$faq_cat->slug] = $faq_cat->name;  
	}

	$ob_faq_cats = array(
		'name' => __('FAQ Category', 'lollum'),
		'data' => 'faq-category',
		'value' => $faq_category,
		'options' => $lol_faqs,
		'desc' => __('Here you can filter your FAQs (layout 2 only)', 'lollum')
	);

	lolfmk_pb_select($ob_faq_cats);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';

	lolfmk_item_after_inner();
}