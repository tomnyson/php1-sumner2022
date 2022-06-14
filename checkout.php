<?php
require('db-connect.php');
include('mailService.php');
// unset($_SESSION['carts']);
?>
<html>

<head>
    <title>thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php
        $errors = array();
            if(isset($_POST['action']) && isset($_SESSION['carts'])) {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $note = $_POST['note'];
                $total = $_POST['total'];
                $carts = $_SESSION['carts'];
                if(empty($name)) {
                    $errors['name'] = 'Vui lòng nhập họ tên';
                }
                if(empty($phone)) {
                    $errors['phone'] = 'Vui lòng nhập số điện thoại';
                }
                if(empty($address)) {
                    $errors['address'] = 'Vui lòng nhập địa chỉ';
                }
                if(empty($note)) {
                    $errors['note'] = 'Vui lòng nhập ghi chú';
                }
                if(empty($total)) {
                    $errors['total'] = 'Vui lòng nhập tổng tiền';
                }
                if(empty($carts)) {
                    $errors['carts'] = 'Vui lòng chọn sản phẩm';
                }
                if(count($errors) == 0) {
                    $sql = "insert into orders(customerId, code, note, address, total, phone, customerName, orderStatus, createAt)
                     values(:customerId, :code, :note, :address, :total, :phone, :customerName, :orderStatus, :createAt)";
                    $stm = $conn->prepare($sql);
                    $content = '';
                    $code = 'DH'.$_SESSION['user']->id.uniqid();
                    $stm->execute([
                        'customerId' => $_SESSION['user']->id,
                        'note' => $note,
                        'code'=> $code,
                        'address' => $address,
                        'total' => $total,
                        'phone' => $phone,
                        'customerName' => $name,
                        'orderStatus' => 0,
                        'createAt' => date('Y-m-d H:i:s')
                    ]);
                    $content.='<h2>Thông tin đơn hàng</h2>';
                    $content.='<p>Mã đơn hàng: '.$code.'</p>';
                    $content.='<p>Ngày đặt hàng: '.date('d/m/Y H:i:s').'</p>';
                    $content.='<p>Người nhận: '.$name.'</p>';
                    $content.='<p>Địa chỉ: '.$address.'</p>';
                    $content.='<p>Số điện thoại: '.$phone.'</p>';
                    $content.='<p>Ghi chú: '.$note.'</p>';
                    $content.='<p><strong style="color: red"> Tổng tiền: '.number_format($total).'</strong></p>';
                    $content.= '<table class="table table-bordered">';
                    $content.= '<thead>';
                    $content.= '<tr>';
                    $content.= '<th>STT</th>';
                    $content.= '<th>Tên sản phẩm</th>';
                    $content.= '<th>Số lượng</th>';
                    $content.= '<th>Đơn giá</th>';
                    $content.= '<th>Thành tiền</th>';
                    $content.= '</tr>';
                    $content.= '</thead>';
                    $content.= '<tbody>';
                    $i = 1;
                    // get last id of order
                    $orderId = $conn->lastInsertId();
                    foreach($_SESSION['carts'] as $cart) {
                        $sql = "insert into order_details(orderId, productId, quantity, price, total)
                        values(:orderId, :productId, :quantity, :price, :total)";
                        $stm = $conn->prepare($sql);
                        $stm->execute([
                            'orderId' => $orderId,
                            'productId' => $cart['productId'],
                            'quantity' => $cart['quantity'],
                            'price' => $cart['price'],
                            'total' => $cart['quantity']*$cart['price']
                        ]);

                        $content.= '<tr>';
                        $content.= '<td>'.$i.'</td>';
                        $content.= '<td>'.$cart['name'].'</td>';
                        $content.= '<td>'.$cart['quantity'].'</td>';
                        $content.= '<td>'.$cart['price'].'</td>';
                        $content.= '<td>'. $cart['quantity']*$cart['price'].'</td>';
                        $content.= '</tr>';
                    }
                    $content.= '</tbody>';
                    $content.= '</table>';
                    $content.= '<p>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi</p>';
                    MailService::send('tabletkindfire@gmail.com', $_SESSION['user']->email, 'Thông tin đơn hàng', $content);
                    unset($_SESSION['carts']);
                    header('location: confirm.php');
                    echo '<div class="alert alert-success">Đặt hàng thành công</div>';
            }
        }
        $total = 0;
        if (isset($_SESSION['carts'])) {
            $carts = $_SESSION['carts'];
            foreach ($carts as $cart) {
                $total += $cart['total'];
            }
        }
        // header('Location: product.php');
        ?>
        <a href="product.php">tiếp tục mua hàng</a> </br>
        <?php
        if (!isset($_SESSION['user'])) {
            echo '<a href="login.php">Đăng nhập</a>';
        }
        ?>
        <div class="row">
            <div class="col col-md-7">
                <h3>Thông tin đơn hàng</h3>
                <?php
                if(count($errors) > 0) {
                    echo '<div class="text text-danger">';
                    foreach($errors as $error) {
                        echo $error . '</br>';
                    }
                    echo '</div>';
                }
                ?>
                <form action="checkout.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">tên người nhận</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">địa chỉ</label>
                        <input type="text" name="address" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">số điện thoại</label>
                        <input type="phone" name="phone" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">ghi chú</label>
                        <input type="note" name="note" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <input class="form-check-input" checked type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            COD(trả bằng tiền mặt khi  nhận hàng)
                        </label>
                        <input type="hidden" name="total" value="<?= $total ?>"/>
                    </div>
                    <?php
                     if (!isset($_SESSION['user'])) {
                        $_SESSION['redirect'] = 'checkout.php';
                        echo '<a href="login.php">Đăng nhập</a>';
                     }else 
                        {
                            echo '<button type="submit" name="action" value="checkout" class="btn btn-primary">Thanh toán</button>';
                        }
                    ?>
                   
                </form>
            </div>
            <div class="col col-md-5">
                <div class="table-responsive-sm">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Tên</th>
                                <th scope="col">giá</th>
                                <th scope="col">số lượng</th>
                                <th scope="col">tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['carts']) && count($_SESSION['carts']) > 0) {
                                foreach ($_SESSION['carts'] as $cart) { ?>
                                    <tr>
                                        <td><?= $cart['name'] ?></td>
                                        <td><?= $cart['price'] ?></td>
                                        <td><?= $cart['quantity'] ?></td>
                                        <td><?= number_format($cart['total']) ?></td>
                                    </tr>
                            <?php }
                            } else {
                                echo "<tr><td class='text text-danger' colspan='6'>không có sản phẩm nào trong giỏ hàng</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                    <h5 class='text text-danger'>tổng tiền : <?php echo number_format($total) ?> VNĐ</h6>
                </div>
            </div>
        </div>

    </div>

</body>

</html>