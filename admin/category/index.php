<?php 
    // SELECT
    $statement = $db->prepare("SELECT * FROM categories");
    $statement->execute();
    $categories = $statement->fetchAll(PDO::FETCH_OBJ);

    // DELETE
    if (isset($_POST['delBtn'])) {
        $categoryId = $_POST["category_id"];

        $statement = $db->prepare("DELETE FROM categories WHERE id=$categoryId");
        $statement->execute();
        echo "<script>sweetAlert('deteled a category.', 'categories')</script>"; 
    }
?>

<div class="container-fluid">
  <!-- Content Row -->
  <div class="row">
    <div class="col-md-12">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                <a href="index.php?page=categories-create" class="btn btn-primary btn-sm">  <i class="fas fa-solid fa-plus"></i> Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                                foreach($categories as $category) :
                            ?>    
                                <tr>
                                    <td><?= $category->id ?></td>
                                    <td><?= $category->name?></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="category_id" value="<?php echo $category->id; ?>">
                                            <a href="index.php?page=categories-edit&category_id=<?php echo $category->id; ?>" class="btn btn-success btn-sm"> <i class="far fa-edit"></i> </a>
                                            <button href="" name="delBtn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash-alt"></i> </button>
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

