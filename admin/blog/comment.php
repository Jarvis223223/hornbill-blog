<?php 
  $blogId = $_GET['blog_id'];

  // Get comments depending on blog
  $statement = $db->prepare("SELECT comments.id, comments.text, comments.created_at, users.name FROM comments INNER JOIN users ON comments.user_id = users.id WHERE blog_id=$blogId");
  $statement->execute();
  $comments = $statement->fetchAll(PDO::FETCH_OBJ); 
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Comment List</h6>
        <a href="index.php?page=blogs" class="btn btn-primary btn-sm"> <i class="fas fa-angle-double-left"></i> Back</a>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            <?php if (count($comments) >= 1) : ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>User</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php 
                    foreach($comments as $comment) :
                  ?>    
                    <tr>
                      <td><?php echo $comment->id ?></td>                     
                      <td>
                        <?php echo $comment->text ?>
                      </td>
                      <td><?php echo $comment->name ?></td>
                      <td><?php echo $comment->created_at?></td>
                    </tr> 
                  <?php 
                    endforeach;
                  ?>
                    
                </tbody>
              </table>
            <?php else: ?> 
              <p>No comment yet</p>
            <?php endif; ?> 
          </div>
      </div>
      </div>
    </div>
  </div>

