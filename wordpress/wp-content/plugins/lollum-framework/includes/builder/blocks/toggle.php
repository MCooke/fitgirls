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
* toggle block
******************************/

function lolfmk_print_toggle_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$list_toggle = (lolfmk_find_xml_node($item, 'child-group')) ? lolfmk_find_xml_node($item, 'child-group') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';
	$size = (lolfmk_find_xml_value($item, 'size')) ? lolfmk_find_xml_value($item, 'size') : '1-4';

	echo '<div class="page-item item-toggle item-'.$size.'" data-type="item-toggle" data-item="Toggle">';

	lolfmk_item_btns('Toggle', 'yes', 'yes');
	lolfmk_item_before_inner('Toggle');

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

	echo '<h6 class="option-title">Toggle</h6>';
	echo '<div class="option option-toggle">';
	echo '<div class="command">';
	echo '<input type="button" class="add-clone-item" value="'.__("Add toggle", "lollum").'">';
	echo '<br></div>';
	echo '<div class="explain">'.__("Add more toggles", "lollum").'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="xml open-group"></div>';
	echo '<div class="list-cloned-items list-toggles">';

	/****** begin default cloned item ******/
	echo '<div class="default-cloned-item">';

			/*** open single item ***/
			echo '<div class="single-item-cloned">';
			echo '<div class="xml open-tab"></div>';

					/* toggle title */

					$ob_toggle_title = array(
						'name' => __('Toggle Title', 'lollum'),
						'data' => 'toggle-title',
						'value' => '',
						'desc' => __('The text of the toggle title', 'lollum')
					);

					lolfmk_pb_text($ob_toggle_title);

					/* toggle content */

					$ob_toggle_content = array(
						'name' => __('Toggle Content', 'lollum'),
						'data' => 'toggle-content',
						'value' => '',
						'desc' => __('Type the content of the toggle', 'lollum')
					);

					lolfmk_pb_textarea($ob_toggle_content);

					/* toggle type */

					$ob_toggle_type = array(
						'name' => __('Type', 'lollum'),
						'data' => 'toggle-type',
						'value' => '',
						'options' => array('open', 'closed'),
						'desc' => __('Select the state of the toggle on page load', 'lollum')
					);

					lolfmk_pb_simple_select($ob_toggle_type);

			echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete toggle", "lollum").'">';

			/*** close single item ***/
			echo '<div class="xml close-tab"></div>';
			echo '</div>';

	/****** end default cloned item ******/
	echo '</div>';

	if ($list_toggle != '') {
		$i = 0;
		foreach ($list_toggle->childNodes as $toggle) {
			if ($i > 0) {
				$toggle_title = lolfmk_find_xml_value($toggle, 'toggle-title');
				$toggle_content = lolfmk_find_xml_value($toggle, 'toggle-content');
				$toggle_type = lolfmk_find_xml_value($toggle, 'toggle-type');

				/*** open single item ***/
				echo '<div class="single-item-cloned">';
				echo '<div class="xml open-tab"></div>';

						/* toggle title */

						$ob_toggle_title_c = array(
							'name' => __('Toggle Title', 'lollum'),
							'data' => 'toggle-title',
							'value' => $toggle_title,
							'desc' => __('The text of the toggle title', 'lollum')
						);

						lolfmk_pb_text($ob_toggle_title_c);

						/* toggle content */

						$ob_toggle_content_c = array(
							'name' => __('Toggle Content', 'lollum'),
							'data' => 'toggle-content',
							'value' => $toggle_content,
							'desc' => __('Type the content of the toggle', 'lollum')
						);

						lolfmk_pb_textarea($ob_toggle_content_c);

						/* toggle type */

						$ob_toggle_type_c = array(
							'name' => __('Type', 'lollum'),
							'data' => 'toggle-type',
							'value' => $toggle_type,
							'options' => array('open', 'closed'),
							'desc' => __('Select the state of the toggle on page load', 'lollum')
						);

						lolfmk_pb_simple_select($ob_toggle_type_c);

				echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete toggle", "lollum").'">';

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