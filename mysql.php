<?php
define('DB_HOST', '192.168.64.2'); #your host -> localhost
define('DB_USERNAME', 'dev'); // your username root
define('DB_PASSWORD', 'dev'); // your password ''
define('DB_NAME', 'teachphp1');  // db của các bạn
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
  // câu query
  //like
  $sql = "select * from cars where price >= :price limit 100";
  $smt = $conn->prepare($sql);
  $smt->execute(['price' => '300000000']);
  // theo mảng liên kết
  // $cars = $smt->fetchAll(PDO::FETCH_ASSOC);
  // // echo "<pre>";
  // // print_r($cars);
  // // echo "</pre>";
  // for ($i = 0; $i < count($cars); $i++) {
  //   echo "ID: " . $cars[$i]['id'] . "</br>";
  //   echo "<img src='" . $cars[$i]['image'] . "' width='300px' /> </br>";
  //   echo "Title: " . $cars[$i]['title'] . "</br>";
  //   echo "description: " . $cars[$i]['description'] . "</br>";
  // }
  // theo object
  $cars = $smt->fetchAll(PDO::FETCH_OBJ);
  // echo "<pre>";
  // print_r($cars);
  // echo "</pre>";
  // for ($i = 0; $i < count($cars); $i++) {
  //   echo "ID: " . $cars[$i]->id . "</br>";
  //   echo "<img src='" . $cars[$i]->image . "' width='300px' /> </br>";
  //   echo "Title: " . $cars[$i]->title . "</br>";
  //   echo "description: " . $cars[$i]->description . "</br>";
  // }
  foreach ($cars as $car) {
    echo "ID: " . $car->id . "</br>";
    echo "<img src='" . $car->image . "' width='300px' /> </br>";
    echo "Title: " . $car->title . "</br>";
    echo "price: " . $car->price . "</br>";
    echo "description: " . $car->description . "</br>";
  }
} catch (Exception $e) {
  die('connect mysql failed');
}
