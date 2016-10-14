<?php

/**
 * Created by PhpStorm.
 * User: xinke
 * Date: 10/14/2016
 * Time: 2:06 PM
 */
//require("../data/DbConnection.php");
//require("../classes/User.php");
require_once("../_config/autoloader.php");

Class RegisterUser{
    private $db_connection = null;
    public $messages = array();
    public $errors = array();

    public function __construct(){
         $this->db_connection = DbConnection::getInstance()->getConnection();
    }

    private function create($user){
        
    }

    /**
     * @return bool
     */
    private function is_create_new_request()
    {
        return (isset($_POST["register_new"]));
    }

    /**
     * @return bool
     */
    private function is_post_request()
    {
        return ($_SERVER["REQUEST_METHOD"] == "POST");
    }


}
