<?php
/**
 * Lollum
 * 
 * The template for displaying the feature block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_block_feature')) {
	function lolfmk_print_block_feature($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$feature_title = lolfmk_find_xml_value($item, 'feature-title');
		$feature_content = lolfmk_find_xml_value($item, 'feature-content');
		$feature_image = lolfmk_find_xml_value($item, 'feature-image');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-block-feature">';
		echo '<img src="'.$feature_image.'" alt="'.$feature_title.'" class="">';
		echo '<h3>'.$feature_title.'</h3>';
		echo '<p>'.$feature_content.'</p>';
		echo '</div>';
	}
}