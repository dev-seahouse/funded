<?php

/**
* 
*/
class CategoryDAO extends BaseDAO
{
	
	function __construct()
	{
		BaseDAO::__construct();
		$this->p_k = "id";
		$this->table_name = "category";
		$this->DVO_name = "Category";
		$this->conn = $this->get_connection();
	}

	public static function getCategories($conn) {
	$sql = 'SELECT name from category';
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	return $stmt->fetchAll();
	}
}