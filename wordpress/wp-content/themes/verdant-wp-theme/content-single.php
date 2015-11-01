<?php
/**
 * @package Verdant
 */
?>

<article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class(); ?>>

	
	<header class="entry-header">
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
		
		verdant_entry_decor();
	
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'feature-large' );
		}
		
		verdant_entry_category();
		?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php verdant_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'verdant' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php verdant_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
