<?php 

// Define the app's base URL securely
if (!defined('APP_PATH')) {
    define("APP_PATH", "http://localhost/college_mgmt_system/");
}

// Secure handling of paths
// $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
// $host = $_SERVER['HTTP_HOST'];
// $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

// define("APP_PATH", "{$protocol}://{$host}/{$path}/");

