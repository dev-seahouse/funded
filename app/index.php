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

<div class="container-fluid">
  <div id="carouselBlock" class="carousel js-flickity">

    <?php
    $projectFac = new ProjectDAO();
    // most popular 5 projects
    $requests = array('status' => 3);
    $fields = array('title', 'img_l', 'id','overview');
    $sorting = array('backer_count' => 'DESC');
    $galleryProjects = $projectFac->getProject($requests, $fields, 'project', $sorting);

    for ($i = 0; $i < 5; $i++) { ?>
      <div class="carousel-cell">
        <div class="cell-content">
          <h2 class="cell-title"><?php echo trim($galleryProjects[$i]['title']); ?></h2>
          <div class="cell-desc dot-ellipsis dot-resize-update dot-height-50">
            <?php echo trim($galleryProjects[$i]['overview']) ?>
          </div>
          <div class="cell-submit">
            <form action='project.php' method="post">
              <input type="hidden" name="project" value="<?php echo $galleryProjects[$i]['id'] ?>"/>
              <button class="btn btn-hollow" type="submit"
                    name="popProject">Back me!</button>

            </form>
          </div>

        </div>
        <img src="https://unsplash.it/1200/500/?random&&<?php echo rand(5, 15); ?>">
      </div>
    <?php } ?>
  </div>
</div>

<h1 class="section-title">Trending Projects</h1>
<!-- Project card -->
<div class="container-fluid">
  <div class='row'>
    <?php
    $projectFac = new ProjectDAO();
    $requests = array('featured' => 1);
    $fields = array('title', 'overview', 'suml_pledged', 'pledge_goal', 'img_l', 'id');
    ?>
    <!-- Project card -->

    <?php
    $requests = array('featured' => 1);
    $fields = array('title', 'overview', 'suml_pledged', 'pledge_goal', 'img_l', 'id');
    $featuredProjects = $projectFac->getProject($requests, $fields, 'featured_project');
    foreach ($featuredProjects as $row) { ?>
        <div class='col-md-3 col-sm-6 col-xs-12'>
          <div class="project">
            <div class='thumbnail'>
              <form action='project.php' method="post">
                <input type="hidden" name="project" value="<?=$row['id'];?>"/>
                <button class="btn btn-hollow" name="projectId">BACK ME</button>
              </form>
              <img src="<?=$row['img_l']?>">
            </div>
            <div class='caption'>
              <div class="title dot-ellipsis dot-resize-update dot-height-30"><?=$row['title']?></div>
              <div class="description dot-ellipsis dot-resize-update dot-height-60"><?=$row['overview']?></div>
            </div>
            <div class="info-section">
              <div class="pledged-amount">$<?=$row['suml_pledged']?>/$<?=$row['pledge_goal']?></div>
              <div class="progress-bar"
                   data-sum ="<?=$row['suml_pledged']?>"
                   data-goal="<?=$row['pledge_goal']?>"
              ></div>
            </div>
          </div>
         <!-- <form action='project.php' method="post">
            <input type="hidden" name="project" value="<?php /*echo $row['id']; */?>"/>
            <img class='card-img-top img-thumbnail' src='<?php /*echo $row['img_l'] */?>' alt='Card image cap'></a>
            <div class='card-block' height='100%'>
              <h6 class='card-title'><?php /*echo $row['title'] */?></h6>
              <p class='card-text small'><?php /*echo $row['overview'] */?></p>
            </div>
            <div class='card-footer'>
              <p class='card-text bottom-align-text small'><span class="tag tag-pill tag-info">Amount Raised</span>
                $<?php /*echo $row['suml_pledged'] */?></p>
              <p class='card-text bottom-align-text small'><span class="tag tag-pill tag-info">Target</span>
                $<?php /*$row['pledge_goal'] */?></p>
              <button class="btn btn-link offset-md-8 offset-sx-8 offset-sm-8" type="submit" name="projectId">Details
              </button>
            </div>
          </form>-->
        </div>
    <?php } ?>
  </div>
</div>
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
<script>
  var containers = $('.progress-bar');
  $.each(containers,function (key,value) {
    var $className = ('progress-bar-' + key);
    $(this).addClass($className);
    $className= '.'+$className;
    var sum = $(this).data('sum');
    var goal = $(this).data('goal');
    var percent = Math.floor((sum / goal) * 100);
    new ProgressBar.Line($className, {
          strokeWidth: 4,
          easing: 'easeInOut',
          duration: 1400,
          color: '#FFA500',
          trailColor: '#eee',
          trailWidth: 1,
          svgStyle: {width: percent+'%', height: '100%'},
          text: {
            style: {
              // Text color.
              // Default: same as stroke color (options.color)
              color: '#999',
              position: 'absolute',
              right: '0',
              top:-8,
              padding: 0,
              margin: 0,
              transform: null
            },
            autoStyleContainer: false
          },
          from: {color: '#FFEA82'},
          to: {color: '#ED6A5A'},
          step: (state, bar) => {
          bar.setText(Math.round(bar.value() * percent) + ' %');
  }
  }).animate(1.0);
  });

</script>
</body>
</html>
