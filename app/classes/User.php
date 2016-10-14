<?php
require_once("../_config/autoloader.php");
class User {
    private $name;
    private $email;
    private $password;
    private $fname;
    private $lname;
    private $conn;

    public function __construct($name, $email, $password, $fname, $lname) {
        $this->conn = null;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->fname = $fname;
        $this->lname = $lname;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }
}