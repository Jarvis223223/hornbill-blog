<?php 
  $userId = $_GET['user_id'];

  // Old User
  $statement = $db->prepare("SELECT * FROM users WHERE id=$userId");
  $statement->execute();
  $user = $statement->fetchObject(); // *****

  // Update User
  $nameErr = "";
  $emailErr = "";
  $pwdErr = "";

  if (isset($_POST['user-update-btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($name === "") {
      $nameErr = "The name field is required!";
    }else if ($email === "") {
      $emailErr = "The email field is required!";
    }else {
      if ($password == '') {
        $statement = $db->prepare("UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$userId");
      } else {
        $password = md5($password);
        $statement = $db->prepare("UPDATE users SET name='$name', email='$email', password='$password', role='$role' WHERE id=$userId");
      }
      
      $statement->execute();
      echo "<script>sweetAlert('updated a user.', 'users')</script>";
    }
  }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary"> Edit Form</h6>
          <a href="index.php?page=users" class="btn btn-primary btn-sm"><< Back</a>
        </div>
        <div class="card-body">
        <form action="" method="post">
          <div class="mb-2">
            <label for="">Name</label>
            <input type="text" value="<?php echo $user->name ?>" name="name" class="form-control">
            <span class="text-danger"><?php echo $nameErr; ?></span>
          </div>
          <div class="mb-2">
            <label for="">Email</label>
            <input type="text" name="email" value="<?php echo $user->email ?>" class="form-control">
            <span class="text-danger"><?php echo $emailErr; ?></span>
          </div>
          <div class="mb-2">
            <label for="">Role</label>
            <select name="role" class="form-control">
              <option value="admin"
                <?php if ($user->role == "admin") : ?>
                  selected
                <?php endif ?>
              >Admin</option>
              <option value="user"
                <?php if ($user->role == "user") : ?>
                  selected
                <?php endif ?>
              >User</option>
            </select>
          </div>
          <div class="mb-2">
            <label for="">Password</label>
            <input type="checkbox" onclick="showPwdInput()" id='checkbox'>
            <input type="text" name="password" class="form-control" style="display: none;" id='password-input' placeholder="Enter new password">
            <span class="text-danger"><?php echo $pwdErr; ?></span>
          </div>
          <button name="user-update-btn" class="btn btn-primary">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let checkbox = document.getElementById("checkbox");
  let passwordInput = document.getElementById("password-input");
  function showPwdInput () {
    if (checkbox.checked) {
      passwordInput.style.display = "block";
    } else {
      passwordInput.style.display = "none";
    }
  }
</script>