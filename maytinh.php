<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html>

<head>
  <title>may tinh</title>
</head>

<body>
  <?php
  /**
   * xuất giá trị ra  màn hình
   */
  // print_r($_POST);
  $ketqua = "";
  // kiểm tra submit
  if (
    isset($_POST['so1']) &&
    isset($_POST['so2']) &&
    isset($_POST['phepTinh'])
  ) {
    // validation
    $error = array();
    $so1 = $_POST['so1'];
    $so2 = $_POST['so2'];
    $phepTinh = $_POST['phepTinh'];
    if ($so1 == "" || $so2 == "" || $phepTinh == "") {
      $error[] = "số 1 || số 2 không được để trống";
    }
    // kiểm tra số 
    if (!is_numeric($so1)) {
      $error[] = "số 1 phải là số";
    }
    if (!is_numeric($so2)) {
      $error[] = "số 2 phải là số";
    }
    if (count($error) == 0) {
      // thực hiện phép tính
      if ($phepTinh == "+") {
        $ketqua = $so1 + $so2;
      } else if ($phepTinh == "-") {
        $ketqua = $so1 - $so2;
      } else if ($phepTinh == "*") {
        $ketqua = $so1 * $so2;
      } else if ($phepTinh == "/") {
        try {
          $ketqua = $so1 / $so2;
        } catch (Exception $e) {
          // echo 'phép chia bị lỗi ' . $e->getMessage();
        }
      } else if ($phepTinh == "%") {
        try {
          $ketqua = $so1 % $so2;
        } catch (Exception $e) {
          echo 'phép chia bị lỗi ' . $e->getMessage();
        }
      } else {
        echo "không có";
      }
    }
  }
  ?>
  <form action="maytinh.php" method="post">
    <input type="text" name="so1" placeholder="số thứ nhất" />
    <input type="text" name="so2" placeholder="số thứ hai" />
    <select name="phepTinh">
      <option value="+">+</option>
      <option value="-">-</option>
      <option value="*">*</option>
      <option value="/">/</option>
      <option value="%">%</option>
    </select>
    <button type="submit">kết quả</button>
    </br>
    <?php
    if (count($error) > 0) {
      foreach ($error as $err) {
        echo "<span style='color:red'>" . $err . "</span><br>";
      }
    }
    ?>
    <h1>Kết quả: <strong style='color:green'><?php echo $ketqua; ?></strong></h1>
  </form>
</body>

</html>