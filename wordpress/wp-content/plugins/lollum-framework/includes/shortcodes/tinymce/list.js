(function() {
	"use strict";
	/* global tinymce, tb_show */
	tinymce.create('tinymce.plugins.lollum_list', {  
		init : function(ed, url) {  
			ed.addButton('lollum_list', {  
				title : 'Add List',  
				image : url + '/images/list.png',  
				onclick : function() {  
					ed.selection.setContent('[lollum_list]<br>[lollum_list_element]' + ed.selection.getContent() + '[/lollum_list_element]<br>[lollum_list_element][/lollum_list_element]<br>[/lollum_list]');
				}  
			});  
		},  
		createControl : function() {  
			return null;  
		}  
	});  
	tinymce.PluginManager.add('lollum_list', tinymce.plugins.lollum_list);  
})();