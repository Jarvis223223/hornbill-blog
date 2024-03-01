<?php 
  $userId = $_SESSION['user']->id;
  $statement = $db->prepare("SELECT * FROM users WHERE id=$userId");
  $statement->execute();
  $user = $statement->fetchObject();
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Users Profile</h6>
        </div>
        <div class="card-body">
          <div class="my-3"><strong>Name</strong> : <?php echo $user->name ?></div>
          <div class="my-3"><strong>Email</strong> : <?php echo $user->email ?></div>
          <div class="my-3"><strong>Email</strong> : <?php echo $user->role ?></div>
        </div>
      </div>
    </div>
  </div>

