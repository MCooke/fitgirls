jQuery(document).ready(function(){ 
"use strict";
/*global jQuery */
var addItem = jQuery('input#add-page-item-btn'),
	listItems = jQuery('#page-select-element-list'),
	pageItemListDefault = jQuery('#page-item-list-default'),
	sectionItemsSelected = jQuery('#section-items-selected-inner'),
	pageItemInner = jQuery('.page-item-inner'),
	editItem = jQuery('.edit-item'),
	publish = jQuery('#publish'),
	itemColpkr = sectionItemsSelected.find('.input-color'),
	openEdit = pageItemInner.find('.edit-item-btn'),
	closeEdit = editItem.find('.edit-item-close-btn'),
	deleteItem = pageItemInner.find('.delete-item'),
	addSize = pageItemInner.find('.btn-plus'),
	subSize = pageItemInner.find('.btn-minus'),
	cloneItem = pageItemInner.find('.btn-clone'),
	addSubItem = editItem.find('input.add-clone-item'),
	itemSize = [
	['item-1-4','1-4'],
	['item-1-3', '1-3'],
	['item-1-2', '1-2'],
	['item-2-3', '2-3'],
	['item-3-4', '3-4'],
	['item-1-1', '1-1']];

addItem.on('click', function(){
	var item_cloned = pageItemListDefault.find('div[data-item="' + listItems.val() + '"]').clone(true);
	if (item_cloned) {
		sectionItemsSelected.append(item_cloned);
	}
	// minicolors
	jQuery('.input-color').minicolors();
});

// minicolors
itemColpkr.minicolors();

// clone item
cloneItem.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item'),
		item_cloned = item_clicked.clone(true),
		next_item = item_clicked.next(),
		originalTextareas = item_clicked.find('textarea'),
		originalTextareasVal = [];

	if (originalTextareas.length) {
		originalTextareas.each(function(index) {
			originalTextareasVal.push(originalTextareas.eq(index).val());
		});
		var clonedTextareas = item_cloned.find('textarea');

		clonedTextareas.each(function(index) {
			clonedTextareas.eq(index).val(originalTextareasVal[index]);
		});
	}

	if (next_item.length) {
		next_item.before(item_cloned);
	} else {
		sectionItemsSelected.append(item_cloned);
	}
	// minicolors
	jQuery('.input-color').minicolors('destroy');
	jQuery('.input-color').minicolors();
});

// add detail
addSubItem.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item'),
		listSubItems = item_clicked.find('.list-cloned-items'),
		subItemCloned = item_clicked.find('.default-cloned-item').html();

	listSubItems.append(subItemCloned);
	
});

// delete detail
jQuery(document).on('click', '.delete-cloned-item', function(){
	jQuery(this).parent().fadeOut(function(){
		jQuery(this).remove();
	});
});

// build xml
function populate_xml(items, item) {
	var xmlValue = '';
	items.each(function(index) {
		if (index > 0) {
			var itemsInputs = jQuery(this).find('.xml');
			xmlValue += '<'+item+'>';
			itemsInputs.each(function() {
				var itemTag = jQuery(this).attr('data-type'),
					itemValue = jQuery(this).val(),
					itemxml = '';
				if (jQuery(this).hasClass('open-group')) {
					xmlValue += '<child-group>';
				} else if (jQuery(this).hasClass('close-group')) {
					xmlValue += '</child-group>';
				} else if (jQuery(this).hasClass('open-tab')) {
					xmlValue += '<tab>';
				} else if (jQuery(this).hasClass('close-tab')) {
					xmlValue += '</tab>';
				} else if (jQuery(this).is(':checkbox')) {
					if (jQuery(this).is(':checked')) {
						itemxml = tag_xml(itemTag, 'on');
					} else {
						itemxml = tag_xml(itemTag, 'off');
					}
					xmlValue += itemxml;
				} else {
					if (jQuery(this).hasClass('esc')) {
						itemxml = tag_xml_esc(itemTag, itemValue);
					} else {
						itemxml = tag_xml(itemTag, itemValue);
					}
					xmlValue += itemxml;
				}
			});
			xmlValue += '</'+item+'>';
			jQuery(this).find('.item-xml').val(xmlValue);
			xmlValue = '';
		}
	});
}

// build tag xml
function tag_xml(type, value) {
	return '<'+type+'>'+value+'</'+type+'>';
}

// build tag xml escape
function tag_xml_esc(type, value) {
	return '<'+type+'><![CDATA['+value+']]></'+type+'>';
}

// open edit section
openEdit.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item'),
		docHeight = jQuery(document).height();
	jQuery("body").append("<div id='overlay'></div>");
	jQuery("#overlay")
		.height(docHeight)
		.css({
			'opacity' : 0.4,
			'position': 'fixed',
			'top': 0,
			'left': 0,
			'background-color': 'black',
			'width': '100%',
			'z-index': 10,
			'-ms-filter' : 'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)',
			'filter': 'alpha(opacity=50)'
	});
	item_clicked.children('.edit-item').fadeIn();
});

// close edit section
closeEdit.on('click', function(){
	var item_clicked = jQuery(this).parents('.edit-item');
	item_clicked.fadeOut(function(){
		jQuery('#overlay').remove();
	});
});

// delete item
deleteItem.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item');
	if (confirm('Are you sure you want to remove this block?')) {
		item_clicked.fadeOut(function(){
			jQuery(this).remove();
		});
	}
});

// add size
addSize.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item'),
		scalable = false,
		current_size = '';
	for (var i=0; i<itemSize.length-1; i++) {
		if(item_clicked.hasClass(itemSize[i][0])){
			scalable = true;
			current_size = itemSize[i][0];
		}
		if(scalable) {
			if( i < itemSize.length-2){
				item_clicked.removeClass(current_size).addClass(itemSize[i+1][0]);
				item_clicked.find('input.item-size').val(itemSize[i+1][1]);
			} else if( i === itemSize.length-2){
				item_clicked.removeClass(current_size).addClass(itemSize[i+1][0]);
				item_clicked.find('input.item-size').val(itemSize[i+1][1]);
			}
			break;
		}
	}
});

// sub size
subSize.on('click', function(){
	var item_clicked = jQuery(this).parents('.page-item'),
		scalable = false,
		current_size = '';
	for (var i = itemSize.length-1; i > 0; i--) {
		if(item_clicked.hasClass(itemSize[i][0])){
			scalable = true;
			current_size = itemSize[i][0];
		}
		if(scalable) {
			if( i > 1 ){
				item_clicked.removeClass(current_size).addClass(itemSize[i-1][0]);
				item_clicked.find('input.item-size').val(itemSize[i-1][1]);
			} else if( i === 1){
				item_clicked.removeClass(current_size).addClass(itemSize[i-1][0]);
				item_clicked.find('input.item-size').val(itemSize[i-1][1]);
			}
			break;
		}
	}
});

// sortable items
sectionItemsSelected.sortable({ handle: ".handle", forcePlaceholderSize: true, placeholder: 'place-item' });
// sectionItemsSelected.disableSelection();

// save xml items
publish.on('click', function(){
	var itemsCollection = jQuery('.page-item');
	itemsCollection.each(function() {
		var itemClass = jQuery(this).attr('data-type'),
			typeCollection = jQuery('.'+itemClass),
			itemType = jQuery(this).attr('data-item');
		populate_xml(typeCollection, itemType);
	});
	var checkJS = jQuery('#check-js');
	checkJS.val('js');
});

});