<?php namespace Leanp\Modules\Home;

use Lean\PageTemplates;

/**
 * Class Bootstrap
 *
 * @package Skaled
 */
class Bootstrap {

	const TEMPLATE = 'home';

	/**
	 * Init
	 */
	public static function init() {
		PageTemplates::register( self::TEMPLATE, 'Home' );
	}
}
