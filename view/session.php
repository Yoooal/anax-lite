<?php
$session = $app->session;

if ($session->has("number")) {
  $session->get("number");
}
else {
  $session->set("number", 1);
}

$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action !== null) {
	switch($action) {

		case "increase":
      $_SESSION['number']++;
		break;

    case "decrease":
      $_SESSION['number']--;
    break;

    case "status":
      header("Location: sessionStatus");
    break;

    case "dump":
      $session->dump();
    break;

		case "destroy":
      $session->destroy();
      header("Location: session");
		break;

		default:
		die("Error message.");
	}
}

?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Test the session - choose route</h1>
  </div>
  <div class="page-content">
    <div class="col-md-6 bak">
      <h4><?php echo "Current Value: " . $_SESSION['number'] ?></h4>

      <form action="<?php __FILE__ ?>" method="POST">
        <input type="submit" class="btn btn-primary" name="action" value="increase">

        <input type="submit" class="btn btn-success" name="action" value="decrease">

        <input type="submit" class="btn btn-info" name="action" value="status">

        <input type="submit" class="btn btn-warning" name="action" value="dump">

        <input type="submit" class="btn btn-danger" name="action" value="destroy">
      </form>
    </div>
  </div>
</div>
