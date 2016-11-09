<?php
/* Page specific variables */
$pageTitle = "Manage Projects";
$currentPage = "browse";
/* End page specific variables */
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
      /*
      if(!isset($_SESSION['user_id'])){
          echo "<script type='text/javascript'>
          window.location = 'index.php';
          </script>";
      }

      $user_id = $_SESSION['user_id'];
      */
      $projectDAO = new ProjectDAO();
      $fields =array("project.id as id, project.title as project", "project.overview as description", "project.img_l as img");
      $requests = array('status' => 3);

      $allProjects = $projectDAO->getProject($requests, $fields, 'project');

      //var_dump($result); #for debug purpose
      ?>
      <?php
      echo "<table align = 'center' class='table table-hover table-responsive table-bordered'>";

 
         foreach ($allProjects as $row) {
      ?>
        <div class="container" style="padding-top: 5%;">
          
          <div class="row" height="30%">
            <div class="col-md-3">
              <img alt="" width="100%" height="30%" src= <?php echo $row['img'];?>>
            </div>
            <div class="col-md-7">
              <div class="container">
               <div>
                 <h4><?php
                   echo $row['project'];
                 ?></h4>
                 <p><?php
                   echo $row['description'];
                 ?></p>
              </div>
            </div>
            </div>
            <div class="col-md-2">
              <!--form action='/project.php' method="post">
              <input type="hidden" name="project" value= <?php echo $row['id']?>>
            	<div class="row" style="padding-top: 2%;">
            		<input type="submit" class="btn btn-primary" value = 'View' name="projectId" style="width:100px">
            	</div>
              </form-->
              <form action='/update_project.php' method="post">
              <input type="hidden" name="project" value= <?php echo $row['id']?>>
            	<div class="row" style="padding-top: 2%;">
                <input type="submit" class="btn btn-primary" value = 'Update' name="projectId" style="width:100px">
            	</div>
              </form>
              <form action='/controllers/delete_project.php' method="post">
              <input type="hidden" name="project" value= <?php echo $row['id']?>>
            	<div class="row" style="padding-top: 2%;">    	
            		<input type="submit" class='btn btn-danger' value = 'Delete' name="projectId" style="width:100px">
            	</div>  
              </form>            
            </div>
          </div>
          
        </div>
    <?php 
        }
    echo "</table>";
    ?>



    <!-- end main content -->
    <div class="footer">
      <p>♥ from dev-seahouse</p>
    </div>
  </div>
  <!-- Google Analytics -->
  <?php require('./inc/analytics.php'); ?>
  <!-- Javascript builds -->
  <?php require('./inc/tail.php'); ?>
</body>
</html>
