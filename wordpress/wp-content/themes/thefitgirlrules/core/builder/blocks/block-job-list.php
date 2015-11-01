<?php
/**
 * Lollum
 * 
 * The template for displaying the job list block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_job_list')) {
	function lolfmk_print_job_list($item) {
		$job_cat = lolfmk_find_xml_value($item, 'job-category');

		$args = array(
			'post_type' => 'lolfmk-job',
			'posts_per_page' => -1,
			'order' => 'DESC',
			'orderby ' => 'date',
			'tax_query' => array(
				array(
					'taxonomy' => 'job-categories',
					'field' => 'slug',
					'terms' => $job_cat
				)
			)
		);
		$term = get_term_by('slug', $job_cat, 'job-categories');
		$name = $term->name;

		echo '<div class="job-list">';

		echo '<div class="divider"><h3>'.$name.'</h3></div>';

		$job_query = new WP_Query($args);
		while($job_query->have_posts()) : $job_query->the_post();
		global $post;
		$job_location = get_post_meta($post->ID, 'lolfmkbox_job_location', true);
		?>

			<div class="entry-job">
				<div class="meta-job-wrap">
					<h4><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
					<div class="meta-job"><?php _e('Published on ', 'lollum'); ?><?php the_time('F j, Y'); ?></div>
				</div>
				<span class="meta-job-location"><?php echo $job_location; ?></span>
			</div>

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}