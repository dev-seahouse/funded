<?php
include_once dirname(__DIR__)."/_config/autoloader.php";
require_once dirname(__DIR__)."/models/User.php";

class UserDAO extends BaseDAO {
  private $conn;
  protected $p_k;
  protected $table_name;
  protected $DVO_name;

  public function __construct($p_key = "id", $table_name = "user", $dvo = "User") {
    BaseDAO::__construct();
    $this->p_k = $p_key;
    $this->table_name = $table_name;
    $this->DVO_name = $dvo;
    $this->conn = $this->get_connection();
  }

  public function getUserById($uid, $role_id = 1,
                              $fields =array("user.*", "role.id as role_id'")){

    try{
      $sql = "SELECT ".implode(",", $fields).
             " FROM user, role, user_role 
              WHERE user.id = user_role.user_id
              AND role.id = user_role.role_id
              AND role.id = :role_id
              AND user.id = :user_id";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":role_id", $role_id,PDO::PARAM_INT);
      $stmt->bindParam(":user_id", $uid, PDO::PARAM_INT);

      if (!$stmt->execute()) throw new DatabaseException();

      return $stmt->fetchObject($this->DVO_name);
    }catch (PDOException $pdoe) {
      debug_to_terminal($pdoe->getMessage());
      throw new DatabaseException();
    }
  }

  // admin and user have different login page, admin use role_id =2,
  // default to user = 1 if nothing passed in
  // follow pdo behaviour, return object if sucess, false if failed.
  public function getUserByNameOrEmail($name, $role_id = 1, $field_list = "*") {
    try {
      $sql = " SELECT COUNT(*) FROM user, role, user_role
                WHERE (user.user_name=:uname OR user.email=:uname) 
                AND user.id = user_role.user_id
                AND role.id = user_role.role_id
                AND role.id = :role_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":uname", $name);
      $stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
      if (!($stmt->execute())) throw new DatabaseException();
      if (($count = $stmt->fetchColumn()) != 1) {
        debug_to_terminal("Something is wrong. getUserByNameOREmail did not return 1 result but " . $count, LOG_WARNING);
        return false;
      }
      // only if exist then fetch data. 2 queryes are needed because
      // For most databases, PDOStatement::rowCount() does not return the number of rows affected by a SELECT statement.
      $sql = "SELECT user.*, role.id as 'role_id' 
                FROM user, role, user_role 
                WHERE (user.user_name=:uname OR user.email=:uname)
                AND user.id = user_role.user_id
                AND role.id = user_role.role_id
                AND role.id = :role_id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":uname", $name);
      $stmt->bindParam(":role_id", $role_id);

      if (!($stmt->execute())) throw new DatabaseException();
      //return false on failure, object on success
      return $stmt->fetchObject($this->DVO_name);

    } catch (PDOException $pdoe) {
      debug_to_terminal($pdoe->getMessage());
      throw new DatabaseException();
    }
  }

  public function create(User $user) {
    if ($this->isUserExist($user)) {
      throw new DuplicateUserException("The Username or Email has already been taken.");
    }

    $field_list = array("user_name", "password", "first_name", "last_name", "email");
    $values = array(
        $user->getUserName(),
        $user->getPassword(),
        $user->getFname(),
        $user->getLname(),
        $user->getEmail()
    );

    $place_holders = $this->makePlaceHolders($field_list);
    $placeholder_value_pairs = array_combine($place_holders, $values);
    try {
      $sql = "INSERT INTO {$this->table_name}" .
          "(" . implode(',', $field_list) . ")" .
          "VALUES (" . implode(',', $place_holders) . ")";

      $stmt = $this->conn->prepare($sql);
      $this->bindValues($stmt, $placeholder_value_pairs);
      if (!($stmt->execute())) {
        throw new DatabaseException("Sorry, we cannot create an account for you due to technical complexity.");
      }

      $inserted_uid = $this->conn->lastInsertId();
      $sql = "INSERT INTO user_role 
                        (user_id, role_id) 
                        VALUES (:uid, :rid)";

      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(":uid", $inserted_uid, PDO::PARAM_INT);
      $stmt->bindValue(":rid", $user->getRoleId(), PDO::PARAM_INT);

      if (!($stmt->execute())) {
        throw new DatabaseException("Sorry, we cannot create an account for you due to technical difficulty.");
      }

    } catch (PDOException $pdeo) {
      // such information should be defined on client
      // but how would client know error type?
      // we can use error codes, but for now, it is convinient to just define from server exceptions
      throw new DatabaseException("Sorry, we cannot create an account for you due to technical difficulty.");
    }
  }


  private function isUserExist(User $user) {
    $uname = $user->getUserName();
    $email = $user->getEmail();
    $sql = "SELECT COUNT(*)
                FROM {$this->table_name} 
                WHERE user_name = :uname OR email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':uname', $uname);
    $stmt->bindParam(':email', $email);
    // return false on failure
    $stmt->execute();
    return ($stmt->fetchColumn() > 0);
  }

  private function makePlaceHolders($field_list) {
    $place_holders = array();
    foreach ($field_list as $item) {
      $place_holders[] = ":{$item}";
    }
    return $place_holders;
  }

  private function bindValues(PDOStatement $stmt, $placeholder_value_pairs) {
    foreach ($placeholder_value_pairs as $place_holder => $value) {
      $stmt->bindValue($place_holder, $value);
    }
  }
}


