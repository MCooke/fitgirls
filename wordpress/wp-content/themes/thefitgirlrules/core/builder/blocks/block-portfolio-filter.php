<?php
/**
 * Lollum
 * 
 * The template for displaying the portfolio filter block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_portfolio_filter')) {
	function lolfmk_print_portfolio_filter($item) {
		$portfolio_type = lolfmk_find_xml_value($item, 'portfolio-type');
		$project_number = lolfmk_find_xml_value($item, 'project-number');
		$project_filter = lolfmk_find_xml_value($item, 'project-filter');

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

		$wp_query = new WP_Query($args);

		$portfolio_ids = array();

		while ($wp_query->have_posts()) : $wp_query->the_post();

			global $post;

			$portfolio_ids[] = $post->ID;

		endwhile;

		// rewind_posts();

		// get terms by IDs

		$portfolio_tabs_terms = wp_get_object_terms($portfolio_ids, 'portfolio-categories');

		$portfolio_tabs = array();

		foreach ($portfolio_tabs_terms as $portfolio_tabs_term) {
			$portfolio_tabs[$portfolio_tabs_term->slug] = $portfolio_tabs_term->name;
		}

		$portfolio_tabs = array_unique($portfolio_tabs);

		if ((count($portfolio_ids) > 1) && $project_filter == 'yes') {

		?>
		<div class="container">
			<div class="row">
				<div class="col-12">

					<div class="portfolio-filter">
						<div class="portfolio-select">
							<select>
								<option value="*"><?php _e('All projects', 'lollum'); ?></option>
								<?php foreach($portfolio_tabs as $slug => $name): ?>
									<option value=".<?php echo $slug; ?>"><?php echo $name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<nav class="portfolio-categories">
							<ul class="portfolio-tabs">
								<li class="active">
									<a data-filter="*" href="#"><?php _e('All', 'lollum'); ?></a>
								</li>
								<?php foreach($portfolio_tabs as $slug => $name): ?>
									<li><a data-filter=".<?php echo $slug; ?>" href="#"><?php echo $name; ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
					</div>

				</div>
			</div>
		</div>

		<?php }

		$section_filterable = ($project_filter == 'yes') ? 'section-filterable' : '';

		echo '<div class="full-portfolio-wrap '.$section_filterable.'">';

		while($wp_query->have_posts()) : $wp_query->the_post();
		global $post;
			$portfolio_description = get_post_meta($post->ID, 'lolfmkbox_portfolio_desc', true);
			$item_classes = '';
			$item_names = '';
			$terms = get_the_terms(get_the_ID(), 'portfolio-categories');
			if ($terms) {
				foreach($terms as $term_cat) {
					$item_classes .= $term_cat->slug . ' ';
					$item_names .= $term_cat->name . ' ';
				}
			}
			?>

			<div class="portfolio-item <?php echo $item_classes; ?>">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="portfolio-mask">
					<div class="portfolio-link">
						<i class="fa fa-search"></i>
					</div>
					<div class="portfolio-title">
						<?php the_title(); ?>
						<div><?php echo $item_names; ?></div>
					</div>
					<div class="project-thumb">
						<?php the_post_thumbnail('featured-thumb'); ?>
					</div>
				</a>
			</div>

		<?php endwhile;
		wp_reset_postdata();

		echo '</div>';
	}
}