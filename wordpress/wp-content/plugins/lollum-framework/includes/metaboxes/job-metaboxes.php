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

$lolfmk_meta_box_job = array(
	'id' => 'lolfmkbox-meta-box-job',
	'title' => 'Job Settings',
	'page' => 'lolfmk-job',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => __('Job Location', 'lollum'),
			'desc' => __('Write the job location.', 'lollum'),
			'id' => $lolfmk_pre . 'job_location',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Responsibilities', 'lollum'),
			'desc' => __('Write the responsibilities of the job.', 'lollum'),
			'id' => $lolfmk_pre . 'job_responsibilities',
			"type" => "textarea",
			'std' => ''
		),
		array(
			'name' => __('Essentials Skills', 'lollum'),
			'desc' => __('Write the essential skills needed for the job.', 'lollum'),
			'id' => $lolfmk_pre . 'job_skills_n',
			"type" => "textarea",
			'std' => ''
		),
		array(
			'name' => __('Desirable Skills', 'lollum'),
			'desc' => __('Write the desirable skills needed for the job.', 'lollum'),
			'id' => $lolfmk_pre . 'job_skills_d',
			"type" => "textarea",
			'std' => ''
		),
		array(
			'name' => __('Job Form', 'lollum'),
			'desc' => __('Paste the shortcode of the form for the job application (create it with Contact Form 7).', 'lollum'),
			'id' => $lolfmk_pre . 'job_form',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' =>  '',
			'message' => __('You can embed a map for the job location. Paste the latitude and longitude of the place.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' => __('Latitude', 'lollum'),
			'desc' => __('The latitude of the place.', 'lollum'),
			'id' => $lolfmk_pre . 'job_lat',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' => __('Longitude', 'lollum'),
			'desc' => __('The longitude of the place.', 'lollum'),
			'id' => $lolfmk_pre . 'job_lng',
			"type" => "text",
			'std' => ''
		),
		array(
			'name' =>  __('Zoom', 'lollum'),
			'desc' => __('The initial zoom of the map. A value from 0 to 19.', 'lollum'),
			'id' => $lolfmk_pre . 'job_zoom',
			'options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19'),
			"type" => "select",
			'std' => '12'
		)
	)
);

function lolfmk_job_boxes() {
	global $lolfmk_meta_box_job, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_job['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'textarea':
				lolfmk_case_textarea($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break;

			case 'select':
				lolfmk_case_select($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $field['options'], $meta);
			break;
		}
	}
	echo '</div>';
}