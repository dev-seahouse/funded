<?php
require_once("../_config/autoloader.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
  $login = new Login();
  $output = $login->login();
  header('Content-type: application/json');
  echo $output->toJson();
} else {
  header('HTTP/1.0 403 Forbidden');
  include dirname(__DIR__)."/404.php";
}
// ===== old ======
/*
try{
$pdo = DbConnection::getInstance();

$sql = 'INSERT into user (user_name,password,first_name,last_name,email) 
VALUES ("test", "110110", "kenan" , "xin", "xinkenan.11@hotmail.com");';

}catch(Exception $e){
    echo $e.getMessage();
}*/
// ===== old ======