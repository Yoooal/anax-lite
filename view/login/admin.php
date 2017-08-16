<?php
$session = $app->session;
$cookie = $app->cookie;

if ($session->get("name") != "admin") {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$db = $app->db;
$db->connect();

$status = '<div class="alert alert-info" role="alert">Change Password</div>';

$sql = "SELECT * FROM users;";
$resultset = $db->executeFetchAll($sql);
$array = json_decode(json_encode($resultset), True);
// $password = $array["password"];
// $id = $array["id"];

// Handle incoming POST variables
$new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
$level = isset($_POST["level"]) ? htmlentities($_POST["level"]) : null;
$search = isset($_POST["search"]) ? htmlentities($_POST["search"]) : null;
$id = isset($_POST["id"]) ? htmlentities($_POST["id"]) : null;
$del = isset($_GET["del"]) ? htmlentities($_GET["del"]) : null;

if ($new_pass != null && $re_pass != null) {
    // Check if new password matches
    if ($new_pass == $re_pass) {
        $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?;";
        $db->execute($sql, [$crypt_pass, $id]);
        $status = '<div class="alert alert-success" role="alert">Password changed!</div>';
    } else {
        $status = '<div class="alert alert-danger" role="alert">The passwords do not match</div>';
    }
}

if ($id != null && $level != null) {
  $sql = "UPDATE users SET userLevel = ? WHERE id = ?;";
  $db->execute($sql, [$level, $id]);
  header("Location: admin");
}

if ($del != null) {
  $sql = "DELETE FROM users WHERE id = ?;";
  $db->execute($sql, [$del]);
  header("Location: admin");
}

if ($search != null) {
  $sql = "SELECT * FROM users WHERE username LIKE ?;";
  $resultset = $db->executeFetchAll($sql, [$search]);
}

?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Admin</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12 bak">
        <br>
        <div class="col-md-6">
          <form class="" action="admin" method="post">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="search" name="search" class="form-control input-lg" placeholder="Search username" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
          </form>
        </div>
        <button type="button" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#register">
          Add User
        </button>
        <table class="table">
          <thead>
            <tr>
              <th>Username</th>
              <th>Level</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($resultset as $row) {
              if ($row->username == "admin") {

              } else {
              ?>
                <tr>
                  <td><?= $row->username ?></td>
                  <td><?= $row->userLevel ?></td>
                  <td>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <select class="form-control" name="level" onchange="this.form.submit()">
                                <option>Change level here..</option>
                                <option>3</option>
                                <option>2</option>
                                <option>1</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                    </form>
                  </td>
                  <td>
                  <form action="admin" method="POST">
                    <input type="password" name="new_pass" placeholder="New password" required>
                    <input type="password" name="re_pass" placeholder="Re-enter Password" required>
                    <button type="submit" class="btn btn-primary" name="submitForm" value="Change password">Change Password</button>
                    <input type="hidden" name="id" value="<?= $row->id ?>">
                  </form>
                  </td>
                  <td><a type="button" class="btn btn-danger" href='?del=<?= $row->id ?>'>Delete</a></td>
                </tr>
              <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
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
  </div>
</div>
