<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
?>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<div class="product-mask-wrap">

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>" class="product-mask">

		<span class="view-product"><?php _e('View', 'lollum'); ?></span>

		<div class="product-thumb">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>

		</div>

	</a>

</div>

<div class="product-meta">
	<div class="product-categories">
		<?php the_terms($post->ID, 'product_cat', '', '', ''); ?>
	</div>

	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	
</div>