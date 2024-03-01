<?php 
  $nameErr = "";
  if (isset($_POST['category-create-btn'])) {
    $name = $_POST['name']; 

    if ($name === "") {
      $nameErr = "The name field is required!";
    }else {
      $statement = $db->prepare("INSERT INTO categories (name) VALUES ('$name')");
      $statement->execute();
      echo "<script>sweetAlert('created a category.', 'categories')</script>";
    }
  }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Category Creation Form</h6>
          <a href="index.php?page=categories" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back</a>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-2">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    <span class="text-danger"><?php echo $nameErr; ?></span>
                </div>
                <button name="category-create-btn" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>
  </div>

</div>