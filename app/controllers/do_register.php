<?php

class Register {
    
    const SUCCESS = 1;
    const DUPLICATE = 0;
    const EXCEPTION = -2;
    const ERR_EXECUTION = -1;
    const BACKER_ROLE = 1;
    const ADMIN_ROLE = 2;

    private function register($role = BACKER_ROLE) {
        require_once("../_config/autoloader.php");
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST) {
            $user_name = trim(filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING));
            // TODO: password should be stored as hash
            $password = trim(filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));
            $email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
            $first_name = trim(filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));
            $last_name = trim(filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));
            $role_id = $role;

            $variable_names = array("user_name", "first_name", "last_name", "email", "password", "role_id");
            $data = compact($variable_names);
            $new_user = new User($data);

            $dao = new UserDAO();
            $is_success = ($dao->create($new_user));
        }
    }
}

