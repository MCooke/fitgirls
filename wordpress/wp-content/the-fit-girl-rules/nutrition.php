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
/*
Template Name: Nutrition
*/
?>

<?php get_header(); ?>

<?php if (!get_post_meta($post->ID, 'lolfmkbox_headline_check', true) == 'yes') { ?>



        <img class="nutrition-banner" src="http://www.thefitgirlrules.com/images/banners/nutrition-banner.jpg" width="100%">

	<h1><?php the_title(); ?></h1>

<?php } ?>

<!-- BEGIN #Nutrition Page template -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main">
	
	<?php // START the loop ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php if (get_post_meta($post->ID, 'lolfmkbox_page_margin_check', true) == 'yes') {
			$lol_page_margin = 'no-margin';
		} else {
			$lol_page_margin = '';
		} ?>

		<!-- BEGIN #content -->
		<div id="content" class="<?php echo $lol_page_margin; ?>" role="main">

			<?php get_template_part('content/content', 'page'); ?>

		</div>
		<!-- END #content -->
				
	<?php endwhile; ?>
	<?php // END the loop ?>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>