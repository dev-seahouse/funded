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

	function getProject($requests, $fields, $table = "project") {
		$sql = "SELECT ".implode(",", $fields)."
		FROM {$table} 
		WHERE ";

		$keys = array_keys($requests);
		$values = array_values($requests);
		$placeholder = $this->makePlaceHolders($keys);
		$placeholder_value_pairs = array_combine($placeholder, $values);
		

		for ($counter=0 ; $counter < count($requests); $counter++) { 
			$sql .= ($counter === (count($requests)-1)) ? "{$keys[$counter]} = {$placeholder[$counter]}" : "{$keys[$counter]} = {$placeholder[$counter]},";
		}
		
		$stmt = $this->conn->prepare($sql);
		$this->bindValues($stmt, $placeholder_value_pairs);

		if(!$stmt->execute()){
			echo "failure";
		}

		return $stmt->fetchAll();
	}

	function getProjectByBacker($backer_id, $fields) {
		$query = "SELECT ".implode(",", $fields)."
				 FROM project, backer_project
           		 WHERE backer_project.backer_id = :backer_id
				 AND project.id = backer_project.project_id";
 
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(":backer_id", $backer_id);


	    $stmt->execute();
	 
	    return $stmt;
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

	//assume only one key word for now
	public function search($keywords) {

		$sql = "SELECT * FROM {$this->table_name} WHERE title LIKE '%{$keywords}%' OR overview LIKE '%{$keywords}%'";

		$stmt = $this->conn->query($sql);
		return $stmt->fetchAll();
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