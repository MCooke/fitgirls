<?php

/**
 * Featured Products Widget
 */

class Lollum_WC_Widget_Featured_Products extends WC_Widget_Featured_Products {
 
	function widget( $args, $instance ) {

		global $woocommerce;

		$cache = wp_cache_get('widget_featured_products', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Featured Products', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
?>

   		<?php $query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = $woocommerce->query->get_meta_query();
		$query_args['meta_query'][] = array(
			'key' => '_featured',
			'value' => 'yes'
		);

		$r = new WP_Query($query_args);

		if ($r->have_posts()) : ?>

		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>


		<div class="product_list_widget">
		<?php while ($r->have_posts()) : $r->the_post(); global $product;

			echo '<div class="entry-product-wgt">';

			echo '<div class="entry-product-thumb">';
			echo '<a href="'.get_permalink().'">'.( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ) : woocommerce_placeholder_img( 'shop_thumbnail' ) ) . '</a>';
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


		<?php echo $after_widget; ?>

		<?php endif;

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('widget_featured_products', $cache, 'widget');
      wp_reset_postdata();

	}
}