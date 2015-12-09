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

require_once 'admin-options.php';

if (!function_exists('lollumframework_add_admin')) {
	function lollumframework_add_admin() {

		// global $query_string;

		$themename =  "Big Point";      

		if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'lollumframework') {
			if (isset($_REQUEST['lol_save']) && 'reset' == $_REQUEST['lol_save']) {
				$options =  get_option('lol_template'); 
				lol_reset_options($options,'lollumframework');
				header("Location: themes.php?page=lollumframework&reset=true");
				die;
			}
		}

		$lol_page_admin = add_submenu_page('themes.php', $themename, __('Theme Options', 'lollum'), 'edit_theme_options', 'lollumframework','lollumframework_options_page');

		if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'lollumframework') {

			add_action("admin_enqueue_scripts", 'lollumframework_add_js');
			add_action("admin_enqueue_scripts",'lollumframework_add_css');

		}

	}
}
add_action('admin_menu', 'lollumframework_add_admin');

if (!function_exists('lollumframework_add_js')) {
	function lollumframework_add_js() {
		wp_register_script('ajaxupload', LOLLUMCORE_URI . 'admin/js/ajaxupload.js', 'jquery', '1.0', 1);
		wp_register_script('color-picker-admin', LOLLUMCORE_URI . 'admin/js/colorpicker.js', array('jquery'), '1.0', 1);
		add_action('admin_footer', 'lol_admin_js');
		wp_enqueue_script('ajaxupload');
		wp_enqueue_script('color-picker-admin');
	}
}

if (!function_exists('lollumframework_add_css')) {
	function lollumframework_add_css() {
		wp_register_style('admin-style', LOLLUMCORE_URI . 'admin/admin-style.css');
		wp_register_style('color-picker', LOLLUMCORE_URI . 'admin/css/colorpicker.css');
		wp_register_style('google-sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
		wp_register_style('google-serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400italic');

		wp_enqueue_style('admin-style');
		wp_enqueue_style('color-picker');
		wp_enqueue_style('google-sans');
		wp_enqueue_style('google-serif');
	}
}

if (!function_exists('lol_reset_options')) {
	function lol_reset_options($options,$page = ''){

		global $wpdb;
		$query_inner = '';
		$count = 0;
		
		$excludes = array('blogname', 'blogdescription');
		
		foreach ($options as $option) {
				
			if (isset($option['id'])) { 
				$count++;
				$option_id = $option['id'];
				$option_type = $option['type'];
				
				if (in_array($option_id,$excludes)) { 
					continue; 
				}
				
				if ($count > 1) { 
					$query_inner .= ' OR ';
				}

				if (is_array($option_type)) {
					$type_array_count = 0;
					foreach ($option_type as $inner_option) {
						$type_array_count++;
						$option_id = $inner_option['id'];

						if($type_array_count > 1) {
							$query_inner .= ' OR ';
						}

						$query_inner .= "option_name = '$option_id'";
					}
					
				} else {
					$query_inner .= "option_name = '$option_id'";
				}
			}	
		}
		
		if ($page == 'lollumframework') {
			$query_inner .= " OR option_name = 'lol_options'";
		}
			
		$query = "DELETE FROM $wpdb->options WHERE $query_inner";
		$wpdb->query($query);

	}
}

require_once 'admin-js.php';

add_action('wp_ajax_lol_ajax_post_action', 'lol_ajax_callback');
if (!function_exists('lol_ajax_callback')) {
	function lol_ajax_callback() {
		global $wpdb;
			
		$save_type = $_POST['type'];
		if ($save_type == 'upload') {
			
			$clickedID = $_POST['data'];
			$filename = $_FILES[$clickedID];
				$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
			$override['test_form'] = false;
			$override['action'] = 'wp_handle_upload';    
			$uploaded_file = wp_handle_upload($filename,$override);

				$upload_tracking[] = $clickedID;
				update_option($clickedID , $uploaded_file['url']);
					
			if (!empty($uploaded_file['error'])) {
				echo 'Upload Error: ' . $uploaded_file['error'];
			} else { 
				echo $uploaded_file['url']; 
			}
		}

		elseif ($save_type == 'image_reset') {
				
			$id = $_POST['data'];
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
		
		}

		elseif ($save_type == 'options' OR $save_type == 'lollum') {

			$data = $_POST['data'];
			parse_str($data,$output);
				$options = get_option('lol_template');

			foreach ($options as $option_array) {
				$id = $option_array['id'];
				$old_value = get_option($id);
				$new_value = '';
				
				if (isset($output[$id])) {
					$new_value = $output[$option_array['id']];
				}
		
				if (isset($option_array['id'])) {

					$type = $option_array['type'];
					
					if (is_array($type)) {

						foreach ($type as $array) {
							if ($array['type'] == 'text') {
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];

								if ($new_value == '') {  
									$new_value = $std; 
								}

								update_option($id, stripslashes($new_value));
							}
						}                 
					}

					elseif ($new_value == '' && $type == 'checkbox') {
						update_option($id,'false');
					}

					elseif ($new_value == 'true' && $type == 'checkbox') {
						update_option($id,'true');
					}

					else {
						update_option($id,stripslashes($new_value));
					}
				}
			}	
		}

		die();

	}
}