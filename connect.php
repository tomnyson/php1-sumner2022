<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$url = 'mysql:host=localhost;dbname=teachPhp1';
$username = 'root';
$password = '';
try {
  $connection = new PDO($url, $username, $password);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}