<?php namespace Leanp;

use Lean\AbstractEndpoint;

/**
 * Class to provide swagger docs for the lean endpoints
 * based on https://github.com/zircote/swagger-php
 */
class Swagger extends AbstractEndpoint {

	/**
	 * Swagger annotation
	 *
	 * @SWG\Info(title="Lean Rest API", version="2.0")
	 */

	/**
	 * Swagger annotation
	 *
	 * @SWG\Get(
	 *     path="/swagger",
	 *     @SWG\Response(response="200", description="Swagger json for the Lean Rest API.")
	 * )
	 */

	/**
	 * Endpoint path
	 *
	 * @Override
	 * @var String
	 */
	protected $endpoint = '/swagger';

	/**
	 * Get the data.
	 *
	 * @Override
	 * @param \WP_REST_Request $request The request.
	 *
	 * @return array|\WP_Error
	 */
	public function endpoint_callback( \WP_REST_Request $request ) {
		$folders = [
			WP_PLUGIN_DIR . '/wp-plugin/src',
			WP_PLUGIN_DIR . '/wp-plugin/vendor/moxie-lean/wp-endpoints-admin-bar',
			WP_PLUGIN_DIR . '/wp-plugin/vendor/moxie-lean/wp-endpoints-routes',
			WP_PLUGIN_DIR . '/wp-plugin/vendor/moxie-lean/wp-endpoints-static',
		];

		$data = \Swagger\scan( $folders );

		return $data;
	}
}
