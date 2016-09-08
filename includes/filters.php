<?php
/**
 * Options Filters
 * @since 1.1.0
**/

/* Force to use feature only on content (via settings) */
add_filter( 'fx_editor_wp_page_editor_ids', 'fx_editor_force_content_only', 5 );
add_filter( 'fx_editor_backcolor_editor_ids', 'fx_editor_force_content_only', 5 );
add_filter( 'fx_editor_boxes_editor_ids', 'fx_editor_force_content_only', 5 );
add_filter( 'fx_editor_buttons_editor_ids', 'fx_editor_force_content_only', 5 );
add_filter( 'fx_editor_columns_editor_ids', 'fx_editor_force_content_only', 5 );
add_filter( 'fx_editor_coder_editor_ids', 'fx_editor_force_content_only', 5 );

/**
 * Force visual editor feature only for content.
 * @since 1.1.0
 */
function fx_editor_force_content_only( $editor_ids ){
	if( fx_editor_get_option( 'content_only', true ) ){
		$editor_ids = array( 'content' );
	}
	return $editor_ids;
}