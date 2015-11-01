<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Link post format
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
			<?php $ptype_link_url = get_post_meta($post->ID, 'lolfmkbox_link_url', true); ?>
			<h1 class="entry-title"><a href="<?php echo $ptype_link_url; ?>"><?php the_title(); ?></a></h1>
			<?php lollum_header_posts($ptype_link_url); ?>
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