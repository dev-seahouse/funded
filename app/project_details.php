<?php
/* Page specific variables */
$pageTitle = "Home";
$currentPage = "browse";
/* End page specific variables */

include "./data/DbConnection.php";

$pdo = DbConnection::getInstance();
$conn = $pdo->getConnection();
?>

<html class="no-js" lang="">
  <?php include_once __DIR__."/inc/head.php";?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once __DIR__."/inc/header.php";?>
    <!-- start main content -->

    <?php
      $projectDetailsDAO= new ProjectDetailsDAO();
      $result = $projectDetailsDAO->getProjectById(2);
      //var_dump($result); #for debug purpose
      ?>

    <div class="container">
  <!--    <div class="row gallery">
        <div class="carousel" data-flickity='{ "autoPlay": 2500 , "wrapAround": true, "resize":true, "watchCSS" :false}'>
          <?php
          /* todo:
          -Tip: views can be created to simply sql statements
          -fetch top 10 projects from project table where
          1. marked as featured by admin
          2. is active
          3. sort by number of likes followed by view counts
          -append project id inside hidden input box(for redirection)
          -add a link of project to redirect to project details page
          -append img url from database and place inside src
          For admins: (optional)
          1. which projects are not active but marked as featured so that i can quickly clean up things?
          2. one click button to update all projects that does not have active status
          */

          // if(isset)
          ?>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15);?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15);?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15);?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15);?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15);?>">
          </div>
        </div>
      </div>

  --><h2><?php
     echo $result[0]["title"];
     ?></h2>
  <h6>by

    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#creatorProfile"><?php
     echo $result[0]["user_name"];
     ?></button>
</h6>
      <div class="row">
        <div class="col-md-8">
          <img alt="" width="100%" height="100%" src="<?php
             echo $result[0]["img_l"];
             ?>"></br></br>
          <?php
             echo $result[0]["overview"];
             ?>
        </div>
        <div class="col-md-4">
            <div class="container">
              <div class="row">
               <div class="col-md-10">
                 <h3><?php
                   echo $result[0]["backer_count"];
                 ?></h3>
                 <h6>backers</h6><br/>
                 <h3>$<?php
                   echo $result[0]["suml_pledged"];
                 ?></h3>
                 <h6>pledged of $
                   <?php
                     echo $result[0]["pledge_goal"];
                   ?>
                    goal</h6></br>
                 <h3> <?php
                    echo $result[0]["days_to_go"];
                  ?></h3>
                 <h6>days to go</h6><br/>
                 <button type="button" class="btn btn-success">Back This Project</button><br/><br/>
                 <?php
                 $tagsRs = $projectDetailsDAO->getProjectTagsById(2);
                   foreach ($tagsRs as $tag) {
                  ?>
                      <span class="tag tag-pill tag-default">
                        <?php
                          echo $tag["name"];
                         ?>
                      </span>

                <?php
                   }
                 ?>
               </div>

                <div class="col-md-2">

                </div>
              </div>
            </div>

        </div>
      </div>
    </div>



    <?php
    $userInfo = $projectDetailsDAO->getUserById(1);
      ?>
    <!-- Modal -->
    <div id="creatorProfile" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
              <img src="<?php
                 echo $userInfo[0]["profile_pic"];?>" class="img-circle" alt="Cinque Terre" width="60" height="50">
              <?php echo $userInfo[0]["first_name"] ?>
              <?php echo $userInfo[0]["last_name"] ?></h4>
            <h6>Last Login: <?php echo $userInfo[0]["last_login"] ?></h6>
          </div>

          <div class="modal-body">

            <p><?php echo $userInfo[0]["user_descriptn"] ?></p>
            <p><?php echo $userInfo[0]["about_me"] ?></p><br/>
            <p><h6>Facebook:</h6><?php echo $userInfo[0]["facebook_id"] ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>





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
