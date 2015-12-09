<?php
/**
 * Lollum
 * 
 * The template for displaying the info block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_info')) {
	function lolfmk_print_info($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$text = lolfmk_find_xml_value($item, 'info-text');
		$address = lolfmk_find_xml_value($item, 'info-address');
		$tel = lolfmk_find_xml_value($item, 'info-tel');
		$fax = lolfmk_find_xml_value($item, 'info-fax');
		$email = lolfmk_find_xml_value($item, 'info-email');
		$web = lolfmk_find_xml_value($item, 'info-web');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		echo '<div class="lol-item-info">';
		if ($text != '') {
			echo '<p class="contact-information">'.$text.'</p>';
		}
		echo '<div class="vcard">';
		if ($address != '') {
			echo '<div class="adr"><i class="icon fa fa-home"></i>'.$address.'</div>';
		}
		if ($tel != '') {
			echo '<div class="tel"><i class="icon fa fa-phone"></i>'.$tel.'</div>';
		}
		if ($fax != '') {
			echo '<div class="fax"><i class="icon fa fa-print"></i>'.$fax.'</div>';
		}
		if ($email != '') {
			echo '<div class="email"><i class="icon fa fa-envelope"></i><a href="mailto:'.$email.'">'.$email.'</a></div>';
		}
		if ($web != '') {
			echo '<div class="website"><i class="icon fa fa-globe"></i><a href="http://'.$web.'">'.$web.'</a></div>';
		}
		echo '</div>';
		echo '</div>';
	}
}