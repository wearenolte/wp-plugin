<?php namespace Leanp\Modules\Widgets;

use Lean\Widgets;

/**
 * Class Bootstrap
 *
 * @package Skaled
 */
class Bootstrap {
	/**
	 * Init
	 */
	public static function init() {
		// Widgets.
		Widgets\Register::init( [
			'leean' => [
				/* List all required Leean widgets here (see https://github.com/moxie-leean/wp-widgets) */
			],
		] );

		// Widget Areas.
		register_sidebar( [
			'id' => 'footer',
			'name' => 'Footer',
			'description' => 'Footer Widget area.',
		] );
	}
}
