<?php
/**
 * Lollum
 * 
 * The template for displaying the text-banner block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_block_text_banner')) {
	function lolfmk_print_block_text_banner($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$banner_title = lolfmk_find_xml_value($item, 'banner-title');
		$banner_subtitle = lolfmk_find_xml_value($item, 'banner-subtitle');
		$banner_link = lolfmk_find_xml_value($item, 'banner-link');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-text-banner-wrap">';
		if ($banner_link != '') {
			echo '<a href="'.$banner_link.'">';
		}
		echo '<div class="lol-item-text-banner">';
		echo '<h3>'.$banner_title.'</h3>';
		echo '<p>'.$banner_subtitle.'</p>';
		echo '</div>';
		if ($banner_link != '') {
			echo '</a>';
		}
		echo '</div>';
	}
}