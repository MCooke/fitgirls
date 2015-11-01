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
* brands parallax block
******************************/

function lolfmk_print_brands_parallax_admin($item = null) {
	global $lolfmk_margin_full;
	$bg_color = (lolfmk_find_xml_value($item, 'bg-color')) ? lolfmk_find_xml_value($item, 'bg-color') : '#ffffff';
	$src = (lolfmk_find_xml_value($item, 'image-src')) ? lolfmk_find_xml_value($item, 'image-src') : '';
	$parallax_effect = (lolfmk_find_xml_value($item, 'parallax-effect')) ? lolfmk_find_xml_value($item, 'parallax-effect') : '';
	$margin = (lolfmk_find_xml_value($item, 'margin-bottom')) ? lolfmk_find_xml_value($item, 'margin-bottom') : '';
	$brands_number = (lolfmk_find_xml_value($item, 'brands-number')) ? lolfmk_find_xml_value($item, 'brands-number') : '';
	$list_brands = (lolfmk_find_xml_node($item, 'child-group')) ? lolfmk_find_xml_node($item, 'child-group') : '';
	$element_id = (lolfmk_find_xml_value($item, 'element-id')) ? lolfmk_find_xml_value($item, 'element-id') : '';

	echo '<div class="page-item item-brands-parallax item-1-1" data-type="item-brands-parallax" data-item="Brands-Parallax">';

	lolfmk_item_btns('Brands-Parallax', 'yes');
	lolfmk_item_before_inner('Brands-Parallax');

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

	$ob_brands_number = array(
		'name' => __('Number of brands', 'lollum'),
		'data' => 'brands-number',
		'value' => $brands_number,
		'options' => array('2', '3', '4', '5', '6'),
		'desc' => __('Select the number of the brands per row', 'lollum')
	);

	lolfmk_pb_simple_select($ob_brands_number);

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

	$ob_image_src = array(
		'name' => __('Image Background', 'lollum'),
		'data' => 'image-src',
		'value' => $src,
		'desc' => __('Upload an image', 'lollum')
	);

	lolfmk_pb_upload($ob_image_src);

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