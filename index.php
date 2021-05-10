<?php 

session_start();
require_once 'app/helpers.php';
$page_title = 'Home Page';

?>

<?php get_header(); ?>

<main class="mh-900">
  <div class="container">
    <section id="join-us">
      <div class="row">
        <div class="col-12 text-center mt-5">
          <h1 class="display-4">Welcome to digg site!</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, saepe?</p>
          <p class="mt-2">
            <a class="btn btn-outline-warning btn-lg" href="signup.php">Join Us and Start Digg</a>
          </p>
        </div>
      </div>
    </section>
    <section id="about-digg">
      <div class="row">
        <div class="col-12 mt-5">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium suscipit nulla assumenda placeat
            vitae officiis nisi officia voluptatem unde repudiandae.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium suscipit nulla assumenda placeat
            vitae officiis nisi officia voluptatem unde repudiandae.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium suscipit nulla assumenda placeat
            vitae officiis nisi officia voluptatem unde repudiandae.</p>
        </div>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>