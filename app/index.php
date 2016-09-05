<?php
/* Page specific variables */
$pageTitle = "Home";
$currentPage = "browse"
/* End page specific variables */
?>
<!doctype html>
<html class="no-js" lang="">
  <?php include "/inc/head.php"?>
  <body>
    <!--[if lt IE 10]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header>
      
      <nav class="navbar navbar-light bg-faded" role="navigation">
        <!--/.container-fluid start -->
        <a class="navbar-brand hidden-xs-down" href="index.php">Funded!</a>
        <a href="index.php" class="navbar-brand hidden-sm-up"><i class="fa fa-dollar"></i>F</a>
        <span class="navbar-divider"></span>
        
        <ul class="nav navbar-nav navbar-links">
          <li class="nav-item m-r-1"> <?php //todo: switch active status depending on which page user is at ?>
            <a class="nav-link" href="#">Browse<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item hidden-xs-down m-r-1">
            <a class="nav-link" href="#">About us</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-links pull-right">
          <li class="nav-item">
            <a class="btn btn-link search-trigger" data-toggle="collapse" href="#search-bar"><i class="fa fa-search"> </i></a>
          </li>
          <li class="nav-item"><a href="" class="nav-link">Log In</a></li>
        </ul>

      </nav>
      
    </header>
    <!-- start main content -->
    <div class="container-fluid">
      <div class="row gallery">
        <div class="owl-carousel owl-theme">
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
          <div class="item"><img src="http://placehold.it/350x350"></div>
        </div>
      </div>
      <div class="row p-y-1 p-x-1">
        <p class="h3">Trending Projects</p>
      </div>
      
    </div>
    <!-- end main content -->
    <div class="footer">
      <p>♥ from dev-seahouse</p>
    </div>
  </div>
  <!-- Google Analytics -->
  <?php require('/inc/analytics.php'); ?>
  <!-- Javascript builds -->
  <?php require('/inc/tail.php'); ?>
</body>
</html>