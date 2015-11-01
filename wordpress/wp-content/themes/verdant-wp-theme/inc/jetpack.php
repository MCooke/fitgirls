<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Verdant
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function verdant_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		// 'type' => 'click',
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'verdant_jetpack_setup' );


/**
 * Remove mobile theme from the Jetpack menu
 * See: http://jetpack.me/2013/08/22/load-only-a-specific-jetpack-module/
 */
// function verdant_jetpack_disable_mobile_theme( $modules ) {
//     unset( $modules['minileven'] );
//     return $modules;
// }
// add_filter( 'jetpack_get_available_modules', 'verdant_jetpack_disable_mobile_theme' );


/**
 * Add theme support for Portfolio Custom Post Type.
 * @see http://www.elegantthemes.com/blog/tips-tricks/what-you-need-to-know-about-the-new-portfolio-post-type-in-jetpack-3-1
 * @see http://en.support.wordpress.com/portfolios/portfolio-shortcode/
 */
function verdant_jetpack_portfolio_cpt() {
	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'verdant_jetpack_portfolio_cpt' );


/**
 * Make all videos responsive
 * @see http://www.elegantthemes.com/blog/tips-tricks/what-you-need-to-know-about-the-new-portfolio-post-type-in-jetpack-3-1
 * @see http://en.support.wordpress.com/portfolios/portfolio-shortcode/
 */
function verdant_jetpack_responsive_videos() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'verdant_jetpack_responsive_videos' );


/**
 * Make all videos responsive
 * @see http://jetpack.me/support/site-logo/
 */
function verdant_jetpack_site_logo() {
	$args = array(
	    'header-text' => array(
	        'site-title',
	        'site-description',
	    ),
	    'size' => 'full',
	);
	add_theme_support( 'site-logo', $args );
}
add_action( 'after_setup_theme', 'verdant_jetpack_site_logo' );


/**
 * Featured Content
 * @see http://jetpack.me/support/featured-content/
 */
function verdant_jetpack_featured_content() {
	add_theme_support( 'featured-content', array(
	    'filter'     => 'verdant_get_featured_posts',
	    'max_posts'  => 20,
	    'post_types' => array( 'post', 'page', 'jetpack-portfolio' ),
	) );
}
add_action( 'after_setup_theme', 'verdant_jetpack_featured_content' );

function verdant_get_featured_posts() {  
    return apply_filters( 'verdant_get_featured_posts', array() );  
}  

function verdant_has_featured_posts( $minimum = 1 ) {
    if ( is_paged() )
        return false;
 
    $featured_posts = apply_filters( 'verdant_get_featured_posts', array() );
 
    if ( ! is_array( $featured_posts ) )
        return false;
 
    if ( absint( $minimum ) > count( $featured_posts ) )
        return false;
 
    return true;
}



function verdant_jetpack_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	if ( get_post_type( $post_id ) == 'jetpack-portfolio' && $size == 'full' ) {
		$size = 'jetpack-portfolio';
		return get_the_post_thumbnail( $post_id, $size, $attr );
	}
	return $html;
}
add_filter( 'post_thumbnail_html', 'verdant_jetpack_post_thumbnail_html', 10, 5 );