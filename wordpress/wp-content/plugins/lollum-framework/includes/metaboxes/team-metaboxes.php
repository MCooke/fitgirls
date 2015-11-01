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
* team meta boxes
******************************/

$lolfmk_meta_box_team = array(
	'id' => 'lolfmkbox-meta-box-team',
	'title' => 'Team Settings',
	'page' => 'lolfmk-team',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Member description', 'lollum'),
			'desc' => __('Write a little description about the member.', 'lollum'),
			'id' => $lolfmk_pre . 'member_desc',
			"type" => "textarea",
			'std' => ''
		),
		array(
			'name' => __('Member position', 'lollum'),
			'desc' => __('Write the position of your member team.', 'lollum'),
			'id' => $lolfmk_pre . 'member_job',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Facebook URL', 'lollum'),
			'desc' => __('The URL of member\'s Facebook account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_facebook',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Twitter URL', 'lollum'),
			'desc' => __('The URL of member\'s Twitter account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_twitter',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Google Plus URL', 'lollum'),
			'desc' => __('The URL of member\'s Google Plus account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_google',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Dribbble URL', 'lollum'),
			'desc' => __('The URL of member\'s Dribbble account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_dribbble',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Linkedin URL', 'lollum'),
			'desc' => __('The URL of member\'s Linkedin account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_linkedin',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Instagram URL', 'lollum'),
			'desc' => __('The URL of member\'s Instagram account (remember "http://").', 'lollum'),
			'id' => $lolfmk_pre . 't_instagram',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Email', 'lollum'),
			'desc' => __('The email of the member.', 'lollum'),
			'id' => $lolfmk_pre . 't_email',
			"type" => "text",
			'std' => ''
		)
	)
);

function lolfmk_team_boxes() {
	global $lolfmk_meta_box_team, $post;
 	
	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');
 
	echo '<div class="wrap-boxes">';
 
	foreach ($lolfmk_meta_box_team['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

		}
	}
	echo '</div>';
}