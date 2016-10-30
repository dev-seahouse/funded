<?php
require_once dirname(__DIR__)."/_config/autoloader.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
  $reg = new Register();
  $output = $reg->register();
  header('Content-type: application/json');
  echo $output->toJson();
} else {
  header('HTTP/1.0 403 Forbidden');
}

/*
 * client :
 * if registration is sucessful,
 * refresh page = > trigger do login
 */


