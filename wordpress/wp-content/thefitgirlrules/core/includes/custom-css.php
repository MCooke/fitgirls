<?php
/**
 * Lollum
 * 
 * Custom user styles function
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/**
 * Custom user styles
 */

add_action('wp_head', 'lollum_print_custom_user_styles');
if (!function_exists('lollum_print_custom_user_styles')) {
	function lollum_print_custom_user_styles() { ?>

	<style type="text/css">

	<?php echo stripslashes(get_option('lol_custom_css')); ?>
	
	</style>
	<?php
	}
}