<?php

// author: xin kenan
// org: dev-seahouse

// object independent generic crud
abstract class BaseDAO {
    private $con;
    protected $p_k;
    protected $table_name;
    protected $DVO_name;

    public function __construct() {
        $this->con = DbConnection::getInstance()->getConnection();
    }

    public function get_connection(){
        return $this->con;
    }

    // return false on failure, single object on success
    public function fetch($id, $fields = "*"){
        $sql =   "SELECT ".implode(",",$fields)."
                FROM  {$this->table_name} 
                WHERE {$this->primary_key} = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject($this->DVO_name);
    }

    // return array of User object on success, false on failure
    public function find($key, $value, $fields) {
        $sql =  "SELECT ". implode(",",$fields)."
                FROM  {$this->table_name} 
                WHERE :key = :value";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':key',$key);
        $stmt->bindParam(':value',$value);
        return $stmt->fetchAll(PDO::FETCH_CLASS,$this->DVO_name);
    }


    public function update($arr_key_val) {
        $sql = "update {$this->table_name} set  ";
        for ($counter = 0, $counter_max = count($arr_key_val); $counter < $counter_max ; $counter++){
            $sql .= ($counter === $counter_max-1) ? "?  = ? " : "? = ? ," ;
        }
        $sql .=" where {$this->p_k} = '{$arr_key_val[$this->p_k]}";
        $stmt = $this->con->prepare($sql);
        $counter = 1 ;
        foreach ($arr_key_val as $col => $val){
            $stmt->bindValue($counter++,$col);
            $stmt->bindParam($counter++,$val);
        }
        $stmt->execute();
        return ($stmt->rowCount());//  ? "Update sucess" : "Update failed";
    }



        // TBD
    /*    public function count($key,$value, $fields = "*"){
            $sql = "SELECT ";

            if (!empty($fields) && is_array($fields)){
                $sql.= implode(", ", $fields);
             } else{
                 $sql.= $fields;
            }

            $sql .="FROM {$this->table_name}
                   WHERE :key = :value";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':key', $key);
            $stmt->bindParam(':value',$value);
            $stmt->execute();
            return $stmt->rowCount();
        }*/
}