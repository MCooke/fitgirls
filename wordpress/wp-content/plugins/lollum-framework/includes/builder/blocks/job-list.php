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
* job list block
******************************/

function lolfmk_print_job_list_admin($item = null) {
	$job_cats = (lolfmk_find_xml_value($item, 'job-category')) ? lolfmk_find_xml_value($item, 'job-category') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-job-list item-'.$size.'" data-type="item-job-list" data-item="Job-List">';

	lolfmk_item_btns('Job-List', 'yes', 'yes');
	lolfmk_item_before_inner('Job-List');

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

	$lol_job_cats = array();

	$taxonomy = 'job-categories';
	$tax_terms = get_terms($taxonomy);
	$lol_job_cats = array();
	foreach ($tax_terms as $tax_term) {  
		$lol_job_cats[$tax_term->slug] = $tax_term->name;  
	}

	$ob_job_cats = array(
		'name' => __('Job Category', 'lollum'),
		'data' => 'job-category',
		'value' => $job_cats,
		'options' => $lol_job_cats,
		'desc' => __('Select the job category.', 'lollum')
	);

	lolfmk_pb_select($ob_job_cats);

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}