<?php
$session = $app->session;
$cookie = $app->cookie;

if (!$session->has("name")) {
  header("Location: about");
}

$db = $app->db;
$db->connect();

$status = '<div class="alert alert-info" role="alert">Change Password</div>';
$user_name = $session->get("name");
$cookieStatus = '<div class="alert alert-danger" role="alert">No Cookie exist</div>';
$yourCookie = "";

if ($cookie->has($user_name)) {
  $yourCookie = $cookie->get($user_name);
  $cookieStatus = '<div class="alert alert-success" role="alert">Cookie exist</div>';
}

$sql = "SELECT * FROM users WHERE username LIKE ?;";
$resultset = $db->executeFetch($sql, [$user_name]);
$array = json_decode(json_encode($resultset), True);
$password = $array["password"];
$id = $array["id"];

// Handle incoming POST variables
$old_pass = isset($_POST["old_pass"]) ? htmlentities($_POST["old_pass"]) : null;
$new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
$new_cookie = isset($_POST["new_cookie"]) ? htmlentities($_POST["new_cookie"]) : null;
$delete_cookie = isset($_GET["delete_cookie"]) ? htmlentities($_GET["delete_cookie"]) : null;

if ($new_cookie != null) {
  $cookie->set($user_name, $new_cookie);
  header("Location: profile");
}

if ($delete_cookie != null) {
  $cookie->delete($user_name);
  header("Location: profile");
}

// Check if all fields are filled
if ($old_pass != null && $new_pass != null && $re_pass != null) {
    // Check if old password is correct
    if (password_verify($old_pass, $password)) {
        // Check if new password matches
        if ($new_pass == $re_pass) {
                $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET password = ? WHERE id = ?;";
                $db->execute($sql, [$crypt_pass, $id]);
                $status = '<div class="alert alert-success" role="alert">Password changed!</div>';
        } else {
            $status = '<div class="alert alert-danger" role="alert">The passwords do not match</div>';
        }
    } else {
        $status = '<div class="alert alert-danger" role="alert">Old password is incorrect</div>';
    }
}

?>

<div class="container" role="main">
    <div class="page-header">
        <h1>Profile: <?= $session->get('name') ?></h1>
    </div>
    <div class="col-md-4 bak">
    <h2>Change Password</h2>
    <?=$status?>
    <form action="" method="POST">
      <div class="form-group">
        <label>Old Password:</label>
        <input type="password" name="old_pass" class="form-control" placeholder="Old password" required>
      </div>
      <div class="form-group">
        <label>New Password:</label>
        <input type="password" name="new_pass" class="form-control" placeholder="New password" required>
      </div>
      <div class="form-group">
        <label>Re-enter Password:</label>
        <input type="password" name="re_pass" class="form-control" placeholder="Re-enter Password" required>
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block" name="submitForm" value="Change password">Change Password</button>
    </form>
  </div>

  <div class="col-md-4 col-md-offset-1 bak">
    <h2>Set a Cookie</h2>
    <?=$cookieStatus?>
    <h4>Your Cookie: <?=$yourCookie?></h4>
    <form action="" method="POST">
      <div class="form-group">
        <label>New Cookie:</label>
        <input type="text" name="new_cookie" class="form-control" placeholder="Cookie here..">
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block" name="submitForm" value="setCookie">Set Cookie</button>
      <a href="?delete_cookie=hej" class="btn btn-lg btn-danger btn-block">Delete Cookie</a>
    </form>
  </div>
</div>
