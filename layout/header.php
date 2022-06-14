<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="product.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./product.php">sản phẩm</span></a>
      </li>
      <?php
      if (isset($_SESSION['user']) && $_SESSION['user']->role == 'admin') { ?>
        <li class="nav-item">
          <a class="nav-link" href="add-category.php">thêm danh mục</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-product.php">thêm sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order.php">quản lý đơn hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-user.php">quản lý user</a>
        </li>
      <?php } ?>
      <li class="nav-item">
          <a class="nav-link" href="contact.php">liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tracking-order.php">kiểm tra đơn hàng</a>
        </li>
        
        
    </ul>
  </div>
  <?php
  if (isset($_SESSION['carts']) && count($_SESSION['carts']) > 0) {
    $num = count($_SESSION['carts']);
    echo "<a href='add-cart.php' class='btn btn-primary'>cart[($num)</a>";
  }
  if (isset($_SESSION['user'])) {
    echo "<a href='my-order.php' class='btn btn-link'>đơn hàng của tôi</a>";
    echo "<span style='margin-right: 20px;'>xin chào: " . $_SESSION['user']->username . "</span>";
    echo '<a href="logout.php" class="btn btn-link">Logout</a>';
  }else {
    echo '<a href="login.php" class="btn btn-link">Login</a>';
  }
  ?>

</nav>