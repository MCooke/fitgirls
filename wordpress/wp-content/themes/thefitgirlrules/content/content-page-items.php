<?php
/**
 * Lollum
 * 
 * Core functions for displaying page builder blocks
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

global $lolfmk_full_size;
$lolfmk_full_size = 0;
$page_xml = get_post_meta($post->ID, 'page-xml-val', true);
if ($page_xml = get_post_meta($post->ID, 'page-xml-val', true)) {
	if (class_exists('DOMDocument')) {
		$xml = new DOMDocument();
		$xml->loadXML($page_xml);
		foreach ($xml->documentElement->childNodes as $item) {
			switch($item->nodeName) {
				case 'Column':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_column($item);
					echo '</div>';
					break;
				case 'Divider':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'divider-block'
					);
					lolfmk_size_items($args);
					lolfmk_print_divider($item);
					echo '</div>';
					break;
				case 'Space':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_space($item);
					echo '</div>';
					break;
				case 'Line':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_line($item);
					echo '</div>';
					break;
				case 'Heading':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_heading($item);
					echo '</div>';
					break;
				case 'Heading-Small':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_heading_small($item);
					echo '</div>';
					break;
				case 'Heading-Wide':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img',
						'color' => '#dfdfdf'
					);
					lolfmk_size_items($args);
					lolfmk_print_heading_wide($item);
					echo '</div>';
					break;
				case 'Heading-Parallax':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'image-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_heading_parallax($item);
					echo '</div>';
					break;
				case 'Image':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_image($item);
					echo '</div>';
					break;
				case 'Image-Parallax':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'image-src')
					);
					lolfmk_size_items($args);
					lolfmk_print_image_parallax($item);
					echo '</div>';
					break;
				case 'Image-Text':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_image_text($item);
					echo '</div>';
					break;
				case 'Service-Column':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_service_column($item);
					echo '</div>';
					break;
				case 'Mini-Service-Column':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_mini_service_column($item);
					echo '</div>';
					break;
				case 'Block-Feature':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_block_feature($item);
					echo '</div>';
					break;
				case 'Block-Banner':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'bg-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_block_banner($item);
					echo '</div>';
					break;
				case 'Block-Banner-Alt':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'bg-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_block_banner_alt($item);
					echo '</div>';
					break;
				case 'Block-Text-Banner':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_block_text_banner($item);
					echo '</div>';
					break;
				case 'Post':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_post($item);
					echo '</div>';
					break;
				case 'Blog-Full':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_blog_full($item);
					echo '</div>';
					break;
				case 'Blog-List':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_blog_list($item);
					echo '</div>';
					break;
				case 'Project':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_project($item);
					echo '</div>';
					break;
				case 'Portfolio-Full':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_portfolio_full($item);
					echo '</div>';
					break;
				case 'Portfolio-List':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_portfolio_list($item);
					echo '</div>';
					break;
				case 'Portfolio-Filter':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'full' => 'full'
					);
					lolfmk_size_items($args);
					lolfmk_print_portfolio_filter($item);
					break;
				case 'Member':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_member($item);
					echo '</div>';
					break;
				case 'Progress-Circle':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_progress_circle($item);
					echo '</div>';
					break;
				case 'Progress-Number':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_progress_number($item);
					echo '</div>';
					break;
				case 'Countdown':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'image-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_countdown($item);
					echo '</div>';
					break;
				case 'Testimonial-Full':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'image-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_testimonial_full($item);
					echo '</div>';
					break;
				case 'Toggle':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_toggle($item);
					echo '</div>';
					break;
				case 'FAQs':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_faqs($item);
					echo '</div>';
					break;
				case 'Call-To-Action':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_call_to_action($item);
					echo '</div>';
					break;
				case 'Map':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_map($item);
					echo '</div>';
					break;
				case 'Full-Map':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'full' => 'full'
					);
					lolfmk_size_items($args);
					lolfmk_print_full_map($item);
					break;
				case 'Info':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_info($item);
					echo '</div>';
					break;
				case 'Mailchimp':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_mailchimp($item);
					echo '</div>';
					break;
				case 'Job-List':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_job_list($item);
					echo '</div>';
					break;
				case 'Embed-Video':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id')
					);
					lolfmk_size_items($args);
					lolfmk_print_embed_video($item);
					echo '</div>';
					break;
				case 'Brands-Parallax':
					$args = array(
						'size_item' => lolfmk_find_xml_value($item, 'size'),
						'id' => lolfmk_find_xml_value($item, 'element-id'),
						'class' => 'full-img '.lolfmk_find_xml_value($item, 'parallax-effect').' margin-'.lolfmk_find_xml_value($item, 'margin-bottom'),
						'image' => lolfmk_find_xml_value($item, 'image-src'),
						'color' => lolfmk_find_xml_value($item, 'bg-color')
					);
					lolfmk_size_items($args);
					lolfmk_print_brands_parallax($item);
					echo '</div>';
					break;
			}
		}
		if ($xml->documentElement->childNodes->length > 0) {
			echo '</div>' . "\n";
			echo '</div>' . "\n";
			echo '</div>' . "\n";
			echo '<!-- END page-row -->' . "\n";
		}
	} else {
		echo '<div class="container">';
		echo '<div class="row">';
		echo '<div class="col-12">';
		echo __('Please enable the DOM extension in your PHP configuration', 'lollum');
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}