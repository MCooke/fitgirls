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

global $lolfmk_pre;

/******************************
* blocks availables
******************************/

$lolfmk_blocks_page = array(
	'Column',
	'Divider',
	'Space',
	'Line',
	'Heading',
	'Heading-Small',
	'Heading-Wide',
	'Heading-Parallax',
	'Image',
	'Image-Parallax',
	'Image-Text',
	'Service-Column',
	'Mini-Service-Column',
	'Block-Feature',
	'Block-Video',
	'Embed-Video',
	'Block-Banner',
	'Block-Banner-Alt',
	'Block-Text-Banner',
	'Post',
	'Blog-Full',
	'Blog-List',
	'Project',
	'Portfolio-Full',
	'Portfolio-List',
	'Portfolio-Filter',
	'Member',
	'Testimonial',
	'Progress-Circle',
	'Progress-Number',
	'Countdown',
	'Blockquote',
	'Testimonial-Full',
	'Toggle',
	'FAQs',
	'Brands',
	'Brands-Parallax',
	'Job-List',
	'Map',
	'Full-Map',
	'Call-To-Action',
	'Info',
	'Mailchimp'
);

global $lolfmk_theme_features, $lolfmk_supported_blocks;

foreach ($lolfmk_blocks_page as $block) {
	if (lolfmk_current_theme_supports($block)) {
		$lolfmk_supported_blocks[] = $block;
	}
}

$lolfmk_meta_box_elements = array(
	'id' => 'lolfmkbox-meta-box-elements',
	'title' => 'Page Elements',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Add page element', 'lollum'),
			'desc' => __('Select an element and add it on the page.', 'lollum'),
			'id' => $lolfmk_pre.'select_item',
			"type" => "elements-select",
			'options' => $lolfmk_supported_blocks,
			'std' => ''
		),
		array(
			'type' => 'open-items-list',
			'id' => ''
		),
		array(
			'name' =>  'Column',
			"type" => "item-column",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Divider',
			"type" => "item-divider",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Space',
			"type" => "item-space",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Line',
			"type" => "item-line",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Heading',
			"type" => "item-heading",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Heading-Small',
			"type" => "item-heading-small",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Heading-Wide',
			"type" => "item-heading-wide",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Heading-Parallax',
			"type" => "item-heading-parallax",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Image',
			"type" => "item-image",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Image-Parallax',
			"type" => "item-image-parallax",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Image-Text',
			"type" => "item-image-text",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Service-Column',
			"type" => "item-service-column",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Mini-Service-Column',
			"type" => "item-mini-service-column",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Block-Feature',
			"type" => "item-block-feature",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Block-Video',
			"type" => "item-block-video",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Embed-Video',
			"type" => "item-embed-video",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Block-Banner',
			"type" => "item-block-banner",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Block-Banner-Alt',
			"type" => "item-block-banner-alt",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Block-Text-Banner',
			"type" => "item-block-text-banner",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Post',
			"type" => "item-post",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Blog-Full',
			"type" => "item-blog-full",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Blog-List',
			"type" => "item-blog-list",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Project',
			"type" => "item-project",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Portfolio-Full',
			"type" => "item-portfolio-full",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Portfolio-List',
			"type" => "item-portfolio-list",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Portfolio-Filter',
			"type" => "item-portfolio-filter",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Member',
			"type" => "item-member",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Testimonial',
			"type" => "item-testimonial",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Progress-Circle',
			"type" => "item-progress-circle",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Progress-Number',
			"type" => "item-progress-number",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Countdown',
			"type" => "item-countdown",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Blockquote',
			"type" => "item-blockquote",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Testimonial-Full',
			"type" => "item-testimonial-full",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Toggle',
			"type" => "item-toggle",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'FAQs',
			"type" => "item-faqs",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Brands',
			"type" => "item-brands",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Brands-Parallax',
			"type" => "item-brands-parallax",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Job-List',
			"type" => "item-job-list",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Map',
			"type" => "item-map",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Full-Map',
			"type" => "item-full-map",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Call-To-Action',
			"type" => "item-call-to-action",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Info',
			"type" => "item-info",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  'Mailchimp',
			"type" => "item-mailchimp",
			'id' => '',
			'std' => ''
		),
		array(
			'type' => 'close-items-list',
			'id' => ''
		),
		array(
			'type' => 'section-items-selected',
			'id' => 'hidden-items-selected',
			'std' => ''
		),
		array(
			'type' => 'page-xml',
			'id' => 'page-xml-val',
			'std' => ''
		)
	)
);

function lolfmk_elements_boxes() {
	global $lolfmk_meta_box_elements, $post;

	wp_nonce_field('lolfmk_meta_blocks_nonce', 'lolfmk_meta_box_elements');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_elements['fields'] as $field) {

		$meta_xml = get_post_meta($post->ID, 'page-xml-val', true);
		$meta = get_post_meta($post->ID, $field['id'], true);

		switch ($field['type']) {

			case 'elements-select':
				lolfmk_case_select_element($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $field['options'], $meta);
			break;

			case 'open-items-list':
				lolfmk_open_default_list();
			break;

			case 'close-items-list':
				lolfmk_close_default_list();
			break;

			case 'item-column':
				if (lolfmk_current_theme_supports('Column')) {
					lolfmk_print_column_admin();
				}
			break;

			case 'item-divider':
				if (lolfmk_current_theme_supports('Divider')) {
					lolfmk_print_divider_admin();
				}
			break;

			case 'item-space':
				if (lolfmk_current_theme_supports('Space')) {
					lolfmk_print_space_admin();
				}
			break;

			case 'item-line':
				if (lolfmk_current_theme_supports('Line')) {
					lolfmk_print_line_admin();
				}
			break;

			case 'item-heading':
				if (lolfmk_current_theme_supports('Heading')) {
					lolfmk_print_heading_admin();
				}
			break;

			case 'item-heading-small':
				if (lolfmk_current_theme_supports('Heading-Small')) {
					lolfmk_print_heading_small_admin();
				}
			break;

			case 'item-heading-wide':
				if (lolfmk_current_theme_supports('Heading-Wide')) {
					lolfmk_print_heading_wide_admin();
				}
			break;

			case 'item-heading-parallax':
				if (lolfmk_current_theme_supports('Heading-Parallax')) {
					lolfmk_print_heading_parallax_admin();
				}
			break;

			case 'item-image':
				if (lolfmk_current_theme_supports('Image')) {
					lolfmk_print_image_admin();
				}
			break;

			case 'item-image-parallax':
				if (lolfmk_current_theme_supports('Image-Parallax')) {
					lolfmk_print_image_parallax_admin();
				}
			break;

			case 'item-image-text':
				if (lolfmk_current_theme_supports('Image-Text')) {
					lolfmk_print_image_text_admin();
				}
			break;

			case 'item-service-column':
				if (lolfmk_current_theme_supports('Service-Column')) {
					lolfmk_print_service_column_admin();
				}
			break;

			case 'item-mini-service-column':
				if (lolfmk_current_theme_supports('Mini-Service-Column')) {
					lolfmk_print_mini_service_column_admin();
				}
			break;

			case 'item-block-feature':
				if (lolfmk_current_theme_supports('Block-Feature')) {
					lolfmk_print_block_feature_admin();
				}
			break;

			case 'item-block-video':
				if (lolfmk_current_theme_supports('Block-Video')) {
					lolfmk_print_block_video_admin();
				}
			break;

			case 'item-embed-video':
				if (lolfmk_current_theme_supports('Embed-Video')) {
					lolfmk_print_embed_video_admin();
				}
			break;

			case 'item-block-banner':
				if (lolfmk_current_theme_supports('Block-Banner')) {
					lolfmk_print_block_banner_admin();
				}
			break;

			case 'item-block-banner-alt':
				if (lolfmk_current_theme_supports('Block-Banner-Alt')) {
					lolfmk_print_block_banner_alt_admin();
				}
			break;

			case 'item-block-text-banner':
				if (lolfmk_current_theme_supports('Block-Text-Banner')) {
					lolfmk_print_block_text_banner_admin();
				}
			break;

			case 'item-post':
				if (lolfmk_current_theme_supports('Post')) {
					lolfmk_print_post_admin();
				}
			break;

			case 'item-blog-full':
				if (lolfmk_current_theme_supports('Blog-Full')) {
					lolfmk_print_blog_full_admin();
				}
			break;

			case 'item-blog-list':
				if (lolfmk_current_theme_supports('Blog-List')) {
					lolfmk_print_blog_list_admin();
				}
			break;

			case 'item-project':
				if (lolfmk_current_theme_supports('Project')) {
					lolfmk_print_project_admin();
				}
			break;

			case 'item-portfolio-full':
				if (lolfmk_current_theme_supports('Portfolio-Full')) {
					lolfmk_print_portfolio_full_admin();
				}
			break;

			case 'item-portfolio-list':
				if (lolfmk_current_theme_supports('Portfolio-List')) {
					lolfmk_print_portfolio_list_admin();
				}
			break;

			case 'item-portfolio-filter':
				if (lolfmk_current_theme_supports('Portfolio-Filter')) {
					lolfmk_print_portfolio_filter_admin();
				}
			break;

			case 'item-member':
				if (lolfmk_current_theme_supports('Member')) {
					lolfmk_print_member_admin();
				}
			break;

			case 'item-testimonial':
				if (lolfmk_current_theme_supports('Testimonial')) {
					lolfmk_print_testimonial_admin();
				}
			break;

			case 'item-progress-circle':
				if (lolfmk_current_theme_supports('Progress-Circle')) {
					lolfmk_print_progress_circle_admin();
				}
			break;

			case 'item-progress-number':
				if (lolfmk_current_theme_supports('Progress-Number')) {
					lolfmk_print_progress_number_admin();
				}
			break;

			case 'item-countdown':
				if (lolfmk_current_theme_supports('Countdown')) {
					lolfmk_print_countdown_admin();
				}
			break;

			case 'item-blockquote':
				if (lolfmk_current_theme_supports('Blockquote')) {
					lolfmk_print_blockquote_admin();
				}
			break;

			case 'item-testimonial-full':
				if (lolfmk_current_theme_supports('Testimonial-Full')) {
					lolfmk_print_testimonial_full_admin();
				}
			break;

			case 'item-toggle':
				if (lolfmk_current_theme_supports('Toggle')) {
					lolfmk_print_toggle_admin();
				}
			break;

			case 'item-faqs':
				if (lolfmk_current_theme_supports('FAQs')) {
					lolfmk_print_faqs_admin();
				}
			break;

			case 'item-brands':
				if (lolfmk_current_theme_supports('Brands')) {
					lolfmk_print_brands_admin();
				}
			break;

			case 'item-brands-parallax':
				if (lolfmk_current_theme_supports('Brands-Parallax')) {
					lolfmk_print_brands_parallax_admin();
				}
			break;

			case 'item-job-list':
				if (lolfmk_current_theme_supports('Job-List')) {
					lolfmk_print_job_list_admin();
				}
			break;

			case 'item-map':
				if (lolfmk_current_theme_supports('Map')) {
					lolfmk_print_map_admin();
				}
			break;

			case 'item-full-map':
				if (lolfmk_current_theme_supports('Full-Map')) {
					lolfmk_print_full_map_admin();
				}
			break;

			case 'item-call-to-action':
				if (lolfmk_current_theme_supports('Call-To-Action')) {
					lolfmk_print_call_to_action_admin();
				}
			break;

			case 'item-info':
				if (lolfmk_current_theme_supports('Info')) {
					lolfmk_print_info_admin();
				}
			break;

			case 'item-mailchimp':
				if (lolfmk_current_theme_supports('Mailchimp')) {
					lolfmk_print_mailchimp_admin();
				}
			break;
			
			case 'section-items-selected':
				lolfmk_items_selected($meta_xml);
			break;

			case 'page-xml':
				lolfmk_page_xml($field['id'], $field['std'], $meta);
			break;
		}
	}
	echo '</div>';
}