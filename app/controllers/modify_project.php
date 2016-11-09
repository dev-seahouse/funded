<?php



if(isset($_POST['projectId'])){
	include_once dirname(__DIR__)."/_config/config.php";
	include_once dirname(__DIR__)."/_config/autoloader.php";
	$projectDAO= new ProjectDAO();

	// set product id to be deleted
    $projectId = $_POST['project'];
 
    // delete the project
    if($projectDAO->deleteProject($projectId)){
        //echo "Project was cancelled.";
        header('Location: ../manage_projects.php');
    }
     
    // if unable to delete the product
    else{
        echo "Unable to cancel project.";       
    }
} else {

$pageTitle = "Update Project";
$currentPage = "browse";
/* End page specific variables */
include_once dirname(__DIR__)."/inc/security.php";?>

<html class="no-js" lang="">
  <?php include_once dirname(__DIR__)."/inc/head.php";?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once dirname(__DIR__)."/inc/header.php";?>
      <?php 
      
	if(isset($_POST['projectId'])){
	$projectId = $_POST['project'];
	} else {
	echo "not set";
	}

    $projectDetailsDAO= new ProjectDetailsDAO();
    $result = $projectDetailsDAO->getProjectById($projectId)[0];

    ?>



    <div class="container" style="padding-top: 5%; padding-bottom: 5%;">

          <div class="row" height="30%">
            <div class="col-md-3">
              <img alt="" width="100%" height="30%" src= <?php echo $result['img_l'];?>>
            </div>
            <div class="col-md-7">
              <div class="container">
               <div>
                 <h4><?php
                   echo $result['title'];
                 ?></h4>
                 <p><?php
                   echo $result['overview'];
                 ?></p>
                 <h6>Pledge Goal: $ <?php
                    echo $result['pledge_goal']
                  ?></h6>
              </div>
            </div>
            </div>
        </div>
    </div>


    <form action='update_project.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered' style="width:88%" align='center'>
 
        <tr>
            <td>New Project Title</td>
            <td><input type='text' name='title'  class='form-control' /></td>
        </tr>
 
        <tr>
            <td>New Target</td>
            <td><input type='number' name='pledge_goal' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='overview' class='form-control'></textarea></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

    <!-- end main content -->
  </div>
  <!-- Google Analytics -->
  <?php require('./inc/analytics.php'); ?>
  <!-- Javascript builds -->
  <?php require('./inc/tail.php'); ?>
</body>
</html>

<?php
if($_POST){
	$projectDAO = new ProjectDAO();

    $updateInfo = $_POST;

    $fields = array("title, pledge_goal, overview");
    $values = array($updateInfo['title'], $updateInfo['pledge_goal'], $updateInfo['overview'] );
    var_dump($_POST);
    // update the product
    if($projectDAO->updateProject($projectId, $fields, $values)){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Project was updated.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Unable to update project.";
        echo "</div>";
    }
}
}