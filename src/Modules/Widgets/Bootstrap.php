<?php namespace Skaled\Modules\Widgets;

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
		register_sidebar( [
			'id' => 'footer_widget_area',
			'name' => 'Footer',
			'description' => 'Footer Widget area.',
		] );
	}
}
