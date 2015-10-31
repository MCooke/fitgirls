<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

$shop_sidebar_type = 'left';

if (get_option('lol_woo_search_sidebar') == 'right') {
	$shop_sidebar_type = 'right';
} elseif (get_option('lol_woo_search_sidebar') == 'full') {
	$shop_sidebar_type = false;
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Increase loop count
$woocommerce_loop['loop']++;

$columns = $shop_sidebar_type ? '3' : '4';
?>

<?php
$open = !(($woocommerce_loop['loop'] - 1)%$columns) ? '<div class="row">' : '';
$close = !(($woocommerce_loop['loop'] - 1)%$columns) && ($woocommerce_loop['loop'] - 1) ? '</div>' : '';
echo $close.$open;
?>

<div class="product-category col-<?php echo($shop_sidebar_type ? '4' : '3'); ?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>

		<h3>
			<?php
				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</h3>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>