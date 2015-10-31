<?php
/**
 * Lollum
 * 
 * The Header for our theme
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?><!DOCTYPE html>
<?php
$responsive_check = ((get_option('lol_check_responsive')  == 'true') ? 'yes-responsive' : 'no-responsive');
$preloader_check = ((get_option('lol_check_preloader')  == 'true') ? 'lol-preloader-yes' : 'lol-preloader-no');
$animations_check = ((get_option('lol_check_animations')  == 'true') ? 'lol-animations-yes' : 'lol-animations-no');
$animations_touch_check = ((get_option('lol_check_animations_touch')  == 'true') ? 'lol-animations-touch-yes' : 'lol-animations-touch-no');
$animations_sticky_check = ((get_option('lol_check_sticky')  == 'true') ? 'lol-sticky-header-yes' : 'lol-sticky-header-no');
$animations_top_header_check = ((get_option('lol_check_top_header')  == 'true') ? 'lol-top-header-yes' : 'lol-top-header-no');
?>
<!--[if IE 8]> <html class="no-js lt-ie9 <?php echo $responsive_check.' '.$preloader_check.' '.$animations_check.' '.$animations_touch_check.' '.$animations_sticky_check.' '.$animations_top_header_check; ?>" <?php language_attributes();?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js <?php echo $responsive_check.' '.$preloader_check.' '.$animations_check.' '.$animations_touch_check.' '.$animations_sticky_check.' '.$animations_top_header_check; ?>" <?php language_attributes();?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<?php if (get_option('lol_check_responsive') == 'true') { ?>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<?php } ?>
	
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title('|', true, 'right');
	// Add the blog name.
	bloginfo('name');
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page())) {
		echo " | $site_description";
	}
	// Add a page number if necessary:
	if ($paged >= 2 || $page >= 2) {
		echo ' | ' . sprintf(__('Page %s', 'lollum'), max($paged, $page));
	}
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php // if (is_singular() && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
	<link rel="alternate" title="<?php printf(__('%s RSS Feed', 'lollum'), get_bloginfo('name')); ?>" href="<?php bloginfo('rss2_url'); ?>">
	<link rel="alternate" title="<?php printf(__('%s Atom Feed', 'lollum'), get_bloginfo('name')); ?>" href="<?php bloginfo('atom_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php if (get_option('lol_custom_favicon')) { ?>
		<link rel="shortcut icon" href="<?php echo get_option('lol_custom_favicon'); ?>">
	<?php } ?>
	<script>document.documentElement.className += " js";</script>
	<!-- BEGIN WP -->
	<?php wp_head(); ?>
	<!-- END WP -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js?ver=1.0" type="text/javascript"></script>
	<![endif]-->
</head>
<body <?php body_class();?>>

<?php
if (get_option('lol_check_preloader') == 'true') :
	if (wp_is_mobile() && get_option('lol_check_preloader_mobile') == 'true') {
		get_template_part('preloader');
	} else if (!wp_is_mobile()) {
		get_template_part('preloader');
	}
endif;
?>

<?php
$has_cart_header = (lollum_check_is_woocommerce() && (get_option('lol_check_cart_header') == 'true')) ? true : false;
?>

<!-- BEGIN wrap -->
<div id="wrap" class="<?php echo (get_option('lol_layout') == 'layout-boxed') ? 'boxed' : ''; ?>">

	<div id="header-wrap">

		<?php if (get_option('lol_check_top_header') == 'true') : ?>
		
		<div id="top-header">
			<div class="container">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-12 -->
					<div class="col-12">
						<div class="company-info">
							<?php if (get_option('lol_tel_company') != '') : ?>
								<div class="info"><i class="icon fa fa-phone"></i><?php echo get_option('lol_tel_company'); ?></div>
							<?php endif; ?>
							<?php if (get_option('lol_email_company') != '') : ?>
								<div class="info"><i class="icon fa fa-envelope"></i><a href="mailto:<?php echo get_option('lol_email_company'); ?>"><?php echo get_option('lol_email_company'); ?></a></div>
							<?php endif; ?>
						</div>
						<div class="top-header-nav">
							<?php if (get_option('lol_check_social_header') == 'true') : ?>
								<ul class="social-links">
									<?php if (get_option('lol_f_facebook') != '') : ?>
										<li><a class="lol-facebook" href="<?php echo get_option('lol_f_facebook'); ?>" title="Facebook">Facebook</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_twitter') != '') : ?>
										<li><a class="lol-twitter" href="<?php echo get_option('lol_f_twitter'); ?>" title="Twitter">Twitter</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_dribbble') != '') : ?>
										<li><a class="lol-dribbble" href="<?php echo get_option('lol_f_dribbble'); ?>" title="Dribbble">Dribbble</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_linkedin') != '') : ?>
										<li><a class="lol-linkedin" href="<?php echo get_option('lol_f_linkedin'); ?>" title="Linkedin">Linkedin</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_flickr') != '') : ?>
										<li><a class="lol-flickr" href="<?php echo get_option('lol_f_flickr'); ?>" title="Flickr">Flickr</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_tumblr') != '') : ?>
										<li><a class="lol-tumblr" href="<?php echo get_option('lol_f_tumblr'); ?>" title="Tumblr">Tumblr</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_vimeo') != '') : ?>
										<li><a class="lol-vimeo" href="<?php echo get_option('lol_f_vimeo'); ?>" title="Vimeo">Vimeo</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_vine') != '') : ?>
										<li><a class="lol-vine" href="<?php echo get_option('lol_f_vine'); ?>" title="Vine">Vine</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_youtube') != '') : ?>
										<li><a class="lol-youtube" href="<?php echo get_option('lol_f_youtube'); ?>" title="Youtube">Youtube</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_instagram') != '') : ?>
										<li><a class="lol-instagram" href="<?php echo get_option('lol_f_instagram'); ?>" title="Instagram">Instagram</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_google') != '') : ?>
										<li><a class="lol-google" href="<?php echo get_option('lol_f_google'); ?>" title="Google Plus">Google Plus</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_stumbleupon') != '') : ?>
										<li><a class="lol-stumbleupon" href="<?php echo get_option('lol_f_stumbleupon'); ?>" title="StumbleUpon">StumbleUpon</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_forrst') != '') : ?>
										<li><a class="lol-forrst" href="<?php echo get_option('lol_f_forrst'); ?>" title="Forrst">Forrst</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_behance') != '') : ?>
										<li><a class="lol-behance" href="<?php echo get_option('lol_f_behance'); ?>" title="Behance">Behance</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_digg') != '') : ?>
										<li><a class="lol-digg" href="<?php echo get_option('lol_f_digg'); ?>" title="Digg">Digg</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_delicious') != '') : ?>
										<li><a class="lol-delicious" href="<?php echo get_option('lol_f_delicious'); ?>" title="Delicious">Delicious</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_deviantart') != '') : ?>
										<li><a class="lol-deviantart" href="<?php echo get_option('lol_f_deviantart'); ?>" title="DeviantArt">DeviantArt</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_foursquare') != '') : ?>
										<li><a class="lol-foursquare" href="<?php echo get_option('lol_f_foursquare'); ?>" title="Foursquare">Foursquare</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_github' )!= '') : ?>
										<li><a class="lol-github" href="<?php echo get_option('lol_f_github'); ?>" title="GitHub">GitHub</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_myspace') != '') : ?>
										<li><a class="lol-myspace" href="<?php echo get_option('lol_f_myspace'); ?>" title="MySpace">MySpace</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_orkut') != '') : ?>
										<li><a class="lol-orkut" href="<?php echo get_option('lol_f_orkut'); ?>" title="Orkut">Orkut</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_pinterest') != '') : ?>
										<li><a class="lol-pinterest" href="<?php echo get_option('lol_f_pinterest'); ?>" title="Pinterest">Pinterest</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_soundcloud') != '') : ?>
										<li><a class="lol-soundcloud" href="<?php echo get_option('lol_f_soundcloud'); ?>" title="SoundCloud">SoundCloud</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_stackoverflow') != '') : ?>
										<li><a class="lol-stackoverflow" href="<?php echo get_option('lol_f_stackoverflow'); ?>" title="Stack Overflow">Stack Overflow</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_skype') != '') : ?>
										<li><a class="lol-skype" href="skype:<?php echo get_option('lol_f_skype'); ?>?call" title="Skype">Skype</a></li>
									<?php endif; ?>
									<?php if (get_option('lol_f_rss') != '') : ?>
										<li><a class="lol-rss" href="<?php echo get_option('lol_f_rss'); ?>" title="RSS">RSS</a></li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>						
							<?php if (get_option('lol_check_menu_header') == 'true') : ?>
								<div class="top-header-menu block">
									<?php wp_nav_menu(array('theme_location' => 'top-header', 'depth' => -1)); ?>
								</div>
							<?php endif; ?>
							<?php if (get_option('lol_check_search_header') == 'true') : ?>
								<?php if (get_option('lol_type_search_header') == 'normal') { ?>
									<div class="header-search block">
										<div class="icon-search">
											<i class="fa fa-search"></i>
										</div>
										<?php get_search_form(); ?>
									</div>
								<?php } elseif (get_option('lol_type_search_header') == 'products' && lollum_check_is_woocommerce()) { ?>
									<div class="header-search block">
										<div class="icon-search">
											<i class="fa fa-search"></i>
										</div>
										<?php get_product_search_form(); ?>
									</div>
								<?php } ?>
							<?php endif; ?>
							<?php if ($has_cart_header) { ?>

								<?php global $woocommerce; ?>

								<div class="header-cart block">

									<div id="lol-header-cart">

										<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="cart-total"><?php _e('Basket', 'lollum'); ?> / <?php echo $woocommerce->cart->get_cart_total(); ?><i class="fa fa-shopping-cart"></i></a>

									</div>

								</div>

							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php endif; ?>

		<!-- BEGIN branding -->
		<header id="branding" role="banner">
			<div class="container">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-12 -->
					<div class="col-12">
						<!-- BEGIN #logo -->
						<div id="logo">
							<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
								<?php if (get_option('lol_custom_logo')): ?> 
									<img src="<?php echo get_option('lol_custom_logo'); ?>" alt="<?php bloginfo('name'); ?>" id="desktop-logo">
									<?php if (get_option('lol_custom_logo_retina')): ?>
										<img src="<?php echo get_option('lol_custom_logo_retina'); ?>" alt="<?php bloginfo('name'); ?>" id="retina-logo">
									<?php endif; ?>
								<?php else: ?>
									<h1 id="site-title"><?php bloginfo('name'); ?></h1>
								<?php endif; ?>
							</a>
						</div>

						<!-- BEGIN nav-menu -->
						<nav id="nav-menu" role="navigation">
							<?php // BEGIN screen reader links ?>
							<h3 class="assistive-text"><?php _e('Main menu', 'lollum'); ?></h3>
							<div class="skip-link">
								<a class="assistive-text" href="#content" title="<?php esc_attr_e('Skip to primary content', 'lollum'); ?>"><?php _e('Skip to primary content', 'lollum'); ?></a>
							</div>
							<div class="skip-link">
								<a class="assistive-text" href="#sidebar" title="<?php esc_attr_e('Skip to secondary content', 'lollum'); ?>"><?php _e('Skip to secondary content', 'lollum'); ?></a>
							</div>
							<?php // END screen reader links ?>

							<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'sf-menu', 'depth' => 3, 'walker' => new lollum_menu_walker())); ?>
						</nav>

						<nav id="mobile-nav-menu" class="<?php echo $ch = $has_cart_header ? 'cart-yes' : 'cart-no'; ?>" role="navigation">
							<div class="mobile-nav-menu-inner">
								<?php lollum_mobile_menu('primary'); ?>
							</div>
							<?php if ($has_cart_header) { ?>

								<?php global $woocommerce; ?>

								<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" id="icon-cart-menu"><i class="fa fa-shopping-cart"></i></a>

							<?php } ?>
						</nav>

					</div>
					<!-- END col-12 -->
				</div>
				<!-- END row -->
			</div>
		</header>
		<!-- END branding -->

	</div>
