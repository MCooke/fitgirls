<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
if (!function_exists('lol_admin_js')) {
	function lol_admin_js() {
	?>
	  
		<script type="text/javascript">
		jQuery(document).ready(function(){
			"use strict";
			// admin group-options
			jQuery('.options-group').hide();
			jQuery('.options-group:first').fadeIn();

			jQuery('#lol-admin-nav li:first').addClass('current');
			jQuery('#lol-admin-nav li a').click(function(e){
			
				jQuery('#lol-admin-nav li').removeClass('current');
				jQuery(this).parent().addClass('current');
				
				var group_section = jQuery(this).attr('href');

				jQuery('.options-group').hide();
				
				jQuery(group_section).fadeIn();

				e.preventDefault();
				
			});

			// radio-images
			jQuery('.lol-radio-img-img').click(function(){
				jQuery(this).parent().parent().find('.lol-radio-img-img').removeClass('lol-radio-img-selected');
				jQuery(this).addClass('lol-radio-img-selected');
				
			});
			jQuery('.lol-radio-img-label').hide();
			jQuery('.lol-radio-img-img').show();
			jQuery('.lol-radio-img-radio').hide();

			<?php $options = get_option('lol_template');
			
			foreach ($options as $option) {

				// case: section-select
				if ($option['type'] == 'section-select') {

					$option_selected = $option['std'];
					$option_select = $option['id']; 
					$option_value = get_option($option_select);
					?>

					var selected = '<?php if ($option_value != "") { echo stripslashes($option_value); } else { echo stripslashes($option_selected); } ?>';
					selected = selected.replace(" ","_").toLowerCase();

					jQuery('.wrap-section.<?php echo stripslashes($option_select); ?>').css('display', 'none');
					jQuery('#wrap-section_' + selected).css('display', 'block');

					var select = jQuery('#<?php echo stripslashes($option_select); ?>');
					select.change(function() {
						var value = jQuery(this).val();
						value = value.replace(" ","_").toLowerCase();
						var sectionSelected = jQuery('#wrap-section_' + value);
						jQuery('.wrap-section.<?php echo stripslashes($option_select); ?>').fadeOut("fast");
						jQuery(sectionSelected).fadeIn("slow");
					});

				<?php }

				// case: image-preview
				elseif ($option['type'] == 'image-preview') {

					$option_selected = $option['std'];
					$option_select = $option['id']; 
					$option_value = get_option($option_select);

					?>

					var selected = '<?php if ($option_value != "") { echo $option_value; } else { echo $option_selected; } ?>';
					selected = selected.replace(/ /g,"_").toLowerCase();

					var img_select = jQuery('#<?php echo $option_select; ?>');

					var myurl = '<?php echo LOLLUMCORE_URI; ?>';

					jQuery('.lol-img-preview').css('background', 'url(<?php echo LOLLUMCORE_URI; ?>admin/images/backgrounds/'+selected+'.png)');

					img_select.change(function() {
						var value = jQuery(this).val();
						value = value.replace(/ /g,"_").toLowerCase();
						jQuery('.lol-img-preview').css('background', 'url(<?php echo LOLLUMCORE_URI; ?>admin/images/backgrounds/'+value+'.png)');
					});

				<?php }

				// case: color-picker
				elseif ($option['type'] == 'color') {
					$option_selected = $option['std'];
					$option_id = $option['id'];
					if (get_option($option_id) != '') {
						$color = get_option($option_id);
					} else {
						$color = $option_selected;
					}
					?>

					jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '<?php echo $color; ?>');    
					jQuery('#<?php echo $option_id; ?>_picker').ColorPicker({
						color: '<?php echo $color; ?>',
						onShow: function (colpkr) {
							jQuery(colpkr).fadeIn(500);
							return false;
						},
						onHide: function (colpkr) {
							jQuery(colpkr).fadeOut(500);
							return false;
						},
						onChange: function (hsb, hex) {
							jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', '#' + hex);
							jQuery('#<?php echo $option_id; ?>_picker').next('input').attr('value','#' + hex);
						}
					});

					jQuery('#<?php echo $option_id; ?>_picker').next('input').change(function(){
						jQuery('#<?php echo $option_id; ?>_picker').children('div').css('backgroundColor', jQuery(this).val());
					});

				<?php }
				
			} 
			?>

			// file upload button
			jQuery('.image_upload_button').each(function(){
				/* global AjaxUpload */
				/*jshint unused: vars */
				var clickedObject = jQuery(this);
				var clickedID = jQuery(this).attr('id');
				var interval;	
				new AjaxUpload(clickedID, {
					action: '<?php echo admin_url("admin-ajax.php"); ?>',
					name: clickedID,
					data: {
						action: 'lol_ajax_post_action',
						type: 'upload',
						data: clickedID },
					autoSubmit: true,
					responseType: false,
					onChange: function(file, extension){},
					onSubmit: function(file, extension){
						clickedObject.text('Uploading');
						this.disable();
						interval = window.setInterval(function(){
							var text = clickedObject.text();
							if (text.length < 13) {	
								clickedObject.text(text + '.'); 
							}
							else { 
								clickedObject.text('Uploading'); 
							} 
						}, 200);
					},
					onComplete: function(file, response) {

						window.clearInterval(interval);
						clickedObject.text('Upload Image');	
						this.enable();
						var buildReturn;
						
						if (response.search('Upload Error') > -1) {
							buildReturn = '<span class="upload-error">' + response + '</span>';
							jQuery(".upload-error").remove();
							clickedObject.parent().after(buildReturn);
						
						} else {
							buildReturn = '<img class="hide lol-option-image" id="image_' + clickedID + '" src="' + response + '" alt="">';
							jQuery(".upload-error").remove();
							jQuery("#image_" + clickedID).remove();	
							clickedObject.parent().after(buildReturn);
							jQuery('img#image_'+clickedID).fadeIn();
							clickedObject.next('span').fadeIn();
							clickedObject.parent().prev('input').val(response);
						}
					}
				});
			
			});
			
			// file remove button
			jQuery('.image_reset_button').click(function(){
				/*jshint unused: vars */

				var clickedObject = jQuery(this);
				// var clickedID = jQuery(this).attr('id');
				var theID = jQuery(this).attr('title');	

				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			
				var data = {
					action: 'lol_ajax_post_action',
					type: 'image_reset',
					data: theID
				};
				
				jQuery.post(ajax_url, data, function(response) {
					var image_to_remove = jQuery('#image_' + theID);
					var button_to_hide = jQuery('#reset_' + theID);
					image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
					button_to_hide.fadeOut();
					clickedObject.parent().prev('input').val('');			
				});
				
				return false; 
					
			});
			
			// AJAX save
			jQuery('#lol-admin-form').submit(function(){
				/*jshint unused: vars */
				function newValues() {
					var serializedValues = jQuery("#lol-admin-form").serialize();
					return serializedValues;
				}
				jQuery(":checkbox, :radio").click(newValues);
				jQuery("select").change(newValues);
				var serializedReturn = newValues();
				var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
				var data = {
					<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'lollumframework'){ ?>
					type: 'options',
					<?php } ?>
					action: 'lol_ajax_post_action',
					data: serializedReturn
				};
				
				jQuery.post(ajax_url, data, function(response) {
					var success = jQuery('#lol-message-save');
					success.fadeIn();
					window.setTimeout(function(){
						success.fadeOut();
					}, 2000);
				});
				
				return false; 
				
			});

			// messageLollum
			if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' === 'true') {
				
				var reset_popup = jQuery('#lol-message-reset');
				reset_popup.fadeIn();
				window.setTimeout(function(){
						reset_popup.fadeOut();
					}, 2000);
			}
					
			jQuery.fn.messageLollum = function(){
				this.css({"top":(jQuery(window).height() - this.height() - 200) / 2+jQuery(window).scrollTop() + "px"});
				this.css("left", 315);
				return this;
			};
			
			jQuery('#lol-message-save').messageLollum();
			jQuery('#lol-message-reset').messageLollum();
			
			jQuery(window).scroll(function(){ 
			
				jQuery('#lol-message-save').messageLollum();
				jQuery('#lol-message-reset').messageLollum();
			
			});

		});
		</script>

	<?php
	}
}