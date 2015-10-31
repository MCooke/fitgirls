<?php
/**
 * Lollum
 * 
 * The search form
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<form method="get" class="searchbox" action="<?php echo esc_url(home_url('/')); ?>">
	<i class="fa fa-search"></i>
	<label class="screen-reader-text" for="s"><?php _e('Search for:', 'lollum'); ?></label>
	<input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'search here', 'lollum' ); ?>" />
</form>