<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => 4,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<!-- BEGIN row -->
	<div class="row">

		<!-- BEGIN col-12 -->
		<div class="col-12">
			
			<div class="upsells products">
				
				<div class="divider">
					<h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>
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

wp_reset_postdata();
