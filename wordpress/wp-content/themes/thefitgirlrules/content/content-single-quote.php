<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Quote post format
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

		<!-- BEGIN .entry-header -->
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php lollum_header_posts(); ?>
		</header>
		<!-- END .entry-header -->

		<!-- BEGIN .entry-conent -->
		<div class="entry-content">
			<?php
			$ptype_author_quote = get_post_meta($post->ID, 'lolfmkbox_author_quote', true);
			$ptype_source_quote = get_post_meta($post->ID, 'lolfmkbox_source_quote', true);
			?>
			<figure class="quote">
				<blockquote>
					<?php the_content(); ?>
				</blockquote>
				<figcaption class="quote-caption">
					<?php if ($ptype_source_quote != '') { ?>
						<a href="<?php echo $ptype_source_quote; ?>">
							<?php echo $ptype_author_quote; ?>
						</a>
					<?php } else { ?>
						<?php echo $ptype_author_quote; ?>
					<?php } ?>
				</figcaption>
			</figure>
		</div>
		<!-- END .entry-conent -->

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