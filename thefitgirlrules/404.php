<?php
/**
 * Lollum
 * 
 * The template for displaying 404 pages (Not Found)
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
					<h1><?php _e('404 Error', 'lollum'); ?></h1>
					<?php lollum_breadcrumb(); ?>
				</div>
			</div>
			<!-- END col-12 -->
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
		<!-- BEGIN col-12 -->
		<div class="col-12">
	
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
		<!-- END col-12 -->
	<!-- END row -->
	</div>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>