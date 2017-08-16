<?php
$session = $app->session;

$user_loggedin = "";
$user_not_loggedin = "disabled";
$admin = "disabled";
$content = "<span class='glyphicon glyphicon-user'></span> Login";
$logout = "";

// Make sure no one is logged in
if ($session->has("name")) {
  $user_loggedin = "disabled";
  $content = "<span class='glyphicon glyphicon-user'></span> " . $session->get("name");
  $user_not_loggedin = "";
  if ($session->get("name") == "admin") {
    $admin = "";
  }
}


?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= $app->url->create("") ?>">OOPHP</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?= $app->navbar->getHTML(); ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class='<?=$user_not_loggedin?>'><a href="<?= $app->url->create("welcome") ?>">Profile</a></li>
        <li class='<?=$admin?>'><a href="<?= $app->url->create("admin") ?>">Admin</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?= $content ?></b> <span class="caret"></span></a>
			     <ul id="login-dp" class="dropdown-menu">
				    <li>
					  <div class="row">
						<div class="col-md-12">

              <form class="form-signin" role="form" action="validate" method="POST">
                <img src="img/login.png" alt="Avatar" class="img-responsive avatar">
                <input type="username" name="name" class="form-control" placeholder="Username" required autofocus <?=$user_loggedin?>>
                <input type="password" name="pass" class="form-control" placeholder="Password" required <?=$user_loggedin?>>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitForm" value="Login" <?=$user_loggedin?>>Sign in</button>
                <a type="button" href="<?= $app->url->create("logout") ?>" class="btn btn-lg btn-danger btn-block" <?=$user_not_loggedin?>>Logout</a>
                <button type="button" class="btn btn-lg btn-default btn-block" data-toggle="modal" data-target="#register">Create Account</button>
              </form>

						</div>
					 </div>
				  </li>
			   </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Create Account</h4>
  </div>
  <div class="modal-body">
    <form role="form" method="POST" action="handle_new_user">
        <div class="form-group">
            <label for="new_name">Username: </label>
            <input type="text" name="new_name" class="form-control" />
        </div>
        <div class="form-group">
            <label for="new_pass">Password: </label>
            <input type="password" name="new_pass" class="form-control" />
        </div>
        <div class="form-group">
            <label for="re_pass">Re-enter password: </label>
            <input type="password" name="re_pass" class="form-control" />
        </div>
        <div class="form-group">
            <label for="level">Level: </label>
            <select class="form-control" name="userLevel">
              <option>3</option>
              <option>2</option>
              <option>1</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submitCreateForm" value="Create">Add</button>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
