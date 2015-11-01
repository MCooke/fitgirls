<?php
/**
 * @package Verdant
 */

$displayPostTitleDecor = 'posts' == get_option( 'show_on_front' ) 
	|| ( 'page' == get_option( 'show_on_front' ) && ! is_front_page() );
?>
<article id="post-<?php esc_attr( the_ID() ); ?>" <?php post_class(); ?>>
	
	<?php
	if ( $displayPostTitleDecor ) {
		verdant_entry_decor();
	}
	
	if ( has_post_thumbnail() ) {
		echo '<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_title() ) . '">';
		the_post_thumbnail( 'feature-large' );
		echo '</a>';
	}
	?>
	
	<?php
	if ( $displayPostTitleDecor ) :
	?>
	<header class="entry-header">
		<?php
		verdant_entry_category();
		?>
		
		<?php
		the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php verdant_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php
	endif;
	?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'verdant' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

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