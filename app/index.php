<?php
/* Page specific variables */
$pageTitle = "Home";
$currentPage = "browse";
/* End page specific variables */
?>
<?php include_once __DIR__ . "/inc/security.php"; ?>
<html class="no-js" lang="">
<?php include_once __DIR__ . "/inc/head.php"; ?>
<body>
<!--[if lt IE 10]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
  your browser</a> to improve your experience.</p>
<![endif]-->
<?php include_once __DIR__ . "/inc/header.php"; ?>
<!-- start main content -->

<div class="jumbotron">
    <h1 class="text-primary text-center">Top 5 Most Funded Projects</h1>
  </div>
<div class="container-fluid">
  <div id ="carouselBlock"class="carousel js-flickity">

      <?php
      $projectFac = new ProjectDAO();
      // most popular 5 projects
      $requests = array('status' => 3);
      $fields = array('title',  'img_l', 'id');
      $sorting = array('backer_count' => 'DESC');
      $galleryProjects = $projectFac->getProject($requests, $fields, 'project', $sorting);

      for ($i=0; $i < 5; $i++) { ?>
        <div class="carousel-cell">
        <form action='project.php' method="post">
        <input type="hidden"  name = "project" value="<?php echo $galleryProjects[$i]['id']?>"/>
        <button class="btn btn-block btn-primary" type="submit" name="popProject"><?php echo $galleryProjects[$i]['title'];?></button></form>
        <img src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15); ?>">
      </div>
      <?php } ?>
  </div>
  </div>

  <hr>

  <div class="jumbotron">
    <h1 class="text-primary text-center">Trending Projects</h1>
  </div>


      <!-- Project card -->

      <?php 
  
  $requests = array('featured' => 1);
  $fields = array('title', 'overview', 'suml_pledged', 'pledge_goal', 'img_l', 'id');
  $featuredProjects = $projectFac->getProject($requests, $fields, 'featured_project');
  $counter = 0;
  foreach ($featuredProjects as $row) {
    $counter++;
    if($counter == 1){ ?>
      <div class='card-deck-wrapper'>
      <div class='card-deck'>
    <?} ?>

    <div class='card col-md-3 col-sm-6 col-xs-12'>
      <form action='project.php' method="post">
      <input type="hidden" name="project" value="<?php echo $row['id'];?>"/>
      <img class='card-img-top img-thumbnail' src='<?php echo $row['img_l']?>' alt='Card image cap'></a>
      <div class='card-block' height = '100%' >
        <h6 class='card-title'><?php echo $row['title']?></h6>
        <p class='card-text small'><?php echo $row['overview']?></p>
      </div>
      <div class = 'card-footer'>
        <p class='card-text bottom-align-text small'> <span class="tag tag-pill tag-info">Amount Raised</span> $<?php echo $row['suml_pledged']?></p>
        <p class='card-text bottom-align-text small'> <span class="tag tag-pill tag-info">Target</span> $<?php $row['pledge_goal']?></p>
        <button class="btn btn-link offset-md-8 offset-sx-8 offset-sm-8" type="submit" name="projectId">Details</button>
      </div>
      </form>
        </div>

    <?php if($counter == 4){ ?>
      </div></div>
      <?php $counter = 0;
    }
  } ?>


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