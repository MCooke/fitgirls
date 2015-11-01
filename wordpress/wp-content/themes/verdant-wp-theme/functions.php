<?php
/**
 * Verdant functions and definitions
 *
 * @package Verdant
 */

defined( 'VERSION_VERDANT' ) or define( 'VERSION_VERDANT', '1.2' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 920; /* pixels */
}

if ( ! function_exists( 'verdant_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function verdant_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Verdant, use a find and replace
	 * to change 'verdant' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'verdant', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 400, 225, true );
	add_image_size( 'feature-large', 920, 450, true );
	add_image_size( 'featured-content', 600, 360, true );
	add_image_size( 'jetpack-portfolio', 600, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'verdant' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'gallery', 'status', 'image', 'video', 'quote', 'link', 'audio', 'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'verdant_custom_background_args', array(
		'default-color' => '#ECF0F1',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'woocommerce' );
}
endif; // verdant_setup
add_action( 'after_setup_theme', 'verdant_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function verdant_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'verdant' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'The general sidebar that appears through the whole site', 'verdant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'verdant' ),
		'id'            => 'footer-1',
		'description'   => __( 'The left footer widget area', 'verdant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'verdant' ),
		'id'            => 'footer-2',
		'description'   => __( 'The middle footer widget area', 'verdant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'verdant' ),
		'id'            => 'footer-3',
		'description'   => __( 'The right footer widget area', 'verdant' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'verdant_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function verdant_scripts() {
	$deps = array( 'jquery' );
	
	wp_enqueue_style( 'verdant-style', get_stylesheet_uri() );
	
	// Use our copy of genericons instead of Jetpack's since we are using a newer version
	// wp_deregister_style( 'genericons' );

	if ( ! wp_script_is( 'genericons', 'registered' ) ) {
		wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css' );
	}
	
	if ( verdant_has_featured_posts( 3 ) && is_front_page() ) {
		wp_enqueue_script( 'gambit-owl-carousel', get_template_directory_uri() . '/js/min/owl.carousel-min.js', array(), VERSION_VERDANT, true );
		wp_enqueue_style( 'gambit-owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), VERSION_VERDANT );
		wp_enqueue_style( 'gambit-owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), VERSION_VERDANT );
		$deps[] = 'gambit-owl-carousel';
	}
	
	if ( ! class_exists( 'TitanFramework' ) ) {
		wp_enqueue_style( 'tf-google-webfont-unica-one-css', '//fonts.googleapis.com/css?family=Unica+One%3A400&#038;subset=latin%2Clatin-ext' );
		wp_enqueue_style( 'tf-google-webfont-roboto-slab-css', '//fonts.googleapis.com/css?family=Roboto+Slab%3A100%2C400&#038;subset=latin%2Clatin-ext' );
		wp_enqueue_style( 'tf-google-webfont-open-sans-css', '//fonts.googleapis.com/css?family=Open+Sans%3A400&#038;subset=latin%2Clatin-ext' );
		wp_enqueue_style( 'tf-google-webfont-neuton-css', '//fonts.googleapis.com/css?family=Neuton%3A200%2C400&#038;subset=latin%2Clatin-ext' );
	}

	wp_enqueue_script( 'verdant-navigation', get_template_directory_uri() . '/js/navigation.js', array(), VERSION_VERDANT, true );
	
	wp_enqueue_script( 'verdant', get_template_directory_uri() . '/js/min/script-min.js', $deps, VERSION_VERDANT, true );

	wp_enqueue_script( 'verdant-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), VERSION_VERDANT, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'verdant_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load TGM Plugin Activation
 */
require get_template_directory() . '/tgm-plugin-activation.php';

/**
 * Load Titan Framework plugin checker
 */
require get_template_directory() . '/titan-framework-checker.php';

/**
 * Load Titan Framework options
 */
require get_template_directory() . '/titan-options.php';