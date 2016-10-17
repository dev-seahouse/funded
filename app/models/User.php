<?php
require_once("../_config/autoloader.php");

class User {
    private $user_name;
    private $email;
    private $password;
    private $fname;
    private $lname;
    private $role_id;

    const BACKER_ROLE = 1;
    const ADMIN_ROLE = 2;

    public function __construct($data = null) {
        if (is_array($data)) {

            if (isset($data['id'])) $this->id = $data['id'];
            if (isset($data['role_id'])) $this->role_id = $data['role_id'];

            $this->user_name = $data['user_name'];
            $this->fname = $data['first_name'];
            $this->lname = $data['last_name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
        }
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getFname() {
        return $this->fname;
    }

    public function setFname($fname) {
        $this->fname = $fname;
        return $this;
    }

    public function getLname() {
        return $this->lname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
        return $this;
    }

    public function getRoleId() {
        return $this->role_id;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
        return $this;
    }
}