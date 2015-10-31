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

if (is_admin() && isset($_GET['activated']) && $pagenow == "themes.php") {
	add_action('admin_head','lol_option_setup');
}

if (!function_exists('lol_option_setup')) {
	function lol_option_setup() {

		$lol_array = array();
		add_option('lol_options',$lol_array);

		$template = get_option('lol_template');
		$saved_options = get_option('lol_options');
		
		foreach($template as $option) {
			if($option['type'] != 'heading' && isset($option['id'])) {
				$id = $option['id'];
				if (isset($option['std'])) {
					$std = $option['std'];
				}
				$db_option = get_option($id);
				if(empty($db_option)) {
					if(is_array($option['type'])) {
						foreach($option['type'] as $child) {
							$c_id = $child['id'];
							$c_std = $child['std'];
							update_option($c_id,$c_std);
							$lol_array[$c_id] = $c_std; 
						}
					} else {
						update_option($id,$std);
						$lol_array[$id] = $std;
					}
				}
				else {
					$lol_array[$id] = $db_option;
				}
			}
		}
		update_option('lol_options',$lol_array);
	}
}