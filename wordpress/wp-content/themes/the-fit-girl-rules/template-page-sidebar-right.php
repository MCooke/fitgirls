<?php
/**
 * Lollum
 * 
 * The Template for displaying pages with sidebar right
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
/*
Template Name: Template Page Sidebar (Right)
*/
?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>



<?php } ?>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container sidebar-right">

	<?php // START the loop ?>
	<?php while (have_posts()) : the_post(); ?>
	
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-9 -->
		<div class="col-xs-12 col-sm-9">

                    <?php
		        if (get_option('lol_check_breadcumbs')  == 'true') {
		          do_action('show_woo_breadcrumb');
			}
		    ?>

			<!-- BEGIN #content -->
			<div id="content" role="main">

                 	    <h1><?php the_title(); ?></h1>

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
		<!-- END col-9 -->

	<?php endwhile; ?>
	<?php // END the loop ?>

		<!-- BEGIN col-3 -->
		<div class="col-xs-3">

			<!-- BEGIN #secondary -->
			<div id="sidebar"role="complementary">
				<!-- BEGIN sidebar -->
				<?php if (!dynamic_sidebar('Page Sidebar')) : ?>
					<aside id="search" class="widget widget_search">
						<?php get_search_form(); ?>
					</aside>
				<?php endif; ?>
				<!-- END sidebar -->
			</div>
			<!-- END #secondary -->

		<!-- END col-3 -->
		</div>

	<!-- END row -->
	</div>

<!-- END #main -->
</div>


<!-- END #page -->

<?php get_footer(); ?>