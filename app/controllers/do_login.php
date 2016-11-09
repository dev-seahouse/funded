<?php
require_once dirname(__DIR__)."/_config/autoloader.php";
$sec = new Security();
$sec->sec_session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
  $login = new Authentication();
  if(isset($_POST['admin'])) {
  	$output = $login->login(2);	
  } else {
  	$output = $login->login();
  }
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