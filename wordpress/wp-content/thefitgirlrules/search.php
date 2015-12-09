<?php
/**
 * Lollum
 * 
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<?php get_header(); ?>

<div id="page-title-wrap">
	<div class="container">
		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-12 -->
			<div class="col-12">
				<div class="page-title">
					<h1>
						<?php printf(__('Search Results for: %s', 'lollum'), '<span>' . get_search_query() . '</span>'); ?>
					</h1>
					<?php lollum_breadcrumb(); ?>
				</div>
			</div>
			<!-- END col-12 -->
		</div>
		<!-- END row -->
	</div>
</div>

<?php // START if have posts ?>
<?php if (have_posts()) : ?>

	<!-- BEGIN #page -->
	<div id="page" class="hfeed">

	<!-- BEGIN #main -->
	<div id="main" class="container">

		<?php rewind_posts(); ?>

		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-9 -->
			<div class="col-9">

				<!-- BEGIN #content -->
				<div id="content" role="main">

					<?php // START the loop ?>
					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('content/content', get_post_format()); ?>

					<?php endwhile; ?>
					<?php // END the loop ?>

				<?php lollum_pagination(); ?>

				</div>
				<!-- END #content -->

			</div>
			<!-- END col-9 -->

<?php // if no results ?>
<?php else : ?>

	<!-- BEGIN #page -->
	<div id="page" class="hfeed">

	<!-- BEGIN #main -->
	<div id="main" class="container">

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-9 -->
		<div class="col-9">

			<!-- BEGIN #content -->
			<div id="content" role="main">
		
				<!-- BEGIN #post-0 -->
				<article id="post-0" class="post no-results not-found">
					<div class="entry-content">
						<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lollum'); ?></p>
					</div>
				</article>
				<!-- END #post-0 -->

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-9 -->

<?php endif; ?>
<?php // END if have posts ?>

	<?php get_sidebar(); ?>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>