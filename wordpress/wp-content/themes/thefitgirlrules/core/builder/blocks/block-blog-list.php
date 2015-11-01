<?php
/**
 * Lollum
 * 
 * The template for displaying the blog list block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_blog_list')) {
	function lolfmk_print_blog_list($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$blog_type = lolfmk_find_xml_value($item, 'blog-type');
		$post_category = lolfmk_find_xml_value($item, 'post-category');
		$blog_number = lolfmk_find_xml_value($item, 'blog-number');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		if ($blog_type == 'recent') {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => $blog_number
			);
		} elseif ($blog_type == 'random') {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => $blog_number,
				'orderby' => 'rand'
			);
		} else {
			$args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'cat' => $post_category,
				'posts_per_page' => $blog_number
			);
		}

		echo '<div class="lol-item-blog-list">';

		$post_query = new WP_Query($args);
		while($post_query->have_posts()) : $post_query->the_post(); ?>

			<div class="entry-post">
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
					<?php $categories_list = get_the_category_list(' ');
						echo '<div class="entry-categories">'.$categories_list.'</div>';
					?>
					<div class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></div>
					<div class="entry-date"><?php the_time('F j, Y'); ?></div>
				</div>
			</div>

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}