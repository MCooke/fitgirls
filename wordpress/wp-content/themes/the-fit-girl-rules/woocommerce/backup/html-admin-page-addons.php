<div class="wrap woocommerce wc_addons_wrap">
	<div class="icon32 icon32-posts-product" id="icon-woocommerce"><br /></div>
	<h2>
		<?php _e( 'WooCommerce Add-Ons / Extensions', 'woocommerce' ); ?>
		<a href="http://www.woothemes.com/product-category/woocommerce-extensions/" class="add-new-h2"><?php _e( 'Browse all extensions', 'woocommerce' ); ?></a>
		<a href="http://www.woothemes.com/product-category/themes/woocommerce/" class="add-new-h2"><?php _e( 'Browse themes', 'woocommerce' ); ?></a>
	</h2>
	<ul class="subsubsub">
		<?php
			$links = array(
				''                         => __( 'Popular', 'woocommerce' ),
				'payment-gateways'         => __( 'Gateways', 'woocommerce' ),
				'shipping-methods'         => __( 'Shipping', 'woocommerce' ),
				'import-export-extensions' => __( 'Import/export', 'woocommerce' ),
				'product-extensions'       => __( 'Products', 'woocommerce' ),
				'marketing-extensions'     => __( 'Marketing', 'woocommerce' ),
				'free-extensions'          => __( 'Free', 'woocommerce' )
			);

			$i = 0;

			foreach ( $links as $link => $name ) {
				$i ++;
				?><li><a class="<?php if ( $view == $link ) echo 'current'; ?>" href="<?php echo admin_url( 'admin.php?page=wc-addons&view=' . esc_attr( $link ) ); ?>"><?php echo $name; ?></a><?php if ( $i != sizeof( $links ) ) echo ' |'; ?></li><?php
			}
		?>
	</ul>
	<br class="clear" />
	<?php echo $addons; ?>
</div>