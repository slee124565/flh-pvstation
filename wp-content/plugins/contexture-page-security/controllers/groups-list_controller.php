<?php
/**Creates the "Add/View Groups" page**/

if ( ! current_user_can( 'promote_users' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ) );

$creategroup_message = '';

//Several forms post back to this page, so we catch the action and process accordingly
if(!empty($_POST['action'])){
 
    //Launch code based on action
    switch($_POST['action']){
        case 'addgroup':
            //Check nonce
            if( !wp_verify_nonce($_POST['_wpnonce'],'add-group') ){
                wp_die( __('Incorrect security token.', 'contexture-page-security') );
            }
            $creategroup_message = CTXPS_App::create_group($_POST['group_name'], $_POST['group_description']);
            break;
        default: break;
    }

}

?>