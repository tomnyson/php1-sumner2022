  <?php
  require('db-connect.php');
  // lấy id từ url request
  $id = $_GET['id'];
  if (isset($id)) {
    // cấu query xoá category by id
    $sql = 'DELETE FROM category WHERE id=:id';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':id' => $id])) {
      // quay về trang list
      header("Location: /teachphp/add-category.php");
    }
  }
  die("id không tồn tại");

  ?>