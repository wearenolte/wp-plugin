<?php namespace Leanp;
/**
 * Plugin Name: Moxie Leanp
 * Description: Barebones modular WordPress plugin.
 * Version: 0.1.0
 * Author: Moxie
 * Author URI: http://getmoxied.net
 * Text Domain: leanp
 */

// General constants.
define( 'LEANP_PLUGIN_NAME', 'Leanp Plugin' );
define( 'LEANP_PLUGIN_VERSION', '0.1.0' );
define( 'LEANP_MINIMUM_WP_VERSION', '4.3.1' );
define( 'LEANP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LEANP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LEANP_TEXT_DOMAIN', 'leanp' );

// Load Composer autoloader.
require_once LEANP_PLUGIN_DIR . 'vendor/autoload.php';

// Run the plugin setup.
require_once LEANP_PLUGIN_DIR . 'PluginSetup.php';
$class_name = __NAMESPACE__ . '\\PluginSetup';
register_activation_hook( __FILE__, array( $class_name, 'maybe_deactivate' ) );
register_deactivation_hook( __FILE__, array( $class_name, 'flush_rewrite_rules' ) );
add_action( 'init', array( $class_name, 'check_dependencies' ) );
$class_name::init();
