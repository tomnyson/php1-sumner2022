<?php
require('db-connect.php');
// unset($_SESSION['carts']);
?>
<html>

<head>
    <title>thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php
        function searchForId($id, $array)
        {
            foreach ($array as $key => $val) {
                if ($val['productId'] === $id) {
                    return $key;
                }
            }
            return -1;
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "select * from cars where id = :id";
            $stm = $conn->prepare($sql);
            $stm->execute([':id' => $id]);
            $product = $stm->fetch(PDO::FETCH_OBJ);
            //add cart
            if ($_GET['action'] == 'add') {
             
                if (isset($_SESSION['carts'])) {
                    $carts = $_SESSION['carts'];
                    if (searchForId($id, $carts) != -1) {
                        $index =  searchForId($id, $carts);
                        $currentCart = $carts[$index];
                        $carts[$index] = array(
                            'productId' => $product->id,
                            'name' => $product->title,
                            'price' => $product->price,
                            'quantity' => $currentCart['quantity'] + 1,
                            'image' => $product->image,
                            'total' => ($currentCart['quantity'] + 1) * $product->price
                        );
                        $_SESSION['carts'] = $carts;
                    } else {
                        $carts[] = array(
                            'productId' => $product->id,
                            'name' => $product->title,
                            'price' => $product->price,
                            'quantity' => 1,
                            'image' => $product->image,
                            'total' => $product->price
                        );
                        $_SESSION['carts'] = $carts;
                    }
                } else {
                    $carts = array();
                    $carts[] = array(
                        'productId' => $product->id,
                        'name' => $product->title,
                        'price' => $product->price,
                        'quantity' => 1,
                        'image' => $product->image,
                        'total' => $product->price
                    );
                    $_SESSION['carts'] = $carts;
                }
            } else if ($_GET['action'] == 'remove') {
               
                if (isset($_SESSION['carts'])) {
                    $carts = $_SESSION['carts'];
                    if (searchForId($id, $carts) != -1) {
                        $index = searchForId($id, $carts);
                        unset($carts[$index]);
                    }
                    $_SESSION['carts'] = $carts;
                }
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
        <a href="checkout.php">thanh toán</a>
        <div class="row">
            <div class="col col-md-6">

            </div>
            <div class="col col-md-6">
                
            </div>
        </div>
        <div class="table-responsive-sm">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">hình ảnh</th>
                        <th scope="col">giá</th>
                        <th scope="col">số lượng</th>
                        <th scope="col">tổng tiền</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['carts'])&&count($_SESSION['carts']) > 0) {
                        foreach ($_SESSION['carts'] as $cart) { ?>
                            <tr>
                                <td><?= $cart['productId'] ?></td>
                                <td><?= $cart['name'] ?></td>
                                <td><img src="<?= $cart['image'] ?>" onerror="this.src='https://via.placeholder.com/100'" width="100px"></td>
                                <td><?= $cart['price'] ?></td>
                                <td><?= $cart['quantity'] ?></td>
                                <td><?= number_format($cart['total']) ?></td>
                                <td>
                                    <a href="add-cart.php?id=<?= $cart['productId'] ?>&action=add" class="btn btn-success">thêm </a>
                                    <a href="add-cart.php?id=<?= $cart['productId'] ?>&action=remove" class="btn btn-danger">xóa</a>
                                </td>
                            </tr>
                    <?php }
                    } else {
                        echo "<tr><td class='text text-danger' colspan='6'>không có sản phẩm nào trong giỏ hàng</td></tr>";
                    } ?>
                </tbody>
            </table>
            <h5 class='text text-danger'>total : <?php echo number_format($total) ?> VNĐ</h6>
        </div>
    </div>

</body>

</html>