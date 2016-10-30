<?php
include_once dirname(__DIR__)."/_config/autoloader.php";
$auth = new Authentication();
$conn = DbConnection::getInstance()->getConnection();
$projectDAO = new ProjectDAO();
$category = CategoryDAO::getCategories($conn);

/* Todos
1. Indicate that user is on certain a page by adding active classes on the page
 */
?>
<header>
<!-- Modal Create Project Begins -->
<div class="modal" id="modal-create-project" tabindex="-1" role="dialog">
<div class="modal-dialog medium">
<div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
    <h3 class="modal-title text-xs-center">Create Projects</h3>
  </div>
  <div class="modal-body">
    <form id="form-create-project" type = "POST" action="controllers/create_project.php">
      <div class="form-group">
        <div>
          <input type="text" name="title" class="form-control input" size="20" placeholder="Enter Project Title">
        </div>
      </div>

      <div class="form-group">
        <div>
          <input type="text" name="pledge_goal" class="form-control input" size="20" placeholder="How much money you want!">
        </div>
      </div>

    <?php 
      if($auth->isUserLoggedIn(1)){ ?>
           <div class ="form-group" style="display:none">
           <div>
             <input type = "text" name = "creator_id" class ="form-control" value="<?php echo $_SESSION['user_id'];?>">
           </div> 
           </div>
      <?php } else { ?>
        <div class="form-group">
        <div>
        <input type="text" name="creator_id" class="form-control input" size="20" placeholder="Your unique ID">
        </div>
        </div>
         <?php } ?>

        <div class="form-group">
        <div>
          <input type="text" name="country" class="form-control input" size="20" placeholder="Your country or location">
        </div>
      </div>

      <div class="form-group">
        <div>
          <input type="text" name="email" class="form-control input" size="20" placeholder="Enter your preferred contact email">
        </div>
      </div>

      <div class="form-group">
        <div>
          <select name= 'category' class="form-control">
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
        </div>
      </div>

      <div class="form-group">
        <div>
          <textarea name="overview" class="form-control" cols = "10">
          </textarea>
        </div>
      </div>

      <div class="form-group">
              <div>
                <input class="btn btn-block btn-lg btn-primary" value="CREATE PROJECT" type="submit"
                       id="submit-create-project">
              </div>
        </div>
    </form>
  </div>
</div>
  
</div>
  
</div>

  <!-- Modal Sign in Begins -->
  <div class="modal" id="modal-login" tabindex="-1" role="dialog">
    <div class="modal-dialog small">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title text-xs-center">Sign in now</h3>
        </div>
        <div class="modal-body">
          <form id="form-user-signin" type="POST" action="controllers/do_login.php">
            <div class="form-group">
              <div>
                <input name="login_id" id="login-user" class="form-control input" size="20"
                       placeholder="Enter Username" type="text">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="login_pass" id="login-password" class="form-control input" size="20"
                       placeholder="Password" type="password">
              </div>
            </div>

            <div class="form-group" style="display:none">
              <div>
                <input name="email" class="form-control" size="20"
                       placeholder="Please leave this field empty"
                       type="text">
              </div>
            </div>
            <input type="hidden" name="login" value="1">

            <div class="form-group">
              <div>
                <div class="checkbox login-remember">
                  <input name="icheck remember-me" id="remember-me" value="forever" checked="checked"
                         type="checkbox">
                  <label for="remember-me"> Remember Me </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="submit" class="btn btn-block btn-lg btn-primary" value="LOGIN"
                       type="submit">
              </div>
            </div>
          </form>
          <!--userForm-->
        </div>
        <div class="modal-footer">
          <p class="text-xs-center"> Not here before? <a data-toggle="modal" data-dismiss="modal"
                                                         href="#modal-sign-up"> Sign Up. </a> <br>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Modal Sign in Ends -->
  <!-- Modal Sign up begins -->
  <div class="modal" id="modal-sign-up" tabindex="-1" role="dialog">
    <div class="modal-dialog small">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title text-xs-center"> REGISTER </h3>
        </div>
        <div class="modal-body">
          <form id="form-user-signup" type="POST" action="controllers/do_register.php">
            <div class="form-group">
              <div>
                <input name="first_name" class="form-control" size="20" placeholder="First Name"
                       type="text">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="last_name" class="form-control" size="20" placeholder="Last Name"
                       type="text">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="user_name" class="form-control" size="20" placeholder="Enter Username/Email"
                       type="text">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="password" class="form-control" size="20" placeholder="Password"
                       type="password">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="password-repeat" id="login-password-repeat" class="form-control input"
                       size="20"
                       placeholder="Please retype password" type="password">
              </div>
            </div>
            <div class="form-group">
              <div>
                <input name="email" class="form-control" size="20" placeholder="Enter Email"
                       type="text">
              </div>
            </div>
            <div class="form-group" style="display:none">
              <div>
                <input name="address" class="form-control" size="20"
                       placeholder="Please leave this field empty"
                       type="text">
              </div>
            </div>
            <input type="hidden" name="register" value="1">
            <div class="form-group">
              <div>
                <input class="btn btn-block btn-lg btn-primary" value="REGISTER" type="submit"
                       id="submit-signup">
              </div>
            </div>
          </form>
          <!--userForm-->
        </div>
        <div class="modal-footer">
          <p class="text-xs-center"> Already member? <a data-toggle="modal" data-dismiss="modal"
                                                        href="#modal-login">
              Sign in </a></p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <! --/Modal Sign up -->
  <nav class="navbar navbar-light bg-faded" role="navigation">
    <div class="container-fluid">
      <!-- header banner -->
      <a class="navbar-brand hidden-xs-down" href="index.php">Funded!</a>
      <a href="index.php" class="navbar-brand hidden-sm-up"><i class="fa fa-dollar"></i>F</a>
      <!-- /header banner -->
      <span class="navbar-divider"></span>
      <!-- header linkts -->
      <ul class="nav navbar-nav navbar-links">
        <li class="nav-item"> <?php //todo: switch active status depending on which page user is at ?>
          <a class="nav-link" href="#">Browse<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item hidden-xs-down">
          <a class="nav-link" href="#">About us</a>
        </li>

        <li class="nav-item hidden-xs-down">
          <a class="nav-link" data-toggle="modal" data-target="#modal-create-project">Create Projects</a>
        </li>
      </ul>
      <!-- end header linkts -->

      <ul class="nav navbar-nav navbar-links pull-right">
        <li class="nav-item">
          <a class="btn btn-link search-trigger" href="#"><i class="fa fa-search"> </i></a>
        </li>
        <div class="nav navbar-nav navbar-links pull-right" id="member_area">

          <?php
          if ($auth->isUserLoggedIn(1)) { ?>
            <li class="nav-link">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                 aria-expanded="false"> <i
                    class="glyphicon glyphicon-log-in hide visible-xs "></i> Hi, <?=strtoupper($_SESSION["last_name"])?> <b
                    class="caret"></b></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item"><a href="#"> Profile</a></li>
                <li class="dropdown-item"><a href="#"> Backed Projects</a></li>
                <li class="divider"></li>
                <li class="dropdown-item"><a href="controllers/do_logout.php" id="logoutBtn"> Log Out</a></li>
              </ul>
            </li>
          <?php } else { ?>
          <li class="nav-item">
            <!-- Todo:  at small screen, show icon dropdown instead of text -->
            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-login">Sign in</a>
          </li>
          <li class="nav-item hidden-xs-down">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-sign-up">Register</a>
          </li>
          <?php }?>
        </div>
      </ul>
      <div class="search-bar text-right" id="#search-bar">
        <a class="pull-right search-close" href="">
          <i class="fa fa-times-circle"></i>
        </a>
        <form action="./search.php" class="search-bar-form" method="post">
          <input type="search" class="search-bar-input" name="search-bar-input"
                 placeholder="start typing and hit enter">
          <button class="btn btn-link search-bar-btn" type="submit" name="search">
            <i class="fa fa-search"> </i>
          </button>
        </form>
      </div>
    </div>
  </nav>
</header>