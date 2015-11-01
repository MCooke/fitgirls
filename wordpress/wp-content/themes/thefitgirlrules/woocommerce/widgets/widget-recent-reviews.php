<?php

/**
 * Recent Reviews Widget
 */

class Lollum_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews {
 
	function widget( $args, $instance ) {

		global $comments, $comment, $woocommerce;

		$cache = wp_cache_get('widget_recent_reviews', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		ob_start();
		extract($args);

 		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Reviews', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) ) $number = 5;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;
			echo '<div class="product_list_widget">';

			foreach ( (array) $comments as $comment) {

				$_product = get_product( $comment->comment_post_ID );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = $_product->get_rating_html( $rating );

				echo '<div class="entry-product-wgt">';

				echo '<div class="entry-product-thumb">';
				echo '<a href="'.esc_url( get_comment_link( $comment->comment_ID ) ).'">'.$_product->get_image().'</a>';
				echo '</div>';

				echo '<div class="entry-product-meta">';
				echo '<div class="divider-wgt">';
				echo '<a href="'.esc_url( get_comment_link( $comment->comment_ID ) ).'">'.$_product->get_title().'</a>';
				echo '</div>';
				echo '<span class="rating">'.$rating_html.'</span>';
				echo '<span class="lol-review">';
				printf( _x( 'by %1$s', 'by comment author', 'woocommerce' ), get_comment_author() );
				echo '</span>';
				echo '</div>';

				echo '</div>';

			}

			echo '</div>';
			echo $after_widget;
		}

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('widget_recent_reviews', $cache, 'widget');

	}

}