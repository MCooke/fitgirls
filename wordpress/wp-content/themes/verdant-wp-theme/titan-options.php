<?php

/*
 * Titan Framework options sample code. We've placed here some
 * working examples to get your feet wet
 * @see	http://www.titanframework.net/get-started/
 */


add_action( 'tf_create_options', 'verdant_create_options' );

/**
 * Initialize Titan & options here
 */
function verdant_create_options() {

	$titan = TitanFramework::getInstance( 'verdant' );
	
	
	/**
	 * Create a Theme Customizer panel where we can edit some options.
	 * You should put options here that change the look of your theme.
	 */
	
	
	
	/**
	 * Site logo & motto options
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Logo Showcase', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'Showcase your awesome logo in the frontpage. This feature requires Jetpack.', 'verdant' ),
	) );
	
	$script = sprintf( '<a href="#" onclick="jQuery(\'.control-panel-back\').trigger(\'click\'); jQuery(\'#accordion-section-title_tagline h3\').trigger(\'click\'); jQuery(window).scrollTop(0);">%s</a>', __( "Site Title, Tagline, and Logo", 'verdant' ) );
	

	$section->createOption( array(
	    'name' => __( 'Frontpage Logo Feature', 'verdant' ),
	    'id' => 'logo_frontpage_feature',
	    'type' => 'enable',
		'default' => true,
		'desc' => sprintf( __( 'Enable this to show your logo in the header of the frontpage. You&apos;ll have to upload a <strong>Logo</strong> in the %s panel. Your logo will be displayed half the size of what you uploaded to support retina screens.', 'verdant' ), $script ),
	) );


	$section->createOption( array(
	    'name' => __( 'Motto', 'verdant' ),
	    'id' => 'logo_frontpage_motto',
	    'type' => 'text',
		'default' => __( 'The Next Evolution of Themes', 'verdant' ),
		'desc' => __( 'A heading motto or catchphrase to display right below your logo.', 'verdant' ),
	) );


	// $section->createOption( array(
	//     'name' => __( 'Motto Text Color', 'verdant' ),
	//     'id' => 'logo_frontpage_motto_color',
	//     'type' => 'color',
	// 	'default' => '#ffffff',
	// 	'desc' => __( 'A heading motto or catchphrase to display right below your logo.', 'verdant' ),
	// 	// 'css' =
	// ) );
	
	$section->createOption( array(
	    'name' => __( 'Headings Font', 'verdant' ),
	    'id' => 'logo_frontpage_font',
	    'type' => 'font',
	    'desc' => __( 'Select the font for all headings in the site', 'verdant' ),
	    'show_line_height' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => 'Unica One',
			'color' => '#ffffff',
			'font-size' => '40px',
			'font-weight' => 'normal',
			'font-style' => 'normal',
		    'letter-spacing' => 'normal',
	    ),
		'css' => '.logo-feature h1, .logo-feature h1 a:hover { value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Top Margin', 'verdant' ),
		'desc' => __( 'The top margin of the logo area.', 'verdant' ),
	    'id' => 'logo_frontpage_margin_top',
	    'type' => 'number',
		'default' => '150',
		'min' => '0',
		'max' => '600',
		'step' => '1',
		'css' => '.logo-feature { padding-top: valuepx }',
	) );

	$section->createOption( array(
	    'name' => __( 'Bottom Margin', 'verdant' ),
		'desc' => __( 'The bottom margin of the logo area.', 'verdant' ),
	    'id' => 'logo_frontpage_margin_bottom',
	    'type' => 'number',
		'default' => '150',
		'min' => '0',
		'max' => '600',
		'step' => '1',
		'css' => '.logo-feature { padding-bottom: valuepx }',
	) );
	
	
	/**
	 * Top Bar
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Top Bar', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'The topbar is the topmost thin bar that contains the site tagline and social icons', 'verdant' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Top Bar Background Color', 'verdant' ),
	    'id' => 'topbar_color_bg',
	    'type' => 'color',
		'default' => '#000000',
		'css' => '#masthead-top-wrapper { background: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Top Bar Text Color', 'verdant' ),
	    'id' => 'topbar_color',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead-top, .social-navigation a:before, .social-navigation a:visited:before, .top-search:before { color: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Search Button', 'verdant' ),
	    'id' => 'topbar_search_enable',
	    'type' => 'enable',
		'default' => true,
	) );

	
	
	/**
	 * Navigation
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Navigation Bar', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'The main navigation bar', 'verdant' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Logo Height', 'verdant' ),
		'desc' => __( 'Your logo is resized into this height in the navigation bar.', 'verdant' ),
	    'id' => 'navbar_logo_height',
	    'type' => 'number',
		'max' => '150',
		'min' => '0',
		'step' => '1',
		'default' => '60',
		'unit' => 'px',
		'css' => '#masthead .site-branding .site-logo { height: valuepx }',
	) );

	$section->createOption( array(
	    'name' => __( 'Background Color', 'verdant' ),
	    'id' => 'navbar_color_bg',
	    'type' => 'color',
		'default' => '#ffffff',
	) );

	$section->createOption( array(
	    'name' => __( 'Background Opacity', 'verdant' ),
	    'id' => 'navbar_color_bg_opacity',
	    'type' => 'number',
		'default' => '0.1',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
	) );

	$section->createOption( array(
	    'name' => __( 'Border Opacity', 'verdant' ),
	    'id' => 'navbar_border_color_opacity',
	    'type' => 'number',
		'default' => '0.3',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
	) );


	$section->createOption( array(
	    'name' => __( 'Sub Menu Background Color', 'verdant' ),
	    'id' => 'navbar_submenu_bg_color',
	    'type' => 'color',
		'default' => '#000000',
	) );

	$section->createOption( array(
	    'name' => __( 'Sub Menu Background Opacity', 'verdant' ),
	    'id' => 'navbar_submenu_bg_color_opacity',
	    'type' => 'number',
		'default' => '0.6',
		'min' => '0.0',
		'max' => '1.0',
		'step' => '0.01',
	) );


	$section->createOption( array(
	    'name' => __( 'Main Menu Text Color', 'verdant' ),
	    'id' => 'navbar_text_color',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead a, #masthead a:visited { color: value }
		@media (max-width: 955px) {
			.menu-toggle { border-color: value !important }
			.menu-toggle * { color: value !important }
		}',
	) );

	$section->createOption( array(
	    'name' => __( 'Main Menu Text Hover Color', 'verdant' ),
	    'id' => 'navbar_text_hover_color',
	    'type' => 'color',
		'default' => '#E87E04',
		'css' => '#masthead li:hover > a, #masthead li:hover > a:visited { color: value !important }
		@media (max-width: 955px) {
			.menu-toggle:hover { border-color: value !important }
			.menu-toggle:hover * { color: value !important }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Sub Menu Text Color', 'verdant' ),
	    'id' => 'navbar_submenu_text_color',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead nav ul ul a, #masthead nav ul ul a:visited, #masthead nav ul ul a:hover a, #masthead nav ul ul a:visited:hover a { color: value }',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Sub Menu Text Hover Color', 'verdant' ),
	    'id' => 'navbar_submenu_text_hover_color',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '#masthead nav ul ul a:hover, #masthead nav ul ul a:visited:hover { color: value }',
	) );
	
	
	/**
	 * Fonts
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Fonts', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'Change the fonts used across your site', 'verdant' ),
	) );
	
	$section->createOption( array(
	    'name' => __( 'Headings Font', 'verdant' ),
	    'id' => 'headings_font',
	    'type' => 'font',
	    'desc' => __( 'Select the font for all headings in the site', 'verdant' ),
		'show_color' => false,
		'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    'show_line_height' => false,
	    'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => 'Roboto Slab',
			'font-weight' => 'lighter',
			'font-style' => 'normal',
	    ),
		'css' => 'h1, h2, h3, h4, h5, h6,
		body #infinite-handle span,
		.entry-header .cat-links, .entry-header #breadcrumbs,
		body div.sharedaddy h3.sd-title,
		body div.sharedaddy .sd-social-icon-text .sd-content > ul > li > a.sd-button, body div.sharedaddy .sd-social-text .sd-content > ul > li > a.sd-button,
		body div#jp-relatedposts h3.jp-relatedposts-headline,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context,
		body div.sharedaddy.jetpack-likes-widget-wrapper h3.sd-title,
		.entry-footer .tags-links a,
		.navigation .nav-previous a, .navigation .nav-next a,
		.navigation.paging-navigation,
		.page-links,
		.widget_tag_cloud .tagcloud a, .widget_tag_cloud .tagcloud a:visited,
		.saboxplugin-wrap .saboxplugin-authorname a,
		#comments .comment-reply-link,
		body #infinite-handle span,
		.featured-content figcaption
		{ value }',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 1 Size', 'verdant' ),
	    'id' => 'heading1_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h1</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '40px',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'h1
		{ value }',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 2 Size', 'verdant' ),
	    'id' => 'heading2_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h2</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '34px',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'h2,
		body div#jp-relatedposts h3.jp-relatedposts-headline
		{ value }
		@media (max-width: 676px) {
			h1 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 3 Size', 'verdant' ),
	    'id' => 'heading3_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h3</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '28px',
			'letter-spacing' => 'normal',
			'text-transform' => 'normal',
	    ),
		'css' => 'h3,
		.navigation .nav-previous a, .navigation .nav-next a,
		.saboxplugin-wrap .saboxplugin-authorname a
		{ value }
		@media (max-width: 676px) {
			h2 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 4 Size', 'verdant' ),
	    'id' => 'heading4_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h4</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '22px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h4,
		body.has-sidebar .navigation .nav-previous a, body.has-sidebar .navigation .nav-next a,
		.navigation .nav-previous a, .navigation .nav-next a,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a
		{ value }
		@media (max-width: 676px) {
			h3, h4 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 5 Size', 'verdant' ),
	    'id' => 'heading5_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h5</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '16px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h5
		{ value }
		@media (max-width: 676px) {
			h5 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Heading 6 Size', 'verdant' ),
	    'id' => 'heading6_font',
	    'type' => 'font',
	    'desc' => __( 'The size of all <code>h6</code> headings', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '14px',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'h6
		{ value }
		@media (max-width: 676px) {
			h6 { value }
		}',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Body Font', 'verdant' ),
	    'id' => 'body_font',
	    'type' => 'font',
	    'desc' => __( 'The normal body font', 'verdant' ),
		// 'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    'show_font_style' => false,
	    // 'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
			'font-family' => 'Neuton',
	        'font-size' => '20px',
			'line-height' => '1.5em',
			'letter-spacing' => 'normal',
			'font-weight' => '200',
	    ),
		'css' => 'body,
		.navigation .nav-previous a span, .navigation .nav-next a span
		{ value }
		',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Smaller Body Font', 'verdant' ),
	    'id' => 'body_font_small',
	    'type' => 'font',
	    'desc' => __( 'The smaller body font found in various places in the theme', 'verdant' ),
		'show_font_family' => false,
		'show_color' => false,
		// 'show_font_size' => false,
	    'show_font_weight' => false,
	    'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-size' => '12px',
			// 'line-height' => '1.5em',
			'letter-spacing' => 'normal',
	    ),
		'css' => 'article .entry-footer,
		.entry-meta,
		.entry-header .cat-links, .entry-header #breadcrumbs,
		.page-header .taxonomy-description,
		.navigation .nav-previous a span, .navigation .nav-next a span,
		#comments .comment-metadata > a, #comments .comment-metadata > a:visited,
		#comments .comment-reply-link,
		#comments .logged-in-as,
		body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context, body div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-date,
		.featured-content figcaption span
		{ value }
		',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Menu Font', 'verdant' ),
	    'id' => 'menu_font',
	    'type' => 'font',
	    'desc' => __( 'Select the font for the main menu site', 'verdant' ),
		'show_color' => false,
		// 'show_font_size' => false,
	    // 'show_font_weight' => false,
	    // 'show_font_style' => false,
	    'show_line_height' => false,
	    // 'show_letter_spacing' => false,
	    // 'show_text_transform' => false,
	    'show_font_variant' => false,
	    'show_text_shadow' => false,
	    'default' => array(
	        'font-family' => 'Roboto Slab',
			'font-size' => '14px',
			'font-style' => 'lighter',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'font-weight' => 'normal',
	    ),
		'css' => '#masthead nav, .menu-all-pages-container, #masthead nav ul ul
		{ value }',
	) );
	
	
	
	/**
	 * Post Format Flags
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Post Format / Sticky Flags', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'These are the flags on the left side of posts that indicate their format', 'verdant' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Post Format Flag Color', 'verdant' ),
	    'id' => 'flag_format_color',
	    'type' => 'color',
		'default' => '#22A7F0',
		'css' => 'article .entry-icon, article .sticky-post, #comments .comments-title { background: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Sticky Flag Color', 'verdant' ),
	    'id' => 'flag_sticky_color',
	    'type' => 'color',
		'default' => '#F7CA18',
		'css' => 'article .sticky-post { background: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Flag Icon Color', 'verdant' ),
	    'id' => 'flag_icon_color',
	    'type' => 'color',
		'default' => '#FFFFFF',
		'css' => 'article .entry-icon, article .sticky-post { color: value }',
	) );
	
	$titan->createCSS("
		article .entry-icon:after, article .sticky-post:after, #comments .comments-title:after { border-right-color: darken(\$flag_format_color,.1) }
		article .sticky-post:after { border-right-color: darken(\$flag_sticky_color,.1) }" );

	
	
	
	/**
	 * Social Icons
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Social Icons', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => 'Social link icons are placed on the top of your site. Paste the links to your social profiles below.'
	) );

	for ( $i = 0; $i <= 10; $i++ ) {
		$section->createOption( array(
		    'name' => $i ? '' : __( 'Social Links', 'verdant' ),
		    'id' => 'social_' . $i,
		    'type' => 'text',
		) );
	}
	
	

	/**
	 * Footer widgets
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Footer Widget Area', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'Colors for the footer widgets', 'verdant' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Text Color', 'verdant' ),
		'desc' => __( 'Pick light when your background is dark. Dark otherwise.', 'verdant' ),
	    'id' => 'footer_widgets_scheme',
	    'type' => 'select',
		'options' => array(
			'light' => __( 'Light text color scheme', 'verdant' ),
			'dark' => __( 'Dark text color scheme', 'verdant' ),
		),
		'default' => 'light',
	) );
	
	

	/**
	 * Footer copyright
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => __( 'Footer Copyright Area', 'verdant' ),
		'panel' => __( 'Theme Options & Colors', 'verdant' ),
		'desc' => __( 'Colors & text of the bottom-most copyright area of the site', 'verdant' ),
	) );

	$section->createOption( array(
	    'name' => __( 'Copyright Text', 'verdant' ),
	    'id' => 'footer_copyright_text',
	    'type' => 'text',
		'default' => '&copy; ' . date( 'Y' ) . ', theme created by Gambit',
	) );

	$section->createOption( array(
	    'name' => __( 'Background Color', 'verdant' ),
	    'id' => 'footer_copyright_bg_color',
	    'type' => 'color',
		'default' => '#000000',
		'css' => '.site-info-container { background: value }',
	) );

	$section->createOption( array(
	    'name' => __( 'Text Color', 'verdant' ),
	    'id' => 'footer_copyright_text_color',
	    'type' => 'color',
		'default' => '#ffffff',
		'css' => '.site-info-container, .site-info-container a:hover, .site-info-container a:visited:hover { color: value }',
	) );
	
	
	
	/**
	 * Featured Content
	 */
	// $section = $titan->createThemeCustomizerSection( array(
// 	    'name' => __( 'Featured Content', 'verdant' ),
// 		'panel' => __( 'Theme Options & Colors', 'verdant' ),
// 		'desc' => __( 'Featured content are the 2 or more posts placed on the top of your frontpage. This feature requires Jetpack', 'verdant' ),
// 	) );
//
// 	$section->createOption( array(
// 	    'name' => __( 'Text Color', 'verdant' ),
// 	    'id' => 'featured_content_color',
// 	    'type' => 'color',
// 		'default' => '#ffffff',
// 		'css' => '.featured-content figcaption { color: value }',
// 	) );
//
// 	$section->createOption( array(
// 	    'name' => __( 'Text Hover Color', 'verdant' ),
// 	    'id' => 'featured_content_hover_color',
// 	    'type' => 'color',
// 		'default' => '#E87E04',
// 		'css' => '.featured-content .featured-item:hover figcaption { color: value }',
// 	) );
//
// 	$section->createOption( array(
// 	    'name' => __( 'Border Color', 'verdant' ),
// 	    'id' => 'featured_border_color',
// 	    'type' => 'color',
// 		'default' => '#000000',
// 		'css' => '.featured-content .featured-item { border-color: value }',
// 	) );
//
// 	$section->createOption( array(
// 	    'name' => __( 'Border Hover Color', 'verdant' ),
// 	    'id' => 'featured_border_hover_color',
// 	    'type' => 'color',
// 		'default' => '#444444',
// 		'css' => '.featured-content .featured-item:hover { border-color: value }',
// 	) );
	
	
	
	/**
	 * Main Colors
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => 'colors',
	) );

	$section->createOption( array(
	    'id' => 'background_gradient_enable',
	    'type' => 'checkbox',
	    'name' => __( 'Use background gradient color instead of the solid color', 'verdant' ),
	    'default' => false,
	) );

	$section->createOption( array(
		'name' => __( 'Background Color Gradient', 'verdant' ),
	    'id' => 'background_gradient',
	    'type' => 'color',
	    'default' => '#95A5A6',
	) );
	
	$section->createOption( array(
	    'name' => __( 'Main / Highlight Color', 'verdant' ),
	    'id' => 'highlight',
	    'type' => 'color',
		'default' => '#E87E04',
		'css' => ".social-navigation a:hover:before, .top-search:hover:before, .site-info-container a, .site-info-container a:visited { color: value }
		.site-info-container {
			a, a:visited {
				color: value;
			}
		}
		body.dark-footer,
		body.light-footer {
			.footer-widgets {
				a, a:visited {
					&:hover {
						color: value;
					}
				}
				.widget_recent_comments {
					.comment-author-link {
						a, a:visited {
							color: value;
						}
					}
				}
				.widget_tag_cloud .tagcloud a, .widget_tag_cloud .tagcloud a:visited {
					&:hover {
						color: value;
					}
				}
				.comment-reply-link,
				.comment-edit-link,
			    .btn, .btn-default, button,
			    input[type=\"button\"],
			    input[type=\"reset\"],
			    input[type=\"submit\"] {
					&:hover {
						color: value;
						border-color: value;
					}
				}
			}
		}
		.logo-feature h1 a {
			color: value;
		}
		body .portfolio-entry:hover .portfolio-entry-title a {
			color: value
		}

		.widget_tag_cloud {
			a, a:visited {
		        &:hover {
					color: value;
				}
			}
		}	
		.entry-footer {
		    .tags-links a {
		        &:hover {
		            color: value;
		        }
			}
		    .comments-link {
		        a, a:visited {
		            &:hover {
		                color: value;
		            }
		        }
		    }
		}

		.entry-header {
		    .cat-links, #breadcrumbs {
		        a, a:visited {
		            color: value;
				}
			}
		}

		a, a:visited {
		    color: value;
		}
		body {
			.comment-reply-link,
			.comment-edit-link,
		    .btn, .btn-default, button,
		    input[type=\"button\"],
		    input[type=\"reset\"],
		    input[type=\"submit\"] {
				color: value;
				border-color: value;
			}
		}
		body {
			#infinite-handle {
				span {
					color: value;
				}
			}
		}

		blockquote, q {
		    box-shadow: -5px 0 0 value;
		}
		#comments {
			.comment-metadata {
				> a, > a:visited {
					&:hover {
						color: value;
					}
				}
			}
			.comment-reply-link {
				background-color: value;
				&:hover {
					color: value;
				}
			}
		}
		.featured-content {
		    .featured-item:hover {
		        border-color: value;
		        figcaption {
		           color: value;
		        }
			}
		}

		.site-info-container {
			a, a:visited {
				color: value;
			}
		}
		#masthead-top {
			.top-search.showme, .top-search:hover {
				color: value;
			}
		}
		body {
		    div.sharedaddy {
		        .sd-social-icon-text, .sd-social-text {
		            .sd-content > ul > li > a.sd-button {
		                &:hover {
		                    color: value !important;
		                }
					}
				}
			}
		}
		body {
		    div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-context {
		        color: value;
		    }
		}
		body {
			.portfolio-entry {
				&:hover {
					.portfolio-entry-title a {
						color: value;
					}
				}
			}
		}
		.widget-area {
			a, a:visited {
				&:hover {
					color: value;
				}
			}
		}
		.widget_calendar {
			a, a:visited {
				color: value;
			}
		}

		.widget_recent_comments {
			.comment-author-link {
				a, a:visited {
					color: value;
				}
			}
		}
		.social-navigation a {
			&:hover {
				&:before {
					color: value;
				}
			}
		}

		.page-links {
			a, a:visited {
				border: 1px solid value;
			}
		}
		body.dark-footer {
			.footer-widgets {
				a, a:visited {
					&:hover {
						color: value;
					}
				}
				.widget_recent_comments {
					.comment-author-link {
						a, a:visited {
							&:hover {
								color: value;
							}
						}
					}
				}
				.widget_tag_cloud .tagcloud a, .widget_tag_cloud .tagcloud a:visited {
					&:hover {
						color: value;
					}
				}
			}
		}

		body.light-footer {
			.footer-widgets {

				a, a:visited {
					&:hover {
						color: value;
					}
				}
		
				.widget_recent_comments {
					.comment-author-link {
						a, a:visited {
							&:hover {
								color: value;
							}
						}
					}
				}
		
				.widget_tag_cloud .tagcloud a, .widget_tag_cloud .tagcloud a:visited {
					&:hover {
						color: value;
					}
				}
			}
		}
		",
	) );
	

	
	/**
	 * Background image cover
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => 'background_image',
	) );

	$section->createOption( array(
	    'id' => 'background_image_cover',
	    'type' => 'checkbox',
	    'name' => __( 'Set background size to cover', 'verdant' ),
	    'default' => true,
	) );
	
	
	/**
	 * Background image toggler
	 */
	$section = $titan->createThemeCustomizerSection( array(
	    'name' => 'header_image',
	) );

	$section->createOption( array(
	    // 'name' => __( 'Custom Javascript Code', 'verdant' ),
	    'id' => 'header_image_frontpage_only',
	    'type' => 'checkbox',
	    'name' => __( 'Show header image in front page only', 'verdant' ),
	    'default' => false,
	) );
}