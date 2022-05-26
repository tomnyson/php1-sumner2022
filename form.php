<?php
include "user.php";
$admin->xuatThongTin();
?>
<html>

<head>
  <title>Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php
    $name = "    le hong son     ";
    // tính độ dài ký tự
    echo "truoc xoa:" . strlen($name) . "</br>";
    // xoá khoảng trắng 2 đầu
    $trim_len = trim($name);
    echo strlen($trim_len) . "</br>";
    echo "truoc xoa" . strlen($trim_len);
    echo "ký tự đặc biêt";
    $dacBiet = "<h1>LÊ HÔNG SƠN</h1> </br>";
    $emty = "";
    // kiểm tra text rỗng
    if (empty($emty)) {
      echo "chuoi rong";
    };
    // chuyển html về text
    echo htmlspecialchars($dacBiet);
    if (isset($_GET['username']) && isset($_GET['password'])) {
      echo "username:" . $_GET['username'] . "</br>";
      echo "password:" . $_GET['password'];
    }
    if (
      isset($_POST['username'])
      && isset($_POST['password'])
      && isset($_POST['email'])
    ) {
      echo "username:" . $_POST['username'] . "</br>";
      echo "password:" . $_POST['password'];
      /** kiem tra email hơp lệ */
      if (!preg_match("/\A[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}\z/i", $_POST['email'])) {
        echo "email khong hop le";
      }
    }

    ?>
    <div class="card mt-5" style="width: 500px;">
      <div class="card-body">
        <h5 class="card-title">Login</h5>
        <form action="form.php" method="POST">
          <div class="mb-5">
            <label for="exampleInputEmail1" class="form-label">username</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail1"
              aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">email</label>
            <input type="text" name="email" class="form-control" id="exampleInputPassword1">
          </div>
          <select name="bieuThuc">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="%">/</option>
          </select>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>


  </div>
</body>

</html>