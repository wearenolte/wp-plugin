<?php namespace Leean;
/**
 * Plugin Name: Moxie Leean
 * Description: Barebones modular WordPress plugin.
 * Version: 0.1.0
 * Author: Moxie
 * Author URI: http://getmoxied.net
 * Text Domain: leeanp
 */

// General constants.
define( 'LEEANP_PLUGIN_NAME', 'LeeanPlugin' );
define( 'LEEANP_PLUGIN_VERSION', '0.1.0' );
define( 'LEEANP_MINIMUM_WP_VERSION', '4.3.1' );
define( 'LEEANP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LEEANP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LEEANP_TEXT_DOMAIN', 'leeanp' );

// Load Composer autoloader.
require_once LEEANP_PLUGIN_DIR . 'vendor/autoload.php';

// Run the plugin setup.
require_once LEEANP_PLUGIN_DIR . 'PluginSetup.php';
$class_name = __NAMESPACE__ . '\\PluginSetup';
register_activation_hook( __FILE__, array( $class_name, 'maybe_deactivate' ) );
register_deactivation_hook( __FILE__, array( $class_name, 'flush_rewrite_rules' ) );
$class_name::init();
