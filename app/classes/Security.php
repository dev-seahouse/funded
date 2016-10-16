<?php

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
}