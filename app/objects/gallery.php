<?php
class Gallery {
	private $conn;
	private $tableName;
	private $name;

	public function __construct($dbConn) {
		$this->conn = $dbConn;
		$tableName = "project";
	}

	/**
	* Get the statement and iterate through each row to 
	* generate project card
	*/
	public function prepare(){
		$query = "SELECT title, pledge_goal, end_date, suml_pledged FROM project WHERE status = 3";
		$stmt = $this->conn->query($query);

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<div class='gallery-project'>";
			foreach ($row as $key => $value) {
				echo '<p>'
				. $key
				. ' is '
				. $value
				. '</p>' ;
			}
			echo '</div>';
		}
	}
}