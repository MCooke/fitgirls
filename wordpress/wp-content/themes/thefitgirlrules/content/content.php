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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-wrap">

		<!-- BEGIN .entry-thumbnail -->
		<?php if (has_post_thumbnail()) : ?>

			<div class="entry-thumbnail">
			   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			   	<?php the_post_thumbnail('post-thumb'); ?>
			   </a>
			</div>

		<?php endif; ?>
		<!-- END .entry-thumbnail -->

		<!-- BEGIN .entry-header -->
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'lollum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php lollum_header_posts(); ?>
		</header>
		<!-- END .entry-header -->

		<?php if (is_search()) : // Only display Excerpts for Search ?>

			<!-- BEGIN .entry-summary -->
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
			<!-- END .entry-summary -->

		<?php else : ?>

			<!-- BEGIN .entry-conent -->
			<div class="entry-content">
				<?php the_content('More', 'lollum'); ?>
			</div>
			<!-- END .entry-conent -->

			<?php
			global $multipage, $more;
			$more = true;
			if ($multipage) {
				echo '<div class="pagelink">';
				wp_link_pages(array('next_or_number'=>'next', 'previouspagelink' => '&laquo;', 'nextpagelink'=>'&raquo;'));
				echo '</div>';
			}
			$more = 0;
			?>

		<?php endif; ?>

	</div>

</article>
<!-- END #post -->