<?php

session_start();
require_once 'app/helpers.php';
$page_title = 'Blog Page';
/* $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
$sql = "SELECT u.name,p.* FROM posts p 
        JOIN users u ON p.user_id = u.id 
        ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);
$post = mysqli_fetch_assoc($result);
dd($post); */

?>

<?php get_header(); ?>

<main class="mh-900">
    <div class="container">
        <section id="blog-digg-content">
            <div class="row">
                <div class="col-12 mt-5">
                    <h1 class="display-4">Write your digg!</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <?php if (isset($_SESSION['user_id'])) : ?>
                    <p><a class="btn btn-primary" href="add_post.php">+ Add New Post</a></p>
                    <?php else : ?>
                    <p><a href="signup.php">Create free account and start digg</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <section id="the-posts">
        </section>
    </div>
</main>

<?php get_footer(); ?>