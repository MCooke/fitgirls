<?php
/**
 * Lollum
 * 
 * The template for displaying the banner block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_block_banner')) {
	function lolfmk_print_block_banner($item) {
		$block_title = lolfmk_find_xml_value($item, 'block-title');
		$block_content = lolfmk_find_xml_value($item, 'block-content');
		$block_image = lolfmk_find_xml_value($item, 'block-image');
		$alt_image = lolfmk_find_xml_value($item, 'alt-image');
		$btn_text = lolfmk_find_xml_value($item, 'btn-text');
		$btn_url = lolfmk_find_xml_value($item, 'btn-url');
		$text_color = lolfmk_find_xml_value($item, 'text-color');

		echo '<div class="lol-item-block-banner '.$text_color.'">';
		echo '<div class="row">';
		echo '<div class="col-6">';
		echo '<img src="'.$block_image.'" alt="'.$alt_image.'">';
		echo "</div>";
		echo '<div class="block-banner-content col-6">';
		echo '<h3>'.$block_title.'</h3>';
		echo '<div>'.do_shortcode($block_content).'</div>';
		if ($btn_text != '') {
			echo '<a href="'.$btn_url.'" class="lol-button-block">'.$btn_text.'</a>';
		}
		echo "</div>";
		echo "</div>";
		echo '</div>';
	}
}