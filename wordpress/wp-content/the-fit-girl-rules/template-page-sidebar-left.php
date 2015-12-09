<?php
/**
 * Lollum
 * 
 * The Template for displaying pages with sidebar left
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
/*
Template Name: Template Page Sidebar (Left)
*/
?>

<?php get_header(); ?>

<?php } ?>
if(function_exists('putRevSlider')) {
	if (get_post_meta($post->ID, 'lolfmkbox_slider_rev_alias', true)) {
		$slider_selected = get_post_meta($post->ID, 'lolfmkbox_slider_rev_alias', true); ?>
		
		<div class="page-slider header-slider">
			<?php putRevSlider(''.$slider_selected.''); ?>

			<?php if (get_post_meta($post->ID, 'lolfmkbox_page_link_slider', true)) { ?>
			<div class="link-slider">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<a href="#page"><?php echo get_post_meta($post->ID, 'lolfmkbox_page_link_slider', true); ?><i class="fa fa-chevron-circle-down"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>

		<?php
	} 
} ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>

	<div id="page-title-wrap">
		<div class="container">
			<!-- BEGIN row -->
			<div class="row">
				<!-- BEGIN col-12 -->
				<div class="col-12">
					<div class="page-title">
						<h1><?php the_title(); ?></h1>
						<?php lollum_breadcrumb(); ?>
					</div>
				</div>
				<!-- END col-12 -->
			</div>
			<!-- END row -->
		</div>
	</div>

<?php } ?>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container sidebar-left">

	<?php // START the loop ?>
	<?php while (have_posts()) : the_post(); ?>

	<?php if (has_post_thumbnail()) : ?>

		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-12 -->
			<div class="col-12">

				<!-- BEGIN .entry-thumbnail -->
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('page-thumb'); ?>
				</div>
				<!-- END .entry-thumbnail -->

			<!-- END col-12 -->
		</div>
	<!-- END row -->
	</div>

	<?php endif; ?>
	
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-9 -->
		<div class="cont col-9">

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
		<!-- END col-9 -->

	<?php endwhile; ?>
	<?php // END the loop ?>

		<!-- BEGIN col-3 -->
		<div class="side col-3">

			<!-- BEGIN #secondary -->
			<div id="sidebar" role="complementary">
				<!-- BEGIN sidebar -->

				<<?php get_sidebar(); ?>
					
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

</div>
<!-- END #page -->

<?php get_footer(); ?>