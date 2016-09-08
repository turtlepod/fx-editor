<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

/* Delete option on uninstall. */
delete_option( 'fx-editor' );