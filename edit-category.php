<?php
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
      isset($_POST['name']) &&
      isset($_POST['id'])
      && isset($_POST['description'])
    ) {
      $id = $_POST['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      if (trim($name) != '' && trim($description) != '') {
        $sql = "update category set name=:name, description=:description where id=:id";
        $stmt = $conn->prepare($sql);
        $check = $stmt->execute([
          ':name' => $name, ':description' => $description,
          ':id' => $id
        ]);
        if ($check) {
          $_SESSION["message"] = "edit thành công";
          header("Location: add-category.php");
        }
      }
    }
    ?>

    <div class="d-flex justify-content-center ">
      <div class="col col-md-6">
        <h2 class="mt-5">Cập nhật danh mục</h2>
        <?php
        $category;
        $id = $_GET['id'];
        if (isset($id)) {
          $sql = "select * from category where id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([':id' => $id]);
          $category = $stmt->fetch(PDO::FETCH_OBJ);
        }
        ?>
        <form action="edit-category.php" method="post" id="frmProductCreate">
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Id</label>
            <input type="text" class="form-control" name="id" value="<?= isset($category->id) ? $category->id : '' ?>" name="id" readonly>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">tên</label>
            <input type="text" class="form-control" value="<?= isset($category->name) ? $category->name : '' ?>" name="name">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" class="form-control" id="price"><?= isset($category->description) ? $category->description : '' ?></textarea>
          </div>
          <button type="submit" name="add" class="btn btn-primary btn-submit" value="add">Cập Nhật</button>
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