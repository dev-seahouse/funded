<?php
abstract class BaseDAO {
    private $con;
    private $p_k;
    private $table_name;
    private $DVO_name;

    public function __construct() {
        $this->con = DbConnection::getInstance()->getConnection();
    }
    // return false on failure, single User object on success
    public function fetch($id){
        $sql = 'SELECT * 
                FROM  {$this->table_name} 
                WHERE {$this->primary_key} = :id';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject($this->DVO_name);
    }

    // return array of User object on success, false on failure
    public function find($key, $value) {
        $sql =  'SELECT * 
                FROM  {$this->table_name} 
                WHERE :key = :value';
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':key',$key);
        $stmt->bindParam(':id',$value);
        return $stmt->fetchAll(PDO::FETCH_CLASS,$this->DVO_name);
    }

    public function update($arr_key_val) {
        $sql = 'update {$this->table_name} set  ';
        $update_items[] = array();
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
        return ($stmt->rowCount()) ? "Update sucess" : "Update failed";
    }
}