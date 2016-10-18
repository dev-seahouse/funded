<?php
require_once("../_config/autoloader.php");

class Login {
  private $output;

  public function __construct() {
    $this->output = new Message();
  }
  // this class contains many early return points, bad
  // but necessary
  public function login($role = User::BACKER_ROLE) {
    $user_name = (filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING));
    $password = (filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));
    $data = compact("user_name", "password");
    if($this->isEmpty($data)) {
      $this->output->putErr("Bad input");
      return $this->output;
    }
    // try to retrieve user from database
    $user_dao = new UserDAO();
    $user = $user_dao->getUserByNameOrEmail($user_name);
    if (!$user) {
      // user does not exist
      $this->output->putErr("Did you forget your login name or password?");
      return $this->output;
    }
    echo($user);
    return $this->output;
  }

  private function isEmpty($data) {
    /* ======================
   "" (an empty string),0,0.0,"0",NULL,FALSE
   array() (an empty array)
   $var; (a variable declared, but without a value)
  ========================*/
    foreach ($data as $row => $val) {
      if (empty($val)) return false;
    }
    return true;
  }


}