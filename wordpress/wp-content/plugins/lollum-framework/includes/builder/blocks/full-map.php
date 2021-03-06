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
* full map block
******************************/

function lolfmk_print_full_map_admin($item = null) {
	global $lolfmk_margin_full;
	$map_lat = (lolfmk_find_xml_value($item, 'map-lat')) ? lolfmk_find_xml_value($item, 'map-lat') : '';
	$map_lng = (lolfmk_find_xml_value($item, 'map-lng')) ? lolfmk_find_xml_value($item, 'map-lng') : '';
	$map_zoom = (lolfmk_find_xml_value($item, 'map-zoom')) ? lolfmk_find_xml_value($item, 'map-zoom') : '';
	$map_size = (lolfmk_find_xml_value($item, 'map-size')) ? lolfmk_find_xml_value($item, 'map-size') : '';
	$map_marker = (lolfmk_find_xml_value($item, 'map-marker')) ? lolfmk_find_xml_value($item, 'map-marker') : '';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-full-map item-1-1" data-type="item-full-map" data-item="Full-Map">';

	lolfmk_item_btns('Full-Map', 'yes');
	lolfmk_item_before_inner('Full-Map');

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

	$ob_map_lat = array(
		'name' => __('Latitude', 'lollum'),
		'data' => 'map-lat',
		'value' => $map_lat,
		'desc' => __('The latitude of the place', 'lollum')
	);

	lolfmk_pb_text($ob_map_lat);

	/*** end command ***/

	/*** begin command ***/

	$ob_map_lng = array(
		'name' => __('Longitude', 'lollum'),
		'data' => 'map-lng',
		'value' => $map_lng,
		'desc' => __('The longitude of the place', 'lollum')
	);

	lolfmk_pb_text($ob_map_lng);

	/*** end command ***/

	/*** begin command ***/

	$ob_map_zoom = array(
		'name' => __('Zoom', 'lollum'),
		'data' => 'map-zoom',
		'value' => $map_zoom,
		'options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'),
		'desc' => __('The initial zoom of the map. A value from 0 to 19', 'lollum')
	);

	lolfmk_pb_simple_select($ob_map_zoom);

	/*** end command ***/

	/*** begin command ***/

	$ob_map_size = array(
		'name' => __('Map Size', 'lollum'),
		'data' => 'map-size',
		'value' => $map_size,
		'options' => array('small', 'normal', 'big'),
		'desc' => __('Select the size (height) of the map', 'lollum')
	);

	lolfmk_pb_simple_select($ob_map_size);

	/*** end command ***/

	/*** begin command ***/

	$ob_map_marker = array(
		'name' => __('Map Marker', 'lollum'),
		'data' => 'map-marker',
		'value' => $map_marker,
		'options' => array('no', 'yes'),
		'desc' => __('Select "yes" to display the marker on the map', 'lollum')
	);

	lolfmk_pb_simple_select($ob_map_marker);

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