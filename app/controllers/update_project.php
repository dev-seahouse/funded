<?php

include_once dirname(__DIR__)."/_config/config.php";
include_once dirname(__DIR__)."/_config/autoloader.php";


// check if value was posted
if($_POST){


$projectDAO= new ProjectDAO();


if(isset($_POST['projectId'])){
  $projectId = $_POST['projectId'];
} else {
  echo "Project not found";
}

if(isset($_POST['likecount'])) {
  echo $projectId." ".$_POST['likecount'];
  $projectDAO->updateLikeCount($projectId, $_POST['likecount']);
}

}

?>
