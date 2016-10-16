<?php
require_once("../_config/autoloader.php");

class Login{
    private $db_connection = null;
    private $errs = array();
    public $messages = array();

    public function __construct(){
        session_start();

    }
}