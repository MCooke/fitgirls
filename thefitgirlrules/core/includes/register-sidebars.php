<?php
/**
 * Lollum
 * 
 * Register widgetized area
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lollum_widgets_init')) {
	function lollum_widgets_init() {
		register_sidebar(array(
			'name' => __('Main Sidebar', 'lollum'),
			'id' => 'main-sidebar',
			'description' => __('This is the main sidebar, used in your blog page (posts, categories, archive and tags)'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => __('Page Sidebar', 'lollum'),
			'id' => 'page-sidebar',
			'description' => __('This area is used in the template "Page Sidebar (left)" and "Page Sidebar (right)"'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		if (lollum_check_is_woocommerce()) {
			register_sidebar(array(
				'name' => __('Shop Sidebar', 'lollum'),
				'id' => 'shop-sidebar',
				'description' => __('The main sidebar used in your shop pages', 'lollum'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<div class="widget-header"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			));
			register_sidebar(array(
				'name' => __('Product Sidebar', 'lollum'),
				'id' => 'product-sidebar',
				'description' => __('This area is used in your single product pages', 'lollum'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<div class="widget-header"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			));
		}
		if (lollum_check_is_lollumframework()) {
			register_sidebar(array(
				'name' => __('Job Sidebar', 'lollum'),
				'id' => 'job-sidebar',
				'description' => __('This sidebar is used in your job entries', 'lollum'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => "</aside>",
				'before_title' => '<div class="widget-header"><h3 class="widget-title">',
				'after_title' => '</h3></div>',
			));
		}
		register_sidebar(array(
			'name' => __('Footer 1', 'lollum'),
			'id' => 'footer1',
			'description' => __('This is the first footer area', 'lollum'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => __('Footer 2', 'lollum'),
			'id' => 'footer2',
			'description' => __('This is the second footer area', 'lollum'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => __('Footer 3', 'lollum'),
			'id' => 'footer3',
			'description' => __('This is the third footer area', 'lollum'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => __('Footer 4', 'lollum'),
			'id' => 'footer4',
			'description' => __('This is the fourth footer area', 'lollum'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => "</section>",
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
	}
}
add_action('init', 'lollum_widgets_init');