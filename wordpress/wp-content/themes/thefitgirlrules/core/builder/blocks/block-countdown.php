<?php
/**
 * Lollum
 * 
 * The template for displaying the countdown block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_countdown')) {
	function lolfmk_print_countdown($item) {
		$block_title = lolfmk_find_xml_value($item, 'block-title');
		$event_date = lolfmk_find_xml_value($item, 'event-date');
		$event_text = lolfmk_find_xml_value($item, 'event-text');
		$bg_color = lolfmk_find_xml_value($item, 'bg-color');
		$src = lolfmk_find_xml_value($item, 'image-src');
		$parallax_effect = lolfmk_find_xml_value($item, 'parallax-effect');
		$text_color = lolfmk_find_xml_value($item, 'text-color');

		$datetime1 = new DateTime($event_date);
		$datetime2 = new DateTime();
		$interval = $datetime1->diff($datetime2);
		$days = $interval->format('%a');
		$hours = $interval->format('%h');
		$min = $interval->format('%i');
		$sec = $interval->format('%s');
		$total = $days*24*60*60 + $hours*60*60 + $min*60 + $sec;

		echo '<div id="countdown" data-countdown="'.$total.'" class="'.$text_color.'">';
		echo '<div id="count-end">'.$event_text.'</div>';
		echo '<h3>'.$block_title.'</h3>';
		echo '<div id="countdown-wrap">';
		echo '<div class="count-wrap">';
		echo '<div class="count">';
		echo '<div class="count-value" id="days">'.$days.'</div>';
		echo '<div class="count-label">'.__("Days", "lollum").'</div>';
		echo '</div>';
		echo '<div class="count">';
		echo '<div class="count-value" id="hours">'.$hours.'</div>';
		echo '<div class="count-label">'.__("Hours", "lollum").'</div>';
		echo '</div>';
		echo '</div>';
		echo '<div class="count-wrap">';
		echo '<div class="count">';
		echo '<div class="count-value" id="minutes">'.$min.'</div>';
		echo '<div class="count-label">'.__("Min", "lollum").'</div>';
		echo '</div>';
		echo '<div class="count">';
		echo '<div class="count-value" id="seconds">'.$sec.'</div>';
		echo '<div class="count-label">'.__("Sec", "lollum").'</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}