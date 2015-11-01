(function($) {
	$(document).ready(function() {
		"use strict";
		/* global jQuery */
		var rebuildTimeout = false;
		function showHideCheckboxes() {
			var megaCheck = $('.edit-menu-item-mega'),
				megaCheckP = $('.edit-menu-item-mega').parents('li'),
				descCheck = $('.edit-menu-item-section_desc'),
				linkCheck = $('.edit-menu-item-section_link');
			
			$('.edit-menu-item-mega').parents('.description').show();
			megaCheckP.not('.menu-item-depth-0').find('.edit-menu-item-mega').parents('.description').hide();
			descCheck.parents('.description').hide();
			linkCheck.parents('.description').hide();

			megaCheck.each(function() {
				var item = $(this);
				if (item.is(':checked')) {
					item.parents('li').addClass('megamenu-active');
					item.parents('li').nextUntil('.menu-item-depth-0').filter('.menu-item-depth-1').find(descCheck).parents('.description').show();
					item.parents('li').nextUntil('.menu-item-depth-0').filter('.menu-item-depth-1').find(linkCheck).parents('.description').show();
				} else {
					item.parents('li').removeClass('megamenu-active');
				}
			});
		}
		showHideCheckboxes();
		$(document).on('mouseup', '.menu-item-bar', function() {
			clearTimeout(rebuildTimeout);
			rebuildTimeout = setTimeout(showHideCheckboxes, 500);
		});
		$(document).on('click', '.edit-menu-item-mega', function() {
			clearTimeout(rebuildTimeout);
			rebuildTimeout = setTimeout(showHideCheckboxes, 500);
		});
	});
})(jQuery);