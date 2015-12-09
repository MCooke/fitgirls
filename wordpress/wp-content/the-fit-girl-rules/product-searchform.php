<?php
/**
 * Lollum
 * 
 * The product search form (Woocommerce)
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
?>

<form role="search" method="get" class="searchbox" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<i class="fa fa-search"></i>
	<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
	<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search The Shop', 'woocommerce' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>