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
          <form action='./controllers/delete_project.php' method="post">
          <input type="hidden" name="project" value= <?php echo $row['id']?>>
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
            	<!--div class="row" style="padding-top: 5%;">
            		<a href='' class='btn btn-primary left-margin'>
                     <span class='glyphicon glyphicon-list'></span> More Details</a>
            	</div-->

            	<div class="row" style="padding-top: 5%;">
                <a href ='' class="btn btn-primary" style="width:100px">Update</a>
            	</div>
            	<div class="row" style="padding-top: 5%;">         		
            		<input type="submit" class='btn btn-danger' value = 'Delete' name="projectId" style="width:100px">
            	</div>              
            </div>
          </div>
          </form>
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
