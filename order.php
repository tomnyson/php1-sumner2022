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
    function getTrangThaiOrder($status)
    {
      switch ($status) {
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
    $statusList = array(
      0 => 'Đang chờ xử lý',
      1 => 'Đang giao hàng',
      2 => 'Đã giao hàng',
      3 => 'Đã hủy'
    );
    $errors = array();
    $status = 0;
    if(isset($_GET['status'])) {
    $status = $_GET['status'];
    }
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
          where orders.orderStatus = :orderStatus
          group by orders.id
          ORDER BY orders.id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':orderStatus', $status);

    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_OBJ);
    if(isset($_GET['id']) && isset($_GET['status'])) {
      $id = $_GET['id'];
      $trangthai = $_GET['status'];
      var_dump($trangthai);
      $sql = "UPDATE orders SET orderStatus = :orderStatus WHERE id = :id";
      $stmt = $conn->prepare($sql);
      if($stmt->execute([
        ':id' => $id,
        ':orderStatus' => $trangthai
      ])){
        echo '<p class="text text-success">Cập nhật trạng thái thành công</p>';
      };
    }
    ?>
    <div class="btn-group">
      <?php foreach ($statusList as $key => $value) : ?>
        <a href="?status=<?php echo $key; ?>" class="btn btn-primary"><?php echo $value; ?></a>
      <?php endforeach; ?>
    </div>
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">code</th>
          <th scope="col">name</th>
          <th scope="col">tổng tiền</th>
          <th scope="col">address</th>
          <th scope="col">phone</th>
          <th scope="col">note</th>
          <th scope="col">status</th>
          <th scope="col">ngày tạo</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order) { ?>
          <tr>
            <td><?= $order->code ?></td>
            <td><?= $order->customerName ?></td>
            <td><?= $order->phone ?></td>
            <td><?= $order->total ?></td>
            <td><?= $order->address ?></td>
            <td><?= $order->note ?></td>
            <td>
              <form action="order.php" method="GET">
              <input type="hidden" name="id" value="<?= $order->orderId ?>">
              <select name="status" onchange="this.form.submit()">
                <?php foreach ($statusList as $key => $value) : ?>
                  <option value="<?php echo $key; ?>" <?php if ($key == $order->orderStatus) echo 'selected'; ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
              </form>
              </td>
            </select></td>
            <td><?= $order->createAt ?></td>
            <td>
              <a href="tracking-order.php?code=<?= $order->code ?>"> xem chi tiết </a>
              <a href="tracking-order.php?code=<?= $order->code ?>">xóa đơn hàng</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>
  </div>
</body>

</html>