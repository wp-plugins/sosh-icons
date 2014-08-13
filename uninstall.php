<?php
    
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

if ( ! current_user_can( 'activate_plugins' ) )
        exit();

delete_option( 'sosh_icons_version' );
delete_option( 'soshicons_options' );
delete_option( 'soshicons_advanced_options' );


// For site options in multisite
delete_site_option( 'sosh_icons_version' );
delete_site_option( 'soshicons_options' );
delete_site_option( 'soshicons_advanced_options' );

?>