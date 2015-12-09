<?php
/**
 * Lollum
 * 
 * The template for displaying the space block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_space')) {
	function lolfmk_print_space($item) {
		$space_height = lolfmk_find_xml_value($item, 'space-height');

		echo '<div class="lol-item-space" style="height:'.$space_height.'px"></div>';
	}
}