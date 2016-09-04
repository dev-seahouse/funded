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
    
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">htdocs</h3>
      </div>

      <div class="jumbotron">
        <h1>Testing browser ddfdsync</h1>
        <p class="lead">Always a pleasure scaffolding your apps.</p>
        <p><a class="btn btn-lg btn-success" href="#">Splendid!</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>HTML5 Boilerplate</h4>
          <p>HTML5 Boilerplate is a professional front-end template for building fast, robust, and adaptable web apps or sites.</p>
          
          <h4>Sass</h4>
          <p>Sass is the most mature, stable, and powerful professional grade CSS extension language in the world.</p>
          
          <h4>Bootstrap</h4>
          <p>Sleek, intuitive, and powerful mobile first front-end framework for faster and easier web development.</p>
          <h4>Modernizr</h4>
          <p>Modernizr is an open-source JavaScript library that helps you build the next generation of HTML5 and CSS3-powered websites.</p>
          
        </div>
      </div>

      <div class="footer">
        <p>♥ from the Yeoman team</p>
      </div>
    </div>
    
    <!-- Google Analytics -->
    <?php require('/inc/analytics.php'); ?>
    <!-- Javascript builds -->
    <?php require('/inc/tail.php'); ?>
  </body>
</html>
