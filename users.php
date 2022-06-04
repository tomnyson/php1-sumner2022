<?php

require "connect.php";
$sql = "select * from users";
$stmt = $connection->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_OBJ);
require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h5>All Users</h5>
      <a href="create-user.php" class="btn btn-primary" href="#">create user</a>
    </div>

    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>username</th>
          <th>role</th>
          <th>Action</th>
        </tr>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td><?= $user->id; ?></td>
            <td><?= $user->name; ?></td>
            <td><?= $user->username; ?></td>
            <td>
              <?= $user->role == 1 ? 'admin' : 'user'; ?>
            </td>
            <td>
              <a href="edit-user.php?id=<?= $user->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete-user.php?id=<?= $user->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
</body>

</html>