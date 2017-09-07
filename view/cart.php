<?php
$session = $app->session;
$cookie = $app->cookie;
$db = $app->db;
$db->connect();

$id = isset($_POST["id"]) ? htmlentities($_POST["id"]) : null;
$del = isset($_GET["del"]) ? htmlentities($_GET["del"]) : null;

if ($del != null) {
  $sql = "DELETE FROM viewCart WHERE id = ?;";
  $db->execute($sql, [$del]);
  header("Location: cart");
}

$sql = "SELECT * FROM showCart;";
$content = $db->executeFetchAll($sql);
$totalPrice = 0;
?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Cart</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12">
        <br>
        <a type="button" class="btn btn-primary btn-lg pull-right" href="order?id="><i class="fa fa-credit-card" aria-hidden="true"></i> Checkout</a>
        <table class="table">
          <thead>
            <tr>
              <th>Bild</th>
              <th>Produkt</th>
              <th>Pris</th>
              <th>Kategori</th>
              <th>Lagerstatus</th>
              <th></th>
            </tr>
          </thead>
          <?php foreach ($content as $row) :
            $totalPrice += $row->price ?>
            <tbody>
              <tr>
                  <td><a target="_blank" href="<?=$row->picture?>"><img src="<?= $row->picture ?>" class="img-responsive img-rounded webshop" alt="Responsive image"></a></td>
                  <td><?= $row->description ?></td>
                  <td><?= $row->price ?> kr</td>
                  <td><?= $row->category ?></td>
                  <td><?= $row->items ?> st</td>
                  <td><a type="button" class="btn btn-lg btn-danger" href="del?id=<?= $row->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              </tr>
            </tbody>
          <?php endforeach; ?>
        </table>
        <hr>
        <h3>Total Price: <?= $totalPrice ?> kr</h3>
      </div>
    </div>
  </div>
</div>
