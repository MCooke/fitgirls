<?php
/**
 * Lollum
 * 
 * The template for displaying the portfolio full block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_portfolio_full')) {
	function lolfmk_print_portfolio_full($item) {
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

		$portfolio_query = new WP_Query($args);

		echo '<div class="row">';

		$i = 1;

		while($portfolio_query->have_posts()) : $portfolio_query->the_post();
		global $post;
			$portfolio_description = get_post_meta($post->ID, 'lolfmkbox_portfolio_desc', true);
			?>

			<div class="col-xs-3">
				<div class="portfolio-item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-mask">
						<div class="portfolio-link">
							<i class="fa fa-search"></i>
						</div>
						<span><?php _e('View', 'lollum'); ?></span>
						<div class="project-thumb">
							<?php the_post_thumbnail('featured-thumb'); ?>
						</div>
					</a>
					<div class="portfolio-meta">
						<div class="project-categories">
							<?php the_terms($post->ID, 'portfolio-categories', '', '', ''); ?>
						</div>
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						<?php lolfmk_display_love_link($post->ID); ?>
					</div>
					<p><?php echo $portfolio_description; ?></p>
				</div>
			</div>

			<?php if ($i == 4 && $project_number == 8) {
				echo '</div><div class="row">';
			} ?>

			<?php $i++; ?>

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}