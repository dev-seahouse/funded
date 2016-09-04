<?php
$pageTitle = "Home";
?>
  <!doctype html>
  <html class="no-js" lang="">
  <?php include "/inc/head.php"?>

  <body>
    <!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header>
      <nav class="navbar navbar-light bg-faded">
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">&#9776;</button>
        <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
          <a class="navbar-brand" href="#">Navbar</a>
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Browse Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
          <form class="form-inline pull-xs-right">
            <input class="form-control" type="text" placeholder="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>
    <div class="container">

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