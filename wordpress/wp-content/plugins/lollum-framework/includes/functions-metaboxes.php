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

require_once('utility-metaboxes.php');
require_once('metaboxes/post-formats-meta.php');
require_once('metaboxes/portfolio-metaboxes.php');
require_once('metaboxes/page-metaboxes.php');
require_once('metaboxes/team-metaboxes.php');
require_once('metaboxes/job-metaboxes.php');
require_once('metaboxes/product-metaboxes.php');


/******************************
* add meta boxes
******************************/

function lolfmk_add_meta_box_element() { 
	global $lolfmk_meta_box_video, $lolfmk_meta_box_audio, $lolfmk_meta_box_link, $lolfmk_meta_box_gallery, $lolfmk_meta_box_image, $lolfmk_meta_box_quote, $lolfmk_meta_box_portfolio, $lolfmk_meta_box_portfolio_video, $lolfmk_meta_box_portfolio_gallery, $lolfmk_meta_box_portfolio_settings, $lolfmk_meta_box_team, $lolfmk_meta_box_job, $lolfmk_meta_box_page_settings, $lolfmk_meta_box_product;

	add_meta_box($lolfmk_meta_box_video['id'], $lolfmk_meta_box_video['title'], 'lolfmk_video_boxes', $lolfmk_meta_box_video['page'], $lolfmk_meta_box_video['context'], $lolfmk_meta_box_video['priority']);
	add_meta_box($lolfmk_meta_box_audio['id'], $lolfmk_meta_box_audio['title'], 'lolfmk_audio_boxes', $lolfmk_meta_box_audio['page'], $lolfmk_meta_box_audio['context'], $lolfmk_meta_box_audio['priority']);
	add_meta_box($lolfmk_meta_box_link['id'], $lolfmk_meta_box_link['title'], 'lolfmk_link_boxes', $lolfmk_meta_box_link['page'], $lolfmk_meta_box_link['context'], $lolfmk_meta_box_link['priority']);
	add_meta_box($lolfmk_meta_box_gallery['id'], $lolfmk_meta_box_gallery['title'], 'lolfmk_gallery_boxes', $lolfmk_meta_box_gallery['page'], $lolfmk_meta_box_gallery['context'], $lolfmk_meta_box_gallery['priority']);
	add_meta_box($lolfmk_meta_box_image['id'], $lolfmk_meta_box_image['title'], 'lolfmk_image_boxes', $lolfmk_meta_box_image['page'], $lolfmk_meta_box_image['context'], $lolfmk_meta_box_image['priority']);
	add_meta_box($lolfmk_meta_box_quote['id'], $lolfmk_meta_box_quote['title'], 'lolfmk_quote_boxes', $lolfmk_meta_box_quote['page'], $lolfmk_meta_box_quote['context'], $lolfmk_meta_box_quote['priority']);
	add_meta_box($lolfmk_meta_box_portfolio['id'], $lolfmk_meta_box_portfolio['title'], 'lolfmk_portfolio_boxes', $lolfmk_meta_box_portfolio['page'], $lolfmk_meta_box_portfolio['context'], $lolfmk_meta_box_portfolio['priority']);
	add_meta_box($lolfmk_meta_box_portfolio_video['id'], $lolfmk_meta_box_portfolio_video['title'], 'lolfmk_portfolio_video_boxes', $lolfmk_meta_box_portfolio_video['page'], $lolfmk_meta_box_portfolio_video['context'], $lolfmk_meta_box_portfolio_video['priority']);
	add_meta_box($lolfmk_meta_box_portfolio_gallery['id'], $lolfmk_meta_box_portfolio_gallery['title'], 'lolfmk_portfolio_gallery_boxes', $lolfmk_meta_box_portfolio_gallery['page'], $lolfmk_meta_box_portfolio_gallery['context'], $lolfmk_meta_box_portfolio_gallery['priority']);
	add_meta_box($lolfmk_meta_box_portfolio_settings['id'], $lolfmk_meta_box_portfolio_settings['title'], 'lolfmk_page_portfolio_settings', $lolfmk_meta_box_portfolio_settings['page'], $lolfmk_meta_box_portfolio_settings['context'], $lolfmk_meta_box_portfolio_settings['priority']);
	add_meta_box($lolfmk_meta_box_team['id'], $lolfmk_meta_box_team['title'], 'lolfmk_team_boxes', $lolfmk_meta_box_team['page'], $lolfmk_meta_box_team['context'], $lolfmk_meta_box_team['priority']);
	add_meta_box($lolfmk_meta_box_job['id'], $lolfmk_meta_box_job['title'], 'lolfmk_job_boxes', $lolfmk_meta_box_job['page'], $lolfmk_meta_box_job['context'], $lolfmk_meta_box_job['priority']);
	add_meta_box($lolfmk_meta_box_page_settings['id'], $lolfmk_meta_box_page_settings['title'], 'lolfmk_page_settings', $lolfmk_meta_box_page_settings['page'], $lolfmk_meta_box_page_settings['context'], $lolfmk_meta_box_page_settings['priority']);
	add_meta_box($lolfmk_meta_box_product['id'], $lolfmk_meta_box_product['title'], 'lolfmk_product_boxes', $lolfmk_meta_box_product['page'], $lolfmk_meta_box_product['context'], $lolfmk_meta_box_product['priority']);
}
add_action('add_meta_boxes', 'lolfmk_add_meta_box_element');


/******************************
* save meta boxes
******************************/

function lolfmk_save_meta_box_element($post_id) {
	global $lolfmk_meta_box_video, $lolfmk_meta_box_audio, $lolfmk_meta_box_link, $lolfmk_meta_box_gallery, $lolfmk_meta_box_image, $lolfmk_meta_box_quote, $lolfmk_meta_box_portfolio, $lolfmk_meta_box_portfolio_video, $lolfmk_meta_box_portfolio_gallery, $lolfmk_meta_box_portfolio_settings, $lolfmk_meta_box_team, $lolfmk_meta_box_job, $lolfmk_meta_box_page_settings, $lolfmk_meta_box_product;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if(!isset($_POST['lol_meta_box_nonce']) || !wp_verify_nonce($_POST['lol_meta_box_nonce'], 'lolfmk_meta_box_nonce')) {
		return;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($lolfmk_meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_audio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_link['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_gallery['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_image['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_quote['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_portfolio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_portfolio_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_portfolio_gallery['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_portfolio_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_team['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_job['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_page_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	foreach ($lolfmk_meta_box_product['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = @$_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
add_action('save_post', 'lolfmk_save_meta_box_element');