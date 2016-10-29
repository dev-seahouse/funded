<?php
class Client{

	public static function getClient($userName, $password){
		require_once (__DIR__."/./pdo.php");
		$conn = PDOConn::getPDO();

		$query = "SELECT * from user WHERE user_name= ? AND password = ?";

		$stmt = $conn->prepare($query);
		$stmt->execute([$userName, $password]);

		$client = $stmt->fetch(PDO::FETCH_ASSOC);
		if($client == null) {
			throw new Exception("No such user exists.");
		}
		
		return $client;
	}

}