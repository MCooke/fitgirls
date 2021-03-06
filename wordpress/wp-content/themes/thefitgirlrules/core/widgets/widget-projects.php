<?php
/**
 * Lollum
 * 
 * Custom Recent Projects Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Projects extends WP_Widget {

	function Lollum_Widget_Projects() {

		$widget_ops = array(
			'classname' => 'lol_widget_projects', 
			'description' => __('Use this widget to display your recent projects in your sidebar or footer.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_projects');
		$this->WP_Widget('lol_widget_projects', __('Custom Recent Projects Widget', 'lollum'), $widget_ops, $control_ops);
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

		<div class="lol-projects-widget"> 	           

		<?php 
		$args = array(
			'post_type' => 'lolfmk-portfolio',
			'posts_per_page' => $number
		);
		
		$project_query = new WP_Query($args);

		while($project_query->have_posts()) : $project_query->the_post();
		global $post;
		?>

			<div class="entry-project">
				<?php if (has_post_thumbnail()) { ?>
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('widget-thumb'); ?>
						</a>
					</div>
				<?php } else { ?>
					<div class="entry-thumbnail no-thumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo LOLLUM_URI; ?>/images/thumb_project.png" alt="Default Thumb">
						</a>
					</div>
				<?php } ?>
				<div class="entry-meta">
					<div class="entry-categories">
						<?php the_terms($post->ID, 'portfolio-categories', '', '', ''); ?>
					</div>
					<div class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark" class="project-title"><?php the_title(); ?></a></div>
					<?php lolfmk_display_love_link($post->ID); ?>
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
		'title' => 'Recent Projects',
		'number' => 3
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of projects:', 'lollum') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>">
		</p>
	
	<?php
	}

}

add_action('widgets_init', 'lol_projects_widget');

function lol_projects_widget() {
	register_widget('Lollum_Widget_Projects');
}