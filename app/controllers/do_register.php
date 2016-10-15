<?php
const SUCCESS = 1;
const DUPLICATE = 0;
const EXCEPTION = -2;
const ERR_EXECUTION = -1;
const BACKER_ROLE = 1;

require_once("../_config/autoloader.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST) {
	$user_name = trim(filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING));
    // TODO: password should be stored as hash
    $password = trim(filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));
    $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
    $first_name = trim(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));
    $role_id = BACKER_ROLE;

    $variable_names = array("user_name","first_name", "last_name", "email", "password", "role_id");
    $data = compact($variable_names);
    $new_user = new User($data);

    $dao = new UserDAO();
    $is_success = ($dao->create($new_user));

 /*   if (isset($data['id'])) $this->id = $data['id'];
            if (isset($data['role_id'])) $this->role_id = $data['role_id'];

            $this->user_name = $data['user_name'];
            $this->fname = $data['first_name'];
            $this->lname = $data['last_name'];
            $this->email = $data['email'];
            $this->password = $data['password'];*/

	/*try {
		$pdo = DbConnection::getInstance();
		$conn = $pdo->getConnection();

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
	}*/
}
