<?php
/**
 * Lollum
 * 
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
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
			<!-- BEGIN col-xs-12 -->
			<div class="col-xs-12">
				<div class="page-title">
					<h1>
					<?php
						if (get_option('lol_headline_blog')) {
							echo get_option('lol_headline_blog');
						} else {
							echo 'Blog';
						} ?>
					</h1>
					<?php lollum_breadcrumb(); ?>
				</div>
			</div>
			<!-- END col-xs-12 -->
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
			
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-xs-12 col-sm-9 -->
		<div class="col-xs-12 col-sm-9">

			<!-- BEGIN #content -->
			<div id="content" role="main">
		
				<?php // START the loop ?>
				<?php while (have_posts()) : the_post(); ?>

					<?php get_template_part('content/content', get_post_format()); ?>

				<?php endwhile; ?>
				<?php // END the loop ?>

				<?php lollum_pagination(); ?>

				<?php // lollum_pagination_default(); ?>

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-xs-12 col-sm-9 -->

<?php // if no results ?>
<?php else : ?>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container">
			
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-xs-12 col-sm-9 -->
		<div class="col-xs-12 col-sm-9">

			<!-- BEGIN #content -->
			<div id="content" role="main">
		
				<!-- BEGIN #post-0 -->
				<article id="post-0" class="post error404 not-found">
					<div class="entry-content">
						
						<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'lollum'); ?></p>

					</div>
				</article>
				<!-- END #post-0 -->

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-xs-12 col-sm-9 -->

	<?php endif; ?>
	<?php // END if have posts ?>

	<?php get_sidebar(); ?>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>