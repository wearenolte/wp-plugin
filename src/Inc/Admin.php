<?php namespace Leean\Inc;

/**
 * General admin interface
 */
class Admin
{
	/**
	 * Init.
	 */
	public static function init() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'admin_menu', function () {
			$user = \wp_get_current_user();

			if ( in_array( 'administrator', $user->roles, true ) ) {
				return;
			}

			remove_menu_page( 'tools.php' );
			remove_menu_page( 'themes.php' );
			remove_menu_page( 'edit-comments.php' );
			remove_menu_page( 'edit.php' );
		} );
	}
}
