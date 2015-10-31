<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (get_option('lol_woo_search_sidebar') == 'right') {
	$shop_sidebar_type = 'right';
} elseif (get_option('lol_woo_search_sidebar') == 'full') {
	$shop_sidebar_type = false;
}

get_header('shop'); ?>

        <a href="http://www.thefitgirlrules.com/category/accessories">
          <div class="product-sub-banner-container">
            <div class="product-sub-banner"><div class="home-sub-banner-text">Shakers Now Available - Limited Availability</div></div>
          </div>
        </a>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

	<h1><?php woocommerce_page_title(); ?></h1>

	<?php endif; ?>

	<!-- BEGIN #page -->
	<div id="page" class="hfeed">

		<!-- BEGIN #main -->
		<div id="main" class="container <?php echo $shop_sidebar_type ? 'sidebar-'.$shop_sidebar_type : 'sidebar-no'; ?>">

			<?php
			if (is_product_category() && (get_option('lol_check_cover_cats')  == 'true')) {
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_image_src( $thumbnail_id, 'page-thumb');

				if ($image) {
					echo '<div class="row">';
					echo '<div class="col-12">';
					echo '<div class="product-category-cover">';
					echo '<img src="' . esc_url( $image[0] ) . '" alt="' . esc_attr( $cat->name ) . '" width="' . $image[1] . '" height="' . $image[2] . '" />';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
			}
			?>

			<!-- BEGIN row -->
			<div class="row">

				<!-- BEGIN col-9 -->
				<div class="cont col-<?php echo($shop_sidebar_type ? '9' : '12'); ?>">

					<!-- BEGIN #content -->
					<div id="content" role="main">

						<?php do_action( 'woocommerce_archive_description' ); ?>

						<?php if ( have_posts() ) : ?>

							<?php woocommerce_product_loop_start(); ?>

								<?php global $woocommerce_loop; ?>

								<?php
								$count = 0;
								$columns = $shop_sidebar_type ? '3' : '4';
								?>

								<?php woocommerce_product_subcategories(); ?>

								<?php echo ($woocommerce_loop['loop']) ? '</div>' : ''; ?>

								<?php while ( have_posts() ) : the_post(); ?>

									<?php
									$open = !($count%$columns) ? '<div class="row">' : '';
									$close = !($count%$columns) && $count ? '</div>' : '';
									echo $close.$open;
									?>

									<div class="product-item col-<?php echo($shop_sidebar_type ? '4' : '3'); ?>">

									<?php wc_get_template_part( 'content', 'product' ); ?>

									</div>

									<?php $count++; ?>

								<?php endwhile; // end of the loop. ?>

								<?php echo $count ? '</div>' : ''; ?>

							<?php woocommerce_product_loop_end(); ?>

							<?php
								/**
								 * woocommerce_after_shop_loop hook
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					</div>
					<!-- END #content -->

				</div>
				<!-- END col-9 -->

				<?php if ($shop_sidebar_type == "left" || $shop_sidebar_type == "right") { ?>

					<?php
						/**
						 * woocommerce_sidebar hook
						 *
						 * @hooked woocommerce_get_sidebar - 10
						 */
						do_action('woocommerce_sidebar');
					?>

				<?php } ?>

			</div>
			<!-- END row -->

		<!-- END #main -->
		</div>

	</div>
	<!-- END #page -->

<?php get_footer('shop'); ?>