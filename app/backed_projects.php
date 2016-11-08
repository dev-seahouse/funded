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
$fields =array("project.id as id, project.title as project", "project.overview as description", "project.category", "backer_project.amount_pledged as amount", "project.img_l as img");
$result = $projectDAO->getProjectByBacker($user_id, $fields);
$num = $result->rowCount(); 
?>

      <?php
      if($num>0){
      echo "<table align = 'center' class='table table-hover table-responsive table-bordered'>";

 
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
      ?>
        <div class="container" style="padding-top: 5%;">
          <div class="row" height="30%">
            <div class="col-md-3">
              <img alt="" width="100%" height="30%" src= <?php echo "{$img} "?>>
            </div>
            <div class="col-md-7">
              <div class="container">
               <div>
                 <h4><?php
                   echo "{$project}"
                 ?></h4>
                 <p><?php
                   echo "{$description}"
                 ?></p>
                 <h6>Amount Pledged: $ <?php
                    echo "{$amount}"
                  ?></h6>
              </div>
            </div>
            </div>
            <div class="col-md-2">
              <a href='' class='btn btn-primary left-margin'>
                     <span class='glyphicon glyphicon-list'></span> More Details</a>
            </div>
          </div>
        </div>
<?php 
        }
 
    echo "</table>";
    }
    else{
    echo "<div>No projects funded.</div>";
    }?>

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






