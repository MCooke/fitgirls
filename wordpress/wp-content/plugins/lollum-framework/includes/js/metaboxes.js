jQuery(document).ready(function($){
	"use strict";
	/* global tb_show, tb_remove, jQuery */
	var templateSelected = $('#page_template'),
		metaBuilder = $('#lolfmkbox-meta-box-elements'),
		metaPortfolio = $('#lolfmkbox-meta-box-portfolio-settings'),
		videoSettings = $('#lolfmkbox-meta-box-video'),
		videoCheck = $('#post-format-video'),
		audioSettings = $('#lolfmkbox-meta-box-audio'),
		audioCheck = $('#post-format-audio'),
		linkSettings = $('#lolfmkbox-meta-box-link'),
		linkCheck = $('#post-format-link'),
		gallerySettings = $('#lolfmkbox-meta-box-gallery'),
		galleryCheck = $('#post-format-gallery'),
		imageSettings = $('#lolfmkbox-meta-box-image'),
		imageCheck = $('#post-format-image'),
		quoteSettings = $('#lolfmkbox-meta-box-quote'),
		quoteCheck = $('#post-format-quote'),
		portfolioVideoSettings = $('#lolfmkbox-meta-box-portfolio-video'),
		portfolioGallerySettings = $('#lolfmkbox-meta-box-portfolio-gallery'),
		postFormatSelect = jQuery('#post-formats-select input'),
		portfolioFormatSelect = jQuery('select[name=lolfmkbox_portfolio_type]');

	/* hide page templates meta boxes */
	metaPortfolio.hide();
	/* hide post formats meta boxes */
	videoSettings.hide();
	audioSettings.hide();
	linkSettings.hide();
	quoteSettings.hide();
	gallerySettings.hide();
	imageSettings.hide();
	/* hide portfolio settings meta boxes */
	portfolioVideoSettings.hide();
	portfolioGallerySettings.hide();
	/* show meta boxes by post format selected */
	if(videoCheck.is(':checked')) {
		videoSettings.removeClass('closed').show();
	}
	if(audioCheck.is(':checked')) {
		audioSettings.removeClass('closed').show();
	}
	if(linkCheck.is(':checked')){
		linkSettings.removeClass('closed').show();
	}
	if(quoteCheck.is(':checked')){
		quoteSettings.removeClass('closed').show();
	}
	if(galleryCheck.is(':checked')){
		gallerySettings.removeClass('closed').show();
	}
	if(imageCheck.is(':checked')){
		imageSettings.removeClass('closed').show();
	}
	postFormatSelect.change(function(){
		if (jQuery(this).val() === 'video') {
			videoSettings.removeClass('closed').show();
			audioSettings.hide();
			linkSettings.hide();
			quoteSettings.hide();
			gallerySettings.hide();
			imageSettings.hide();
		} else if (jQuery(this).val() === 'audio') {
			audioSettings.removeClass('closed').show();
			videoSettings.hide();
			linkSettings.hide();
			quoteSettings.hide();
			gallerySettings.hide();
			imageSettings.hide();
		} else if (jQuery(this).val() === 'link') {
			linkSettings.removeClass('closed').show();
			videoSettings.hide();
			audioSettings.hide();
			quoteSettings.hide();
			gallerySettings.hide();
			imageSettings.hide();
		} else if (jQuery(this).val() === 'quote') {
			quoteSettings.removeClass('closed').show();
			videoSettings.hide();
			audioSettings.hide();
			linkSettings.hide();
			gallerySettings.hide();
			imageSettings.hide();
		} else if (jQuery(this).val() === 'gallery') {
			gallerySettings.removeClass('closed').show();
			videoSettings.hide();
			audioSettings.hide();
			linkSettings.hide();
			quoteSettings.hide();
		} else if (jQuery(this).val() === 'image') {
			imageSettings.removeClass('closed').show();
			videoSettings.hide();
			audioSettings.hide();
			linkSettings.hide();
			quoteSettings.hide();
			gallerySettings.hide();
		} else {
			videoSettings.hide();
			audioSettings.hide();
			linkSettings.hide();
			quoteSettings.hide();
			imageSettings.hide();
			gallerySettings.hide();
		}
	});
	/* show meta boxes by page template selected */
	if (templateSelected.val()) {
		if (templateSelected.val() === 'default') {
			metaPortfolio.hide();
		} else if (templateSelected.val() === 'template-page-sidebar-left.php' || templateSelected.val() === 'template-page-sidebar-right.php') {
			metaPortfolio.hide();
			metaBuilder.hide();
		} else {
			metaPortfolio.removeClass('closed').show();
		}
	}
	templateSelected.change(function(){
		if (jQuery(this).val() === 'default') {
			metaBuilder.removeClass('closed').show();
			metaPortfolio.hide();
		} else if (jQuery(this).val() === 'template-page-sidebar-left.php' || jQuery(this).val() === 'template-page-sidebar-right.php') {
			metaPortfolio.hide();
			metaBuilder.hide();
		} else {
			metaBuilder.removeClass('closed').show();
			metaPortfolio.removeClass('closed').show();
		}
	});
	/* show meta boxes by slider type selected */
	if (portfolioFormatSelect.val()) {
		if (portfolioFormatSelect.val() === 'video') {
			portfolioVideoSettings.removeClass('closed').show();
		} else if (portfolioFormatSelect.val() === 'slider') {
			portfolioGallerySettings.removeClass('closed').show();
		}
	}
	portfolioFormatSelect.change(function(){
		if (jQuery(this).val() === 'video') {
			portfolioVideoSettings.removeClass('closed').show();
			portfolioGallerySettings.hide();
		} else if (jQuery(this).val() === 'slider') {
			portfolioGallerySettings.removeClass('closed').show();
			portfolioVideoSettings.hide();
		} else {
			portfolioGallerySettings.hide();
			portfolioVideoSettings.hide();
		}
	});
	/* init minicolors */
	jQuery('.lol-color').minicolors();
	/* upload manager image */
	$(document).on('click', 'input.upload-button', function() { 
		var upField = $(this).prev().prev();
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			var imgurl = jQuery('img',html).attr('src'); 
			upField.val(imgurl);
			tb_remove();
		};    
		return false;
	});
	/* upload manager video */
	$(document).on('click', 'input.upload-button-video', function() { 
		var upField = $(this).prev().prev();
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			var videourl = jQuery(html).attr('href');
			upField.val(videourl);
			tb_remove();
		};
		return false;
	});
	/* upload manager audio */
	$(document).on('click', 'input.upload-button-audio', function() { 
		var upField = $(this).prev().prev();
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			var audiourl = jQuery(html).attr('href');
			upField.val(audiourl);
			tb_remove();
		};
		return false;
	});
	/* upload manager image (post format) */
	$(document).on('click', 'input.upload-button-image', function() { 
		var upField = $(this).prev().prev(),
			altFiled = $('#lolfmkbox_p_image_alt'),
			wFiled = $('#lolfmkbox_p_image_w'),
			hFiled = $('#lolfmkbox_p_image_h');
		tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			var imgurl = jQuery('img',html).attr('src'),
				imgAlt =  jQuery('img',html).attr('alt'),
				imgw = jQuery('img',html).attr('width'),
				imgh = jQuery('img',html).attr('height');
			upField.val(imgurl);
			altFiled.val(imgAlt);
			wFiled.val(imgw);
			hFiled.val(imgh);
			tb_remove();
		};
		return false;
	});
});