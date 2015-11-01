<?php
/**
 * Lollum
 * 
 * The template for displaying the blog full block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_blog_full')) {
	function lolfmk_print_blog_full($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$blog_type = lolfmk_find_xml_value($item, 'blog-type');
		$post_category = lolfmk_find_xml_value($item, 'post-category');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		if ($blog_type == 'recent') {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => 40
			);
		} elseif ($blog_type == 'random') {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => 40,
				'orderby' => 'rand'
			);
		} else {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'cat' => $post_category,
				'posts_per_page' => 40
			);
		}

		echo '<div class="row">';

		$post_query = new WP_Query($args);
		while($post_query->have_posts()) : $post_query->the_post(); ?>

			<div class="category_item col-xs-6 col-sm-3">
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
			</div>

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}