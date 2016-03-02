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
		add_filter( 'mce_buttons', array( $this, 'mce_add_buttons_1_wp_page' ), 1, 2 );

		/* Add button to TinyMCE button 2nd Row */
		add_filter( 'mce_buttons_2', array( $this, 'mce_add_buttons_2_backcolor' ), 1, 2 );

		/* Add button to TinyMCE button 4th Row */
		add_filter( 'mce_buttons_4', array( $this, 'mce_add_buttons_4_boxes' ), 1, 2 );
		add_filter( 'mce_buttons_4', array( $this, 'mce_add_buttons_4_buttons' ), 1, 2 );
		add_filter( 'mce_buttons_4', array( $this, 'mce_add_buttons_4_columns' ), 1, 2 );

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

		return $plugins;
	}

	/**
	 * Add button to 1st row in editor: WP Page
	 * @since 0.1.0
	 */
	public function mce_add_buttons_1_wp_page( $buttons, $editor_id ){

		/* Make editor id filterable. */
		$wp_page_editor_ids = apply_filters( 'fx_editor_wp_page_editor_ids', false );
		if( is_array( $wp_page_editor_ids ) && ! in_array( $editor_id, $wp_page_editor_ids ) ){
			return $buttons;
		}

		/* Add button */
		if( fx_editor_get_option( 'wp_page', false ) ){
			array_splice( $buttons, 13, 0, 'wp_page' );
		}
		return $buttons;
	}

	/**
	 * Add button to 2nd row in editor: backcolor
	 * @since 0.1.0
	 * @link https://shellcreeper.com/how-to-add-background-color-highlight-option-in-wordpress-editor-tinymce/
	 */
	public function mce_add_buttons_2_backcolor( $buttons, $editor_id ){

		/* Make editor id filterable. */
		$backcolor_editor_ids = apply_filters( 'fx_editor_backcolor_editor_ids', false );
		if( is_array( $backcolor_editor_ids ) && ! in_array( $editor_id, $backcolor_editor_ids ) ){
			return $buttons;
		}

		/* Add buttons */
		if( fx_editor_get_option( 'backcolor', false ) ){
			array_splice( $buttons, 4, 0, 'backcolor' );
		}
		return $buttons;
	}

	/**
	 * Add button to 4th row in editor: Boxes
	 * @since 0.1.0
	 */
	public function mce_add_buttons_4_boxes( $buttons, $editor_id ){

		/* Make editor id filterable. */
		$boxes_editor_ids = apply_filters( 'fx_editor_boxes_editor_ids', false );
		if( is_array( $boxes_editor_ids ) && ! in_array( $editor_id, $boxes_editor_ids ) ){
			return $buttons;
		}

		/* Boxes */
		if( fx_editor_get_option( 'boxes', false ) ){
			array_push( $buttons, 'wpe_addon_boxes' );
		}

		return $buttons;
	}

	/**
	 * Add button to 4th row in editor: Buttons
	 * @since 0.1.0
	 */
	public function mce_add_buttons_4_buttons( $buttons, $editor_id ){

		/* Make editor id filterable. */
		$buttons_editor_ids = apply_filters( 'fx_editor_buttons_editor_ids', false );
		if( is_array( $buttons_editor_ids ) && ! in_array( $editor_id, $buttons_editor_ids ) ){
			return $buttons;
		}

		/* Add buttons */
		if( fx_editor_get_option( 'buttons', false ) ){
			array_push( $buttons, 'wpe_addon_buttons' );
		}

		return $buttons;
	}

	/**
	 * Add button to 4th row in editor: Columns
	 * @since 0.1.0
	 */
	public function mce_add_buttons_4_columns( $buttons, $editor_id ){

		/* Make editor id filterable. Set to false to enable anywhere. */
		$columns_editor_ids = apply_filters( 'fx_editor_columns_editor_ids', false );
		if( is_array( $columns_editor_ids ) && ! in_array( $editor_id, $columns_editor_ids ) ){
			return $buttons;
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

