<?php
/**
 * Lollum
 * 
 * The template for displaying the column block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_column')) {
	function lolfmk_print_column($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$text = lolfmk_find_xml_value($item, 'text-column');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-column">'.do_shortcode($text).'</div>';
	}
}