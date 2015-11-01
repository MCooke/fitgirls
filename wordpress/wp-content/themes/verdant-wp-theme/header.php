<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Verdant
 */

global $verdant_titan;
if ( class_exists( 'TitanFramework' ) ) {
	$verdant_titan = TitanFramework::getInstance( 'verdant' );
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'verdant' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div id="masthead-top-wrapper">
			<div id="masthead-top">
				<span class='site-description'><?php esc_html( bloginfo( 'description' ) ); ?></span>
				<?php
				if ( ! class_exists( 'TitanFramework' ) || $verdant_titan->getOption( 'topbar_search_enable' ) ) :
					?>
					<a href='#' class="top-search genericon genericon-search"></a>
					<?php get_search_form( true ) ?>
				<?php
				endif;
				?>
				<span class='social-navigation'><?php verdant_create_social_icons() ?></span>
			</div>
		</div>
		<div id="masthead-main-wrapper">
			<div id="masthead-main">
				<div class="site-branding">
					<?php
					if ( class_exists( 'TitanFramework' ) ) {
						if ( ! $verdant_titan->getOption( 'logo_frontpage_feature' ) || ! is_front_page() ) :
							if ( function_exists( 'jetpack_the_site_logo' ) ) {
								jetpack_the_site_logo();
							} else {
								?>
								<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h3>
								<?php
							}
						?>
						<!-- <h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3> -->
						<?php
						endif;
					} else {
						if ( function_exists( 'jetpack_the_site_logo' ) ) {
							jetpack_the_site_logo();
						} else {
							?>
							<h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h3>
							<?php
						}
					}
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><span class="genericon genericon-menu"></span></button>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav><!-- #site-navigation -->
				<div style="clear: both"></div>
			</div>
		</div>
	</header><!-- #masthead -->
	
	<?php 
	if ( is_front_page() ) {
		verdant_feature_logo();
	}
	?>

	<div id="content" class="site-content">
