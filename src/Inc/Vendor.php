<?php namespace Leean\Inc;

use Leean\Endpoints;

/**
 * Set-up vendor libs
 */
class Vendor
{
	/**
	 * Init.
	 */
	public static function init() {
		Endpoints\View::init();
	}
}
