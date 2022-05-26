<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$url = 'mysql:host=192.168.64.2;dbname=php_demo';
$username = 'dev';
$password = 'dev';
try {
  $connection = new PDO($url, $username, $password);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}