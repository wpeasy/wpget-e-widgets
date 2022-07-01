<?php
/**
 * Plugin Name:       WPGet Elementor Widgets
 * Plugin URI:        https://www.wpget.net
 * Description:       Common Widgets by WPGet
 * Version:           0.0.1
 * Author:            Alan Blair
 * Author URI:        https://www.wpget.net
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wpget-e-widgets
 */

namespace WPGet_WPG_WIDGETS_Widgets_Plugin;

use WPGet_Elementor_Widgets\Application;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'WPG_WIDGETS_VERSION', '1.0.0' );
define( 'WPG_WIDGETS__FILE__', __FILE__ );
define( 'WPG_WIDGETS_PLUGIN_BASE', plugin_basename( WPG_WIDGETS__FILE__ ) );
define( 'WPG_WIDGETS_PATH', plugin_dir_path( WPG_WIDGETS__FILE__ ) );
define( 'WPG_WIDGETS_URL', plugin_dir_url(WPG_WIDGETS__FILE__));
define( 'WPG_WIDGETS_MODULE_DIR', __DIR__ . '/src/WPGet_Elementor_Widgets/Modules/');
define( 'WPG_WIDGETS_CLASS_BASE', 'WPGet_Elementor_Widgets');
define( 'WPG_WIDGETS_TEXT_DOMAIN', 'wpget-e-widgets');

require_once __DIR__ . '/vendor/autoload.php';

Application::instance();

