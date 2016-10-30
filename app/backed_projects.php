<?php
/* Page specific variables */
$pageTitle = "Backed Project";
$currentPage = "backed_projects";

?>
<?php include_once __DIR__."/inc/security.php";?>
<html class="no-js" lang="">
  <?php include_once __DIR__."/inc/head.php";?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once __DIR__."/inc/header.php";?>
<?php 
if(!isset($_SESSION['user_id'])){
    echo "<script type='text/javascript'>
    window.location = 'index.php';
    </script>";
}

$user_id = $_SESSION['user_id'];

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
<!-- Google Analytics -->
  <?php require('./inc/analytics.php'); ?>
  <!-- Javascript builds -->
  <?php require('./inc/tail.php'); ?>
</body>
</html>



\





