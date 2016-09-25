<?php
class Category {
	
	private $conn;
	private $tableName;
	private $name;

	public function __construct($dbConn){
		$this->conn = $dbConn;
		$tableName = "category";
	}

	public function getCategories(){
		$query = 'SELECT name from category';
		$stmt = $this->conn->query($query);
		
		foreach ($stmt as $row) {
			echo $row['name'];
			echo '<option name="' 
				. $row['name']
				. '"/>'
				. $row['name']
				. '</option>';
		}
	}
}