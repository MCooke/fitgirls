<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Verdant
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function verdant_body_classes( $classes ) {
	global $verdant_titan;
	
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	// Main sidebar class
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}
	
	// footer widget color scheme
	if ( class_exists( 'TitanFramework' ) && $verdant_titan->getOption( 'footer_widgets_scheme' ) !== false ) {
		$classes[] = $verdant_titan->getOption( 'footer_widgets_scheme' ) . '-footer';
	} else {
		$classes[] = 'light-footer';
	}
	
	// logo feature
	$classes[] = ( class_exists( 'TitanFramework' ) && $verdant_titan->getOption( 'logo_frontpage_feature' ) ) && is_front_page() ? 'has-logo-feature' : 'no-logo-feature';

	return $classes;
}
add_filter( 'body_class', 'verdant_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function verdant_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'verdant' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'verdant_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function verdant_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'verdant_render_title' );
endif;


function verdant_create_social_icons() {
	global $verdant_titan;
	
	if ( ! class_exists( 'TitanFramework' ) ) {
		return;
	}
	
	for ( $i = 0; $i <= 10; $i++ ) {
		$url = $verdant_titan->getOption( 'social_' . $i );
		if ( empty( $url ) ) {
			continue;
		}
		
		echo "<a href='{$url}' target='_blank'></a>";
	}
}



function verdant_titan_custom_css() {
	global $verdant_titan;
	
	if ( ! class_exists( 'TitanFramework' ) ) {
		return;
	}
	
	$verdant_titan = TitanFramework::getInstance( 'verdant' );
	
	echo "<style>";
	
	$bg = $verdant_titan->getOption( 'navbar_color_bg' );
	$opacity = $verdant_titan->getOption( 'navbar_color_bg_opacity' );
	$borderOpacity = $verdant_titan->getOption( 'navbar_border_color_opacity' );
	$rgb = verdant_hex2rgb( $bg );
	
	echo "#masthead {
		background: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity});
		border-bottom: 1px solid rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$borderOpacity});
	}";
	
	$bg = $verdant_titan->getOption( 'navbar_submenu_bg_color' );
	$opacity = $verdant_titan->getOption( 'navbar_submenu_bg_color_opacity' );
	$opacity2 = (float)$opacity + 0.3;
	$opacity3 = (float)$opacity + 0.6;
	$rgb = verdant_hex2rgb( $bg );
	
	echo "#masthead nav ul ul li {
		background: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity});
	}
	#masthead nav ul ul li:hover {
		background: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity2});
	}
	@media (max-width: 955px) {
		#masthead nav li {
			background-color: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity});
		}
		#masthead nav li:hover {
			background-color: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity2});
		}
	}
	@media (max-width: 955px) {
		#masthead nav li {
			background-color: rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, {$opacity3}) !important;
		}
	}
	";
	
	$bg1 = '#' . get_background_color();
	$bg2 = $verdant_titan->getOption( 'background_gradient' );
	
	if ( $verdant_titan->getOption( 'background_gradient_enable' ) ) {
		echo "body.custom-background {
			background: {$bg1}; /* Old browsers */
			background: -moz-linear-gradient(-45deg, {$bg1} 0%, {$bg2} 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,{$bg1}), color-stop(100%,{$bg2})); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(-45deg, {$bg1} 0%,{$bg2} 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(-45deg, {$bg1} 0%,{$bg2} 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(-45deg, {$bg1} 0%,{$bg2} 100%); /* IE10+ */
			background: linear-gradient(135deg, {$bg1} 0%,{$bg2} 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$bg1}', endColorstr='{$bg2}',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
			background-attachment: fixed;
		}";
	}
	
	if ( $verdant_titan->getOption( 'background_image_cover' ) ) {
		echo "body.custom-background { background-size: cover }";
	}
	
	echo "</style>";
}
add_action( 'wp_head', 'verdant_titan_custom_css' );


/**
 * Halves the size of the site-logo to make it retina ready
 *
 * @param	$html string The rendered site-logo html
 * @param	$logo array The logo-Jetpack object
 * @param	$size string The size of the logo
 * @see	jetpack_the_site_logo filter in Jetpack
 */
function verdant_the_site_logo( $html, $logo, $size ) {
	
	if ( empty( $logo ) ) {
		return '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo-link" rel="home"><img width="100" class="site-logo attachment" src="' . get_template_directory_uri() . '/images/logo.png" title="Verdant WordPress Theme"/></a>';
	}
	
	// Checker, comes from jetpack_the_site_logo
	if ( ! jetpack_has_site_logo() ) {
		return $html;
	}
	
	// Get the image size
	$imageAttachment = wp_get_attachment_image_src( $logo['id'], $size );
	
	// Half the image size since we want a retina ready image
	$html = preg_replace( '/width="(\d+)"/i', 'width="' . ( $imageAttachment[1] / 2 ) . '"', $html );
	$html = preg_replace( '/height="(\d+)"/i', 'height="' . ( $imageAttachment[2] / 2 ) . '"', $html );
	
	return $html;
}
add_filter( 'jetpack_the_site_logo', 'verdant_the_site_logo', 10, 3 );



function verdant_feature_logo() {
	global $verdant_titan;
	
	if ( class_exists( 'TitanFramework' ) && ! $verdant_titan->getOption( 'logo_frontpage_feature' ) ) {
		return;
	}
	
	?>
	<div class='logo-feature'>
		<?php 
		if ( function_exists( 'jetpack_the_site_logo' ) ) {
			jetpack_the_site_logo();
		} else {
			?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
		}
		
		if ( class_exists( 'TitanFramework' ) ) {
			$motto = $verdant_titan->getOption( 'logo_frontpage_motto' );
			if ( ! empty( $motto ) ):
				?>
				<h1 class="logo-feature-motto" style="color: <?php echo $verdant_titan->getOption( 'logo_frontpage_motto_color' ) ?>"><?php echo $motto ?></h1>
				<?php
			endif;
		}
		?>
	</div>
	<?php
}


// @see	http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
if ( ! function_exists( 'verdant_hex2rgb' ) ) {
	function verdant_hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}



/**
 * This snippet will make `is_active_sidebar` work correctly with Custom Sidebars
 * @author Benjamin Intal
 * @see https://wordpress.org/support/topic/is_active_sidebar-not-reflecting-new-sidebar?replies=2#post-6483681
 * @see https://gist.github.com/bfintal/5b565eb32e8472e755a9
 */

/**
 * Gathers all the sidebar IDs and the replacement IDs
 */
add_action( 'cs_predetermineReplacements', 'verdant_custom_sidebars_determine_replacements' );
function verdant_custom_sidebars_determine_replacements( $defaults ) {
	global $_verdant_sidebar_ids_to_replace;
	$_verdant_sidebar_ids_to_replace = array();
	
	$customSidebarReplacer = CustomSidebarsReplacer::instance();
	
	$replacements = $customSidebarReplacer->determine_replacements( $defaults );

	foreach ( $replacements as $sb_id => $replace_info ) {

		if ( ! is_array( $replace_info ) || count( $replace_info ) < 3 ) {
			continue;
		}

		// Fix rare message "illegal offset type in isset or empty"
		$replacement = (string) @$replace_info[0];
		$replacement_type = (string) @$replace_info[1];
		$extra_index = (string) @$replace_info[2];

		$check = $customSidebarReplacer->is_valid_replacement( $sb_id, $replacement, $replacement_type, $extra_index );

		if ( $check ) {
			$_verdant_sidebar_ids_to_replace[ $sb_id ] = $replacement;
		}
	}
}


/**
 * Checks the sidebars being replaced and make corresponding is_active_sidebar calls to work
 */
add_filter( 'is_active_sidebar', 'verdant_custom_sidebars_is_active_sidebar', 10, 2 );
function verdant_custom_sidebars_is_active_sidebar( $is_active_sidebar, $index ) {
	global $_verdant_sidebar_ids_to_replace;
	
	if ( empty( $_verdant_sidebar_ids_to_replace ) ) {
		return $is_active_sidebar;
	}
	
	if ( ! empty( $_verdant_sidebar_ids_to_replace[ $index ] ) ) {
		// Return the current value if it's the same replacement	
		if ( $_verdant_sidebar_ids_to_replace[ $index ] == $index ) {
			return $is_active_sidebar;
		}
		
		return is_active_sidebar( $_verdant_sidebar_ids_to_replace[ $index ] );
	}
	
	return $is_active_sidebar;
}