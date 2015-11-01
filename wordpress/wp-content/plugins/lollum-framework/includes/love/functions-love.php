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
* display love link
******************************/

function lolfmk_display_love_link($post_id) {
	if (get_option('lol_check_love_functionality') == 'true') {
		global $lolfmk_fontawesome_version;
		$love_count = lolfmk_get_love_count($post_id);
		$love_count = $love_count - 1;
		if (lolfmk_user_has_loved_post($post_id)) {
			$done = 'loved';
		} else {
			$done = '';
		}
		if ($lolfmk_fontawesome_version > 3) {
			echo '<div class="lol-love-wrap"><a href="#" class="lol-love '.$done.'" data-post-id="'.$post_id.'"><i class="fa fa-heart"></i><span>'.$love_count.'</span></a></div>';
		} else {
			echo '<div class="lol-love-wrap"><a href="#" class="lol-love '.$done.'" data-post-id="'.$post_id.'"><i class="icon-heart"></i><span>'.$love_count.'</span></a></div>';
		}
	}
}


/******************************
* check if user has loved
******************************/

function lolfmk_user_has_loved_post($post_id) {
	global $lolfmk_theme_name;
	if (isset($_COOKIE[''.$lolfmk_theme_name.'_loved_'.$post_id.''])) {
		return true;
	}
	return false;
}


/******************************
* mark post as loved
******************************/

function lolfmk_mark_post_as_loved($post_id) {
	$love_count = get_post_meta($post_id, '_lolfmk_love_count', true);
	if($love_count) {
		$love_count = $love_count + 1;
	} else {
		$love_count = 1;
	}
	if(update_post_meta($post_id, '_lolfmk_love_count', $love_count)) {	
		return true;
	}
	return false;
}


/******************************
* retrieve love count
******************************/

function lolfmk_get_love_count($post_id) {
	$love_count = get_post_meta($post_id, '_lolfmk_love_count', true);
	if($love_count) {
		return $love_count;
	}
	return 0;
}


/******************************
* process love
******************************/

function lolfmk_process_love() {
	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['love_it_nonce'], 'lolfmk-love-it-nonce') ) {
		if(lolfmk_mark_post_as_loved($_POST['item_id'])) {
			echo 'loved';
		} else {
			echo 'failed';
		}
	}
	die();
}
add_action('wp_ajax_lolfmk_love_it', 'lolfmk_process_love');
add_action('wp_ajax_nopriv_lolfmk_love_it', 'lolfmk_process_love');


/******************************
* localize script
******************************/

function lolfmk_front_end_js() {
	global $lolfmk_version, $lolfmk_theme_name;
	wp_enqueue_script('love-js', plugin_dir_url( __FILE__ ).'love.js', array('jquery'), $lolfmk_version, 1 );
	wp_localize_script( 'love-js', 'lolfmk_love_it_vars', 
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('lolfmk-love-it-nonce'),
			'theme_name' => $lolfmk_theme_name
		) 
	);	
	}
add_action('wp_enqueue_scripts', 'lolfmk_front_end_js');