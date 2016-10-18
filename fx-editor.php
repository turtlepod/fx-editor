<?php
/**
 * Plugin Name: f(x) Editor
 * Plugin URI: http://genbumedia.com/plugins/fx-editor/
 * Description: Power-up Your WordPress Visual Editor with Boxes, Buttons, Columns, and more... (No Shortcodes).
 * Version: 1.3.0
 * Author: David Chandra Purnama
 * Author URI: http://shellcreeper.com/
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: fx-editor
 * Domain Path: /languages
**/

/* Plugin Version. */
define( 'FX_EDITOR_VERSION', '1.3.0' );

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

		/* Content Only Filter  */
		require_once( FX_EDITOR_PATH . 'includes/filters.php' );
	}

	/* Plugin Action Link */
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'fx_editor_plugin_action_links' );
}

/**
 * Plugin Action Support Link
 * @since 1.2.0
 */
function fx_editor_plugin_action_links( $links ){

	/* Get current user info */
	if( function_exists( 'wp_get_current_user' ) ){
		$current_user = wp_get_current_user();
	}
	else{
		global $current_user;
		get_currentuserinfo();
	}

	/* Build support url */
	$support_url = add_query_arg(
		array(
			'about'      => urlencode( 'f(x) Editor (v.' . FX_EDITOR_VERSION . ')' ),
			'sp_name'    => urlencode( $current_user->display_name ),
			'sp_email'   => urlencode( $current_user->user_email ),
			'sp_website' => urlencode( home_url() ),
		),
		'http://genbumedia.com/contact/'
	);

	/* Add support link */
	$links[] = '<a target="_blank" href="' . esc_url( $support_url ) . '">' . __( 'Get Support', 'fx-editor' ) . '</a>';

	return $links;
}

