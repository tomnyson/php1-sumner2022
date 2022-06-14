<?php
require('db-connect.php');
$sql = "select * from category";
$stm = $conn->prepare($sql);
$stm->execute();
$categories = $stm->fetchAll(PDO::FETCH_OBJ);
?>
<html>

<head>
  <title>thêm sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <?php include('./layout/header.php');
       include('permission-admin.php');
       ?>
    ?>
    
    <h2>thêm sản phẩm</h2>
    <?php
    $errors = array();
    if ((isset($_POST['action'])
      && isset($_POST['name'])
      && isset($_POST['price'])
      && isset($_POST['url'])
      && isset($_POST['contact'])
      && isset($_POST['categoryId'])
      && isset($_POST['description']))) {
      // validation
      $name = $_POST['name'];
      $description = $_POST['description'];
      $$name = $_POST['name'];
      $url = $_POST['url'];
      $price = $_POST['price'];
      $contact = $_POST['contact'];
      $categoryId = $_POST['categoryId'];
      $image = "";
      if (isset($_FILES['image'])) {
        // lấy thư mục upload
        $target_file = "images/" . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          echo "go here" . $image;
          $image = $_FILES['image']['name'];
        }
      }
      if (empty($name)) {
        $errors['name'] = 'name không được để trống';
      }
      if (empty($price)) {
        $errors['price'] = 'price không được để trống';
      }
      if (empty($categoryId)) {
        $errors['category'] = 'category không được để trống';
      }
      if (empty($description)) {
        $errors['description'] = 'description không được để trống';
      }
      if (count($errors) == 0) {
        $sql = "insert into cars(title,description,url,price,contact,categoryId,image)
         values(:title,:description,:url,:price,:contact,:categoryId,:image)";
        $stm = $conn->prepare($sql);
        if ($stm->execute([
          ':title' => $name,
          ':description' => $description,
          ':url' => $url,
          ':price' => $price,
          ':contact' => $contact,
          ':categoryId' => $categoryId,
          ':image' => $image
        ])) {
          echo '<div class="alert alert-success">thêm thành công</div>';
          echo "success";
        }
      }
    }
    ?>
    <form id="frmProductCreate" method="post" enctype="multipart/form-data">
      <div class="row">
        <?php
        if (count($errors) > 0) {
          var_dump($errors);
          foreach ($errors as $error) {
            echo "<p class='help-block text-danger'>" . $error . "</p>";
          }
        }
        ?>
        <div class="col col-md-6">
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">tiêu đề</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">hình ảnh</label>
            <input type="file" name="image" class="form-control" id="price">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">url</label>
            <input type="text" class="form-control" name="url">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">giá</label>
            <input type="number" class="form-control" name="price">
          </div>
          <button type="submit" name="action" class="btn btn-primary btn-submit" value="add">Thêm sản phẩm</button>
        </div>
        <div class="col col-md-6">
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">liên hệ</label>
            <textarea class="form-control" type="text" class="form-control" name="contact"></textarea>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Danh mục</label>
            <select name="categoryId" class="form-control" type="text" class="form-control" name="contact">
              <option value="">chọn danh mục</option>
              <?php
              if (count($categories) > 0) {
                foreach ($categories as $category) {
                  echo "<option value=" . $category->id . ">" . $category->name . "</option>";
                }
              } ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">description</label>
            <textarea class="form-control" name="description" type="text" class="form-control"
              id="description"></textarea>
          </div>
          <div>
          </div>
        </div>
      </div>
    </form>

  </div>
</body>

</html>