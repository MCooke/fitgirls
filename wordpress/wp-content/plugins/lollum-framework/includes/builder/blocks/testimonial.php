<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Framework
 * @author Lollum <support@lollum.com>
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

/******************************
* testimonial block
******************************/

function lolfmk_print_testimonial_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$list_testimonials = (lolfmk_find_xml_node($item, 'child-group')) ? lolfmk_find_xml_node($item, 'child-group') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-testimonial item-'.$size.'" data-type="item-testimonial" data-item="Testimonial">';

	lolfmk_item_btns('Testimonial', 'yes', 'yes');
	lolfmk_item_before_inner('Testimonial');

	/*** begin command ***/

	$ob_element_id = array(
		'name' => __('Element ID', 'lollum'),
		'data' => 'element-id',
		'value' => $element_id,
		'desc' => __('The ID of the element (optional)', 'lollum')
	);

	lolfmk_pb_text($ob_element_id);

	/*** end command ***/

	/*** begin command ***/

	$ob_header_text = array(
		'name' => __('Header Text', 'lollum'),
		'data' => 'header-text',
		'value' => $header_text,
		'desc' => __('The text of the header (optional)', 'lollum')
	);

	lolfmk_pb_text($ob_header_text);

	/*** end command ***/

	/*** begin command ***/

	echo '<h6 class="option-title">'.__("Testimonials", "lollum").'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="button" class="add-clone-item" value="'.__("Add testimonial", "lollum").'">';
	echo '<br></div>';
	echo '<div class="explain">'.__("Add more testimonials", "lollum").'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="xml open-group"></div>';
	echo '<div class="list-cloned-items">';

	/****** begin default cloned item ******/
	echo '<div class="default-cloned-item">';

			/*** open single item ***/
			echo '<div class="single-item-cloned">';
			echo '<div class="xml open-tab"></div>';

					/* testimonial text */

					$ob_testimonial_text = array(
						'name' => __('Text Testimonial', 'lollum'),
						'data' => 'testimonial-text',
						'value' => '',
						'desc' => __('The content of the testimonial', 'lollum')
					);

					lolfmk_pb_textarea($ob_testimonial_text);

					/* testimonial author */

					$ob_testimonial_author = array(
						'name' => __('Author Testimonial', 'lollum'),
						'data' => 'testimonial-author',
						'value' => '',
						'desc' => __('The author of the quote', 'lollum')
					);

					lolfmk_pb_text($ob_testimonial_author);

					/* testimonial subtitle */

					$ob_testimonial_subtitle = array(
						'name' => __('Subtitle Testimonial', 'lollum'),
						'data' => 'testimonial-subtitle',
						'value' => '',
						'desc' => __('The subtitle of the author\'s quote (eg. "Web Designer", "The New York Times")', 'lollum')
					);

					lolfmk_pb_text($ob_testimonial_subtitle);

					/* testimonial avatar */

					$ob_testimonial_avatar = array(
						'name' => __('Testimonial avatar', 'lollum'),
						'data' => 'testimonial-avatar',
						'value' => '',
						'desc' => __('Upload an image', 'lollum')
					);

					lolfmk_pb_upload($ob_testimonial_avatar);

			echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete testimonial", "lollum").'">';

			/*** close single item ***/
			echo '<div class="xml close-tab"></div>';
			echo '</div>';

	/****** end default cloned item ******/
	echo '</div>';
	
	if ($list_testimonials != '') {
		$i = 0;
		foreach ($list_testimonials->childNodes as $testimonial) {
			if ($i > 0) {
				$testimonial_text = lolfmk_find_xml_value($testimonial, 'testimonial-text');
				$testimonial_author = lolfmk_find_xml_value($testimonial, 'testimonial-author');
				$testimonial_subtitle = lolfmk_find_xml_value($testimonial, 'testimonial-subtitle');
				$testimonial_avatar = lolfmk_find_xml_value($testimonial, 'testimonial-avatar');

				/*** open single item ***/
				echo '<div class="single-item-cloned">';
				echo '<div class="xml open-tab"></div>';

						/* testimonial text */

						$ob_testimonial_text_c = array(
							'name' => __('Text Testimonial', 'lollum'),
							'data' => 'testimonial-text',
							'value' => $testimonial_text,
							'desc' => __('The content of the testimonial', 'lollum')
						);

						lolfmk_pb_textarea($ob_testimonial_text_c);

						/* testimonial author */

						$ob_testimonial_author_c = array(
							'name' => __('Author Testimonial', 'lollum'),
							'data' => 'testimonial-author',
							'value' => $testimonial_author,
							'desc' => __('The author of the quote', 'lollum')
						);

						lolfmk_pb_text($ob_testimonial_author_c);

						/* testimonial subtitle */

						$ob_testimonial_subtitle_c = array(
							'name' => __('Subtitle Testimonial', 'lollum'),
							'data' => 'testimonial-subtitle',
							'value' => $testimonial_subtitle,
							'desc' => __('The subtitle of the author\'s quote (eg. "Web Designer", "The New York Times")', 'lollum')
						);

						lolfmk_pb_text($ob_testimonial_subtitle_c);

						/* testimonial avatar */

						$ob_testimonial_avatar_c = array(
							'name' => __('Testimonial avatar', 'lollum'),
							'data' => 'testimonial-avatar',
							'value' => $testimonial_avatar,
							'desc' => __('Upload an image', 'lollum')
						);

						lolfmk_pb_upload($ob_testimonial_avatar_c);

				echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete testimonial", "lollum").'">';

				/*** close single item ***/
				echo '<div class="xml close-tab"></div>';
				echo '</div>';

			}
		$i++;
		}
	}

	echo '</div>';
	echo '<div class="xml close-group"></div>';

	/*** end command ***/

	echo '<input class="item-size xml" type="hidden" value="'.$size.'" data-type="size">';

	lolfmk_item_after_inner();
}