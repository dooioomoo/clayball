<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              ryan.asdraw.com
 * @since             1.5.7
 * @package           Clayball
 *
 * @wordpress-plugin
 * Plugin Name:       ClayBall
 * Plugin URI:        www.fduit.net
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.5.7
 * Author:            jevinsong
 * Author URI:        ryan.asdraw.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       clayball
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * 创建常量
 */
$masterfolder = basename(__DIR__);
define('__CLAYBALLPLUGINPATH__', __DIR__);
define('__CLAYBALLTHEMEPATH__', get_template_directory());
define('__CLAYBALLPLUGINURI__', plugins_url().'/'.$masterfolder);
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CLAYBALL_VERSION', '1.5.7' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-clayball-activator.php
 */
function activate_clayball() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clayball-activator.php';
	
	Clayball_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-clayball-deactivator.php
 */
function deactivate_clayball() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clayball-deactivator.php';
	Clayball_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_clayball' );
register_deactivation_hook( __FILE__, 'deactivate_clayball' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'public/partials/clayball-public-shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'public/partials/clayball-public-display.php';

require plugin_dir_path( __FILE__ ) . 'includes/class-clayball.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_clayball() {

	$plugin = new Clayball();
	$plugin->run();

}
run_clayball();

