<?php 
  $nameErr = '';
  $emailErr = '';
  $pwdErr = '';
  if (isset($_POST['user-create-btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    if ($name === '') {
      $nameErr = "The name field is required!";
    } else if ($email === '') {
      $emailErr = "The email field is required!";
    } else if ($password === '') {
      $pwdErr = "The password field is required!";
    } else {
      $password = md5($password);
      $statement = $db->prepare("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
      $statement->execute();
      echo "<script>sweetAlert('created a user.', 'users')</script>";
    } 
 }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Users Creation Form</h6>
          <a href="index.php?page=users" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back</a>
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="mb-2">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control">
              <span class="text-danger"><?php echo $nameErr; ?></span>
            </div>
            <div class="mb-2">
              <label for="">Email</label>
              <input type="text" name="email" class="form-control">
              <span class="text-danger"><?php echo $emailErr; ?></span>
            </div>
            <div class="mb-2">
              <label for="">Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>
            <div class="mb-2">
              <label for="">Password</label>
              <input type="text" name="password" class="form-control">
              <span class="text-danger"><?php echo $pwdErr; ?></span>
            </div>
            <button name="user-create-btn" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>