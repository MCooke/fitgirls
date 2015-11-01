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
* brands block
******************************/

function lolfmk_print_brands_admin($item = null) {
	$header_text = (lolfmk_find_xml_value($item, 'header-text')) ? lolfmk_find_xml_value($item, 'header-text') : '';
	$brands_number = (lolfmk_find_xml_value($item, 'brands-number')) ? lolfmk_find_xml_value($item, 'brands-number') : '';
	$list_brands = (lolfmk_find_xml_node($item, 'child-group')) ? lolfmk_find_xml_node($item, 'child-group') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-brands item-1-1" data-type="item-brands" data-item="Brands">';

	lolfmk_item_btns('Brands', 'yes');
	lolfmk_item_before_inner('Brands');

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

	$ob_brands_number = array(
		'name' => __('Number of brands', 'lollum'),
		'data' => 'brands-number',
		'value' => $brands_number,
		'options' => array('2', '3', '4', '6'),
		'desc' => __('Select the number of brands per row', 'lollum')
	);

	lolfmk_pb_simple_select($ob_brands_number);

	/*** end command ***/

	/*** begin command ***/

	echo '<h6 class="option-title">'.__("Images", "lollum").'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="button" class="add-clone-item" value="'.__("Add brand", "lollum").'">';
	echo '<br></div>';
	echo '<div class="explain">'.__("Add more images", "lollum").'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';

	echo '<div class="xml open-group"></div>';
	echo '<div class="list-cloned-items">';

	/****** begin default cloned item ******/
	echo '<div class="default-cloned-item">';

			/*** open single item ***/
			echo '<div class="single-item-cloned">';
			echo '<div class="xml open-tab"></div>';

					/* image */
					
					$ob_image_src = array(
						'name' => __('Image URL', 'lollum'),
						'data' => 'image-src',
						'value' => '',
						'desc' => __('Upload an image', 'lollum')
					);

					lolfmk_pb_upload($ob_image_src);

					/*** alt ***/

					$ob_alt_image = array(
						'name' => __('Alt Image', 'lollum'),
						'data' => 'alt-image',
						'value' => '',
						'desc' => __('Type the alt attribute of your image', 'lollum')
					);

					lolfmk_pb_text($ob_alt_image);

					/*** link ***/

					$ob_link_image = array(
						'name' => __('Link Image', 'lollum'),
						'data' => 'link-image',
						'value' => '',
						'desc' => __('Insert a URL for your image (optional)', 'lollum')
					);

					lolfmk_pb_text($ob_link_image);

			echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete brand", "lollum").'">';

			/*** close single item ***/
			echo '<div class="xml close-tab"></div>';
			echo '</div>';

	/****** end default cloned item ******/
	echo '</div>';

	if ($list_brands != '') {
		$i = 0;
		foreach ($list_brands->childNodes as $brand) {
			if ($i > 0) {
				$img_src = lolfmk_find_xml_value($brand, 'image-src');
				$alt_image = lolfmk_find_xml_value($brand, 'alt-image');
				$link_image = lolfmk_find_xml_value($brand, 'link-image');

				/*** open single item ***/
				echo '<div class="single-item-cloned">';
				echo '<div class="xml open-tab"></div>';

						/* image */
						
						$ob_image_src_c = array(
							'name' => __('Image URL', 'lollum'),
							'data' => 'image-src',
							'value' => $img_src,
							'desc' => __('Upload an image', 'lollum')
						);

						lolfmk_pb_upload($ob_image_src_c);

						/*** alt ***/

						$ob_alt_image_c = array(
							'name' => __('Alt Image', 'lollum'),
							'data' => 'alt-image',
							'value' => $alt_image,
							'desc' => __('Type the alt attribute of your image', 'lollum')
						);

						lolfmk_pb_text($ob_alt_image_c);

						/*** link ***/

						$ob_link_image_c = array(
							'name' => __('Link Image', 'lollum'),
							'data' => 'link-image',
							'value' => $link_image,
							'desc' => __('Insert a URL for your image (optional)', 'lollum')
						);

						lolfmk_pb_text($ob_link_image_c);

				echo '<br><input type="button" class="delete-cloned-item" value="'.__("Delete brand", "lollum").'">';

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