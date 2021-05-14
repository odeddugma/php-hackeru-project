<?php

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '');
define('MYSQL_DB', 'digg');

function dd($data, $die = true, $fn = 'print_r') // dd = dump and die
{
  echo '<pre>';
  $fn($data);
  echo '</pre>';
  if ($die) die;
  echo '<hr>';
}

function get_footer($page = 'footer')
{
  include "tpl/$page.php";
}

function get_header($page = 'header')
{
  global $page_title;
  include "tpl/$page.php";
}

function old($fn)
{
  return $_REQUEST[$fn] ?? '';
}

function email_exist($link, $email)
{

  $exist = false;
  $sql = "SELECT email FROM users WHERE email = '$email'";
  $result = mysqli_query($link, $sql);

  if ($result && mysqli_num_rows($result)) {
    $exist = true;
  }

  return $exist;
}