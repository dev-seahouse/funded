<?php
require dirname(__DIR__)."/inc/utility.php";
require_once("../_config/autoloader.php");

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

    public function create(User $user) {

        if ($this->isUserExit($user)) {
            throw new DuplicateUserException("The Username or Email has already been taken.");
        }

        $field_list = array("user_name", "password", "first_name","last_name","email");
        $values = array(
            $user->getUserName(),
            $user->getPassword(),
            $user->getFname(),
            $user->getLname(),
            $user->getEmail()
        );

        $place_holders = $this->makePlaceHolders($field_list);
        $placeholder_value_pairs = array_combine($place_holders,$values);

        $sql = "INSERT INTO {$this->table_name}" .
                "(".implode(',',$field_list).")" .
                "VALUES (".implode(',',$place_holders).")";

        $stmt = $this->conn->prepare($sql);
        $this->bindValues($stmt, $placeholder_value_pairs);
        $isQuerySuccess = $stmt->execute();

        if($isQuerySuccess){
            $inserted_uid = $this->conn->lastInsertId();
            $sql = "INSERT INTO user_role 
                    (user_id, role_id) 
                    VALUES (:uid, :rid)";
        }else{
            echo "error inserting user";
            return false;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":uid",$inserted_uid ,PDO::PARAM_INT);
        $stmt->bindValue(":rid",$user->getRoleId(), PDO::PARAM_INT);

        $isQuerySuccess = $stmt->execute();

        if ($isQuerySuccess) {
            echo SUCCESS;
            return true;
        } else {
            echo ERR_EXECUTION;
            return false;
        }
    }

    private function isUserExit(User $user) {
        $uname = $user->getUserName();
        $email = $user->getEmail();
        $sql = "SELECT COUNT(*)
                FROM {$this->table_name} 
                WHERE user_name = :uname OR email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':email', $email);
        $stmt->execute(); // return false on failure
        return ($stmt->fetchColumn() > 0);
    }

    private static function makePlaceHolders($field_list) {
        $place_holders= array();
        foreach ($field_list as $item){
           $place_holders[] = ":{$item}";
        }
        return $place_holders;
    }

    private function bindValues(PDOStatement $stmt, $placeholder_value_pairs) {
        foreach ($placeholder_value_pairs as $place_holder => $value){
            $stmt->bindValue($place_holder,$value);
        }
    }
}


