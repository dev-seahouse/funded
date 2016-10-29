
<header>
<!-- Greeting for users begin --> 
  <!-- Modal Sign in Begins -->
  <div class="modal" id="modal-login" tabindex="-1" role="dialog">
    <div class="modal-dialog small">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title text-xs-center">Sign in now</h3>
        </div>
        <form id = "form-user-login" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div>
              <input name="username" id="login-user" class="form-control input" size="20"
              placeholder="Enter Username" type="text">
            </div>
          </div>
          <div class="form-group">
            <div>
              <input name="password" id="login-password" class="form-control input" size="20"
              placeholder="Password" type="password">
            </div>
          </div>
          <div class="form-group">
            <div>
              <div class="checkbox login-remember">
                <input name="remember-me" id="remember-me" value="forever" checked="checked" type="checkbox">
                <label for="remember-me"> Remember Me </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div>
            <button type="submit" class="btn btn-block btn-lg btn-primary" name="login" method="post">LOGIN</button>
            </div>
          </div>
          <!--userForm-->
        </div>
        </form>
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
          <form id="form-user-signup" type="POST" action="#">
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
                <input name="user_name" class="form-control" size="20" placeholder="Enter Username"
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
                <input name="email" class="form-control" size="20" placeholder="Enter Email" type="text">
              </div>
            </div>

            <?php // todo:honey pot for spam protection?>
            <div class="form-group">
              <div>
                <input class="btn btn-block btn-lg btn-primary" value="REGISTER" type="submit" id="submit-signup">
              </div>
            </div>
          </form>
          <!--userForm-->
        </div>
        <div class="modal-footer">
          <p class="text-xs-center"> Already member? <a data-toggle="modal" data-dismiss="modal" href="#modal-login">
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
          <a class="nav-link" href="../controllers/create_project.php">Create Projects</a>
        </li>
      </ul>
      <!-- end header linkts -->
      
      <ul class="nav navbar-nav navbar-links pull-right ">
        <li class="nav-item">
          <a class="btn btn-link search-trigger" href="#"><i class="fa fa-search"> </i></a>
        </li>
        <?php if(!isset($_SESSION['uid'])){ ?>
        <li class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-login">Sign in | Register</a>
          <!-- Todo:  at small screen, show icon dropdown instead of text -->
        </li>
        <? } else { ?>
          <li class = "nav-item">
          <a class="nav-link" href="../controllers/home.php"><? echo "Hi! ".$_SESSION['user_name']?></a>
          </li>
        <? } ?>
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
