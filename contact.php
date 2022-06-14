<?php
include 'mailService.php';
?>
<html>

<head>
  <title>thêm Danh Mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <?php 
        include('layout/header.php');
    ?>
    <h2 class="mt-5">Liên hệ</h2>
    <?php
    // lay session ra
    $errors = array();
    if (isset($_POST['name'])
      && isset($_POST['email'])
      && isset($_POST['content'])){
        $subject = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['content'];

        if (empty($subject)) {
          $errors['name'] = 'name không được để trống';
        }
        if (empty($email)) {
          $errors['email'] = 'email không được để trống';
        }
        if (empty($message)) {
          $errors['content'] = 'content không được để trống';
        }
        if (count($errors) == 0) {
          MailService::send('tabletkindfire@gmail.com', $email, $subject, $message);
          echo '<div class="alert alert-success">Cảm ơn bạn đã liên hệ với chúng tôi</div>';
          header("Location: contact.php");
      }
    }
    ?>
    <form action="contact.php" method="post" id="frmProductCreate">
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">chủ đề</label>
        <input type="text" class="form-control" name="name" id="name">
        <?php if (isset($errors['name'])) {
          echo '<p class="text-danger">' . $errors['name'] . '</p>';
        } ?>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">email</label>
        <input type="text" class="form-control" name="email" id="name">
        <?php if (isset($errors['email'])) {
          echo '<p class="text-danger">' . $errors['email'] . '</p>';
        } ?>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">nội dung</label>
        <textarea class="form-control" name="content" class="form-control" id="price"></textarea>
        <?php if (isset($errors['content'])) {
          echo '<p class="text-danger">' . $errors['content'] . '</p>';
        } ?>
      </div>
      <button type="submit" name="add" class="btn btn-primary btn-submit" value="add">Gửi</button>
      <div>
      </div>
    </form>
  </div>
</body>

</html>