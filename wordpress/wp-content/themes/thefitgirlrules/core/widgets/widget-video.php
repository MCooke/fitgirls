<?php
/**
 * Lollum
 * 
 * Custom Video Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Video extends WP_Widget {
	
	function Lollum_Widget_Video() {

		$widget_ops = array(
			'classname' => 'lol_widget_video',
			'description' => __('Use this widget to display your video (Youtube and Vimeo) in your sidebar.', 'lollum')
		);
		$control_ops = array('id_base' => 'lol_widget_video');
		$this->WP_Widget('lol_widget_video', __('Custom Video Widget', 'lollum'), $widget_ops, $control_ops);
		
	}
		
	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$video_src = $instance['video_src'];

		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}

		$video_src = explode(" <p>", $video_src);

		?>
			
		<div class="video-widget">
			<?php echo $video_src[0]; ?>
		</div>
		
		<?php
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['video_src'] = stripslashes($new_instance['video_src']);
		return $instance;

	}

	function form($instance) {

		$defaults = array(
			'title' => 'Video Widget',
			'video_src' => '',
			'limit' => '4'
		);
		
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('video_src'); ?>"><?php _e('Embed code (Youtube or Vimeo):', 'lollum') ?></label>
			<textarea style="height: 150px;" class="widefat" id="<?php echo $this->get_field_id('video_src'); ?>" name="<?php echo $this->get_field_name('video_src'); ?>"><?php echo stripslashes(htmlspecialchars(($instance['video_src']), ENT_QUOTES)); ?></textarea>
		</p>
			
	<?php
	}
}

add_action('widgets_init', 'lol_dribbble_video');

function lol_dribbble_video() {
	register_widget('Lollum_Widget_Video');
}