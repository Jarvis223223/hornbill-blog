<?php 
  $statement = $db->prepare("SELECT * FROM categories");
  $statement->execute();
  $categories = $statement->fetchAll(PDO::FETCH_OBJ);

  // Create Category
  $titleErr = '';
  $categoryErr = '';
  $contentErr = '';
  $imageErr = '';
  if (isset($_POST['blog-create-btn'])) {
    $title = $_POST['title'];
    $categoryId = $_POST['category_id'];
    $content = $_POST['content'];
    $userId = $_SESSION['user']->id;
    $createdAt = date('Y-m-d H:i:s');

    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    if ($title == '') {
      $titleErr = "The title fields is required!";
    }else if ($categoryId == '') {
      $categoryErr = "The category fields is required!";
    } else if ($content == '') {
      $contentErr = "The content fields is required!";
    } else if ($imageName == '') {
      $imageErr = "The image fields is required!";
    } else {
      $imageName = uniqid() . "_" . $imageName; //Give imageName UNIQUE 

      if (in_array($imageType, ['image/png', 'image/jpeg', 'image/jpg'])) {
        move_uploaded_file($imageTmpName, "../assets/blog-images/$imageName");
      }
  
      $statement = $db->prepare("INSERT INTO blogs (title, category_id, content, image, user_id, created_at) VALUES ('$title', $categoryId, '$content', '$imageName', $userId, '$createdAt')");
      $resutl = $statement->execute();
      if ($resutl) {
        echo "<script>sweetAlert('created a blog.', 'blogs')</script>";
      }
    }
  }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Blogs Creation Form</h6>
          <a href="index.php?page=blogs" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back</a>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-2">
              <label for="">Title</label>
              <input type="text" name="title" class="form-control">
              <span class="text-danger"><?php echo $titleErr; ?></span>
            </div>
            <div class="mb-2">
              <label for="">Category</label>
              <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                <?php foreach($categories as $category) :?>
                  <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
              </select>
              <span class="text-danger"><?php echo $categoryErr; ?></span>
            </div>
            <div class="mb-2">
              <label for="">Content</label>
              <textarea name="content" class="form-control" rows="10"></textarea>
              <span class="text-danger"><?php echo $contentErr; ?></span>
            </div>
            <div class="mb-2">
              <label for="">Images</label>
              <input type="file" name="image" class="form-control">
              <span class="text-danger"><?php echo $imageErr; ?></span>
            </div>
            <button name="blog-create-btn" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>