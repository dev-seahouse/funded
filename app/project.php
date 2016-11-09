<?php


/* Page specific variables */
$pageTitle = "Home";
$currentPage = "project";
/* End page specific variables */


if (isset($_POST['projectId'])) {
  $projectTarget = $_POST['project'];
} else {
  echo "not set";
}
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

<?php


$projectDetailsDAO = new ProjectDetailsDAO();
$result = $projectDetailsDAO->getProjectById($projectTarget);


// var_dump($result); #for debug purpose
?>

<div class="container">
  <h2><?php
    echo $result[0]["title"];
    ?></h2>
  <h6>by
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#creatorProfile"><?php
      echo $result[0]["user_name"];
      ?></button>
  </h6>
  <div class="row">
    <div class="col-md-8">
      <img alt="" width="80%" height="80%" src="<?php
      echo $result[0]["img_l"];
      ?>"></br></br>
      <?php
      echo $result[0]["overview"];
      ?>
    </div>
    <div class="col-md-4">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h3><?php
              echo $result[0]["backer_count"];
              ?></h3>
            <h6>backers</h6><br/>
            <h3>$<?php
              echo $result[0]["suml_pledged"];
              ?></h3>
            <h6>pledged of $
              <?php
              echo $result[0]["pledge_goal"];
              ?>
              goal</h6></br>
            <h3> <?php
              echo $result[0]["days_to_go"];
              ?></h3>
            <h6>days to go</h6><br/>
            <form id="form-backup" method="post" action="controllers/backup.php">
              <input type="hidden" name="projectId" value="<? echo $result[0]['project_id']; ?>">
              <?php if (isset($_SESSION['user_id'])) {
                if ($projectDetailsDAO->isBackedByUser($result[0]['project_id'], $_SESSION['user_id']) == 0) { ?>
                  <input type="text" name="backAmount" placeholder="Enter the amount">
                  <input type="hidden" name="backerId" value="<? echo $_SESSION['user_id'] ?>">
                  <input class="btn btn-lg btn-primary" value="BACK PROJECT" type="submit" name="newProject">
                <?php } else { ?>
                  <h6> Backed Amount :
                    $ <? echo $projectDetailsDAO->getBackAmount($_SESSION['user_id'], $result[0]['project_id']) ?> </h6>
                  <br/>
                  <input type="text" name="newAmount" placeholder="Show more support?">
                  <input type="hidden" name="backerId" value="<? echo $_SESSION['user_id'] ?>">
                  <input class="btn btn-lg btn-primary" value="UPDATE AMOUNT" type="submit" name="updateProject">
                <?php }
              } else { ?>
                <input type="text" name="backAmount" placeholder="Enter the amount">
                <input class="btn btn-lg btn-primary" value="BACK PROJECT" type="submit" name="newProject">
              <?php } ?>
            </form>
            <!-- <?php
            $tagsRs = $projectDetailsDAO->getProjectTagsById($projectTarget);
            foreach ($tagsRs as $tag) {
              ?>
                      <span class="tag tag-pill tag-default">
                        <?php
              echo $tag["name"];
              ?>
                      </span>

                <?php
            }
            ?> -->
          </div>

          <div class="col-md-2">

          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<?php
$userInfo = $projectDetailsDAO->getUserById(1);
?>
<!-- Modal -->
<div id="creatorProfile" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
          <img src="<?php
          echo $userInfo[0]["profile_pic"]; ?>" class="img-circle" alt="Cinque Terre" width="60" height="50">
          <?php echo $userInfo[0]["first_name"] ?>
          <?php echo $userInfo[0]["last_name"] ?></h4>
        <h6>Last Login: <?php echo $userInfo[0]["last_login"] ?></h6>
      </div>

      <div class="modal-body">

        <p><?php echo $userInfo[0]["user_descriptn"] ?></p>
        <p><?php echo $userInfo[0]["about_me"] ?></p><br/>
        <p><h6>Facebook:</h6><?php echo $userInfo[0]["facebook_id"] ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- end main content -->
<div class="footer">
  <p>♥ from dev-seahouse</p>
</div>

<!-- Google Analytics -->
<?php require('./inc/analytics.php'); ?>
<!-- Javascript builds -->
<?php require('./inc/tail.php'); ?>
</body>
</html>
