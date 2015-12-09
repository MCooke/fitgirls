<?php
/**
 * Lollum
 * 
 * Theme update notification functions and definitions
 *
 * Based on WordPress Theme Update Notifier
 * (https://github.com/unisphere/unisphere_notifier)
 *
 * Joao Araujo
 * (http://themeforest.net/user/unisphere)
 * http://twitter.com/unispheredesign
 *
 * @package WordPress
 * @subpackage Lollum Themes
 * @author Lollum <support@lollum.com>
 *
 */
 
// Constants for the theme name, folder and remote XML url
define( 'BP_NOTIFIER_THEME_NAME', 'Big Point' ); // The theme name
define( 'BP_NOTIFIER_THEME_FOLDER_NAME', 'bigpoint' ); // The theme folder name
define( 'BP_NOTIFIER_XML_FILE', 'http://lollum.com/api/themes/bigpoint/notifier.xml' ); // The remote notifier XML file containing the latest version of the theme and changelog
define( 'BP_NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

// Adds an update notification to the WordPress Dashboard menu
function lollum_lollum_update_notifier_menu() {  
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		$xml = lollum_get_latest_theme_version(BP_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$my_theme = wp_get_theme();
		$theme_data = $my_theme->get( 'Version' ); // Read theme current version from the style.css
		
		$xml_latest = str_replace(".", "", $xml->latest);
		$current_latest = str_replace(".", "", $theme_data);

		if ((float)$xml_latest && (float)$current_latest) {

			if((float)$xml_latest > (float)$current_latest) { // Compare current theme version with the remote XML version
				add_dashboard_page( BP_NOTIFIER_THEME_NAME . ' Theme Updates', BP_NOTIFIER_THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">New</span></span>', 'administrator', 'theme-update-notifier', 'lollum_update_notifier');
			}

		}
	}	
}
add_action('admin_menu', 'lollum_lollum_update_notifier_menu');  

// Adds an update notification to the WordPress 3.1+ Admin Bar
function lollum_lollum_update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;
	
		if ( !is_super_admin() || !is_admin_bar_showing() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;
		
		$xml = lollum_get_latest_theme_version(BP_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$my_theme = wp_get_theme();
		$theme_data = $my_theme->get( 'Version' ); // Read theme current version from the style.css

		$xml_latest = str_replace(".", "", $xml->latest);
		$current_latest = str_replace(".", "", $theme_data);

		if ((float)$xml_latest && (float)$current_latest) {

			if((float)$xml_latest > (float)$current_latest) { // Compare current theme version with the remote XML version
				$wp_admin_bar->add_menu( array( 'id' => 'lollum_update_notifier', 'title' => '<span>' . BP_NOTIFIER_THEME_NAME . ' <span id="ab-updates">New</span></span>', 'href' => get_admin_url() . 'index.php?page=theme-update-notifier' ) );
			}

		}
	}
}
add_action( 'admin_bar_menu', 'lollum_lollum_update_notifier_bar_menu', 1000 );

// The notifier page
function lollum_update_notifier() { 
	$xml = lollum_get_latest_theme_version(BP_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$my_theme = wp_get_theme();
	$theme_data = $my_theme->get( 'Version' ); // Read theme current version from the style.css ?>
	
	<style>
		img.img-theme {max-width: 300px;}
		.update-nag { display: none; }
		#instructions {min-height:227px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
		#changelog h4 {margin-bottom: 5px;}
	</style>

	<div class="wrap">
	
		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo BP_NOTIFIER_THEME_NAME ?> Theme Updates</h2>
			<div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo BP_NOTIFIER_THEME_NAME; ?> theme available.</strong> You have version <?php $my_theme = wp_get_theme(); echo $my_theme->get( 'Version' ); ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

		<img class="img-theme" style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" />
		
		<div id="instructions">
			<h3>Update Download and Instructions</h3>
			<p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo BP_NOTIFIER_THEME_FOLDER_NAME; ?>/</strong></p>
			<p>To update the Theme, login to <a href="http://themeforest.net/">Themeforest</a>, head over to your <strong>downloads</strong> section and download the latest version of the theme, which is <?php echo $xml->latest; ?></p>
			<p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo BP_NOTIFIER_THEME_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
			<p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
		</div>
	    
		<div id="changelog">
			<h3 class="title">Changelog</h3>
			<?php echo $xml->changelog; ?>
		</div>

	</div>
    
<?php } 

// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function lollum_get_latest_theme_version($interval) {
	$notifier_file_url = BP_NOTIFIER_XML_FILE;	
	$db_cache_field = 'lollum_bp_notifier-cache';
	$db_cache_field_last_updated = 'lollum_bp_notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {
		// cache doesn't exist, or is old, so refresh it
		
		$res = wp_remote_get( $notifier_file_url );
		$cache=wp_remote_retrieve_body($res);
		
		if ($cache) {			
			// we got good results	
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		} 
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}
	
	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}
	
	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($notifier_data); 
	
	return $xml;
}