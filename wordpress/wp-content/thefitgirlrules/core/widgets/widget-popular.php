<?php
/**
 * Lollum
 * 
 * Custom Popular Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Popular extends WP_Widget {

	function Lollum_Widget_Popular() {

		$widget_ops = array(
			'classname' => 'lol_widget_popular', 
			'description' => __('Use this widget to display your popular posts in your sidebar or footer.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_popular');
		$this->WP_Widget('lol_widget_popular', __('Custom Popular Widget', 'lollum'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$number = (isset($instance['number'])) ? $instance['number'] : 0;

		echo $before_widget;

		if ($title) { 
			echo $before_title . $title . $after_title; 
		}
		?>
			
		<ul>            

			<?php 
			$args = array(
				'posts_per_page' => $number,
				'orderby' => 'comment_count'
			);
			
			$pop_query = new WP_Query($args);

			while($pop_query->have_posts()) : $pop_query->the_post(); ?>

				<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'lollum'), get_the_title()); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			
		</ul>
	
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);

		return $instance;
	}

	function form($instance) {

		$defaults = array(
		'title' => 'Popular posts',
		'number' => 4
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>">
		</p>
	
	<?php
	}

}

add_action('widgets_init', 'lol_popular_widget');

function lol_popular_widget() {
	register_widget('Lollum_Widget_Popular');
}