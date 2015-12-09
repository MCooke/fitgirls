<?php
/**
 * Lollum
 * 
 * The template for displaying the image block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_image')) {
	function lolfmk_print_image($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$alt_image = lolfmk_find_xml_value($item, 'alt-image');
		$src = lolfmk_find_xml_value($item, 'image-src');
		$image_alignment = lolfmk_find_xml_value($item, 'image-alignment');
		$image_link = lolfmk_find_xml_value($item, 'image-link');
		$image_lightbox = lolfmk_find_xml_value($item, 'image-lightbox');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-image lol-'.$image_alignment.'">';
		if ($image_link != '') {
			if ($image_lightbox == 'yes') {
				echo '<a href="'.$image_link.'" data-rel="prettyPhoto">';
			} else {
				echo '<a href="'.$image_link.'">';
			}
		}
		echo '<img src="'.$src.'" alt="'.$alt_image.'">';
		if ($image_link != '') {
			echo '</a>';
		}
		echo '</div>';
	}
}