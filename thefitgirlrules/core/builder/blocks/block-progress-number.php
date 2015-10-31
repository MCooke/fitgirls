<?php
/**
 * Lollum
 * 
 * The template for displaying the progress number block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_progress_number')) {
	function lolfmk_print_progress_number($item) {
		$progress_description = lolfmk_find_xml_value($item, 'progress-description');
		$progress_number_from = lolfmk_find_xml_value($item, 'progress-number-from');
		$progress_number_to = lolfmk_find_xml_value($item, 'progress-number-to');
		$progress_icon = lolfmk_find_xml_value($item, 'progress-icon');

		echo '<div class="progress-number">';
		echo '<i class="fa '.$progress_icon.'"></i>';
		echo '<span class="timer" data-from="'.$progress_number_from.'" data-to="'.$progress_number_to.'" data-speed="1000"></span>';
		echo '<span class="nojs-timer">'.$progress_number_to.'</span>';
		echo '<p>'.$progress_description.'</p>';
		echo '</div>';
	}
}