<?php
/**
 * Lollum
 * 
 * The template for displaying the image text block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_image_text')) {
	function lolfmk_print_image_text($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$text_image = lolfmk_find_xml_value($item, 'text-image');
		$src = lolfmk_find_xml_value($item, 'image-src');
		$image_link = lolfmk_find_xml_value($item, 'image-link');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-image-text">';
		if ($image_link != '') {
			echo '<a href="'.$image_link.'" class="image-mask">';
		} else {
			echo '<div class="image-mask">';
		}
		echo '<h3>'.$text_image.'</h3>';
		echo '<img src="'.$src.'" alt="'.$text_image.'">';
		if ($image_link != '') {
			echo '</a>';
		} else {
			echo '</div>';
		}
		echo '</div>';
	}
}