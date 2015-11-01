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
* portfolio meta boxes
******************************/

$lolfmk_meta_box_portfolio = array(
	'id' => 'lolfmkbox-meta-box-portfolio',
	'title' => 'Portfolio Settings',
	'page' => 'lolfmk-portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Portfolio type', 'lollum'),
			'desc' => __('Select the type of portfololio.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_type',
			'options' => array('image', 'slider', 'video'),
			"type" => "select",
			'std' => 'image'
		),
		array(
			'name' => __('Portfolio description', 'lollum'),
			'desc' => __('A little description of your project.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_desc',
			"type" => "textarea",
			'std' => ''
		),
		array(
			'name' => __('Portfolio date', 'lollum'),
			'desc' => __('The date of your project.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_date',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Label Portfolio date', 'lollum'),
			'desc' => __('The label of the field.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_date_label',
			"type" => "text",
			'std' => 'Date'
		),
		array(
			'name' => __('Portfolio client', 'lollum'),
			'desc' => __('The client of your project.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_client',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Label Portfolio client', 'lollum'),
			'desc' => __('The label of the field.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_client_label',
			"type" => "text",
			'std' => 'Client'
		),
		array(
			'name' => __('Portfolio skills', 'lollum'),
			'desc' => __('The skills needed for this project.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_skills',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Label Portfolio skills', 'lollum'),
			'desc' => __('The label of the field.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_skills_label',
			"type" => "text",
			'std' => 'Skills'
		),
		array(
			'name' => __('Portfolio project URL', 'lollum'),
			'desc' => __('The URL of your project.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_url',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Label Portfolio project URL', 'lollum'),
			'desc' => __('The label of the field.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_url_label',
			"type" => "text",
			'std' => 'Project URL'
		),
		array(
			'name' => __('Portfolio love count', 'lollum'),
			'desc' => __('Portfolio love count.', 'lollum'),
			'id' => '_lolfmk_love_count',
			"type" => "meta-love",
			'std' => 1
		)
	)
);

function lolfmk_portfolio_boxes() {
	global $lolfmk_meta_box_portfolio, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_portfolio['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'select':
				lolfmk_case_select($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $field['options'], $meta);
			break;

			case 'meta-love':
				lolfmk_case_meta_love($field['id'], $field['std'], $meta);
			break;
		}
	}
	echo '</div>';
}

$lolfmk_meta_box_portfolio_video = array(
	'id' => 'lolfmkbox-meta-box-portfolio-video',
	'title' => 'Portfolio Video Settings',
	'page' => 'lolfmk-portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  '',
			'message' => __('You can embed a video from Youtube or Vimeo ("Embed Code" section), or videos hosted on your server.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' => __('MP4 Video', 'lollum'),
			'desc' => __('Upload a video from Media Library.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_mp4_url',
			"type" => "upload-video",
			'std' => ''
		),
		array(
			'name' => __('Poster Video', 'lollum'),
			'desc' => __('The poster of the video (optional).', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_poster_video',
			"type" => "upload",
			'std' => ''
		),
		array(
			'name' => __('Embed Code', 'lollum'),
			'desc' => __('Embed code for no self-hosted videos (Youtube, Vimeo, etc).', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_embed_video',
			"type" => "textarea",
			'std' => ''
		)
	)
);

function lolfmk_portfolio_video_boxes() {
	global $lolfmk_meta_box_portfolio_video, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_portfolio_video['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'checkbox':
				lolfmk_case_checkbox($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);   
			break;

			case 'upload':
				lolfmk_case_upload($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'upload-video':
				lolfmk_case_upload_video($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;
		}
	}
	echo '</div>';
}

$lolfmk_meta_box_portfolio_gallery = array(
	'id' => 'lolfmkbox-meta-box-portfolio-gallery',
	'title' => 'Portfolio Gallery Settings',
	'page' => 'lolfmk-portfolio',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  '',
			'message' => __('Insert in this field the gallery shortcode.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' => __('Gallery Shortcode', 'lollum'),
			'desc' => __('Insert the gallery shortcode.', 'lollum'),
			'id' => $lolfmk_pre . 'gallery_shortcode',
			"type" => "text",
			'std' => ''
		)
	)
);

function lolfmk_portfolio_gallery_boxes() {
	global $lolfmk_meta_box_portfolio_gallery, $post;
	
	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_portfolio_gallery['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}