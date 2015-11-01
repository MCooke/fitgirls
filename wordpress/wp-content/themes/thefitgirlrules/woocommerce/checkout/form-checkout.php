<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

?>

<ul id="order-process">
	<li class="disabled"><?php _e('Shopping Bag', 'lollum'); ?><span class="sep">&gt;</span></li>
	<li class="active"><?php _e('Checkout Details', 'lollum'); ?><span class="sep">&gt;</span></li>
	<li class="disabled"><?php _e('Order Complete', 'lollum'); ?></li>
</ul>

<div class="checkout-wrap">

<div class="row">

	<div class="col-7">

		<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

	</div>

</div>

<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<div class="row">

		<?php $col_c = '12'; ?>

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php $col_c = '5'; ?>

			<div class="col-7">

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div id="customer_details">

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			</div>

		<?php endif; ?>

		<div class="col-<?php echo $col_c; ?> right">

			<div id="order-review-wrap">
			
			<div id="order-review-inner">

				<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>

				<?php do_action( 'woocommerce_checkout_order_review' ); ?>

			</div>

			</div>

		</div>

	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>