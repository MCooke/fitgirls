<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( 4 );

if ( sizeof( $related ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> 4,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<!-- BEGIN row -->
	<div class="row">

		<!-- BEGIN col-12 -->
		<div class="col-12">

			<div class="related products">
				
				<div class="divider">
					<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
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
