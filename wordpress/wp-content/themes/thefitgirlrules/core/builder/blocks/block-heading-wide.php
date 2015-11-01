<?php
/**
 * Lollum
 * 
 * The template for displaying the heading wide block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_heading_wide')) {
	function lolfmk_print_heading_wide($item) {
		$heading_text = lolfmk_find_xml_value($item, 'heading-text');

		echo '<div class="lol-item-heading-wide">';
		echo '<h2>'.$heading_text.'</h2>';
		echo '</div>';
	}
}