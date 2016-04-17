<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://wenthemes.com
 * @since             1.0.0
 * @package           WEN_Responsive_Columns
 *
 * @wordpress-plugin
 * Plugin Name:       WEN Responsive Columns
 * Plugin URI:        http://wenthemes.com/item/wordpress-plugins/wen-responsive-columns/
 * Description:       Easily display columnized content in your pages or posts.
 * Version:           1.1
 * Author:            WEN Themes
 * Author URI:        http://wenthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wen-responsive-columns
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define
define( 'WEN_RESPONSIVE_COLUMNS_NAME', 'WEN Responsive Columns' );
define( 'WEN_RESPONSIVE_COLUMNS_SLUG', 'wen-responsive-columns' );
define( 'WEN_RESPONSIVE_COLUMNS_BASENAME', basename( dirname( __FILE__ ) ) );
define( 'WEN_RESPONSIVE_COLUMNS_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'WEN_RESPONSIVE_COLUMNS_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wen-responsive-columns-activator.php
 */
function activate_wen_responsive_columns() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wen-responsive-columns-activator.php';
	WEN_Responsive_Columns_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wen-responsive-columns-deactivator.php
 */
function deactivate_wen_responsive_columns() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wen-responsive-columns-deactivator.php';
	WEN_Responsive_Columns_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wen_responsive_columns' );
register_deactivation_hook( __FILE__, 'deactivate_wen_responsive_columns' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wen-responsive-columns.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wen_responsive_columns() {

	$plugin = new WEN_Responsive_Columns();
	$plugin->run();

}
run_wen_responsive_columns();
