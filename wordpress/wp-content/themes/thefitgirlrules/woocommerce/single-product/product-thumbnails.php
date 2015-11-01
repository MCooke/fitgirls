<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {

	foreach ( $attachment_ids as $attachment_id ) {

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
			continue;

		$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" title="%s" data-rel="thumbnails">%s</a></li>', $image_link, $image_title, $image ), $attachment_id, $post->ID, '' );

	}

}