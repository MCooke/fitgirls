(function ($) {
	"use strict";
	/* global mejs */
	// add mime-type aliases to MediaElement plugin support
	mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
	mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');

	$(function () {
		$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer({
			videoWidth: '100%',
			videoHeight: '100%',
			audioWidth: '100%',
			videoVolume: 'horizontal'
		});
	});

}(jQuery));