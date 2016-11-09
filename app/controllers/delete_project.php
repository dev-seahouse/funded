<?php

include_once dirname(__DIR__)."/_config/config.php";
include_once dirname(__DIR__)."/_config/autoloader.php";
// check if value was posted
if($_POST){


$projectDAO= new ProjectDAO();

// set product id to be deleted

if(isset($_POST['projectId'])){
        $projectId = $_POST['project'];

      } else {
        echo "Project not found";
}    
    // delete the project
    if($projectDAO->deleteProject($projectId)){
        //echo "Project was cancelled.";
        header('Location: ../manage_projects.php');
    }
     
    // if unable to delete the product
    else{
        echo "Unable to cancel project.";       
    }
}
?>