<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('location: blog.php');
}

require_once 'app/helpers.php';
$page_title = 'Sign In';
$error = '';

if (isset($_POST['submit'])) {

  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email = trim($email);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $password = trim($password);

  if (!$email) {
    $error = '* Email is required';
  } elseif (!$password) {
    $error = '* Password is required';
  } else {

    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    // block sql injection / clean data from user
    $email = mysqli_real_escape_string($link, $email);
    $password = mysqli_real_escape_string($link, $password);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result)) {

      $user = mysqli_fetch_assoc($result);

      if (password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('location: blog.php');
      } else {
        $error = '* Email or password are incorect';
      }
    }
  }
};

?>

<?php get_header(); ?>

<main class="mh-900">
    <div class="container">
        <section id="signin-to-digg">
            <div class="row">
                <div class="col-12 mt-5">
                    <h1 class="display-4">Here you can sign in with your account</h1>
                    <p>Or create new <a href="signup.php">account</a></p>
                </div>
            </div>
        </section>
        <section id="signin-form-content">
            <div class="row">
                <div class="col-lg-6">
                    <form id="signin-form" action="" method="POST" novalidate="novalidate">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= old('email'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
                        <span class="text-danger"><?= $error; ?></span>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>