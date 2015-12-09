<?php
/**
 * Lollum
 * 
 * WooCommerce custom styles function
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/**
 * WooCommerce custom styles
 */

add_action('wp_head', 'lollum_print_woocommerce_custom_styles');
if (!function_exists('lollum_print_woocommerce_custom_styles')) {
	function lollum_print_woocommerce_custom_styles() { ?>

	<style type="text/css">

	/* first accent color */

	#content div.quantity input.plus:hover,
	#content div.quantity input.minus:hover {
		border: 1px solid <?php echo get_option('lol_first_ac_color');?>;
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}
	tr.shipping label,
	tr.shipping p,
	#content dl.customer_details dt,
	#content .order_details_wrap tbody .product-name,
	#content .product-item .product-meta .product-categories a,
	#content .product-item .product-meta .price,
	#content .product-category a:hover,
	#content .summary .price,
	#content .product_meta a:hover,
	#content #reviews h2,
	#content #reviews h3,
	#content #reviews .woocommerce-noreviews,
	#content table.shop_table.cart tbody td.product-name a:hover,
	#content table.shop_table.cart tbody th.product-subtotal,
	#content table.shop_table.cart tbody td.product-subtotal,
	#content .cart_totals .order-total th,
	#content .cart_totals strong .amount,
	#content .checkout-wrap #order-review-wrap tbody .product-name,
	#content .checkout-wrap #order-review-wrap tfoot .cart-subtotal .amount,
	#content .checkout-wrap #order-review-wrap .order-total th,
	.woocommerce-account #content .order-info mark,
	.woocommerce-account #content table.my_account_orders tbody .order-total .amount,
	#content ol.notes p.meta,
	#sidebar .widget .product_list_widget li a:hover,
	#sidebar .widget .product_list_widget li span,
	#sidebar .widget .widget_shopping_cart_content li span .amount,
	#footer .widget .product_list_widget li a:hover,
	#footer .widget .product_list_widget li span,
	#footer .widget .widget_shopping_cart_content li span .amount,
	#content .woocommerce-tabs .shop_attributes th {
		color: <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .order_details_wrap,
	#content #reviews .woocommerce-verification-required,
	#content #reviews #respond,
	#content .cart-totals-wrap,
	#content .checkout-wrap #order-review-wrap {
		border: 3px solid <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .order_details_wrap h2,
	#content .product-item .product-mask-wrap .add_to_cart_button:hover,
	#content .product-item .product-mask-wrap .added_to_cart:hover,
	#content .product-item .product-mask span.onsale,
	#content .product-item .product-meta .product-categories:after,
	#content span.onsale,
	#content .cart_totals h2,
	#content .checkout-wrap h3#order_review_heading,
	.woocommerce-account #content table.my_account_orders tbody .view {
		background-color: <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .cart_totals .order-total {
		border-top: 3px solid <?php echo get_option('lol_first_ac_color');?>;
		border-bottom: 3px solid <?php echo get_option('lol_first_ac_color');?>;
	}
	#content .checkout-wrap #order-review-wrap .order-total {
		color: <?php echo get_option('lol_first_ac_color');?>;
		border-top: 3px solid <?php echo get_option('lol_first_ac_color');?>;
		border-bottom: 3px solid <?php echo get_option('lol_first_ac_color');?>;
	}
	#sidebar .widget .widget_shopping_cart_content p.total,
	#footer .widget .widget_shopping_cart_content p.total {
		color: <?php echo get_option('lol_first_ac_color');?>;
		border-top: 2px solid <?php echo get_option('lol_first_ac_color');?>;
		border-bottom: 2px solid <?php echo get_option('lol_first_ac_color');?>;
	}
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
		background: <?php echo get_option('lol_first_ac_color');?>;
	}

	/* second accent color */

	#content .product-item .product-mask-wrap .add_to_cart_button,
	#content .product-item .product-mask-wrap .added_to_cart,
	.woocommerce-account #content table.my_account_orders tbody .view:hover {
		background-color: <?php echo get_option('lol_second_ac_color');?>;
	}
	#content .product-item .product-meta .product-categories a:hover,
	#content .product-item .product-meta h3 a:hover,
	#content table.shop_table.cart tbody td.product-remove a:hover,
	#content .cart_totals .order-total {
		color: <?php echo get_option('lol_second_ac_color');?>;
	}

	/* third accent color */

	#content .product-item .product-mask:after {
		background-color: <?php echo get_option('lol_third_ac_color');?>;
	}

	/* first button color */

	#content #reviews #respond input[type="submit"],
	#content p.order-again a:hover,
	#sidebar .widget .widget_shopping_cart_content .wc-forward:hover,
	#sidebar .widget .widget_shopping_cart_content .wc-forward.checkout,
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	#footer .widget .widget_shopping_cart_content .wc-forward:hover,
	#footer .widget .widget_shopping_cart_content .wc-forward.checkout {
		background-color:<?php echo get_option('lol_first_btn_color');?>;
	}
	#content p.order-again a {
		border: 1px solid <?php echo get_option('lol_first_btn_color');?>;
		color: <?php echo get_option('lol_first_btn_color');?>;
	}

	/* second button color */

	#content .woocommerce-pagination a:hover,
	#content .woocommerce-pagination .current:hover,
	#content .woocommerce-pagination .current,
	#content .social-meta a:hover,
	#content #reviews .navigation a:hover,
	#sidebar .widget_product_tag_cloud a:hover,
	#footer .widget_product_tag_cloud a:hover {
		color: <?php echo get_option('lol_second_btn_color');?>;
	}
	#content .social-meta a:hover,
	#sidebar .widget_product_tag_cloud a:hover,
	#footer .widget_product_tag_cloud a:hover {
		color: <?php echo get_option('lol_second_btn_color');?>!important;
	}
	#content #reviews #respond input[type="submit"]:hover,
	#sidebar .widget .widget_shopping_cart_content .wc-forward,
	#sidebar .widget .widget_shopping_cart_content .wc-forward.checkout:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	#footer .widget .widget_shopping_cart_content .wc-forward,
	#footer .widget .widget_shopping_cart_content .wc-forward.checkout:hover {
		background-color: <?php echo get_option('lol_second_btn_color');?>;
	}

	/* primary font - normal weight */

	tr.shipping label,
	tr.shipping p,
	#content .woocommerce-message a,
	#content .woocommerce-message strong,
	#content .woocommerce-error a,
	#content .woocommerce-error strong {
		font-weight: <?php echo get_option('lol_ff_normal');?>;
	}

	/* primary font - bold weight */

	.pp_description,
	#content div.quantity input[type=number],
	#content a.chosen-single,
	#content dl.customer_details dt,
	#content .order_details_wrap tbody .product-name,
	#content .woocommerce-result-count,
	#content .woocommerce-pagination a,
	#content .woocommerce-pagination .current,
	#content .product-item .product-mask-wrap .add_to_cart_button,
	#content .product-item .product-mask-wrap .added_to_cart,
	#content .product-item .product-meta .product-categories,
	#content table.variations .reset_variations,
	#content .product_meta .sku_wrapper,
	#content .product_meta .posted_in,
	#content .product_meta .tagged_as,
	#content #reviews .comment_container .comment-text .meta,
	#content #reviews .comment_container .comment-text .meta strong,
	#content #reviews .navigation,
	#content #reviews .navigation a,
	#content #reviews #respond input[type="submit"],
	#content table.shop_table.cart tbody td.product-name,
	#content table.shop_table.cart tbody td.product-price,
	#content table.shop_table.cart tbody th.product-subtotal,
	#content table.shop_table.cart tbody td.product-subtotal,
	#content .checkout-wrap #order-review-wrap tbody .product-name,
	#content .checkout-wrap #order-review-wrap tfoot .cart-subtotal .amount,
	.woocommerce-account #content table.my_account_orders tbody .order-number,
	.woocommerce-account #content table.my_account_orders tbody .order-total .amount,
	#content p.order-again a,
	#sidebar .widget_product_tag_cloud a,
	#sidebar .widget_layered_nav .count,
	#sidebar .widget .widget_shopping_cart_content p.total .amount,
	#sidebar .widget .widget_shopping_cart_content .wc-forward,
	#sidebar .widget .widget_shopping_cart_content .wc-forward.checkout,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	#footer .widget_product_tag_cloud a,
	#footer.dark .widget_product_tag_cloud a,
	#footer .widget_layered_nav .count,
	#footer .widget .widget_shopping_cart_content p.total .amount,
	#footer .widget .widget_shopping_cart_content .wc-forward,
	#footer .widget .widget_shopping_cart_content .wc-forward.checkout {
		font-weight: <?php echo get_option('lol_ff_bold');?>;
	}

	/* secondary font - normal weight */

	#content .woo-header,
	#content .woo-header h2,
	#content .woo-header h3,
	#content .woocommerce-tabs .tabs li a,
	#content form.checkout .woo-header label,
	#content form.checkout .woo-header h3,
	#content .woocommerce-tabs .shop_attributes th {
		font-weight: <?php echo get_option('lol_sf_normal');?>;
	}

	/* primary font family */

	tr.shipping label,
	tr.shipping p {
		font-family: <?php echo get_option('lol_primary_font');?>;
	}

	/* secondary font family */

	#content #order-process,
	#content .woo-header,
	#content .product-item .product-meta h3,
	#content .product-item .product-meta .price,
	#content .product-category a h3,
	#content .summary h1.product_title,
	#content .summary .price,
	#content .woocommerce-tabs .tabs li a,
	#content #reviews h2,
	#content #reviews h3,
	#content form.checkout .woo-header label,
	#content form.checkout .woo-header h3,
	#sidebar .widget .product_list_widget li a,
	#sidebar .widget .product_list_widget li span,
	.woocommerce .widget_price_filter .price_slider_amount,
	#footer .widget .product_list_widget li a,
	#footer .widget .product_list_widget li span {
		font-family: <?php echo get_option('lol_secondary_font');?>;
	}

	</style>

	<?php
	}
}