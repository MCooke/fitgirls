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

if (!function_exists('lollumframework_options_page')) {
	function lollumframework_options_page(){
		$options =  get_option('lol_template');      
	?>

	<div class="wrap" id="wrap-admin">
		<div id="lol-message-save" class="lol-popup-message">
			<div class="lol-popup-save"><?php _e('Options Updated', 'lollum'); ?></div>
		</div>
		<div id="lol-message-reset" class="lol-popup-message">
			<div class="lol-popup-reset"><?php _e('Options Resetted', 'lollum'); ?></div>
		</div>

		<form enctype="multipart/form-data" id="lol-admin-form" action="<?php echo admin_url();?>themes.php?page=lollumframework">
			<div id="header">
				<div id="corner"></div>
				<div id="banner"><h1><?php _e('Theme Options', 'lollum'); ?></h1></div>
				<div class="clear"></div>
			</div>
			<?php 
			$return = lollumframework_cases($options);
			?>
			<div id="main">
				<div id="lol-admin-nav">
					<ul>
						<?php echo $return[1]; ?>
					</ul>
				</div>
				<div id="content">
					<?php echo $return[0]; ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="lol-admin-footer">
				<input type="submit" value="<?php _e('Save All Changes', 'lollum'); ?>" class="save-button">
			</div>
		</form>
		<form method="post" style="display:inline" id="lol-admin-reset" action="<?php echo admin_url();?>themes.php?page=lollumframework">
			<span class="submit-footer-reset">
				<input name="reset" type="submit" value="<?php _e('Reset Options', 'lollum'); ?>" class="submit-button reset-button" onclick="return confirm('<?php _e('Click OK to reset. Any settings will be lost!', 'lollum'); ?>');">
				<input type="hidden" name="lol_save" value="reset">
			</span>
		</form>
		
		<div class="clear"></div>
		<div id="js-admin-warning"><span><?php _e('Please enable Javascript to use this panel', 'lollum'); ?></span></div>
	</div>

	<?php
	}
}

// Option cases

if (!function_exists('lollumframework_cases')) {
	function lollumframework_cases($options) {

	   $counter = 0;
		$menu = '';
		$output = '';
		foreach ($options as $value) {
		   
			$counter++;
			$val = '';

			if ($value['type'] == "open-section") {
				if (isset($value['class'])) {
			 		$class = $value['class'];
			 	}
			 	if (isset($value['id'])) {
			 		$id = $value['id'];
			 	}
				$output .= '<div class="wrap-section ' . $class . '" id="wrap-section_' . $id . '">' . "\n";
			}

			elseif ($value['type'] == "close-section") {
				$output .= '</div>';
			}

			elseif ($value['type'] == "section-description") {
				$output .= '<div class="section section-' . $value['type'] . '">' . "\n";
				$output .= '<div class="option">' . "\n" . '<div class="command">' . "\n";
			}

			elseif ($value['type'] != "heading") {
			 	$class = ''; 

			 	if (isset($value['class'])) {
			 		$class = $value['class'];
			 	}

				$output .= '<div class="section section-' . $value['type'] . ' ' . $class . '">' . "\n";
				$output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
				$output .= '<div class="option">' . "\n" . '<div class="command">' . "\n";
			}

			$select_value = ''; 

			switch ($value['type']) {

			case "section-description":
			
				$output .= '<div class="section-description"><p>' . $value['message'] . '</p></div>';
				
			break;
			
			case 'text':
				$val = $value['std'];
				$std = get_option($value['id']);

				if ($std != "") { 
					$val = $std; 
				}

				$output .= '<input class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="' . stripslashes(htmlspecialchars($val)) . '">';		
			break;

			case 'textarea':
				
				$textarea_value = '';
				
				if (isset($value['std'])) {
					$textarea_value = $value['std']; 
				}

				$std = get_option($value['id']);
				
				if($std != "") { 
					$textarea_value = stripslashes($std); 
				}

				$output .= '<textarea class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="46" rows="10">' . $textarea_value . '</textarea>';
				
			break;

			case 'textarea-css':
				
				$textarea_value = '';
				
				if (isset($value['std'])) {
					$textarea_value = $value['std']; 
				}

				$std = get_option($value['id']);
				
				if($std != "") { 
					$textarea_value = stripslashes($std); 
				}

				$output .= '<textarea class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="46" rows="10">' . stripslashes(htmlspecialchars($textarea_value)) . '</textarea>';
				
			break;
			
			case 'select':

				$output .= '<select class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';
				$select_value = get_option($value['id']);
				 
				foreach ($value['options'] as $option) {
					
					$selected = '';
					
					if ($select_value != '') {
						if ($select_value == $option) { 
							$selected = ' selected="selected"';
						} 
				   } else {
						if (isset($value['std'])) {
							if ($value['std'] == $option) {
								$selected = ' selected="selected"';
							}
						}
					}
					  
					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				 
				} 
				$output .= '</select>';
		
			break;

			case 'section-select':

				$output .= '<select class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';
				$select_value = get_option($value['id']);
				 
				foreach ($value['options'] as $option) {
					
					$selected = '';
					
					if ($select_value != '') {
						if ($select_value == $option) { 
							$selected = ' selected="selected"';
						} 
				   } else {
						if (isset($value['std'])) {
							if ($value['std'] == $option) {
								$selected = ' selected="selected"';
							}
						}
					}
					  
					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				 
				} 
				$output .= '</select>';

				if (get_option($value['id']) != "") { 
					$sel = stripslashes(get_option($value['id'])); 
				} else { 
					$sel = $value['std']; 
				};

				$select = $value['id'];

			break;

			case 'font-select':

				$output .= '<select class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';
				$output .= '<option disabled>Standard Fonts</option>';
				$select_value = get_option($value['id']);
				 
				foreach ($value['options-web'] as $option) {
					
					$selected = '';
					
					if ($select_value != '') {
						if ($select_value == $option) { 
							$selected = ' selected="selected"';
						} 
					} else {
						if (isset($value['std'])) {
							if ($value['std'] == $option) { 
						 		$selected = ' selected="selected"'; 
						 	}
						}
					}

					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				 
				} 

				$output .= '<option disabled>Google Fonts</option>';

				foreach ($value['options-google'] as $option) {
					
					$selected = '';
					
					if ($select_value != '') {
						if ($select_value == $option) { 
							$selected = ' selected="selected"';
						} 
				   } else {
						if (isset($value['std'])) {
							if ($value['std'] == $option) { 
								$selected = ' selected="selected"'; 
							}
						}
					}
					  
					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				 
				}

				$output .= '</select>';

			break;

			case 'image-preview':

				$output .= '<select class="lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '">';
				$select_value = get_option($value['id']);
				 
				foreach ($value['options'] as $option) {
					
					$selected = '';
					
					if ($select_value != '') {
						if ($select_value == $option) { 
							$selected = ' selected="selected"';
						} 
				   } else {
						if (isset($value['std'])) {
							if ($value['std'] == $option) {
								$selected = ' selected="selected"';
							}
						}
					}
					  
					$output .= '<option' . $selected . '>';
					$output .= $option;
					$output .= '</option>';
				 
				} 
				$output .= '</select>';

				$output .= '<div class="preview"><div class="lol-img-preview"></div></div>';

			break;

			case "radio-images":

				$i = 0;
				$select_value = get_option($value['id']);
					   
				foreach ($value['options'] as $key => $option) { 

				 	$i++;

					$checked = '';
					$selected = '';

					if ($select_value != '') {
						if ($select_value == $key) { 
							$checked = ' checked';
							$selected = 'lol-radio-img-selected'; 
						} 
					} 

					else {
						if ($value['std'] == $key) { 
							$checked = ' checked'; 
							$selected = 'lol-radio-img-selected'; 
						}
						elseif ($i == 1  && !isset($select_value)) { 
							$checked = ' checked'; 
							$selected = 'lol-radio-img-selected'; 
						}
						elseif ($i == 1  && $value['std'] == '') { 
							$checked = ' checked'; 
							$selected = 'lol-radio-img-selected'; 
						}
						else { 
							$checked = ''; 
						}
					}	
					
					$output .= '<div>';
					$output .= '<input type="radio" id="lol-radio-img-' . $value['id'] . $i . '" class="checkbox lol-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . '>';
					$output .= '<div class="lol-radio-img-label">' . $key . '</div>';
					$output .= '<img src="' . $option . '" alt="" class="lol-radio-img-img ' . $selected . '" onClick="document.getElementById(\'lol-radio-img-' . $value['id'] . $i . '\').checked = true;">';
					$output .= '</div>';
					
				}

			break;

			case "radio":
				
				$select_value = get_option($value['id']);
					   
				foreach ($value['options'] as $key => $option) { 

					$checked = '';

					if ($select_value != '') {
						if ($select_value == $key) { 
							$checked = ' checked'; 
						} 
					} else {
						if ($value['std'] == $key) { 
							$checked = ' checked'; 
						}
					}

					$output .= '<input class="lol-input lol-radio" type="radio" name="' . $value['id'] . '" value="' . $key . '" ' . $checked . '>' . $option . '<br>';
				}
				 
			break;

			case "checkbox": 
			
				$std = $value['std'];  
			   
				$saved_std = get_option($value['id']);
			   
				$checked = '';
				
				if(!empty($saved_std)) {
					if($saved_std == 'true') {
						$checked = 'checked="checked"';
					} else {
					   $checked = '';
					}
				}

				elseif ($std == 'true') {
				   $checked = 'checked="checked"';
				}
				
				else {
					$checked = '';
				}

				$output .= '<input type="checkbox" class="checkbox lol-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="true" ' . $checked . '>';

			break;

			case "upload":
				
				$output .= lollum_uploader_function($value['id'],$value['std']);
				
			break;
			
			case "color":

				$val = $value['std'];
				$stored  = get_option($value['id']);
				
				if ($stored != "") { 
					$val = $stored; 
				}

				$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';

				$output .= '<input class="lol-color" name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $val . '">';

			break;                                         
			
			case "heading":
				
				if($counter >= 2) {
				   $output .= '</div>' . "\n";
				}

				$jquery_click_hook = preg_replace("/[^A-Za-z0-9]/", "", strtolower($value['name']));
				$jquery_click_hook = "lol-option-" . $jquery_click_hook;
				$menu .= '<li><a title="' . $value['name'] . '" href="#' . $jquery_click_hook .'">' . $value['name'] . '</a></li>';
				$output .= '<div class="options-group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";

			break;                                  
			} 

			if (($value['type'] != "heading") && ($value['type'] != "open-section") && ($value['type'] != "close-section")) { 
				if ($value['type'] != "checkbox") { 
					$output .= '<br>';
				}
				if (!isset($value['desc'])) { 
					$explain_value = ''; 
				} else { 
					$explain_value = $value['desc']; 
				}

				$output .= '</div><div class="explain">' . $explain_value . '</div>' . "\n";
				$output .= '<div class="clear"> </div></div></div>' . "\n";
			}
		   
		}

		$output .= '</div>';
		return array($output,$menu);
	}
}

if (!function_exists('lollum_uploader_function')) {
	function lollum_uploader_function($id,$std) {

		$uploader = '';
		$upload = get_option($id);
		
		$val = $std;

		if (get_option($id) != "") { 
			$val = get_option($id);
		}

		$uploader .= '<input class="lol-input" name="' . $id . '" id="' . $id . '_upload" type="text" value="' . $val . '">';
		
		
		$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="' . $id . '">'.__("Upload Image", "lollum").'</span>';
		
		if(!empty($upload)) {
			$hide = '';
		} else { 
			$hide = 'hide';
		}
		
		$uploader .= '<span class="button image_reset_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">'.__("Remove", "lollum").'</span>';
		$uploader .='</div>' . "\n";
		$uploader .= '<div class="clear"></div>' . "\n";
		if(!empty($upload)) {
			$uploader .= '<a class="lol-uploaded-image" href="' . $upload . '">';
			$uploader .= '<img class="lol-option-image" id="image_' . $id . '" src="' . $upload . '" alt="">';
			$uploader .= '</a>';
		}
		
		$uploader .= '<div class="clear"></div>' . "\n";

	return $uploader;

	}
}

?>