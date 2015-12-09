<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<ul id="order-process">
	<li class="active"><?php _e('Shopping Bag', 'lollum'); ?><span class="sep">&gt;</span></li>
	<li class="disabled"><?php _e('Checkout Details', 'lollum'); ?><span class="sep">&gt;</span></li>
	<li class="disabled"><?php _e('Order Complete', 'lollum'); ?></li>
</ul>

<p class="cart-empty"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p class="return-to-shop"><a class="button lol-button light-btn wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></p>