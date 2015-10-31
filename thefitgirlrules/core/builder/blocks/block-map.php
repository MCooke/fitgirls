<?php
/**
 * Lollum
 * 
 * The template for displaying the map block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_map')) {
	function lolfmk_print_map($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$map_lat = lolfmk_find_xml_value($item, 'map-lat');
		$map_lng = lolfmk_find_xml_value($item, 'map-lng');
		$map_zoom = lolfmk_find_xml_value($item, 'map-zoom');
		$map_size = lolfmk_find_xml_value($item, 'map-size');
		$map_marker = lolfmk_find_xml_value($item, 'map-marker');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="map-canvas-wrapper" data-lat="'.$map_lat.'" data-lng="'.$map_lng.'" data-zoom="'.$map_zoom.'" data-uri="'.LOLLUM_URI.'" data-marker="marker-'.$map_marker.'"><div class="map-canvas '.$map_size.'"></div></div>';
	}
}