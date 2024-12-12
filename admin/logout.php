<?php
include_once '../constant.php';
session_start();

session_unset();

session_destroy();

session_abort();

header("Location: " . APP_PATH . "admin/index.php");
