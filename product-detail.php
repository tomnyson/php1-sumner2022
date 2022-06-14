<?php
require('db-connect.php');

?>
<html>

<head>
  <title>thêm sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <?php include('./layout/header.php');
    if ($_GET['id']) {
      $sql = "select * from cars where id = :id";
      $stm = $conn->prepare($sql);
      $stm->execute([
        'id' => $_GET['id']
      ]);
      $car = $stm->fetch(PDO::FETCH_OBJ);
      ?>
     
      <div class="row">
        <div class="card col-md-6" >
          <img class="card-img-top" src="<?= $car->image ?>" width="50%" onerror="this.src='https://via.placeholder.com/150'" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title"><a href="product-detail.php?id=<?= $car->id ?>"><?= $car->title ?></a></h5>
            <p class="card-text"><?= $car->description ?></p>
            <p class="card-price"><?= $car->price ?></p>
            <a href="add-cart.php?id=<?= $car->id ?>&action=add" class="btn btn-primary">mua hàng</a>
          </div>
        </div>
      </div>

    <?
    } else {
      echo "không tìm thấy sản phẩm";
    }
    ?>
  </div>
</body>

</html>