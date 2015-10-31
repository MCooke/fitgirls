<?php
/**
 * Lollum
 * 
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>
<!-- BEGIN #post -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (has_post_thumbnail()) : ?>

	<div class="container">
		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-12 -->
			<div class="col-12">

				<!-- BEGIN .entry-thumbnail -->
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('page-thumb'); ?>
				</div>
				<!-- END .entry-thumbnail -->

			</div>
			<!-- END col-12 -->
		</div>
		<!-- END row -->
	</div>

	<?php endif; ?>

	<?php if (get_the_content() != '') { ?>

		<div class="container">
			<!-- BEGIN row -->
			<div class="row">
				<!-- BEGIN col-12 -->
				<div class="col-12">

					<!-- BEGIN .entry-conent -->
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<!-- END .entry-conent -->

				</div>
				<!-- END col-12 -->
			</div>
			<!-- END row -->
		</div>

	<?php } ?>

	<?php if (lollum_check_is_lollumframework() && (get_option('lolfmk_support_page_builder') == 'yes')) { ?>

		<!-- BEGIN .entry-page-items -->
		<div class="entry-page-items">
			<?php get_template_part('content/content', 'page-items'); ?>
		</div>
		<!-- END .entry-page-items -->

	<?php } ?>

</article>
<!-- END #post -->