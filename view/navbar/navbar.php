<?php
$session = $app->session;
$db = $app->db;
$db->connect();

$user_loggedin = "";
$user_not_loggedin = "disabled";
$admin = "disabled";
$content = '<i class="fa fa-sign-in" aria-hidden="true"></i> Login';
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

$sql = "SELECT * FROM showCart;";
$resultset = $db->executeFetchAll($sql);
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
      <a class="navbar-brand" href="<?= $app->url->create("") ?>"><img src="img/sneaker.png" class="img-responsive" alt="Logo"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?= $app->navbar->getHTML(); ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown <?=$user_not_loggedin?>">
          <a href="#" class="dropdown-toggle <?=$user_not_loggedin?>" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart<span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
            <?php foreach ($resultset as $row) : ?>
              <li>
                <span class="item">
                    <span class="item-left">
                        <img class="img-responsive img-rounded webshop" src="<?=$row->picture?>" alt="" />
                        <span class="item-info">
                            <span><?= $row->description ?></span>
                            <span><?= $row->price ?> kr</span>
                        </span>
                    </span>
                  <!-- <span class="item-right">
                      <button class="btn btn-xs btn-danger pull-right">x</button>
                  </span> -->
                </span>
              </li>
              <?php endforeach; ?>
              <li class="divider"></li>
            <li><a class="text-center" href="<?= $app->url->create("cart") ?>">View Cart</a></li>
          </ul>
        </li>
        <li class='<?=$user_not_loggedin?>'><a href="<?= $app->url->create("profile") ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
        <li class="dropdown <?=$admin?>">
          <a href="#" class="dropdown-toggle <?=$admin?>" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs" aria-hidden="true"></i> Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class='<?=$admin?>'><a href="<?= $app->url->create("webshop") ?>">Webshop</a></li>
            <li class='<?=$admin?>'><a href="<?= $app->url->create("user") ?>">Users</a></li>
            <li class='<?=$admin?>'><a href="<?= $app->url->create("content") ?>">Content</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?= $content ?></b> <span class="caret"></span></a>
			     <ul id="login-dp" class="dropdown-menu">
				    <li>
					  <div class="row">
						<div class="col-md-12">

              <form class="form-signin" role="form" action="validate" method="POST">
                <img src="img/sneaker.png" alt="Avatar" class="img-responsive avatar">
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
