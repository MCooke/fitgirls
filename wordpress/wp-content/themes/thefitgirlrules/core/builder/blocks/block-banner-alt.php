<?php
/**
 * Lollum
 * 
 * The template for displaying the banner (alt) block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_block_banner_alt')) {
	function lolfmk_print_block_banner_alt($item) {
		$block_title = lolfmk_find_xml_value($item, 'block-title');
		$block_content = lolfmk_find_xml_value($item, 'block-content');
		$text_color = lolfmk_find_xml_value($item, 'text-color');

		echo '<div class="lol-item-block-banner-alt '.$text_color.'">';
		echo '<h3>'.$block_title.'</h3>';
		echo '<div class="block-banner-content">'.do_shortcode($block_content).'</div>';
		echo '</div>';
	}
}