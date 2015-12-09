<?php
/**
 * Lollum
 * 
 * The template for displaying the project block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_project')) {
	function lolfmk_print_project($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$project_id = lolfmk_find_xml_value($item, 'project-id');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		$args = array(
			'post_type' => 'lolfmk-portfolio',
			'p' => $project_id
		);

		$portfolio_query = new WP_Query($args);
		while($portfolio_query->have_posts()) : $portfolio_query->the_post();
			$portfolio_description = get_post_meta($project_id, 'lolfmkbox_portfolio_desc', true);
			?>

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
						<?php the_terms($project_id, 'portfolio-categories', '', '', ''); ?>
					</div>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<?php lolfmk_display_love_link($project_id); ?>
				</div>
				<p><?php echo $portfolio_description; ?></p>
			</div>

		<?php endwhile;
		wp_reset_postdata();
	}
}