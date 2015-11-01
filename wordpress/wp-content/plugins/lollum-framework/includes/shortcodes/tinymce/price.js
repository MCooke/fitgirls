(function() {
	"use strict";
	/* global tinymce, tb_show */
	tinymce.create('tinymce.plugins.lollum_price', {  
		init : function(ed, url) {  
			ed.addButton('lollum_price', {  
				title : 'Add Price Table',  
				image : url + '/images/price.png',  
				onclick : function() {  
					tb_show('Price Table Shortcode', url + '/price.php?&width=670&height=600');
				}  
			});  
		},  
		createControl : function() {  
			return null;  
		}  
	});  
	tinymce.PluginManager.add('lollum_price', tinymce.plugins.lollum_price);  
})();