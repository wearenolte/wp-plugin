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

		add_filter( 'ln_endpoints_data_routes', [ __CLASS__, 'add_extra_routes' ] );

		add_filter( 'allowed_http_origin', [ __CLASS__, 'gform_allowed_http_origin' ] );
	}

	/**
	 * Add extra routes the the endpoint
	 *
	 * @param array $routes The current set of routes.
	 * @return mixed
	 */
	public static function add_extra_routes( $routes ) {
		$extra_routes = [
			[
				'state' => 'blogIndex',
				'url' => '/blog/',
				'template' => 'blog',
				'endpoint' => 'collection',
				'params' => [
					/* Add additional params here */
				],
			],
			[
				'state' => 'blogPost',
				'url' => '/blog/:slug',
				'template' => 'blog-single',
				'endpoint' => 'post',
			],
		];

		return array_merge( $routes, $extra_routes );
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
}
