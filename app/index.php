<?php
/* Page specific variables */
$pageTitle = "Home";
$currentPage = "browse"
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
      <div class="row p-t-3 p-x-2">
        <h2>Trending Projects</h2>
        <div class="col-xs-9">

        </div>
        <div class="col-xs-9">

        </div>
        <div class="col-xs-9">

        </div>
      </div>

      <!-- Project card -->

      <?php 
  $projectFac = new ProjectDAO();
  $requests = array('featured' => 1);
  $fields = array('title', 'overview');

  $featuredProjects = $projectFac->getProject($requests, $fields, 'featured_project');
  $counter = 0;

  foreach ($featuredProjects as $row) {
    $counter++;

    if($counter == 1){
      echo "<div class='card-deck-wrapper'>
      <div class='card-deck'>";
    }

    echo "<div class='card'>
      <img class='card-img-top' src='...'' alt='Card image cap'>
      <div class='card-block'>
        <h4 class='card-title'>{$row['title']}</h4>
        <p class='card-text'>{$row['overview']}</p>
        <p class='card-text'><small class='text-muted'>Last updated 3 mins ago</small></p>
      </div>
    </div>";

    if($counter == 4){
      echo '</div></div>';
      $counter = 0;
    }
  }
?>
      <!-- Project card ends -->


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
