<?php
// include("	../data/DbConnection.php");
// try {
// $pdo = DbConnection::getInstance();
// $sql = "INSERT into user (user_name,password,first_name,last_name,email) 
// VALUES ("test", "110110", "kenan" , "xin", "xinkenan.11@hotmail.com");"
// }catch(Exception $e){
// 	echo $e.getMessage();
// }

  //Try to connect to database 
  require_once(__DIR__."/../objects/pdo.php");
  require_once(__DIR__."/../objects/client.php");
  try{
    $client = Client::getClient($_POST['username'],$_POST['password']);
    var_dump($client);
  } catch (Exception $e) {
    //Give error message
    $message = "Your username and password does not match. Please try again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
