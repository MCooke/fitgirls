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
* item inner stuff
******************************/

function lolfmk_item_btns($block, $edit = null, $size = null) {
	$block_inner = '<div class="page-item-inner">';
	if ($size == 'yes') {
		$block_inner .= '<div class="change-size">';
		$block_inner .= '<div class="btn-change-size btn-plus">Add size</div>';
		$block_inner .= '<div class="btn-change-size btn-minus">Subtract size</div>';
		$block_inner .= '</div>';
	}
	$block_inner .= '<h5 class="item-title handle">'.$block.'</h5>';
	if ($edit == 'yes') {
		$block_inner .= '<div class="edit-item-btn">Edit item</div>';
	}
	$block_inner .= '<div class="btn-clone">Clone item</div>';
	$block_inner .= '<div class="delete-item">Delete item</div>';
	$block_inner .= '</div>';
	echo $block_inner;
}

function lolfmk_item_before_inner($block) {
	$before_inner = '<div class="edit-item">';
	$before_inner .= '<div class="edit-item-inner">';
	$before_inner .= '<div class="edit-item-close-btn">Close item</div>';
	$before_inner .= '<h5 class="item-title">'.$block.'</h5>';
	$before_inner .= '<div class="commands">';
	echo $before_inner;
}

function lolfmk_item_after_inner() {
	$after_inner = '<input class="item-xml" name="item-xml[]" type="hidden" value="">';
	$after_inner .= '</div>';
	$after_inner .= '</div>';
	$after_inner .= '</div>';
	$after_inner .= '</div>';
	echo $after_inner;
}


/******************************
* case text
******************************/

function lolfmk_pb_text($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input class="xml esc" type="text" data-type="'.$ob['data'].'" value="'.$ob['value'].'">';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}

/******************************
* case textarea
******************************/

function lolfmk_pb_textarea($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<textarea cols="10" rows="8" class="xml esc" data-type="'.$ob['data'].'">'.$ob['value'].'</textarea>';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}


/******************************
* case simple select
******************************/

function lolfmk_pb_simple_select($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo'<select class="xml" data-type="'.$ob['data'].'">';
	foreach ($ob['options'] as $option) {
		echo'<option';
		if ($ob['value'] == $option) { 
			echo ' selected="selected"'; 
		}
		echo'>' . $option . '</option>';
	}
	echo'</select>';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}


/******************************
* case select
******************************/

function lolfmk_pb_select($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo'<select class="xml" data-type="'.$ob['data'].'">';
	foreach ($ob['options'] as $key => $value) {
		echo '<option value="'.$key.'"';
		if ($ob['value'] == $key) { 
			echo ' selected="selected"'; 
		}
		echo'>'.$value.'</option>';
	}
	echo'</select>';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}


/******************************
* case upload
******************************/

function lolfmk_pb_upload($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input type="text" name="input-image" id="input-image" value="'.$ob['value'].'" class="xml" data-type="'.$ob['data'].'"><br>';
	echo '<input type="button" name="input-image" id="input-image" class="upload-button" value="'.__("Upload", "lollum").'">';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}


/******************************
* case color
******************************/

function lolfmk_pb_color($ob) {
	echo '<h6 class="option-title">'.$ob['name'].'</h6>';
	echo '<div class="option">';
	echo '<div class="command">';
	echo '<input class="xml input-color" type="text" value="'.$ob['value'].'" data-type="'.$ob['data'].'">';
	echo '<br></div>';
	echo '<div class="explain">'.$ob['desc'].'</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
}

/******************************
* dropdown with blocks
******************************/

function lolfmk_case_select_element($type, $id, $std, $name, $desc, $options, $meta) {
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));

	echo '<div class="section section-' . $type . '">';
	echo '<h4 class="heading">' . $name . '</h4>';
	echo '<div class="option">';
	echo '<div class="command">';

	echo'<select id="page-select-element-list">';
	foreach ($options as $option) {
		echo'<option>' . $option . '</option>';
	} 
	echo'</select>';

	echo '<input type="button" id="add-page-item-btn" value="'.__("Add element", "lollum").'">';

	echo '<br></div>';
	echo '<div class="explain">' . $desc . '</div>';
	echo '<div class="clear"></div>';
	echo '</div>';
	echo '</div>';

	echo '<div class="page-element-lists" id="page-element-lists">';	
	echo '<br>';
	echo '</div>';
}


/******************************
* open/close block list
******************************/

function lolfmk_open_default_list() {		
	echo '<div id="page-item-list-default">';
}
function lolfmk_close_default_list() {		
	echo '<div class="clear"></div>';
	echo '</div>';
}


/******************************
* print default blocks
******************************/

function lolfmk_items_selected($meta_xml) {
	echo '<div id="section-items-selected"><div id="section-items-selected-inner">';
	lolfmk_print_default_items($meta_xml);
	echo '</div></div>';
}

/******************************
* the whole xml and a js check
******************************/

function lolfmk_page_xml($id, $std, $meta) {		
	$val = $meta ? $meta : $std;
	$val = stripslashes(htmlspecialchars($val, ENT_QUOTES));
	echo '<input type="hidden" name="'.$id.'" id="'.$id.'" value="'.$val.'">';
	echo '<input type="hidden" id="check-js" name="check-js" value="no-js">';
}