<?php 
$pageTitle = "Create Project";
require_once dirname(__DIR__)."/_config/autoloader.php";


$projectDAO= new ProjectDAO();
if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST){

    $project = new Project($_POST);
    $message = new Message();

    try {
        $output = $projectDAO->createProject($project); 
        
        header('Content-type: application/json');
        echo $output->toJson();
    } catch (DatabaseException $dea) {
        header('HTTP/1.0 403 Forbidden');
    }
}
 