<?php
/**
 * Lollum
 * 
 * The sidebar containing the secondary widget area, displays on shop pages (Woocommerce)
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<!-- BEGIN col-3 -->
<div class="side col-3">

	<!-- BEGIN #sidebar -->
	<div id="sidebar" role="complementary">
		<?php if (!dynamic_sidebar('Shop Sidebar')) : ?>
			<aside>
				<?php get_product_search_form(); ?>
			</aside>
		<?php endif; ?>
	</div>
	<!-- END #sidebar -->

<!-- END col-3 -->
</div>