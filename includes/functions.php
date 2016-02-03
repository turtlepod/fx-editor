<?php
/**
 * f(x) Editor Functions
**/
/* Do not access this file directly */
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Get Option helper function
 * @since 0.1.0
 */
function fx_editor_get_option( $option, $default = '', $option_name = 'fx-editor' ) {

	/* Bail early if no option defined */
	if ( !$option ){
		return false;
	}

	/* Get database and sanitize it */
	$get_option = get_option( $option_name );

	/* if the data is not array, return false */
	if( !is_array( $get_option ) ){
		return $default;
	}

	/* Get data if it's set */
	if( isset( $get_option[ $option ] ) ){
		return $get_option[ $option ];
	}
	/* Data is not set */
	else{
		return $default;
	}
}


/**
 * Custom Features Active
 * @since 0.1.0
 * @return bool
**/
function fx_editor_is_custom_feature_active(){
	if( fx_editor_get_option( 'boxes', false ) || fx_editor_get_option( 'buttons', false ) || fx_editor_get_option( 'columns', false ) ){
		return apply_filters( 'fx_editor_is_custom_feature_active', true );
	}
	return apply_filters( 'fx_editor_is_custom_feature_active', false );
}
