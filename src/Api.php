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
		Endpoints\Collection::init();
		Endpoints\Post::init();
		Endpoints\StaticApi::init();
		Endpoints\AdminBarApi::init();

		add_filter( 'allowed_http_origin', [ __CLASS__, 'gform_allowed_http_origin' ] );
		
		add_filter( 'ln_endpoints_data_routes', [ __CLASS__, 'patternlab_routes' ] );
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
	 * Add routes required for patternlab.
	 * (temporary fix until we do https://github.com/moxie-lean/ng-patternlab/issues/54).
	 *
	 * @param array $routes The routes.
	 * @return array
	 */
	public static function patternlab_routes( $routes ) {
		return array_merge( $routes, [
			[
				'url' => '/patterns',
				'state' => 'patterns',
				'template' => 'patterns',
				'request' => false,
			],
			[
				'url' => '/examples/:exampleId',
				'state' => 'patternsExamples',
				'template' => 'examples',
				'request' => false,
			],
		] );
	}
}
