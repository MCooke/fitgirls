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
* page meta boxes
******************************/

$lolfmk_meta_box_page_settings = array(
	'id' => 'lolfmkbox-meta-box-page-settings',
	'title' => 'Page Settings',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Hide Page Title', 'lollum'),
			'desc' => __('Check this to hide the title section in this page.', 'lollum'),
			'id' => $lolfmk_pre . 'headline_check',
			"type" => "checkbox",
			'std' => ''
		),
		array(
			'name' =>  '',
			'message' => __('You can create a custom slider in every page with the Revolution Slider plugin.', 'lollum'),
			"type" => "section-description",
			'id' => '',
			'std' => ''
		),
		array(
			'name' =>  __('Slider Revolution Alias', 'lollum'),
			'desc' => __('Type the alias of the slider..', 'lollum'),
			'id' => $lolfmk_pre . 'slider_rev_alias',
			"type" => "text",
			'std' => ''
		)
	)
);

global $lolfmk_link_slider;

if ($lolfmk_link_slider != '' && $lolfmk_link_slider == 'yes') {

	$lolfmk_meta_box_page_settings['fields'][] = array(
		'name' =>  __('Link to Content', 'lollum'),
		'desc' => __('Type some text to display a link at the bottom of the slider.', 'lollum'),
		'id' => $lolfmk_pre . 'page_link_slider',
		"type" => "text",
		'std' => ''
	);

}

global $lolfmk_margin_full;

if ($lolfmk_margin_full != '' && $lolfmk_margin_full == 'yes') {

	$lolfmk_meta_box_page_settings['fields'][] = array(
		'name' =>  __('No Margin', 'lollum'),
		'desc' => __('Check this to remove the bottom margin of the page. Useful when you use full width blocks (not available in pages with sidebars).', 'lollum'),
		'id' => $lolfmk_pre . 'page_margin_check',
		"type" => "checkbox",
		'std' => ''
	);

}

function lolfmk_page_settings() {
	global $lolfmk_meta_box_page_settings, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_page_settings['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'checkbox':
				lolfmk_case_checkbox($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break; 
		}
	}
	echo '</div>';
}

/******************************
* portfolio meta boxes
******************************/

$lolfmk_meta_box_portfolio_settings = array(
	'id' => 'lolfmkbox-meta-box-portfolio-settings',
	'title' => 'Portfolio Settings',
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Number of projects', 'lollum'),
			'desc' => __('Choose the number of the projects per page (-1 unlimited).', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_settings',
			"type" => "text",
			'std' => '6'
		),
		array(
			'name' =>  __('Limit', 'lollum'),
			'desc' => __('Check this to limit the number of the projects on the page without pagination.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_limit',
			"type" => "checkbox",
			'std' => ''
		),
		array(
			'name' =>  __('Project categories', 'lollum'),
			'desc' => __('Select the categories of your projects.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_cats',
			"type" => "multicheckbox-taxonomy",
			'std' => ''
		),
		array(
			'name' =>  __('Filterable', 'lollum'),
			'desc' => __('Select the type of your portfolio page, filterable or not.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_filterable',
			'options' => array('yes', 'no'),
			"type" => "select",
			'std' => ''
		),
		array(
			'name' =>  __('Filterable Text', 'lollum'),
			'desc' => __('Type the description of the filter (optional).', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_filterable_text',
			"type" => "text",
			'std' => 'Filter our projects'
		),
		array(
			'name' =>  __('Portfolio Layout', 'lollum'),
			'desc' => __('Select the layout of your portfolio page.', 'lollum'),
			'id' => $lolfmk_pre . 'portfolio_temp_type',
			'options' => array('normal', 'gallery'),
			"type" => "select",
			'std' => 'normal'
		)
	)
);

function lolfmk_page_portfolio_settings() {
	global $lolfmk_meta_box_portfolio_settings, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_portfolio_settings['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'text':
				lolfmk_case_text($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'checkbox':
				lolfmk_case_checkbox($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);
			break;

			case 'multicheckbox-taxonomy':
				lolfmk_case_multicheckbox_taxonomy($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $meta);    
			break;

			case 'select':
				lolfmk_case_select($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $field['options'], $meta);
			break;

			case 'section-description':
				lolfmk_case_sectiondescription($field['type'], $field['name'], $field['message']);
			break; 
		}
	}
	echo '</div>';
}