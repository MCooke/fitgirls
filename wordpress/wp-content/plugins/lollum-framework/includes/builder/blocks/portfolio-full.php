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
* portfolio full block
******************************/

function lolfmk_print_portfolio_full_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$portfolio_type = (lolfmk_find_xml_value($item, 'portfolio-type')) ? lolfmk_find_xml_value($item, 'portfolio-type') : '';
	$project_number = (lolfmk_find_xml_value($item, 'project-number')) ? lolfmk_find_xml_value($item, 'project-number') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-portfolio-full item-1-1" data-type="item-portfolio-full" data-item="Portfolio-Full">';

	lolfmk_item_btns('Portfolio-Full', 'yes');
	lolfmk_item_before_inner('Portfolio-Full');

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

	$ob_project_type = array(
		'name' => __('Portfolio Type', 'lollum'),
		'data' => 'portfolio-type',
		'value' => $portfolio_type,
		'options' => array('recent', 'loved', 'random'),
		'desc' => __('Display your projects sorted by date, by "loves" or in random order', 'lollum')
	);

	lolfmk_pb_simple_select($ob_project_type);

	/*** end command ***/

	/*** begin command ***/

	$ob_project_number = array(
		'name' => __('Number of Projects', 'lollum'),
		'data' => 'project-number',
		'value' => $project_number,
		'options' => array('4', '8'),
		'desc' => __('Select the number of projects', 'lollum')
	);

	lolfmk_pb_simple_select($ob_project_number);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';

	lolfmk_item_after_inner();
}