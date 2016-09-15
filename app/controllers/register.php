<?php
const SUCCESS = 1;
const DUPLICATE = 0;
const EXCEPTION = -2;
const ERR_EXECUTION = -1;
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
		// include db connection class
		include "../data/DbConnection.php";

		// get instance of db connection
		$pdo = DbConnection::getInstance();
		$conn = $pdo->getConnection();

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
				echo SUCCESS;
				// if sucess, echo sucess code
				// start session
				// echo session[last_name]
				// user js to extract from response and display
			} else {
				echo ERR_EXECUTION;
			}
		}

	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
