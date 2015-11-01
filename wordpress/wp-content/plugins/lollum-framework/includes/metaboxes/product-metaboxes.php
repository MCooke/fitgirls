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

$lolfmk_meta_box_product = array(
	'id' => 'lolfmkbox-meta-box-product',
	'title' => 'Product Sidebar',
	'page' => 'product',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' =>  __('Product Sidebar', 'lollum'),
			'desc' => __('Select your single product page layout.', 'lollum'),
			'id' => $lolfmk_pre . 'product_sidebar',
			'options' => array('no-sidebar', 'left-sidebar', 'right-sidebar'),
			"type" => "select",
			'std' => ''
		)
	)
);

function lolfmk_product_boxes() {
	global $lolfmk_meta_box_product, $post;

	wp_nonce_field('lolfmk_meta_box_nonce', 'lol_meta_box_nonce');

	echo '<div class="wrap-boxes">';

	foreach ($lolfmk_meta_box_product['fields'] as $field) {

		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			case 'select':
				lolfmk_case_select($field['type'], $field['id'], $field['std'], $field['name'], $field['desc'], $field['options'], $meta);
			break;
		}
	}
	echo '</div>';
}