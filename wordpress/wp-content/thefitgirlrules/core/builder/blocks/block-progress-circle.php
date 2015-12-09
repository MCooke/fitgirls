<?php
/**
 * Lollum
 * 
 * The template for displaying the progress circle block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_progress_circle')) {
	function lolfmk_print_progress_circle($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$skill = lolfmk_find_xml_value($item, 'skill');
		$level = lolfmk_find_xml_value($item, 'level');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="progress-circle">';
		echo '<div class="chart" data-percent="'.$level.'"><span>%</span></div>';
		echo '<div>'.$skill.'</div>';
		echo '</div>';
	}
}