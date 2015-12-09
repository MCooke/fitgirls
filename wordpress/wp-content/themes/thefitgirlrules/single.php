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

<div id="page-title-wrap">
	<div class="container">
		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-xs-12 -->
			<div class="col-xs-12">
				<div class="page-title">
					<h1><?php the_title(); ?></h1>
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
	
	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-xs-12 col-sm-9 -->
		<div class="col-xs-12 col-sm-9">
	
			<!-- BEGIN #content -->
			<div id="content" role="main">
				
				<?php // START the loop ?>
				<?php while (have_posts()) : the_post(); ?>

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

					comments_template('', true); ?>

				<?php endwhile; ?>
				<?php // END the loop ?>

			</div>
			<!-- END #content -->
	
		</div>
		<!-- END col-xs-12 col-sm-9 -->

			<?php get_sidebar(); ?>
</div>

<!-- END #main -->
</div>


<!-- END #page -->

<?php get_footer(); ?>