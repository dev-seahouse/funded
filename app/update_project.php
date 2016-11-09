<?php
/* Page specific variables */
$pageTitle = "Update Project";
$currentPage = "browse";
/* End page specific variables */
include_once __DIR__."/inc/security.php";?>
<html class="no-js" lang="">
  <?php include_once __DIR__."/inc/head.php";?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once __DIR__."/inc/header.php";?>
      <?php 
      

    $projectId =  $_POST['project'] ;

    $projectDetailsDAO= new ProjectDetailsDAO();
    $result = $projectDetailsDAO->getProjectById($projectId)[0];

    ?>



    <div class="container" style="padding-top: 5%; padding-bottom: 5%;">

          <div class="row" height="30%">
            <div class="col-md-6">
              <img alt="" width="90%" height="70%" src= <?php echo $result['img_l'];?>>
            </div>
            <div class="col-md-6">
              <form action='update_project.php' method='post'>
    <input type="hidden" name="project" value= <?php echo $projectId ?>>
    <table class='table table-hover table-responsive table-bordered' height = '' align='center'>
 
        <tr>
            <td>New Project Title</td>
            <td><input type='text' name='title'  class='form-control' /></td>
        </tr>
 
        <tr>
            <td>New Target</td>
            <td><input type='text' name='pledge_goal' class='form-control' /></td>
        </tr>

        <tr>
            <td>Featured</td>
            <td><input type='checkbox' name='featured' class='form-control' /></td>
        </tr>

        <tr height='230px'>
            <td>Description</td>
            <td><textarea name='overview' class='form-control' rows="8" ></textarea></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary" >Update</button>
            </td>
        </tr>
 
    </table>
</form>
            </div>
        </div>
    </div>


    

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

    $title = $_POST['title'];
    $overview = $_POST['overview'];
    $amount = $_POST['pledge_goal'];
    $featured = isset($_POST['featured']) ? 1 : 0;

    // update the project
    
    if($projectDAO->updateProject($projectId, $title, $overview, $amount, $featured)){
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
?>