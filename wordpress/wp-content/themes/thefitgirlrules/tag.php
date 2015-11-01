<?php
/**
 * Lollum
 * 
 * The Template for displaying Tag pages
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<?php get_header(); ?>

<?php // START if have posts ?>
<?php if (have_posts()) : ?>

<div id="page-title-wrap">
	<div class="container">
		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-xs-12 -->
			<div class="col-xs-12">
				<div class="page-title">
					<h1>
						<?php printf(__('Tag Archives: %s', 'lollum'), '<span>' . single_tag_title('', false) . '</span>'); ?>
					</h1>
					<?php lollum_breadcrumb(); ?>
				</div>
			</div>
			<!-- END col-xs-12 -->
		</div>
		<!-- END row -->
	</div>
</div>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container">

		<?php rewind_posts(); ?>

		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-xs-9 -->
			<div class="col-xs-9">

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
			<!-- END col-xs-9 -->

	<?php endif; ?>
	<?php // END if have posts ?>

	<?php get_sidebar(); ?>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>