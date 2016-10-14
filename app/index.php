<?php
/* Page specific variables */
$pageTitle = "Home";
$currentPage = "browse"
/* End page specific variables */
?>
<!doctype html>
<html class="no-js" lang="">
  <?php include "./inc/head.php"?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include "./inc/header.php";?>
    <!-- start main content -->
    <div class="container-fluid">
      <div class="row gallery">
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
      <div class="row p-y-1 p-x-1">
        <p class="h3">Trending projects</p>
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
