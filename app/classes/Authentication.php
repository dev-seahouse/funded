  <?php
  require_once(dirname(__DIR__)."/_config/autoloader.php");
  require_once(dirname(__DIR__)."/inc/utility.php");
  require_once(dirname(__DIR__)."/data/UserDAO.php");

  class Authentication {
    private $output;
    private $user_dao;

    public function __construct() {
      $this->output = new Message();
      $this->user_dao = new UserDAO();
    }
    // this class contains many early return points, bad
    // but necessary
    public function login($role = User::BACKER_ROLE) {
      $user_name = (filter_input(INPUT_POST, "login_id", FILTER_SANITIZE_STRING));
      $password = (filter_input(INPUT_POST, "login_pass", FILTER_UNSAFE_RAW));
      $data = compact("user_name", "password");

      if ($this->isEmpty($data)) {
        $this->output->putFailure("Bad input");
        return $this->output;
      }
      // try to retrieve user from database
      $user = $this->user_dao->getUserByNameOrEmail($user_name, $role);

      if (!$user) {
        // user does not exist
        $this->output->putFailure("Did you forget your login name or password?");
        return $this->output;
      }

      // verify password
      if (!password_verify($password, $user->getPassword())) {
        $this->output->putFailure("Did you forget your login name or password?");
        return $this->output;

      }

      $this->setSessionData($user);
      $this->output->putinfo("Login sucessful");
      $this->output->putData('user_name' , $_SESSION['user_name']);
      $this->output->putData('user_id', $_SESSION['user_id']);
      $this->output->putData('first_name', $user->getFirstname());
      $this->output->putData('last_name', $user->getLastname());
      $this->output->putData('profile_pic' , $user->profile_pic);

      return $this->output;
    }

    public function logout() {

  // Unset all session values
      $_SESSION = array();

  // get session parameters
      $params = session_get_cookie_params();

  // Delete the actual cookie.
      setcookie(session_name(),
          '', time() - 42000,
          $params["path"],
          $params["domain"],
          $params["secure"],
          $params["httponly"]);

  // Destroy session
      session_destroy();
      // header(dirname(__DIR__) . "/index.php");
    }

  //for PHP version below 5.6, which does not support hash_equals.
     private function hash_equals($str1, $str2){
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }


    public function isUserLoggedIn($role_id) {
      if (isset($_SESSION['user_id'],
          $_SESSION['user_name'],
          $_SESSION['login_key'])) {

        $user_id = $_SESSION['user_id'];
        debug_to_terminal("User id in session is ".$user_id);
        $login_key = $_SESSION['login_key'];
        debug_to_terminal("Login key in session is ".$login_key);
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $user = $this->user_dao->getUserById($user_id, $role_id,array("user.id", "user.password"));
        if (!$user) {
          debug_to_terminal("unkonwn user in session");
          return false;
        }
        $login_key_verify = hash('sha512',$user->getPassword(), $user_browser);
        error_log("User id is ". $_SESSION['user_id']);

        if ($this->hash_equals($login_key_verify,$login_key)){
          return true;
        }
        return false; // hash not equal

      }
      error_log("Session not set");
      return false; // session not set
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
      $_SESSION['last_name'] = $user->getLastname();
      $_SESSION['user_id'] = $user_id;
      $_SESSION['login_key'] = hash('sha512', $user->getPassword(), $user_browser);
    }
  }