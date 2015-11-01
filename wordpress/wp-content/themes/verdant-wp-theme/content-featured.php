<?php
/**
 * @package Verdant
 */


$featuredPosts = verdant_get_featured_posts();
?>

<div class="featured-content featured11-num-<?php echo count( $featuredPosts ) ?>">
	<?php

    foreach ( $featuredPosts as $post ) : setup_postdata( $post ); ?>
	
		<a href="<?php echo esc_url( get_permalink() ) ?>" title="<?php esc_attr( the_title() ); ?>" class='featured-item'>
	        <figure>
	            <?php the_post_thumbnail( 'featured-content' ); ?>
	            <figcaption>
					<span>
					<?php
					foreach( get_the_category() as $key => $category ) {
						echo $key > 0 ? ', ' : '';
						echo $category->cat_name;
					}
					?>
					</span>
					<h4><?php esc_html( the_title() ) ?></h4>
				</figcaption>
	            <?php //the_excerpt(); ?>
	        </figure><!-- .slide -->
		</a>
		
    <?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
</div><!-- .featured-content -->