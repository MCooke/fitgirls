<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <a href="http://www.thefitgirlrules.com/category/accessories">
              <div class="product-sub-banner-container">
                <div class="product-sub-banner"><div class="home-sub-banner-text">Shakers Now Available - Limited Availability</div></div>
              </div>
            </a>

	<?php endif; ?>

	<?php
	$product_sidebar = get_post_meta($post->ID, 'lolfmkbox_product_sidebar', true);
	$p_s = false;
	if ($product_sidebar == 'left-sidebar') {
		$p_s = 'left';
	} elseif ($product_sidebar == 'right-sidebar') {
		$p_s = 'right';
	}
	?>

	<!-- BEGIN #page -->
	<div id="page" class="hfeed">

		<!-- BEGIN #main -->
		<div id="main" class="container <?php echo $p_s ? 'sidebar-'.$p_s : 'sidebar-no'; ?>">

			<!-- BEGIN row -->
			<div class="row">

				<!-- BEGIN col-9 -->
				<div class="cont col-<?php echo($p_s ? '9' : '12'); ?>">
				
                                <?php
				  if (get_option('lol_check_breadcumbs')  == 'true') {
				    do_action('show_woo_breadcrumb');
				  }
				?>

					<!-- BEGIN #content -->
					<div id="content" role="main">

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						<?php endwhile; // end of the loop. ?>

					</div>
					<!-- END #content -->

				</div>
				<!-- END col-9 -->

				<?php if ($product_sidebar == 'left-sidebar' || $product_sidebar == 'right-sidebar') { ?>

					<?php get_template_part('sidebar', 'product'); ?>

				<?php } ?>

			</div>
			<!-- END row -->

		<!-- END #main -->
		</div>

	</div>
	<!-- END #page -->

<?php get_footer('shop'); ?>