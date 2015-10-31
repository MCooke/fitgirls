<?php
/**
 * Lollum
 * 
 * The template for displaying the heading block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_heading')) {
	function lolfmk_print_heading($item) {
		$heading_text = lolfmk_find_xml_value($item, 'heading-text');
		$heading_sub = lolfmk_find_xml_value($item, 'heading-sub');

		echo '<div class="lol-item-heading">';
		echo '<h2>'.$heading_text.'</h2>';
		if ($heading_sub) {
			echo '<p>'.$heading_sub.'</p>';
		}
		echo '</div>';
	}
}