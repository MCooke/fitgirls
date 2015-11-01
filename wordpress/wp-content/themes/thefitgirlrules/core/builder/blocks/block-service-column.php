<?php
/**
 * Lollum
 * 
 * The template for displaying the service column block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_service_column')) {
	function lolfmk_print_service_column($item) {
		$service_title = lolfmk_find_xml_value($item, 'service-title');
		$service_text = lolfmk_find_xml_value($item, 'service-text');
		$service_icon = lolfmk_find_xml_value($item, 'service-icon');
		$service_url = lolfmk_find_xml_value($item, 'service-url');

		echo '<div class="lol-item-service-column">';
		echo '<i class="service-icon fa '.$service_icon.'"></i>';
		echo '<h3>';
		if ($service_url != '') {
			echo '<a href="'.$service_url.'">';
		}
		echo $service_title;
		if ($service_url != '') {
			echo '</a>';
		}
		echo '</h3>';
		echo '<p>'.$service_text.'</p>';
		
		echo '</div>';
	}
}