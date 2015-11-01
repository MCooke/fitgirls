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
* case section description
******************************/

function lolfmk_case_sectiondescription($type, $name, $message) {
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<div class="section-description"><p>'.$message.'</p></div>';
	echo '<br></div>';
	echo '<div class="explain"></div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case section title
******************************/

function lolfmk_case_sectiontitle($name) {
	echo '<h4 class="section-title">'.$name.'</h4>';
}


/******************************
* case text
******************************/

function lolfmk_case_text($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$val.'">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case hidden field
******************************/

function lolfmk_case_text_hidden($id, $std, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.$val.'">';
}

/******************************
* case love meta
******************************/

function lolfmk_case_meta_love($id, $std, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.$val.'">';
}

/******************************
* case textarea
******************************/

function lolfmk_case_textarea($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<textarea name="'.$id.'" id="'.$id.'" value="'.$val.'" cols="5" rows="8">'.$val.'</textarea>';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case select
******************************/

function lolfmk_case_select($type, $id, $std, $name, $desc, $options, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo'<select name="'.$id.'">';
	foreach ($options as $option) {
		echo'<option';
		if ($meta == $option) { 
			echo ' selected="selected"'; 
		}
		echo'>'.$option.'</option>';
	} 
	echo'</select>';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case checkbox
******************************/

function lolfmk_case_checkbox($type, $id, $std, $name, $desc, $meta) {
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="checkbox" name="'.$id.'" id="'.$id.'" value="yes"';
	if ($meta == 'yes') {
		echo "checked='yes'";
	} else {
		echo "";
	}
	echo '><br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case multicheckbox
******************************/

function lolfmk_case_multicheckbox($type, $id, $std, $name, $desc, $options, $meta) {
	$val = $meta ? $meta : array($std);
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	foreach ($options as $key => $option) {
		echo '<input type="checkbox" name="'.$id.'[]" id="'.$id.'_'.$key.'" value="'.$key.'"';
		if (in_array($key, $val)) {
			echo "checked='yes'";
		} else {
			echo "";
		}
		echo '><label class="label-multicheck" for="'.$key.'">'.$option.'</label><br><br>';
	}
	echo '</div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case multicheckbox taxonomy
******************************/

function lolfmk_case_multicheckbox_taxonomy($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : array($std);
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	$terms = get_terms("portfolio-categories");
	foreach ($terms as $term) {
		echo '<input type="checkbox" name="'.$id.'[]" id="'.$id.'_'.$term->term_id.'" value="'.$term->term_id.'"';
		if (in_array($term->term_id, $val)) {
			echo "checked='yes'";
		} else {
			echo "";
		}
		echo '><label class="label-multicheck" for="'.$term->term_id.'">'.$term->name.'</label><br><br>';
	}
	echo '</div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case upload
******************************/

function lolfmk_case_upload($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$val.'"><br>';
	echo '<input type="button" class="upload-button" name="'.$id.'" id="'.$id.'"value="Upload">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case upload video
******************************/

function lolfmk_case_upload_video($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$val.'"><br>';
	echo '<input type="button" class="upload-button-video" name="'.$id.'" id="'.$id.'"value="Upload">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case upload audio
******************************/

function lolfmk_case_upload_audio($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$val.'"><br>';
	echo '<input type="button" class="upload-button-audio" name="'.$id.'" id="'.$id.'"value="Upload">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case upload image
******************************/

function lolfmk_case_upload_image($type, $id, $std, $name, $desc, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$val.'"><br>';
	echo '<input type="button" class="upload-button-image" name="'.$id.'" id="'.$id.'"value="Upload">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}


/******************************
* case color
******************************/

function lolfmk_case_color($type, $id, $std, $name, $desc, $meta) {
	$val = $std;
	$stored  = $meta;
	if ($stored != "") { 
		$val = $stored; 
	}
	echo '<div class="section section-'.$type.'">';
	echo '<h4 class="heading">'.$name.'</h4>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<div id="'.$id.'_picker" class="colorSelector"><div></div></div>';
	echo '<input class="lol-color" name="'.$id.'" id="'.$id.'" type="text" value="'.$val.'">';
	echo '<br></div>';
	echo '<div class="explain">'.$desc.'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';
}