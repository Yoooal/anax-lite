<?php
$session = $app->session;
$diceGame = $app->diceGame;
$session->start();

if ($session->has("rolls")) {
  $session->get("rolls");
  $diceGame->rolls = $_SESSION['rolls'];
}
else {
  $_SESSION['rolls'] = array();
}

if ($session->has("player1")) {
  $session->get("player1");
  $diceGame->player1 = $_SESSION['player1'];
}
else {
  $_SESSION['player1'] = array();
}

$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action !== null) {
	switch($action) {

		case "roll":
      $diceGame->rollDice();
      array_push($_SESSION['rolls'], $diceGame->diceNumber);
		break;

    case "save":
      array_push($_SESSION['player1'], $diceGame->getTotal() + $diceGame->diceNumber);
      unset($_SESSION["rolls"]);
      header("Location: dice");
    break;

		case "destroy":
      $session->destroy();
      header("Location: dice");
		break;

		default:
		die("Error message.");
	}
}

$roundScore = $diceGame->getTotal() + $diceGame->diceNumber;
$totalScore = $diceGame->getTotalPlayer() + $roundScore;

if ($diceGame->diceNumber == 1) {
  unset($_SESSION["rolls"]);
  header("Location: dice");
}

?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Dice Game</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-4">
        <h2>Total Score</h2>
        <h4>Player: <?= $totalScore ?></h4>
      </div>
      <div class="col-md-4">
        <form action="<?php __FILE__ ?>" method="POST">
          <h2>Player</h2>
          <h4>Round Score: <?= $roundScore ?></h4>
          <?= $diceGame->win($totalScore); ?>
          <h4>History: <?= implode(", ", $diceGame->rolls) ?></h4>
          <h4>Dice: <?= $diceGame->diceNumber ?></h4>
          <br>
          <button type="submit" class="btn btn-success" name="action" value="roll">Roll Dice</button>
          <button type="submit" class="btn btn-primary" name="action" value="save">Save Score</button>
          <button type="submit" class="btn btn-danger" name="action" value="destroy">Kill Game</button>
        </form>
      </div>
      <div class="col-md-4">
        <h2>Info om spelet</h2>
        <p>Tärningsspelet 100 är ett enkelt, men roligt, tärningsspel.
          Det gäller att samla ihop poäng för att komma först till 100.
          I varje omgång kastar en spelare tärning tills hon väljer att
          stanna och spara poängen eller tills det dyker upp en 1:a och
          hon förlorar alla poäng som samlats in i rundan.</p>
      </div>
    </div>
  </div>
</div>
