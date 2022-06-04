<?php
session_start();
require('db-connect.php');
?>
<html>

<head>
  <title>thêm Danh Mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <?php include('layout/header.php') ?>
    <h2 class="mt-5">Thêm Danh Mục</h2>
    <?php
    if (isset($_SESSION['message'])) {
      echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
      unset($_SESSION['message']);
    }
    $errors = array();
    if ((isset($_POST['name'])
      && isset($_POST['description'])
      && $_SERVER['REQUEST_METHOD'] == 'POST')) {
      $name = $_POST['name'];
      $description = $_POST['description'];
      if (trim($name) == '') {
        $errors['name'] = 'name không được để trống';
      }
      if (trim($description) == '') {
        $errors['description'] = 'description không được để trống';
      }
      if (trim($name) != '' && trim($description) != '') {
        $sql = "insert into category(name, description) values(:name, :description)";
        $stmt = $conn->prepare($sql);
        $check = $stmt->execute([
          ':name' => $name, ':description' => $description
        ]);
        if ($check) {
          $_SESSION['message'] = 'Thêm thành công';
          header("Location: add-category.php");
        }
      }
    }

    ?>
    <form action="add-category.php" method="post" id="frmProductCreate">
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">tên</label>
        <input type="text" class="form-control" name="name" id="name">
        <?php if (isset($errors['name'])) {
          echo '<p class="text-danger">' . $errors['name'] . '</p>';
        } ?>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mô tả</label>
        <textarea class="form-control" name="description" class="form-control" id="price"></textarea>
        <?php if (isset($errors['description'])) {
          echo '<p class="text-danger">' . $errors['description'] . '</p>';
        } ?>
      </div>
      <button type="submit" name="add" class="btn btn-primary btn-submit" value="add">Thêm Mới</button>
      <div>
      </div>
    </form>
    <?php
    $sql_category = "select * from category";
    $stmt_category = $conn->prepare($sql_category);
    $stmt_category->execute();
    $categories = $stmt_category->fetchAll(PDO::FETCH_OBJ);
    ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">Tên</th>
          <th scope="col">Mô tả</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) { ?>
        <tr>
          <td><?= $category->id ?></td>
          <td><?= $category->name ?></td>
          <td><?= $category->description ?></td>
          <td>
            <a onclick="confirm('bạn có muốn xoá không?')" href="delete-category.php?id=<?= $category->id ?>"><i
                class="fa-solid fa-minus"></i></a>
            <a style="margin-left: 20px" href="edit-category.php?id=<?= $category->id ?>"><i
                class="fa-solid fa-pen-to-square"></i></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>

</html>