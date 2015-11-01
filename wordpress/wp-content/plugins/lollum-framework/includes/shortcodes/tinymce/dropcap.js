(function() {
	"use strict";
	/* global tinymce */
	tinymce.create('tinymce.plugins.lollum_dropcap', {  
		init : function(ed, url) {  
			ed.addButton('lollum_dropcap', {  
				title : 'Add Dropcap',  
				image : url + '/images/dropcap.png',  
				onclick : function() {  
					ed.selection.setContent('[lollum_dropcap]' + ed.selection.getContent() + '[/lollum_dropcap]');
				}  
			});  
		},  
		createControl : function() {  
			return null;  
		}  
	});  
	tinymce.PluginManager.add('lollum_dropcap', tinymce.plugins.lollum_dropcap);  
})();