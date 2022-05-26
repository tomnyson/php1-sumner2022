<?php

require "connect.php";
$message = "";
$error = [];
if (
  isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name'])
  && isset($_POST['role'])
) {
  $name = $_POST['name'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $username = $_POST['username'];
  $sql = 'INSERT INTO users(username, password, role, name) VALUES(:username, :password, :role, :name)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([
    ':name' => $name, ':password' => password_hash($password, PASSWORD_DEFAULT),
    ':role' => $role, ':username' => $username
  ])) {
    $message = 'tạo thành công';
  }
} else {
  if (empty($_POST['username'])) {
    $error['username'] = 'username không được để trống';
  }
  if (empty($_POST['name'])) {
    $error['name'] = 'name không được để trống';
  }
  if (empty($_POST['role'])) {
    $error['role'] = 'role không được để trống';
  }
  if (empty($_POST['password'])) {
    $error['password'] = 'password không được để trống';
  }
  $message = 'dữ liệu không để trống';
}
require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h5>create a user</h5>
    </div>

    <div class="card-body">
      <?php if (!empty($message)) : ?>
      <div class="alert alert-success">
        <?= $message; ?>
      </div>
      <?php
        if (count($error) > 0) {
          foreach ($error as $key => $value) {
            echo "<span class='alert-danger'>" . $value . "</span> </br>  ";
          }
        }
        ?>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">username</label>
          <input type="text" name="username" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">role</label>
          <select name="role" id="password" class="form-control">
            <option value=""> choose role </option>
            <option value="1"> admin </option>
            <option value="2"> user </option>
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
  </body>

  </html>