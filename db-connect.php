<?php
define('DB_HOST', '192.168.64.2'); #your host -> localhost
define('DB_USERNAME', 'dev'); // your username root
define('DB_PASSWORD', 'dev'); // your password ''
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