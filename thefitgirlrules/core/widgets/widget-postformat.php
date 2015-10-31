<?php
/**
 * Lollum
 * 
 * Custom Post Format Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Postformat extends WP_Widget {

	function Lollum_Widget_Postformat() {

		$widget_ops = array(
			'classname' => 'lol_widget_postformat', 
			'description' => __('Use this widget to display your latest posts (by post format) in your sidebar.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_postformat');
		$this->WP_Widget('lol_widget_postformat', __('Custom Post Format Widget', 'lollum'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$number = (isset($instance['number'])) ? $instance['number'] : 0;
		$postformat = $instance['postformat'];

		echo $before_widget;

		if ($title) { 
			echo $before_title . $title . $after_title; 
		}
		?>
			
		<div class="postformat_widget">            
			<ul>
				<?php 

				$postformat_selected = strtolower($postformat);
				 
				$args = array(
					'posts_per_page' => $number,
					'tax_query' => array(
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array('post-format-' . $postformat_selected . '')
						)
					)
				);
								
				$postformat_query = new WP_Query($args);

				while($postformat_query->have_posts()) : $postformat_query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'lollum'), get_the_title()); ?>"><?php the_title(); ?></a></li>	
				<?php endwhile; ?>
				<?php wp_reset_postdata();

				?>
			</ul>
		</div>
	
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['postformat'] = $new_instance['postformat'];

		return $instance;
	}

	function form($instance) {

		$defaults = array(
		'title' => 'Post by Post Format',
		'number' => 4
		);

		$postformat = (isset($instance['postformat']) ? $instance['postformat'] : '');

		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('postformat'); ?>"><?php _e('Post Format to show:', 'lollum') ?></label>
			<select id="<?php echo $this->get_field_id('postformat'); ?>" class="widefat" name="<?php echo $this->get_field_name('postformat'); ?>">
				<option <?php if ('Audio' == $postformat) { echo 'selected="selected"'; } ?>>Audio</option>
				<option <?php if ('Gallery' == $postformat) { echo 'selected="selected"'; } ?>>Gallery</option>
				<option <?php if ('Status' == $postformat) { echo 'selected="selected"'; } ?>>Status</option>
				<option <?php if ('Video' == $postformat) { echo 'selected="selected"'; } ?>>Video</option>
			</select>
		</p>
	
	<?php
	}

}

add_action('widgets_init', 'lol_postformat_widget');

function lol_postformat_widget() {
	register_widget('Lollum_Widget_Postformat');
}