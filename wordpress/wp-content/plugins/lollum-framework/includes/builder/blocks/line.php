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
* line block
******************************/

function lolfmk_print_line_admin($item = null) {

	echo '<div class="page-item item-line item-1-1" data-type="item-line" data-item="Line">';

	lolfmk_item_btns('Line');
	lolfmk_item_before_inner('Line');
	
	echo '<input class="item-size xml" type="hidden" value="1-1" data-type="size">';
	
	lolfmk_item_after_inner();
}