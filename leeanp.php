<?php
/**
 * Main plugin file
 *
 * @since 0.1.0
 * @package Leeanp
 */

/**
 * Plugin Name: Moxie Leean
 * Description: Barebones modular WordPress plugin.
 * Version: 0.1.0
 * Author: Moxie
 * Author URI: http://getmoxied.net
 * Text Domain: leeanp
 */

define( 'LEEANP_PLUGIN_NAME', 'LeeanPlugin' );
define( 'LEEANP_PLUGIN_VERSION', '0.1.0' );
define( 'LEEANP_MINIMUM_WP_VERSION', '4.3.1' );
define( 'LEEANP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'LEEANP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LEEANP_TEXT_DOMAIN', 'leeanp' );

define( 'LEEANP_API_VERSION', '1' );
define( 'LEEANP_API_NAMESPACE', 'leeanp/v' . LEEANP_API_VERSION );

require_once LEEANP_PLUGIN_DIR . 'class-leeanp.php';
require_once LEEANP_PLUGIN_DIR . 'vendor/autoload.php';

$class_name = '\Leeanp\Leeanp_Setup';
register_activation_hook( __FILE__, array( $class_name, 'maybe_deactivate' ) );
register_deactivation_hook( __FILE__, array( $class_name, 'flush_rewrite_rules' ) );
$class_name::init();
