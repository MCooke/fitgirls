<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in meta">' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'woocommerce' ) . ' ', '.</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as meta">' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $post->ID, 'product_tag' ) ), 'woocommerce' ) . ' ', '.</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>