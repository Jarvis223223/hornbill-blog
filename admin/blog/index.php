<?php 
  // Get Blogs
  $statement = $db->prepare("SELECT blogs.id, blogs.title, blogs.content, blogs.image, blogs.created_at, categories.name as category_name, users.name as users_name FROM blogs
    INNER JOIN categories ON blogs.category_id = categories.id
    INNER JOIN users ON blogs.user_id = users.id
  ");
  $statement->execute();
  $blogs = $statement->fetchAll(PDO::FETCH_OBJ);

  // Delete Blog
  if (isset($_POST['blogDelBtn'])) {
    $blogId = $_POST['blog_id'];

    // To get image before delete image.
    $selectStm = $db->prepare("SELECT image FROM blogs WHERE id=$blogId");
    $selectStm->execute();
    $blog = $selectStm->fetchObject();
    
    $statement = $db->prepare("DELETE FROM blogs WHERE id=$blogId");
    $result = $statement->execute();
    if ($result) {     
      unlink("../assets/blog-images/$blog->image");
      echo "<script>sweetAlert('deleted a blog.', 'blogs')</script>";
    }
  }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
        <a href="index.php?page=blogs-create" class="btn btn-primary btn-sm"> <i class="fas fa-solid fa-plus"></i> Add New</a>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php 
                    foreach($blogs as $blog) :
                  ?>    
                    <tr>
                      <td><?= $blog->id ?></td>
                      <td>
                        <img src="../assets/blog-images/<?php echo $blog->image?>" style="width: 100px">
                      </td>
                      <td>
                        <?php echo $blog->category_name ?>
                      </td>
                      <td><?= $blog->title?></td>
                      <td>
                        <div class='p-2' style="max-width: 300px;max-height: 200px;overflow: auto;"><?= $blog->content?></div>
                      </td>
                      <td><?= $blog->users_name?></td>
                      <td><?= $blog->created_at?></td>
                      <td>
                        <form method="post">
                          <input type="hidden" name="blog_id" value="<?php echo $blog->id ?>">
                          <a title="edit" href="index.php?page=blogs-edit&blog_id=<?php echo $blog->id; ?>" class="m-1 btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                          <button title="delete" name="blogDelBtn" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                          <a title="comment" href="index.php?page=blogs-comments&blog_id=<?php echo $blog->id; ?>" class="btn btn-info btn-sm m-1">
                            <i class="far fa-comment-dots"></i>
                          </a>
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

