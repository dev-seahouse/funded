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
    <?php 
  $projectFac = new ProjectDAO();
	$conn = DbConnection::getInstance()->getConnection();
  $category = CategoryDAO::getCategories($conn);

  // for simple search in name and overview
  if(isset($_POST["search"])) {
	$target = $_POST['search-bar-input'];
	$projects = $projectFac->search($target);
  }


  //for more advanced findProjects

  if(isset($_POST["find"])) {
    $requests = $_POST;
    //var_dump($requests);
    $projects = $projectFac->findProjects($requests);
  }
 ?>
<div class="container">
  <div class="row">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form-find" method="post" action="./search.php" >
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Categories</label>
                            <select id="pref-perpage" class="form-control" name = 'category'>
                             <?php
                                foreach ($category as $row) {
                                echo $row['name'];
                                echo '<option name="' 
                                    . $row['name']
                                    . '"/>'
                                    . $row['name']
                                    . '</option>';
                                 }?>
                            </select>                                
                        </div> <!-- form group [category] -->
                        

                        <div class="form-group">
                            <label style="margin-right:0;" for="pref-search">Tags:</label>
                            <input type="text" class="form-control input-sm" id="pref-search" name="tag">
                        </div><!-- form group [tag] -->
                        

                        <div class="form-group">
                            <label style="margin-right:0;" for="pref-search">Minimum Amount:</label>
                            <input type="text" class="form-control input-sm" id="pref-search" name="min-amount">
                        </div><!-- form group [min ammount] -->
                        
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Maximum Amount:</label>
                            <input type="text" class="form-control input-sm" id="pref-search" name="max-amount">
                        </div> <!-- form group [max ammoutn] --> 

                        
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Minimum Backer Number:</label>
                            <input type="text" class="form-control input-sm" id="pref-search" name="min-backer">
                        </div> <!-- form group [order by] --> 

                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Max Backer Number:</label>
                            <input type="text" class="form-control input-sm" id="pref-search" name="max-backer">
                        </div> <!-- form group [order by] --> 

                        <div class="form-group">    
                            <button type="submit" class="btn btn-default filter-col" name="findProjects">
                                <span class="glyphicon glyphicon-record"></span> Find Projects
                            </button>  
                        </div>

                    </form>
                </div>
            </div>
        </div>    
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
            <span class="glyphicon glyphicon-cog"></span> Advanced Search
        </button>
  </div>
</div>


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
				<a href='#' title='{$row['title']}'class='card-text'><img class='img-thumbnail' src='{$row['img_l']}' alt='{$row['title']}'/></a>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-2'>
				<ul class='meta-search'>
					<li><i class='glyphicon glyphicon-calendar'></i> <span>". substr($row['end_date'], 0, 10) . "</span></li>
          <li><i class='glyphicon glyphicon-time'></i> <span>". substr($row['end_date'], 11) . "</span></li>
					<li><i class='glyphicon glyphicon-tags'></i> <span>{$row['category']}</span></li>
				</ul>
			</div>
			<div class='col-xs-12 col-sm-12 col-md-6 excerpet'>
				<h6><a href='#' title=''>{$row['title']}</a></h6>
				<p class='small'>{$row['overview']}</p>		    				
			</div>
      <div class='col-xs-12 col-sm-12 col-md-1 excerpet'>
        <form method = 'post' action='./project.php'>
        <input type='hidden' name='project' value = {$row['id']}>
        <input class='btn btn-link' type='submit' name='projectId' value = 'Details'>
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
