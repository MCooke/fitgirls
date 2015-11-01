<?php

/* Function 1 */

    add_action( 'init', 'custom_fix_thumbnail' );
 
    function custom_fix_thumbnail() {
      add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');
   
        function custom_woocommerce_placeholder_img_src( $src ) {
        $upload_dir = wp_upload_dir();
        $uploads = untrailingslashit( $upload_dir['baseurl'] );
        $src = 'http://www.thefitgirlrules.com/images/product-placeholder.jpg';
	 
        return $src;
      }
    }



/* Function 2 */

    function sb_remove_admin_menus (){
      if ( function_exists('remove_menu_page') ) {}

      remove_menu_page('themes.php'); // Appearance

    }



/* Function 3 */

    add_action('admin_menu', 'sb_remove_admin_menus'); 
    add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

    function remove_wp_logo( $wp_admin_bar ) {
      $wp_admin_bar->remove_node( 'wp-logo' );
    }

    add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );



/* Function 4 */

    function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
      $user_id = get_current_user_id();
      $current_user = wp_get_current_user();
      $profile_url = get_edit_profile_url( $user_id );

    if ( 0 != $user_id ) {
      $avatar = get_avatar( $user_id, 28 );
      $howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
      $class = empty( $avatar ) ? '' : 'with-avatar';

    $wp_admin_bar->add_menu( array(
      'id' => 'my-account',
      'parent' => 'top-secondary',
      'title' => $howdy . $avatar,
      'href' => $profile_url,
      'meta' => array(
      'class' => $class,
    ),

    ));}}



/* Function 5 */

    function custom_excerpt_length( $length ) {
      return 12;
    }

    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

?>