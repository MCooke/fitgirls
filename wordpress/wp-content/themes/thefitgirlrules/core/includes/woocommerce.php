<?php
/**
 * Lollum
 * 
 * WooCommerce functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/**
 * Disable and register WooCommerce styles
 */

add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/**
 * Remove theme wrappers
 */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


/**
 * Reposition breadcrumb
 */

if (!function_exists('lollum_remove_woo_breadcrumb')) {
	function lollum_remove_woo_breadcrumb() {
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	}
}
add_action('woocommerce_before_main_content', 'lollum_remove_woo_breadcrumb');

if (!function_exists('lollum_woo_custom_breadcrumb')) {
	function lollum_woo_custom_breadcrumb() {
		woocommerce_breadcrumb();
	}
}
add_action('show_woo_breadcrumb', 'lollum_woo_custom_breadcrumb');


/**
 * Change woocommerce breadcrumb output
 */

add_filter('woocommerce_breadcrumb_defaults', 'lollum_woo_breadcrumb_filter');
if (!function_exists('lollum_woo_breadcrumb_filter')) {
	function lollum_woo_breadcrumb_filter() {
		return array(
		'delimiter'   => ' / ',
		'wrap_before' => '<nav class="crumbs"><span>'.__('You are here:', 'lollum').'</span>',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'home'        => _x('Home', 'breadcrumb', 'woocommerce' ),
		);
	}
}

/**
 * Change number of products per page
 */

add_filter('loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20);


/**
 * Change order actions woocommerce_before_shop_loop
 */

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 30 );


/**
 * Change demo store notice location
 */

remove_action( 'wp_footer', 'woocommerce_demo_store' );
add_action( 'lollum_woocommerce_store_notice', 'woocommerce_demo_store');


/**
 * Add default thumbnails dimensions to woocommerce
 */

if (!function_exists('lollum_woocommerce_default_thumbs')) {
	function lollum_woocommerce_default_thumbs() {
		update_option('shop_catalog_image_size', array('width' => 758, 'height' => 1000, 'crop' => true));
		update_option('shop_single_image_size', array('width' => 758, 'height' => 1000, 'crop' => true)); 
		update_option('shop_thumbnail_image_size', array('width' => 500, 'height' => 647, 'crop' => true));
	}
}
add_action('after_setup_theme', 'lollum_woocommerce_default_thumbs');


/**
 * Update header cart
 */

if (!function_exists('lollum_header_add_to_cart_fragment')) {
	function lollum_header_add_to_cart_fragment($fragments) {
		global $woocommerce;
		
		ob_start();
		
		?>

		<div id="lol-header-cart">

			<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="cart-total"><?php _e('Basket', 'lollum'); ?> / <?php echo $woocommerce->cart->get_cart_total(); ?><i class="fa fa-shopping-cart"></i></a>

		</div>

		<?php
		
		$fragments['#lol-header-cart'] = ob_get_clean();
		
		return $fragments;
		
	}
}
add_filter('add_to_cart_fragments', 'lollum_header_add_to_cart_fragment');


/**
 * Modify default shortcodes
 */

if (!function_exists('lollum_custom_woo_shortcodes')) {
	function lollum_custom_woo_shortcodes() {
		remove_shortcode('product');
		remove_shortcode('product_category');
		remove_shortcode('product_categories');
		remove_shortcode('products');
		remove_shortcode('recent_products');
		remove_shortcode('sale_products');
		remove_shortcode('best_selling_products');
		remove_shortcode('top_rated_products');
		remove_shortcode('featured_products');
		remove_shortcode('product_attribute');
		add_shortcode('product', 'lollum_custom_product');
		add_shortcode('product_category', 'lollum_custom_product_category');
		add_shortcode('product_categories', 'lollum_custom_product_categories');
		add_shortcode('products', 'lollum_custom_products');
		add_shortcode('recent_products', 'lollum_custom_recent_products');		
		add_shortcode('sale_products', 'lollum_custom_sale_products');
		add_shortcode('best_selling_products', 'lollum_custom_best_selling_products');
		add_shortcode('top_rated_products', 'lollum_custom_top_rated_products');
		add_shortcode('featured_products', 'lollum_custom_featured_products');
		add_shortcode('product_attribute', 'lollum_custom_product_attribute');
	}
}
add_action('init', 'lollum_custom_woo_shortcodes');

// Product shortcode

if (!function_exists('lollum_custom_product')) {
	function lollum_custom_product( $atts ) {
		if ( empty( $atts ) ) return '';

		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page' 	=> 1,
			'no_found_rows' 	=> 1,
			'post_status' 		=> 'publish',
			'meta_query' 		=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array('catalog', 'visible'),
					'compare' 	=> 'IN'
				)
			)
		);

		if ( isset( $atts['sku'] ) ) {
			$args['meta_query'][] = array(
				'key' 		=> '_sku',
				'value' 	=> $atts['sku'],
				'compare' 	=> '='
			);
		}

		if ( isset( $atts['id'] ) ) {
			$args['p'] = $atts['id'];
		}

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<div class="product-item">

							<?php wc_get_template_part( 'content', 'product' ); ?>

						</div>

					<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row-single">' . ob_get_clean() . '</div>';
	}
}

// Product category shortcode

if (!function_exists('lollum_custom_product_category')) {
	function lollum_custom_product_category($atts) {

		if ( empty( $atts ) ) return '';

		extract( shortcode_atts( array(
			'per_page' 		=> '12',
			'columns' 		=> '4',
			'orderby'   	=> 'title',
			'order'     	=> 'desc',
			'category'		=> '',
			'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
			), $atts ) );

		if ( ! $category ) return '';

		// Default ordering args
		$ordering_args = WC()->query->get_catalog_ordering_args( $orderby, $order );

		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
			'posts_per_page' 		=> $per_page,
			'meta_query' 			=> array(
				array(
					'key' 			=> '_visibility',
					'value' 		=> array('catalog', 'visible'),
					'compare' 		=> 'IN'
				)
			),
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array( esc_attr( $category ) ),
					'field' 		=> 'slug',
					'operator' 		=> $operator
				)
			)
		);

		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php
				$count = 0;
				$col = 3;
				$col_mod = 4;
				switch ($columns) {
					case '2':
						$col_mod = 2;
						$col = 6;
						break;
					case '3':
						$col_mod = 3;
						$col = 4;
						break;
					case '6':
						$col_mod = 6;
						$col = 2;
						break;
					default:
						$col_mod = 4;
						$col = 3;
						break;
				}
				?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		woocommerce_reset_loop();
		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Product categories shortcode

if (!function_exists('lollum_custom_product_categories')) {
	function lollum_custom_product_categories($atts) {
		extract( shortcode_atts( array(
			'number'     => null,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'columns' 	 => '4',
			'hide_empty' => 1,
			'parent'     => ''
		), $atts ) );

		if ( isset( $atts[ 'ids' ] ) ) {
			$ids = explode( ',', $atts[ 'ids' ] );
			$ids = array_map( 'trim', $ids );
		} else {
			$ids = array();
		}

		$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

		// get terms and workaround WP bug with parents/pad counts
		$args = array(
			'orderby'    => $orderby,
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'include'    => $ids,
			'pad_counts' => true,
			'child_of'   => $parent
		);

		$product_categories = get_terms( 'product_cat', $args );

		if ( $parent !== "" ) {
			$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
		}

		if ( $number ) {
			$product_categories = array_slice( $product_categories, 0, $number );
		}

		ob_start();

		if ( $product_categories ) {

			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}

			woocommerce_product_loop_start();

			foreach ( $product_categories as $category ) {

				$open = !($count%$col_mod) ? '<div class="row">' : '';
				$close = !($count%$col_mod) && $count ? '</div>' : '';
				echo $close.$open; ?>

				<div class="product-category col-<?php echo $col; ?>">

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

				<?php $count++;

			}

			echo $count ? '</div>' : '';

			woocommerce_product_loop_end();

		}

		woocommerce_reset_loop();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Products shortcode

if (!function_exists('lollum_custom_products')) {
	function lollum_custom_products( $atts ) {

		if ( empty( $atts ) ) return '';

		extract( shortcode_atts( array(
			'columns' 	=> '4',
			'orderby'   => 'title',
			'order'     => 'asc'
		), $atts ) );

		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'posts_per_page' 		=> -1,
			'meta_query' 			=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array('catalog', 'visible'),
					'compare' 	=> 'IN'
				)
			)
		);

		if ( isset( $atts['skus'] ) ) {
			$skus = explode( ',', $atts['skus'] );
			$skus = array_map( 'trim', $skus );
			$args['meta_query'][] = array(
				'key' 		=> '_sku',
				'value' 	=> $skus,
				'compare' 	=> 'IN'
			);
		}

		if ( isset( $atts['ids'] ) ) {
			$ids = explode( ',', $atts['ids'] );
			$ids = array_map( 'trim', $ids );
			$args['post__in'] = $ids;
		}

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		$woocommerce_loop['columns'] = $columns;

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Recent products shortcode

if (!function_exists('lollum_custom_recent_products')) {
	function lollum_custom_recent_products($atts) {

		extract( shortcode_atts( array(
			'per_page' 	=> '12',
			'columns' 	=> '4',
			'orderby' 	=> 'date',
			'order' 	=> 'desc'
		), $atts ) );

		$meta_query = WC()->query->get_meta_query();

		$args = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $per_page,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'meta_query' 			=> $meta_query
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Sale Products shortcode

if (!function_exists('lollum_custom_sale_products')) {
	function lollum_custom_sale_products( $atts ){

		extract( shortcode_atts( array(
			'per_page'      => '12',
			'columns'       => '4',
			'orderby'       => 'title',
			'order'         => 'asc'
		), $atts ) );

		// Get products on sale
		$product_ids_on_sale = wc_get_product_ids_on_sale();

		$meta_query   = array();
		$meta_query[] = WC()->query->visibility_meta_query();
		$meta_query[] = WC()->query->stock_status_meta_query();
		$meta_query   = array_filter( $meta_query );

		$args = array(
			'posts_per_page'	=> $per_page,
			'orderby' 			=> $orderby,
			'order' 			=> $order,
			'no_found_rows' 	=> 1,
			'post_status' 		=> 'publish',
			'post_type' 		=> 'product',
			'meta_query' 		=> $meta_query,
			'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php echo $count ? '</div>' : ''; ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Best Selling Products shortcode

if (!function_exists('lollum_custom_best_selling_products')) {
	function lollum_custom_best_selling_products( $atts ){

		extract( shortcode_atts( array(
			'per_page'      => '12',
			'columns'       => '4'
		), $atts ) );

		$args = array(
			'post_type' 			=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page'		=> $per_page,
			'meta_key' 		 		=> 'total_sales',
			'orderby' 		 		=> 'meta_value_num',
			'meta_query' 			=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array( 'catalog', 'visible' ),
					'compare' 	=> 'IN'
				)
			)
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

					<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php echo $count ? '</div>' : ''; ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Top Rated Products shortcode

if (!function_exists('lollum_custom_top_rated_products')) {
	function lollum_custom_top_rated_products( $atts ){

		extract( shortcode_atts( array(
			'per_page'      => '12',
			'columns'       => '4',
			'orderby'       => 'title',
			'order'         => 'asc'
			), $atts ) );

		$args = array(
			'post_type' 			=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'   => 1,
			'orderby' 				=> $orderby,
			'order'					=> $order,
			'posts_per_page' 		=> $per_page,
			'meta_query' 			=> array(
				array(
					'key' 			=> '_visibility',
					'value' 		=> array('catalog', 'visible'),
					'compare' 		=> 'IN'
				)
			)
		);

		ob_start();

		add_filter( 'posts_clauses', 'lollum_order_by_rating_post_clauses' );

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		remove_filter( 'posts_clauses', 'lollum_order_by_rating_post_clauses' );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

if (!function_exists('lollum_order_by_rating_post_clauses')) {
	function lollum_order_by_rating_post_clauses( $args ) {

		global $wpdb;

		$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

		$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

		$args['join'] .= "
			LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
			LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
		";

		$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";

		$args['groupby'] = "$wpdb->posts.ID";

		return $args;
	}
}

// Featured Products shortcode

if (!function_exists('lollum_custom_featured_products')) {
	function lollum_custom_featured_products( $atts ) {

		extract( shortcode_atts( array(
			'per_page' 	=> '12',
			'columns' 	=> '4',
			'orderby' 	=> 'date',
			'order' 	=> 'desc'
		), $atts ) );

		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $per_page,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'meta_query'			=> array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array('catalog', 'visible'),
					'compare'	=> 'IN'
				),
				array(
					'key' 		=> '_featured',
					'value' 	=> 'yes'
				)
			)
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

// Product Attribute shortcode

if (!function_exists('lollum_custom_product_attribute')) {
	function lollum_custom_product_attribute( $atts ) {

		extract( shortcode_atts( array(
			'per_page'  => '12',
			'columns'   => '4',
			'orderby'   => 'title',
			'order'     => 'asc',
			'attribute' => '',
			'filter'    => ''
		), $atts ) );

		$attribute 	= strstr( $attribute, 'pa_' ) ? sanitize_title( $attribute ) : 'pa_' . sanitize_title( $attribute );

		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $per_page,
			'orderby'             => $orderby,
			'order'               => $order,
			'meta_query'          => array(
				array(
					'key'               => '_visibility',
					'value'             => array('catalog', 'visible'),
					'compare'           => 'IN'
				)
			),
			'tax_query' 			=> array(
				array(
					'taxonomy' 	=> $attribute,
					'terms'     => array_map( 'sanitize_title', explode( ",", $filter ) ),
					'field' 	=> 'slug'
				)
			)
		);

		ob_start();

		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) : ?>

			<?php
			$count = 0;

			$col = 3;
			$col_mod = 4;
			switch ($columns) {
				case '2':
					$col_mod = 2;
					$col = 6;
					break;
				case '3':
					$col_mod = 3;
					$col = 4;
					break;
				case '6':
					$col_mod = 6;
					$col = 2;
					break;
				default:
					$col_mod = 4;
					$col = 3;
					break;
			}
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php
					$open = !($count%$col_mod) ? '<div class="row">' : '';
					$close = !($count%$col_mod) && $count ? '</div>' : '';
					echo $close.$open;
					?>

					<div class="product-item col-<?php echo $col; ?>">

						<?php wc_get_template_part( 'content', 'product' ); ?>

					</div>

					<?php $count++; ?>

				<?php endwhile; // end of the loop. ?>

				<?php echo $count ? '</div>' : ''; ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php endif;

		wp_reset_postdata();

		return '<div class="woocommerce shortcode-row">' . ob_get_clean() . '</div>';
	}
}

/**
 * Filter tag cloud
 */

if (!function_exists('lollum_product_tag_cloud_args')) {
	function lollum_product_tag_cloud_args($args) {
		$args['largest'] = 10;
		$args['smallest'] = 10;
		$args['unit'] = 'px';
		return $args;
	}
}
add_filter('woocommerce_product_tag_cloud_widget_args', 'lollum_product_tag_cloud_args');