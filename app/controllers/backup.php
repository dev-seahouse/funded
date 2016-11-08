<?php
require_once dirname(__DIR__)."/_config/autoloader.php";

$projectDAO= new ProjectDAO();
$message = new Message();

if(isset($_POST)){
	if(isset($_POST['backerId'])){
   		$backerId= $_POST['backerId'];
		$projectId = $_POST['projectId'];
    	$backAmount = $_POST['backAmount'];

    	var_dump($_POST);

    try {
        $output = $projectDAO->backProject($projectId, $backerId, $backAmount); 
        header('Content-type: application/json');
        echo $output->toJson();
    } catch (DatabaseException $dea) {
        header('HTTP/1.0 403 Forbidden');
    }
	} else {
		$message->putFailure("Please log in first");
		$message->setCode(Message::LOGIN_REQUIRED);
		header('Content-type: application/json');
		echo $message->toJson();
	}
}