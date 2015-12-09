<?php
/**
 * Lollum
 * 
 * The sidebar containing the secondary widget area, displays on single products
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<!-- BEGIN col-3 -->
<div class="side col-xs-4">

	<!-- BEGIN #sidebar -->
	<div id="sidebar" class="product-sidebar" role="complementary">
		<?php if (!dynamic_sidebar('Product Sidebar')) : ?>
			<aside>
				<?php get_product_search_form(); ?>
			</aside>
		<?php endif; ?>
	</div>
	<!-- END #sidebar -->

<!-- END col-3 -->
</div>