<?php
/**
 * Visual Editor Features.
**/
/* Do not access this file directly */
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * f(x) Editor Class
 * @since 0.1.0
 */
class fx_Editor{

	/**
	 * Class Constructor.
	 * @since 0.1.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'setup' ), 10 );
	}

	/**
	 * Setup plugins functions
	 * @since  0.1.0
	 */
	public function setup(){

		/* Register TinyMCE External Plugins */
		add_filter( 'mce_external_plugins', array( $this, 'register_mce_external_plugins' ) );

		/* Add button to TinyMCE button 1st Row */
		add_filter( 'mce_buttons', array( $this, 'mce_add_buttons_1' ), 1, 2 );

		/* Add button to TinyMCE button 2nd Row */
		add_filter( 'mce_buttons_2', array( $this, 'mce_add_buttons_2' ), 1, 2 );

		/* Add button to TinyMCE button 4th Row */
		add_filter( 'mce_buttons_4', array( $this, 'mce_add_buttons_4' ), 1, 2 );

		/* Only load CSS if custom features (boxes,buttons,columns) are activated. */
		if( fx_editor_is_custom_feature_active() ){

			/* Add CSS to TinyMCE Editor */
			add_filter( 'mce_css', array( $this, 'editor_css' ) );

			/* Enqueue stylesheets on front end. */
			add_action( 'wp_enqueue_scripts', array( $this, 'front_css' ), 1 );
		}

		/* Before Init: for P to BR */
		add_filter( 'tiny_mce_before_init', array( $this, 'p_to_br' ) );

	}

	/**
	 * Register MCE External Plugins
	 * @since 0.1.0
	 */
	public function register_mce_external_plugins( $plugins ){

		/* tinyMCE version */
		global $tinymce_version;

		/* Only for WP 3.9 with tinyMCE 4 */
		if ( version_compare( $tinymce_version, '400', '>=' ) ) {

			/* Boxes */
			if( fx_editor_get_option( 'boxes', false ) ){
				$plugins['wpe_addon_boxes'] = FX_EDITOR_URL . "js/mce-plugin-boxes.js";
			}
			/* Buttons */
			if( fx_editor_get_option( 'buttons', false ) ){
				$plugins['wpe_addon_buttons'] = FX_EDITOR_URL . "js/mce-plugin-buttons.js";
			}
			/* Columns */
			if( fx_editor_get_option( 'columns', false ) ){
				$plugins['wpe_addon_columns'] = FX_EDITOR_URL . "js/mce-plugin-columns.js";
			}
		}

		return $plugins;
	}

	/**
	 * Add button to 1st row in editor
	 * @since 0.1.0
	 */
	public function mce_add_buttons_1( $buttons, $editor_id ){
		if ( 'content' != $editor_id ){
			return $buttons;
		}
		if( fx_editor_get_option( 'wp_page', false ) ){
			array_splice( $buttons, 13, 0, 'wp_page' );
		}
		return $buttons;
	}

	/**
	 * Add button to 2nd row in editor
	 * @since 0.1.0
	 * @link https://shellcreeper.com/how-to-add-background-color-highlight-option-in-wordpress-editor-tinymce/
	 */
	public function mce_add_buttons_2( $buttons, $editor_id ){
		if ( 'content' != $editor_id ){
			return $buttons;
		}
		if( fx_editor_get_option( 'backcolor', false ) ){
			array_splice( $buttons, 4, 0, 'backcolor' );
		}
		return $buttons;
	}

	/**
	 * Add button to 4th row in editor
	 * @since 0.1.0
	 */
	public function mce_add_buttons_4( $buttons, $editor_id ){

		/* Filterable editor ids */
		$editor_ids = apply_filters( 'fx_editor_editor_ids', array( 'content' ) );

		/* If editor ID not in the list, return */
		if ( is_array( $editor_ids ) && !in_array( $editor_id, $editor_ids ) ){
			return $buttons;
		}

		/* Boxes */
		if( fx_editor_get_option( 'boxes', false ) ){
			array_push( $buttons, 'wpe_addon_boxes' );
		}
		/* Buttons */
		if( fx_editor_get_option( 'buttons', false ) ){
			array_push( $buttons, 'wpe_addon_buttons' );
		}
		/* Columns */
		if( fx_editor_get_option( 'columns', false ) ){
			array_push( $buttons, 'wpe_addon_col_12_12', 'wpe_addon_col_13_23', 'wpe_addon_col_23_13', 'wpe_addon_col_13_13_13' );
		}

		return $buttons;
	}

	/**
	 * MCE/Editor CSS
	 * @since 0.1.0
	 */
	public function editor_css( $mce_css ){
		if ( apply_filters( 'fx_editor_load_editor_css', true ) ){
			$mce_css .= ', ' . FX_EDITOR_URL . "css/editor.css";
		}
		return $mce_css;
	}

	/**
	 * Front-end CSS
	 * @since 0.1.0
	 */
	public function front_css(){
		if ( apply_filters( 'fx_editor_load_front_css', true ) ){
			wp_enqueue_style( 'fx-editor-front', FX_EDITOR_URL . "css/front.css", null, FX_EDITOR_VERSION );
		}
	}

	/**
	 * Switch Default Behaviour in TinyMCE to use "<br>"
	 * On Enter instead of "<p>"
	 * 
	 * @link https://shellcreeper.com/?p=1041
	 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/tiny_mce_before_init
	 * @link http://www.tinymce.com/wiki.php/Configuration:forced_root_block
	 */
	public function p_to_br( $settings ){
		if( fx_editor_get_option( 'p_to_br', false ) ){
			$settings['forced_root_block'] = false;
		}
		return $settings;
	}
}

