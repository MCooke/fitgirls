<?php
/**
 * Lollum
 * 
 * Custom Flickr Widget (footer)
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Flickr_Footer extends WP_Widget {
	
	function Lollum_Widget_Flickr_Footer() {

		$widget_ops = array(
			'classname' => 'lol_widget_flickr_footer',
			'description' => __('Use this widget to display your Flickr photos in your footer.', 'lollum')
		);
		$control_ops = array('id_base' => 'lol_widget_flickr_footer');
		$this->WP_Widget('lol_widget_flickr_footer', __('Custom Flickr Widget (Footer)', 'lollum'), $widget_ops, $control_ops);
		
	}
		
	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$flickr_ID = $instance['flickr_ID'];
		$limit = $instance['limit'];

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}

		?>
			
		<div class="footer-flickr-widget">

			<script type="text/javascript">

			(function($){

				var id = '<?php echo $flickr_ID; ?>';
				var limit = '<?php echo $limit; ?>';
				var $i = 1;

				$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + id + "&lang=en-us&format=json&jsoncallback=?",

				function(data){$.each(data.items,
					function(i,item) {
						if(i < limit) {
							$(".footer-flickr-widget").append("<a class='flickr-item-" + $i + "' href='" + item.media.m + "' title='" +  item.title +"'><img src='" + item.media.m + "'></a>");
							$i++;
						}
					});
				});

			})(jQuery);
			</script>
			
		</div>
		
		<?php
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_ID'] = strip_tags($new_instance['flickr_ID']);
		$instance['limit'] = $new_instance['limit'];
		return $instance;

	}

	function form($instance) {

		$defaults = array(
			'title' => 'Flickr Widget',
			'flickr_ID' => '',
			'limit' => '8'
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('flickr_ID'); ?>"><?php _e('Flickr ID:', 'lollum') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('flickr_ID'); ?>" name="<?php echo $this->get_field_name('flickr_ID'); ?>" value="<?php echo $instance['flickr_ID']; ?>">
			<small>Don't know your ID? Head on over to <a href="http://idgettr.com">idgettr</a> to find it.</small>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of Photos:', 'lollum') ?></label>
			<select id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" class="widefat">
				<option <?php if ('4' == $instance['limit']) { echo 'selected="selected"'; } ?>>4</option>
				<option <?php if ('8' == $instance['limit']) { echo 'selected="selected"'; } ?>>8</option>
				<option <?php if ('12' == $instance['limit']) { echo 'selected="selected"'; } ?>>12</option>
			</select>
		</p>
			
	<?php
	}
}

add_action('widgets_init', 'lol_flickr_widget_footer');

function lol_flickr_widget_footer() {
	register_widget('Lollum_Widget_Flickr_Footer');
}