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

add_action('init','lol_options');

if (!function_exists('lol_options')) {
function lol_options(){
	
$shortname = "lol";

global $lol_options;
$lol_options = get_option('lol_options');

// Categories
$lol_categories = get_categories('hide_empty=0&orderby=name');
$lol_wp_cats = array();  
foreach ($lol_categories as $category_list) {  
	$lol_wp_cats[$category_list->cat_ID] = $category_list->cat_name;  
}  

// Pages
$lol_pages = get_pages('sort_column=post_parent,menu_order');
$lol_wp_pages = array();
foreach ($lol_pages as $page_list) {
	$lol_wp_pages[$page_list->ID] = $page_list->post_name;
}

global $web_fonts;
global $google_fonts;
require_once 'options-fonts.php';

require_once 'options-backgrounds.php';

/**
 * Options Array
 */

$options = array();

$options[] = array( 
	"name" => __('General Settings','lollum'),
	"type" => "heading");
                    
$options[] = array( 
	"name" => "",
	"message" => __('Control and configure the general setup of your theme. Upload your preferred logo, your favicon, insert your analytics tracking code, etc.','lollum'),
	"type" => "section-description");

$options[] = array( 
	"name" => __('Custom Logo','lollum'),
	"desc" => __('Upload a custom logo for your website. An height of 95px (at least) is preferred, with a little blank space at the top and bottom (to center the image).','lollum'),
	"id" => $shortname . "_custom_logo",
	"std" => "",
	"type" => "upload");

$options[] = array( 
	"name" => __('Custom Logo Retina','lollum'),
	"desc" => __('Upload a double size logo for your retina version.','lollum'),
	"id" => $shortname . "_custom_logo_retina",
	"std" => "",
	"type" => "upload");

$options[] = array( 
	"name" => __('Custom Favicon','lollum'),
	"desc" => __('Upload a custom favicon for your website (16px x 16px or 32px x 32px Png/Gif).','lollum'),
	"id" => $shortname . "_custom_favicon",
	"std" => "",
	"type" => "upload");

$options[] = array( 
	"name" => __('Enable Responsive','lollum'),
	"desc" => __('Check this to enable the responsive features.','lollum'),
	"id" => $shortname . "_check_responsive",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Breadcumbs','lollum'),
	"desc" => __('Check this to enable breadcumbs.','lollum'),
	"id" => $shortname . "_check_breadcumbs",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Author Bio','lollum'),
	"desc" => __('Check this to enable author bio below posts.','lollum'),
	"id" => $shortname . "_check_author_bio",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Love','lollum'),
	"desc" => __('Check this to enable the "love" functionality.','lollum'),
	"id" => $shortname . "_check_love_functionality",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Animations','lollum'),
	"desc" => __('Check this to enable the animations.','lollum'),
	"id" => $shortname . "_check_animations",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Animations Touch Devices','lollum'),
	"desc" => __('Check this to enable the animations on touch devices.','lollum'),
	"id" => $shortname . "_check_animations_touch",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Sticky Header','lollum'),
	"desc" => __('Check this to enable the "sticky" header functionality.','lollum'),
	"id" => $shortname . "_check_sticky",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Social Sharer on Posts','lollum'),
	"desc" => __('Check this to enable the social sharer on posts.','lollum'),
	"id" => $shortname . "_check_sharer_posts",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Social Sharer on Projects','lollum'),
	"desc" => __('Check this to enable the social sharer on projects.','lollum'),
	"id" => $shortname . "_check_sharer_projects",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Social Sharer on Products','lollum'),
	"desc" => __('Check this to enable the social sharer on products.','lollum'),
	"id" => $shortname . "_check_sharer_products",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Social Sharer on Jobs','lollum'),
	"desc" => __('Check this to enable the social sharer on jobs.','lollum'),
	"id" => $shortname . "_check_sharer_jobs",
	"std" => "true",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Tracking Code','lollum'),
	"desc" => __('Paste your Google Analytics tracking code here','lollum'),
	"id" => $shortname . "_google_analytics",
	"std" => "",
	"type" => "textarea");

$options[] = array( 
	"name" => __('Font Settings','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Select the primary font','lollum'),
	"desc" => __('Select the primary font of your website','lollum'),
	"id" => $shortname . "_primary_font",
	"options-web" => $web_fonts,
	"options-google" => $google_fonts,
	"std" => "Open Sans",
	"type" => "font-select");

$options[] = array( 
	"name" => __('Select the secondary font','lollum'),
	"desc" => __('Select the secondary font of your website','lollum'),
	"id" => $shortname . "_secondary_font",
	"options-web" => $web_fonts,
	"options-google" => $google_fonts,
	"std" => "Montserrat",
	"type" => "font-select");

$options[] = array(
	"name" => "",
	"message" => __('Define the font weight used in your website. Can be useful when a certain weight is not available in Google','lollum'),
	"type" => "section-description");

$options[] = array( 
	"name" => __('Primary Font - Normal weight','lollum'),
	"desc" => __('Select the normal font weight for the primary font.','lollum'),
	"id" => $shortname . "_ff_normal",
	"options" => array('300', '400', '600', '700'),
	"std" => "400",
	"type" => "select");

$options[] = array( 
	"name" => __('Primary Font - Semibold weight','lollum'),
	"desc" => __('Select the semibold font weight for the primary font.','lollum'),
	"id" => $shortname . "_ff_semibold",
	"options" => array('300', '400', '600', '700'),
	"std" => "600",
	"type" => "select");

$options[] = array( 
	"name" => __('Primary Font - Bold weight','lollum'),
	"desc" => __('Select the bold font weight for the primary font.','lollum'),
	"id" => $shortname . "_ff_bold",
	"options" => array('300', '400', '600', '700'),
	"std" => "700",
	"type" => "select");

$options[] = array( 
	"name" => __('Primary Font - Light weight','lollum'),
	"desc" => __('Select the light font weight for the primary font.','lollum'),
	"id" => $shortname . "_ff_light",
	"options" => array('300', '400', '600', '700'),
	"std" => "300",
	"type" => "select");

$options[] = array( 
	"name" => __('Secondary Font - Normal weight','lollum'),
	"desc" => __('Select the normal font weight for the secondary font.','lollum'),
	"id" => $shortname . "_sf_normal",
	"options" => array('300', '400', '600', '700'),
	"std" => "400",
	"type" => "select");

$options[] = array( 
	"name" => __('Secondary Font - Bold weight','lollum'),
	"desc" => __('Select the bold font weight for the secondary font.','lollum'),
	"id" => $shortname . "_sf_bold",
	"options" => array('300', '400', '600', '700'),
	"std" => "700",
	"type" => "select");

$options[] = array( 
	"name" => __('Background Image','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => "",
	"message" => __('Select an image. Note that you have to select a boxed layout for a better result. Also, remember that the background color is defined in the General Colors tab (it\'s important if you upload an image with alpha channel).', 'lollum'),
	"type" => "section-description");

$layout_url = LOLLUMCORE_URI . 'admin/images/';

$options[] = array( 
	"name" => __('Layout','lollum'),
	"desc" => __('Select between boxed and stretched layout.','lollum'),
	"id" => $shortname . "_layout",
	"std" => "layout-stretched",
	"type" => "radio-images",
	"options" => array(
		'layout-boxed' => $layout_url . 'boxed.png',
		'layout-stretched' => $layout_url . 'stretched.png')
	);

$options[] = array( 
	"name" => __('Enable Background Image','lollum'),
	"desc" => __('Check this to enable a background image.','lollum'),
	"id" => $shortname . "_bg_image_check",
	"std" => "",
	"type" => "checkbox");				

$options[] = array( 
	"name" => __('Select Background Type','lollum'),
	"desc" => __('Select the background type','lollum'),
	"id" => $shortname . "_background_img_type",
	"options" => array("Default image", "Custom image"),
	"std" => "Default image",
	"type" => "section-select");

$options[] = array( 
	"id" => "default_image",
	"class" => $shortname . "_background_img_type",
	"type" => "open-section");

$options[] = array( 
	"name" => __('Select Background Image','lollum'),
	"desc" => __('Set the default background image to use on all pages','lollum'),
	"id" => $shortname . "_default_image_bg",
	"options" => $lol_images_bg,
	"std" => "Texturetastic Gray",
	"type" => "image-preview");

$options[] = array(
	"type" => "close-section");

$options[] = array( 
	"id" => "custom_image",
	"class" => $shortname . "_background_img_type",
	"type" => "open-section");

$options[] = array( 
	"name" => __('Custom Background Image','lollum'),
	"desc" => __('Upload an image for your background theme.','lollum'),
	"id" => $shortname . "_custom_image_bg",
	"std" => "",
	"type" => "upload");

$bg_repeat = array(
	'repeat' => 'Repeat',
	'repeat-x' => 'Repeat X',
	'repeat-y' => 'Repeat Y',
	'no-repeat' => 'No Repeat');

$options[] = array( 
	"name" => __('Custom Background Image Repeat', 'lollum'),
	"desc" => __('Select the background repeat for the custom background image', 'lollum'),
	"id" => $shortname . "_custom_image_bg_repeat",
	"std" => "repeat",
	"type" => "radio",
	"options" => $bg_repeat);

$options[] = array( 
	"name" => __('Background Attachment','lollum'),
	"desc" => __('Check this to enable a fixed attachment.','lollum'),
	"id" => $shortname . "_custom_image_bg_attachment",
	"std" => "",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Background Size Cover','lollum'),
	"desc" => __('Check this to enable a cover background size.','lollum'),
	"id" => $shortname . "_custom_image_bg_cover",
	"std" => "",
	"type" => "checkbox");

$options[] = array(
	"type" => "close-section");

$options[] = array( 
	"name" => __('General Colors','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Body Background Color', 'lollum'),
	"desc" => __('Select the background color of the body', 'lollum'),
	"id" => $shortname . "_body_bg_color",
	"std" => "#ffffff",
	"type" => "color");

$options[] = array( 
	"name" => __('Header Background Color', 'lollum'),
	"desc" => __('Select the background color of the header', 'lollum'),
	"id" => $shortname . "_header_bg_color",
	"std" => "#1a1d1f",
	"type" => "color");

$options[] = array( 
	"name" => __('First Accent Color', 'lollum'),
	"desc" => __('Select the first accent color of the theme', 'lollum'),
	"id" => $shortname . "_first_ac_color",
	"std" => "#617c96",
	"type" => "color");

$options[] = array( 
	"name" => __('Second Accent Color', 'lollum'),
	"desc" => __('Select the second accent color of the theme', 'lollum'),
	"id" => $shortname . "_second_ac_color",
	"std" => "#e74c3c",
	"type" => "color");

$options[] = array( 
	"name" => __('Third Accent Color', 'lollum'),
	"desc" => __('Select the third accent color of the theme', 'lollum'),
	"id" => $shortname . "_third_ac_color",
	"std" => "#262f3a",
	"type" => "color");

$options[] = array( 
	"name" => __('Primary Button Color', 'lollum'),
	"desc" => __('Select the primary color of the button', 'lollum'),
	"id" => $shortname . "_first_btn_color",
	"std" => "#e74c3c",
	"type" => "color");

$options[] = array( 
	"name" => __('Second Button Color', 'lollum'),
	"desc" => __('Select the secondary color of the button', 'lollum'),
	"id" => $shortname . "_second_btn_color",
	"std" => "#617c96",
	"type" => "color");

$options[] = array( 
	"name" => __('Preloader','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Enable Preloader','lollum'),
	"desc" => __('Check this to enable the preloader effect.','lollum'),
	"id" => $shortname . "_check_preloader",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Enable Preloader On Mobile','lollum'),
	"desc" => __('Check this to enable the preloader effect on mobile devices.','lollum'),
	"id" => $shortname . "_check_preloader_mobile",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Spinner Type','lollum'),
	"desc" => __('Select the spinner.','lollum'),
	"id" => $shortname . "_spinner_type",
	"options" => array('1', '2', '3', '4', '5', '6', '7', '8'),
	"std" => "1",
	"type" => "select");

$options[] = array( 
	"name" => __('Spinner Color', 'lollum'),
	"desc" => __('Select the color of the spinner', 'lollum'),
	"id" => $shortname . "_spinner_color",
	"std" => "#ffffff",
	"type" => "color");

$options[] = array( 
	"name" => __('Preloader Background Color', 'lollum'),
	"desc" => __('Select the background color of the splash', 'lollum'),
	"id" => $shortname . "_splash_bg",
	"std" => "#262f3a",
	"type" => "color");

$options[] = array( 
	"name" => __('Header Options','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Display Top Header','lollum'),
	"desc" => __('Check this to display the top header section.','lollum'),
	"id" => $shortname . "_check_top_header",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Display social accounts','lollum'),
	"desc" => __('Check this to display your social accounts in the header.','lollum'),
	"id" => $shortname . "_check_social_header",
	"std" => "false",
	"type" => "checkbox");

if (lollum_check_is_woocommerce()) {

$options[] = array( 
	"name" => __('Display Cart Header','lollum'),
	"desc" => __('Check this to display the cart in the header section.','lollum'),
	"id" => $shortname . "_check_cart_header",
	"std" => "false",
	"type" => "checkbox");

}

$options[] = array( 
	"name" => __('Display menu','lollum'),
	"desc" => __('Check this to display a menu in your header.','lollum'),
	"id" => $shortname . "_check_menu_header",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => "",
	"message" => __('Search field settings.','lollum'),
	"type" => "section-description");

$options[] = array( 
	"name" => __('Display search','lollum'),
	"desc" => __('Check this to display a search field in your header.','lollum'),
	"id" => $shortname . "_check_search_header",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Search field type','lollum'),
	"desc" => __('Select the type of your search field.','lollum'),
	"id" => $shortname . "_type_search_header",
	"options" => array('normal', 'products'),
	"std" => "normal",
	"type" => "select");

$options[] = array( 
	"name" => "",
	"message" => __('Company details.','lollum'),
	"type" => "section-description");

$options[] = array( 
	"name" => __('Phone','lollum'),
	"desc" => __('Write your phone number.','lollum'),
	"id" => $shortname . "_tel_company",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('E-mail','lollum'),
	"desc" => __('Type your email address.','lollum'),
	"id" => $shortname . "_email_company",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Footer Options','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Footer Color','lollum'),
	"desc" => __('Select the style of the footer.','lollum'),
	"id" => $shortname . "_footer_style",
	"options" => array('dark', 'light'),
	"std" => "dark",
	"type" => "select");

$options[] = array( 
	"name" => __('Display footer bottom section','lollum'),
	"desc" => __('Check this to display the footer bottom section.','lollum'),
	"id" => $shortname . "_footer_bottom_check",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Copyright Text','lollum'),
	"desc" => __('Type your copyright text.','lollum'),
	"id" => $shortname . "_footer_copy",
	"std" => "",
	"type" => "textarea");

$options[] = array( 
	"name" => __('Display social accounts','lollum'),
	"desc" => __('Check this to display your social accounts in the footer.','lollum'),
	"id" => $shortname . "_check_social_footer",
	"std" => "false",
	"type" => "checkbox");

$options[] = array( 
	"name" => __('Social Accounts','lollum'),
	"type" => "heading");
	
$options[] = array( 
	"name" => __('Facebook','lollum'),
	"desc" => __('Type the URL of your Facebook account (remember "http://").','lollum'),
	"id" => $shortname . "_f_facebook",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Twitter','lollum'),
	"desc" => __('Type the URL of your Twitter account (remember "http://").','lollum'),
	"id" => $shortname . "_f_twitter",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Dribbble','lollum'),
	"desc" => __('Type the URL of your Dribbble account (remember "http://").','lollum'),
	"id" => $shortname . "_f_dribbble",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('LinkedIn','lollum'),
	"desc" => __('Type the URL of your LinkedIn account (remember "http://").','lollum'),
	"id" => $shortname . "_f_linkedin",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Flickr','lollum'),
	"desc" => __('Type the URL of your Flickr account (remember "http://").','lollum'),
	"id" => $shortname . "_f_flickr",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Tumblr','lollum'),
	"desc" => __('Type the URL of your Tumblr account (remember "http://").','lollum'),
	"id" => $shortname . "_f_tumblr",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Vimeo','lollum'),
	"desc" => __('Type the URL of your Vimeo account (remember "http://").','lollum'),
	"id" => $shortname . "_f_vimeo",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Vine','lollum'),
	"desc" => __('Type the URL of your Vine account (remember "http://").','lollum'),
	"id" => $shortname . "_f_vine",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Youtube','lollum'),
	"desc" => __('Type the URL of your Youtube account (remember "http://").','lollum'),
	"id" => $shortname . "_f_youtube",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Instagram','lollum'),
	"desc" => __('Type the URL of your Instagram account (remember "http://").','lollum'),
	"id" => $shortname . "_f_instagram",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Google Plus','lollum'),
	"desc" => __('Type the URL of your Google Plus account (remember "http://").','lollum'),
	"id" => $shortname . "_f_google",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('StumbleUpon','lollum'),
	"desc" => __('Type the URL of your StumbleUpon account (remember "http://").','lollum'),
	"id" => $shortname . "_f_stumbleupon",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Forrst','lollum'),
	"desc" => __('Type the URL of your Forrst account (remember "http://").','lollum'),
	"id" => $shortname . "_f_forrst",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Behance','lollum'),
	"desc" => __('Type the URL of your Behance account (remember "http://").','lollum'),
	"id" => $shortname . "_f_behance",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Digg','lollum'),
	"desc" => __('Type the URL of your Digg account (remember "http://").','lollum'),
	"id" => $shortname . "_f_digg",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Delicious','lollum'),
	"desc" => __('Type the URL of your Delicious account (remember "http://").','lollum'),
	"id" => $shortname . "_f_delicious",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('DeviantArt','lollum'),
	"desc" => __('Type the URL of your DeviantArt account (remember "http://").','lollum'),
	"id" => $shortname . "_f_deviantart",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Foursquare','lollum'),
	"desc" => __('Type the URL of your Foursquare account (remember "http://").','lollum'),
	"id" => $shortname . "_f_foursquare",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('GitHub','lollum'),
	"desc" => __('Type the URL of your GitHub account (remember "http://").','lollum'),
	"id" => $shortname . "_f_github",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('MySpace','lollum'),
	"desc" => __('Type the URL of your MySpace account (remember "http://").','lollum'),
	"id" => $shortname . "_f_myspace",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Orkut','lollum'),
	"desc" => __('Type the URL of your Orkut account (remember "http://").','lollum'),
	"id" => $shortname . "_f_orkut",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Pinterest','lollum'),
	"desc" => __('Type the URL of your Pinterest account (remember "http://").','lollum'),
	"id" => $shortname . "_f_pinterest",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('SoundCloud','lollum'),
	"desc" => __('Type the URL of your SoundCloud account (remember "http://").','lollum'),
	"id" => $shortname . "_f_soundcloud",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('Stack Overflow','lollum'),
	"desc" => __('Type the URL of your Stack Overflow account (remember "http://").','lollum'),
	"id" => $shortname . "_f_stackoverflow",
	"std" => "",
	"type" => "text");

$options[] = array( 
	"name" => __('RSS','lollum'),
	"desc" => __('Type your RSS feed URL (remember "http://").','lollum'),
	"id" => $shortname . "_f_rss",
	"std" => "",
	"type" => "text");

if (lollum_check_is_woocommerce()) {

$options[] = array( 
	"name" => __('Woocommerce','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Shop Sidebar','lollum'),
	"desc" => __('With this option you can select your global shop layout.','lollum'),
	"id" => $shortname . "_woo_search_sidebar",
	"options" => array('left', 'right', 'full'),
	"std" => "left",
	"type" => "select");

$options[] = array( 
	"name" => __('Create Account Text','lollum'),
	"desc" => __('This text is visible on your "My Account" page (if you enable the registration in this page)','lollum'),
	"id" => $shortname . "_woo_create_account_text",
	"std" => "",
	"type" => "textarea");

$options[] = array( 
	"name" => __('Cover in product categories','lollum'),
	"desc" => __('Check this to display a cover in your product category pages (you need to upload an image in Products > Categories)','lollum'),
	"id" => $shortname . "_check_cover_cats",
	"std" => "true",
	"type" => "checkbox");

}

$options[] = array( 
	"name" => __('Custom CSS','lollum'),
	"type" => "heading");

$options[] = array( 
	"name" => __('Custom CSS','lollum'),
	"desc" => __('Paste here your small css snippets','lollum'),
	"id" => $shortname . "_custom_css",
	"std" => "",
	"type" => "textarea-css");

update_option('lol_template',$options); 					  
update_option('lol_shortname',$shortname);

   }
}