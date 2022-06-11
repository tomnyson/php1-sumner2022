<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">ADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./mysql.php">list</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-category.php">category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-product.php">product</a>
      </li>
    </ul>
  </div>
  <?php
    if(isset($_SESSION['user'])){
      echo "<span style='margin-right: 20px;'>xin chào: ".$_SESSION['user']->username."</span>";
      echo '<a href="logout.php" class="btn btn-primary">Logout</a>';
    }
  ?>
      
</nav>