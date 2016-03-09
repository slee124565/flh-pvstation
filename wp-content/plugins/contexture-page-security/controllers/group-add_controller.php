<?php
    if ( ! current_user_can( 'add_users' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.','contexture-page-security' ) );
?>