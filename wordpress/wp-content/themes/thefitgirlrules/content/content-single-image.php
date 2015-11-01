<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Image post format (single)
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

		<?php
		$embed = get_post_meta($post->ID, 'lolfmkbox_embed_image', true);
		if(!empty($embed)) {
			echo '<div class="entry-image">';
			echo stripslashes(htmlspecialchars_decode($embed));
			echo '</div>';
		} else {
			$p_image_url = get_post_meta($post->ID, 'lolfmkbox_p_image_url', true);
			$p_image_alt = get_post_meta($post->ID, 'lolfmkbox_p_image_alt', true);
			$p_image_w = get_post_meta($post->ID, 'lolfmkbox_p_image_w', true);
			$p_image_h = get_post_meta($post->ID, 'lolfmkbox_p_image_h', true);
			?>
			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<img src="<?php echo $p_image_url; ?>" alt="<?php echo $p_image_alt; ?>" width="<?php echo $p_image_w; ?>" height="<?php echo $p_image_h; ?>">
				</a>
			</div>
		<?php } ?>

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