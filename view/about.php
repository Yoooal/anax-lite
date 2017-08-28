<?php
$db = $app->db;
$urlReport = $app->url->create("status");

$sql = <<<EOD
SELECT
*
FROM content
WHERE
path = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;

$content = $db->executeFetch($sql, ["aboutText", "block"]);

?>

<div class="container" role="main">
    <div class="page-header">
        <h1>About</h1>
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="img/profil.jpg" class="img-responsive aboutPicture" alt="Responsive image">
      </div>
      <div class="col-md-9 bak">
        <br>
        <?= $content->data ?>
      </div>
    </div>
</div>
