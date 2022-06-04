<?php
require('db-connect.php');
?>
<html>

<head>
  <title>Cập nhật danh mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <?php include('layout/header.php') ?>

    <?php
    if ((isset($_POST['name'])
      && isset($_POST['description'])
      && $_SERVER['REQUEST_METHOD'] == 'POST')) {
      // $name = $_POST['name'];
      // $description = $_POST['description'];
      // if (trim($name) != '' && trim($description) != '') {
      //   $sql = "insert into category(name, description) values(:name, :description)";
      //   $stmt = $conn->prepare($sql);
      //   $check = $stmt->execute([
      //     ':name' => $name, ':description' => $description
      //   ]);
      //   if ($check) {

      //     echo "<div class='alert alert-primary' role='alert'>
      //     Thêm thành công
      //   </div>";
      //     header("Location: " . $_SERVER['PHP_SELF']);
      //   }
      // }
      // echo $name;
      // echo $description;
    }
    ?>

    <div class="d-flex justify-content-center ">
      <div class="col col-md-6">
        <h2 class="mt-5">Cập nhật danh mục</h2>
        <?php
        if (isset($_GET['id'])) {
          echo $_GET['id'];
          $id = $_GET['id'];
          $sql = "select * from category where id = :id";
          $stmt = $conn->prepare($sql);
          $stmt->execute([':id' => $id]);
          $category = $stmt->fetch(PDO::FETCH_OBJ);
          $val = $category->name;
        ?>
        <form action="add-category.php" method="post" id="frmProductCreate">
          <div class="mb-3">
            <input type="text" class="form-control" value="<?= $category->id ?>" name="name" id="name">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" value="<?= $categories->description ?>"
              class="form-control" id="price"></textarea>
          </div>
          <button type="submit" name="add" class="btn btn-primary btn-submit" value="add">Cập Nhật</button>
          <div>
          </div>
        </form>
        <?php } ?>
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