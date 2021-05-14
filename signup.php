<?php

session_start();

if (isset($_SESSION['user_id'])) {
  header('location: blog.php');
}

require_once 'app/helpers.php';
$page_title = 'Sign Up';
$errors = ['name' => '', 'email' => '', 'password' => '',];


if (isset($_POST['submit'])) {

  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $name = trim($name);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $email = trim($email);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $password = trim($password);
  $valid_form = true;

  $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

  // block sql injection / clean data from user
  $email = mysqli_real_escape_string($link, $email);
  $password = mysqli_real_escape_string($link, $password);
  $name = mysqli_real_escape_string($link, $name);
  $email = mysqli_real_escape_string($link, $email);
  $password = mysqli_real_escape_string($link, $password);

  if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {
    $errors['name'] = '* Name is required for 2-70 chars';
    $valid_form = false;
  }

  if (!$email) {
    $errors['email'] = '* A valid email is required';
    $valid_form = false;
  } elseif (email_exist($link, $email)) {
    $errors['email'] = '* Email is taken';
    $valid_form = false;
  }

  if (!$password || mb_strlen($password) < 6 || mb_strlen($password) > 20) {
    $errors['password'] = '* Password is required for 6-20 chars';
    $valid_form = false;
  }

  if ($valid_form) {


    $sql = "INSERT INTO users VALUES(null, '$name', '$email', '$password')";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_affected_rows($link)) {

      $_SESSION['user_name'] = $name;
      $_SESSION['user_id'] = mysqli_insert_id($link);
      header('location: blog.php');
    }
  }
}



?>

<?php get_header(); ?>

<main class="mh-900">
    <div class="container">
        <section id="signin-to-digg">
            <div class="row">
                <div class="col-12 mt-5">
                    <h1 class="display-4">Here you can open new account for free!</h1>
                    <p>Have an account <a href="signin.php">Sign In</a></p>
                </div>
            </div>
        </section>
        <section id="signup-form-content">
            <div class="row">
                <div class="col-lg-6">
                    <form id="signup-form" action="" method="POST" novalidate="novalidate">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>">
                            <span class="text-danger"><?= $errors['name']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= old('email'); ?>">
                            <span class="text-danger"><?= $errors['email']; ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="text-danger"><?= $errors['password']; ?></span>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>