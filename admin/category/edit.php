<?php 
  $categoryId = $_GET['category_id'];

  // Old Category
  $statement = $db->prepare("SELECT * FROM categories WHERE id=$categoryId");
  $statement->execute();
  $category = $statement->fetchObject(); // *****

  // Update Category
  $nameErr = "";
  if (isset($_POST['category-update-btn'])) {
    $name = $_POST['name'];
    if ($name === "") {
      $nameErr = "The name field is required!";
    }else {
      $statement = $db->prepare("UPDATE categories SET name='$name' WHERE id=$categoryId");
      $statement->execute();
      echo "<script>sweetAlert('updated a category.', 'categories')</script>";
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
          <a href="index.php?page=categories" class="btn btn-primary btn-sm"><< Back</a>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-2">
                    <label for="">Name</label>
                    <input type="text" value="<?php echo $category->name ?>" name="name" class="form-control">
                    <span class="text-danger"><?php echo $nameErr; ?></span>
                </div>
                <button name="category-update-btn" class="btn btn-primary">Update</button>
            </form>
        </div>
      </div>
    </div>
  </div>

</div>