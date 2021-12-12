<?php

session_start();

if (!isset($_SESSION['user_id'])) {

  header('location: signin.php');
}

require_once 'app/helpers.php';
$page_title = 'Delete Post Page';

$uid = $_SESSION['user_id'];

if (isset($_POST['delete'])) {
  //echo $_GET['pid'];

  $pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

  if ($pid && is_numeric($pid)) {

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
    $pid = mysqli_real_escape_string($link, $pid);
    $sql = "DELETE FROM posts WHERE id = $pid AND user_id = $uid";
    mysqli_query($link, $sql);
    header('location: blog.php');
  }
}

?>

<?php get_header(); ?>

<main class="mh-900">
  <div class="container">
    <section id="delete-post-content">
      <div class="row">
        <div class="col-12 mt-5">
          <h3>Are you sure you want to delete this post?</h3>
          <p>This action will delete this post</p>
          <form action="" method="POST">
            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            <a href="blog.php" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>