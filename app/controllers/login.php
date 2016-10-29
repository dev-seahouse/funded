<?php
// include("	../data/DbConnection.php");
// try {
// $pdo = DbConnection::getInstance();
// $sql = "INSERT into user (user_name,password,first_name,last_name,email) 
// VALUES ("test", "110110", "kenan" , "xin", "xinkenan.11@hotmail.com");"
// }catch(Exception $e){
// 	echo $e.getMessage();
// }
  session_start();

  //Try to connect to database 
  require_once(__DIR__."/../objects/pdo.php");
  require_once(__DIR__."/../objects/client.php");
  try{
    $client = Client::getClient($_POST['username'],$_POST['password']);
    
    //set sesssions
    $_SESSION['uid'] = $client['id'];
    $_SESSION['user_name'] = $client['user_name'];
    echo "success";
  } catch (Exception $e) {
    //Give error message
    echo "not success";
  }
