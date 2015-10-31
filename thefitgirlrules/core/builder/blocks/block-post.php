<?php
/**
 * Lollum
 * 
 * The template for displaying the post block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_post')) {
	function lolfmk_print_post($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$post_id = lolfmk_find_xml_value($item, 'post-id');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		$args = array(
			'p' => $post_id
		);
		$post_query = new WP_Query($args);
		while($post_query->have_posts()) : $post_query->the_post(); ?>

			<div class="post-item">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-mask">
					<div class="post-link">
						<i class="fa fa-search"></i>
					</div>
					<span><?php _e('View', 'lollum'); ?></span>
					<div class="post-thumb">
						<?php the_post_thumbnail('featured-thumb'); ?>
					</div>
				</a>
				<div class="post-meta">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<p><?php the_excerpt(); ?></p>
			</div>

		<?php endwhile;
		wp_reset_postdata();
	}
}