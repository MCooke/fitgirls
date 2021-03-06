/***********************************************
 * UberMenu Administrative JavaScript
 * 
 * @author Chris Mavricos, Sevenspark http://sevenspark.com
 * @version 2.3.1.2
 * Last modified 2013-08-05
 * 
 ***********************************************/

jQuery(document).ready(function($){

	var DEBUG = false;

	//$megaInputs = $( '.wpmega-custom :input' ); 
	var mega_inputs_selector = '.wpmega-custom input, .wpmega-custom textarea, .wpmega-custom select';
	$megaInputs = $( mega_inputs_selector );
	//$megaInputs.each( function(){
	//	$( this ).attr( 'data-name' , $( this ).attr( 'name' ) ).removeAttr( 'name' );
	//});
	function processMegaAtts(){
		$( '.wpmega-atts.wpmega-unprocessed' ).each( function(){
			$( this ).removeClass( 'wpmega-unprocessed' );
			var $inputs = $( this ).find( ':input:not( .uber_options_input )' );
			$inputs.each( function(){
				var name = $( this ).attr( 'name' );
				name = name.substring( 0 , name.indexOf( '[' ) );
				$( this ).attr( 'data-name' , name ).attr( 'name' , name ); //.removeAttr( 'name' );
			});
			var options = $inputs.serialize();
			$( this ).find( '.uber_options_input' ).val( options );
			$inputs.removeAttr( 'name' );
		});
	}
	processMegaAtts();
	
	var $menu_management = $( '#menu-management' );
	$menu_management.on( 'change' , mega_inputs_selector , function(){		//$megaInputs.live( 'change' , function(){
		var $attGroup = $( this ).parents( '.wpmega-atts' );
		var $inputs = $attGroup.find( ':input:not( .uber_options_input )' );
		$inputs.each( function(){
			$( this ).attr( 'name' , $( this ).attr( 'data-name' ) );
		});
		var options = $inputs.serialize();
		//console.log( options );
		$attGroup.find( '.uber_options_input' ).val( options );
		$inputs.removeAttr( 'name' );
	});

	
	/* MENU ITEMS */
	/** Menu Panel Add New Item Override **/
	/* This overrides the normal addItemToMenu Function, in order to call a different callback which invokes the custom walker */
	if(typeof wpNavMenu != 'undefined'){
		wpNavMenu.addItemToMenu = function(menuItem, processMethod, callback) {
			var menu = $('#menu').val(),
			nonce = $('#menu-settings-column-nonce').val();
		
			processMethod = processMethod || function(){};
			callback = callback || function(){};
		
			params = {
				//'action': 'add-menu-item',
				'action': 'wpmega-add-menu-item',
				'menu': menu,
				'menu-settings-column-nonce': nonce,
				'menu-item': menuItem
			};

			$.post( ajaxurl, params, function(menuMarkup) {
				var ins = $('#menu-instructions');
				processMethod(menuMarkup, params);
				// Make it stand out a bit more visually, by adding a fadeIn
				$( 'li.pending' ).hide().fadeIn('slow');
				$( '.drag-instructions' ).show();
				if( ! ins.hasClass( 'menu-instructions-inactive' ) && ins.siblings().length )
					ins.addClass( 'menu-instructions-inactive' );
				callback();
				processMegaAtts();
			});
		};
	}

	/** Menu Panel Mega Options **/
	$('.wpmega-atts').hide();
	$menu_management.on( 'click' , '.wpmega-showhide-menu-ops' , function(){ //$('.wpmega-showhide-menu-ops').live('click', function(e){
		$(this).siblings('.wpmega-atts').slideToggle();
		return false;
	});

	/** Menu Panel Choosing Images **/
	/*var megaMenuAdminItemID = 0;
	$menu_management.on( 'click' , '.set-menu-item-thumb', function(){ //$('.set-menu-item-thumb').click(function(){
		megaMenuAdminItemID = $(this).attr('id');
	});*/

	// Uploading files
	var uber_media_frame;
	var $menu_item_button;
	var um_item_id;

	$('.menu').on( 'click', '.set-menu-item-thumb' , function( e ){
	 
		e.preventDefault();
		$menu_item_button = $(this);
		um_item_id = $menu_item_button.data( 'menu-item-id' );
	 
		// If the media frame already exists, reopen it.
		if( uber_media_frame ) {
			//uber_media_frame.uploader.uploader.param( 'um_item_id', um_item_id );
			uber_media_frame.open();
			return;
		}
	 
		// Create the media frame.
		uber_media_frame = wp.media.frames.uber_media_frame = wp.media({
			className: 'ubermenu-media-frame media-frame',
			library: {
				type: 'image'
			},
			title: $( this ).data( 'uploader_title' ),
			button: {
				text: $( this ).data( 'uploader_button_text' ),
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});
	 
		// When an image is selected, run a callback.
		uber_media_frame.on( 'select', function() {
		
			// We set multiple to false so only get one image from the uploader
			attachment = uber_media_frame.state().get('selection').first().toJSON();

			// Do something with attachment.id and/or attachment.url here
			$menu_item_button.html( '<img src="'+attachment.url + '" />' );

			$.ajax({
				type:	'POST',
				cache:	false,
				url:	ajaxurl,
				data:	{
					"action" : "ubermenu_getMenuImage",
					"menu_item_id" : um_item_id,
					"thumbnail_id" : attachment.id
				},
				error:	function(req, status, errorThrown){
					if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
				},
				success: function(data, status, req){
					//console.log( 'we\'re back!' , data );
					//$menu_item_button.removeClass('wpmega-loading-img');
					if( data == '' || data.image == '' ){
						$menu_item_button.html( 'Set Thumbnail' );
					}
					else{
						$menu_item_button.html( data.image );
						$('a#remove-post-thumbnail-'+data.id).remove();
						
						$menu_item_button.after(
								'<div class="remove-item-thumb" id="remove-item-thumb-'+data.id+'">'+
									'<a href="#" id="remove-post-thumbnail-'+data.id+'" '+
										'onclick="wpmega_remove_thumb(\''+ data.remove_nonce +'\', '+	data.id+'); return false; ">'+
										'Remove image</a></div>');
						
					}
				}
			});
			
		});

		// Finally, open the modal
		uber_media_frame.open();
	});


	/*

	$( 'body' ).on( 'unload' , '#TB_window' , function (){ //$( '#TB_window').live("unload", function(){

		var $item = $('#'+megaMenuAdminItemID);
		$item.addClass('wpmega-loading-img');

		$.ajax({
			type:	'POST',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "ubermenu_getMenuImage",	"id" : megaMenuAdminItemID },
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				$item.removeClass('wpmega-loading-img');
				if(data == '' || data.image == ''){
					$item.text('Set Thumbnail');
				}
				else{
					$item.html(data.image);
					$('a#remove-post-thumbnail-'+data.id).remove();
					$item.after(
							'<div class="remove-item-thumb" id="remove-item-thumb-'+data.id+'">'+
								'<a href="#" id="remove-post-thumbnail-'+data.id+'" '+
									'onclick="wpmega_remove_thumb(\''+ data.remove_nonce +'\', '+	data.id+'); return false; ">'+
									'Remove image</a></div>');
				}
			}
		});
	});

	*/


	/** For Menus Panel - setup Navigation Locations **/
	$('#wp-mega-menu-navlocs-submit').click(function(){
		var $waiting = $(this).parent().find('.waiting');
		$waiting.fadeIn();
		
		var data = new Array();
		$('#nav-menu-theme-megamenus input[name="wp-mega-menu-nav-loc"]').each(function(){
			if($(this).is(':checked')) data.push($(this).val());
		});
		data = data.join(',');
		
		$.ajax({
			type:	'POST',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "megaMenu_updateNavLocs",	"data" : data },
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				$waiting.fadeOut();
			}
		});		
		return false;
	});
	
	
	
	
	
	
	
	/** Setup Color Pickers **/	
	$( '.wp-colorpicker-uber' ).wpColorPicker();

	/*
	$('input[type="text"].colorPicker-color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
			$(el).css({ 'background-color' : '#'+hex} );
			
			color = $(el).val();
			if(color == '') color = '#ffffff';
			else $(el).css('background-color', '#'+color);
			$(el).attr('title', color);
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		}
	})
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	
	//Set initial Color
	$('input[type="text"].colorPicker-color').each(function(){
		var color = $(this).val();
		if(color != '')
			$(this).css( { "background-color" : "#"+color });
		$(this).attr('title', "#"+color);
		
		$(this).change(function(){
			
			var color = $(this).val();
			
			if(color == '')
				$(this).css('background-color', '#ffffff');
			else{
				if(color.indexOf('#') != 0) $(this).val(color.substring(1));
				$(this).css('background-color', '#'+$(this).val());
			}
		});
		
	});
	
	
	$('.clearColor').click( function(){
		$(this).parent('.container-type-color').find('.colorPicker-color').css('background-color', '').val('');
	});
	*/


	
	$('#ubermenu-style-viewer-button').click( function(){
		$('#ubermenu-style-viewer').toggle('normal');
		return false;
	});
	
	//Preview
	$('#ubermenu-preview-button').click(function(e){
		
		e.preventDefault();
		
		var data = $('#spark-options').serialize();
		
		
		
		var $preview = $('#ubermenu-style-preview');
		//var $style = $('#wpmega-style-css');
		$preview.addClass('ubermenu-loading').html('');
		$preview.slideDown();
		//$style.hide();
					
		$.ajax({
			type:	'POST',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "ubermenu_getPreview",	"data" : data }, 
			dataType: 'json',
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				
				//remove any previous <style>
				//$('#wpmega-preview-css').remove();
				
				//add styles
				if(data.style == ''){
					var link = data.link;
					
					if(link != ''){
						var $existing = $('#ubermenu-style-link');
						if($existing.size() == 0){
							$('head').append(link);
						}
						else{
							$existing.replaceWith(link);
						}
					}
				}	
				else{
					var style = '<style id="ubermenu-preview-css" type="text/css">'+data.style+'</style>';
					var $existing = $('#ubermenu-preview-css');
					if( $existing.size() > 0 ){
						$existing.remove();
					}
					$('head').append(style);
					//else{
					//	//$existing.replaceWith(style);
					//}
				}
				
				//show preview
				$preview.removeClass('ubermenu-loading').html(data.content);
				$preview.find('.spark-preview-close').click( function(){
					$preview.slideUp();
					return false;
				});
				
				$('#ubermenu-style-viewer textarea').html(data.style);

				
				var $menu = $u( '#megaMenu' );
				if( $menu.size() == 0 ) return;
				
				$menu.uberMenu( uberMenuSettings );
				var $um = $menu.data( 'uberMenu' );
			}
		});		
		return false;
	});
	
	
	
	//For WordPress 3.3
	var menuItemID = 0;
	WPSetThumbnailID = function(id){
		menuItemID = id;
		var field = jQuery('input[value="_thumbnail_id"]', '#list-table');
		if ( field.size() > 0 ) {
			jQuery('#meta\\[' + field.attr('id').match(/[0-9]+/) + '\\]\\[value\\]').text(id);
		}
	};
	
	
	//For WordPress 3.3
	WPSetThumbnailHTML = function(html){
		
		var $item = $('#'+megaMenuAdminItemID);
		$item.addClass('wpmega-loading-img');
		
		$.ajax({
			type:	'POST',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "ubermenu_getMenuImage",	"id" : megaMenuAdminItemID },
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				$item.removeClass('wpmega-loading-img');
				if(data == '' || data.image == ''){
					$item.text('Set Thumbnail');
				}
				else{
					$item.html(data.image);
					$('a#remove-post-thumbnail-'+data.id).remove();
					$item.after(
							'<div class="remove-item-thumb" id="remove-item-thumb-'+data.id+'">'+
								'<a href="#" id="remove-post-thumbnail-'+data.id+'" '+
									'onclick="wpmega_remove_thumb(\''+ data.remove_nonce +'\', '+	data.id+'); return false; ">'+
									'Remove image</a></div>');
				}
			}
		});
	};
	
	//For WordPress 3.3
	WPRemoveThumbnail = function(nonce){};
	
	//For WordPress 3.2
	WPSetAsThumbnail = function(a,b){}
	
	
	/* THANKS BOX */
	$('#ubermenu-thanks-cleared').click(function(){
		$.ajax({
			type:	'GET',
			cache:	false,
			url:	ajaxurl,
			data:	{ "action" : "ubermenu_showThanksCleared",	"cleared" : 'yup' },
			error:	function(req, status, errorThrown){
				if(DEBUG) console.log('Error: '+status+' | '+errorThrown);
			},
			success: function(data, status, req){
				$('.ubermenu-thanks').slideUp(function(){
					$(this).html(data.response).slideDown(function(){
						$thanks = $(this);
						$button = $('<span style="font-size:12px; margin:0px 0px 0px 20px; padding:5px;" class="button">Dismiss</span>');
						$button.click(function(){
							$thanks.slideUp();
						});
						$(this).append($button);
					});
				});
			}
		});
		return false;
	});
	
	$( '.appearance_page_uber-menu .updated, .appearance_page_uber-menu .error' ).prependTo('.wrap');
		
});

function wpmega_remove_thumb(nonce, id){
	jQuery.post(ajaxurl, {
		action:"set-post-thumbnail", post_id: id, thumbnail_id: -1, _ajax_nonce: nonce, cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( setPostThumbnailL10n.error );
		} else {
			if(str != '-1'){
				jQuery('a#set-post-thumbnail-'+id).html('Set Thumbnail');
				jQuery('a#remove-post-thumbnail-'+id).remove();
			}
		}
	});
};


