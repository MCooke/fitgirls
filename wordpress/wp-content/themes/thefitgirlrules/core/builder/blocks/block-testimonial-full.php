<?php
/**
 * Lollum
 * 
 * The template for displaying the testimonial full block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_testimonial_full')) {
	function lolfmk_print_testimonial_full($item) {
		$list_testimonials = lolfmk_find_xml_node($item, 'child-group');
		$text_color = lolfmk_find_xml_value($item, 'text-color');
		$block_title = lolfmk_find_xml_value($item, 'block-title');

		echo '<div class="lol-item-testimonial-full '.$text_color.'">';
		echo '<h3>'.$block_title.'</h3>';
		echo '<div class="flexslider flex-testimonial">';
		echo '<ul class="slides">';
		echo '<div class="preloader"></div>';
		$i = 0;
		foreach ($list_testimonials->childNodes as $testimonial) {
			if ($i > 0) {
				$testimonial_text = lolfmk_find_xml_value($testimonial, 'testimonial-text');
				$testimonial_author = lolfmk_find_xml_value($testimonial, 'testimonial-author');
				$testimonial_subtitle = lolfmk_find_xml_value($testimonial, 'testimonial-subtitle');
				echo '<li>';
				echo '<blockquote class="testimonial-content">'.$testimonial_text.'</blockquote>';
				echo '<div class="testimonial-meta">';
				echo '<cite>'.$testimonial_author.'</cite>';
				if ($testimonial_subtitle) {
					echo '<span class="sep">-</span>';
					echo '<span>'.$testimonial_subtitle.'</span>';
				}
				echo '</div>';
				echo '</li>';
			}
			$i++;
		}
		echo '</ul>';
		echo '</div>';
		echo '</div>';
	}
}