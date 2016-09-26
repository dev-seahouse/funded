<?php
const SUCCESS = 1;
const DUPLICATE = 0;
const EXCEPTION = -2;
const ERR_EXECUTION = -1;
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST) {

	$user_name = trim(filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING));

	// todo: password should be stored as hash
	$password = trim(filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));

	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));

	$first_name = trim(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));

	$last_name = trim(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));

	// todo: check for empty strings for each variable
	//
	try {
		
		// there is always problem with the require "../_config/config.php"
		// include "../data/DbConnection.php";

		// get instance of db connection
		require_once(__DIR__.'/../objects/pdo.php');
		$conn = PDOConn::getPDO();

		// check whether user name or email exist
		$sql = "SELECT * FROM user
		WHERE user_name = ? OR email=?";

		$stmt = $conn->prepare($sql);
		$stmt->bindParam(1, $user_name, PDO::PARAM_STR);
		$stmt->bindParam(2, $email, PDO::PARAM_STR);

		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count != 0) {
			echo DUPLICATE;
			exit();
		} else {
			$sql = "INSERT INTO user (user_name,password,first_name,last_name,email)
VALUES (?, ?, ?, ? , ?);";

			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $user_name, PDO::PARAM_STR);
			$stmt->bindParam(2, $password, PDO::PARAM_STR);
			$stmt->bindParam(3, $first_name, PDO::PARAM_STR);
			$stmt->bindParam(4, $last_name, PDO::PARAM_STR);
			$stmt->bindParam(5, $email, PDO::PARAM_STR);

			if ($stmt->execute()) {
				// if sucess, echo sucess code
				// start session
				require "../objects/client.php";
				$clientFact = new Client($conn);
				$client = &$clientFact->getClient($user_name,$password);
				$_SESSION['client'] = $client;
				echo SUCCESS;
			} else {
				echo ERR_EXECUTION;
			}
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
