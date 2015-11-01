<?php
/**
 * Lollum
 * 
 * Custom Dribbble Widget (footer)
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Dribbble_Footer extends WP_Widget {
	
	function Lollum_Widget_Dribbble_Footer() {

		$widget_ops = array(
			'classname' => 'lol_widget_dribbble_footer',
			'description' => __('Use this widget to display your Dribbble shots in your footer.', 'lollum')
		);
		$control_ops = array('id_base' => 'lol_widget_dribbble_footer');
		$this->WP_Widget('lol_widget_dribbble_footer', __('Custom Dribbble Widget (Footer)', 'lollum'), $widget_ops, $control_ops);
		
	}
		
	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$dribbble_ID = $instance['dribbble_ID'];
		$limit = $instance['limit'];

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}

		?>
			
		<div class="footer-dribbble-widget">

			<script type="text/javascript">
				(function($){
					var $i = 1;
					$.getJSON("http://api.dribbble.com/players/<?php echo $dribbble_ID; ?>/shots?callback=?", function(data) {
						$.each(data.shots, function(index, shot) {
							if(index < <?php echo $limit; ?>) {
								$(".footer-dribbble-widget").append("<a class='dribbble-item-" + $i + "' href='" + shot.image_url + "'><img src='" + shot.image_teaser_url + "'></a>");
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
		$instance['dribbble_ID'] = strip_tags($new_instance['dribbble_ID']);
		$instance['limit'] = $new_instance['limit'];
		return $instance;

	}

	function form($instance) {

		$defaults = array(
			'title' => 'Dribbble Widget',
			'dribbble_ID' => '',
			'limit' => '8'
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('dribbble_ID'); ?>"><?php _e('Dribbble Username:', 'lollum') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('dribbble_ID'); ?>" name="<?php echo $this->get_field_name('dribbble_ID'); ?>" value="<?php echo $instance['dribbble_ID']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of Shots:', 'lollum') ?></label>
			<select id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" class="widefat">
				<option <?php if ('4' == $instance['limit']) { echo 'selected="selected"'; } ?>>4</option>
				<option <?php if ('8' == $instance['limit']) { echo 'selected="selected"'; } ?>>8</option>
				<option <?php if ('12' == $instance['limit']) { echo 'selected="selected"'; } ?>>12</option>
			</select>
		</p>
			
	<?php
	}
}

add_action('widgets_init', 'lol_dribbble_widget_footer');

function lol_dribbble_widget_footer() {
	register_widget('Lollum_Widget_Dribbble_Footer');
}