<?php
/**
 * Lollum
 * 
 * The template for displaying Category pages.
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

<?php // START if have posts ?>
<?php if (have_posts()) : ?>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container">

		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-xs-9 -->
			<div class="col-xs-9">

                            <?php
		              if (get_option('lol_check_breadcumbs')  == 'true') {
		                do_action('show_woo_breadcrumb');
			      }
		            ?>

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