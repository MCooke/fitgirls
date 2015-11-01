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
* find XML value
******************************/

function lolfmk_find_xml_value($xml, $field){
	if(!empty($xml)){
		foreach($xml->childNodes as $xmlChild){
			if($xmlChild->nodeName == $field){
				return $xmlChild->nodeValue;
			}
		}
	}
	return '';
}


/******************************
* find XML node
******************************/

function lolfmk_find_xml_node($xml, $node){
	if(!empty($xml)){
		foreach($xml->childNodes as $xmlChild){
			if($xmlChild->nodeName == $node){
				return $xmlChild;
			}
		}
	}
	return '';
}


/******************************
* load the XML and print
* blocks in admin
******************************/

function lolfmk_print_default_items($meta_xml) {

	$page_xml = $meta_xml;
	if ($page_xml) {
		if (class_exists('DOMDocument')) {
			$xml = new DOMDocument();
			$xml->loadXML($page_xml);

			foreach ($xml->documentElement->childNodes as $item) {
				switch($item->nodeName) {
					case 'Column':
						if (lolfmk_current_theme_supports('Column')) {
							lolfmk_print_column_admin($item);
						}
					break;

					case 'Divider':
						if (lolfmk_current_theme_supports('Divider')) {
							lolfmk_print_divider_admin($item);
						}
					break;

					case 'Space':
						if (lolfmk_current_theme_supports('Space')) {
							lolfmk_print_space_admin($item);
						}
					break;

					case 'Line':
						if (lolfmk_current_theme_supports('Line')) {
							lolfmk_print_line_admin($item);
						}
					break;

					case 'Heading':
						if (lolfmk_current_theme_supports('Heading')) {
							lolfmk_print_heading_admin($item);
						}
					break;

					case 'Heading-Small':
						if (lolfmk_current_theme_supports('Heading-Small')) {
							lolfmk_print_heading_small_admin($item);
						}
					break;

					case 'Heading-Wide':
						if (lolfmk_current_theme_supports('Heading-Wide')) {
							lolfmk_print_heading_wide_admin($item);
						}
					break;

					case 'Heading-Parallax':
						if (lolfmk_current_theme_supports('Heading-Parallax')) {
							lolfmk_print_heading_parallax_admin($item);
						}
					break;

					case 'Image':
						if (lolfmk_current_theme_supports('Image')) {
							lolfmk_print_image_admin($item);
						}
					break;

					case 'Image-Parallax':
						if (lolfmk_current_theme_supports('Image-Parallax')) {
							lolfmk_print_image_parallax_admin($item);
						}
					break;

					case 'Image-Text':
						if (lolfmk_current_theme_supports('Image-Text')) {
							lolfmk_print_image_text_admin($item);
						}
					break;

					case 'Service-Column':
						if (lolfmk_current_theme_supports('Service-Column')) {
							lolfmk_print_service_column_admin($item);
						}
					break;

					case 'Mini-Service-Column':
						if (lolfmk_current_theme_supports('Mini-Service-Column')) {
							lolfmk_print_mini_service_column_admin($item);
						}
					break;

					case 'Block-Feature':
						if (lolfmk_current_theme_supports('Block-Feature')) {
							lolfmk_print_block_feature_admin($item);
						}
					break;

					case 'Block-Video':
						if (lolfmk_current_theme_supports('Block-Video')) {
							lolfmk_print_block_video_admin($item);
						}
					break;

					case 'Embed-Video':
						if (lolfmk_current_theme_supports('Embed-Video')) {
							lolfmk_print_embed_video_admin($item);
						}
					break;

					case 'Block-Banner':
						if (lolfmk_current_theme_supports('Block-Banner')) {
							lolfmk_print_block_banner_admin($item);
						}
					break;

					case 'Block-Banner-Alt':
						if (lolfmk_current_theme_supports('Block-Banner-Alt')) {
							lolfmk_print_block_banner_alt_admin($item);
						}
					break;

					case 'Block-Text-Banner':
						if (lolfmk_current_theme_supports('Block-Text-Banner')) {
							lolfmk_print_block_text_banner_admin($item);
						}
					break;

					case 'Post':
						if (lolfmk_current_theme_supports('Post')) {
							lolfmk_print_post_admin($item);
						}
					break;

					case 'Blog-Full':
						if (lolfmk_current_theme_supports('Blog-Full')) {
							lolfmk_print_blog_full_admin($item);
						}
					break;

					case 'Blog-List':
						if (lolfmk_current_theme_supports('Blog-List')) {
							lolfmk_print_blog_list_admin($item);
						}
					break;

					case 'Project':
						if (lolfmk_current_theme_supports('Project')) {
							lolfmk_print_project_admin($item);
						}
					break;

					case 'Portfolio-Full':
						if (lolfmk_current_theme_supports('Portfolio-Full')) {
							lolfmk_print_portfolio_full_admin($item);
						}
					break;

					case 'Portfolio-List':
						if (lolfmk_current_theme_supports('Portfolio-List')) {
							lolfmk_print_portfolio_list_admin($item);
						}
					break;

					case 'Portfolio-Filter':
						if (lolfmk_current_theme_supports('Portfolio-Filter')) {
							lolfmk_print_portfolio_filter_admin($item);
						}
					break;

					case 'Member':
						if (lolfmk_current_theme_supports('Member')) {
							lolfmk_print_member_admin($item);
						}
					break;

					case 'Testimonial':
						if (lolfmk_current_theme_supports('Testimonial')) {
							lolfmk_print_testimonial_admin($item);
						}
					break;

					case 'Progress-Circle':
						if (lolfmk_current_theme_supports('Progress-Circle')) {
							lolfmk_print_progress_circle_admin($item);
						}
					break;

					case 'Progress-Number':
						if (lolfmk_current_theme_supports('Progress-Number')) {
							lolfmk_print_progress_number_admin($item);
						}
					break;

					case 'Countdown':
						if (lolfmk_current_theme_supports('Countdown')) {
							lolfmk_print_countdown_admin($item);
						}
					break;

					case 'Blockquote':
						if (lolfmk_current_theme_supports('Blockquote')) {
							lolfmk_print_blockquote_admin($item);
						}
					break;

					case 'Testimonial-Full':
						if (lolfmk_current_theme_supports('Testimonial-Full')) {
							lolfmk_print_testimonial_full_admin($item);
						}
					break;

					case 'Toggle':
						if (lolfmk_current_theme_supports('Toggle')) {
							lolfmk_print_toggle_admin($item);
						}
					break;

					case 'FAQs':
						if (lolfmk_current_theme_supports('FAQs')) {
							lolfmk_print_faqs_admin($item);
						}
					break;

					case 'Brands':
						if (lolfmk_current_theme_supports('Brands')) {
							lolfmk_print_brands_admin($item);
						}
					break;

					case 'Brands-Parallax':
						if (lolfmk_current_theme_supports('Brands-Parallax')) {
							lolfmk_print_brands_parallax_admin($item);
						}
					break;

					case 'Job-List':
						if (lolfmk_current_theme_supports('Job-List')) {
							lolfmk_print_job_list_admin($item);
						}
					break;

					case 'Map':
						if (lolfmk_current_theme_supports('Map')) {
							lolfmk_print_map_admin($item);
						}
					break;

					case 'Full-Map':
						if (lolfmk_current_theme_supports('Full-Map')) {
							lolfmk_print_full_map_admin($item);
						}
					break;

					case 'Call-To-Action':
						if (lolfmk_current_theme_supports('Call-To-Action')) {
							lolfmk_print_call_to_action_admin($item);
						}
					break;

					case 'Info':
						if (lolfmk_current_theme_supports('Info')) {
							lolfmk_print_info_admin($item);
						}
					break;

					case 'Mailchimp':
						if (lolfmk_current_theme_supports('Mailchimp')) {
							lolfmk_print_mailchimp_admin($item);
						}
					break;
				}
			}
		} else {
			echo '<div>';
			echo __('Please enable the DOM extension in your PHP configuration', 'lollum');
			echo '</div>';
		}
	}
}