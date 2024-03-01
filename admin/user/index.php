<?php 
  // get Users
  $statement = $db->prepare("SELECT * FROM users");
  $statement->execute();
  $users = $statement->fetchAll(PDO::FETCH_OBJ);

  // Delete User
  if (isset($_POST['userDelBtn'])) {
    $userId = $_POST['user_id'];

    $statement = $db->prepare("DELETE FROM users WHERE id=$userId");
    $statement->execute();
    echo "<script>sweetAlert('deleted a user.', 'users')</script>";
  }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
        <a href="index.php?page=users-create" class="btn btn-primary btn-sm"> <i class="fas fa-solid fa-plus"></i> Add New</a>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php 
                    foreach($users as $user) :
                  ?>    
                    <tr>
                      <td><?= $user->id ?></td>
                      <td><?= $user->name?></td>
                      <td><?= $user->email?></td>
                      <td><h5>
                        <?php if ($user->role === 'admin') :?>
                          <span class="badge badge-danger badge-lg">Admin</span>
                        <?php elseif ($user->role === 'user') :?>
                          <span class="badge badge-primary badge-lg">User</span>
                        <?php endif ?>
                      </h5></td>
                      <td>
                        <form method="post">
                          <input type="hidden" name="user_id" value="<?php echo $user->id ?>">
                          <a href="index.php?page=users-edit&user_id=<?php echo $user->id; ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                          <button href="" name="userDelBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr> 
                  <?php 
                    endforeach;
                  ?>
                    
                </tbody>
              </table>
          </div>
      </div>
        </div>
    </div>
  </div>

