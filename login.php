<?php
session_start();
require('db-connect.php');
?>
<html>

<head>
  <title>Đăng nhập</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    $errors = array();
    if(!empty($_POST['username'])&& !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //có thể đếm được
        $sql = "select * from users where username = :username and password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $password
        ]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if($user) {
            $_SESSION['user'] = $user;
            header('Location: add-category.php');
        } else {
            $errors['login'] = 'Đăng nhập thất bại';
        }
        
    } else {
        if(empty($_POST['username'])) {
            $errors['username'] = 'Username không được để trống';
        }
        if(empty($_POST['password'])) {
            $errors['password'] = 'password không được để trống';
        }
    }
    ?>
<div class="card mt-5" style="width: 500px;">
      <div class="card-body">
        <h5 class="card-title">Đăng Nhập</h5>
        <?php if(count($errors)>0) {
          foreach($errors as $error) {
            echo "<div class='text-danger'>$error</div>";
          }
        } ?>
        <form action="login.php"  method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">username</label>
            <input type="text" class="form-control" name="username" id="exampleInputEmail1"
              aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <a href="register.php">tạo tài khoản mới</a>
      </div>
    </div>
</body>

</html>