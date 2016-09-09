<?php 
class Project{
	/*************
	* Variables 
	*************/

	private $conn;
	private $tableName = 'project';

	public $id;
	public $title;
	public $pledgeGoal;
	public $founderName;
	public $country;
	public $email;

	/************
	* Functions
	************/

	public function __construct($db){
		$this->conn = $db;
	}

	function create(){
		$query = "INSERT into " . $this->tableName ."(id, title, pledge_goal,founder_name, country, email) VALUES (?,?,?,?,?,?)";

		$stmt = $this->conn->prepare($query);

		//Get posted values
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->pledgeGoal = htmlspecialchars(strip_tags($this->pledgeGoal));
		$this->founderName = htmlspecialchars(strip_tags($this->founderName));
		$this->country = htmlspecialchars(strip_tags($this->country));
		$this->email = htmlspecialchars(strip_tags($this->email));


		$stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->title);
        $stmt->bindParam(3, $this->pledgeGoal);
        $stmt->bindParam(4, $this->founderName);
        $stmt->bindParam(5, $this->country);
        $stmt->bindParam(6, $this->email);

        if($stmt->execute()){
        	return true;
        } else {
        	return false;
        }
	}
}
?>