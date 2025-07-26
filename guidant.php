<?php
/**
 * Plugin Name:       WP Guidant
 * Plugin URI:        https://wpcommerz.com/guidant/
 * Description:       Build Multi-step Guided Selling Process & Smart Forms to Convert 10X More Traffic Into Leads & New Customers.
 * Version:           1.2.4
 * Author:            WPCommerz
 * Author URI:        https://wpcommerz.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       guidant
 * Domain Path:       /languages
 */


// If this file is called directly, exit.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'GUIDANT_VERSION', '1.2.4' );
defined( 'GUIDANT_PATH' ) or define( 'GUIDANT_PATH', plugin_dir_path( __FILE__ ) );
defined( 'GUIDANT_URL' ) or define( 'GUIDANT_URL', plugin_dir_url( __FILE__ ) );
defined( 'GUIDANT_BASE_PATH' ) or define( 'GUIDANT_BASE_PATH', plugin_basename(__FILE__) );
defined( 'GUIDANT_IMG_DIR' ) or define( 'GUIDANT_IMG_DIR', plugin_dir_url( __FILE__ ) . 'assets/img/' );
defined( 'GUIDANT_CSS_DIR' ) or define( 'GUIDANT_CSS_DIR', plugin_dir_url( __FILE__ ) . 'assets/css/' );
defined( 'GUIDANT_JS_DIR' ) or define( 'GUIDANT_JS_DIR', plugin_dir_url( __FILE__ ) . 'assets/js/' );

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_guidant() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
        require_once __DIR__ . '/appsero/src/Client.php';
    }

    $client = new Appsero\Client( '5862c38b-086b-417e-b2bd-6aeed31716a1', 'WP Guidant', __FILE__ );

    // Active insights
    $client->insights()->init();

}

add_action( 'init', 'appsero_init_tracker_guidant' );

add_action('init', function() {
    load_plugin_textdomain( 'guidant', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
});


require_once GUIDANT_PATH . 'includes/GuidantSettings.php';
require_once GUIDANT_PATH . 'includes/GuidantUtils.php';
require_once GUIDANT_PATH . 'includes/GuidantRenderer.php';
require_once GUIDANT_PATH . 'backend/class-guidant-ajax.php';
require_once GUIDANT_PATH . 'backend/class-guidant-meta.php';
require_once GUIDANT_PATH . 'backend/class-guidant-admin.php';

require_once GUIDANT_PATH . 'frontend/class-guidant-ajax.php';
require_once GUIDANT_PATH . 'frontend/class-guidant-shortcode.php';
require_once GUIDANT_PATH . 'frontend/class-guidant-frontend.php';