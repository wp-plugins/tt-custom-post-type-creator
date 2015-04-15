<?php
// Check that code was called from WordPress with uninstallation
// constant declared


if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
	exit;
}

// Check if options exist and delete them if present

if ( get_option( 'tt_cptc_create_posttype_options' ) != false ) {
	delete_option( 'tt_cptc_create_posttype_options' );
}

if ( get_option( 'tt_cptc_create_taxonomy_options' ) != false ) {
	delete_option( 'tt_cptc_create_taxonomy_options' );
}
if ( get_option( 'tt_cptc_unique_counter' ) != false ) {
	delete_option( 'tt_cptc_unique_counter' );
}

?>
