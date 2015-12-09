<?php
/**
 * Lollum
 * 
 * The template for displaying Comments
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<section id="comments">
	<?php if (post_password_required()) : ?>
		<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'lollum'); ?></p>
	</section>

<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

	<?php if (have_comments()) : ?>
		<div class="divider">
			<h3 id="comments-title">
				<?php printf(_n('1 comment', '%1$s comments', get_comments_number(), 'lollum'),
						number_format_i18n(get_comments_number())); ?>
			</h3>
		</div>

		<ol class="commentlist">
			<?php wp_list_comments(array('callback' => 'lollum_comment')); ?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
		<nav id="comment-nav">
			<h2 class="assistive-text"><?php _e('Comment navigation', 'lollum'); ?></h2>
			<span class="nav-previous"><?php previous_comments_link(__('&laquo;', 'lollum')); ?></span>
			<span class="nav-next"><?php next_comments_link(__('&raquo;', 'lollum')); ?></span>
		</nav>
		<?php endif; ?>


	<?php elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
		
		<p class="nocomments"><?php _e('Comments are closed.', 'lollum'); ?></p>
	
	<?php endif; ?>

	<?php if (comments_open()) : ?>

		<div id="respond">

			<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>

				<p class="comment-must-logged"><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'lollum'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?>
				</p>

			<?php else : ?>

				<div class="divider">
					<h3><?php comment_form_title(__('Leave a comment', 'lollum'), __('Leave a reply to %s', 'lollum')); ?></h3>
				</div>

				<div class="cancel-comment-reply">
					<?php cancel_comment_reply_link(); ?>
				</div>

				<?php // lollum_comment_default(); ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

				<?php if (is_user_logged_in()) : ?>
				
				<p class="comment-logged-in"><?php printf(__('Logged in as %1$s / %2$sLog out &raquo;%3$s', 'lollum'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'lollum').'">', '</a>') ?>
				</p>

				<?php else : ?>

				<div class="row">

					<div class="col-xs-4">
						<p class="comment-input">
							<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" placeholder="name (*)">
							<label for="author">
								<small><?php _e('Name', 'lollum') ?> <span><?php if ($req) _e('(*)', 'lollum'); ?></span></small>
							</label>
						</p>
					</div>
				
					<div class="col-xs-4">
						<p class="comment-input">
							<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" placeholder="e-mail (*)">
							<label for="email">
								<small><?php _e('Email', 'lollum') ?> <span><?php if ($req) _e('(*)', 'lollum'); ?></span></small>
							</label>
						</p>
					</div>
				
					<div class="col-xs-4">
						<p class="comment-input">
							<input type="text" name="website" id="website" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" placeholder="website">
							<label for="website">
								<small><?php _e('Website', 'lollum') ?></small>
							</label>
						</p>
					</div>

				</div>
				
				<?php endif; ?>

				<p class="comment-textarea">
					<textarea name="comment" id="comment" cols="58" rows="12" tabindex="4" placeholder="write a comment..."></textarea>
				</p>

				<p class="comment-submit">
					<input name="submit" class="" type="submit" id="submit" tabindex="5" value="Submit">
					<?php comment_id_fields(); ?>
				</p>
					<?php do_action('comment_form', $post->ID); ?>

				</form>

			<?php endif; ?>

		</div>

	<?php endif; ?>

</section>