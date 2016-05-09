<?php namespace Leanp;

/**
 * Main class loader for initializing and  setting up the plugin.
 *
 * @since 0.1.0
 */
class PluginSetup {

	/**
	 * Initialise the program after everything is ready.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		$inc_dir = LEANP_PLUGIN_DIR . 'src';

		$modules_dir = LEANP_PLUGIN_DIR . 'src/Modules';

		// Run the init() function for any inc classes which have it.
		foreach ( glob( $inc_dir . '/*.php' ) as $file ) {
			$class = '\\' . __NAMESPACE__ . '\\' . basename( $file, '.php' );
			if ( method_exists( $class, 'init' ) ) {
				call_user_func( [ $class, 'init' ] );
			}
		}

		// Run the Bootstrap::init() function for any modules which have it.
		foreach ( glob( $modules_dir . '/*', GLOB_ONLYDIR ) as $dir ) {
			$bootstrap = '\\' . __NAMESPACE__ . '\\Modules\\' . basename( $dir ) . '\\Bootstrap';
			if ( method_exists( $bootstrap, 'init' ) ) {
				call_user_func( [ $bootstrap, 'init' ] );
			}
		}
	}

	/**
	 * Checks program environment to see if all dependencies are available. If at least one
	 * dependency is absent, deactivate the plugin.
	 *
	 * @since 0.1.0
	 */
	public static function maybe_deactivate() {

		global $wp_version;

		load_plugin_textdomain( LEANP_TEXT_DOMAIN );

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( version_compare( $wp_version, LEANP_MINIMUM_WP_VERSION, '<' ) ) {

			deactivate_plugins( LEANP_PLUGIN_NAME );

			echo wp_kses(
				sprintf(
					esc_html__(
						'Plugin %s requires WordPress %s or higher.',
						LEANP_TEXT_DOMAIN
					), LEANP_API_VERSION, LEANP_MINIMUM_WP_VERSION
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
