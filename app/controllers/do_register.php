<?php
require_once("../_config/autoloader.php");
require_once ("../inc/utility.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
  $reg = new Register();
  $output = $reg->register();
  header('Content-type: application/json');
  echo $output->toJson();
} else {
  header('HTTP/1.0 403 Forbidden');
  include dirname(__DIR__)."/404.php";
}

/*
 * client :
 * if registration is sucessful,
 * refresh page = > trigger do login
 */


