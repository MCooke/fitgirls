(function() {
	"use strict";
	/* global tinymce, tb_show */
	tinymce.create('tinymce.plugins.lollum_button', {  
		init : function(ed, url) {  
			ed.addButton('lollum_button', {  
				title : 'Add Button',  
				image : url + '/images/button.png',  
				onclick : function() {  
					tb_show('Button Shortcode', url + '/button.php?&width=670&height=600');
				}  
			});  
		},  
		createControl : function() {  
			return null;  
		}  
	});  
	tinymce.PluginManager.add('lollum_button', tinymce.plugins.lollum_button);  
})();