<?php
/**
 * Plugin Name:       ProductFlow - Product Demand Tracker
 * Description:       With this plugin, you can easily track the number of items added to users' carts and get insights into product demand and trends.
 * Version:           1.0.0
 * Author:            MD Raihan
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       product-demand-tracker
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PRODUCT_DEMAND_TRACKER_VERSION', '1.0.0' );

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-product-demand-tracker.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function product_demand_tracker_run() {

	$plugin = new Product_Demand_Tracker();
	$plugin->run();

}
product_demand_tracker_run();
