<?php namespace Leeanp;
/**
 * The main plugin file for setup and initialization
 *
 * @since 0.1.0
 *
 * @package LeeanP
 */


/**
 * Main class loader for initializing and  setting up the plugin.
 *
 * @since 0.1.0
 */
class LeeanP_Setup {

	/**
	 * Initialise the program after everything is ready.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		//TODO: autoload Bootstep::init() for each Module and Inc
	}

	/**
	 * Checks program environment to see if all dependencies are available. If at least one
	 * dependency is absent, deactivate the plugin.
	 *
	 * @since 0.1.0
	 */
	public static function maybe_deactivate() {

		global $wp_version;

		load_plugin_textdomain( LEEANP_TEXT_DOMAIN );

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( version_compare( $wp_version, LEEANP_MINIMUM_WP_VERSION, '<' ) ) {

			deactivate_plugins( LEEANP_PLUGIN_NAME );

			echo wp_kses(
				sprintf(
					esc_html__(
						'Plugin %s requires WordPress %s or higher.',
						LEEANP_TEXT_DOMAIN
					), LEEANP_API_VERSION, LEEANP_MINIMUM_WP_VERSION
				),
				array()
			);
			wp_die();
			exit;
		}
	}

	/**
	 * Register the CPTs and flush the rewrite rules in order to have corrent
	 * permalinks.
	 *
	 * @since 0.1.0
	 */
	public static function flush_rewrite_rules() {
		self::init();
		flush_rewrite_rules();
	}
}
