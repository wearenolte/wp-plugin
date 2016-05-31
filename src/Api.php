<?php namespace Leanp;

use Lean\Endpoints;

/**
 * Set-up api endpoints.
 */
class Api
{
	/**
	 * Init.
	 */
	public static function init() {
		Endpoints\Routes::init();
		Endpoints\StaticApi::init();
		Endpoints\AdminBarApi::init();

		\Lean\Acf\RestApi::init();
		\Lean\Metadata\RestApi::init();

		add_filter( 'allowed_http_origin', [ __CLASS__, 'gform_allowed_http_origin' ] );

		add_filter( 'rest_endpoints', [ __CLASS__, 'disable_endpoints' ] );
	}

	/**
	 * Set the http origin to "*" for certain gforms endpoints.
	 *
	 * @param bool $allow_all Whether to allow all domains.
	 * @return bool
	 */
	public static function gform_allowed_http_origin( $allow_all ) {
		$method = isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : false;
		$uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : false;

		return
			( 'GET' === $method && 1 === preg_match( '/gravityformsapi\/forms\/?\?/', $uri ) ) ||
			( 'GET' === $method && 1 === preg_match( '/gravityformsapi\/forms\/\d*\/?\?/', $uri ) ) ||
			( 'POST' === $method && 1 === preg_match( '/gravityformsapi\/forms\/\d*\/submissions\/?/', $uri ) )
				? true : $allow_all;
	}

	/**
	 * Disable unwanted endpoints (for now just users for security).
	 *
	 * @param array $endpoints All the active endpoints.
	 * @return array
	 */
	public static function disable_endpoints( $endpoints ) {
		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}

		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}

		return $endpoints;
	}
}
