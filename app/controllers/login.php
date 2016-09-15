<?php
include("../data/DbConnection.php");
try {
$pdo = DbConnection::getInstance();
$sql = "INSERT into user (user_name,password,first_name,last_name,email) 
VALUES ("test", "110110", "kenan" , "xin", "xinkenan.11@hotmail.com");"
}catch(Exception $e){
	echo $e.getMessage();
}