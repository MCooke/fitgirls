<?php
/**
 * Lollum
 * 
 * Core functions and definitions
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

/**
 * Mobile dropdown menu
 */
if(!function_exists('lollum_mobile_menu')) {
	function lollum_mobile_menu($menu_name) {
		if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
			$menu = wp_get_nav_menu_object($locations[$menu_name]);
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$menu_list = '<select id="mobile-primary-menu" class="dropdownmenu">';
			$menutext = __('Navigation', 'lollum');
			$menu_list .= '<option>' . $menutext . '</option>';
			foreach ((array) $menu_items as $key => $menu_item) {
				$title = $menu_item->title;
				$url = $menu_item->url;
				if ($url === 'http://#' || $url === '#' || $url === '') {
					continue;
				}
				$menu_list .= '<option value="' . $url . '">' . $title . '</option>';
			}
			$menu_list .= '</select>';
		} else {
		$menu_list = '<select class="dropdownmenu"><option>Menu "' . $menu_name . '" not defined.</option></select>';
		}
		echo $menu_list;
	}
}

/**
 * Add Parent Class
 */
add_filter( 'wp_nav_menu_objects', 'lollum_add_menu_parent_class' );
if (!function_exists('lollum_add_menu_parent_class')) {
	function lollum_add_menu_parent_class( $items ) {
		$parents = array();
		foreach ( $items as $item ) {
			if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
				$parents[] = $item->menu_item_parent;
			}
		}
		foreach ( $items as $item ) {
			if ( in_array( $item->ID, $parents ) ) {
				$item->classes[] = 'menu-parent-item'; 
			}
		}
		return $items;    
	}
}

/**
 * Breadcumbs
 */
if(!function_exists('lollum_breadcrumb')) {
	function lollum_breadcrumb() {
		$delimiter = ' / ';
		$home = 'Home';
		$homeLink = site_url();
		$blog = '<span>'.get_option('lol_breadcumb_blog').'</span>';
		$blog = 'Blog';
		$before = '<span>';
		$after = '</span>';
		global $post;
		if (get_option('lol_check_breadcumbs')  == 'true') {
		   echo '<nav class="crumbs">';
			if (is_home()) {
		   	echo '<span>'.__('You are here:', 'lollum').'</span>';
				echo '<a class="home" href="'.$homeLink.'">'.$home.'</a> '.$delimiter.$blog.'';
			} elseif (!is_front_page()) {
		   	echo '<span>'.__('You are here:', 'lollum').'</span>';
				echo '<a class="home" href="'.$homeLink.'">'.$home.'</a> '.$delimiter.'';
				if (is_category()) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$thisCat = $cat_obj->term_id;
					$thisCat = get_category($thisCat);
					$parentCat = get_category($thisCat->parent);
					if ($thisCat->parent != 0) {
						echo get_category_parents($parentCat, TRUE, ''.$delimiter.'');
					}
					echo $before.'Archive by category "'.single_cat_title('', false).'"'.$after;
				} elseif (is_search()) {
					echo $before.'Search results for "'.get_search_query().'"'.$after;
				} elseif (is_day()) {
					echo '<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.'';
					echo '<a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_time('F').'</a> '.$delimiter.'';
					echo $before.get_the_time('d').$after;
				} elseif (is_month()) {
					echo '<a href="'.get_year_link(get_the_time('Y')).'">'.get_the_time('Y').'</a> '.$delimiter.'';
					echo $before.get_the_time('F').$after;
				} elseif (is_year()) {
					echo $before.get_the_time('Y').$after;
				} elseif (is_single() && !is_attachment()) {
					if (get_post_type() != 'post') {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						echo '<a href="'.$homeLink.'/'.$slug['slug'].'/">'.$post_type->labels->singular_name.'</a> '.$delimiter.'';
						echo $before.get_the_title().$after;
					} else {
						$cat = get_the_category();
						$cat = $cat[0];
						echo get_category_parents($cat, TRUE, ''.$delimiter.'');
						echo $before.get_the_title().$after;
					}
				} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
					$post_type = get_post_type_object(get_post_type());
					echo $before.$post_type->labels->singular_name.$after;
				} elseif (is_attachment()) {
					$parent = get_post($post->post_parent);
					// $cat = get_the_category($parent->ID);
					// $cat = $cat[0];
					// echo get_category_parents($cat, TRUE, ''.$delimiter.'');
					echo '<a href="'.get_permalink($parent).'">'.$parent->post_title.'</a> '.$delimiter.'';
					echo $before.get_the_title().$after;
				} elseif (is_page() && !$post->post_parent) {
					echo $before.ucfirst(strtolower(get_the_title())).$after;
				} elseif (is_page() && $post->post_parent) {
					$parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<a href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a>';
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) {
						echo $crumb.''.$delimiter.'';
					}
					echo $before.get_the_title().$after;
				} elseif (is_tag()) {
					echo $before.'Posts tagged "'.single_tag_title('', false).'"'.$after;
				} elseif (is_author()) {
					global $author;
					$userdata = get_userdata($author);
					echo $before.'Articles posted by '.$userdata->display_name.$after;
				} elseif (is_404()) {
					echo $before.'Error 404'.$after;
				}
				if (get_query_var('paged')) {
					if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
						echo ' (';
					}
					echo $delimiter.$before.__('Page', 'lollum').''.get_query_var('paged').$after;
					if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
						echo ')';
					}
				}
			}
			echo '</nav>';
		}
	}
}

/**
 * Lollum Header Posts
 */
if(!function_exists('lollum_header_posts')) {
	function lollum_header_posts($url = null) {
		echo '<div class="post-meta">';
		if ($url != '') {
			echo '<span class="meta-wrap"><i class="fa fa-external-link-square"></i>'.$url.'</span>';
		}
		if (is_sticky() && is_home() && ! is_paged()) {
			echo '<span class="meta-wrap meta-sticky"><i class="fa fa-thumb-tack"></i>'.__('Sticky', 'lollum').'</span>';
		}
		echo '<span class="meta-wrap"><i class="fa fa-calendar-o"></i>'.get_the_time('F j, Y').'</span>';
		echo '<span class="meta-wrap"><i class="fa fa-user"></i><a class="url fn n" href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'" rel="me">'.get_the_author().'</a></span>';
		$categories_list = get_the_category_list(', ');
		if ($categories_list) {
			echo '<span class="meta-wrap"><i class="fa fa-tags"></i>'.$categories_list.'</span>';
		}
		if ((comments_open() || ('0' != get_comments_number() && ! comments_open())) && (!post_password_required())) {
			echo '<span class="meta-wrap comments"><i class="fa fa-comments"></i>';
			comments_popup_link(__('Leave a comment', 'lollum'), __('1 Comment', 'lollum'), __('% Comments', 'lollum'));
			echo '</span>';
		}
		echo '</div>';
	}
}

/**
 * Lollum Header Jobs
 */
if(!function_exists('lollum_header_jobs')) {
	function lollum_header_jobs($postid) {
		$job_location = get_post_meta($postid, 'lolfmkbox_job_location', true);
		echo '<div class="post-meta">';
		echo '<span class="meta-wrap"><i class="fa fa-calendar"></i>'.get_the_time('F j, Y').'</span>';
		if ($job_location != '') {
			echo '<span class="meta-wrap"><i class="fa fa-map-marker"></i>'.$job_location.'</span>';
		}
		echo '<span class="meta-wrap"><i class="fa fa-user"></i><a class="url fn n" href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'" rel="me">'.get_the_author().'</a></span>';
		$job_terms = get_the_terms($postid, 'job-categories');
		if ($job_terms) {
			echo '<span class="meta-wrap"><i class="fa fa-tags"></i>';
			the_terms($postid, 'job-categories', '', '', '');
			echo '</span>';
		}
		echo '</div>';
	}
}

/**
 * Lollum Footer Posts
 */
if(!function_exists('lollum_footer_posts')) {
	function lollum_footer_posts($postid) {
		$social_check = '';
		$tags_list = get_the_tags();
		if (get_option('lol_check_sharer_posts')  == 'true') {
			$social_check = 'social';
		}
		if ((get_option('lol_check_sharer_posts')  == 'true') || ($tags_list)) {
			echo '<footer class="footer-meta '.$social_check.'">';
		}
		if ($tags_list) {
			echo get_the_tag_list('<div class="meta-tags-wrap">Tags: ',', ','</div>');
		}
		if (get_option('lol_check_sharer_posts')  == 'true') {
			lollum_show_sharer();
		}
		if ((get_option('lol_check_sharer_posts')  == 'true') || ($tags_list)) {
			echo '</footer>';
		}
	}
}

/**
 * Social sharer
 */
if(!function_exists('lollum_show_sharer')) {
	function lollum_show_sharer($product = null) { ?>
		<ul class="social-meta">
			<li><a class="facebook-share" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a></li>
			<li><a class="twitter-share" href="https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<li><a class="google-share" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
			<?php if ($product = 'product') { ?>
				<li><a class="pinterest-share" href="//pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
		</ul>
	<?php }
}

/**
 * Show gallery
 */
if(!function_exists('lollum_show_gallery')) {
	function lollum_show_gallery($postid, $imagesize, $single = null) {
		$pattern = get_post_meta($postid, 'lolfmkbox_gallery_shortcode', true);
		if (preg_match('/\[gallery.*ids=.(.*).\]/', $pattern, $matches)) {
			$images = explode(",", $matches[1]);
			if (count($images) > 1) {
				echo '<div class="flexslider flex-gallery">';
				echo '<ul class="slides">';
				echo '<div class="preloader"></div>';
				foreach ($images as $image) {
					$src = wp_get_attachment_image_src($image, $imagesize);
					echo '<li>';
					if (!$single) {
						echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
					}
					echo '<img width="' . $src[1] . '" height="' . $src[2] . '" src="' . $src[0] . '" >';
					if (!$single) {
						echo '</a>';
					}
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
			}
		}
	}
}

/**
 * Show video
 */
if (!function_exists('lollum_show_video')) {
	function lollum_show_video($postid, $portfolio = null) {
		if (isset($portfolio)) {
			$mp4 = get_post_meta($postid, 'lolfmkbox_portfolio_mp4_url', true);
			$poster = get_post_meta($postid, 'lolfmkbox_portfolio_poster_video', true);
		} else {
			$mp4 = get_post_meta($postid, 'lolfmkbox_mp4_url', true);
			$poster = get_post_meta($postid, 'lolfmkbox_poster_video', true);
		} ?>

		<video class="wp-video-shortcode" width="320" height="240" controls="controls" poster="<?php echo $poster; ?>" preload="none">
			<source type="video/mp4" src="<?php echo $mp4; ?>">
			<a href="<?php echo $mp4; ?>"><?php echo $mp4; ?></a>
		</video>

	<?php }
}

/**
 * Show audio
 */
if (!function_exists('lollum_show_audio')) {
	function lollum_show_audio($postid) {
		$mp3 = get_post_meta($postid, 'lolfmkbox_mp3_url', true); ?>
	
		<audio class="wp-audio-shortcode" controls="control" preload="none" src="<?php echo $mp3; ?>" type="audio/mp3"></audio>

	<?php }
}

/**
 * Show Chat
 */
if (!function_exists('add_chat_detection_format')) {
	function add_chat_detection_format( $name, $newline_regex, $delimiter_regex ) {
		global $_wp_chat_parsers;

		if ( empty( $_wp_chat_parsers ) )
			$_wp_chat_parsers = array();

		$_wp_chat_parsers = array( $name => array( $newline_regex, $delimiter_regex ) ) + $_wp_chat_parsers;
	}
	add_chat_detection_format( 'IM', '#^([^:]+):#', '#[:]#' );
	add_chat_detection_format( 'Skype', '#(\[.+?\])\s([^:]+):#', '#[:]#' );
}

if (!function_exists('get_content_chat')) {
	function get_content_chat( &$content, $remove = false ) {
		global $_wp_chat_parsers;

		$trimmed = strip_tags( trim( $content ) );
		if ( empty( $trimmed ) )
			return array();

		$matched_parser = false;
		foreach ( $_wp_chat_parsers as $parser ) {
			@list( $newline_regex, $delimiter_regex ) = $parser;
			if ( preg_match( $newline_regex, $trimmed ) ) {
				$matched_parser = $parser;
				break;
			}
		}

		if ( false === $matched_parser )
			return array();

		$last_index = 0;
		$stanzas = $data = $stanza = array();
		$author = $time = '';
		$lines = explode( "\n", make_clickable( $trimmed ) );
		$found = false;
		$found_index = 0;

		foreach ( $lines as $index => $line ) {
			if ( ! $found )
				$found_index = $index;

			$line = trim( $line );

			if ( empty( $line ) && $found ) {
				if ( ! empty( $author ) ) {
					$stanza[] = array(
						'time'    => $time,
						'author'  => $author,
						'message' => join( ' ', $data )
					);
				}

				$stanzas[] = $stanza;

				$stanza = $data = array();
				$author = $time = '';
				if ( ! empty( $lines[$index + 1] ) && ! preg_match( $delimiter_regex, $lines[$index + 1] ) )
					break;
				else
					continue;
			}

			$matched = preg_match( $newline_regex, $line, $matches );
			if ( ! $matched )
				continue;

			$found = true;
			$last_index = $index;
			$author_match = empty( $matches[2] ) ? $matches[1] : $matches[2];
			// assume username syntax if no whitespace is present
			$no_ws = $matched && ! preg_match( '#[\r\n\t ]#', $author_match );
			// allow script-like stanzas
			$has_ws = $matched && preg_match( '#[\r\n\t ]#', $author_match ) && empty( $lines[$index + 1] ) && empty( $lines[$index - 1] );
			if ( $matched && ( ! empty( $matches[2] ) || ( $no_ws || $has_ws ) ) ) {
				if ( ! empty( $author ) ) {
					$stanza[] = array(
						'time'    => $time,
						'author'  => $author,
						'message' => join( ' ', $data )
					);
					$data = array();
				}

				$time = empty( $matches[2] ) ? '' : $matches[1];
				$author = $author_match;
				$data[] = trim( str_replace( $matches[0], '', $line ) );
			} elseif ( preg_match( '#\S#', $line ) ) {
				$data[] = $line;
			}
		}

		if ( ! empty( $author ) ) {
			$stanza[] = array(
				'time'    => $time,
				'author'  => $author,
				'message' => trim( join( ' ', $data ) )
			);
		}

		if ( ! empty( $stanza ) )
			$stanzas[] = $stanza;

		if ( $remove ) {
			if ( 0 === $found_index ) {
				$removed = array_slice( $lines, $last_index );
			} else {
				$before = array_slice( $lines, 0, $found_index );
				$after = array_slice( $lines, $last_index + 1 );
				$removed = array_filter( array_merge( $before, $after ) );
			}
			$content = trim( join( "\n", $removed ) );
		}

		return $stanzas;
	}
}

if (!function_exists('get_the_post_format_chat')) {
	function get_the_post_format_chat( $id = 0 ) {
		$post = empty( $id ) ? clone get_post() : get_post( $id );
		if ( empty( $post ) )
			return array();

		$data = get_content_chat($post->post_content);
		if ( empty( $data ) )
			return array();

		return $data;
	}
}

if (!function_exists('the_post_format_chat')) {
	function the_post_format_chat() {
		$output  = '<dl class="chat">';
		$stanzas = get_the_post_format_chat();

		foreach ( $stanzas as $stanza ) {
			foreach ( $stanza as $row ) {
				$time = '';
				if ( ! empty( $row['time'] ) )
					$time = sprintf( '<time class="chat-timestamp">%s</time>', esc_html( $row['time'] ) );

				$output .= sprintf(
					'<dt class="chat-author chat-author-%1$s vcard">%2$s <cite class="fn">%3$s</cite>: </dt>
						<dd class="chat-text">%4$s</dd>
					',
					esc_attr( sanitize_title_with_dashes( $row['author'] ) ), // Slug.
					$time,
					esc_html( $row['author'] ),
					$row['message']
				);
			}
		}

		$output .= '</dl><!-- .chat -->';

		echo $output;
	}
}

/**
 * Pagination
 */
if (!function_exists('lollum_pagination')) {
	function lollum_pagination($pages = '', $range = 2) {  
		$showitems = ($range * 2)+1;  
		global $paged;
		if(empty($paged)) $paged = 1;
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}   
		if(1 != $pages) {
			echo "<nav class='pagination'>";
			echo "<h2 class='assistive-text'>" . __('Post navigation', 'lollum') . "</h2>";
			if($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'>&laquo;</a>";

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
					echo ($paged == $i)? "<span class='current'>" . $i . "</span>":"<a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a>";
				}
			}
			if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1) . "'>&raquo;</a>";  
			echo "</nav>\n";
		}
	}
}

if (!function_exists('lollum_pagination_default')) {
	function lollum_pagination_default() {
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search()))
			return;
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php _e('Posts navigation', 'lollum'); ?></h2>
			<div class="nav-links">
				<?php if (get_next_posts_link()) : ?>
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'lollum')); ?></div>
				<?php endif; ?>

				<?php if (get_previous_posts_link()) : ?>
				<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lollum')); ?></div>
				<?php endif; ?>
			</div>
		</nav>
		<?php
	}
}
if (!function_exists('lollum_comment_default')) {
	function lollum_comment_default() {
		comment_form();
	}
}

/**
 * Function author bio
 */
if (!function_exists('lollum_author_bio')) {
	function lollum_author_bio() {
		?>
		<aside class="about-author">
			<div class="bio-avatar">
				<?php echo get_avatar(get_the_author_meta('email'), $size='100'); ?>	
			</div>

			<div class="entry-bio">
				<div class="bio-title">
					<h4><?php the_author(); ?></h4>
					<span><?php _e('About the Author', 'lollum'); ?></span>
				</div>
				<div class="about-text">
					<p><?php the_author_meta('description'); ?></p>
				</div>
			</div>
		</aside>
		<?php
	}
}

/**
 * Function password protected post
 */
add_filter('the_password_form', 'lollum_password_form');

if (!function_exists('lollum_password_form')) {
	function lollum_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		' . '
		<label class="pass-label" for="' . $label . '">' . __( "Password:", "lollum" ) . ' </label><input name="post_password" id="' . $label . '" type="password" placeholder="Password"><br><input type="submit" name="Submit" class="button" value="' . esc_attr__( "Submit" ) . '">
		</form>';
		return $o;
	}
}

/**
 * Filter tag cloud
 */
if (!function_exists('lollum_tag_cloud_args')) {
	function lollum_tag_cloud_args($args) {
		$args['largest'] = 10;
		$args['smallest'] = 10;
		$args['unit'] = 'px';
		return $args;
	}
}
add_filter('widget_tag_cloud_args', 'lollum_tag_cloud_args');

/**
 * Optional theme features
 */
if (!function_exists('lollum_optional_setup')) {
	function lollum_optional_setup() {
		add_theme_support( 'custom-header', $args );
		add_theme_support( 'custom-background', $args );
	}
}
// add_action('after_setup_theme', 'lollum_setup');