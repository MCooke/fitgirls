<?php
/**
 * Lollum
 * 
 * The template for displaying the embed video block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_embed_video')) {
	function lolfmk_print_embed_video($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$block_video_embed = lolfmk_find_xml_value($item, 'block-video-embed');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-embed-video">'.$block_video_embed.'</div>';
	}
}