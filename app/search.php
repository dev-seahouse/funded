<?php
/* Page specific variables */
$pageTitle = "Search Result";
$currentPage = "search";
/* End page specific variables */
//TODO: what if empty?
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
    <<?php 
	if(isset($_POST["search"])) {
	$target = $_POST['search-bar-input'];
	$projectFac = new ProjectDAO();
	$projects = $projectFac->search($target);
}
 ?>
    <div class="container">

    <hgroup class="mb20">
		<h1>Search Results</h1>
		<h2 class="lead"><strong class="text-danger">
		<?php echo count($projects); ?>
		</strong> results were found for the search for <strong class="text-danger"><? echo $target;?></strong></h2>
	</hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
    <?php if(count($projects)>0) {
    	foreach ($projects as $row) {
    		echo "<article class='search-result row'>
			<div class='col-xs-12 col-sm-12 col-md-3'>
				<a href='#' title='{$row['title']}'class='thumbnail'><img src='{$row['img_l']}' alt='{$row['title']}'/></a>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-2'>
				<ul class='meta-search'>
					<li><i class='glyphicon glyphicon-calendar'></i> <span>{$row['end_date']}</span></li>
					<li><i class='glyphicon glyphicon-tags'></i> <span>{$row['category']}</span></li>
				</ul>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-7 excerpet'>
				<h3><a href='#' title=''>{$row['title']}</a></h3>
				<p>{$row['overview']}</p>						
			</div>
			<span class='clearfix borda'></span>
		</article>";
    	}
    } else { ?>
    	<div>
    		<h2 class='text-warning'> Please try search someting else.</h2>
    	</div>
    	<form action="./search.php" class="search-bar-form" method="post">
          <input type="search" class="search-bar-input" name="search-bar-input"
                 placeholder="start typing and hit enter">
          <button class="btn btn-link search-bar-btn" type="submit" name="search">
            <i class="fa fa-search"> </i>
          </button>
        </form>
        <? } ?>
	</section>
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
