<?php 
include dirname(__DIR__, 2). '/constant.php';
session_start();

session_unset();

session_destroy();

header('Location: '.APP_PATH.'index.php');

?>
