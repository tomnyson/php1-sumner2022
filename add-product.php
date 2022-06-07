<html>

<head>
  <title>thêm sản phẩm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">ADMIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">list</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">product</a>
          </li>
        </ul>
      </div>
    </nav>
    <h2>thêm sản phẩm</h2>
    <form id="frmProductCreate">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">id</label>
        <input type="text" class="form-control" id="id" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">name</label>
        <input type="text" class="form-control" id="name">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">price</label>
        <input type="number" class="form-control" id="price">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">image</label>
        <input type="text" class="form-control" id="image">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">description</label>
        <textarea class="form-control" type="text" class="form-control" id="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-submit" value="add">ADD</button>
      <div>
      </div>
    </form>

  </div>
</body>

</html>