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
* post format video meta boxes
******************************/

$lolfmk_meta_box_video = array(
	'id' => 'lolfmkbox-meta-box-video',
	'title' => 'Video Settings',
	'page' => 'post',
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
			'id' => $lolfmk_pre . 'mp4_url',
			"type" => "upload-video",
			'std' => ''
		),
		array(
			'name' => __('Poster Video', 'lollum'),
			'desc' => __('The poster of the video (optional).', 'lollum'),
			'id' => $lolfmk_pre . 'poster_video',
			"type" => "upload",
			'std' => ''
		),
		array(
			'name' => __('Embed Code', 'lollum'),
			'desc' => __('Embed code for no self-hosted videos (Youtube, Vimeo, etc).', 'lollum'),
			'id' => $lolfmk_pre . 'embed_video',
			"type" => "textarea",
			'std' => ''
		)
	)
);

function lolfmk_video_boxes() {
	global $lolfmk_meta_box_video, $post;
	
	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_video['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'upload-video':
				lolfmk_case_upload_video($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;


			case 'upload':
				lolfmk_case_upload($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}


/******************************
* post format audio meta boxes
******************************/

$lolfmk_meta_box_audio = array(
	'id' => 'lolfmkbox-meta-box-audio',
	'title' => 'Audio Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  '',
			'message' => __('You can embed an audio file from Soundcloud, etc., or songs hosted on your server.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' => __('MP3 Audio', 'lollum'),
			'desc' => __('Upload a song from Media Library.', 'lollum'),
			'id' => $lolfmk_pre . 'mp3_url',
			"type" => "upload-audio",
			'std' => ''
		),
		array(
			'name' => __('Embed Code', 'lollum'),
			'desc' => __('Embed code for no self-hosted audio files (Soundcloud, etc).', 'lollum'),
			'id' => $lolfmk_pre . 'embed_audio',
			"type" => "textarea",
			'std' => ''
		)
	)
);

function lolfmk_audio_boxes() {
	global $lolfmk_meta_box_audio, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_audio['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'upload-audio':
				lolfmk_case_upload_audio($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;
	
		}
	}
	echo '</div>';
}


/******************************
* post format link meta boxes
******************************/

$lolfmk_meta_box_link = array(
	'id' => 'lolfmkbox-meta-box-link',
	'title' => 'Link Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('URL', 'lollum'),
			'desc' => __('The URL of your link (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 'link_url',
			"type" => "text",
			'std' => ''
		)
	)
);

function lolfmk_link_boxes() {
	global $lolfmk_meta_box_link, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_link['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}


/******************************
* post format gallery meta boxes
******************************/

$lolfmk_meta_box_gallery = array(
	'id' => 'lolfmkbox-meta-box-gallery',
	'title' => 'Gallery Settings',
	'page' => 'post',
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

function lolfmk_gallery_boxes() {
	global $lolfmk_meta_box_gallery, $post;
	
	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_gallery['fields'] as $field) {

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


/******************************
* post format image meta boxes
******************************/

$lolfmk_meta_box_image = array(
	'id' => 'lolfmkbox-meta-box-image',
	'title' => 'Image Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  '',
			'message' => __('You can upload an image from Media Library or paste HTML code.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' => __('Image', 'lollum'),
			'desc' => __('Upload an image from Media Library.', 'lollum'),
			'id' => $lolfmk_pre . 'p_image_url',
			"type" => "upload-image",
			'std' => ''
		),
		array(
			'name' => __('Image Alt', 'lollum'),
			'desc' => __('The alternate text of the image.', 'lollum'),
			'id' => $lolfmk_pre . 'p_image_alt',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Image W', 'lollum'),
			'desc' => __('The width of the image.', 'lollum'),
			'id' => $lolfmk_pre . 'p_image_w',
			"type" => "text-hidden",
			'std' => ''
		),
		array(
			'name' => __('Image H', 'lollum'),
			'desc' => __('The height of the image.', 'lollum'),
			'id' => $lolfmk_pre . 'p_image_h',
			"type" => "text-hidden",
			'std' => ''
		),
		array(
			'name' => __('Embed Code', 'lollum'),
			'desc' => __('Embed code for the image.', 'lollum'),
			'id' => $lolfmk_pre . 'embed_image',
			"type" => "textarea",
			'std' => ''
		)
	)
);

function lolfmk_image_boxes() {
	global $lolfmk_meta_box_image, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_image['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'text-hidden':
				lolfmk_case_text_hidden($field['id'], $field['std'], $meta);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'upload-image':
				lolfmk_case_upload_image($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}


/******************************
* post format quote meta boxes
******************************/

$lolfmk_meta_box_quote = array(
	'id' => 'lolfmkbox-meta-box-quote',
	'title' => 'Quote Settings',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Author Quote', 'lollum'),
			'desc' => __('The author of the quote.', 'lollum'),
			'id' => $lolfmk_pre . 'author_quote',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Source Quote', 'lollum'),
			'desc' => __('The source of the quote (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 'source_quote',
			"type" => "text",
			'std' => ''
		)
	)
);

function lolfmk_quote_boxes() {
	global $lolfmk_meta_box_quote, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_quote['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}