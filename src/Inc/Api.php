<?php namespace Leean\Inc;

use Lean\Endpoints;
use Leean\Endpoints as LegacyEndpointsNs;	// These packages will be updated to Lean\Endpoints.

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

		LegacyEndpointsNs\Post::init();
		LegacyEndpointsNs\StaticApi::init();

		add_filter( 'ln_endpoints_data_routes', [ __CLASS__, 'add_extra_routes' ] );
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
}
