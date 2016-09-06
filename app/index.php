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
      <!-- Modal Sign in Begins -->
      <div class="modal modal-login" id="modal-login" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h3 class="modal-title-site text-center">Sign in now</h3>
            </div>
            <div class="modal-body">
              <div class="form-group login-username">
                <div>
                  <input name="log" id="login-user" class="form-control input" size="20"
                  placeholder="Enter Username" type="text">
                </div>
              </div>
              <div class="form-group login-password">
                <div>
                  <input name="Password" id="login-password" class="form-control input" size="20"
                  placeholder="Password" type="password">
                </div>
              </div>
              <div class="form-group">
                <div>
                  <div class="checkbox login-remember">
                    <label>
                      <input name="rememberme" value="forever" checked="checked" type="checkbox">
                    Remember Me </label>
                  </div>
                </div>
              </div>
              <div>
                <div>
                  <input name="submit" class="btn btn-block btn-lg btn-primary" value="LOGIN" type="submit">
                </div>
              </div>
              <!--userForm-->
            </div>
            <div class="modal-footer">
              <p class="text-center"> Not here before? <a data-toggle="modal" data-dismiss="modal"
              href="#modal-login"> Sign Up. </a> <br>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- Modal Sign in Ends -->
      <nav class="navbar navbar-light bg-faded" role="navigation">
        <div class="container">
          <!-- header banner -->
          <a class="navbar-brand hidden-xs-down" href="index.php">Funded!</a>
          <a href="index.php" class="navbar-brand hidden-sm-up"><i class="fa fa-dollar"></i>F</a>
          <!-- /header banner -->
          <span class="navbar-divider"></span>
          <!-- header linkts -->
          <ul class="nav navbar-nav navbar-links">
            <li class="nav-item m-r-1"> <?php //todo: switch active status depending on which page user is at ?>
              <a class="nav-link" href="#">Browse<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item hidden-xs-down m-r-1">
              <a class="nav-link" href="#">About us</a>
            </li>
          </ul>
          <!-- end header linkts -->
          <ul class="nav navbar-nav navbar-links pull-right">
            
            <li class="nav-item">
              <a class="btn btn-link search-trigger" href="#"><i class="fa fa-search"> </i></a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-login">Sign in</a>
            </li>
          </ul>
          <div class="search-bar text-right" id="#search-bar">
            <a class="pull-right search-close" href="#">
              <i class="fa fa-times-circle"></i>
            </a>
            <form action="#" class="search-bar-form">
              <input type="search" class="search-bar-input" name="search-bar-input" placeholder="start typing and hit enter">
              <button class="btn btn-link search-bar-btn" type="submit">
              <i class="fa fa-search"> </i>
              </button>
            </form>
          </div>
        </div>
      </nav>
      
    </header>
    <!-- start main content -->
    <div class="container-fluid">
      <div class="row gallery">
        <div class="carousel" data-flickity='{ "autoPlay": 2500 , "wrapAround": true}'>
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
            <img class="carousel-image" src="https://unsplash.it/350/500/?<?php echo date('H:i:s'); ?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/350/500/?<?php echo date('H:i:s'); ?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/350/500/?<?php echo date('H:i:s'); ?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/350/500/?<?php echo date('H:i:s'); ?>">
          </div>
          <div class="carousel-cell">
            <input type="hidden" value="project_id"/>
            <div class="carousel-caption">Project Title</div>
            <img class="carousel-image" src="https://unsplash.it/350/500/?<?php echo date('H:i:s'); ?>">
          </div>
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