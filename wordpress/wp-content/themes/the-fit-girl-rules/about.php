<?php

/*

Template Name:     About

*/

?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>

<?php } ?>

<!-- BEGIN #About Page -->
<div id="page" class="no-responsive hfeed">

<!-- BEGIN #main -->
<div id="main" class="container sidebar-right">

	<?php // START the loop ?>
	<?php while (have_posts()) : the_post(); ?>
	
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-xs-12 col-sm-8 -->
		<div class="col-xs-12 col-sm-8">

                    <?php
		        if (get_option('lol_check_breadcumbs')  == 'true') {
		          do_action('show_woo_breadcrumb');
			}
		    ?>

			<!-- BEGIN #content -->
			<div id="content" role="main">



				<!-- BEGIN #post -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- BEGIN .entry-conent -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<!-- END .entry-conent -->

				</article>
				<!-- END #post -->

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-xs-12 col-sm-8 -->
           <?php get_sidebar(); ?>
	<?php endwhile; ?>
	<?php // END the loop ?>


<!-- END #main -->
</div>

</div>
<!-- END #page -->
<hr class="recipe-single-seperator" />
<h2 style="text-align: center;"><span face="Oswald" style="font-family: Oswald; color: #91d4c3;">INSTAGRAM FEED</h2>
<!-- SnapWidget -->
<script src="http://snapwidget.com/js/snapwidget.js"></script>
<iframe src="http://snapwidget.com/p/widget/?id=z2sKUMZXuk&t=851" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe>

<?php get_footer(); ?>