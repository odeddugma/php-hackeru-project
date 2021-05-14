<?php

session_start();
require_once 'app/helpers.php';
$page_title = 'Blog Page';
$link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);
$sql = "SELECT u.name, p.* FROM posts AS p 
        JOIN users AS u ON p.user_id = u.id 
        ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);
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
        <?php if ($result && mysqli_num_rows($result)) : ?>
        <section id="the-posts">
            <div class="row">
                <?php while ($post = mysqli_fetch_assoc($result)) : ?>
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header">
                            <span><?= htmlentities($post['name']); ?></span>
                            <span class="float-end"><?= date('d/m/Y H:m:s', strtotime($post['date'])); ?></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlentities($post['title']); ?></h5>
                            <p class="card-text"><?= str_replace("\n", '<br>', htmlentities($post['article'])); ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>