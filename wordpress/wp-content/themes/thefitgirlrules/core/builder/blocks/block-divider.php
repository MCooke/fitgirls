<?php
/**
 * Lollum
 * 
 * The template for displaying the divider block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_divider')) {
	function lolfmk_print_divider($item) {
		$header_text = lolfmk_find_xml_value($item, 'divider-text');

		echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
	}
}