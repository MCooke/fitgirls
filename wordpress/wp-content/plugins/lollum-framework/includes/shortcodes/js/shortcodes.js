(function($) {

"use strict";
/*global jQuery */

var LOLLUM_SHORTCODES = {};
/*-----------------------------------------------------------------------------------*/
/*	Animations
/*-----------------------------------------------------------------------------------*/
LOLLUM_SHORTCODES.animations = function() {
	function elementViewed(element) {
		var elem = element,
			window_top = $(window).scrollTop(),
			offset = $(elem).offset(),
			top = offset.top;
		if ($(elem).length > 0) {
			if (top + $(elem).height() >= window_top &&
				top <= window_top + $(window).height()) {
				return true;
			} else {
				return false;
			}
		}
	}
	function skillAnimation(skill) {		
		$(skill).each(function() {
			var currentSkill = $(this);
			var w = currentSkill.data("skill");
			currentSkill.animate({width: w + "%"}, function() {
				currentSkill.addClass('lol-animated');
			});
		});
	}
	function onScrollInterval() {
		var didScroll = false;
		$(window).scroll(function () {
			didScroll = true;
		});
		setInterval(function () {
			if (didScroll) {
				didScroll = false;
				$('.lol-skill .lol-bar').each(function() {
					var currentSkill = $(this);
					if (elementViewed(currentSkill) && !$(this).hasClass('lol-animated')) {
						skillAnimation(currentSkill);
					}
				});
			}
		}, 250);
	}
	onScrollInterval();
};
/*-----------------------------------------------------------------------------------*/
/*	Init Functions
/*-----------------------------------------------------------------------------------*/
$(document).ready(function() {
	LOLLUM_SHORTCODES.animations();
});
})(jQuery);