<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://raghav.com
 * @since             1.0.0
 * @package           Post_Mailer
 *
 * @wordpress-plugin
 * Plugin Name:       post-mailer
 * Plugin URI:        https://postmail.com
 * Description:       mail the post to admin.
 * Version:           1.0.0
 * Author:            Raghav Sharma
 * Author URI:        https://raghav.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       post-mailer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'POST_MAILER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-mailer-activator.php
 */
function activate_post_mailer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-mailer-activator.php';
	Post_Mailer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-mailer-deactivator.php
 */
function deactivate_post_mailer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-mailer-deactivator.php';
	Post_Mailer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_post_mailer' );
register_deactivation_hook( __FILE__, 'deactivate_post_mailer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-post-mailer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_post_mailer() {

	$plugin = new Post_Mailer();
	$plugin->run();

}
run_post_mailer();
