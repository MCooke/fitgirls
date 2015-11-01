<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>

<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link = wp_get_attachment_url( get_post_thumbnail_id() );
			$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			$attachment_ids = $product->get_gallery_attachment_ids();

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			if ($attachment_ids) {

				echo '<div class="flexslider flex-product">';
				echo '<ul class="slides">';
				echo '<div class="preloader"></div>';
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><img src="%s"></li>', $image_link, $image_title, $image ), $post->ID );
			
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><img src="%s"></li>', $image_link, $image_title, $image ), $attachment_id, $post->ID );

				}

				echo '</ul>';
				echo '</div>';

				?>

				<div class="thumbnails row">
					<nav class="thumbnails-nav">
						<ul>
							<?php
							$image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
							?>
							<li><a href="<?php echo $image_url; ?>" title="<?php echo $image_title; ?>" rel="thumbnails"><?php the_post_thumbnail('shop_thumbnail'); ?></a></li>
							<?php do_action( 'woocommerce_product_thumbnails' ); ?>
						</ul>
					</nav>
				</div>

			<?php } else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );
			}

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	?>

</div>
