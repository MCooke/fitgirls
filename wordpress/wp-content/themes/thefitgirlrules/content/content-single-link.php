<?php
/**
 * Lollum
 * 
 * The template for displaying posts in the Link post format (single)
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
			<?php $ptype_link_url = get_post_meta($post->ID, 'lolfmkbox_link_url', true); ?>
			<h1 class="entry-title"><a href="<?php echo $ptype_link_url; ?>"><?php the_title(); ?></a></h1>
			<?php lollum_header_posts($ptype_link_url); ?>
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