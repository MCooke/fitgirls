<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Verdant
 */

global $verdant_titan;
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		get_sidebar( 'footer' );
		?>
		
		<div class="site-info-container">
			<div class="site-info">
				<?php
				if ( class_exists( 'TitanFramework' ) ) {
					echo $verdant_titan->getOption( 'footer_copyright_text' );
				}
				?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php 
	if ( get_header_image() 
		&& ( ! class_exists( 'TitanFramework' ) || ( ! $verdant_titan->getOption( 'header_image_frontpage_only' ) 
			|| ( is_front_page() && $verdant_titan->getOption( 'header_image_frontpage_only' ) ) ) ) ) : ?>
	<div id="header-image">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</div>
	<?php endif; // End header image check. ?>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
