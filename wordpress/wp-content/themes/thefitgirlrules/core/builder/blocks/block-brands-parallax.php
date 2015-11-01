<?php
/**
 * Lollum
 * 
 * The template for displaying the brands parallax block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_brands_parallax')) {
	function lolfmk_print_brands_parallax($item) {
		$brands_number = lolfmk_find_xml_value($item, 'brands-number');
		$list_brands = lolfmk_find_xml_node($item, 'child-group');

		echo '<div class="lol-item-brands-parallax cols-'.$brands_number.'">';

		$i = 0;
		foreach ($list_brands->childNodes as $brand) {
			if ($i > 0) {
				echo '<div>';
				$img_src = lolfmk_find_xml_value($brand, 'image-src');
				$alt_image = lolfmk_find_xml_value($brand, 'alt-image');
				$link_image = lolfmk_find_xml_value($brand, 'link-image');
				if ($link_image != '') {
					echo '<a href="'.$link_image.'">';
				}
				echo '<img src="'.$img_src.'" alt="'.$alt_image.'">';
				if ($link_image != '') {
					echo '</a>';
				}
				echo '</div>';
			}
			$i++;
		}

		echo '</div>';
	}
}