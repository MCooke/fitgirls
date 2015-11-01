jQuery(document).ready(function() {
	"use strict";
	/* global tinyMCE, tb_remove */
	// Button shortcode
	jQuery(document).on('click', '#insert-shortcode-button', function(){
		var shortcode = '',
			buttonText = jQuery('#lol-button-text').val(),
			buttonURL = jQuery('#lol-button-url').val(),
			buttonSize = jQuery('#lol-button-size').val();
		shortcode = '[lollum_button';
		shortcode += ' text="' + buttonText + '"';
		shortcode += ' url="' + buttonURL + '"';
		shortcode += ' size="' + buttonSize + '"';
		shortcode += ']';
		tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
		tb_remove();
	});
	// Skill shortcode
	jQuery(document).on('click', '#insert-shortcode-skill', function(){
		var shortcode = '',
			skillSize = jQuery('#lol-skill-size').val(),
			skillName = jQuery('#lol-skill-name').val();
		shortcode = '[lollum_skill';
		shortcode += ' name="' + skillName + '"';
		shortcode += ' size="' + skillSize + '"';
		shortcode += ']';
		tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
		tb_remove();
	});
	// Price shortcode
	jQuery(document).on('click', '#insert-shortcode-price', function(){
		var shortcode = '',
			priceItem = '',
			priceSize = jQuery('#lol-price-size').val();
		shortcode = '[lollum_price_table columns="' + priceSize + '"]' + '<br><br>';
		for (var i=0; i<priceSize; i++) {
			priceItem += '[lollum_price_item name="" popular="no" cost="" currency="$" plan="monthly" btn_text="" btn_url="http://"]' + '<br>';
			priceItem += '[lollum_price_package][/lollum_price_package]' + '<br>';
			priceItem += '[lollum_price_package][/lollum_price_package]' + '<br>';
			priceItem += '[lollum_price_package][/lollum_price_package]' + '<br>';
			priceItem += '[/lollum_price_item]' + '<br><br>';
		}
		shortcode += priceItem + '[/lollum_price_table]' + '<br>';
		tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
		tb_remove();
	});
});