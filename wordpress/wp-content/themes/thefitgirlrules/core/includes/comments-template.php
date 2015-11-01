<?php
/**
 * Lollum
 * 
 * Template for comments and pingbacks
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */

if( !function_exists('lollum_comment')) {
	function lollum_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="pingback">
			<p><?php _e('Pingback:', 'lollum'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('[edit]', 'lollum'), '<span class="edit-link">', '</span>'); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<div class="comment-author">
					<?php
					$avatar_size = 50;
					/*if ('0' != $comment->comment_parent)
						$avatar_size = 39;*/
					echo get_avatar($comment, $avatar_size);
					?>
				</div>

				<div class="comment-wrap">
					<header class="comment-meta">
						<?php
							printf('<span class="fn">%s</span>', get_comment_author_link());
							printf('<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url(get_comment_link($comment->comment_ID)),
									get_comment_time('c'),
									// translators: 1: date, 2: time
									sprintf(__('%1$s at %2$s', 'lollum'), get_comment_date(), get_comment_time())
								);
							comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'lollum'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
						?>

						<?php edit_comment_link(__('[edit]', 'lollum'), '<span class="edit-link">', '</span>'); ?>

					</header>

					<div class="comment-content"><?php comment_text(); ?></div>

					<?php if ($comment->comment_approved == '0') : ?>
						<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'lollum'); ?></em>
						<br>
					<?php endif; ?>
				</div>

			</article>

		<?php
				break;
		endswitch;
	}
}