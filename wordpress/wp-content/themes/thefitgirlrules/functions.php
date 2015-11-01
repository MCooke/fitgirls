<?php
/**
 * Lollum
 * 
 * Big Point functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lollum_setup')) {

	function lollum_setup() {

		load_theme_textdomain('lollum', get_template_directory() . '/languages');

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

	 	if (is_readable($locale_file)) {
	        require_once($locale_file);
		}

		register_nav_menu('primary', __('Menu', 'lollum'));
		register_nav_menu('top-header', __('Top Header', 'lollum'));

		add_theme_support('post-formats', array('aside', 'status', 'quote', 'image', 'gallery', 'video', 'audio', 'link', 'chat'));
		add_theme_support('post-thumbnails');

		add_image_size('widget-thumb', 500, 500, true);
		add_image_size('post-thumb', 1000, 500, true);
		add_image_size('page-thumb', 1170, 403, true);
		add_image_size('featured-thumb', 870, 532, true);

		if (!isset($content_width)) {
		  $content_width = 870;
		}

		add_theme_support('automatic-feed-links');

		add_theme_support('woocommerce');

		$features = array(
			'Column' => 'yes',
			'Divider' => 'yes',
			'Space' => 'yes',
			'Line' => 'yes',
			'Heading' => 'yes',
			'Heading-Small' => 'yes',
			'Heading-Wide' => 'yes',
			'Heading-Parallax' => 'yes',
			'Image' => 'yes',
			'Image-Parallax' => 'yes',
			'Image-Text' => 'yes',
			'Service-Column' => 'yes',
		        'Mini-Service-Column' => 'yes',
			'Block-Feature' => 'yes',
			'Embed-Video' => 'yes',
		        'Block-Banner' => 'yes',
			'Block-Banner-Alt' => 'yes',
			'Block-Text-Banner' => 'yes',
		        'Post' => 'yes',
			'Blog-Full' => 'yes',
			'Blog-List' => 'yes',
			'Project' => 'yes',
			'Portfolio-Full' => 'yes',
			'Portfolio-List' => 'yes',
			'Portfolio-Filter' => 'yes',
			'Member' => 'yes',
			'Progress-Circle' => 'yes',
			'Progress-Number' => 'yes',
			'Countdown' => 'yes',
			'Testimonial-Full' => 'yes',
		        'Toggle' => 'yes',
			'FAQs' => 'yes',
			'Brands-Parallax' => 'yes',
			'Job-List' => 'yes',
			'Map' => 'yes',
			'Full-Map' => 'yes',
			'Call-To-Action' => 'yes',
			'Info' => 'yes',
			'Mailchimp' => 'yes'
		);

		$post_types = array(
			'portfolio' => 'yes',
                        'team' => 'yes',
			'job' => 'yes',
			'faq' => 'yes'
		);

		add_option('lolfmk_supported_post_types', $post_types);
		add_option('lolfmk_supported_features', $features);
		add_option('lolfmk_support_page_builder', 'yes');
		add_option('lolfmk_load_shortcodes_scripts', 'no');
		add_option('lolfmk_fontawesome_version', '4');
		add_option('lolfmk_margin_full', 'yes');
		add_option('lolfmk_link_slider', 'yes');
	}
}

add_action('after_setup_theme', 'lollum_setup');

if(!function_exists('lolfmk_remove_supported_features')) {
	function lolfmk_remove_supported_features() {
		delete_option('lolfmk_supported_features');
		delete_option('lolfmk_support_page_builder');
		delete_option('lolfmk_load_shortcodes_scripts');
		delete_option('lolfmk_fontawesome_version');
		delete_option('lolfmk_supported_post_types');
		delete_option('lolfmk_margin_full');
		delete_option('lolfmk_link_slider');
	}
}

add_action('switch_theme', 'lolfmk_remove_supported_features');

require_once('core/core.php');

add_action('wp_enqueue_scripts', 'lollum_register_js');
if (!function_exists('lollum_register_js')) {
	function lollum_register_js() {
		if (!is_admin()) {
			global $wp_scripts, $wp_version;
			if ($wp_version >= '3.6') {
				wp_deregister_script('mediaelement');
				wp_deregister_script('wp-mediaelement');
			}
			wp_register_script('bigpoint-modernizr', LOLLUM_URI . '/js/modernizr.js', array(), '1.0', 0);
			wp_register_script('bigpoint-common', LOLLUM_URI . '/js/common.js', array('jquery'), '1.0', 1);
			wp_register_script('bigpoint-isotope', LOLLUM_URI . '/js/jquery.isotope.js', array('jquery'), '1.0', 1);
			wp_register_script('bigpoint-parallax', LOLLUM_URI . '/js/jquery.parallax.js', array('jquery'), '1.0', 1);
			wp_register_script('bigpoint-countTo', LOLLUM_URI . '/js/jquery.countTo.js', array('jquery'), '1.0', 1);
			wp_register_script('bigpoint-easypiechart', LOLLUM_URI . '/js/jquery.easypiechart.js', array('jquery'), '1.0', 1);
			wp_register_script('mediaelement', LOLLUMCORE_URI . 'mediaelement/mediaelement-and-player.min.js', array('jquery'), '2.13.0', 1);
			wp_register_script('wp-mediaelement', LOLLUMCORE_URI . 'mediaelement/wp-mediaelement.js', array('mediaelement'), '1.0', 1);
			wp_register_script('bigpoint-init', LOLLUM_URI . '/js/init.js', array('jquery'), '1.0', 1);
			wp_register_script('lolfmk-progress', LOLLUM_URI . '/js/progress-circle.js', array('jquery', 'bigpoint-easypiechart'), '1.0', 1);

			wp_localize_script( 'lolfmk-progress', 'lolfmk_progress_vars', 
				array(
					'barColor' => get_option('lol_first_ac_color')
				)
			);
			
			wp_enqueue_script('bigpoint-modernizr');
			wp_enqueue_script('bigpoint-common');
			wp_enqueue_script('bigpoint-init');
			wp_enqueue_script('mediaelement');
			wp_enqueue_script('wp-mediaelement');
		}

		if (is_singular() && comments_open() && get_option('thread_comments') && !is_page()) {
			wp_register_script('lollum-comment-reply', LOLLUM_URI . '/js/comment-reply.min.js', '1.0', 1);
			wp_enqueue_script('lollum-comment-reply');
		}
	}
}

if (!function_exists('lollum_register_css')) {
	function lollum_register_css() {
		if (!is_admin()) {
			global $wp_styles, $wp_version;
			if ($wp_version >= '3.6') {
				wp_deregister_style('mediaelement');
			}
			wp_register_style('woocommerce', LOLLUM_URI . '/woocommerce/css/woocommerce.css', array(), '1.0');
			wp_register_style('thefitgirlrules', LOLLUM_URI . '/style.css', array(), '1.0');
			wp_register_style('font-awesome', LOLLUM_URI . '/css/font-awesome.css', array(), '4.3.0');
			wp_register_style('flexslider', LOLLUM_URI . '/css/flexslider.css', array(), '1.0');
			wp_register_style('ie8', LOLLUM_URI . '/css/ie8.css', array(), '1.0');
			wp_register_style('responsive', LOLLUM_URI . '/css/responsive.css', array(), '1.0');
			wp_register_style('edits-1', LOLLUM_URI . '/css/edits-1.css', array(), '1.0');

			wp_enqueue_style('woocommerce');
			wp_enqueue_style('thefitgirlrules');
			wp_enqueue_style('font-awesome');
			wp_enqueue_style('flexslider');
			wp_enqueue_style('ie8');
			wp_enqueue_style('responsive');
			wp_enqueue_style('edits-1');
			$wp_styles->add_data('ie8', 'conditional', 'lt IE 9');
		}
	}
}

add_action('wp_enqueue_scripts', 'lollum_register_css');

if (!function_exists('lollum_queue_frontend')) {
	function lollum_queue_frontend() {
		if (is_page()) {
			wp_enqueue_script('bigpoint-parallax');
			wp_enqueue_script('bigpoint-countTo');
			wp_enqueue_script('lolfmk-progress');
			wp_enqueue_script('bigpoint-isotope');
			wp_enqueue_script('lolfmk-prettyPhoto');
			wp_enqueue_style('lolfmk-prettyPhoto-css');
		}
		if (is_page() || ('lolfmk-job' == get_post_type())) {
			wp_enqueue_script('lolfmk-google-maps-api');
			wp_enqueue_script('lolfmk-google-maps');
		}
	}
}

add_action('wp_enqueue_scripts', 'lollum_queue_frontend');
