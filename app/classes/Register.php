<?php
require_once("../_config/autoloader.php");

/*
This class make use of Message class
for I/O of error/info/data
the rationale for choosing such design is to
solve the problem that client side
does not have common communication channel with server
in ajax applications.
all expected exceptions are caught in custom defined exception class with
user-oriented messages for direct display
*/

class Register {
    private $output;

    public function __construct() {
        $this->output = new Message();
    }
    // returns Message object
    public function register($role = User::BACKER_ROLE) {
            $data = $this->createUserData($role);
            if (!$this->isValidInput($data, $this->output)) return $this->output;

            $data["password"] = Security::hash($data["password"]);
            try {
                $new_user = new User($data);
                $user_db_access = new UserDAO();
                $user_db_access->create($new_user);
            } catch (DatabaseException $dbe) {
                $this->output->putFailure($dbe);
            } catch (DuplicateUserException $due) {
                $this->output->putFailure($due->getMessage());
            } catch (Exception $e) {
                $this->output->putHiddenErr($e->getMessage());
            }
          return $this->output;
    }

    private function isValidInput($data, Message $output) {
        // filter_input returns
        $isValid = true;
        foreach ($data as $row => $val) {
            if ($val === '') {
                $output->putFailure("Did you forget to fill in something?");
                $isValid = false;
            } else if ($val === null || $val === false) {
                $output->putFailure("Did you mistyped something? ");
                $isValid = false;
            }
        }
        return $isValid;
    }

    /**
     * @param $role
     * @return array
     */
    private function createUserData($role) {
        // is there anyway to do this automatically in a loop ? how to determine which filter to use...errr
        $user_name = (filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING));
        $password = (filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));
        $email = (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $first_name = (filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING));
        $last_name = (filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING));
        $role_id = $role;
        $variable_names = array("user_name", "first_name", "last_name", "email", "password", "role_id");
        $data = compact($variable_names);
        return $data; // create associative arr using variable name as keys and value of var as values
    }
}

