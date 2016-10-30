<?php
require_once(dirname(__DIR__)."/_config/autoloader.php");

class Project
{
	private $id;
	private $title;
	  private $start_date;
	  private $end_date;
	  private $created_on;
	  private $pledge_goal;
	  private $status;
	  private $sum_pledged;
	  private $category;
	  private $backer_count;
	  private $like_count;
	  private $creator_id;
	  private $country;
	  private $web_link;
	  private $email;
	  private $video_link;
	  private $overview;
	  private $view_count;
	  private $img_s;
	  private $img_l;
	  private $pitch;
	  private $featured;
	  private $challenges;

	  private $fields;



	function __construct($data = null)
	{
		$this->fields = array();
		 
		if(is_array($data)) {
			foreach ($data as $key => $value) {
					$this->fields[$key] = $value;
				}
		}


	}

	public function getFields() {
		return $this->fields;
	}

}