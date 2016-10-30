<?php 
$pageTitle = "Funded Project";
require_once dirname(__DIR__)."/_config/autoloader.php";
//include_once dirname(__DIR__)."/inc/header.php";
?>

<?php 
//$user_id = $_SESSION['user_id'];
//having trouble retrieving session info
$user_id = 3;

$projectDAO = new ProjectDAO();
 
// query products
$fields =array("project.id as id, project.title as project", "project.overview as description", "project.category", "backer_project.amount_pledged as amount");
$stmt = $projectDAO->getProjectByBacker($user_id, $fields);
$num = $stmt->rowCount();
 
// display the projects backed by the user
if($num>0){
    echo "<table align = 'center' border = '1' class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Project</th>";
            echo "<th>Description</th>";
            echo "<th>Category</th>";
            echo "<th>Amount Pledged</th>";
            echo "<th></th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$project}</td>";
                echo "<td>{$description}</td>";
                echo "<td>{$category}</td>";
                echo "<td>{$amount}</td>";		 
                echo "<td>";
				    // view project button
                	//link to be inserted after implementing read projects
				    echo "<a href='' class='btn btn-primary left-margin'>";
				        echo "<span class='glyphicon glyphicon-list'></span> More Details";
				    echo "</a>";
				 
				    
				echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
}
 
// tell the user there are no projects funded
else{
    echo "<div>No projects funded.</div>";
}
?>


\





