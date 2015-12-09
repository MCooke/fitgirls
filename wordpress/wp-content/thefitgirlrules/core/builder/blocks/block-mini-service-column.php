<?php
/**
 * Lollum
 * 
 * The template for displaying the mini service column block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_mini_service_column')) {
	function lolfmk_print_mini_service_column($item) {
		$service_title = lolfmk_find_xml_value($item, 'service-title');
		$service_text = lolfmk_find_xml_value($item, 'service-text');
		$service_icon = lolfmk_find_xml_value($item, 'service-icon');
		$service_url = lolfmk_find_xml_value($item, 'service-url');
		$service_margin = lolfmk_find_xml_value($item, 'service-margin');

		echo '<div class="lol-item-mini-service-column '.$service_margin.'">';
		echo '<i class="mini-service-icon fa '.$service_icon.'"></i>';
		echo '<h3>'.$service_title.'</h3>';
		echo '<p>'.$service_text.'</p>';
		if ($service_url != '') {
			echo '<a href="'.$service_url.'" class="more">'.__('Read more', 'lollum').'<i class="fa fa-angle-right"></i></a>';
		}
		echo '</div>';
	}
}