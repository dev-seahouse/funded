<?php
require_once(dirname(__DIR__)."/_config/autoloader.php");
include_once (dirname(__DIR__)."/_config/config.php");

class Security {
    public function sec_session_start(){
        $session_name = 'sec_session_id';   // Set a custom session name
        session_name($session_name);

        $secure = true;
        $httponly = true;
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: ". dirname(__DIR__)."/index.php");
            exit();
        }

        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            $secure,
            $httponly);

        session_start();            // Start the PHP session
        session_regenerate_id(true);    // regenerated the session, delete the old one.
    }

    public static function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
    }

    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }
}