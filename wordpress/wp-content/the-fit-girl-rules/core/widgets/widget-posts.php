<?php
/**
 * Lollum
 * 
 * Custom Recent Posts Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */ 

class Lollum_Widget_Posts extends WP_Widget {

	function Lollum_Widget_Posts() {

		$widget_ops = array(
			'classname' => 'lol_widget_posts', 
			'description' => __('Use this widget to display your recent posts in your sidebar or footer.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_posts');
		$this->WP_Widget('lol_widget_posts', __('Custom Recent Posts Widget', 'lollum'), $widget_ops, $control_ops);
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

		<div class="lol-posts-widget row">
		<?php 
		$args = array(
			'ignore_sticky_posts' => true,
			'posts_per_page' => $number
		);
		
		$post_query = new WP_Query($args);
		$i = 0;

		while($post_query->have_posts()) : $post_query->the_post(); ?>
			<?php
				if ( i == 0 ){ 	
					echo( '<div class="entry-post col-xs-offset-1 col-xs-2">');
				} else {
					echo( '<div class="entry-post col-xs-2">')
				} ?>
			<div class="entry-post col-xs-2">
				<?php if (has_post_thumbnail()) { ?>
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('widget-thumb'); ?>
						</a>
					</div>
				<?php } else { ?>
					<div class="entry-thumbnail no-thumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo LOLLUM_URI; ?>/images/thumb_post.png" alt="Default Thumb">
						</a>
					</div>
				<?php } ?>
				<div class="entry-meta">
					<div class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></div>
					<div class="entry-date"><?php the_time('F j, Y'); ?></div>
				</div>
			</div>
		<?php i++; ?>
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
		'title' => 'Recent Posts',
		'number' => 3
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

add_action('widgets_init', 'lol_posts_widget');

function lol_posts_widget() {
	register_widget('Lollum_Widget_Posts');
}