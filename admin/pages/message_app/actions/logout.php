<?php 

if( isset( $_SESSION['userid'] ) ) {
    unset($_SESSION['userid'] );
    session_destroy();
}

$info->logged_in = false;
echo json_encode( $info );
