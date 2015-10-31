<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Status post format
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
			<?php lollum_header_posts(); ?>
		</header>
		<!-- END .entry-header -->

		<!-- BEGIN .entry-conent -->
		<div class="entry-content">
			<div class="entry-avatar">
				<?php echo get_avatar(get_the_author_meta('email'), $size='50'); ?>
			</div>

			<div class="entry-status">
				<h3><?php the_author(); ?></h3>
				<?php the_content('Read more'); ?>
			</div>
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

	</div>

</article>
<!-- END #post -->