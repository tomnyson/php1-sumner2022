<?php
require('db-connect.php');
$page = 1;
$limit = 20;
$total_pages = 0;
$keyword = '';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
if(!empty($_GET['keyword'])) {
    $keyword = trim($_GET['keyword']);
}
$sql = "select * from cars where title like :title  limit " . (($page - 1) * $limit) . ",$limit";
$stm = $conn->prepare($sql);
$stm->execute([
    'title' => !empty($keyword) ? "%$keyword%" : '%%']);
$sql_total = "select count(*) as total from cars where title like :title";
$stm_total = $conn->prepare($sql_total);
$stm_total->execute([
    'title' => !empty($keyword) ? "%$keyword%" : '%%']);
$total = $stm_total->fetch(PDO::FETCH_OBJ)->total;
$cars = $stm->fetchAll(PDO::FETCH_OBJ);
$total_pages = ceil($total / $limit);
?>
<html>

<head>
    <title>thêm Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css" />
</head>

<body>
    <div class="container">
        <?php
        include('layout/header.php');
        ?>
        <div style='width: 25%' class="mb-2">
            <form action="product.php" method="GET" class="input-group rounded">
                <input type="search" name="keyword" class="form-control rounded" placeholder="tìm kiếm xe" aria-label="Search" aria-describedby="search-addon" />
                <input class="btn btn-success" type="submit" value="tìm kiếm" />
            </form>
        </div>
        <div class="row">

            <?php
            if(count($cars) >0){
            foreach ($cars as $car) { ?>
                <div class="col col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="<?= $car->image ?>" onerror="this.src='https://via.placeholder.com/150'" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><a href="product-detail.php?id=<?= $car->id ?>"><?= $car->title ?></a></h5>
                            <p class="card-text"><?= $car->description ?></p>
                            <p class="card-price"><?= $car->price ?></p>
                            <a href="add-cart.php?id=<?= $car->id ?>&action=add" class="btn btn-primary">mua hàng</a>
                        </div>
                    </div>
                </div>
            <?php }} else {
                echo '<h3>Không có sản phẩm nào</h3>';
             } ?>
            <nav class="navigation example">
                <?php
                if (ceil($total_pages / $limit) > 0) : ?>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item"><a class="page-link" href="product.php?page=<?php echo $page - 1 ?>">Prev</a></li>
                            <?php endif; ?>
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo " <li class='page-item'><a class='page-link' href='product.php?page=$i'>$i</a></li>";
                            }
                            ?>
                            <?php if ($page <  $total_pages) : ?>
                                <li class="page-item"><a class="page-link" href="product.php?page=<?php echo $page - 1 ?>">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            </nav>
        </div>
    </div>
</body>

</html>