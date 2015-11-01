<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

// Define constants
define('LOLLUM_PATH', get_template_directory());
define('LOLLUM_URI', get_template_directory_uri());
define('LOLLUMCORE_PATH', get_template_directory() . '/core/');
define('LOLLUMCORE_URI', get_template_directory_uri() . '/core/');

// Includes
require_once LOLLUMCORE_PATH . 'includes/functions-utility.php';
require_once LOLLUMCORE_PATH . 'includes/config-theme.php';
require_once LOLLUMCORE_PATH . 'includes/walker-menu.php';
require_once LOLLUMCORE_PATH . 'includes/custom-styles.php';
require_once LOLLUMCORE_PATH . 'includes/register-sidebars.php';
require_once LOLLUMCORE_PATH . 'includes/comments-template.php';
require_once LOLLUMCORE_PATH . 'includes/custom-css.php';

// Builder
if (lollum_check_is_lollumframework() && (get_option('lolfmk_support_page_builder') == 'yes')) {
	require_once LOLLUMCORE_PATH . 'builder/functions-builder.php';
}

// WooCommerce
if (lollum_check_is_woocommerce()) {
	require_once LOLLUMCORE_PATH . 'includes/woocommerce.php';
	require_once LOLLUMCORE_PATH . 'includes/woocommerce-custom-styles.php';
}

// Theme Options
require_once LOLLUMCORE_PATH . 'admin/admin-functions.php';
require_once LOLLUMCORE_PATH . 'admin/admin-core.php';
require_once LOLLUMCORE_PATH . 'admin/theme-options/theme-options.php';

// Plugins Activation
require_once LOLLUMCORE_PATH . 'includes/class-tgm-plugin-activation.php';

// Theme Update
require_once LOLLUMCORE_PATH . 'includes/update.php';

// Widgets
require_once LOLLUMCORE_PATH . 'widgets/widget-twitter.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-flickr.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-flickr-footer.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-category.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-dribbble.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-dribbble-footer.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-popular.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-video.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-postformat.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-info.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-loved.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-posts.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-projects.php';
require_once LOLLUMCORE_PATH . 'widgets/widget-jobs.php';