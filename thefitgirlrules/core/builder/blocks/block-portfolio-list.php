<?php
/**
 * Lollum
 * 
 * The template for displaying the portfolio list block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_portfolio_list')) {
	function lolfmk_print_portfolio_list($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$portfolio_type = lolfmk_find_xml_value($item, 'portfolio-type');
		$project_number = lolfmk_find_xml_value($item, 'project-number');	

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		if ($portfolio_type == 'recent') {
			$args = array(
				'post_type' => 'lolfmk-portfolio',
				'posts_per_page' => $project_number,
				'orderby' => 'date',
				'order' => 'DESC'
			);
		} elseif ($portfolio_type == 'random') {
			$args = array(
				'post_type' => 'lolfmk-portfolio',
				'posts_per_page' => $project_number,
				'orderby' => 'rand'
			);
		} else {
			$args = array(
				'post_type' => 'lolfmk-portfolio',
				'posts_per_page' => $project_number,
				'meta_key' => '_lolfmk_love_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC'
			);
		}

		echo '<div class="lol-item-portfolio-list">';

		$portfolio_query = new WP_Query($args);
		while($portfolio_query->have_posts()) : $portfolio_query->the_post();
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

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}