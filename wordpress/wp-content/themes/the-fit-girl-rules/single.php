<?php
/**
 * Lollum
 * 
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>



<?php } ?>

<!-- BEGIN #Single Post -->
<div id="page" class="no-responsive hfeed">

	<!-- BEGIN #main -->
	<div id="main" class="container">

		<!-- BEGIN row -->
		<div class="row">
			

			<?php
			if (get_option('lol_check_breadcumbs')  == 'true') {
				do_action('show_woo_breadcrumb');
			}
			?>


			<?php // START the loop ?>
			<?php while (have_posts()) : the_post(); ?>

				<?php if (has_post_thumbnail()) : ?>

					<div class="col-xs-12">
						
					</div>

				<?php endif; ?>
					<!-- BEGIN col-xs-12 col-sm-8 -->
				<div class="col-xs-12 col-sm-8">
					<!-- BEGIN #content -->
					<div id="content" role="main">

						<?php
						if ('aside' == get_post_format()) {
							get_template_part('content/content', 'single-aside');
						} elseif ('link' == get_post_format()) {
							get_template_part('content/content', 'single-link');
						} elseif ('status' == get_post_format()) {
							get_template_part('content/content', 'single-status');
						} elseif ('quote' == get_post_format()) {
							get_template_part('content/content', 'single-quote');
						} elseif ('gallery' == get_post_format()) {
							get_template_part('content/content', 'single-gallery');
						} elseif ('image' == get_post_format()) {
							get_template_part('content/content', 'single-image');
						} elseif ('video' == get_post_format()) {
							get_template_part('content/content', 'single-video');
						} elseif ('audio' == get_post_format()) {
							get_template_part('content/content', 'single-audio');
						} elseif ('chat' == get_post_format()) {
							get_template_part('content/content', 'single-chat');
						} else {
							get_template_part('content/content', 'single');
						}
						?>

						<?php comments_template(); ?>

					<?php endwhile; ?>
					<?php // END the loop ?>

				</div>

				<!-- END #content -->

			</div>
			<?php get_sidebar(); ?>
			<!-- END col-xs-12 col-sm-8 -->
		</div>
	</div>

	<!-- END #main -->
</div>


</div>
<!-- END #page -->

<?php get_footer(); ?>