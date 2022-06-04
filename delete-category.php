  <?php
  session_start();
  require('db-connect.php');
  // lấy id từ url request
  $id = $_GET['id'];
  if (isset($id)) {
    // cấu query xoá category by id
    $sql = 'DELETE FROM category WHERE id=:id';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':id' => $id])) {
      // quay về trang list
      $_SESSION["message"] = "delete thành công";
      header("Location: /teachphp/add-category.php");
    }
  }
  die("id không tồn tại");

  ?>