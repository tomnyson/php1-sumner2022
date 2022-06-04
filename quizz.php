<?php
define('DB_HOST', '192.168.64.2'); #your host -> localhost
define('DB_USERNAME', 'dev'); // your username root
define('DB_PASSWORD', 'dev'); // your password ''
define('DB_NAME', 'teachphp1');

try {
  $connectString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . "";
  $conn = new PDO($connectString, DB_USERNAME, DB_PASSWORD);
  // show loi
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // câu query
  //like
  $sql = "select *, q.id as questionKey, q.name as questionName from questions q INNER JOIN answers a on q.id = a.questionId
  order by a.id, q.id";
  $smt = $conn->prepare($sql);
  $smt->execute();
  $data = $smt->fetchAll(PDO::FETCH_ASSOC);
  // echo "<pre";
  // print_r($data);
  // echo "</pre>";

  function group_by($key, $data)
  {
    $result = array();

    foreach ($data as $val) {
      if (array_key_exists($key, $val)) {
        $result[$val[$key]][] = $val;
      } else {
        $result[""][] = $val;
      }
    }

    return $result;
  }

  $byGroup = group_by("questionKey", $data);
  print_r($byGroup);
  echo "<form action='quizz.php' method='post'>";
  foreach ($byGroup as $key => $value) {
    echo "<h2>" . $value[0]['questionName'] . "</h2>";
    echo "<input type='hidden' name='question' value='" . $value[0]['questionId'] . "'/></br>";
    foreach ($value as $keyChild => $item) {
      echo "<input type='radio' name='" . $item['questionId'] . "' value='" .  $item['name'] . "'/> <label for='html'>" . $item['name'] . "</label><br></br>";
      echo "<input type='hidden' name='correct' value='" . $value[0]['isCorrect'] . "'/></br>";
    }
  }
  echo "<input type='submit' name='submit' value='submit' />";
  echo "</form>";

  if (isset($_POST['submit'])) {
    var_dump($_POST);
  }
} catch (PDOException $e) {
  die('connect mysql failed');
}