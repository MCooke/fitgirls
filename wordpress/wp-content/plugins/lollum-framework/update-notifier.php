<?php
/**
 * Lollum
 *
 * Plugin update notification functions and definitions
 *
 * Based on WordPress plugin Update Notifier
 * (https://github.com/pippinsplugins/WordPress-Plugin-Update-Notifier-for-Code-Canyon)
 *
 * Pippin Williamson
 * http://codecanyon.net/user/mordauk
 * http://twitter.com/pippinsplugins
 *
 * @package WordPress
 * @subpackage Lollum Framework
 * @author Lollum <support@lollum.com>
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }
 
// Constants for the plugin name, folder and remote XML url
define( 'LOLFMK_NOTIFIER_PLUGIN_NAME', 'Lollum Framework' ); // The plugin name
define( 'LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME', 'lollum-framework' ); // The plugin folder name
define( 'LOLFMK_NOTIFIER_PLUGIN_FILE_NAME', 'lollum-framework.php' ); // The plugin file name
define( 'LOLFMK_NOTIFIER_PLUGIN_XML_FILE', 'http://lollum.com/api/plugins/lollum-framework/notifier.xml' ); // The remote notifier XML file containing the latest version of the plugin and changelog
define( 'LOLFMK_NOTIFIER_PLUGIN_XML_URL', 'http://lollum.com/api/plugins/lollum-framework/' ); // The remote notifier XML file containing the latest version of the plugin and changelog
define( 'LOLFMK_PLUGIN_NOTIFIER_CACHE_INTERVAL', 21600 ); // The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

// Adds an update notification to the WordPress Dashboard menu
function lolfmk_update_plugin_notifier_menu() {  
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
	    $xml 			= lolfmk_get_latest_plugin_version(LOLFMK_PLUGIN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$plugin_data 	= get_plugin_data(WP_PLUGIN_DIR . '/' . LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME . '/' . LOLFMK_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the style.css

		if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
			if(defined('LOLFMK_NOTIFIER_PLUGIN_SHORT_NAME')) {
				$menu_name = LOLFMK_NOTIFIER_PLUGIN_SHORT_NAME;
			} else {
				$menu_name = LOLFMK_NOTIFIER_PLUGIN_NAME;
			}
			add_dashboard_page( LOLFMK_NOTIFIER_PLUGIN_NAME . ' Plugin Updates', $menu_name . ' <span class="update-plugins count-1"><span class="update-count">New</span></span>', 'administrator', 'lollum-framework-plugin-update-notifier', 'lolfmk_update_notifier');
		}
	}	
}
add_action('admin_menu', 'lolfmk_update_plugin_notifier_menu');  

// Adds an update notification to the WordPress 3.1+ Admin Bar
function lolfmk_update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
		global $wp_admin_bar, $wpdb;

		if ( !is_super_admin() || !is_admin_bar_showing() || !is_admin() ) // Don't display notification in admin bar if it's disabled or the current user isn't an administrator
		return;

		$xml 		= lolfmk_get_latest_plugin_version(LOLFMK_PLUGIN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
		$plugin_data 	= get_plugin_data(WP_PLUGIN_DIR . '/' . LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME . '/' .LOLFMK_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the main plugin file

		if( (string)$xml->latest > (string)$plugin_data['Version']) { // Compare current plugin version with the remote XML version
			$wp_admin_bar->add_menu( array( 'id' => 'plugin_update_notifier', 'title' => '<span>' . LOLFMK_NOTIFIER_PLUGIN_NAME . ' <span id="ab-updates">New</span></span>', 'href' => get_admin_url() . 'index.php?page=lollum-framework-plugin-update-notifier' ) );
		}
	}
}
add_action( 'admin_bar_menu', 'lolfmk_update_notifier_bar_menu', 1000 );

// The notifier page
function lolfmk_update_notifier() { 
	$xml 			= lolfmk_get_latest_plugin_version(LOLFMK_PLUGIN_NOTIFIER_CACHE_INTERVAL); // Get the latest remote XML file on our server
	$plugin_data 	= get_plugin_data(WP_PLUGIN_DIR . '/' . LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME . '/' .LOLFMK_NOTIFIER_PLUGIN_FILE_NAME); // Read plugin current version from the main plugin file ?>

	<style>
		img.img-plugin {max-width: 300px;}
		.update-nag { display: none; }
		#instructions {min-height:227px;}
		h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
		#changelog h4 {margin-bottom: 5px;}
	</style>

	<div class="wrap">

		<div id="icon-tools" class="icon32"></div>
		<h2><?php echo LOLFMK_NOTIFIER_PLUGIN_NAME ?> Plugin Updates</h2>
		<div id="message" class="updated below-h2"><p><strong>There is a new version of the <?php echo LOLFMK_NOTIFIER_PLUGIN_NAME; ?> plugin available.</strong> You have version <?php echo $plugin_data['Version']; ?> installed. Update to version <?php echo $xml->latest; ?>.</p></div>

		<img class="img-plugin" style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo LOLFMK_NOTIFIER_PLUGIN_XML_URL . '/screenshot.png'; ?>" />
		
		<div id="instructions">
			<h3>Update Download and Instructions</h3>
			<p><strong>Please note:</strong> make a <strong>backup</strong> of the Plugin inside your WordPress installation folder <strong>/wp-content/plugins/<?php echo LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME; ?>/</strong></p>
			<p>To update the Plugin, click <a href="<?php echo LOLFMK_NOTIFIER_PLUGIN_XML_URL . '/lollum-framework.1.8.zip'; ?>">here</a>.</p>
			<p>Extract the zip's contents, look for the extracted plugin folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/plugins/<?php echo LOLFMK_NOTIFIER_PLUGIN_FOLDER_NAME; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the plugin files).</p>
			<p>If you didn't make any changes to the plugin files, you are free to overwrite them with the new ones without the risk of losing any plugins settings, and backwards compatibility is guaranteed.</p>
		</div>

		<div id="changelog">
			<h3 class="title">Changelog</h3>
			<?php echo $xml->changelog; ?>
		</div>

	</div>
    
<?php } 

// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function lolfmk_get_latest_plugin_version($interval) {
	$notifier_file_url = LOLFMK_NOTIFIER_PLUGIN_XML_FILE;	
	$db_cache_field = 'lolfmk-notifier-cache';
	$db_cache_field_last_updated = 'lolfmk-notifier-cache-last-updated';
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