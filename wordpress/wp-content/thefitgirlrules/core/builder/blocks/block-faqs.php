<?php
/**
 * Lollum
 * 
 * The template for displaying the faqs block
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if (!function_exists('lolfmk_print_faqs')) {
	function lolfmk_print_faqs($item) {
		$header_text = lolfmk_find_xml_value($item, 'header-text');
		$faq_layout = lolfmk_find_xml_value($item, 'faq-layout');
		$faq_type = lolfmk_find_xml_value($item, 'faq-type');
		$faq_description = lolfmk_find_xml_value($item, 'faq-description');
		$faq_category = lolfmk_find_xml_value($item, 'faq-category');

		if ($header_text != '') {
			echo '<div class="divider"><h3>'.$header_text.'</h3></div>';
		}

		if ($faq_layout == '1') {

			$args = array(
				'post_type' => 'lolfmk-faq',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);

			$faqs_query = new WP_Query($args);

			while($faqs_query->have_posts()) : $faqs_query->the_post();
				global $post;
				$faqs_ids[] = $post->ID;
			endwhile;
			wp_reset_postdata();

			$faqs_tabs_terms = wp_get_object_terms($faqs_ids, 'faqs-categories');
			$faqs_tabs = array();
			foreach ($faqs_tabs_terms as $faqs_tabs_term) {
				$faqs_tabs[$faqs_tabs_term->slug] = $faqs_tabs_term->name;
			}
			$faqs_tabs = array_unique($faqs_tabs);

			if ((count($faqs_ids) > 1) && $faq_type == 'yes') { ?>

				<div class="faqs-filter">
					<div class="faqs-select">
						<select>
							<option value="*"><?php _e('All', 'lollum'); ?></option>
							<?php foreach($faqs_tabs as $slug => $name): ?>
								<option value="<?php echo $slug; ?>"><?php echo $name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<nav class="faqs-categories">
						<ul class="faqs-tabs">
							<li class="active">
								<a data-filter="*" href="#"><?php _e('All', 'lollum'); ?></a>
							</li>
							<?php foreach($faqs_tabs as $slug => $name): ?>
								<li><a data-filter="<?php echo $slug; ?>" href="#"><?php echo $name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			<?php }

			echo '<div class="lol-faq-wrap">';

			while($faqs_query->have_posts()) : $faqs_query->the_post();

				$faq_classes = '';
				$terms = get_the_terms(get_the_ID(), 'faqs-categories');
				if ($terms) {
					foreach($terms as $term_cat) {
						$faq_classes .= $term_cat->slug . ' ';
					}
				}

				echo '<div class="lol-faq" data-filter="'.$faq_classes.'">';
				echo '<div class="lol-faq-header">';
				echo '<div class="lol-icon-faq">Q</div>';
				echo '<span class="lol-faq-title">'.get_the_title().'</span>';
				echo '</div>';
				echo '<div class="lol-faq-content">'.get_the_content().'</div>';
				echo '</div>';

			endwhile;
			wp_reset_postdata();

			echo '</div>';

		} else {

			$args = array(
				'post_type' => 'lolfmk-faq',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);

			if ($faq_category != 'all') {
				$args['tax_query'] = array(
					array(
					'taxonomy' => 'faqs-categories',
					'field' => 'slug',
					'terms' => $faq_category
					),
				);
			}

			$faqs_query = new WP_Query($args);

			$i = 1;
			$j = 1;

			echo '<p class="faq-description">'.$faq_description.'</p>';

			echo '<ul id="lol-faq-topics">';

			while($faqs_query->have_posts()) : $faqs_query->the_post();

				echo '<li><a href="#topic'.$i.'">'.get_the_title().'</a></li>';
				$i++;

			endwhile;

			echo '</ul>';

			while($faqs_query->have_posts()) : $faqs_query->the_post();

				echo '<div class="lol-faq-entry">';
				echo '<h3 id="topic'.$j.'" class="lol-faq-topic-title">'.$j.' - '.get_the_title().'</h3>';
				echo '<p class="lol-faq-topic-content">'.get_the_content().'</p>';
				echo '<a class="back-faqs" href="#lol-faq-topics">'.__('Back to Top', 'lollum').'</a>';
				echo '</div>';

				$j++;

			endwhile;
			wp_reset_postdata();

		}
	}
}