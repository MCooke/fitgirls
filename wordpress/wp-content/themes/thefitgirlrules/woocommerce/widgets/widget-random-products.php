<?php

/**
 * Random Products Widget
 */

class Lollum_WC_Widget_Random_Products extends WC_Widget_Random_Products {
 
	function widget( $args, $instance ) {
		global $woocommerce;

		// Use default title as fallback
		$title = ( '' === $instance['title'] ) ? __('Random Products', 'woocommerce' ) : $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		// Setup product query
		$query_args = array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => $instance['number'],
			'orderby'        => 'rand',
			'no_found_rows'  => 1
		);

		$query_args['meta_query'] = array();

		if ( ! $instance['show_variations'] ) {
			$query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
			$query_args['post_parent'] = 0;
		}

	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ) {
			echo $args['before_widget'];

			if ( '' !== $title ) {
				echo $args['before_title'], $title, $args['after_title'];
			} ?>

			<div class="product_list_widget">
				<?php while ($query->have_posts()) : $query->the_post(); global $product;
					echo '<div class="entry-product-wgt">';

					echo '<div class="entry-product-thumb">';
					echo '<a href="'.get_permalink().'">'.( has_post_thumbnail() ? get_the_post_thumbnail( $query->post->ID, 'shop_thumbnail' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '</a>';
					echo '</div>';

					echo '<div class="entry-product-meta">';
					echo '<div class="divider-wgt">';
					echo '<a href="'.get_permalink().'">'.get_the_title().'</a>';
					echo '</div>';
					echo '<span class="price">'.$product->get_price_html().'</span>';
					echo '</div>';

					echo '</div>';
				endwhile; ?>
			</div>

			<?php
			echo $args['after_widget'];
		}

		wp_reset_postdata();

	}

}