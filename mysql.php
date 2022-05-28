<?php
define('DB_HOST', '192.168.64.2'); #your host
define('DB_USERNAME', 'dev'); // your username
define('DB_PASSWORD', 'dev'); // your password
define('DB_NAME', 'teachphp1');
// $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
// if ($conn->connect_error) {
//   die('connect mysql failed');
// }
// echo 'connect thanh cong';

// cach 2: PDO

try {
  $connectString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "";
  $conn = new PDO($connectString, DB_USERNAME, DB_PASSWORD);
  // show loi
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo 'connect thanh cong';
} catch (Exception $e) {
  die('connect mysql failed');
}