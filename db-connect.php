<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
define('DB_HOST', 'localhost'); #your host -> localhost
define('DB_USERNAME', 'root'); // your username root
define('DB_PASSWORD', ''); // your password ''
define('DB_NAME', 'teachphp1');  // db của các bạn
$conn = null;
try {
  $connectString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "";
  $conn = new PDO($connectString, DB_USERNAME, DB_PASSWORD);
  // show loi
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
  die('connect mysql failed');
}
