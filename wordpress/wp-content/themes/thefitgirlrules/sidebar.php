<?php
/**
 * Lollum
 * 
 * The sidebar containing the secondary widget area, displays on posts
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

	<!-- BEGIN col-xs-3 -->
	<div class="col-xs-12 col-sm-3">

		<!-- BEGIN #sidebar -->
		<div id="sidebar" role="complementary">
			<!-- BEGIN sidebar -->
			<?php if (!dynamic_sidebar('Main Sidebar')) : ?>
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
			<?php endif; ?>
			<!-- END sidebar -->
		</div>
		<!-- END #sidebar -->

	<!-- END col-xs-3 -->
	</div>

<!-- END row -->
</div>