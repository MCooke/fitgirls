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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-wrap">

		<!-- BEGIN .entry-header -->
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
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

	</div>

</article>
<!-- END #post -->