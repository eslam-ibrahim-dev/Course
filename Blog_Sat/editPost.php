<?php require_once 'inc/header.php';
   require_once 'inc/db.php';

?>
<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>Edit Post</h4>
          <h2>edit your personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <?php
    if (!isset($_GET['id'])) {
      header("location:index.php");
      exit();
    }
    $id = $_GET['id'];
    $query = "SELECT * FROM posts where id = $id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
    if (!empty($post)) {
    ?>
      <h3 class="my-5">edit Post</h3>
  </div>

  <form method="POST" action="Handle/handleUpdate.php?id=<?php echo $post['id'] ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title'] ?>">
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      <textarea class="form-control" id="body" name="body" rows="5"><?php echo $post['body'] ?></textarea>
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">image</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <img src="assets/images/postImage/<?php echo $post['image'] ?>" alt="" width="100px" srcset=""> 
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
  <?php  } else { ?>  <img src="assets/images/postImage/1-10.webp" alt=""> <?php }?>
</div>


<?php require_once 'inc/footer.php' ?>