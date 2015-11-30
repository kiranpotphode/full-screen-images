<?php

/**
*
* @link              https://github.com/kiranpotphode/full-screen-images
* @since             1.0.0
* @package           Full_Screen_Images
*
* @wordpress-plugin
* Plugin Name:       Full Screen Images
* Plugin URI:        https://github.com/kiranpotphode/full-screen-images
* Description:       Viewing images on the full screen. Using the touch/mouse position for panning.
* Version:           1.0.0
* Author:            Kiran Potphode
* Author URI:        https://github.com/kiranpotphode/full-screen-images
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       full-screen-images
* Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function full_screen_images_scripts() {

	wp_enqueue_script( 'intense-images-js', plugin_dir_url( __FILE__ ) . 'js/intense.min.js', array( 'jquery' ), false, false);

	wp_enqueue_script( 'full-screen-images-js', plugin_dir_url( __FILE__ ) . 'js/full-screen-images.js', array( 'jquery' ), false, false);

}

add_action( 'wp_enqueue_scripts', 'full_screen_images_scripts' );


/**
 * Register menu for Full Screen Image Plugin
 */
function register_full_screen_images_submenu_page() {
	add_submenu_page( 'options-general.php', 'Full Screen Images', 'Full Screen Images', 'manage_options', 'full-screen-images-page', 'full_screen_images_submenu_page_callback' );
}

/**
 * Callback for Full Screen Images
 *
 *  */
function full_screen_images_submenu_page_callback() {

	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>Full Screen Images</h2>';
		echo '<p>View large images up close using simple mouse interaction, and the full screen.</p>';
		echo '<p>Add <code>full-screen-image</code> class to image. The one mandatory attribute is either a <code>src</code>, <code>data-image</code> or a <core>href</core>, which needs to point to an image file. You can use <code>data-image</code> if you want to load in a different version of the image to the original source (higher resolution, for example).</p>';

		echo '<p>You can also pass through titles, and subcaptions, which will appear at the bottom right of the viewer. To do this, you use the <code>data-title</code> and <code>data-caption</code> attributes.</p>';

		echo '<p>This plugin is based on <a href="https://github.com/tholman/intense-images" target="_blank">Intense Image Viewer</a> javascript liabrary by <a href="https://github.com/tholman" target="_blank">Tim Holman</a></p>';
	echo '</div>';

}

add_action('admin_menu', 'register_full_screen_images_submenu_page');

/**
 *  Add settings link on plugin page
 */
function full_screen_images_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=full-screen-images-page.php">More Info</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'full_screen_images_settings_link' );
