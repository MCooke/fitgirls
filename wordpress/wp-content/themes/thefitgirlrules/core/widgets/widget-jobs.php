<?php
/**
 * Lollum
 * 
 * Custom Jobs Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Jobs extends WP_Widget {

	function Lollum_Widget_Jobs() {

		$widget_ops = array(
			'classname' => 'lol_widget_jobs', 
			'description' => __('Use this widget to display your recent jobs in your sidebar or footer.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_jobs');
		$this->WP_Widget('lol_widget_jobs', __('Custom Recent Jobs Widget', 'lollum'), $widget_ops, $control_ops);
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

		<div class="lol-jobs-widget"> 	           

		<?php 
		$args = array(
			'post_type' => 'lolfmk-job',
			'order' => 'DESC',
			'orderby ' => 'date',
			'posts_per_page' => $number
		);
		
		$job_query = new WP_Query($args);

		while($job_query->have_posts()) : $job_query->the_post();
		global $post;
		$job_location = get_post_meta($post->ID, 'lolfmkbox_job_location', true);
		?>

			<div class="entry-job">
				<div class="entry-meta">
					<a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark" class="job-title"><?php the_title(); ?></a>
					<span><?php echo $job_location; ?></span>
				</div>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

		</div>
	
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
		'title' => 'Recent Jobs',
		'number' => 3
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of jobs:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>">
		</p>
	
	<?php
	}

}

add_action('widgets_init', 'lol_jobs_widget');

function lol_jobs_widget() {
	register_widget('Lollum_Widget_Jobs');
}