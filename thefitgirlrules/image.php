<?php
/**
 * Lollum
 * 
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<?php get_header(); ?>

<div id="page-title-wrap">
	<div class="container">
		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-12 -->
			<div class="col-12">
				<div class="page-title">
					<h1><?php the_title(); ?></h1>
					<?php lollum_breadcrumb(); ?>
				</div>
			</div>
			<!-- END col-12 -->
		</div>
		<!-- END row -->
	</div>
</div>

<!-- BEGIN #page -->
<div id="page" class="hfeed">

<!-- BEGIN #main -->
<div id="main" class="container">

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-12">
	
			<!-- BEGIN #content -->
			<div id="content" class="attachment-template" role="main">
				
				<?php // START the loop ?>
				<?php while (have_posts()) : the_post(); ?>
					
					<!-- BEGIN #post -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
						<!-- BEGIN #image-navigation -->
						<nav id="image-navigation">
							<span class="previous-image"><?php previous_image_link(false, __('Previous' , 'lollum')); ?></span>
							<span class="next-image"><?php next_image_link(false, __('Next' , 'lollum')); ?></span>
						</nav>
						<!-- END #image-navigation -->

						<!-- BEGIN .entry-content -->
						<div class="entry-content">
							
							<!-- BEGIN .entry-attachment -->
							<div class="entry-attachment">
								<div class="attachment">
									<?php
									$attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));
									foreach ($attachments as $k => $attachment) {
										if ($attachment->ID == $post->ID)
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if (count($attachments) > 1) {
										if (isset($attachments[$k]))
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link($attachments[$k]->ID);
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link($attachments[0]->ID);
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
									?>

									<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment">
										<?php
										$attachment_size = apply_filters('lollum_attachment_size', 1170);
										$original_src = wp_get_attachment_image_src($post->ID, array($attachment_size, $attachment_size));
										?>
										<?php echo wp_get_attachment_image($post->ID, array($attachment_size, $attachment_size)); ?>
									</a>
								</div>

								<?php if (!empty($post->post_excerpt)) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div>
							<!-- END .entry-attachment -->

							<?php if (get_the_content() != '') { ?>
								<div class="attachment-description">
									<?php the_content(); ?>
								</div>
							<?php } ?>

						</div>
						<!-- END .entry-content -->

					</article>
					<!-- END #post -->

				<?php endwhile; ?>
				<?php // END the loop ?>

			</div>
			<!-- END #content -->

		</div>
		<!-- END col-12 -->
	<!-- END row -->
	</div>

<!-- END #main -->
</div>

</div>
<!-- END #page -->

<?php get_footer(); ?>