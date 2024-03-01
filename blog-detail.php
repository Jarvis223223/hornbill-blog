<?php 
    require_once("layout/header.php");
    // Nav
    require_once("layout/navbar.php");

    // Get Blog
    $blogId = $_GET['blog_id'];
    $statement = $db->prepare("SELECT blogs.title, blogs.content, blogs.image, blogs.created_at, users.name FROM blogs INNER JOIN users ON blogs.user_id=users.id WHERE blogs.id = $blogId");
    $statement->execute();
    $blog = $statement->fetchObject();

    // Create Comment
    if (isset($_POST['createCommentBtn'])) {
        $text = $_POST['text'];
        $userId = $_SESSION['user']->id;
        $date = date('Y-m-d H:i:s');
        
        $statement = $db->prepare("INSERT INTO comments (text, blog_id, user_id, created_at) VALUES ('$text', $blogId, $userId, '$date')");
        $result = $statement->execute();
        if ($result) {
            echo "<script>sweetAlert('created a comment', 'blog-detail.php?blog_id=" . $blogId ." ')</script>";
        }
    }

    // Get comments depending on blog
    $commentStatement = $db->prepare("SELECT comments.text, comments.created_at, users.name FROM comments INNER JOIN users ON comments.user_id=users.id WHERE blog_id=$blogId");
    $commentStatement->execute();
    $comments = $commentStatement->fetchAll(PDO::FETCH_OBJ); 
?>

    <div id="blog-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <h3 data-aos="fade-right" data-aos-duration="1000">Blog Detail</h3>
                    <div class="heading-line" data-aos="fade-left" data-aos-duration="1000"></div>
                    <div class="card my-3" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="card-body p-0">
                            <div class="img-wrapper">
                                <img src="assets/blog-images/<?php echo $blog->image ?>" class="img-fluid" alt="">
                            </div>
                            <div class="content p-3">
                                <h5 class="fw-semibold"><?php echo $blog->title ?></h5>
                                <div class="mb-3"><?php echo $blog->created_at ?> | by <?php echo $blog->name ?></div>
                                <p>
                                    <?php echo $blog->content; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Comment section -->
                    <div class="comment">
                        <?php if (isset($_SESSION['user'])) : ?>
                        <h5 data-aos="fade-right" data-aos-duration="1000">Leave a Comment</h5>
                        <form method="post" data-aos="fade-left" data-aos-duration="1000">
                            <div class="mb-2">
                                <textarea name="text" rows="5" class="form-control" required></textarea>
                            </div>
                            <button name="createCommentBtn" class="btn">Submit</button>
                        </form>
                        <?php else : ?>
                            <a aria-current="staticBackdrop" href="#signIn" data-bs-toggle="offcanvas" class="btn btn-primary">Sign In to comment</a>
                        <?php endif; ?>
                        <h6 class="fw-bold mt-5">User's comment</h6>
                        <?php foreach($comments as $comment) :?>
                        <div class="card card-body my-3" data-aos="fade-right" data-aos-duration="1000">
                            <h6><?php echo $comment->name ?></h6>
                            <?php echo $comment->text; ?>
                            <div class="mt-3">
                                <span class="float-end"><?php echo $comment->created_at ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php require_once("layout/right-side.php"); ?>
            </div>
        </div>
    </div>

    <?php 
        require_once("layout/footer.php");
    ?>