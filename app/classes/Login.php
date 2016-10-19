<?php
require_once("../_config/autoloader.php");
require_once ("../inc/utility.php");
class Login {
  private $output;
  public function __construct() {
    $this->output = new Message();
  }
  // this class contains many early return points, bad
  // but necessary
  public function login($role = User::BACKER_ROLE) {
    $user_name = (filter_input(INPUT_POST, "login_id", FILTER_SANITIZE_STRING));
    $password = (filter_input(INPUT_POST, "login_pass", FILTER_UNSAFE_RAW));
    $data = compact("user_name", "password");

    if($this->isEmpty($data)) {
      $this->output->putFailure("Bad input");
      return $this->output;
    }
    // try to retrieve user from database
    $user_dao = new UserDAO();
    $user = $user_dao->getUserByNameOrEmail($user_name);
    if (!$user) {
      // user does not exist
      $this->output->putFailure("Did you forget your login name or password?");
      return $this->output;
    }
    
    // verify password
    if (!password_verify($password, $user->getPassword())) {
      $this->output->putFailure("Did you forget your login name or password?");
    }

    $this->setSessionData($user);
    $this->output->putinfo("Login sucessful");
    $this->output->putData(array('user_name' => $_SESSION['user_name']));
    $this->output->putData(array('user_id' => $_SESSION['user_id']));
    $this->output->putData(array('first_name' => $user->getFirstname()));
    $this->output->putData(array('profile_pic' => $user->profile_pic));

    return $this->output;
  }

  public function isUserLoggedIn(){
    if (isset($_SESSION['user_id'],
        $_SESSION['user_name'],
        $_SESSION['login_key'])) {

      $user_id = $_SESSION['user_id'];
      $login_key = $_SESSION['login_key'];
      $user_name = $_SESSION['user_name'];
      $user_browser = $_SERVER['HTTP_USER_AGENT'];


    }
  }

  private function isEmpty($data) {
    /* ======================
   "" (an empty string),0,0.0,"0",NULL,FALSE
   array() (an empty array)
   $var; (a variable declared, but without a value)
  ========================*/
    foreach ($data as $row => $val) {
      if (empty($val)) return true;
    }
    return false;
  }

  /**
   * @param $user
   */
  private function setSessionData($user) {
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    // XSS protection
    $user_name = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user->getUserName());
    $user_id = preg_replace("/[^0-9]+/", "", $user->getId());
    // set session variable
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['login_key'] = hash('sha512', $user->getPassword(), $user_browser);
  }
}