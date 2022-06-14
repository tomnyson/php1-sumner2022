<?php
require('db-connect.php');
?>
<html>

<head>
  <title>kiểm tra đơn hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container">
    <?php
    include('layout/header.php');
    function getTrangThaiOrder($status) {
      switch($status) {
        case 0;
          return 'Đang chờ xử lý';
          break;
        case 1:
          return 'Đang giao hàng';
          break;
        case 2:
          return 'Đã giao hàng';
          break;
        case 3:
          return 'Đã hủy';
          break;
        default:
          return 'Không xác định';
          break;
      }
    }
    ?>
    <?php
    $errors = array();
    $order = null;
    if (isset($_GET['code'])) {
      $code = $_GET['code'];
      if (empty($code)) {
        $errors['code'] = 'Mã đơn hàng không được để trống';
      }
      if (count($errors) == 0) {
        $sql = "SELECT
          orders.*,
          order_details.*,
          cars.*
        FROM orders
        JOIN users
          ON orders.customerId = users.id
        JOIN order_details
          ON order_details.orderId = orders.id
        JOIN cars
          ON order_details.productId = cars.id
        where orders.code = :code";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        $order = $stmt->fetchAll(PDO::FETCH_OBJ);
      }
    }

    if (count($errors) > 0) {
      foreach ($errors as $error) {
        echo '<p class="text text-danger">' . $error . '</p><br/>';
      }
    }
    ?>
    <form action="tracking-order.php" method="GET">
      <input type="text" name="code" class="form-control" style="height: 50px" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mã đơn hàng">
      <button type="submit" name="action" value="track" class="btn btn-primary">Kiểm tra</button>
    </form>
    <?php
      if($order!=null){?>
      <div class="row">
        <div class="col col-md-6">
        <h3 >Thông tin hóa đơn hàng</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Số điện thoại</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $order[0]->code; ?></td>
                <td><?php echo $order[0]->customerName; ?></td>
                <td><?php echo $order[0]->phone; ?></td>
                <td><?php echo $order[0]->address; ?></td>
                <td><?php echo  number_format($order[0]->total); ?></td>
                <td><?php echo getTrangThaiOrder($order[0]->orderStatus); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col col-md-6">
          <h3>Thông tin chi tiết đơn hàng</h3>
          <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên xe</th>
              <th scope="col">Ảnh</th>
              <th scope="col">Giá</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Tổng tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($order as $item) {
              ?>
              <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $item->title ?></td>
                <td><img src="<?= $item->image ?>" alt="" width="100px"></td>
                <td><?= $item->price ?></td>
                <td><?= $item->quantity ?></td>
                <td><?= number_format($item->total) ?>VNĐ</td>
              </tr>
            <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
          </div>
      <?php } else {
        echo '<p class="text text-danger">Không tìm thấy đơn hàng</p>';
      } ?>
</div>
  </div>

  </div>
</body>

</html>