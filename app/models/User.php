<?php
require_once(dirname(__DIR__)."/_config/autoloader.php");

class User {
  private $user_name;
  private $email;
  private $password;
  private $first_name;
  private $last_name;
  private $role_id;
  private $last_login;
  private $id;

  const BACKER_ROLE = 1;
  const ADMIN_ROLE = 2;

  public function __construct($data = null) {
    if (is_array($data)) {

      if (isset($data['id'])) $this->id = $data['id'];
      if (isset($data['role_id'])) $this->role_id = $data['role_id'];

      $this->user_name = $data['user_name'];
      $this->first_name = $data['first_name'];
      $this->last_name = $data['last_name'];
      $this->email = $data['email'];
      $this->password = $data['password'];
    }
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }
  
  public function getLastLogin() {
    return $this->last_login;
  }

  public function setLastLogin($newDate){
    $this->last_login = $newDate;
    return $this;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
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

  public function getFirstname() {
    return $this->first_name;
  }

  public function setFirstname($first_name) {
    $this->first_name = $first_name;
    return $this;
  }

  public function getLastname() {
    return $this->last_name;
  }

  public function setLastname($last_name) {
    $this->last_name = $last_name;
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