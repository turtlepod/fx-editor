<?php
/**
 * Plugin Name: f(x) Editor
 * Plugin URI: http://genbu.me/plugins/fx-editor/
 * Description: Power-up Your WordPress Visual Editor with Boxes, Buttons, Columns, and more... (No Shortcodes)
 * Version: 1.0.1
 * Author: David Chandra Purnama
 * Author URI: http://shellcreeper.com/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @author David Chandra Purnama <david@genbu.me>
 * @copyright Copyright (c) 2016, Genbu Media
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
**/

/* Plugin Version. */
define( 'FX_EDITOR_VERSION', '1.0.1' );

/* Path to plugin directory. */
define( 'FX_EDITOR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

/* Plugin URL. */
define( 'FX_EDITOR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

/* Load it on init */
add_action( 'plugins_loaded', 'fx_editor_load' );

/**
 * Do Stuff.
 * @since 0.1.0
 */
function fx_editor_load(){

	/* Language */
	load_plugin_textdomain( 'fx-editor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	/* WordPress version */
	global $wp_version;

	/* Minimum WP version 4.0 */
	if ( version_compare( $wp_version, '4.0', '>=' ) ) {

		/* Load Functions  */
		require_once( FX_EDITOR_PATH . 'includes/functions.php' );

		/* Settings Page  */
		if( is_admin() ){
			require_once( FX_EDITOR_PATH . 'includes/settings.php' );
			$fx_editor_settings = new fx_Editor_Settings();
		}

		/* Visual Editor  */
		require_once( FX_EDITOR_PATH . 'includes/mce-editor.php' );
		$fx_editor = new fx_Editor();
	}
}

/* Activation hook
------------------------------------------ */

/* Register activation hook. */
register_activation_hook( __FILE__, 'fx_editor_activation' );


/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
function fx_editor_activation() {
	global $wp_version;

	/* Minimum WP version 4.0 */
	if ( version_compare( $wp_version, '4.0', '<' ) ) {
		set_transient( 'fx_editor_min_wp_notice', true, 5 );
	}
}


/* Add admin notice */
add_action( 'admin_notices', 'fx_editor_admin_notice' );

/**
 * Admin Notice on Activation.
 * @since 0.1.0
 */
function fx_editor_admin_notice(){
	if( get_transient( 'fx_editor_min_wp_notice' ) ){
		global $wp_version;
		?>
		<div class="error notice is-dismissible">
			<p><?php echo sprintf( _x( 'You need use at least WordPress version 4.0 to use <strong>f(x) Editor Plugin</strong>. Currently you are using version %s', 'admin notice' , 'fx-editor' ), $wp_version ); ?></p>
		</div>
		<?php
		delete_transient( 'fx_editor_min_wp_notice' );
	}
}
