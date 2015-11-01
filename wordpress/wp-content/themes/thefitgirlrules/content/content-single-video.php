<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Video post format (single)
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

		<!-- BEGIN .entry-video -->
		<div class="entry-video">
			
			<?php
			$embed = get_post_meta($post->ID, 'lolfmkbox_embed_video', true);
			if(!empty($embed)) {
				echo "<div class='video-frame'>";
				echo stripslashes(htmlspecialchars_decode($embed));
				echo "</div>";
			} else {
				lollum_show_video($post->ID);
			}
			?>

		</div>
		<!-- END .entry-video -->

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