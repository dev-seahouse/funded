<?php
require_once("../_config/autoloader.php");
class User {
    private $name;
    private $email;
    private $password;
    private $fname;
    private $lname;


public function __construct($data = null)
{
    if (is_array($data)) {
        if (isset($data['id'])) $this->id = $data['id'];

        $this->username = $data['username'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
    }
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