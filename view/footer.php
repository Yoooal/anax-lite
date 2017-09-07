<?php
$db = $app->db;
$db->connect();
$textfilter = $app->textfilter;

$sql = $app->sqlCode->getSqlCode("block");
$block1 = $db->executeFetch($sql, ["footerBlock1", "block"]);
$block2 = $db->executeFetch($sql, ["footerBlock2", "block"]);
$block3 = $db->executeFetch($sql, ["footerBlock3", "block"]);
$block4 = $db->executeFetch($sql, ["footerBlock4", "block"]);
?>

    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <?= $block1->data ?>
          </div>
          <div class="col-sm-3">
            <?= $block2->data ?>
          </div>
          <div class="col-sm-3">
            <?= $block3->data ?>
          </div>
          <div class="col-sm-3">
            <?= $block4->data ?>
          </div>
        </div>
        <hr>
        <div class="row text-center">COPYRIGHT © 2017 SNEAKER STORE</div>
      </div>
    </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
