<?php
/**
 * Plugin Name:       WP Guidant
 * Plugin URI:        https://wpcommerz.com/guidant/
 * Description:       Build Multi-step Guided Selling Process & Smart Forms to Convert 10X More Traffic Into Leads & New Customers.
 * Version:           1.0.0
 * Author:            WPCommerz
 * Author URI:        https://wpcommerz.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       guidant
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'GUIDANT_VERSION', '1.0.0' );
defined( 'GUIDANT_PATH' ) or define( 'GUIDANT_PATH', plugin_dir_path( __FILE__ ) );
defined( 'GUIDANT_URL' ) or define( 'GUIDANT_URL', plugin_dir_url( __FILE__ ) );
defined( 'GUIDANT_BASE_PATH' ) or define( 'GUIDANT_BASE_PATH', plugin_basename(__FILE__) );
defined( 'GUIDANT_IMG_DIR' ) or define( 'GUIDANT_IMG_DIR', plugin_dir_url( __FILE__ ) . 'assets/img/' );
defined( 'GUIDANT_CSS_DIR' ) or define( 'GUIDANT_CSS_DIR', plugin_dir_url( __FILE__ ) . 'assets/css/' );
defined( 'GUIDANT_JS_DIR' ) or define( 'GUIDANT_JS_DIR', plugin_dir_url( __FILE__ ) . 'assets/js/' );




require_once GUIDANT_PATH . 'includes/GuidantSettings.php';
require_once GUIDANT_PATH . 'includes/GuidantUtils.php';
require_once GUIDANT_PATH . 'includes/GuidantRenderer.php';
require_once GUIDANT_PATH . 'backend/class-guidant-ajax.php';
require_once GUIDANT_PATH . 'backend/class-guidant-meta.php';
require_once GUIDANT_PATH . 'backend/class-guidant-admin.php';

require_once GUIDANT_PATH . 'frontend/class-guidant-ajax.php';
require_once GUIDANT_PATH . 'frontend/class-guidant-shortcode.php';
require_once GUIDANT_PATH . 'frontend/class-guidant-frontend.php';


