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
* includes
******************************/

require_once('functions-builder.php');
require_once('utility-builder.php');
require_once('blocks-builder.php');

/******************************
* include available blocks
******************************/

if (lolfmk_current_theme_supports('Column')) {
	require_once('blocks/column.php');
}
if (lolfmk_current_theme_supports('Divider')) {
	require_once('blocks/divider.php');
}
if (lolfmk_current_theme_supports('Space')) {
	require_once('blocks/space.php');
}
if (lolfmk_current_theme_supports('Line')) {
	require_once('blocks/line.php');
}
if (lolfmk_current_theme_supports('Heading')) {
	require_once('blocks/heading.php');
}
if (lolfmk_current_theme_supports('Heading-Small')) {
	require_once('blocks/heading-small.php');
}
if (lolfmk_current_theme_supports('Heading-Wide')) {
	require_once('blocks/heading-wide.php');
}
if (lolfmk_current_theme_supports('Heading-Parallax')) {
	require_once('blocks/heading-parallax.php');
}
if (lolfmk_current_theme_supports('Image')) {
	require_once('blocks/image.php');
}
if (lolfmk_current_theme_supports('Image-Parallax')) {
	require_once('blocks/image-parallax.php');
}
if (lolfmk_current_theme_supports('Image-Text')) {
	require_once('blocks/image-text.php');
}
if (lolfmk_current_theme_supports('Service-Column')) {
	require_once('blocks/service-column.php');
}
if (lolfmk_current_theme_supports('Mini-Service-Column')) {
	require_once('blocks/mini-service-column.php');
}
if (lolfmk_current_theme_supports('Block-Feature')) {
	require_once('blocks/block-feature.php');
}
if (lolfmk_current_theme_supports('Block-Video')) {
	require_once('blocks/block-video.php');
}
if (lolfmk_current_theme_supports('Embed-Video')) {
	require_once('blocks/embed-video.php');
}
if (lolfmk_current_theme_supports('Block-Banner')) {
	require_once('blocks/block-banner.php');
}
if (lolfmk_current_theme_supports('Block-Banner-Alt')) {
	require_once('blocks/block-banner-alt.php');
}
if (lolfmk_current_theme_supports('Block-Text-Banner')) {
	require_once('blocks/text-banner.php');
}
if (lolfmk_current_theme_supports('Post')) {
	require_once('blocks/post.php');
}
if (lolfmk_current_theme_supports('Blog-Full')) {
	require_once('blocks/blog-full.php');
}
if (lolfmk_current_theme_supports('Blog-List')) {
	require_once('blocks/blog-list.php');
}
if (lolfmk_current_theme_supports('Project')) {
	require_once('blocks/project.php');
}
if (lolfmk_current_theme_supports('Portfolio-Full')) {
	require_once('blocks/portfolio-full.php');
}
if (lolfmk_current_theme_supports('Portfolio-List')) {
	require_once('blocks/portfolio-list.php');
}
if (lolfmk_current_theme_supports('Portfolio-Filter')) {
	require_once('blocks/portfolio-filter.php');
}
if (lolfmk_current_theme_supports('Member')) {
	require_once('blocks/member.php');
}
if (lolfmk_current_theme_supports('Testimonial')) {
	require_once('blocks/testimonial.php');
}
if (lolfmk_current_theme_supports('Progress-Circle')) {
	require_once('blocks/progress-circle.php');
}
if (lolfmk_current_theme_supports('Progress-Number')) {
	require_once('blocks/progress-number.php');
}
if (lolfmk_current_theme_supports('Countdown')) {
	require_once('blocks/countdown.php');
}
if (lolfmk_current_theme_supports('Blockquote')) {
	require_once('blocks/blockquote.php');
}
if (lolfmk_current_theme_supports('Testimonial-Full')) {
	require_once('blocks/testimonial-full.php');
}
if (lolfmk_current_theme_supports('Toggle')) {
	require_once('blocks/toggle.php');
}
if (lolfmk_current_theme_supports('FAQs')) {
	require_once('blocks/faqs.php');
}
if (lolfmk_current_theme_supports('Brands')) {
	require_once('blocks/brands.php');
}
if (lolfmk_current_theme_supports('Brands-Parallax')) {
	require_once('blocks/brands-parallax.php');
}
if (lolfmk_current_theme_supports('Job-List')) {
	require_once('blocks/job-list.php');
}
if (lolfmk_current_theme_supports('Map')) {
	require_once('blocks/map.php');
}
if (lolfmk_current_theme_supports('Full-Map')) {
	require_once('blocks/full-map.php');
}
if (lolfmk_current_theme_supports('Call-To-Action')) {
	require_once('blocks/call-to-action.php');
}
if (lolfmk_current_theme_supports('Info')) {
	require_once('blocks/info.php');
}
if (lolfmk_current_theme_supports('Mailchimp')) {
	require_once('blocks/mailchimp.php');
}

/******************************
* add builder meta box
******************************/

function lolfmk_add_builder_meta_box() { 
	global $lolfmk_meta_box_elements; 

	add_meta_box($lolfmk_meta_box_elements['id'], $lolfmk_meta_box_elements['title'], 'lolfmk_elements_boxes', $lolfmk_meta_box_elements['page'], $lolfmk_meta_box_elements['context'], $lolfmk_meta_box_elements['priority']);
}
add_action('add_meta_boxes', 'lolfmk_add_builder_meta_box');


/******************************
* save builder meta box
******************************/

function lolfmk_save_builder_meta_box($post_id) {
	global $lolfmk_meta_box_elements;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if(!isset($_POST['lolfmk_meta_box_elements']) || !wp_verify_nonce($_POST['lolfmk_meta_box_elements'], 'lolfmk_meta_blocks_nonce')) {
		return;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$page_xml_var = @$_POST['item-xml'];
	if ($page_xml_var) {
		$page_xml_meta = '<xml-tag>';
		foreach ($page_xml_var as $key => $value) {
			if ($key > 1) {
				$page_xml_meta .= $value;
			}
		}
		$page_xml_meta .= '</xml-tag>';
	}
	foreach ($lolfmk_meta_box_elements['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
		$check_js = @$_POST['check-js'];
		if ($check_js == 'js') {
			if ($field['type'] == 'page-xml') {
				update_post_meta($post_id, $field['id'], $page_xml_meta);
			}
		}
	}
}
add_action('save_post', 'lolfmk_save_builder_meta_box');