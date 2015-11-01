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
* testimonial full block
******************************/

function lolfmk_print_testimonial_full_admin($item = null) {
	global $lolfmk_margin_full;
	$block_title = (lolfmk_find_xml_value($item, 'block-title')) ? lolfmk_find_xml_value($item, 'block-title') : '';
	$list_testimonials = (lolfmk_find_xml_node($item, 'child-group')) ? lolfmk_find_xml_node($item, 'child-group') : '';
	$text_color = (lolfmk_find_xml_value($item, 'text-color')) ? lolfmk_find_xml_value($item, 'text-color') : '';
	$bg_color = (lolfmk_find_xml_value($item, 'bg-color')) ? lolfmk_find_xml_value($item, 'bg-color') : '#ffffff';
	$bg_src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$parallax_effect = (lolfmk_find_xml_value($item, 'parallax-effect')) ? lolfmk_find_xml_value($item, 'parallax-effect') : '';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-testimonial-full item-1-1" data-type="item-testimonial-full" data-item="Testimonial-Full">';

	lolfmk_item_btns('Testimonial-Full', 'yes');
	lolfmk_item_before_inner('Testimonial-Full');

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

	$ob_block_title = array(
		'name' => __('Block Title', 'lollum'),
		'data' => 'block-title',
		'value' => $block_title,
		'desc' => __('The title of the block', 'lollum')
	);

	lolfmk_pb_text($ob_block_title);

	/*** end command ***/

	/*** begin command ***/

	$ob_text_color = array(
		'name' => __('Text Color', 'lollum'),
		'data' => 'text-color',
		'value' => $text_color,
		'options' => array('dark', 'light'),
		'desc' => __('Select the color of the text', 'lollum')
	);

	lolfmk_pb_simple_select($ob_text_color);

	/*** end command ***/

	/*** begin command ***/

	$ob_bg_color = array(
		'name' => __('Background Color', 'lollum'),
		'data' => 'bg-color',
		'value' => $bg_color,
		'desc' => __('Select a background color', 'lollum')
	);

	lolfmk_pb_color($ob_bg_color);

	/*** end command ***/

	/*** begin command ***/

	$ob_bg_src = array(
		'name' => __('Background Image', 'lollum'),
		'data' => 'image-src',
		'value' => $bg_src,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_bg_src);

	/*** end command ***/

	/*** begin command ***/

	$ob_parallax = array(
		'name' => __('Parallax Effect', 'lollum'),
		'data' => 'parallax-effect',
		'value' => $parallax_effect,
		'options' => array('parallax-yes', 'parallax-no'),
		'desc' => __('Select "parallax-yes" for a parallax effect', 'lollum')
	);

	lolfmk_pb_simple_select($ob_parallax);

	/*** end command ***/

	if ($lolfmk_margin_full != '' && $lolfmk_margin_full == 'yes') {

	/*** begin command ***/

	$ob_margin = array(
		'name' => __('Margin Bottom', 'lollum'),
		'data' => 'margin-bottom',
		'value' => $margin,
		'options' => array('yes', 'no'),
		'desc' => __('Select "no" to remove the margin of this block', 'lollum')
	);

	lolfmk_pb_simple_select($ob_margin);

	/*** end command ***/

	}

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

	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';

	lolfmk_item_after_inner();
}