<?php
/**
 * Lollum
 * 
 * The template for displaying the mailchimp block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_mailchimp')) {
	function lolfmk_print_mailchimp($item) {
		$block_title = lolfmk_find_xml_value($item, 'block-title');
		$action_url = lolfmk_find_xml_value($item, 'action-url');
		$btn_text = lolfmk_find_xml_value($item, 'btn-text');

		echo '<div class="newsletter-block">';
		echo '<div class="row">';
		echo '<div class="newsletter-title col-6">';
		echo '<h3>'.$block_title.'</h3>';
		echo '</div>';
		echo '<div class="mc_form">';
		echo '<form action="'.$action_url.'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">';
		echo '<div class="mc-field-group col-3">';
		echo '<label for="mce-EMAIL">Email Address</label>';
		echo '<input type="email" value="" name="EMAIL" id="mce-EMAIL" placeholder="enter your email">';
		echo '</div>';
		echo '<div class="btn-newsletter-wrap col-3">';
		echo '<div class="btn-newsletter">';
		echo '<i class="fa fa-envelope"></i>';
		echo '<input type="submit" value="'.$btn_text.'" name="subscribe" id="mc-embedded-subscribe" class="button">';
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
}