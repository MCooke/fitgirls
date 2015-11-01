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
* post block
******************************/

function lolfmk_print_project_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$project_id = (lolfmk_find_xml_value($item, 'project-id')) ? lolfmk_find_xml_value($item, 'project-id') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-project item-'.$size.'" data-type="item-project" data-item="Project">';

	lolfmk_item_btns('Project', 'yes', 'yes');
	lolfmk_item_before_inner('Project');

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

	$lol_projects_ids = array();
	$args = array(
		'post_type' => 'lolfmk-portfolio',
		'numberposts' => -1
	);
	$projects_array = get_posts($args);
	foreach ($projects_array as $projects_single) {
		$lol_projects_ids[$projects_single->ID] = $projects_single->post_title;
	}	

	$ob_project_id = array(
		'name' => __('Project Title', 'lollum'),
		'data' => 'project-id',
		'value' => $project_id,
		'options' => $lol_projects_ids,
		'desc' => __('Select your project', 'lollum')
	);

	lolfmk_pb_select($ob_project_id);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}