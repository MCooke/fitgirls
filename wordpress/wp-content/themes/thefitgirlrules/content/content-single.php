<?php
/**
 * Lollum
 * 
 * The default template for displaying content. Used for both single and index/archive/search
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<!-- BEGIN #post -->
<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>

	<div class="post-wrap">

		<!-- BEGIN .entry-thumbnail -->
		<?php if (has_post_thumbnail()) : ?>

			<div class="entry-thumbnail">
			   <?php the_post_thumbnail('post-thumb'); ?>
			</div>

		<?php endif; ?>
		<!-- END .entry-thumbnail -->

		<!-- BEGIN .entry-header -->
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php lollum_header_posts(); ?>
		</header>
		<!-- END .entry-header -->

		<!-- BEGIN .entry-conent -->
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<!-- END .entry-conent -->

                <div class="post-share">
                  Share This On &nbsp; &nbsp;
                  <a href="http://www.facebook.com/share.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>"><i class="fa-facebook fa"></i></a>
                  <a href="http://twitter.com/home?status=<?php print(urlencode(get_permalink())); ?>+<?php print(urlencode(the_title())); ?>" title="twitter" rel="nofollow" target="_blank"><i class="fa-twitter fa"></i></a>
                  <a href="mailto:?body=<?php print(urlencode(get_permalink())); ?>&subject=<?php print(urlencode(the_title())); ?>"><i class="fa-envelope fa"></i></a>
                </div>

		<?php
		global $multipage;
		if ($multipage) {
			echo '<div class="pagelink">';
			wp_link_pages(array('next_or_number'=>'next', 'previouspagelink' => '&laquo;', 'nextpagelink'=>'&raquo;'));
			echo '</div>';
		}
		?>

		<!-- BEGIN footer .entry-meta -->
		<?php lollum_footer_posts($post->ID); ?>
		<!-- END footer .entry-meta -->

	</div>

</article>
<!-- END #post -->

<?php
if ((get_option('lol_check_author_bio') == 'true') && (get_post_meta($post->ID, 'lolbox_check_author_bio', true) != 'yes')) {

	lollum_author_bio();

} ?>