/**
 * Project class which represents a single project
 * It is exported to ../controllers/create_project.php
 *
 */

<?php 
class Project{
	/*************
	* Variables 
	*************/
	//TODO : It can be imporved with use of array
	private $conn;
	private $tableName = 'project';

	//Not null variables must be provided
	
	public $title;
	public $pledgeGoal;
	public $founderName;
	public $country;
	public $email;

	public $fields;


	/************
	* Functions
	************/

	public function __construct($db){
		$this->conn = $db;
		$this->fields = array(
		"title" => NULL,
		"pledge_goal" => NULL,
		"creator_id" => NULL,
		"country" => NULL,
		"email" => NULL,
		"category" => NULL,
		"overview" => NULL,
		);

		// echo var_dump($fields);
	}
	public function &getFields(){
		return $this->fields;
	}

	function create(){
		// $fields['creator_id'] = getUserID();
		// echo var_dump($this->fields);

		$query = "INSERT into " .$this->tableName ."(title, pledge_goal,creator_id, country, email,category,overview) VALUES (:title,:pledge_goal,:creator_id,:country,:email,:category,:overview)";



		$stmt = $this->conn->prepare($query);
		
		//Get posted values
		foreach ($this->fields as $key => $value) {
			$value = htmlspecialchars(strip_tags($value));
		}

		foreach ($this->fields as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}



		// $this->id = htmlspecialchars(strip_tags($this->id));
		// $this->title = htmlspecialchars(strip_tags($this->title));
		// $this->pledgeGoal = htmlspecialchars(strip_tags($this->pledgeGoal));
		// $this->founderName = htmlspecialchars(strip_tags($this->founderName));
		// $this->country = htmlspecialchars(strip_tags($this->country));
		// $this->email = htmlspecialchars(strip_tags($this->email));


		// $stmt->bindParam(1, $this->id);
  //       $stmt->bindParam(2, $this->title);
  //       $stmt->bindParam(3, $this->pledgeGoal);
  //       $stmt->bindParam(4, $this->founderName);
  //       $stmt->bindParam(5, $this->country);
  //       $stmt->bindParam(6, $this->email);

        if($stmt->execute()){
        	return true;
        } else {
        	return false;
        }
	}
}
?>