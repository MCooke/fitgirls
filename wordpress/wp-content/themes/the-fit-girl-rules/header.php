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
?>

<!DOCTYPE html>

<?php
$animations_check = ((get_option('lol_check_animations')  == 'true') ? 'lol-animations-yes' : 'lol-animations-no');
$animations_touch_check = ((get_option('lol_check_animations_touch')  == 'true') ? 'lol-animations-touch-yes' : 'lol-animations-touch-no');
$animations_sticky_check = ((get_option('lol_check_sticky')  == 'true') ? 'lol-sticky-header-yes' : 'lol-sticky-header-no');
$animations_top_header_check = ((get_option('lol_check_top_header')  == 'true') ? 'lol-top-header-yes' : 'lol-top-header-no');
?>

<!--[if IE 8]> <html class="no-js lt-ie9 <?php echo $responsive_check.' '.$preloader_check.' '.$animations_check.' '.$animations_touch_check.' '.$animations_sticky_check.' '.$animations_top_header_check; ?>" <?php language_attributes();?>> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js <?php echo $responsive_check.' '.$preloader_check.' '.$animations_check.' '.$animations_touch_check.' '.$animations_sticky_check.' '.$animations_top_header_check; ?>" <?php language_attributes();?>> <!--<![endif]-->

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="TheFitGirlRules® has been created to help motivate and inspire women to take care of their health and fitness. Get lifestyle and fitness advice, food inspiration and purchase the latest TheFitGirlRules® merchandise here.">
	<meta name="google-site-verification" content="5DUU3d7flgdfUXKo-iXGIhUF264SJ7GYawAyRPJImpQ" />

	<meta property="og:image" content="http://www.thefitgirlrules.com/images/facebook-preview.png">

	<title>
		<?php
		global $page, $paged;
		wp_title('|', true, 'right');
		bloginfo('name');
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) {
			echo " | $site_description";
		}
		if ($paged >= 2 || $page >= 2) {
			echo ' | ' . sprintf(__('Page %s', 'lollum'), max($paged, $page));
		}
		?>
	</title>

	<link rel="icon" type="image/ico" href="http://www.thefitgirlrules.com/images/favicon.png">

	<link href='https://fonts.googleapis.com/css?family=Oswald:300|Roboto+Condensed:400,700,400italic|Roboto:100,100italic|Montserrat' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		
	<!-- BEGIN WP -->
	<?php wp_head(); ?>
	<!-- END WP -->

	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js?ver=1.0" type="text/javascript"></script><![endif]-->

	<script type="text/javascript" src="//use.typekit.net/hqx8uwf.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

</head>



<body <?php body_class();?>>

	<a href="https://plus.google.com/101045163458042763839" rel="publisher"></a>

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



		<div id="header-wrap">

			<?php if (get_option('lol_check_top_header') == 'true') : ?>

				<div id="top-header" class="no-responsive">
					<div class="container">
						<!-- BEGIN row -->
						<div class="row">
							<!-- BEGIN col-xs-12 -->
							<div class="col-xs-12">
								<div class="newsletter">
									<a href="http://eepurl.com/bbpNR5" target="_blank" class="newsletter_text">Join our newsletter</a>
								</div>
								<div class="social-icons">
									<a href="https://www.facebook.com/groups/438306129661867/" target="_blank"><i class="fa-facebook fa"></i></a><a href="https://www.twitter.com/thefitgirlrules" target="_blank"><i class="fa-twitter fa"></i></a><a href="http://www.instagram.com/thefitgirlrules" target="_blank"><i class="fa-instagram fa"></i></a><a href="http://www.youtube.com/thefitgirlrules" target="_blank"><i class="fa-youtube-play fa"></i></a><a href="http://www.pinterest.com/TheFitGirlRules" target="_blank"><i class="fa-pinterest fa"></i></a>
								</div>
								<div class="top-header-nav">                    
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

			<header id="branding" role="banner">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">

							<a href="http://www.thefitgirlrules.com">
								<div id="logo">
									<img src="http://www.thefitgirlrules.com/wp-content/uploads/2015/10/white-logo.png" width="75px" height="75px">
								</div>
							</a>

							<?php uberMenu_easyIntegrate(); ?>

							<nav id="mobile-nav-menu" class="<?php echo $ch = $has_cart_header ? 'cart-yes' : 'cart-no'; ?>" role="navigation">
								<div class="mobile-nav-menu-inner">
									<?php lollum_mobile_menu('primary'); ?>
								</div>
								<?php if ($has_cart_header) { ?>

								<?php global $woocommerce; ?>



								<?php } ?>
							</nav>

						</div>
					</div>
				</div>
			</header>
		</div>