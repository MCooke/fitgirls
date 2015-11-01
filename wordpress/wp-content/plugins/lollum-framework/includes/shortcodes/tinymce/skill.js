(function() {
	"use strict";
	/* global tinymce, tb_show */  
	tinymce.create('tinymce.plugins.lollum_skill', {  
		init : function(ed, url) {  
			ed.addButton('lollum_skill', {  
				title : 'Add Skill',  
				image : url + '/images/skill.png',  
				onclick : function() {  
					tb_show('Skill Shortcode', url + '/skill.php?&width=670&height=600');
				}  
			});
		},
		createControl : function() {
			return null;
		}
	});
	tinymce.PluginManager.add('lollum_skill', tinymce.plugins.lollum_skill);  
})();