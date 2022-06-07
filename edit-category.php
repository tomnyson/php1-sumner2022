<?php
//start session
session_start();
require('db-connect.php');
?>
<html>

<head>
  <title>Cập nhật danh mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <?php include('layout/header.php') ?>

    <?php
    if (
      isset($_GET['id']) && isset($_POST['action'])
      && isset($_POST['name']) && isset($_POST['description'])
    ) {
      $errors = array();
      $id = $_GET['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      if (trim($name) == '') {
        $errors['name'] = 'name không được để trống';
      }
      if (trim($description) == '') {
        $errors['description'] = 'description không được để trống';
      }
      if (count($errors) == 0) {
        $sql = "update category set name = :name, description = :description where id = :id";
        $stmt = $conn->prepare($sql);
        $check = $stmt->execute([
          ':name' => $name, ':description' => $description, ':id' => $id
        ]);
        if ($check) {
          //set session 
          $_SESSION['message'] = 'Cập nhật thành công';
          header("Location: add-category.php");
        }
      }
    }
    ?>

    <div class="d-flex justify-content-center ">
      <div class="col col-md-6">
        <h2 class="mt-5">Cập nhật danh mục</h2>
        <?php
        $category = null;
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $sql = "select * from category where id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([':id' => $id]);
          $category = $stmt->fetch(PDO::FETCH_OBJ);
        }

        ?>
        <form action="edit-category.php?id=<?= $_GET['id'] ?>" method="post" id="frmProductCreate">
          <div class="mb-3">
            <input type="hidden" name="id" value="<?= isset($category->id) ? $category->id : '' ?>" />
            <input type="text" class="form-control" value="<?= isset($category->name) ? $category->name : '' ?>" name="name" id="name">
            <p class="help-block text-danger"><?= isset($errors['name']) ? $errors['name'] : '' ?></p>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" value="" class="form-control" id="price"><?= isset($category->description) ? $category->description : '' ?></textarea>
            <p class="help-block text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></p>
          </div>
          <button type="submit" name="action" class="btn btn-primary btn-submit" value="update">Cập Nhật</button>
          <div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  $sql_category = "select * from category";
  $stmt_category = $conn->prepare($sql_category);
  $stmt_category->execute();
  $categories = $stmt_category->fetchAll(PDO::FETCH_OBJ);
  ?>
  </div>
</body>

</html>