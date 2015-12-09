<?php
/**
 * Lollum
 * 
 * The template for displaying the call to action block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_call_to_action')) {
	function lolfmk_print_call_to_action($item) {
		$block_title = lolfmk_find_xml_value($item, 'block-title');
		$btn_text = lolfmk_find_xml_value($item, 'btn-text');
		$btn_url = lolfmk_find_xml_value($item, 'btn-url');
		$text_color = lolfmk_find_xml_value($item, 'text-color');

		echo '<div class="lol-item-call-to-action '.$text_color.'">';
		echo '<h3>'.$block_title.'</h3>';
		echo '<a href="'.$btn_url.'" class="lol-button-block">'.$btn_text.'</a>';
		echo '</div>';
	}
}