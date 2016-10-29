<?php

/**
* 
*/
class ProjectDAO extends BaseDAO
{
	private $conn;
  	protected $p_k;
  	protected $table_name;
  	protected $DVO_name;
  	private $output;
  	
	function __construct()
	{
		BaseDAO::__construct();
		$this->p_k = "id";
		$this->table_name = "project";
		$this->DVO_name = "Project";
		$this->conn = $this->get_connection();
		$this->output = new Message();
	}

	/**
	* $requests in the form of column => value pair.
	* $fields in the form of array(column, column, ..)
	*/

	function getProject($requests, $fields) {
		$sql = "SELECT ".implode(",", $fields)."
		FROM {$this->table_name} 
		WHERE ";
		for ($counter=0 ; $counter < count($requests); $counter++) { 
			$sql .= ($counter === (count($requests)-1)) ? "? = ?" : "? = ? ,";
		}
		$stmt = $this->conn->prepare($sql);
		$counter = 1;
		foreach ($requests as $key => $value) {
				$stmt->bindValue($counter++, $key);
				$stmt->bindValue($counter++, $value);
		}

		return $stmt->fetchAll();
	}


	function createProject(Project $project) {
		try {
			$keys = $this->getKeys($project);
			$values = $this->getValues($project);
			$placeholder = $this->makePlaceHolders($keys);
			$placeholder_value_pairs = array_combine($placeholder, $values);

			$sql = 
			"INSERT INTO {$this->table_name} ("
			.implode(', ', $keys)
			.") VALUES ("
			.implode(', ', $placeholder)
			.")";


			$stmt = $this->conn->prepare($sql);
			$this->bindValues($stmt, $placeholder_value_pairs);

			//handle errors
			if(!($stmt->execute())) {
				$this->output->putFailure("Projects cannot be created.");
			}
			$this->output->putinfo("Sueccess");
			return $this->output;

		} catch (PDOException $pdoe) {
			throw new DatabaseException("Projects cannot be created.");
		}
	}


	private function bindValues(PDOStatement $stmt, $placeholder_value_pairs) {
    foreach ($placeholder_value_pairs as $place_holder => $value) {
      $stmt->bindValue($place_holder, $value);
    }
  }

  	private function makePlaceHolders($field_list) {
    $place_holders = array();
   
    foreach ($field_list as $item) {
      $place_holders[] = ":{$item}";
    }
    return $place_holders;
  }



	private function getKeys($project) {
		return array_keys($project->getFields());
	}

	private function getValues($project) {
		return array_values($project->getFields());
	}

}