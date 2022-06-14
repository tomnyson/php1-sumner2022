<?php
require('db-connect.php');
include('mailService.php');
?>
<html>

<head>
  <title>Đăng ký</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    $errors = array();
    if (isset($_POST['username'])&& isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if (empty($username)) {
            $errors['username'] = 'Username không được để trống';
        }

        if (empty($password)) {
            $errors['password'] = 'Password không được để trống';
        }

        if (empty($email)) {
            $errors['email'] = 'Email không được để trống';
        }
        
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không hợp lệ';
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(count($errors)==0) {
          // check tồn tại username
          $sql_user = "SELECT * FROM users WHERE username = :username";
          $stmt_user = $conn->prepare($sql_user);
          $stmt_user->execute([
            ':username' => $username
          ]);
            $isExist = $stmt_user->rowCount();
            if($isExist >0) {
                $errors['username'] = 'Username đã tồn tại';
            }else {
              $sql = "insert into users(username, password, email, role)
              values(:username, :password, :email, :role)";
             $stmt = $conn->prepare($sql);
             $check = $stmt->execute([
                 ':username' => $username,
                 ':password' => password_hash($password, PASSWORD_DEFAULT),
                 ':email' => $email,
                 ':role' => 'user'
             ]);
             if($check) {
                MailService::send('tabletkindfire@gmail.com',$email, 'Đăng ký thành công', '
                chào: '.$username.'
                <br>
                mật khẩu là: <strong>' .$password.'</strong>
              ');
              unset($_POST);
                 echo "<div class='alert alert-success'>thêm thành công</div>";
             }
            }
           
        }


    }

    ?>
<div class="d-flex justify-content-center" style="margin-bottom: 50px">
<div class="card mb-5" style="width: 40%;">
      <div class="card-body">
        <h5 class="card-title">Đăng ký</h5>
        <?php if(count($errors)>0) {
          foreach($errors as $error) {
            echo "<div class='text text-danger'>$error</div>";
          }
        } ?>
        <form action="register.php"  method="POST">
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
          <button type="submit"  class="btn btn-primary">Đăng ký</button>
        </form>
        <a href="login.php">đăng nhập</a>
      </div>
    </div>
    </div>
</body>

</html>