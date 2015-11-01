<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Verdant
 */
?>

<article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'feature-large' );
		}
		?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
		<?php edit_post_link( __( 'Edit', 'verdant' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
