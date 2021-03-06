<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => 4,
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<!-- BEGIN row -->
	<div class="row">

		<!-- BEGIN col-12 -->
		<div class="col-12">

			<div class="cross-sells">

				<div class="divider">
					<h2><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h2>
				</div>

				<?php woocommerce_product_loop_start(); ?>

					<?php
					$count = 0;
					?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<?php
						$open = !($count%4) ? '<div class="row">' : '';
						$close = !($count%4) && $count ? '</div>' : '';
						echo $close.$open;
						?>

						<div class="product-item col-3">

							<?php wc_get_template_part( 'content', 'product' ); ?>

						</div>

						<?php $count++; ?>

					<?php endwhile; // end of the loop. ?>

					<?php echo $count ? '</div>' : ''; ?>

				<?php woocommerce_product_loop_end(); ?>

			</div>

		</div>
		<!-- END col-12 -->

	</div>
	<!-- END row -->

<?php endif;

wp_reset_query();