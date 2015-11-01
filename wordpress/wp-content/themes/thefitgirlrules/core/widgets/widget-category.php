<?php
/**
 * Lollum
 * 
 * Custom Category Widget
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

class Lollum_Widget_Category extends WP_Widget {

	function Lollum_Widget_Category() {

		$widget_ops = array(
			'classname' => 'lol_widget_category', 
			'description' => __('Use this widget to display your latest posts by category  in your sidebar.', 'lollum') 
		);
		$control_ops = array('id_base' => 'lol_widget_category');
		$this->WP_Widget('lol_widget_category', __('Custom Category Widget', 'lollum'), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
		$number = (isset($instance['number'])) ? $instance['number'] : 0;
		$category = (is_numeric($instance['category']) ? (int)$instance['category'] : '');

		echo $before_widget;

		if ($title) { 
			echo $before_title . $title . $after_title; 
		}
		?>
			
		<div class="category_widget">            
			<ul>
				<?php 
				$args = array(
					'posts_per_page' => $number,
					'cat' => $category,
					'order' => 'DESC',
					'orderby' => 'date'
				);
				
				$cat_query = new WP_Query($args);

				while($cat_query->have_posts()) : $cat_query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'lollum'), get_the_title()); ?>"><?php the_title(); ?></a></li>	
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['category'] = strip_tags($new_instance['category']);

		return $instance;
	}

	function form($instance) {

		$defaults = array(
		'title' => 'Post by Category',
		'number' => 4
		);

		if (isset($instance['category'])) {
			$category = esc_attr($instance['category']);
		} else {
			$category = '';
		}

		$categories = get_categories();
		$cat_options = array();
		foreach ($categories as $cat) {
			$selected = $category === $cat->cat_ID ? ' selected="selected"' : '';
			$cat_options[] = '<option value="' . $cat->cat_ID . '"' . $selected . '>' . $cat->name . '</option>';
		}

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
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category to show:', 'lollum') ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<?php echo implode('', $cat_options); ?>
			</select>
		</p>
	
	<?php
	}

}

add_action('widgets_init', 'lol_category_widget');

function lol_category_widget() {
	register_widget('Lollum_Widget_Category');
}