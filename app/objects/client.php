<?php
class Client{
	private $conn;
	private $client;
	public function __construct($db) {
		$this->conn = $db;
	}

	public function &getClient($userName, $password){
		$query = "SELECT * from user WHERE user_name= ? AND password = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->execute([$userName, $password]);

		$this->client = $stmt->fetch(PDO::FETCH_ASSOC);

		return $this->client;
	}

}