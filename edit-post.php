<?php

session_start();

if (!isset($_SESSION['user_id'])) {

  header('location: sdit-post.php');
}

require_once 'app/helpers.php';
$page_title = 'Edit Post Page';
$errors = ['title' => '', 'article' => '',];

$uid = $_SESSION['user_id'];
$pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);

if ($pid && is_numeric($pid)) {

  $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
  $pid = mysqli_real_escape_string($link, $pid);
  $sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
  $result = mysqli_query($link, $sql);

  if ($result && mysqli_num_rows($result) == 1) {

    $post = mysqli_fetch_array($result);
  } else {
    header('location: blog.php');
  }
} else {

  header('location: blog.php');
}

if (isset($_POST['submit'])) {

  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $title = trim($title);
  $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $article = trim($article);
  $form_valid = true;

  if (!$title || mb_strlen($title) < 2) {
    $errors['title'] = '* Title is required for at least 2 chars';
    $form_valid = false;
  }

  if (!$article || mb_strlen($article) < 2) {
    $errors['article'] = '* Article is required for at least 2 chars';
    $form_valid = false;
  }

  if ($form_valid) {

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    $title = mysqli_real_escape_string($link, $title);
    $article = mysqli_real_escape_string($link, $article);
    $sql = "UPDATE posts SET title = '$title',article = '$article' WHERE id = $pid AND user_id = $uid";
    mysqli_query($link, $sql);
    header('location: blog.php');
  }
}

?>

<?php get_header(); ?>

<main class="mh-900">
  <div class="container">
    <section id="edit-post-content">
      <div class="row">
        <div class="col-12 mt-5">
          <h1 class="display-4">Edit post</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
      </div>
    </section>
    <section id="edit-post-form">
      <div class="row">
        <div class="col-lg-6">
          <form action="" method="POST" autocomplete="off" novalidate="novalidate">
            <div class="mb-3">
              <label for="title" class="form-label">* Title</label>
              <input type="text" class="form-control" id="title" name="title" value="<?= $post['title']; ?>">
              <span class="text-danger"><?= $errors['title']; ?></span>
            </div>
            <div class="mb-3">
              <label for="article" class="form-label">* Article</label>
              <textarea class="form-control" name="article" id="article" cols="30"
                rows="10"><?= $post['article']; ?></textarea>
              <span class="text-danger"><?= $errors['article']; ?></span>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update Post</button>
            <a class="btn btn-secondary" href="blog.php">Cancel</a>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>