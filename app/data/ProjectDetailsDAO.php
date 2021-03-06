<?php

/**
*
*/
class ProjectDetailsDAO extends ProjectDAO
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

	function getProjectById($id) {
		$sql = "SELECT p.id AS project_id, title,overview,img_l,backer_count,pledge_goal,suml_pledged,DATEDIFF(end_date,CURDATE()) 
			AS days_to_go, u.user_name,u.id
		 	FROM project p, project_status s, user u 
		 	WHERE p.status = s.id AND p.id = {$id} AND p.creator_id = u.id";
		 
		
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(":id", $id);

		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getProjectTagsById($id) {
		$sql = "SELECT t.name
		 FROM project p, tag t, project_tag pt WHERE p.id={$id} and p.id=pt.project_id and t.id=pt.tag_id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function getUserById($id) {
		$sql = "SELECT user_name,first_name, last_name, user_descriptn, profile_pic, about_me, email, facebook_id, twitter_id, last_login
		 FROM  user  WHERE id = $id";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	function isBackedByUser($projectId, $userId) {
		$query = "SELECT * 
		FROM project p 
		WHERE p.id = {$projectId} AND p.id IN 
		(SELECT bp.project_id FROM backer_project bp
		WHERE bp.backer_id = {$userId})
		";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function getBackAmount($userId, $projectId) {
		$query = "SELECT amount_pledged FROM backer_project WHERE backer_id = {$userId} AND project_id = {$projectId}";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$amount = $stmt->fetch();
		return $amount['amount_pledged'];
	}




}
