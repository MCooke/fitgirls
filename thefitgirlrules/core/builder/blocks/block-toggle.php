<?php
/**
 * Lollum
 * 
 * The template for displaying the toggle block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_toggle')) {
	function lolfmk_print_toggle($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$list_toggle = lolfmk_find_xml_node($item, 'child-group');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-toggle">';
		$i = 0;
		foreach ($list_toggle->childNodes as $toggle) {
			if ($i > 0) {
			$toggle_title = lolfmk_find_xml_value($toggle, 'toggle-title');
			$toggle_content = lolfmk_find_xml_value($toggle, 'toggle-content');
			$toggle_type = lolfmk_find_xml_value($toggle, 'toggle-type');
			$toggle_open = '';

			if ($toggle_type == 'open') {
				$toggle_icon = '<div class="lol-icon-toggle open"><i class="fa fa-chevron-up"></i></div>';
			} else {
				$toggle_icon = '<div class="lol-icon-toggle"><i class="fa fa-chevron-down"></i></div>';
			}
			echo '<div class="lol-toggle-header">';
			echo '<span class="lol-toggle-title">'.$toggle_title.'</span>';
			echo $toggle_icon;
			echo '</div>';
			echo '<div class="lol-toggle-content" data-toggle="'.$toggle_type.'">';
			echo '<p>'.$toggle_content.'</p>';
			echo '</div>';
			}
			$i++;
		}
		echo '</div>';
	}
}