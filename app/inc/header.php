<?php
/* Todos
1. Indicate that user is on certain a page by adding active class on the page
*/
?>
<header>
  <!-- Modal Sign in Begins -->
  <div class="modal" id="modal-login" tabindex="-1" role="dialog">
    <div class="modal-dialog small">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
          <h3 class="modal-title text-xs-center">Sign in now</h3>
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

                <input name="remember-me" id="remember-me" value="forever" checked="checked" type="checkbox">
                <label for="remember-me"> Remember Me </label>
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
          <form id="form-signup" method="post">
            <div class="form-group reg-username">
              <div>
                <input name="login" class="form-control input" size="20" placeholder="Enter Username"
                type="text">
              </div>
            </div>
            <div class="form-group reg-email">
              <div>
                <input name="reg" class="form-control input" size="20" placeholder="Enter Email" type="text">
              </div>
            </div>
            <div class="form-group reg-password">
              <div>
                <input name="password" class="form-control input" size="20" placeholder="Password"
                type="password">
              </div>
            </div>
            <div>
              <div>
                <input name="submit" class="btn btn-block btn-lg btn-primary" value="REGISTER" type="submit" id="submit-signup">
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
      </ul>
      <!-- end header linkts -->
      <ul class="nav navbar-nav navbar-links pull-right ">

        <li class="nav-item">
          <a class="btn btn-link search-trigger" href="#"><i class="fa fa-search"> </i></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-login">Sign in | Register</a>
          <!-- Todo:  at small screen, show icon dropdown instead of text -->
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
